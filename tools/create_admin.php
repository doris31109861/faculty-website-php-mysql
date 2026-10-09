<?php
/*
 * tools/create_admin.php — 建立或重設後台管理員帳號（只能在命令列執行）
 *
 * 用法：php tools/create_admin.php <帳號> <密碼>
 *
 * 密碼以 password_hash()（預設 bcrypt）雜湊後才存入 admin 資料表，
 * 資料庫與程式碼裡都不會出現明文密碼。
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);  // 禁止從瀏覽器執行
    exit('CLI only');
}

if ($argc !== 3) {
    fwrite(STDERR, "用法: php tools/create_admin.php <username> <password>\n");
    exit(1);
}

require_once __DIR__ . '/../config.php';

[$_, $username, $password] = $argv;
$hash = password_hash($password, PASSWORD_DEFAULT);

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or exit("無法連線資料庫\n");
mysqli_set_charset($link, 'utf8mb4');

// 帳號已存在就更新密碼，不存在就新增
$stmt = mysqli_prepare($link,
    'INSERT INTO admin (username, password_hash) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)');
mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
mysqli_stmt_execute($stmt);

echo "管理員 {$username} 已建立／更新\n";
