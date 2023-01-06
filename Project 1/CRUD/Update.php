<?php
//include db connection
include_once '../session_check.php';
include_once '../dbcontroller.php';
$dbHandler= new DBController();
//get user inputs
$id = mysqli_real_escape_string($dbHandler->connectDB(), $_POST['id']);
if(isset($_POST["product_name"])&&$_POST["product_name"]!==""){
    $product_name=$_POST["product_name"];
    $query = "UPDATE tblproduct SET name= '$product_name' WHERE id='$id'";
    $dbHandler->RunQueryNoRe($query);
}
if(isset($_POST["product_desc"])&&$_POST["product_desc"]!==""){
    $product_desc=$_POST["product_desc"];
    $query = "UPDATE tblproduct SET product_desc= '$product_desc' WHERE id='$id'";
    mysqli_query($dbHandler->connectDB(), $query);
    $dbHandler->RunQueryNoRe($query);
}
if(isset($_POST["image"])&&$_POST["image"]!==""){
    $image=$_POST["image"];
    $query = "UPDATE tblproduct SET image= '$image' WHERE id='$id'";
    $dbHandler->RunQueryNoRe($query);
}

if(isset($_POST["price"])&&$_POST["price"]!==""){
    $price=$_POST["price"];
    $query = "UPDATE tblproduct SET price= '$price' WHERE id='$id'";
    $dbHandler->RunQueryNoRe($query);
}
if(isset($_POST["stock"])&&$_POST["stock"]!==""){
    $stock=$_POST["stock"];
    $query = "UPDATE tblproduct SET stock= '$stock' WHERE id='$id'";
    $dbHandler->RunQueryNoRe($query);
}
?>
<link rel="stylesheet" href="../style.css">
<?php
include_once "../navigation.php";
echo "It is done";