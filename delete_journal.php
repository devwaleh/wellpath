<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('classes/Journal.php');

    $journal_id = $_GET['journal_id'];

    $delete = $journal->delete_journal($journal_id);

    if ($delete) {
        $_SESSION['success_message'] = "Journal deleted successfully";
        header('location:journal.php');
        exit();
    } else {
        $_SESSION['error_message'] = "An error occurred. Please try again";
        header('location:journal.php');
        exit();
    }
    

?>