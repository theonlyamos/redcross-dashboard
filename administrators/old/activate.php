<?php 

require_once("../include/connection.php");

session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}

$userid = $conn->real_escape_string($_GET['userid']);

$now = date('Y-m-d H:i:s');

if($conn->query("UPDATE users SET last_dues_payment_date='$now' WHERE userid='$userid'")){
    header('Location: /redcross/members');
}
else {
    echo "Counldn't activate record";
}


?>