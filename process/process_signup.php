<?php

    error_reporting(E_ALL);
    session_start();
    require_once('../classes/User.php');
    require_once('../classes/utilities.php');

    if ($_POST) {
        $username = sanitizer($_POST['user']);
        $email = sanitizer($_POST['mail']);
        $password = $_POST['password'];
        $confirm_password = $_POST['cpassword'];
        
        if (empty($username)) {
            $_SESSION['error_message'] = "Username cannot be empty";
            header('location:../signup.php');
            exit();
        } 
        if (empty($email)) {
            $_SESSION['error_message'] = "Please input email address";
            header('location:../signup.php');
            exit();
        } 
        if (empty($password) || empty($confirm_password)) {
            $_SESSION['error_message'] = "Please choose a password";
            header('location:../signup.php');
            exit();
        }
        if ($password != $confirm_password) {
            $_SESSION['error_message'] = "Password must be the same";
            header('location:../signup.php');
            exit();
        }

        $result = $user->sign_up($username,$email,$password,$confirm_password);

        if ($result) {
            $_SESSION['success_message'] = "Account created successfully please comlete your profile";
            $_SESSION['user_online'] = $result;
            header('location:../editprofile.php');
            exit();
        }else{
            $_SESSION['error_message'] = "An error occured, Please try again";
            header('location:../signup.php');
            exit();
        }

        
    } else {
        $_SESSION['error_message'] = "Please signup to continue";
        header('location:../signup.php');
        exit();
    }
    

?>