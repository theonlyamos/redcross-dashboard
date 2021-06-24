<?php 

require_once("../../include/connection.php");

session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}

$userid = $conn->real_escape_string($_GET['userid']);

$result = $conn->query("SELECT * FROM users WHERE userid='$userid'");

if ($result->num_rows){
    $user = $result->fetch_assoc();
}

$districts = ['Shama Ahanta East Metropolitan District', 'SEKONDI - TAKORADI', 'Ahanta West District, AGONA-NKWANTA', 'Aowin/Suaman District, ENCHI', 'Bia District, ESSAM', 'Bibiani/Anhwiaso/Bekwai District, BIBIANI', 'Ellembelle District, NKROFUL', 'Jomoro District, HALF-ASSIN', 'Juaboso District, JUABOSO', 'Wassa East District, DABOASE', 'Nzema East District, AXIM', 'Prestea-Huni Valley District, BOGOSO', 'Sefwi-Wiawso District, WIAWSO', 'Sefwi Akontombra district, SEFWI AKONTOMBRA', 'Shama District, SHAMA', 'Wasa Amenfi East District, WASSA-AKROPONG', 'Wasa Amenfi West District, ASANKRANGWA', 'TARKWA-Nsuaem', 'Bia-West-Essam', 'Bia East-Adabokrom', 'Amenfi Central-Manso', 'Mpohor Wassa - Mpohor District'];

$genders = ["male", "female", "others"];   

$educationLevels = ["NONE","PRIMARY","JHS","SHS","DIPLOMA","HND","DEGREE","MASTERS","PHD","DOCTORATE","PROFESSOR"];

$ranks = ["school","chapter","metro","region"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Member</title><meta name="viewport" content="width=device-width;initial-scale=1;"/>
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/style.css">
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/registration.css">
    <link rel='icon' href="/redcross/pic/favicon.ico">
</head>

<body>
    <?php require_once('../../include/header.php'); ?>

    <section class="registration-form">
        <?php 

          if(isset($_SESSION['error']) && $_SESSION['error']) {
              echo "<h5 class='error-message'><b>Error adding record to database</b></h5>";
        }  
       $_SESSION['error'] = false;
      ?>
        <div class="title">
            <h2>UPDATE FORM</h2>
        </div>
        <form id="registration" method="post" action="/redcross/members/update/update.php" enctype="multipart/form-data">


            <div class="left">
                <input type="text" name="userid" value="<?=$user['userid']?>" readonly required class="in-left">

                <input type="text" name="firstname" value="<?=$user['firstname']?>" placeholder="Enter first Name" required class="in-left">

                <input type="text" name="lastname" value="<?=$user['lastname']?>" placeholder="Enter last Name" required class="in-left">
            </div>

            <div class="picture-box" id="pictureBox" style="background-image: url('/redcross/pictures/<?=$user['picture']?>')">
                <img src="/redcross/pic/cloud-upload.png" alt="upload icon" onclick="getImage()">
                <input type="file" name="picture" accept="image/*" style="display:none" id="pictureInput" onchange="handleFiles(this)">
            </div>

            <input type="text" name="email" value="<?=$user['email']?>" placeholder="Enter E-mail" required>
            <input type="text" style="visibility: hidden">

            <input type="text" name="designation" value="<?=$user['designation']?>" placeholder="Enter Designation" required>

            <input type="text" name="residence" value="<?=$user['residence']?>" placeholder="Enter name of Residence" required>

            <input type="text" name="phonenumber" value="<?=$user['phonenumber']?>" inputmode="numeric" placeholder="Enter phone number" required>

            <select id="box" name="district" required>
                <option value="">Choose District </option>
                <?php
                    foreach($districts as $district){
                        echo "<option value='$district' ";
                        if ($district == $user['district']){
                            echo "selected";
                        }
                        echo ">$district</option>";
                    }
                ?>
            </select>

            <select name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <?php
                    foreach($genders as $gender){
                        echo "<option value='$gender' ";
                        if ($gender == $user['gender']){
                            echo "selected";
                        }
                        echo ">".ucfirst($gender)."</option>";
                    }
                ?>
            </select>

            <select id="certification" name="educationLevel" required>
                <option value="">Level of Education</option>
                <?php
                    foreach($educationLevels as $level){
                        echo "<option value='$level' ";
                        if ($level == $user['educationLevel']){
                            echo "selected";
                        }
                        echo ">$level</option>";
                    }
                ?>
            </select>


            <select name="rank" id="rank" class="rank" required>
                <option value="">Select Rank</option>
                <?php
                    foreach($ranks as $rank){
                        echo "<option value='$rank' ";
                        if ($rank == $user['rank']){
                            echo "selected";
                        }
                        echo ">".ucfirst($rank)."</option>";
                    }
                ?>
            </select>

            <input type="text" style="visibility:hidden">

            <button type="submit" class="submit" id="submit" name="SUBMIT">Update</button>
        </form>
    </section>
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
</body>

</html>
