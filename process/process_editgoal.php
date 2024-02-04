<?php

error_reporting(E_ALL);
session_start();
require_once('../classes/Goal.php');
require_once('../classes/utilities.php');

if (isset($_POST['edit_goal'])) {
    $new_target = sanitizer($_POST['new_target']);
    $goal_id = $_POST['goal_id'];
    $user_id = $_SESSION['user_online'];

    if (empty($new_target)) {
        $_SESSION['error_message'] = "Please input a record";
        header("location:../goal_detail.php?goal_id=$goal_id");
        exit();
    }

    $updated = $goal->edit_goal($new_target, $goal_id);

    if ($updated) {
        $_SESSION['success_message'] = "Goal edited successfully";
        header("location:../goal_detail.php?goal_id=$goal_id");
        exit();
    } else {
        $_SESSION['error_message'] = "Operation failed. Please try again";
        header("location:../goal_detail.php?goal_id=$goal_id");
        exit();
    }
    
    
} else {
    header("location:../goal_detail.php?goal_id=$goal_id");
    exit();
}

?>