<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('classes/User.php');

    $user->logout();

    header('location:index.php');

?>