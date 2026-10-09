-- schema.sql — 資料庫建表語法
--
-- 匯入方式：mysql -u <user> -p <database> < schema.sql

-- 後台管理員帳號：只存 password_hash() 產生的雜湊，不存明文密碼
-- 建立帳號請用：php tools/create_admin.php <帳號> <密碼>
CREATE TABLE IF NOT EXISTS admin (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET = utf8mb4;
