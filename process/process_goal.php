<?php

error_reporting(E_ALL);
session_start();
require_once('../classes/Goal.php');
require_once('../classes/utilities.php');

if (isset($_POST['add_goal'])) {
    $cat = $_POST['cat_name'];
    $target = sanitizer($_POST['goal_target']);
    $user_id = $_SESSION['user_online'];

    if (empty($cat)) {
        $_SESSION['error_message'] = "Please select a category";
        header('location:../dashboard.php');
        exit();
    }

    if (empty($target)) {
        $_SESSION['error_message'] = "Please add a target";
        header('location:../dashboard.php');
        exit();
    }

    $add = $goal->add_goal($user_id, $target, $cat);

    if ($add) {
        $_SESSION['success_message'] = "Goal added successfully";
        header('location:../dashboard.php');
        exit();
    } else {
        $_SESSION['error_message'] = "Operation failed, please try again";
        header('location:../dashboard.php');
        exit();
    }
    
} else {
    header('location:../dashboard.php');
    exit();
}

?>