<?php
require_once("../../include/connection.php");
session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}

if (!empty($_SESSION['users'])){
    $users = $_SESSION['users'];
    $_SESSION['users'] = null;
}
else {
    $query = $conn->query("SELECT * FROM users");
    $users = $query->fetch_all(MYSQLI_ASSOC); 
}

$membersCount = count($users);

$districts = ['SEKONDI - TAKORADI', 'Ahanta West District, AGONA-NKWANTA', 'Aowin/Suaman District, ENCHI', 'Bia District, ESSAM', 'Bibiani/Anhwiaso/Bekwai District, BIBIANI', 'Ellembelle District, NKROFUL', 'Jomoro District, HALF-ASSIN', 'Juaboso District, JUABOSO', 'Wassa East District, DABOASE', 'Nzema East District, AXIM', 'Prestea-Huni Valley District, BOGOSO', 'Sefwi-Wiawso District, WIAWSO', 'Sefwi Akontombra district, SEFWI AKONTOMBRA', 'Shama District, SHAMA', 'Wasa Amenfi East District, WASSA-AKROPONG', 'Wasa Amenfi West District, ASANKRANGWA', 'TARKWA-Nsuaem', 'Bia West, Adabokrom', 'Bia East ,Essam', 'Wassa Amenfi East “ Amenfi Central', 'Mpohor Wassa “ Mpohor District'];

$genders = ["male", "female", "others"];   

$educationLevels = ["NONE","PRIMARY","JHS","SHS","DIPLOMA","HND","DEGREE","MASTERS","PHD","DOCTORATE","PROFESSOR"];

$ranks = ["school","chapter","metro","region"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Red Cross Society::Users</title>
    <meta name="viewport" content="width=device-width;initial-scale=1;"/>
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/style.css">
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/members.css">
    <link rel='icon' href="/redcross/pic/favicon.ico">
</head>

<body>
    <?php require_once('../../include/header.php') ?>
    <section class="users">
        <form action="/redcross/members/search.php" method="post" class="search-box">
            <input type="text" name="search" placeholder="Search by Name">
            <input type="text" name="userid" placeholder="Search by ID">
            <select id="box" name="status">
                <option value="">Choose Status </option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <select id="box" name="district">
                <option value="">Choose District </option>
                <?php
                    foreach($districts as $district){
                        echo "<option value='$district' ";
                        echo ">$district</option>";
                    }
                ?>
            </select>
            

            <select name="gender" id="gender">
                <option value="">Select Gender</option>
                <?php
                    foreach($genders as $gender){
                        echo "<option value='$gender' ";
                        echo ">".ucfirst($gender)."</option>";
                    }
                ?>
            </select>

            <select name="rank" id="rank" class="rank">
                <option value="">Select Rank</option>
                <?php
                    foreach($ranks as $rank){
                        echo "<option value='$rank' ";
                        echo ">".ucfirst($rank)."</option>";
                    }
                ?>
            </select>

            <select id="certification" name="educationLevel">
                <option value="">Level of Education</option>
                <?php
                    foreach($educationLevels as $level){
                        echo "<option value='$level' ";
                        echo ">$level</option>";
                    }
                ?>
            </select>

            <button type="submit" class="search" id="search" name="SUBMIT">Search</button>
        </form>
        <div class="info">
            <div class="total">
                <h3>Total: <span class="total-members"><?=$membersCount?></span></h3>
            </div>
        </div>
        <div class="users-box">
        <table class="users-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Designation</th>
                    <th>Rank</th>
                    <th>District</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($users as $user){
                    echo "<tr>";
                    echo "<td>".$user['userid']."</td>";
                    echo "<td><img src='/redcross/pictures/".$user['picture']."' class='thumbnail' alt='user pic'></td>";
                    echo "<td>".$user['firstname']." ".$user['lastname']."</td>";
                    echo "<td>".$user['email']."</td>";
                    echo "<td>".$user['phonenumber']."</td>";
                    echo "<td>".$user['designation']."</td>";
                    echo "<td>".$user['rank']."</td>";
                    echo "<td>".$user['district']."</td>";
                    $last = new DateTime($user['last_dues_payment_date']);
                    $now = new DateTime(date('Y-m-d H:i:s'));
                    $interval = $last->diff($now);
                    if ((bool) number_format($interval->format('%Y'), 0)){
                        echo "<td><span class='inactive'>Inactive</span></td>";
                    }
                    else {
                        echo "<td><span class='active'>Active</span></td>";
                    }
                    echo "<td><a href='/redcross/members/update/?userid=".$user['userid']."' class='action action-profile'>Update</a>";
                    echo "<a href='/redcross/members/delete.php?userid=".$user['userid']."' class='action action-delete'>Delete</a>";
                    if ((bool) number_format($interval->format('%Y'), 0)){
                        echo "<br><br><a href='/redcross/members/activate.php?userid=".$user['userid']."' class='action action-activate'>Activate</a></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </section>
</body>
