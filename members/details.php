<?php 

require_once("../include/connection.php");

session_start();

header("Content-Type: application/json; charset=utf-8");

$userid = $conn->real_escape_string($_GET['id']);

$query = "SELECT * FROM users WHERE id = '{$userid}'";

$result = $conn->query($query);
if(!$result){
        echo json_encode(["status"=> "error", "message"=> "Error retrieving record!!"]);
}
else{
		if($result->num_rows){
    		$user = $result->fetch_assoc();
       	echo json_encode(["status"=>"success", "user"=>$user]);
        exit;
    }
    else {
        echo json_encode(["status"=>"warning", "message"=>"Member with this id does not exist"]);  
        exit;

    }
}


?>

