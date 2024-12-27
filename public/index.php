<?php
session_start();

require "../app/core/init.php";
// lấy tham số từ get['url'], nếu không có gán bằng home    
$url = $_GET['url'] ?? 'home';

// chuyển url thành chữ thường
$url = strtolower($url);
// tách chuỗi url thành 1 mảng, quy tắc tách khi gặp dấu /
$url = explode('/', $url);
// print_r($url);

// lấy phần tử đầu tiên trong mảng, bỏ khoảng trắng 2 đầu
$page_name = trim($url[0]);
// tạo đường dẫn đến tệp tương ứng
$file_name = "../app/pages/".$page_name.".php";

// biến page dùng để xác định trang hiện tại, trang tiếp theo, trang trước đó và trang đầu tiên
$PAGE = get_pagination_vars();

// nếu tệp tồn tại thì nhúng tệp, nếu không thì nhúng báo lỗi
if (file_exists($file_name)) {
    require_once $file_name;
}else{
    require_once "../app/pages/erro.php";
}

?>
