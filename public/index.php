<?php
session_start();

require "../app/core/init.php";
$url = $_GET['url'] ?? 'home';
$url = strtolower($url);
$url = explode('/', $url);
$page_name = trim($url[0]);
$file_name = "../app/pages/".$page_name.".php";

$PAGE = get_pagination_vars();

if (file_exists($file_name)) {
    require_once $file_name;
}else{
    require_once "../app/pages/erro.php";
}

// echo"<pre>";
// echo $file_name;

// print_r($url);

// echo"homePage";

?>
