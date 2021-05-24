<?php
//require_once "connected.php";

$_POST = json_decode(file_get_contents('php://input'), true);
//var_dump($POST); 

//$user = isset($data['user']);
//$kota = isset($data['kota']);
// $endpoint =$_POST['endpoint'];
// $key = $_POST['key'];
// $auth = $_POST['token'];
// $key_len = strlen($key);
// $auth_len = strlen($auth);
// $key = substr($key, 0, ($key_len - 1));     //hapus sama dengan ("=") di akhir string
// $auth = substr($auth, 0, ($auth_len - 2));  //hapus sama dengan ("==") di akhir string
?>