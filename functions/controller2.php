

<?php


function Registered_User(){
	if (isset($_POST['register'])) {
		require 'connection.php';
		$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
		$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
		$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		$address = mysqli_real_escape_string($db,$_POST['address']);
		$password2 = mysqli_real_escape_string($db,$_POST['password2']);
		$type='User';
		$id=uniqid();


		//Check if password matches

		if($password==$password2){
			//If True Performs Process
			$password = md5($password);
			$result = mysqli_query($db,"INSERT INTO user_tbl (id,first_name,last_name,contact_number,address,password,type) VALUES ('$id','$first_name','$last_name','$contact_number','$address','$password','$type')");

			echo

			'<script>alert("Account Succesfully Registered")</script>;
			';



		}
		else{
			echo"<center><h6 class='txt1'>Password doesn't match</h6></center>";

		}



	}
}



function Login_User(){
	if (isset($_POST['login'])){
		require('connection.php');

		$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		$password = md5($password); 
		$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE contact_number = '$contact_number' AND password = '$password'");

		if(mysqli_num_rows($result) > 0){
			$resultname= mysqli_query($db,"SELECT * FROM user_tbl WHERE contact_number = '$contact_number' ");
			while ($row = mysqli_fetch_assoc($resultname)) {
				$name=$row['first_name'];
				$type=$row['type'];
				$id=$row['id'];

				session_start();  
				$_SESSION['username'] = $name;
				$_SESSION['type'] = $type;
				$_SESSION['id'] = $id;

				if($type=='User'){


					header("location:./Client/client.php");
				}
				else if($type=='Administrator'){
					header("location:./Admin/admin.php");
				}  
			}  

		}
		else{
			echo"<center><h6 class='txt1'>Invalid Credentials</h6></center>";


		}

	}
}

?>