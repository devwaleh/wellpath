<?php

    error_reporting(E_ALL);
    session_start();
    require_once('../classes/Journal.php');

    if (isset($_POST['edit_journal'])) {

        $img = $_FILES['journal_img'];
        $content = $_POST['journal_content'];
        $id = $_POST['journal_id'];

       if (empty($content)) {
        $_SESSION['error_message'] = "Please add a message";
        header('location:../journal.php');
        exit();
       }
       
        $edit = $journal->edit_journal($content, $img, $id);
  
        if ($edit) {
        $_SESSION['success_message'] = "Journal updated successfully";
        header('location:../journal.php');
        exit();
       } else {
        header('location:../journal.php');
        exit();
       }
       
        
    } else {
        $_SESSION['error_message'] = "Please add journal content";
        header('location:../journal.php');
        exit();
    }
    

?>