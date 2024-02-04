<?php

    if(!isset($_SESSION['user_online'])){
        $_SESSION['user_feedback'] = "You must be logged in to access this page.";
        header('location:login.php');
        exit();
    }

?>