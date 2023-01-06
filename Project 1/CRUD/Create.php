<?php
//include db connection
include_once '../session_check.php';
include_once '../dbcontroller.php';

$dbHandler = new DBController();

//get user inputs
$product_name = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["product_name"]);
$product_desc = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["product_desc"]);
$img = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["image"]);
$price = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["price"]);
$stock = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["stock"]);
$code = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["code"]);
    //add product to db table query
    $query = "INSERT INTO tblproduct(stock, name, product_desc, image,price, code) values('$stock','$product_name','$product_desc','$img','$price','$code')";

    if(mysqli_query($dbHandler->connectDB(),$query))
        echo 'Registration Successful';
    else
        echo 'Registration Failed';