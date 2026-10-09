# Changelog

## 2026-10-09 — 補上完整建表語法 schema.sql

- **內容**：`schema.sql` 加入 6 張內容表（TIME、EXPERIENCE、PAPER、BOOK、PLAN、AWARD），欄位依程式中的 INSERT / UPDATE / SELECT 反推；每張表加自動遞增 `id` 主鍵；README 安裝步驟改為直接匯入 `schema.sql`。
- **原因**：原本沒有建表語法，別人無法重現網站。
- **測試**：此電腦沒有 MySQL，**未實際匯入測試**；已逐一比對欄位名稱與程式中的 SQL 一致，且程式以欄位名稱讀取資料，新增 `id` 欄位不影響既有功能。

## 2026-10-09 — 後台登入加上真正的帳密驗證

- **內容**：`enter.php` 改為 POST 到新的 `login.php`；帳號存在 `admin` 資料表（`schema.sql`），密碼以 `password_hash()` 雜湊、`password_verify()` 比對，查詢使用 prepared statement；登入成功後 `session_regenerate_id()` 並以 session 記錄；新增 `auth.php`，`background.php` 與 `bg_php/` 下 30 個頁面開頭都會檢查登入；新增 `logout.php` 與 `tools/create_admin.php`。
- **原因**：原本登入按鈕只是直接跳到 `background.php`，任何人都能進後台修改資料。
- **測試**：此電腦沒有安裝 PHP／MySQL，**尚未實際執行測試**；僅人工檢查程式流程。
