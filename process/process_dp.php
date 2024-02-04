<?php

    error_reporting(E_ALL);
    session_start();
    require_once('../classes/User.php');

    if (isset($_POST['upload_btn'])) {
        $dp = $_FILES['dp'];
        $id = $_SESSION['user_online'];

        $my_dp = $user->add_dp($id, $dp);

        if ($my_dp) {
            $_SESSION['success_message'] = "Profile Picture uploaded successfully";
            header('location:../editprofile.php');
        } else {
            header('location:../editprofile.php');
        }
        
    } else {
        $_SESSION['error_message'] = "Please upload profile picture";
        header('location:../editprofile.php');
    }
    

?>