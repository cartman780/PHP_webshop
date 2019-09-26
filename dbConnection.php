<?php
	//Database connection
	function connectToDB(){
		$servername = "localhost";
		$username = "root";
		$password = "Q1w2e3r4";
		$dbname = "demo";
		
		//Create connection
		$conn = @mysqli_connect($servername, $username, $password, $dbname);
		
		//Test connection
		if(!$conn){
			throw new exception("Connection failed!: " . mysqli_connect_error()); 
		}
//echo "Connected succesfully";
		return $conn;
	}
		
	/*
	function findUserByEmail($email){
		//Select from table
		$sql = "SELECT user_id, email, name, password";
		$result = mysqli_query($conn, $sql);
		
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()){
				echo "id: ".$row["user_id"]. " - email: ".$row["email"]. " - name: ".$row["name"]. " - password: ".$row["password"]."<br>";
			}else{
				echo "0 results";
			}
		}
		$conn->close();
	*/
?>