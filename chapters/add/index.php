<?php 

session_start();

if (!isset($_SESSION['user'])){
    header("Location: /redcross/login");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <meta name="viewport" content="width=device-width;initial-scale=1;"/>
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/style.css">
    <link rel="stylesheet" type="text/css" href="/redcross/CSS/registration.css">
    <link rel='icon' href="/redcross/pic/favicon.ico">
</head>

<body>
    <?php require_once('../../../include/header.php'); ?>

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
        <form id="registration" method="post" action="/redcross/members/add/registration.php" enctype="multipart/form-data">

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
