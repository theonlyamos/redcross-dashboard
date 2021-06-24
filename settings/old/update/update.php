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
$district = $conn->real_escape_string($_POST['district']);
$rank = $conn->real_escape_string($_POST['rank']);
$educationLevel = $conn->real_escape_string($_POST['educationLevel']);
$picture = null;
$time = time();
$target_dir = "../../pictures/";
$target_file = $target_dir.$time . basename($_FILES["picture"]["name"]);

$uploadOk = 1;

if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    $picture = $time.basename( $_FILES["picture"]["name"]);
}

$query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', designation='$designation', residence='$residence',
          phonenumber='$phonenumber', gender='$gender', district='$district', educationLevel='$educationLevel', rank='$rank'";

if ($picture !== null){
    $query .= ", picture='$picture'";
}
    
$query .= " WHERE userid='$userid'";
    
$result = $conn->query( $query);
    
if($result){
    header("Location: /redcross/members");
    
}	
else{
    $_SESSION['error'] = true;
    
    header("Location: /redcross/members");
}
	

}

?>
