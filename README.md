# Faculty Profile Website (PHP + MySQL)

> 資料庫系統期末專題｜逢甲大學資訊工程學系（成績 98）｜PHP、MySQL、HTML/CSS、JavaScript

[中文](#中文) | [English](#english)

---

## 中文

參考逢甲大學資訊工程學系教授的個人網頁，重新架設一個以 MySQL 為後端的網站，並加上後台管理系統維護網站內容。

### 功能

- **前台網頁**（`index.php`）：直接從資料庫讀取並顯示教授的論文、著作、獲獎、研究計畫、經歷與課表
- **後台登入**（`enter.php`）
- **後台管理**（`bg_php/`）：6 張資料表都有完整的新增／查詢／修改／刪除（CRUD）

| 資料表 | 內容 |
|---|---|
| `paper` | 期刊與研討會論文 |
| `book` | 專書與專書章節 |
| `award` | 獲獎紀錄 |
| `plan` | 研究計畫 |
| `experience` | 經歷 |
| `time` | 課表／Office hour |

- 寫入資料庫前以 `mysqli_real_escape_string` 處理使用者輸入

### 安裝與執行

1. 建立 MySQL 資料庫與上述 6 張資料表
2. 將 `config.example.php` 複製成 `config.php`，填入自己的資料庫帳密（`config.php` 已列入 `.gitignore`，不會上傳）
3. 用 Apache + PHP（例如 XAMPP）開啟 `index.php`

### 專案結構

```
index.php            # 前台
enter.php            # 後台登入
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
- **Admin login** (`enter.php`)
- **Admin back-end** (`bg_php/`): full CRUD for 6 tables (`paper`, `book`, `award`, `plan`, `experience`, `time`)
- User input is escaped with `mysqli_real_escape_string` before it is written to the database

### Setup

1. Create a MySQL database and the six tables.
2. Copy `config.example.php` to `config.php` and fill in your credentials (`config.php` is git-ignored).
3. Serve the folder with Apache/PHP (e.g. XAMPP) and open `index.php`.

### What I learned

- Relational schema design and SQL CRUD
- Server-side rendering with PHP and MySQL
- Separating a public front-end from an admin back-end
