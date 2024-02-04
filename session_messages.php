<?php

    error_reporting(E_ALL);

    if(isset($_SESSION['success_message'])){
        echo "<div class='alert alert-success'>".$_SESSION['success_message']."</div>";
        unset($_SESSION['success_message']);
    }

    if(isset($_SESSION['error_message'])){
        echo "<div class='alert alert-danger'>".$_SESSION['error_message']."</div>";
        unset($_SESSION['error_message']);
    }

    if(isset($_SESSION['user_feedback'])){
        echo "<div class='alert alert-info'>". $_SESSION['user_feedback']. "</div>";
        unset($_SESSION['user_feedback']);
    }

?>