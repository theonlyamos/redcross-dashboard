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

    $sql = "SELECT users.*, districts.name AS district FROM users";

    if (isset($_GET['page']) && $_GET['page']){
        if ($_GET['page'] > $OFFSET){
            $PAGENUM = $_GET['page'] - 1;
            $OFFSET = $PAGENUM * $LIMIT;

            $sql .= " LEFT JOIN districts on districts.id = users.district_id limit $OFFSET, $LIMIT";
        }
        else {
            $sql .= " LEFT JOIN districts on districts.id = users.district_id limit $LIMIT";
        }
    }
    else {
        $sql .= " LEFT JOIN districts on districts.id = users.district_id limit $LIMIT";
    }

    $result = $conn->query($sql);
    $users = $result->fetch_all(MYSQLI_ASSOC);

    $result = $conn->query('SELECT * FROM users');
    $usersCount = $result->num_rows;

    $result = $conn->query('SELECT * FROM districts');
    $districts = $result->fetch_all(MYSQLI_ASSOC);

    $genders = ["male", "female", "others"];   

    $educationLevels = ["NONE","PRIMARY","JHS","SHS","DIPLOMA","HND","DEGREE","MASTERS","PHD","DOCTORATE","PROFESSOR"];

    $result = $conn->query('SELECT * FROM ranks');
    $ranks = $result->fetch_all(MYSQLI_ASSOC);

    $currentPage = 'members';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRC DASHBOARD</title>
    <link rel="stylesheet" href="/redcross/dashboard/public/css/admin.css">
    <!--
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/registration.css">
    -->
    <link rel="stylesheet" type="text/css" href="/redcross/dashboard/public/css/all.css">
    <link rel='icon' href="/redcross/pic/favicon.ico">
    <script src="/redcross/dashboard/public/js/jquery-3.3.1.min.js"></script>
</head>

<body>
   <?php require_once '../modals/registration.php'; ?>
   <?php require_once '../modals/deleteConfirm.php'; ?>
   <?php require_once '../modals/makeAdmin.php'; ?>
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
                    <form action="/redcross/members/search.php" method="POST" class="d-flex flex-row flex-wrap justify-content-between">
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
                                    echo "<option value='".$district['id']."'>".ucfirst(strtolower($district['name']))."</option>";
                                }
                            ?> 
                        </select>
                        <select class="form-control mr-1 mt-1" name="rank">
                            <option selected>Rank</option>
                            <?php
                                foreach($ranks as $rank){
                                    echo "<option value='".$rank['id']."'>".ucfirst(strtolower($rank['name']))."</option>";
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
                <div class="card d-flex flex-wrap justify-content-between align-items-center py-1 px-1 w-90">
                    <div class="d-flex align-items-center">
                         <a href="#userModal" class="text-success select-tool tool-update disabled" title="Member Details" id="userDetailsTool">
                            <i class='fas fa-user-cog fa-fw fa-2x'></i>
                            <span class="tool-name d-none" style='display: none'>Details</span>
                        </a>

                        <a href="#confirmDeleteModal" class="text-danger ml-1 disabled select-tool tool-delete" title="Delete Member" id="deleteTool">
                            <i class='fas fa-trash fa-fw fa-2x'></i>
                            <span class="tool-name" style="display: none">Delete</span>
                        </a>
                        <a href="#makeAdmin" class="text-danger ml-1 disabled select-tool tool-user-admin" title="Make Member Admin">
                            <i class='fas fa-user-shield fa-fw fa-2x'></i>
                            <span class="tool-name" style="display: none">Admin</span>
                        </a>

                    </div>
                    <div class="d-flex justify-content-end">
<!--
                        <a href="#searchContainer" class="d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-dark text-white shadow">
                            <i class="fas fa-search fa-fw"></i> <span class="fw-700">Search</span>
                        </a>
                        <a href="#userModal" class="ml-1 d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-primary text-white shadow">
                            <i class="fas fa-user-plus fa-fw"></i> <span class="fw-700">Add</span>
                        </a> -->
                         <a href="#searchContainer" class="text-black">
                            <i class="fas fa-search fa-fw fa-2x"></i> <span class="d-none fw-700">Search</span>
                        </a>
                        <a href="#userModal" class="text-primary ml-1" id="userAddTool">
                            <i class="fas fa-user-plus fa-fw fa-2x"></i> <span class="fw-700 d-none">Add</span>
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
                            <td class="pl-1"><input type="checkbox" id="check-<?=$user['id']?>" data-userid="<?=$user['id']?>"/></td>
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
                            $curPage = isset($_GET['page']) ? $_GET['page'] : 1;
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
    <script src="/redcross/dashboard/public/js/members.js"></script>
</body>

</html>
