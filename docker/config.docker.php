<?php
// config.docker.php — Docker Compose 用的設定：資料庫連線資訊由環境變數提供（見 docker-compose.yml）
define('DB_HOST', getenv('DB_HOST') ?: 'db');
define('DB_USER', getenv('DB_USER') ?: 'faculty');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'faculty');
