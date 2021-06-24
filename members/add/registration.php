<?php 

require_once("../../include/connection.php"); 
session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}


if(isset($_POST['SUBMIT'])){

$userid = $conn->real_escape_string($_POST['userid']);
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$email = $conn->real_escape_string($_POST['email']);
$designation = $conn->real_escape_string($_POST['designation']);
$residence = $conn->real_escape_string($_POST['residence']);
$phonenumber = $conn->real_escape_string($_POST['phonenumber']);
$gender = $conn->real_escape_string($_POST['gender']);
$district_id = $conn->real_escape_string($_POST['district_id']);
$rank = $conn->real_escape_string($_POST['rank']);
$educationLevel = $conn->real_escape_string($_POST['educationLevel']);
$picture = null;
$time = time();
$target_dir = "../../pictures/";
$target_file = $target_dir.$time. basename($_FILES["picture"]["name"]);

$uploadOk = 1;

if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    $picture = $time.basename( $_FILES["picture"]["name"]);
}

$now = date('Y-m-d H:i:s');
$date = new DateTime($now);
$date = $date->sub(new DateInterval('P1Y'));
$last = $date->format('Y-m-d H:i:s');
    
$query = "INSERT INTO users(userid,firstname,lastname,email,designation,residence,phonenumber,gender,district_id,educationLevel,rank,last_dues_payment_date,picture)
  values('$userid','$firstname','$lastname','$email','$designation','$residence','$phonenumber','$gender','$district_id','$educationLevel','$rank','$last', '$picture')";
		  
		    
$result = $conn->query( $query);
    
if($result){
    header("Location: /redcross/members");
    
}	
else{
    $_SESSION['error'] = true;
    $_SESSION['error_message'] = $conn->error;
    header('Location: /redcross/members');
}
	

}

?>
