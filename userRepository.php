<?php
	//-----------------------even nog goed includen!!!----------------
	
	function arrayToString($data){
		//return implode(" | ", $data);
		return "'".$data['email']."'".', '."'".$data['name']."'".', '."'".$data['password']."'";
	}
	
	//als input valid is, checken of het overeenkomt met user in de text file.
	function findUserByEmail($email){
		include_once 'dbConnection.php';
		$conn = connectToDB();
		try{
			$sql = "SELECT * FROM users";
			$result = mysqli_query($conn, $sql);
			if($result==false){
				throw new exception("query failed".$sql."from".mysqli_error($conn));
			}
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['email']==$email){
					return $row;
				}
			}
		}
		return null;
		}
		finally{
			$conn->close();
		}
	}
	
	//Add user
	function addUser($data){
		$conn = connectToDB();
		$stringData = arrayToString($data);
//echo $stringData;
		//Insert into table
		$sql = "INSERT INTO users (email, name, password) VALUES ($stringData)";
//$sql = "INSERT INTO users (email, name, password) VALUES ('test@test.test', 'test', 'test')";
		
		//Test if values are added
		if (mysqli_query($conn, $sql) === TRUE){
			$last_id = mysqli_insert_id($conn);
			echo "New record created successfully. Last inserted ID is: " . $last_id;
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
?>