#!/usr/bin/env bash
# tests/integration_test.sh — 用 curl 實際操作網站，驗證登入保護與後台 CRUD
#
# 前置（CI 會自動做）：MySQL 已匯入 schema.sql、config.php 已設定、
# 已用 tools/create_admin.php 建立測試帳號，並以 php -S 在 $BASE 啟動網站。
# 用法：BASE=http://127.0.0.1:8000 ADMIN_USER=admin ADMIN_PASS=... bash tests/integration_test.sh

set -u
BASE="${BASE:-http://127.0.0.1:8000}"
JAR="$(mktemp)"          # cookie jar：保存登入後的 session
FAILS=0

pass() { echo "PASS  $1"; }
fail() { echo "FAIL  $1"; FAILS=$((FAILS + 1)); }

# 回傳 HTTP 狀態碼與 Location 標頭（不跟隨轉址）
status_and_location() {
    curl -s -o /dev/null -w '%{http_code} %{redirect_url}' -b "$JAR" -c "$JAR" "$@"
}

# 1) 未登入直接開後台頁面 → 應被導回 enter.php
for page in background.php bg_php/award/bg_award.php bg_php/paper/insert_paper.php; do
    r=$(status_and_location "$BASE/$page")
    [[ "$r" == 302*enter.php ]] && pass "未登入開 $page 被導回登入頁" || fail "未登入開 $page：$r"
done

# 2) 錯誤密碼 → 回登入頁，且仍進不了後台
r=$(status_and_location -d "username=$ADMIN_USER&password=wrong-password" "$BASE/login.php")
[[ "$r" == 302*enter.php ]] && pass "錯誤密碼被拒絕" || fail "錯誤密碼：$r"
r=$(status_and_location "$BASE/background.php")
[[ "$r" == 302*enter.php ]] && pass "錯誤密碼後仍無法進後台" || fail "錯誤密碼後開後台：$r"

# 3) 正確密碼 → 導到後台，之後可以正常開啟後台頁面
r=$(status_and_location -d "username=$ADMIN_USER&password=$ADMIN_PASS" "$BASE/login.php")
[[ "$r" == 302*background.php ]] && pass "正確密碼登入成功" || fail "正確密碼：$r"
code=$(curl -s -o /dev/null -w '%{http_code}' -b "$JAR" "$BASE/bg_php/award/bg_award.php")
[[ "$code" == 200 ]] && pass "登入後可開啟後台頁面" || fail "登入後開後台：$code"

# 4) 新增：名稱含單引號與 SQL 片段，prepared statement 應原樣存入
NAME="O'Brien Award'; DROP TABLE AWARD; --"
curl -s -o /dev/null -b "$JAR" --data-urlencode "year=2023" --data-urlencode "name=$NAME" \
    --data-urlencode "uint=FCU" --data-urlencode "date=2023-05-29" --data-urlencode "award=Best Paper" \
    --data-urlencode "type=0" "$BASE/bg_php/award/insert_award.php"
count=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT COUNT(*) FROM AWARD WHERE Name='O''Brien Award''; DROP TABLE AWARD; --'")
[[ "$count" == 1 ]] && pass "含引號／SQL 片段的資料原樣寫入，資料表未被破壞" || fail "新增：count=$count"

# 5) 前台顯示時有做 HTML 跳脫的查詢頁：select_award.php 應能查到這筆
body=$(curl -s -b "$JAR" --data-urlencode "name1=$NAME" --data-urlencode "award1=Best Paper" "$BASE/bg_php/award/select_award.php")
grep -q "O&#039;Brien Award" <<<"$body" && pass "查詢頁找到資料且輸出已跳脫" || fail "查詢頁沒有找到資料"

# 6) 修改
curl -s -o /dev/null -b "$JAR" --data-urlencode "name1=$NAME" --data-urlencode "award1=Best Paper" \
    --data-urlencode "year=2024" --data-urlencode "name=Renamed Award" --data-urlencode "uint=FCU" \
    --data-urlencode "date=2024-01-01" --data-urlencode "award=Gold" --data-urlencode "type=1" \
    "$BASE/bg_php/award/update_award.php"
year=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT Year FROM AWARD WHERE Name='Renamed Award' AND Award='Gold'")
[[ "$year" == 2024 ]] && pass "修改成功" || fail "修改：year=$year"

# 7) 前台首頁能顯示修改後的資料
curl -s "$BASE/index.php" | grep -q "Renamed Award" && pass "前台首頁顯示資料" || fail "前台首頁沒有顯示資料"

# 8) 刪除
curl -s -o /dev/null -b "$JAR" --data-urlencode "name=Renamed Award" --data-urlencode "award=Gold" \
    "$BASE/bg_php/award/delete_award.php"
