<?php
include '../component/connect.php';

session_start();
session_unset();
session_destroy();

// it still works //

// if(isset($_GET['logout'])){
//     unset($user_id);
//     session_destroy();
//     header('location:login.php');
//  }


header('location:login.php');

?>