<?php
/*
 * login.php — 處理後台登入表單（enter.php 以 POST 送到這裡）
 *
 * 流程：
 *   1. 用 prepared statement 依帳號查出 admin 資料表中的密碼雜湊（避免 SQL injection）
 *   2. 用 password_verify() 比對使用者輸入的密碼與資料庫中的 password_hash() 雜湊
 *   3. 成功：重新產生 session id（防 session fixation），記錄登入者後導到後台首頁
 *      失敗：導回登入頁並顯示錯誤訊息（不透露是帳號錯還是密碼錯）
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/session.php';

// 只接受 POST，直接用網址開啟就回登入頁
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: enter.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$ok = false;
if ($username !== '' && $password !== '') {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($link) {
        mysqli_set_charset($link, 'utf8mb4');

        // 以 ? 佔位符查詢，帳號字串不會被當成 SQL 執行
        $stmt = mysqli_prepare($link, 'SELECT id, password_hash FROM admin WHERE username = ?');
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $hash);

        if (mysqli_stmt_fetch($stmt) && password_verify($password, $hash)) {
            $ok = true;
            session_regenerate_id(true);         // 登入成功後換新的 session id
            $_SESSION['admin_id']   = $id;
            $_SESSION['admin_name'] = $username;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
}

if ($ok) {
    header('Location: background.php');
} else {
    $_SESSION['login_error'] = '帳號或密碼錯誤';
    header('Location: enter.php');
}
exit;
