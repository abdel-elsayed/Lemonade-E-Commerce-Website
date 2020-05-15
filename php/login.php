<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require("config.php");

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);

		$stmt = $conn->prepare("SELECT username, password FROM users WHERE username=? AND password=? LIMIT 1");
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$stmt->bind_result($username, $password);
		$stmt->store_result();
		if($stmt->num_rows >0)  //To check if the row exists
		{
			if($stmt->fetch()) //fetching the contents of the row
			{	
				$sql = "SELECT user_id FROM users WHERE username = '" . $username . "'"; // to get the Id of the user to use it later throughout the session
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("s", $username );
				$stmt->execute();
				$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
				if($result){
					foreach($result as $row){
							$_SESSION['userId']= $row['user_id'];
						}
					$_SESSION['username']=$username;
					$_SESSION['source']="login"; 
					header("Location:profile.php"); // head to profile
					exit();	
				}
			}
		}
		else {
			header("Location:loginIndex.php?error=invalidCredentials");
			exit();	
		}
		$stmt->close();
}
else{
	header("Location:loginIndex.php?error=LoginFirst");
			exit();	
}
?>