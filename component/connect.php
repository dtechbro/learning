<?php
$db_name = 'mysql:host=localhost;dbname=portal';
$user_name = 'root';
$user_password = '';
$conn = new PDO($db_name, $user_name, $user_password);

if(!$conn) {
    echo "Connection Failed!";
}
?>