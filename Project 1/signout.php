<?php
include_once 'session_check.php';
unset($_SESSION['id']);
unset($_SESSION['cart_item']);
header('LOCATION: LoginPage.php');