<?php
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://localhost/DuAn');
date_default_timezone_set("Asia/Ho_Chi_Minh");

function check($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}
