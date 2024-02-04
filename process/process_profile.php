<?php

    error_reporting(E_ALL);
    session_start();
    require_once('../classes/User.php');
    require_once('../classes/utilities.php');

    if ($_POST) {
        $birthday = $_POST['dob'];
        $gender = $_POST['gender'];
        $weight = sanitizer($_POST['weight']);
        $height = sanitizer($_POST['height']);
        $user_id = $_SESSION['user_online'];

        if (is_nan($weight)) {
            $_SESSION['error_message'] = "Weight must be a number";
            header('location:../editprofile.php');
            exit();
        }

        if (is_nan($height)) {
            $_SESSION['error_message'] = "Height must be a number";
            header('location:../editprofile.php');
            exit();
        }

        $response = $user->update_profile($birthday, $gender, $weight, $height, $user_id);
        if ($response) {
            $_SESSION['success_message'] = "Profile updated successfully";
            header('location:../profile.php');
            exit();
        } else {
            $_SESSION['error_message'] = "An error occured, Please try again";
            header('location:../editprofile.php');
            exit();
        }
        
    } else {
        $_SESSION['error_message'] = "Please update your profile";
        header('location:../editprofile.php');
    }
    

?>