# Changelog

## 2026-10-09 — 新增／修改／刪除抽成共用函式

- **內容**：新增 `bg_php/crud.php`：以 `$CRUD_TABLES` 描述 6 張表的欄位與 key，`crud_build()` 依動作組出 SQL 與參數、`crud_handle()` 執行並轉址。18 個 `insert_`／`update_`／`delete_` 頁面各縮成 3 行（共刪除約 450 行重複程式）。整合測試加入 TIME、EXPERIENCE、PAPER 的修改與 5 張表的刪除。
- **原因**：6 張表的 CRUD 幾乎一樣，抽成共用函式後新增資料表只要加一行設定。
- **測試**：見 CI 整合測試結果（下一筆紀錄）。

## 2026-10-09 — 加入 PHP + MySQL 整合測試（GitHub Actions）

- **內容**：新增 `tests/integration_test.sh` 與 `.github/workflows/integration.yml`：CI 啟動 MySQL 8 與 PHP 8.2，匯入 `schema.sql`、建立測試管理員，再用 curl 實際操作網站：未登入被導回、錯誤密碼被拒、正確密碼登入、新增含單引號與 SQL 片段的資料、查詢頁輸出跳脫、修改、前台顯示、刪除、其餘 5 張表各新增一筆、登出後後台受保護；另對所有 `.php` 做 `php -l` 語法檢查。
- **原因**：此電腦沒有 PHP／MySQL，先前的登入、schema、prepared statement 修改都還沒實際執行過。
- **測試**：CI 實跑 21 項全部通過（含先前未能在本機測試的登入、schema、prepared statement 修改）。

## 2026-10-09 — README 加入操作畫面 GIF

- **內容**：從期末專題錄影（2023-05-29）擷取前台各區塊與後台時間表維護畫面，做成 `docs/demo.gif`（800px、8fps、約 450KB），放在 README 開頭。已裁掉瀏覽器網址列與工作列，並避開顯示學校伺服器 IP 與登入帳號的片段。
- **原因**：讓 README 一打開就看得到網站實際畫面。
- **測試**：逐格檢查 GIF，確認沒有網址、IP 或帳號資訊。

## 2026-10-09 — SQL 改用 prepared statements

- **內容**：新增 `db.php`（`db_run($link, $sql, $params)`：`mysqli_prepare` + `bind_param` + `execute`；`h()`：HTML 跳脫）。`bg_php/` 下 24 個新增／查詢／修改／刪除頁面的 SQL 全部改成 `?` 佔位符，移除 `mysqli_real_escape_string` 字串拼接；查詢頁輸出資料時加上 `h()` 防 XSS。`insert_plan.php` 原本 Role 值前面多一個空白（`' $role'`），改用佔位符後一併修正。
- **原因**：字串拼接 SQL 即使有 escape 仍不是最佳做法，prepared statement 讓資料永遠不會被當成 SQL 執行。
- **測試**：此電腦沒有 PHP／MySQL，**未實際執行**；轉換以腳本完成，已逐檔確認佔位符數量與綁定參數數量、順序一致（前台 `index.php` 的查詢不含使用者輸入，維持原樣）。

## 2026-10-09 — 補上完整建表語法 schema.sql

- **內容**：`schema.sql` 加入 6 張內容表（TIME、EXPERIENCE、PAPER、BOOK、PLAN、AWARD），欄位依程式中的 INSERT / UPDATE / SELECT 反推；每張表加自動遞增 `id` 主鍵；README 安裝步驟改為直接匯入 `schema.sql`。
- **原因**：原本沒有建表語法，別人無法重現網站。
- **測試**：此電腦沒有 MySQL，**未實際匯入測試**；已逐一比對欄位名稱與程式中的 SQL 一致，且程式以欄位名稱讀取資料，新增 `id` 欄位不影響既有功能。

## 2026-10-09 — 後台登入加上真正的帳密驗證

- **內容**：`enter.php` 改為 POST 到新的 `login.php`；帳號存在 `admin` 資料表（`schema.sql`），密碼以 `password_hash()` 雜湊、`password_verify()` 比對，查詢使用 prepared statement；登入成功後 `session_regenerate_id()` 並以 session 記錄；新增 `auth.php`，`background.php` 與 `bg_php/` 下 30 個頁面開頭都會檢查登入；新增 `logout.php` 與 `tools/create_admin.php`。
- **原因**：原本登入按鈕只是直接跳到 `background.php`，任何人都能進後台修改資料。
- **測試**：此電腦沒有安裝 PHP／MySQL，**尚未實際執行測試**；僅人工檢查程式流程。
