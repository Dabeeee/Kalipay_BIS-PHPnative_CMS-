<?php






require ('../vendor/autoload.php');


use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
//****************************************************************************************************************************
//													LOGIN FUNCTIONS
//*****************************************************************************************************************************

function Register_User(){
	if (isset($_POST['register'])) {
		require 'connection.php';
		$first_name = mysqli_real_escape_string($db,	);
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

				session_start();  
				$_SESSION['username'] = $name;
				$_SESSION['type'] = $type;
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






//****************************************************************************************************************************

//														ADMIN FUNCTIONS
//*****************************************************************************************************************************

function UserTable(){

	require 'connection.php';

	$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE type ='User'" );
	while ($row = mysqli_fetch_assoc($result)) {

		$id=$row['id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$contact_number=$row['contact_number'];


		echo '

		<tr>
		<td>'.$id.'</td>
		<td>'.$first_name.'</td>
		<td>'.$last_name.'</td>
		<td>'.$contact_number.'</td>
		
		<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete'.$id.'">
		<i class="fa fa-trash-o"></i>
		</button>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-edit'.$id.'">
		<i class="fa fa-edit"></td>
		</tr>



		<div class="modal modal-danger fade" id="modal-delete'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">DELETE USER</h4>
		</div>
		<div class="modal-body">
		<form role="form" method="POST">
		<input type="hidden" name="delete_id" value="'.$id.'">
		<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
		<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
		</div>
		</form>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->




		<div class="modal modal-success fade" id="modal-edit'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">EDIT USER</h4>
		</div>
		<div class="modal-body">
		<div class="box-body">
		<form role="form" method="POST">
		<input type="hidden" name="edit_id" value="'.$id.'">
		<div class="form-group">

		<label for="exampleInputEmail1">First Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" value="'.$first_name.'" required name="first_name">
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Last Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" value="'.$last_name.'" required name="last_name">
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Contact Number</label>
		<input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="'.$contact_number.'" required name="contact_number">
		</div>

		
		</div>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-outline" name="edit_submit">Save changes</button>
		</div>
		</form>
		</div>

		</div>

		</div>
		<!-- /.modal -->





		';
		if (isset($_POST['edit_submit'])){
			require 'connection.php';
			$edit_id = $_POST['edit_id'];
			$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
			$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);



			$edit_result = mysqli_query($db,"UPDATE user_tbl SET first_name ='$first_name', last_name ='$last_name', contact_number ='$contact_number'  WHERE id ='$edit_id' ");
			if($edit_result){

				echo

				'<script>alert("User Information Succesfully Updated")</script>;
				';


				echo '<script>window.location.href="user_account.php"</script>';
			}
			else{
				echo

				'<script>alert("User Information Update Failed")</script>;
				';

			}

		}



		if (isset($_POST['delete_submit'])) {
			$delete_id = $_POST['delete_id'];
			$del_result = mysqli_query($db,"DELETE FROM user_tbl WHERE id ='$delete_id'");
			if($del_result){
				echo

				'<script>alert("User Information Succesfully Deleted")</script>;
				';

				echo '<script>window.location.href="user_account.php"</script>';  

			} 
			else{
				echo

				'<script>alert("User Information Delete Failed")</script>;
				';

			}
		}




	}	



}



function AdminTable(){

	require 'connection.php';

	$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE type ='Administrator'" );
	while ($row = mysqli_fetch_assoc($result)) {

		$id=$row['id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$contact_number=$row['contact_number'];


		echo '

		<tr>
		<td>'.$id.'</td>
		<td>'.$first_name.'</td>
		<td>'.$last_name.'</td>
		<td>'.$contact_number.'</td>
		
		<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete'.$id.'">
		<i class="fa fa-trash-o"></i>
		</button>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-edit'.$id.'">
		<i class="fa fa-edit"></td>
		</tr>



		<div class="modal modal-danger fade" id="modal-delete'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">DELETE USER</h4>
		</div>
		<div class="modal-body">
		<form role="form" method="POST">
		<input type="hidden" name="delete_id" value="'.$id.'">
		<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
		<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
		</div>
		</form>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->




		<div class="modal modal-success fade" id="modal-edit'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">EDIT USER</h4>
		</div>
		<div class="modal-body">
		<div class="box-body">
		<form role="form" method="POST">
		<input type="hidden" name="edit_id" value="'.$id.'">
		<div class="form-group">

		<label for="exampleInputEmail1">First Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" value="'.$first_name.'" required name="first_name">
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Last Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" value="'.$last_name.'" required name="last_name">
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Contact Number</label>
		<input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="'.$contact_number.'" required name="contact_number">
		</div>

		
		</div>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-outline" name="edit_submit">Save changes</button>
		</div>
		</form>
		</div>

		</div>

		</div>
		<!-- /.modal -->





		';
		if (isset($_POST['edit_submit'])){
			require 'connection.php';
			$edit_id = $_POST['edit_id'];
			$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
			$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);



			$edit_result = mysqli_query($db,"UPDATE user_tbl SET first_name ='$first_name', last_name ='$last_name', contact_number ='$contact_number'  WHERE id ='$edit_id' ");
			if($edit_result){

				echo

				'<script>alert("User Information Succesfully Updated")</script>;
				';


				echo '<script>window.location.href="admin_account.php"</script>';
			}
			else{
				echo

				'<script>alert("User Information Update Failed")</script>;
				';

			}

		}



		if (isset($_POST['delete_submit'])) {
			$delete_id = $_POST['delete_id'];
			$del_result = mysqli_query($db,"DELETE FROM user_tbl WHERE id ='$delete_id'");
			if($del_result){
				echo

				'<script>alert("User Information Succesfully Deleted")</script>;
				';

				echo '<script>window.location.href=""admin_account.php"</script>';  

			} 
			else{
				echo

				'<script>alert("User Information Delete Failed")</script>;
				';

			}
		}




	}	



}


function Add_User(){
	if (isset($_POST['add_user'])) {
		require 'connection.php';
		$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
		$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
		$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);
		$address== mysqli_real_escape_string($db,$_POST['address']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		$password2 = mysqli_real_escape_string($db,$_POST['password2']);
		$type='User';
		$id=uniqid();


		//Check if password matches
		$result1 = mysqli_query($db,"SELECT * FROM user_tbl WHERE contact_number='$contact_number' ");
		if(mysqli_num_rows($result1) > 0){
			echo

			'<script>alert("User Already Exist")</script>;
			';


		}
		else if($password==$password2){
			//If True Performs Process
			$password = md5($password);
			$result = mysqli_query($db,"INSERT INTO user_tbl (id,first_name,last_name,contact_number,address,password,type) VALUES ('$id','$first_name','$last_name','$contact_number','$address','$password','$type')");

			if($result){
				echo

				'<script>alert("Succefully Added")</script>;
				';
				echo '<script>window.location.href="user_account.php"</script>';
			}
			else{
				echo

				'<script>alert("Not Succefully Added")</script>';
			}


		}
		else{
			echo

			'<script>alert("Password Doesnt Match ")</script>;
			';
		}



	}
}





function Add_Admin(){
	if (isset($_POST['add_admin'])) {
		require 'connection.php';
		$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
		$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
		$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);
		$address== mysqli_real_escape_string($db,$_POST['address']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		$password2 = mysqli_real_escape_string($db,$_POST['password2']);
		$type='Administrator';
		$id=uniqid();

		//Check if password matches
		$result1 = mysqli_query($db,"SELECT * FROM user_tbl WHERE email='$email' ");
		if(mysqli_num_rows($result1) > 0){
			echo

			'<script>alert("User Already Exist")</script>;
			';


		}
		else if($password==$password2){
			//If True Performs Process
			$password = md5($password);
			$result = mysqli_query($db,"INSERT INTO user_tbl (id,first_name,last_name,contact_number,address,password,type) VALUES ('$id','$first_name','$last_name','$contact_number','$address','$password','$type')");

			echo

			'<script>alert("Succefully Added")</script>;
			';
			echo '<script>window.location.href="admin_account.php"</script>';


		}
		else{
			echo

			'<script>alert("Password Doesnt Match ")</script>;
			';
		}



	}
}





function Patient_tbl(){

	require 'connection.php';

	$result = mysqli_query($db,"SELECT * FROM patient_list ");
	while ($row = mysqli_fetch_assoc($result)) {

		$id=$row['user_id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$contact_number=$row['contact_number'];
		
		echo '
		<tr>
		<td>'.$id.'</td>
		<td>'.$first_name.'</td>
		<td>'.$last_name.'</td>
		<td>'.$contact_number.'</td>
		

		
		<td> <a href="prenatal.php?id='.$id.'"  name="prenatal_submit" class="btn btn-warning" data-toggle="modal" >
		PRENATAL RECORD
		</a>
		<a class="btn btn-success"  href="maternity.php?id='.$id.'"  	   name="maternity_submit" data-toggle="modal" >
		MATERNITY RECORD
		</a>
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete'.$id.'">
		DELETE RECORD
		</button></td>
		</tr>

		

		';



		



	}

}


function DisplayUser(){
	require 'connection.php';
		
		$id = $_SESSION['id'];
		$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$first_name=$row['first_name'];
			$last_name=$row['last_name'];
			$contact_number=$row['contact_number'];
			$address=$row['address'];
			echo '
			<div class="col-md-6">
			<!-- /.box -->

			<div class="box-body">
			<div class="form-group">
			<label for="exampleInputEmail1">First Name</label>	
			<input type="email" class="form-control" id="exampleInputEmail1" value="'.$first_name.'" >
			</div>

			<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
			<input type="email" class="form-control" id="exampleInputEmail1" value="'.$address.'">
			</div>




			</div>
			<!-- /.box-body -->



			</div>



			<div class="box-body">
			<div class="col-md-6">




			<div class="form-group">
			<label for="exampleInputEmail1">Last Name</label>
			<input type="email" class="form-control" id="exampleInputEmail1" value="'.$last_name.'" >
			</div>



			<div class="form-group">
			<label for="exampleInputEmail1">Contact Number</label>
			<input type="number" class="form-control" id="exampleInputEmail1" value="'.$contact_number.'">
			</div>
			<form method="POST" action="prenatal_report.php">
			<input type="hidden" name="id" value="'.$id.'">
			<button type="submit" class="btn btn-info pull-right" name="generate_prenatal" >
			&nbsp GENERATE REPORT
			</button>
			</form>



			<div class="modal modal-warning fade" id="modal-addtest">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE TESTS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="user_id" value="'.$id.'">
			<div class="form-group">
			<label for="exampleInputEmail1">Test Name</label>
			<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Test Name" name="test_name" required>
			</div>
			<div class="form-group">
			<label >Test Results</label>
			<textarea class="form-control" rows="3" placeholder="Enter ..." name="results"></textarea>
			</div>

			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker" name="date_taken">
			</div>
			<!-- /.input group -->
			</div>



			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="add_test">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->








			<div class="modal modal-warning fade" id="modal-addmeeting">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE CHECKUPS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="user_id" value="'.$id.'">


			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker1" name="date_taken">
			</div>
			<!-- /.input group -->
			</div>



			<div class="form-group">
			<label >Remarks</label>
			<textarea class="form-control" rows="3" placeholder="Enter ..." name="remarks"></textarea>
			</div>

			<div class="form-group">
			<label for="exampleInputEmail1">Issued Medicine</label>
			<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Test Name" name="issued_medicine" required>
			</div>






			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="add_meeting">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->

			'
			;
		}
	}




function AddTest(){
	if (isset($_POST['add_test'])) {
		require 'connection.php';
		$user_id = mysqli_real_escape_string($db,$_POST['user_id']);
		$test_name = mysqli_real_escape_string($db,$_POST['test_name']);
		$results = mysqli_real_escape_string($db,$_POST['results']);
		$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);


		$result = mysqli_query($db,"INSERT INTO prenatal_test (user_id,test_name,results,date_taken) VALUES ('$user_id','$test_name','$results','$date_taken')");

		if($result){
			echo

			'<script>alert("Succefully Added")</script>';
			
			echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
		}
		
		else{

			echo

			'<script>alert("Test Not Succefully Added")</script>';
		}




	}

}




function AddMeeting(){
	if (isset($_POST['add_meeting'])) {
		require 'connection.php';
		$user_id = mysqli_real_escape_string($db,$_POST['user_id']);
		$remarks = mysqli_real_escape_string($db,$_POST['remarks']);
		$issued_medicine = mysqli_real_escape_string($db,$_POST['issued_medicine']);
		$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);


		$result = mysqli_query($db,"INSERT INTO prenatal_checkup (user_id,date_taken,remarks,issued_medicine) VALUES ('$user_id','$date_taken','$remarks','$issued_medicine')");

		if($result){
			echo

			'<script>alert("Succefully Added")</script>';
			
			echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';

		}
		else{

			echo

			'<script>alert("Test Not Succefully Added")</script>';
		}




	}

}


