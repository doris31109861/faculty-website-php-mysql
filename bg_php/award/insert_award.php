<?php
// insert_award.php — 新增一筆獎項資料（共用邏輯在 bg_php/crud.php，表單送出後回到 bg_award.php）
require_once __DIR__ . '/../../auth.php';   // 未登入導回登入頁
require_once __DIR__ . '/../crud.php';
crud_handle('award', 'insert');
