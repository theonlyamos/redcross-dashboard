<?php
    require_once("../include/connection.php");
    session_start();
    
    if (!isset($_SESSION['user'])){
        header("Location: /redcross/login");
        exit;
    }
    
    $result = $conn->query("SELECT districts.id, districts.name, COUNT(users.id) AS members FROM `districts` LEFT OUTER JOIN users ON districts.id = users.district_id GROUP BY districts.name ORDER BY districts.id");
    $districts = $result->fetch_all(MYSQLI_ASSOC);
    $result = $conn->query('SELECT * FROM districts');
    $districtsCount = $result->num_rows;

    $currentPage = 'districts';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRC DASHBOARD</title>
    <link rel="stylesheet" href="/redcross/dashboard/public/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/registration.css">
    <link rel="stylesheet" type="text/css" href="/redcross/dashboard/public/css/all.css">
    <link rel='icon' href="/redcross/pic/favicon.ico">
    <script src="/redcross/dashboard/public/js/jquery-3.3.1.min.js"></script>
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
                <div class="d-flex align-items-center">
                    <i class="fas fa-building fa-4x"></i>
                    <div class="main__greeting ml-2">
                        <h3 class="text-title"><?=$districtsCount?></h3>
                        <p class="text-accent">Districts</p>
                    </div>
                </div>
            </div>
            <div class="main__card d-flex justify-content-center ml-1">
                <div class="card pb-1 px-1 w-90">
                    <div class="d-flex justify-content-end w-100">
                        <a href="#districtModal" class="btn btn-primary ml-1 d-flex align-items-center text-white shadow">
                            <i class="fas fa-plus fa-fw"></i> <span class="fw-700">Add District</span>
                        </a>
                    </div>
                </div>
                <div class="card p-1 table-responsive w-90 overflow-auto">
                    <table class="table table-striped w-100">
                        <thead class="bg-dark text-white">
                            <tr class="text-start">
                                <th class="bg-dark"><input type="checkbox" id="checkAll"/></th>
                                <th class="bg-dark p-1">Name</th>
                                <th class="bg-dark p-1">School Links</th>
                                <th class="bg-dark p-1">Mother's Club</th>
                                <th class="bg-dark p-1">Members</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($districts as $district){
                        ?> 
                            <tr class="ff-monospace" id="row-<?=$district['id']?>">
                                <td class="p-1"><input type="checkbox" id="check-<?=$district['id']?>"/></td>
                                <td class="p-1"><?=ucfirst($district['name'])?></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"><?=$district['members']?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        
    </main>
    <script type="text/jscript">
        function getImage() {
            const picture = document.getElementById("pictureInput");
            picture.click();
        }

        const handleFiles = function(e) {
            const target = e.id;
            const files = e.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.startsWith('image/')) {
                    continue
                }

                const thumbnail = document.getElementById("pictureBox");

                const reader = new FileReader();
                reader.onload = (function(athumbnail) {
                    return function(e) {
                        athumbnail.style.backgroundImage = `url(${e.target.result})`;
                    }
                })(thumbnail);
                reader.readAsDataURL(file);
            }
        }

    </script>
    <script src="/redcross/dashboard/public/js/districts.js"></script>
</body>

</html>
