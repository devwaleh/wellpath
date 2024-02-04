<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('classes/Goal.php');

    $goal_id = $_GET['goal_id'];

    $delete = $goal->delete_goal($goal_id);

    if ($delete) {
        $_SESSION['success_message'] = "Goal deleted successfully";
        header('location:dashboard.php');
        exit();
    } else {
        $_SESSION['error_message'] = "An error occurred. Please try again";
        header('location:dashboard.php');
        exit();
    }
    

?>