function DisplayTests(){
	require 'connection.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$result = mysqli_query($db,"SELECT * FROM prenatal_test WHERE user_id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$user_id=$row['user_id'];
			$test_name=$row['test_name'];
			$results=$row['results'];
			$date_taken=$row['date_taken'];
			
			echo '

			<tr>
			
			<td>'.$test_name.'</td>
			<td>'.$results.'</td>
			<td>'.$date_taken.'</td>

			<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-deletetest'.$id.'">
			<i class="fa fa-trash-o"></i>
			</button>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-edittest'.$id.'">
			<i class="fa fa-edit"></td>
			</tr>


			<div class="modal modal-warning fade" id="modal-edittest'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE TESTS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="edit_id" value="'.$id.'">
			<div class="form-group">
			<label for="exampleInputEmail1">Test Name</label>
			<input type="text" class="form-control" id="exampleInputEmail1"name="test_name" required value="'.$test_name.'">
			</div>
			<div class="form-group">
			<label >Test Results</label>
			<textarea class="form-control" rows="3"name="results">'.$results.'</textarea>
			</div>

			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker2" name="date_taken" value="'.$date_taken.'">
			</div>
			<!-- /.input group -->
			</div>



			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="edit_test">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->





			<div class="modal modal-danger fade" id="modal-deletetest'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DELETE USER</h4>
			</div>
			<div class="modal-body">
			<form role="form" method="POST">
			<input type="hidden" name="delete_id" value="'.$id.'">
			<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
			<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
			</div>
			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			';


			if (isset($_POST['delete_submit'])) {
				$delete_id = $_POST['delete_id'];
				$del_result = mysqli_query($db,"DELETE FROM prenatal_test WHERE id ='$delete_id'");
				if($del_result){
					echo

					'<script>alert("User Information Succesfully Deleted")</script>;
					';

					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}

				
				else{
					echo

					'<script>alert("User Information Delete Failed")</script>;
					';

				}
			}


			if (isset($_POST['edit_test'])){
				require 'connection.php';
				$edit_id = $_POST['edit_id'];
				$test_name = mysqli_real_escape_string($db,$_POST['test_name']);
				$results = mysqli_real_escape_string($db,$_POST['results']);
				$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);



				$edit_result = mysqli_query($db,"UPDATE prenatal_test SET test_name ='$test_name', results ='$results', date_taken ='$date_taken'  WHERE id ='$edit_id'");
				if($edit_result){

					echo

					'<script>alert("User Information Succesfully Updated")</script>;
					';


					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}
				else{
					echo

					'<script>alert("User Information Update Failed")</script>;
					';

				}

			}


		}


	}
}


