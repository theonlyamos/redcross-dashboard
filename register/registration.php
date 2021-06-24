<?php 

require_once("../include/connection.php"); 

if(isset($_POST['SUBMIT'])){

$userid = $conn->real_escape_string($_POST['userid']);
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$email = $conn->real_escape_string($_POST['email']);
$designation = $conn->real_escape_string($_POST['designation']);
$residence = $conn->real_escape_string($_POST['residence']);
$phonenumber = $conn->real_escape_string($_POST['phonenumber']);
$gender = $conn->real_escape_string($_POST['gender']);
$district = $conn->real_escape_string($_POST['district']);
$rank = $conn->real_escape_string($_POST['rank']);
$educationLevel = $conn->real_escape_string($_POST['educationLevel']);
$picture = null;
$time = time();
$target_dir = "../pictures/";
$target_file = $target_dir.$time.basename($_FILES["picture"]["name"]);

$uploadOk = 1;

if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    $picture = $time.basename( $_FILES["picture"]["name"]);
}

$now = date('Y-m-d H:i:s');
$date = new DateTime($now);
$date = $date->sub(new DateInterval('P1Y'));
$last = $date->format('Y-m-d H:i:s');
    
$query = "INSERT INTO users(userid,firstname,lastname,email,designation,residence,phonenumber,gender,district,educationLevel,rank,last_dues_payment_date,picture)
  values('$userid','$firstname','$lastname','$email','$designation','$residence','$phonenumber','$gender','$district','$educationLevel','$rank','$last', '$picture')";
		  
		    
$result = $conn->query( $query);
    
if($result){
    header("Location: /red/");
    
}	
else{
    $_SESSION['error'] = true;
    $_SESSION['error_message'] = $conn->error;
    header('Location: /red/register');
}
	

}

?>
