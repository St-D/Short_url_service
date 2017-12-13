<?php
// Устанавливаем возможность отправлять ответ для любого домена
header('Access-Control-Allow-Origin: *');
//echo phpversion()."<br>";
/*
if (version_compare(phpversion(), '5.3.0', '>=')  == 1)
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

else
    error_reporting(E_ALL & ~E_NOTICE);
*/

$long_url = urldecode($_GET["long"]);
$short_url = urldecode($_GET["short"]);

$_POST["l_url"] = $long_url;
$_POST["s_url"] = $short_url;

header('Content-type: application/json');
include 'create_short_url.php';

?>