function DisplayMeeting(){
	require 'connection.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$result = mysqli_query($db,"SELECT * FROM prenatal_checkup WHERE user_id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$user_id=$row['user_id'];

			$remarks=$row['remarks'];
			$date_taken=$row['date_taken'];
			$issued_medicine=$row['issued_medicine'];
			echo '

			<tr>
			
			<td>'.$date_taken.'</td>
			<td>'.$remarks.'</td>
			<td>'.$issued_medicine.'</td>

			<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-deletemeeting'.$id.'">
			<i class="fa fa-trash-o"></i>
			</button>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editmeeting'.$id.'">
			<i class="fa fa-edit"></td>
			</tr>

			<div class="modal modal-warning fade" id="modal-editmeeting'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE CHECKUPS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="edit_id" value="'.$id.'">


			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker3" name="date_taken" value="'.$date_taken.'">
			</div>
			<!-- /.input group -->
			</div>



			<div class="form-group">
			<label >Remarks</label>
			<textarea class="form-control" rows="3" placeholder="Enter ..." name="remarks">'.$remarks.'</textarea>
			</div>

			<div class="form-group">
			<label for="exampleInputEmail1">Issued Medicine</label>
			<input type="text" class="form-control" id="exampleInputEmail1" value="'.$issued_medicine.'" name="issued_medicine" required>
			</div>






			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="edit_meeting">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->





			<div class="modal modal-danger fade" id="modal-deletemeeting'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DELETE USER</h4>
			</div>
			<div class="modal-body">
			<form role="form" method="POST">
			<input type="hidden" name="delete_id" value="'.$id.'">
			<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
			<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
			</div>
			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			';


			if (isset($_POST['delete_submit'])) {
				$delete_id = $_POST['delete_id'];
				$del_result = mysqli_query($db,"DELETE FROM prenatal_checkup WHERE id ='$delete_id'");
				if($del_result){
					echo

					'<script>alert("User Information Succesfully Deleted")</script>;
					';

					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}

				
				else{
					echo

					'<script>alert("User Information Delete Failed")</script>;
					';

				}
			}


			if (isset($_POST['edit_meeting'])){
				require 'connection.php';
				$edit_id = $_POST['edit_id'];
				$issued_medicine = mysqli_real_escape_string($db,$_POST['issued_medicine']);
				$remarks = mysqli_real_escape_string($db,$_POST['remarks']);
				$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);



				$edit_result = mysqli_query($db,"UPDATE prenatal_checkup SET issued_medicine ='$issued_medicine', remarks ='$remarks', date_taken ='$date_taken'  WHERE id ='$edit_id'");
				if($edit_result){

					echo

					'<script>alert("User Information Succesfully Updated")</script>;
					';


					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}
				else{
					echo

					'<script>alert("User Information Update Failed")</script>;
					';

				}

			}


		}


	}
}
function SENDSMS(){


	if (isset($_POST['smsall'])) {
		


		$message_text = $_POST['message_text'];
		$result = mysqli_query($db,"SELECT * FROM usertbl");
		while ($row = mysqli_fetch_assoc($result)) {
			$contact_num = $row['contact_num'];


                            // Configure client
			$config = Configuration::getDefaultConfiguration();
			$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzNTM5MDcyNywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYwMDA3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.jPas-iqdQxAE6c4B7T4k939tfv8RIjNGv9ozVfJzjBM');
			$apiClient = new ApiClient($config);
			$messageClient = new MessageApi($apiClient);


			$sendMessageRequest = new SendMessageRequest([
				'phoneNumber' => $contact_num,
				'message' => $message_text,
				'deviceId' => 100119,
			]);

			$sendMessages = $messageClient->sendMessages([$sendMessageRequest]);



		}
		if($sendMessages){
			echo '<script>alert("SMS Succesfully Sent")</script>';    

		}
		else{
			echo '<script>alert("SMS NOT Succesfully Sent")</script>';  

		}


	}
}





