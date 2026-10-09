<?php
/*
 * session.php — 統一啟動 PHP session
 *
 * 設定 session cookie：HttpOnly 讓 JavaScript 讀不到 cookie、SameSite=Lax 降低 CSRF 風險。
 * enter.php、login.php、logout.php、auth.php 都透過這個檔案啟動 session。
 */

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}
