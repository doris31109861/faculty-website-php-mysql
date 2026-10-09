-- schema.sql — 資料庫建表語法
--
-- 匯入方式：mysql -u <user> -p <database> < schema.sql
--
-- 欄位名稱與程式中的 SQL 完全一致（表名大寫：程式寫 AWARD、BOOK…，
-- 在 Linux 上 MySQL 表名區分大小寫，所以這裡也用大寫）。
-- 原本的表單欄位都是文字輸入，因此年份、日期也以 VARCHAR 儲存。
-- 每張表加上自動遞增的 id 作為主鍵；程式以欄位名稱讀取資料，多一個欄位不影響原功能。
-- Type 欄位是分類代碼（0/1/2），前台依 Type 分區塊顯示。

-- 課表／Office hour
CREATE TABLE IF NOT EXISTS TIME (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    Day        VARCHAR(20)  NOT NULL,   -- 星期
    Class      VARCHAR(20)  NOT NULL,   -- 節次
    Class_name VARCHAR(100) NOT NULL    -- 課程名稱
) DEFAULT CHARSET = utf8mb4;

-- 經歷（Type 為分類代碼，前台分兩區顯示）
CREATE TABLE IF NOT EXISTS EXPERIENCE (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    Department VARCHAR(100) NOT NULL,   -- 單位
    Position   VARCHAR(100) NOT NULL,   -- 職稱
    Type       CHAR(1)      NOT NULL DEFAULT '0'
) DEFAULT CHARSET = utf8mb4;

-- 論文（Type 0 / 1 / 2 為分類代碼，前台分三區顯示，例如會議論文、專書論文）
CREATE TABLE IF NOT EXISTS PAPER (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    Name    VARCHAR(255) NOT NULL,      -- 論文名稱
    Teacher VARCHAR(255),               -- 作者
    Date    VARCHAR(50),                -- 發表日期
    Page    VARCHAR(50),                -- 頁數
    Source  VARCHAR(255),               -- 期刊／會議名稱
    Type    CHAR(1)      NOT NULL DEFAULT '0',
    Num     VARCHAR(50),                -- 卷期
    Place   VARCHAR(100)                -- 發表地點
) DEFAULT CHARSET = utf8mb4;

-- 專書與專書章節
CREATE TABLE IF NOT EXISTS BOOK (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    Name    VARCHAR(255) NOT NULL,      -- 書名
    Press   VARCHAR(100),               -- 出版社
    Type    CHAR(1)      NOT NULL DEFAULT '0',
    Nation  VARCHAR(50),                -- 出版國家
    Date    VARCHAR(50),                -- 出版日期
    Teacher VARCHAR(255)                -- 作者
) DEFAULT CHARSET = utf8mb4;

-- 研究計畫
CREATE TABLE IF NOT EXISTS PLAN (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    Name   VARCHAR(255) NOT NULL,       -- 計畫名稱
    Role   VARCHAR(50),                 -- 擔任角色（主持人／共同主持人）
    Date   VARCHAR(50),                 -- 執行期間
    Number VARCHAR(50),                 -- 計畫編號
    Type   CHAR(1)      NOT NULL DEFAULT '0'
) DEFAULT CHARSET = utf8mb4;

-- 獲獎紀錄（Uint 為程式中沿用的欄位名稱，代表頒獎單位）
CREATE TABLE IF NOT EXISTS AWARD (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    Year  VARCHAR(10),                  -- 年度
    Name  VARCHAR(255) NOT NULL,        -- 獲獎者／作品
    Uint  VARCHAR(100),                 -- 頒獎單位
    Date  VARCHAR(50),                  -- 日期
    Award VARCHAR(255) NOT NULL,        -- 獎項名稱
    Type  CHAR(1)      NOT NULL DEFAULT '0'
) DEFAULT CHARSET = utf8mb4;

-- 後台管理員帳號：只存 password_hash() 產生的雜湊，不存明文密碼
-- 建立帳號請用：php tools/create_admin.php <帳號> <密碼>
CREATE TABLE IF NOT EXISTS admin (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET = utf8mb4;