function DisplayUser1(){
	require 'connection.php';
	
		$id = $_SESSION['id'];
		$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE id ='$id'  ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$first_name=$row['first_name'];
			$last_name=$row['last_name'];
			$contact_number=$row['contact_number'];
			$address=$row['address'];



			echo '
			<div class="col-md-6">
			<!-- /.box -->

			<div class="box-body">
			<div class="form-group">
			<label for="exampleInputEmail1">First Name</label>
			<input type="email" class="form-control" id="exampleInputEmail1" value="'.$first_name.'" >
			</div>

			<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
			<input type="email" class="form-control" id="exampleInputEmail1" value="'.$address.'">
			</div>




			</div>
			<!-- /.box-body -->



			</div>



			<div class="box-body">
			<div class="col-md-6">




			<div class="form-group">
			<label for="exampleInputEmail1">Last Name</label>
			<input type="email" class="form-control" id="exampleInputEmail1" value="'.$last_name.'" >
			</div>



			<div class="form-group">
			<label for="exampleInputEmail1">Contact Number</label>
			<input type="number" class="form-control" id="exampleInputEmail1" value="'.$contact_number.'">
			</div>
			<form method="POST" action="maternity_report.php">
			<input type="hidden" name="id" value="'.$id.'">
			<button type="submit" class="btn btn-info pull-right" name="generate_prenatal" >
			&nbsp GENERATE REPORT
			</button>
			</form>






			<div class="modal modal-warning fade" id="modal-addprogress">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE TESTS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="user_id" value="'.$id.'">

			<div class="form-group">
			<label >Patient Progress</label>
			<textarea class="form-control" rows="3" placeholder="Enter ..." name="progress_notes"></textarea>
			</div>

			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker" name="date_taken">
			</div>
			<!-- /.input group -->
			</div>



			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="add_progress">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->



			';



		}
	}


function DisplayMAternity(){
	require 'connection.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$result = mysqli_query($db,"SELECT * FROM maternity_tbl WHERE user_id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$user_id=$row['user_id'];
			$progress_notes=$row['progress_notes'];
			$date_taken=$row['date_taken'];
			
			echo '

			<tr>
			
			<td>'.$date_taken.'</td>
			<td>'.$progress_notes.'</td>
			

			<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-deletematernity'.$id.'">
			<i class="fa fa-trash-o"></i>
			</button>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editmaternity'.$id.'">
			<i class="fa fa-edit"></td>
			</tr>


			<div class="modal modal-warning fade" id="modal-editmaternity'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE TESTS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="edit_id" value="'.$id.'">
			
			<div class="form-group">
			<label> Patient Recovery Progress</label>
			<textarea class="form-control" rows="3"  name="progress_notes">'.$progress_notes.'</textarea>
			</div>

			
			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker2" name="date_taken" value="'.$date_taken.'">
			</div>
			<!-- /.input group -->
			</div>



			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="edit_maternity">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->





			<div class="modal modal-danger fade" id="modal-deletematernity'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DELETE USER</h4>
			</div>
			<div class="modal-body">
			<form role="form" method="POST">
			<input type="hidden" name="delete_id" value="'.$id.'">
			<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
			<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
			</div>
			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			';


			if (isset($_POST['delete_submit'])) {
				$delete_id = $_POST['delete_id'];
				$del_result = mysqli_query($db,"DELETE FROM maternity_tbl WHERE id ='$delete_id'");
				if($del_result){
					echo

					'<script>alert("User Information Succesfully Deleted")</script>;
					';

					echo '<script>window.location.href="maternity.php?id='.$user_id.'"</script>';
				}

				
				else{
					echo

					'<script>alert("User Information Delete Failed")</script>;
					';

				}
			}


			if (isset($_POST['edit_maternity'])){
				require 'connection.php';
				$edit_id = $_POST['edit_id'];
				$progress_notes = mysqli_real_escape_string($db,$_POST['progress_notes']);

				$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);



				$edit_result = mysqli_query($db,"UPDATE maternity_tbl SET progress_notes ='$progress_notes', date_taken ='$date_taken'  WHERE id ='$edit_id'");
				if($edit_result){

					echo

					'<script>alert("User Information Succesfully Updated")</script>;
					';


					echo '<script>window.location.href="maternity_.php?id='.$user_id.'"</script>';
				}
				else{
					echo

					'<script>alert("User Information Update Failed")</script>;
					';

				}

			}


		}


	}
}




