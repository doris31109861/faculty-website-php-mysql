# Changelog

## 2026-10-09 — 後台登入加上真正的帳密驗證

- **內容**：`enter.php` 改為 POST 到新的 `login.php`；帳號存在 `admin` 資料表（`schema.sql`），密碼以 `password_hash()` 雜湊、`password_verify()` 比對，查詢使用 prepared statement；登入成功後 `session_regenerate_id()` 並以 session 記錄；新增 `auth.php`，`background.php` 與 `bg_php/` 下 30 個頁面開頭都會檢查登入；新增 `logout.php` 與 `tools/create_admin.php`。
- **原因**：原本登入按鈕只是直接跳到 `background.php`，任何人都能進後台修改資料。
- **測試**：此電腦沒有安裝 PHP／MySQL，**尚未實際執行測試**；僅人工檢查程式流程。
