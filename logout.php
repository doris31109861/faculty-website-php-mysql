<?php
/*
 * logout.php — 登出：清空 session 資料、刪除 session cookie，再回到登入頁
 */

require_once __DIR__ . '/session.php';

$_SESSION = [];

// 讓瀏覽器端的 session cookie 立即過期
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_destroy();

header('Location: enter.php');
exit;