function AddProgress(){
	if (isset($_POST['add_progress'])) {
		require 'connection.php';
		
		$user_id = mysqli_real_escape_string($db,$_POST['user_id']);
		$progress_notes = mysqli_real_escape_string($db,$_POST['progress_notes']);

		$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);


		$result = mysqli_query($db,"INSERT INTO maternity_tbl (user_id,progress_notes,date_taken) VALUES ('$user_id','$progress_notes','$date_taken')");

		if($result){
			echo

			'<script>alert("Succefully Added")</script>';
			
			echo '<script>window.location.href="maternity.php?id='.$user_id.'"</script>';

		}
		else{

			echo

			'<script>alert("Test Not Succefully Added")</script>';
		}




	}

}


function CountUser(){
	require 'connection.php';
	$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE type = 'USER'");
	$rows=mysqli_num_rows($result);
	echo ' <span class="info-box-number">'.$rows.'</span>';

}

function CountAdministrator(){
	require 'connection.php';
	$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE type = 'Administrator'");
	$rows=mysqli_num_rows($result);
	echo ' <span class="info-box-number">'.$rows.'</span>';

}

function CountPatients(){
	require 'connection.php';
	$result = mysqli_query($db,"SELECT * FROM patient_list ");
	$rows=mysqli_num_rows($result);
	echo ' <span class="info-box-number">'.$rows.'</span>';

}

function Personal_tbl(){

	require 'connection.php';

	$id=$_SESSION["id"];
	

	$result = mysqli_query($db,"SELECT * FROM user_tbl WHERE id='$id'");
	while($row = mysqli_fetch_assoc($result)) {

		$id=$row['id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$contact_number=$row['contact_number'];
		$address=$row['address'];
		
		echo '
		<tr>
		<td>'.$id.'</td>
		<td>'.$first_name.'</td>
		<td>'.$last_name.'</td>
		<td>'.$contact_number.'</td>
		

	
		</tr>



		<div class="modal modal-warning fade" id="modal-alertconfirmation'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">REQUEST FORM</h4>
		</div>
		<div class="modal-body">
		<div class="box-body">
		<form role="form" method="post">

		<div class="form-group">
		<label for="exampleInputEmail1">Maiden Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1"  name="maiden_name" required placeholder="Maiden Name" >
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Citizenship</label>
		<input type="text" class="form-control" id="exampleInputEmail1"  name="citizenship_1" required placeholder="Citizenship" >
		</div>

		

		<input type="hidden" name="user_id" value='.$id.'>
		<input type="hidden" name="first_name" value='.$first_name.'>
		<input type="hidden" name="last_name" value='.$last_name.'>
		<input type="hidden" name="contact_number" value='.$contact_number.'>
		<input type="hidden" name="address" value='.$address.'>


		<div class="form-group">
		<label >Birth Date</label>  
		<div class="input-group date">
		<div class="input-group-addon">
		<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="datepicker1" name="birthdate">
		</div>
		<!-- /.input group -->
		</div>
		




		<div class="form-group">
		<label>Highest Educational Attainment</label>
		<select class="form-control " name="high_attain1">

		<option>Primary|Elementary</option>
		<option>Secondary|Highschool</option>
		<option>Tertiary|College</option>
		</select>
		</div>


		<div class="form-group">
		<label>Employed</label>
		<select class="form-control " name="employed1">

		<option>Employed</option>
		<option>Unemployed</option>
		
		
		</select>
		</div>


		
		<div class="form-group">
		<label for="exampleInputEmail1">Partner Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1"  name="partner_name" required placeholder="Partner Name"  >
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Citizenship</label>
		<input type="text" class="form-control" id="exampleInputEmail1"  name="citizenship_2" required placeholder="Citizenship" >
		</div>

		<div class="form-group">
		<label>Highest Educational Attainment</label>
		<select class="form-control " name="high_attain2">

		<option>Primary|Elementary</option>
		<option>Secondary|Highschool</option>
		<option>Tertiary|College</option>
		
		</select>
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">Contact Number</label>
		<input type="number" class="form-control" id="exampleInputEmail1"  name="contact_number2" required placeholder="Weight">
		</div>






		<div class="form-group">
		<label>Employed</label>
		<select class="form-control " name="employed2">

		<option>Employed</option>
		<option>Unemployed</option>
		
		
		</select>
		</div>


		


		<div class="form-group">
		<label >Expected Delivery Date</label>  
		<div class="input-group date">
		<div class="input-group-addon">
		<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="datepicker2" name="expecteddate">
		</div>
		<!-- /.input group -->
		


		</div>

		<div class="form-group">
		<label>Delivery Type</label>
		<select class="form-control " name="delivery_type">

		<option>Normal</option>
		<option>Caesarian</option>
		
		
		</select>
		</div>



		<div class="form-group">
		<label for="exampleInputEmail1">Weight/kg</label>
		<input type="number" class="form-control" id="exampleInputEmail1"  name="weight" required placeholder="Weight">
		</div>




		</div>
		</div>
		<div class="modal-footer">
		<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
		<button  class="btn btn-outline" type="submit" name="alert_submit">Save changes</button>
		</div>

		</form>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		




		'




		;

		if (isset($_POST['alert_submit'])) {
			require 'connection.php';
			$user_id = mysqli_real_escape_string($db,$_POST['user_id']);
			$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
			$address = mysqli_real_escape_string($db,$_POST['address']);
			$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);
			$maiden_name = mysqli_real_escape_string($db,$_POST['maiden_name']);
			$partner_name = mysqli_real_escape_string($db,$_POST['partner_name']);
			$birthdate = mysqli_real_escape_string($db,$_POST['birthdate']);
			$high_attain1 = mysqli_real_escape_string($db,$_POST['high_attain1']);


			$employed1 = mysqli_real_escape_string($db,$_POST['employed1']);
			$employed2 = mysqli_real_escape_string($db,$_POST['employed2']);
			$expecteddate = mysqli_real_escape_string($db,$_POST['expecteddate']);
			$weight = mysqli_real_escape_string($db,$_POST['weight']);
			$contact_number2 = mysqli_real_escape_string($db,$_POST['contact_number2']);
			$high_attain2 = mysqli_real_escape_string($db,$_POST['high_attain2']);
			$citizenship_1 = mysqli_real_escape_string($db,$_POST['citizenship_1']);
			$citizenship_2 = mysqli_real_escape_string($db,$_POST['citizenship_2']);
			$delivery_type = mysqli_real_escape_string($db,$_POST['delivery_type']);







			$resultcheck=mysqli_query($db,"SELECT * FROM request_tbl WHERE user_id='$user_id' ");
			$resultcheck1=mysqli_query($db,"SELECT * FROM patient_list WHERE user_id='$user_id' ");
			$checkrequest=mysqli_num_rows($resultcheck);
			$checkrequest1=mysqli_num_rows($resultcheck1);


			if($checkrequest>0 ){

				echo

				'<script>alert("You Already Sent A Request")</script>';



			}
			else{

				$result1 = mysqli_query($db,"INSERT INTO request_tbl (user_id,first_name,last_name,contact_number,address,maiden_name,partner_name,birthdate,high_attain1,employed1,employed2,expecteddate,weight,contact_number2,high_attain2,citizenship_1,citizenship_2,delivery_type) VALUES ('$user_id','$first_name','$last_name','$contact_number','$address','$maiden_name','$partner_name','$birthdate','$high_attain1','$employed1','$employed2','$expecteddate','$weight','$contact_number2','$high_attain2','$citizenship_1','$citizenship_2','$delivery_type')");

				if($result1){
					echo

					'<script>alert("Request Succesfully Send To Admin")</script>';

					echo '<script>window.location.href="client.php"</script>';

				}
				else{

					echo

					'<script>alert("Request Not Succesfully Submitted")</script>';
				}

			}


		}



		



	}

}




