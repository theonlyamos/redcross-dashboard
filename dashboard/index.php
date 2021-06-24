<?php
    require_once("../include/connection.php");
    
    session_start();
    
    if (!isset($_SESSION['user'])){
        header("Location: /redcross/login");
        exit;
    }
    

    $query = $conn->query("SELECT * FROM users");
    $users = $query->fetch_all(MYSQLI_ASSOC); 


    $result = $conn->query('SELECT * FROM users');
    $usersCount = $result->num_rows;
    

    $loggedInUser = $_SESSION['user'];

    $currentPage = 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRC DASHBOARD</title>
    <link rel="stylesheet" href="/redcross/dashboard/public/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/redcross/dashboard/public/css/all.css">
    <link rel='icon' href="/redcross/pic/favicon.ico">
</head>

<body>
    <main class="d-flex  h-100 overflow-hidden">
        <?php require_once('../include/sidebar.php'); ?>
        <div class="main__container overflow-y-auto">
            <nav class="navbar card p-2 bg-white d-flex justify-content-between">
                <div class="navbar__left">
                    <a class="text-black menu-icon" href="#menu"><i class="fas fa-bars fa-2x"></i></a>
                </div>
                <div class="navbar__right">
                    <!--
                    <a href="#">
                        <i class="fas fa-search fa-2x"></i>
                    </a>
                    <a href="#">
                        <i class="fas fa-clock fa-2x"></i>
                    </a>
                    <a href="#">
                        <i class="far fa-user-circle fa-2x"></i>
                    </a>
                    -->
                </div>
            </nav>
            <div class="main__title d-flex align-items-center m-2">
                <i class="fas fa-user fa-4x"></i>
                <div class="main__greeting ml-2">
                    <h3 class="text-title">Hello <?=ucfirst($loggedInUser['username'])?></h3>
                    <p class="text-accent">Welcome to your admin dashboard</p>
                </div>
            </div>
            <div class="main__card d-flex">

                <a href="/redcross/members" class="card p-2 m-1 d-flex align-items-center justify-content rounded">
                    <div class="card__header text-center w-65">
                        <i class="fas fa-users fa-2x text-lighblue"></i>
                        <p class="text-primary-p">MEMBERSHIP</p>
                    </div>
                    <div class="card__inner text-center w-35">
                        <span class="font-bold text-title fs-1-75em fw-700">
                            <?=$usersCount?>
                        </span>
                    </div>
                </a>


                <a href="#" class="card  p-2 m-1 d-flex align-items-center justify-content rounded">
                    <div class="card__header text-center w-50">
                        <i class="fas fa-calendar-alt fa-2x text-red"></i>
                        <p class="text-primary-p">NUMBER OF CHAPTER</p>
                    </div>
                    <div class="card__inner text-center w-50">
                        <span class="font-bold text-title fs-1-75em fw-700">700</span>
                    </div>
                </a>

                <a href="#" class="card  p-2 m-1 d-flex align-items-center justify-content rounded">
                    <div class="card__header text-center w-50">
                        <i class="fas fa-video fa-2x text-yellow"></i>
                        <p class="text-primary-p">NUMBER OF SCHOOL LINK</p>
                    </div>
                    <div class="card__inner text-center w-50">
                        <span class="font-bold text-title fs-1-75em fw-700">600</span>
                    </div>
                </a>

                <a href="#" class="card  p-2 m-1 d-flex align-items-center justify-content rounded">
                    <div class="card__header text-center w-50">
                        <i class="fa fa-thumbs-up fa-2x text-green"></i>
                        <p class="text-primary-p">NUMBER OF MOTHERS</p>
                    </div>
                    <div class="card__inner text-center w-50">
                        <span class="font-bold text-title fs-1-75em fw-700">2000</span>
                    </div>
                </a>

            </div>
        </div>
        
        <!-- Type here -->
        
    </main>
</body>

</html>
