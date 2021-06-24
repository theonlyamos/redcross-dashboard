<?php 

require_once("../include/connection.php");

session_start();

if(isset($_POST['LOGIN']))

{
	
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$encpassword = MD5($password);


$query = "SELECT id, username FROM admins WHERE username = '{$username}' AND password = '{$encpassword}'";

$result = $conn->query($query);
if(!$result){
	$_SESSION['err_msg'] = "Invalid login credentials";
}
else{
	if($result->num_rows)
	{
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;
        
		header("Location: /redcross/dashboard");
        exit;
	}
	
	else {
        $_SESSION['error'] = true;
        header("Location: /redcross/login");
        exit;
	
	}
}

      }
		

?>

