# Faculty Profile Website (PHP + MySQL)

> 資料庫系統期末專題｜逢甲大學資訊工程學系（成績 98）｜PHP、MySQL、HTML/CSS、JavaScript

[中文](#中文) | [English](#english)

---

## 中文

參考逢甲大學資訊工程學系教授的個人網頁，重新架設一個以 MySQL 為後端的網站，並加上後台管理系統維護網站內容。

### 功能

- **前台網頁**（`index.php`）：直接從資料庫讀取並顯示教授的論文、著作、獲獎、研究計畫、經歷與課表
- **後台登入**（`enter.php` → `login.php`）：帳密存在 `admin` 資料表，密碼以 `password_hash()` 雜湊；登入後以 PHP session 記錄，每個後台頁面開頭都 `require auth.php` 檢查登入狀態，未登入一律導回登入頁；`logout.php` 登出
- **後台管理**（`bg_php/`）：6 張資料表都有完整的新增／查詢／修改／刪除（CRUD）

| 資料表 | 內容 |
|---|---|
| `paper` | 期刊與研討會論文 |
| `book` | 專書與專書章節 |
| `award` | 獲獎紀錄 |
| `plan` | 研究計畫 |
| `experience` | 經歷 |
| `time` | 課表／Office hour |

- **防 SQL injection**：所有含使用者輸入的 SQL 都改用 prepared statement（`db.php` 的 `db_run()`，`?` 佔位符＋`bind_param`），查詢結果輸出到 HTML 前以 `htmlspecialchars` 跳脫

### 安裝與執行

1. 建立 MySQL 資料庫，匯入 `schema.sql`：`mysql -u <user> -p <database> < schema.sql`（建立 6 張內容表與 `admin` 表）
2. 將 `config.example.php` 複製成 `config.php`，填入自己的資料庫帳密（`config.php` 已列入 `.gitignore`，不會上傳）
3. 建立後台帳號：`php tools/create_admin.php <帳號> <密碼>`（只會存入密碼雜湊）
4. 用 Apache + PHP（例如 XAMPP）開啟 `index.php`

### 專案結構

```
index.php            # 前台
enter.php            # 後台登入頁
login.php / logout.php  # 登入驗證（password_verify + session）／登出
auth.php             # 後台頁面共用的登入檢查
db.php               # prepared statement 共用函式 db_run()、HTML 跳脫 h()
schema.sql           # 建表語法（6 張內容表＋admin）
tools/create_admin.php  # 建立管理員帳號（命令列）
background.php       # 後台首頁
bg_php/<資料表>/     # 每張表的 bg_ / insert_ / select_ / update_ / delete_ 頁面
config.example.php   # 資料庫設定範本
```

### 學到的東西

- 關聯式資料表設計與 SQL CRUD
- 以 PHP 進行伺服器端渲染並串接 MySQL
- 前台展示與後台管理的分離

---

## English

A rebuild of a CSIE professor's profile website, backed by MySQL, with an admin back-end for managing its content.

### Features

- **Public site** (`index.php`): renders papers, books, awards, research projects, experience and schedule from the database
- **Admin login** (`enter.php` → `login.php`): credentials live in an `admin` table with `password_hash()` hashes; a PHP session marks the user as logged in, every admin page starts with `require auth.php` and redirects to the login page otherwise; `logout.php` ends the session
- **Admin back-end** (`bg_php/`): full CRUD for 6 tables (`paper`, `book`, `award`, `plan`, `experience`, `time`)
- **SQL-injection safe**: every query that takes user input uses a prepared statement (`db_run()` in `db.php`, `?` placeholders + `bind_param`); query results are HTML-escaped before output

### Setup

1. Create a MySQL database and import `schema.sql` (six content tables plus `admin`): `mysql -u <user> -p <database> < schema.sql`.
2. Copy `config.example.php` to `config.php` and fill in your credentials (`config.php` is git-ignored).
3. Create an admin account: `php tools/create_admin.php <user> <password>` (only the hash is stored).
4. Serve the folder with Apache/PHP (e.g. XAMPP) and open `index.php`.

### What I learned

- Relational schema design and SQL CRUD
- Server-side rendering with PHP and MySQL
- Separating a public front-end from an admin back-end