function CountRequest(){
	require 'connection.php';
	$result = mysqli_query($db,"SELECT * FROM request_tbl ");
	$rows=mysqli_num_rows($result);
	echo ' <span class="info-box-number">'.$rows.'</span>';

}



function Request_tbl(){

	require 'connection.php';


	

	$result = mysqli_query($db,"SELECT * FROM request_tbl");
	while ($row = mysqli_fetch_assoc($result)) {

		$id=$row['user_id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$contact_number=$row['contact_number'];
		$address=$row['address'];
		$maiden_name=$row['maiden_name'];
		$birthdate=$row['birthdate'];
		$high_attain1=$row['high_attain1'];
		$employed1=$row['employed1'];
		$employed2=$row['employed2'];
		$expecteddate=$row['expecteddate'];
		$weight=$row['weight'];
		$partner_name=$row['partner_name'];
		$high_attain2=$row['high_attain2'];
		$contact_number2=$row['contact_number2'];
		$citizenship_1=$row['citizenship_1'];
		$citizenship_2=$row['citizenship_2'];
		$delivery_type=$row['delivery_type'];



		
		echo '
		<tr>
		<td>'.$id.'</td>
		<td>'.$first_name.'</td>
		<td>'.$last_name.'</td>
		

		<td>
		<button type="button" class="btn btn-success " data-toggle="modal" data-target="#modal-accept'.$id.'"><i class= "fa fa-check"></i>&nbsp &nbsp Accept Request</button>
		<button type="button" class="btn btn-warning " data-toggle="modal" data-target="#modal-reject'.$id.'"> <i class= "fa fa-times"></i> &nbsp &nbsp Remove Request</button>

		</td>
		</tr>






		<div class="modal modal-success fade" id="modal-accept'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">CONFIRM MESSAGE</h4>
		</div>
		<div class="modal-body">
		<form role="form" method="POST">
		
		<input type="hidden" name="user_id" value="'.$id.'">
		<input type="hidden" name="first_name" value="'.$first_name.'">
		<input type="hidden" name="last_name" value="'.$last_name.'">
		<input type="hidden" name="contact_number" value="'.$contact_number.'">
		<input type="hidden" name="address" value="'.$address.'">
		<input type="hidden" name="maiden_name" value="'.$maiden_name.'">
		<input type="hidden" name="birthdate" value="'.$birthdate.'">
		<input type="hidden" name="high_attain1" value="'.$high_attain1.'">
		<input type="hidden" name="employed1" value="'.$employed1.'">
		<input type="hidden" name="employed2" value="'.$employed2.'">
		<input type="hidden" name="expecteddate" value="'.$expecteddate.'">
		<input type="hidden" name="weight" value="'.$weight.'">
		<input type="hidden" name="partner_name" value="'.$partner_name.'">
		<input type="hidden" name="contact_number2" value="'.$contact_number2.'">
		<input type="hidden" name="high_attain2" value="'.$high_attain2.'">
		<input type="hidden" name="citizenship_1" value="'.$citizenship_1.'">
		<input type="hidden" name="citizenship_2" value="'.$citizenship_2.'">
		<input type="hidden" name="delivery_type" value="'.$delivery_type.'">

		<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Confirm Accept Admission? </h3></p>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn btn-outline pull-left" name="accept_submit">Yes</button>
		<button type="button" class="btn btn-outline" name="" data-dismiss="modal" >	No</button>
		</div>
		
		</form>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		


		<div class="modal modal-warning fade" id="modal-reject'.$id.'">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">CONFIRM MESSAGE</h4>
		</div>
		<div class="modal-body">
		<form role="form" method="POST">
		<input type="hidden" name="delete_id" value="'.$id.'">
		
		<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Confirm Remove Admission? </h3></p>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn btn-outline pull-left" name="alert_submit">Yes</button>
		<button type="button" class="btn btn-outline" name="" data-dismiss="modal" >	No</button>
		</div>
		<input type="hidden" name>
		</form>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		
		


		';




	}
}





function ValidRequest(){
	if (isset($_POST['accept_submit'])) {
		require 'connection.php';
		$user_id = mysqli_real_escape_string($db,$_POST['user_id']);
		$first_name = mysqli_real_escape_string($db,$_POST['first_name']);
		$last_name = mysqli_real_escape_string($db,$_POST['last_name']);
		$address = mysqli_real_escape_string($db,$_POST['address']);
		$contact_number = mysqli_real_escape_string($db,$_POST['contact_number']);



		$maiden_name = mysqli_real_escape_string($db,$_POST['maiden_name']);
		$partner_name = mysqli_real_escape_string($db,$_POST['partner_name']);
		$birthdate = mysqli_real_escape_string($db,$_POST['birthdate']);
		$high_attain1 = mysqli_real_escape_string($db,$_POST['high_attain1']);
		

		$employed1 = mysqli_real_escape_string($db,$_POST['employed1']);
		$employed2 = mysqli_real_escape_string($db,$_POST['employed2']);
		$expecteddate = mysqli_real_escape_string($db,$_POST['expecteddate']);
		$weight = mysqli_real_escape_string($db,$_POST['weight']);



		$contact_number2 = mysqli_real_escape_string($db,$_POST['contact_number2']);
		$high_attain2 = mysqli_real_escape_string($db,$_POST['high_attain2']);
		$citizenship_1 = mysqli_real_escape_string($db,$_POST['citizenship_1']);
		$citizenship_2 = mysqli_real_escape_string($db,$_POST['citizenship_2']);
		$delivery_type = mysqli_real_escape_string($db,$_POST['delivery_type']);



		
		$result1 = mysqli_query($db,"INSERT INTO patient_list (user_id,first_name,last_name,contact_number,address,maiden_name,partner_name,birthdate,high_attain1,employed1,employed2,expecteddate,weight,contact_number2,high_attain2,citizenship_1,citizenship_2,delivery_type) VALUES ('$user_id','$first_name','$last_name','$contact_number','$address','$maiden_name','$partner_name','$birthdate','$high_attain1','$employed1','$employed2','$expecteddate','$weight','$contact_number2','$high_attain2','$citizenship_1','$citizenship_2','$delivery_type')");

		$del_result = mysqli_query($db,"DELETE  FROM request_tbl WHERE user_id ='$user_id'");

		if($result1){
			echo

			'<script>alert("Request Succesfully Send To Admin")</script>';

			echo '<script>window.location.href="admin.php"</script>';


		}
		else{

			echo

			'<script>alert("Request Not Succesfully Submitted")</script>';
		}




	}


}


function DeleteRequest(){
	require('connection.php');

	if (isset($_POST['alert_submit'])) {
		$delete_id = $_POST['delete_id'];
		$del_result = mysqli_query($db,"DELETE FROM request_tbl WHERE user_id ='$delete_id'");
		if($del_result){
			echo

			'<script>alert("User Information Succesfully Deleted")</script>;
			';

			echo '<script>window.location.href="admin.php"</script>';
		}


		else{
			echo

			'<script>alert("User Information Delete Failed")</script>;
			';

		}
	}
}







function DisplayMAternity1(){
	require 'connection.php';
	
		$id = $_SESSION['id'];
		$result = mysqli_query($db,"SELECT * FROM maternity_tbl WHERE user_id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$user_id=$row['user_id'];
			$progress_notes=$row['progress_notes'];
			$date_taken=$row['date_taken'];
			
			echo '

			<tr>
			
			<td>'.$date_taken.'</td>
			<td>'.$progress_notes.'</td>
			

			<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-deletematernity'.$id.'">
			<i class="fa fa-trash-o"></i>
			</button>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editmaternity'.$id.'">
			<i class="fa fa-edit"></td>
			</tr>


			<div class="modal modal-warning fade" id="modal-editmaternity'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE TESTS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="edit_id" value="'.$id.'">
			
			<div class="form-group">
			<label >Remarks</label>
			<textarea class="form-control" rows="3"  name="progress_notes">'.$progress_notes.'</textarea>
			</div>

			
			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker2" name="date_taken" value="'.$date_taken.'">
			</div>
			<!-- /.input group -->
			</div>



			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="edit_maternity">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->





			<div class="modal modal-danger fade" id="modal-deletematernity'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DELETE USER</h4>
			</div>
			<div class="modal-body">
			<form role="form" method="POST">
			<input type="hidden" name="delete_id" value="'.$id.'">
			<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
			<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
			</div>
			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			';


			if (isset($_POST['delete_submit'])) {
				$delete_id = $_POST['delete_id'];
				$del_result = mysqli_query($db,"DELETE FROM maternity_tbl WHERE id ='$delete_id'");
				if($del_result){
					echo

					'<script>alert("User Information Succesfully Deleted")</script>;
					';

					echo '<script>window.location.href="maternity.php?id='.$user_id.'"</script>';
				}

				
				else{
					echo

					'<script>alert("User Information Delete Failed")</script>;
					';

				}
			}


			if (isset($_POST['edit_maternity'])){
				require 'connection.php';
				$edit_id = $_POST['edit_id'];
				$progress_notes = mysqli_real_escape_string($db,$_POST['progress_notes']);

				$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);



				$edit_result = mysqli_query($db,"UPDATE maternity_tbl SET progress_notes ='$progress_notes', date_taken ='$date_taken'  WHERE id ='$edit_id'");
				if($edit_result){

					echo

					'<script>alert("User Information Succesfully Updated")</script>;
					';


					echo '<script>window.location.href="maternity_.php?id='.$user_id.'"</script>';
				}
				else{
					echo

					'<script>alert("User Information Update Failed")</script>;
					';

				}

			}


		}


	}




