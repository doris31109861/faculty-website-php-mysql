<?php
// delete_plan.php — 刪除一筆計畫資料（共用邏輯在 bg_php/crud.php，表單送出後回到 bg_plan.php）
require_once __DIR__ . '/../../auth.php';   // 未登入導回登入頁
require_once __DIR__ . '/../crud.php';
crud_handle('plan', 'delete');
