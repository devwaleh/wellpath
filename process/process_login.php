<?php

error_reporting(E_ALL);
session_start();
require_once('../classes/User.php');
require_once('../classes/utilities.php');

if ($_POST) {
    $email = sanitizer($_POST['mail']);
    $password = $_POST['pass'];
    
    $result = $user->login($email,$password);

    if ($result) {
        print_r($result);
        $_SESSION['user_online'] = $result['user_id'];
        header('location:../dashboard.php');
        exit();
    }else{
        $_SESSION['error_message'] = "Incorrect email or password";
        header('location:../login.php');
        exit();
    }

    
} else {
    $_SESSION['error_message'] = "Please login to continue";
    header('location:../login.php');
    exit();
}

?>