function DisplayMeeting1(){
	require 'connection.php';
	
		$id = $_SESSION['id'];
		$result = mysqli_query($db,"SELECT * FROM prenatal_checkup WHERE user_id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$user_id=$row['user_id'];

			$remarks=$row['remarks'];
			$date_taken=$row['date_taken'];
			$issued_medicine=$row['issued_medicine'];
			echo '

			<tr>
			
			<td>'.$date_taken.'</td>
			<td>'.$remarks.'</td>
			<td>'.$issued_medicine.'</td>

			
			</tr>

			<div class="modal modal-warning fade" id="modal-editmeeting'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE CHECKUPS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="edit_id" value="'.$id.'">


			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker3" name="date_taken" value="'.$date_taken.'">
			</div>
			<!-- /.input group -->
			</div>



			<div class="form-group">
			<label >Remarks</label>
			<textarea class="form-control" rows="3" placeholder="Enter ..." name="remarks">'.$remarks.'</textarea>
			</div>

			<div class="form-group">
			<label for="exampleInputEmail1">Issued Medicine</label>
			<input type="text" class="form-control" id="exampleInputEmail1" value="'.$issued_medicine.'" name="issued_medicine" required>
			</div>






			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="edit_meeting">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->





			<div class="modal modal-danger fade" id="modal-deletemeeting'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DELETE USER</h4>
			</div>
			<div class="modal-body">
			<form role="form" method="POST">
			<input type="hidden" name="delete_id" value="'.$id.'">
			<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
			<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
			</div>
			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			';


			if (isset($_POST['delete_submit'])) {
				$delete_id = $_POST['delete_id'];
				$del_result = mysqli_query($db,"DELETE FROM prenatal_checkup WHERE id ='$delete_id'");
				if($del_result){
					echo

					'<script>alert("User Information Succesfully Deleted")</script>;
					';

					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}

				
				else{
					echo

					'<script>alert("User Information Delete Failed")</script>;
					';

				}
			}


			if (isset($_POST['edit_meeting'])){
				require 'connection.php';
				$edit_id = $_POST['edit_id'];
				$issued_medicine = mysqli_real_escape_string($db,$_POST['issued_medicine']);
				$remarks = mysqli_real_escape_string($db,$_POST['remarks']);
				$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);



				$edit_result = mysqli_query($db,"UPDATE prenatal_checkup SET issued_medicine ='$issued_medicine', remarks ='$remarks', date_taken ='$date_taken'  WHERE id ='$edit_id'");
				if($edit_result){

					echo

					'<script>alert("User Information Succesfully Updated")</script>;
					';


					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}
				else{
					echo

					'<script>alert("User Information Update Failed")</script>;
					';

				}

			}


		}


	}


