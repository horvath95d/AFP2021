<?php
Class dbObj{
	var $servername = "";
	var $username = "";
	var $password = "";
	var $dbname = "AFP2021"
	var $conn;

	funciton getConnectionstring(){
		$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		if(mysqli_connect_errno()){
			printf("Connect failed: $s\n", mysql_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}
?>