count=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT COUNT(*) FROM AWARD")
[[ "$count" == 0 ]] && pass "刪除成功" || fail "刪除：count=$count"

# 9) 其他 5 張表各做一次新增，確認每個 insert 頁的欄位與佔位符對得上
curl -s -o /dev/null -b "$JAR" -d "day=Monday&class=3&class_name=DB" "$BASE/bg_php/time/insert_time.php"
curl -s -o /dev/null -b "$JAR" -d "department=CSIE&position=Professor&type=0" "$BASE/bg_php/experience/insert_experience.php"
curl -s -o /dev/null -b "$JAR" -d "name=Paper1&teacher=Lee&date=2023&page=1-8&source=IEEE&type=0&num=3&place=Taipei" "$BASE/bg_php/paper/insert_paper.php"
curl -s -o /dev/null -b "$JAR" -d "name=Book1&press=Pub&type=0&nation=TW&date=2023&teacher=Lee" "$BASE/bg_php/book/insert_book.php"
curl -s -o /dev/null -b "$JAR" -d "name=Plan1&role=PI&date=2023&number=NSTC-1&type=0" "$BASE/bg_php/plan/insert_plan.php"
for t in TIME EXPERIENCE PAPER BOOK PLAN; do
    c=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT COUNT(*) FROM $t")
    [[ "$c" == 1 ]] && pass "$t 新增成功" || fail "$t 新增：count=$c"
done
role=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT Role FROM PLAN")
[[ "$role" == PI ]] && pass "PLAN.Role 沒有多餘的前導空白" || fail "PLAN.Role='$role'"

# 10) 其他表的修改／刪除：涵蓋兩個 key（TIME、EXPERIENCE）與單一 key（PAPER）
curl -s -o /dev/null -b "$JAR" -d "day1=Monday&class1=3&day=Tuesday&class=5&class_name=DB2" "$BASE/bg_php/time/update_time.php"
v=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT CONCAT(Day,'/',Class,'/',Class_name) FROM TIME")
[[ "$v" == "Tuesday/5/DB2" ]] && pass "TIME 修改成功" || fail "TIME 修改：$v"
curl -s -o /dev/null -b "$JAR" -d "department1=CSIE&position1=Professor&department=EE&position=Chair&type=1" "$BASE/bg_php/experience/update_experience.php"
v=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT CONCAT(Department,'/',Position,'/',Type) FROM EXPERIENCE")
[[ "$v" == "EE/Chair/1" ]] && pass "EXPERIENCE 修改成功" || fail "EXPERIENCE 修改：$v"
curl -s -o /dev/null -b "$JAR" -d "name1=Paper1&name=Paper2&teacher=Lee&date=2024&page=9&source=ACM&type=1&num=4&place=Tainan" "$BASE/bg_php/paper/update_paper.php"
v=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT CONCAT(Name,'/',Source,'/',Place) FROM PAPER")
[[ "$v" == "Paper2/ACM/Tainan" ]] && pass "PAPER 修改成功" || fail "PAPER 修改：$v"
curl -s -o /dev/null -b "$JAR" -d "day=Tuesday&class=5" "$BASE/bg_php/time/delete_time.php"
curl -s -o /dev/null -b "$JAR" -d "department=EE&position=Chair" "$BASE/bg_php/experience/delete_experience.php"
curl -s -o /dev/null -b "$JAR" -d "name=Paper2" "$BASE/bg_php/paper/delete_paper.php"
curl -s -o /dev/null -b "$JAR" -d "name=Book1&type=0" "$BASE/bg_php/book/delete_book.php"
curl -s -o /dev/null -b "$JAR" -d "name=Plan1" "$BASE/bg_php/plan/delete_plan.php"
for t in TIME EXPERIENCE PAPER BOOK PLAN; do
    c=$(mysql -N -h 127.0.0.1 -u root -p"$DB_ROOT_PASS" "$DB_NAME" -e "SELECT COUNT(*) FROM $t")
    [[ "$c" == 0 ]] && pass "$t 刪除成功" || fail "$t 刪除：count=$c"
done

# 11) 登出後再也進不了後台
curl -s -o /dev/null -b "$JAR" -c "$JAR" "$BASE/logout.php"
r=$(status_and_location "$BASE/background.php")
[[ "$r" == 302*enter.php ]] && pass "登出後後台被保護" || fail "登出後：$r"

rm -f "$JAR"
echo "-----"
if [[ $FAILS -eq 0 ]]; then echo "全部通過"; else echo "$FAILS 項失敗"; exit 1; fi
