<?php
    require_once("../include/connection.php");
    session_start();
    
    if (!isset($_SESSION['user'])){
        header("Location: /redcross/login");
        exit;
    }
    
    if (!empty($_SESSION['users'])){
        $users = $_SESSION['users'];
    }
    else {
        $query = $conn->query("SELECT * FROM users");
        $users = $query->fetch_all(MYSQLI_ASSOC); 
    }
   
    $OFFSET = 1;
    $LIMIT = 5;

    $sql = "SELECT * FROM users";

    if (isset($_GET['page']) && $_GET['page']){
        if ($_GET['page'] > $OFFSET){
            $PAGENUM = $_GET['page'] - 1;
            $OFFSET = $PAGENUM * $LIMIT;

            $sql .= " limit $OFFSET, $LIMIT";
        }
        else {
            $sql .= " limit $LIMIT";
        }
    }
    else {
        $sql .= " limit $LIMIT";
    }

    $result = $conn->query($sql);
    $users = $result->fetch_all(MYSQLI_ASSOC);

    $result = $conn->query('SELECT * FROM users');
    $usersCount = $result->num_rows;

    $districts = ['SEKONDI - TAKORADI', 'Ahanta West District, AGONA-NKWANTA', 'Aowin/Suaman District, ENCHI', 'Bia District, ESSAM', 'Bibiani/Anhwiaso/Bekwai District, BIBIANI', 'Ellembelle District, NKROFUL', 'Jomoro District, HALF-ASSIN', 'Juaboso District, JUABOSO', 'Wassa East District, DABOASE', 'Nzema East District, AXIM', 'Prestea-Huni Valley District, BOGOSO', 'Sefwi-Wiawso District, WIAWSO', 'Sefwi Akontombra district, SEFWI AKONTOMBRA', 'Shama District, SHAMA', 'Wasa Amenfi East District, WASSA-AKROPONG', 'Wasa Amenfi West District, ASANKRANGWA', 'TARKWA-Nsuaem', 'Bia West, Adabokrom', 'Bia East ,Essam', 'Wassa Amenfi East “ Amenfi Central', 'Mpohor Wassa “ Mpohor District'];

    $genders = ["male", "female", "others"];   

    $educationLevels = ["NONE","PRIMARY","JHS","SHS","DIPLOMA","HND","DEGREE","MASTERS","PHD","DOCTORATE","PROFESSOR"];

    $ranks = ["school","chapter","metro","region"];

    $currentPage = 'account';
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
    <div class="modal w-100" id="userModal">
        <div class="modal-header d-flex justify-content-end p-1">
            <div class="modal-tools">
                <a href="#"><i class="fas fa-times fa-fw text-dark"></i></a>
            </div>
        </div>
        <div class="modal-content w-100 h-100 overflow-y-auto">
            <section class="registration-form">
            <?php 

            if(isset($_SESSION['error']) && $_SESSION['error']) {
                echo "<h5 class='error-message'><b>Error adding record to database</b></h5>";
            }  
        $_SESSION['error'] = false;
        ?>
            <div class="title">
                <h2>REGISTRATION FORM</h2>
            </div>
            <form id="registration" method="post" action="/redcross/account/add/registration.php" enctype="multipart/form-data">

                <div class="left">
                    <input type="text" name="userid" id="userid" placeholder="Enter ID" required class="in-left">

                    <input type="text" name="firstname" id="name" placeholder="Enter first Name" required class="in-left">

                    <input type="text" name="lastname" id="name" placeholder="Enter last Name" required class="in-left">
                </div>

                <div class="picture-box" id="pictureBox">
                    <img src="/redcross/pic/cloud-upload.png" alt="upload icon" onclick="getImage()">
                    <input type="file" name="picture" accept="image/*" style="display:none" id="pictureInput" onchange="handleFiles(this)">
                </div>

                <input type="text" name="email" id="name" placeholder="Enter E-mail" required>
                <input type="text" style="visibility: hidden">

                <input type="text" name="designation" id="name" placeholder="Enter Designation" required>

                <input type="text" name="residence" id="name" placeholder="Enter name of Residence" required>

                <input type="text" name="phonenumber" inputmode="numeric" placeholder="Enter phone number" required>

                <select id="box" name="district" required>
                    <option value="">Choose District </option>
                    <option value="SEKONDI - TAKORADI">SEKONDI - TAKORADI </option>
                    <option value="Ahanta West District, AGONA-NKWANTA">Ahanta West District, AGONA-NKWANTA</option>
                    <option value="Aowin/Suaman District, ENCHI">Aowin/Suaman District, ENCHI</option>
                    <option value="Bia District, ESSAM">Bia District, ESSAM</option>
                    <option value="Bibiani/Anhwiaso/Bekwai District, BIBIANI">Bibiani/Anhwiaso/Bekwai District, BIBIANI</option>
                    <option value="Ellembelle District, NKROFUL">Ellembelle District, NKROFUL</option>
                    <option value="Jomoro District, HALF-ASSIN">Jomoro District, HALF-ASSIN</option>
                    <option value="Juaboso District, JUABOSO">Juaboso District, JUABOSO</option>
                    <option value="Wassa East District, DABOASE">Wassa East District, DABOASE</option>
                    <option value="Nzema East District, AXIM">Nzema East District, AXIM</option>
                    <option value="Prestea-Huni Valley District, BOGOSO">Prestea-Huni Valley District, BOGOSO</option>
                    <option value="Sefwi-Wiawso District, WIAWSO">Sefwi-Wiawso District, WIAWSO</option>
                    <option value="Sefwi Akontombra district, SEFWI AKONTOMBRA">Sefwi Akontombra district, SEFWI AKONTOMBRA</option>
                    <option value="Shama District, SHAMA">Shama District, SHAMA</option>
                    <option value="Wasa Amenfi East District, WASSA-AKROPONG">Wasa Amenfi East District, WASSA-AKROPONG</option>
                    <option value="Wasa Amenfi West District, ASANKRANGWA">Wasa Amenfi West District, ASANKRANGWA</option>
                    <option value="TARKWA-Nsuaem">TARKWA-Nsuaem</option>
                    <option value="Bia – Bia East">Bia East, Adabokrom</option>
                    <option value="Bia – Bia East">Bia West, Essam </option>
                    <option value="Wassa Amenfi East – Amenfi Central">Amenfi Central-Manso</option>
                    <option value="Mpohor Wassa – Mpohor District">Mpohor Wassa – Mpohor District</option>
                </select>

                <select name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>

                <select id="certification" name="educationLevel" required>
                    <option value="">Level of Education</option>
                    <option value="NONE">NONE</option>
                    <option value="PRIMARY">PRIMARY</option>
                    <option value="JHS">JHS</option>
                    <option value="SHS">SHS</option>
                    <option value="DIPLOMA">DIPLOMA</option>
                    <option value="HND">HND</option>
                    <option value="DEGREE">DEGREE</option>
                    <option value="MASTERS">MASTERS</option>
                    <option value="PHD">PHD</option>
                    <option value="DOCTORATE">DOCTORATE</option>
                    <option value="PROFESSOR">PROFESSOR</option>
                </select>


                <select name="rank" id="rank" class="rank" required>
                    <option value="">Select One</option>
                    <option value="school">School Link</option>
                    <option value="chapter">Chapter</option>
                    <option value="metro">Metro</option>
                    <option value="region">Region</option>
                </select>

                <input type="text" style="visibility:hidden">

                <button type="submit" class="submit" id="submit" name="SUBMIT">Submit</button>
            </form>
        </section>
        </div>
    </div>
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
                    <i class="fas fa-users fa-4x"></i>
                    <div class="main__greeting ml-2">
                        <h3 class="text-title"><?=$usersCount?></h3>
                        <p class="text-accent">Members</p>
                    </div>
                </div>
            </div>
            <div class="main__card d-flex justify-content-center ml-1">
                <div class="card pb-2 px-1 w-90 mb-1 search-container" id="searchContainer">
                    <form action="/redcross/account/search.php" method="POST" class="d-flex flex-row flex-wrap justify-content-between">
                        <input type="text" class="form-control mr-1 mt-1" name="userid" placeholder="ID Number">
                        <input type="text" class="form-control mr-1 mt-1" name="name" placeholder="Name">
                        <input type="text" class="form-control mr-1 mt-1" name="phonenumber" placeholder="Phone Number">
                        <input type="text" class="form-control mr-1 mt-1" name="email" placeholder="Email Address">
                        <select class="form-control mr-1 mt-1" name="gender">
                            <option selected>Gender</option>
                            <?php
                                foreach($genders as $gender){
                                    echo "<option value='$gender'>".ucfirst(strtolower($gender))."</option>";
                                }
                            ?> 
                        </select>
                        <select class="form-control mr-1 mt-1" name="district">
                            <option selected>District</option>
                            <?php
                                foreach($districts as $district){
                                    echo "<option value='$district'>".ucfirst(strtolower($district))."</option>";
                                }
                            ?> 
                        </select>
                        <select class="form-control mr-1 mt-1" name="rank">
                            <option selected>Rank</option>
                            <?php
                                foreach($ranks as $rank){
                                    echo "<option value='$rank'>".ucfirst(strtolower($rank))."</option>";
                                }
                            ?> 
                        </select>
                        <select class="form-control mr-1 mt-1" name="designation">
                            <option selected>Designation</option>
                            <?php
                                foreach($users as $user){
                                    if (!in_array($user['designation'], $designations)){
                                        $user_designation = $user['designation'];
                                        array_push($designations, $user_designation);
                                        echo "<option value='$user_designation'>".ucfirst(strtolower($user_designation))."</option>";
                                    }
                                }
                            ?> 
                        </select>
                        <select class="form-control mr-1 mt-1" name="educationLevel">
                            <option selected>Education Level</option>
                            <?php
                                foreach($educationLevels as $level){
                                    echo "<option value='$level'>".ucfirst(strtolower($level))."</option>";
                                }
                            ?> 
                        </select>
                        <div class="filter mt-1 d-flex justify-content-end">
                            <a href="#" class="mr-1 d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-light text-dark shadow">
                                <i class="fas fa-times fa-fw"></i> <span class="fw-700">Hide</span>
                            </a>
                            <button type="submit" class="d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-warning text-dark shadow">
                                <i class="fas fa-filter fa-fw"></i> <span class="fw-700">Filter</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card pb-1 px-1 w-90">
                    <div class="d-flex justify-content-end w-100">
                        <a href="#searchContainer" class="d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-dark text-white shadow">
                            <i class="fas fa-search fa-fw"></i> <span class="fw-700">Search</span>
                        </a>
                        <a href="#userModal" class="ml-1 d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-primary text-white shadow">
                            <i class="fas fa-user-plus fa-fw"></i> <span class="fw-700">Add</span>
                        </a>
                    </div>
                </div>
                <div class="card p-1 table-responsive w-90 overflow-auto">
                    <table class="table table-striped w-100">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="p-1"><input type="checkbox" id="checkAll"/></th>
                                <th class="bg-dark p-1">#ID</th>
                                <th class="bg-dark p-1">Picture</th>
                                <th class="bg-dark p-1">Name</th>
                                <th class="bg-dark p-1">Phone</th>
                                <th class="bg-dark p-1">Designation</th>
                                <th class="bg-dark p-1">District</th>
                                <th class="bg-dark p-1">Rank</th>
                                <th class="bg-dark p-1">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($users as $user){
                        ?> 
                            <tr class="ff-monospace" id="row-<?=$user['id']?>">
                                <td class="pl-1"><input type="checkbox" id="check-<?=$user['id']?>"/></td>
                                <td class="pl-1"><?=$user['userid']?></td>
                                <td class="text-center">
                                    <?php
                                    echo "<img src='/redcross/pictures/".$user['picture']."' class='thumbnail py-1' alt='user pic'>"
                                    ?>
                                </td>
                                <td class="pl-1"><?=strtolower($user['firstname']." ".$user['lastname'])?></td>
                                <td class="pl-1"><?=$user['phonenumber']?></td>
                                <td class="pl-1"><?=strtolower($user['designation'])?></td>
                                <td class="pl-1"><?=strtolower($user['district'])?></td>
                                <td class="pl-1"><?=strtolower($user['rank'])?></td>
                                <td class="pl-1">
                                    <?php
                                        $last = new DateTime($user['last_dues_payment_date']);
                                        $now = new DateTime(date('Y-m-d H:i:s'));
                                        $interval = $last->diff($now);
                                        if ((bool) number_format($interval->format('%Y'), 0)){
                                            echo "<span class='text-danger'>Inactive</span>";
                                        }
                                        else {
                                            echo "<span class='text-primary'>Active</span>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="d-flex justify-content-center w-90 mt-2 px-1">
                    <div class="d-flex w-50 bg-transparent">
                        <a href="" class="rounded-0 border-0 border-right py-1 pl-1 pr-2 text-center text-dark bg-white shadow">&lt;&lt;</a>
                        <?php
                            $page_count = $usersCount/$LIMIT;
                            $curPage = $_GET['page'] ? $_GET['page'] : 1;
                            $listPages = 9;
                            for ($i = 0; $i <= $page_count; $i++){
                                if ($i+1 == $curPage && $i+1 <= $listPages ){
                        ?>
                                <a href="?page=<?=$i+1?>" class="rounded-0 border-0 border-right py-1 pl-1 pr-2 text-center text-white bg-dark"><?=$i+1?></a>
                        <?php
                                }
                                elseif($i+1 <= $listPages) {
                        ?>
                                <a href="?page=<?=$i+1?>" class="rounded-0 border-0 border-right py-1 pl-1 pr-2  text-center text-dark bg-white"><?=$i+1?></a>
                        <?php
                                }
                            }
                        ?>
                        <a href="" class="rounded-0 border-0 border-left py-1 pl-1 pr-2 text-center text-dark bg-white shadow">&gt;&gt;</a>
                    </div>
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
    <script src="/redcross/dashboard/public/js/account.js"></script>
</body>

</html>
