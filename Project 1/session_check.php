<?php

session_start();

if (!$_SESSION['id'])
    header('LOCATION: LoginPage.php');
?>