function DisplayTests1(){
	require 'connection.php';
	
		$id = $_SESSION['id'];
		$result = mysqli_query($db,"SELECT * FROM prenatal_test WHERE user_id ='$id' ");
		while ($row = mysqli_fetch_assoc($result)) {

			$id=$row['id'];
			$user_id=$row['user_id'];
			$test_name=$row['test_name'];
			$results=$row['results'];
			$date_taken=$row['date_taken'];
			
			echo '

			<tr>
			
			<td>'.$test_name.'</td>
			<td>'.$results.'</td>
			<td>'.$date_taken.'</td>

			
			</tr>


			<div class="modal modal-warning fade" id="modal-edittest'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DONE TESTS</h4>
			</div>
			<div class="modal-body">
			<div class="box-body">
			<form role="form" method="post">
			<input type="hidden" name="edit_id" value="'.$id.'">
			<div class="form-group">
			<label for="exampleInputEmail1">Test Name</label>
			<input type="text" class="form-control" id="exampleInputEmail1"name="test_name" required value="'.$test_name.'">
			</div>
			<div class="form-group">
			<label >Test Results</label>
			<textarea class="form-control" rows="3"name="results">'.$results.'</textarea>
			</div>

			<div class="form-group">
			<label >Date Taken</label>  
			<div class="input-group date">
			<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control pull-right" id="datepicker2" name="date_taken" value="'.$date_taken.'">
			</div>
			<!-- /.input group -->
			</div>



			</div>
			</div>
			<div class="modal-footer">
			<button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			<button  class="btn btn-outline" type="submit" name="edit_test">Save changes</button>
			</div>

			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->





			<div class="modal modal-danger fade" id="modal-deletetest'.$id.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">DELETE USER</h4>
			</div>
			<div class="modal-body">
			<form role="form" method="POST">
			<input type="hidden" name="delete_id" value="'.$id.'">
			<p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-outline pull-left" name="delete_submit">Yes</button>
			<button type="button" class="btn btn-outline" name="delete_submit" data-dismiss="modal" >	No</button>
			</div>
			</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			';


			if (isset($_POST['delete_submit'])) {
				$delete_id = $_POST['delete_id'];
				$del_result = mysqli_query($db,"DELETE FROM prenatal_test WHERE id ='$delete_id'");
				if($del_result){
					echo

					'<script>alert("User Information Succesfully Deleted")</script>;
					';

					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}

				
				else{
					echo

					'<script>alert("User Information Delete Failed")</script>;
					';

				}
			}


			if (isset($_POST['edit_test'])){
				require 'connection.php';
				$edit_id = $_POST['edit_id'];
				$test_name = mysqli_real_escape_string($db,$_POST['test_name']);
				$results = mysqli_real_escape_string($db,$_POST['results']);
				$date_taken = mysqli_real_escape_string($db,$_POST['date_taken']);



				$edit_result = mysqli_query($db,"UPDATE prenatal_test SET test_name ='$test_name', results ='$results', date_taken ='$date_taken'  WHERE id ='$edit_id'");
				if($edit_result){

					echo

					'<script>alert("User Information Succesfully Updated")</script>;
					';


					echo '<script>window.location.href="prenatal.php?id='.$user_id.'"</script>';
				}
				else{
					echo

					'<script>alert("User Information Update Failed")</script>;
					';

				}

			}


		}


	}


?>	