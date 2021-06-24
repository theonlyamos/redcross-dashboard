<?php 

require_once("../include/connection.php");

session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}

$name = $conn->real_escape_string($_POST['name']);
$district = $conn->real_escape_string($_POST['district']);
$rank = $conn->real_escape_string($_POST['rank']);
$gender = $conn->real_escape_string($_POST['gender']);
$educationLevel = $conn->real_escape_string($_POST['educationLevel']);
$userid = $conn->real_escape_string($_POST['userid']);
$status = $conn->real_escape_string($_POST['status']);

$query = "SELECT * FROM users WHERE (LOWER(`firstname`) LIKE LOWER('$name%') OR LOWER(`lastname`) LIKE LOWER('$name%') OR LOWER(`firstname`) LIKE LOWER('%$name') OR LOWER(`lastname`) LIKE LOWER('%$name') OR LOWER(`firstname`) = LOWER('$name') OR LOWER(`lastname`)= LOWER('$name'))";

if (!empty($name) && !empty($district)){
    $query .= " AND `district` = '$district'";
}
else if (empty($name) && !empty($district)){
    $query = "SELECT * FROM users WHERE `district` = '$district'";
}

if (!empty($name) && !empty($rank)){
    $query .= " AND `rank` = '$rank'";
}
else if (empty($name) && !empty($rank)){
    $query = "SELECT * FROM users WHERE `rank` = '$rank'";
}

if (!empty($name) && !empty($gender)){
    $query .= " AND `gender` = '$gender'";
}
else if (empty($name) && !empty($gender)){
    $query = "SELECT * FROM users WHERE `gender` = '$gender'";
}

if (!empty($name) && !empty($educationLevel)){
    $query .= " AND `educationLevel` = '$educationLevel'";
}
else if (empty($name) && !empty($educationLevel)){
    $query = "SELECT * FROM users WHERE `educationLevel` = '$educationLevel'";
}

if (!empty($userid)){
    $query = "SELECT * FROM users WHERE `userid`='$userid'";
}

if (!empty($status)){
    $now = date('Y-m-d H:i:s');
    $date = new DateTime($now);
    $date = $date->sub(new DateInterval('P1Y'));
    $last = $date->format('Y-m-d H:i:s');

    if ($status == 'active'){
        $query = "SELECT * FROM users WHERE `last_dues_payment_date` > '$last'";
    }
    else {
        $query = "SELECT * FROM users WHERE `last_dues_payment_date` < '$last'";
    }
}

$result = $conn->query($query);

if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $_SESSION['users'] = $users;
    header("Location: /redcross/members");
}
else if ($conn->errno){
    echo $conn->error;
}


?>