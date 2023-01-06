<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "test";
	private $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	//Down here is the EVERYTHING function that returns a row.
	function runQuery($query) {

		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (isset($resultset))
            return $resultset;
	}

    //Down here is the EVERYTHING function that doesn't return a row.
    function RunQueryNoRe($query) {

        $result = mysqli_query($this->conn,$query);

        return $result;
    }

    function insertUser($dbHandler,$query){
        if(!mysqli_query($dbHandler->connectDB(),$query))
            echo "failure!";
        else
            header('LOCATION: loginPage.php');
    }
	//count rows, never used it
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>