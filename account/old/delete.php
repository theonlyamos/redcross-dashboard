<?php 

require_once("../include/connection.php");

session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}

$userid = $conn->real_escape_string($_GET['userid']);

$query = "SELECT * FROM USERS where userid='$userid'";

$result = $conn->query($query);

if ($result->num_rows){
    $user = $result->fetch_assoc();
    $picture = $user['picture'];
    $filename = realpath("../pictures/".$picture);
    echo $filename;
    unlink($filename);
}

if($conn->query("DELETE FROM users WHERE userid='$userid'")){
    header('Location: /redcross/members');
}
else {
    echo "Counldn't delete record";
}


?>