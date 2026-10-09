<?php
/*
 * auth.php — 後台登入檢查
 *
 * 每一個後台頁面（background.php 與 bg_php/ 底下所有頁面）都在第一行 require 這個檔案。
 * 若 session 中沒有登入紀錄，就導回登入頁 enter.php，避免直接輸入網址繞過登入。
 */

require_once __DIR__ . '/session.php';

if (empty($_SESSION['admin_id'])) {
    // 依目前頁面所在的資料夾深度，組出回到 enter.php 的相對路徑
    // 例：background.php → enter.php；bg_php/award/bg_award.php → ../../enter.php
    $script = str_replace('\\', '/', realpath($_SERVER['SCRIPT_FILENAME']));
    $root   = str_replace('\\', '/', __DIR__);
    $depth  = substr_count(substr($script, strlen($root) + 1), '/');

    header('Location: ' . str_repeat('../', $depth) . 'enter.php');
    exit; // 一定要結束，否則後面的頁面內容仍會被輸出
}
