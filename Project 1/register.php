<!--registration process-->
<?php
    //include db connection
    require_once 'dbcontroller.php';
    $dbHandler = new DBController();
    //get user inputs
    $username = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["username"]);
    $email = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["email"]);
    $password = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["password"]);
    $cpassword = mysqli_real_escape_string($dbHandler->connectDB(), $_POST["cpassword"]);

    if($username == '' || $email == '' || $password == '' || $cpassword == '')
        echo 'No field can be blank';
    //check passwords
    else if($password != $cpassword)
        echo "Passwords do not match";
    else{
        //hash password
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(USERNAME, EMAIL, PASSWORD) values('$username','$email','$password')";
        $dbHandler->insertUser($dbHandler,$query);
    }
