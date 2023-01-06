<!--login process-->
<?php
session_start();
require_once("dbcontroller.php");

if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
    unset($_SESSION['cart_item']);
}

    //get user inputs
    $dbHandler = new DBController();
    $username = mysqli_real_escape_string($dbHandler->connectDB(), $_POST['username']);
    $password = mysqli_real_escape_string($dbHandler->connectDB(), $_POST['password']);

    if ($username == '' || $password == '')
        echo 'No field can be blank';
    else {
        //find user in db table
        $query = "SELECT * FROM users WHERE USERNAME='$username'";
        $users = $dbHandler->runQuery($query);//execute query and return results into variable
        if (!$users) {
            echo 'no such username';
        } //change returned result into associative array
        elseif ($check = password_verify($password, $users[0]['password'])) {
            session_start();
            $_SESSION['id'] = $username;
            header("LOCATION: index.php");
        } else
            echo 'Incorrect Password';

    }

?>
