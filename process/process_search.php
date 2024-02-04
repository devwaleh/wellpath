<?php

    error_reporting(E_ALL);
    session_start();
    require_once('../classes/Journal.php');
    require_once('../classes/utilities.php');


    if ($_POST&&isset($_POST['btn_search'])) {
       $content = $_POST['search_journal'];
       if (empty($content)) {
        unset($_SESSION['result']);
        unset($_SESSION['search']);
        header('location:../journal.php');
        exit();
       }
       $content = sanitizer($content);

       $id = $_SESSION['user_online'];

       $searched = $journal->search_journal(strtolower($content),$id);

       if ($searched) {
        $_SESSION['search'] = $content;
        $_SESSION['result'] = $searched;
        header('location:../journal.php');
        exit();
       } else {
        unset($_SESSION['result']);
        unset($_SESSION['search']);
        $_SESSION['error_message'] = "No results found";
        header('location:../journal.php');
        exit();
       }


    } else {
        unset($_SESSION['result']);
        unset($_SESSION['search']);
        $_SESSION['error_message'] = "No results found";
        header('location:../journal.php');
        exit();
    }
    

?>