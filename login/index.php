<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width;initial-scale=1;"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
    <link rel='icon' href="/red/pic/favicon.ico">
</head>

<body>
   <section class="login-form forms">
      <?php 

          if(isset($_SESSION['error']) && $_SESSION['error']) {
              echo "<h5 class='error-message'><b>Username/Password Combination is incorrect.</b></h5>";
        }  
       session_unset();
      ?>
       <form id="form1" name="form1" method="post" action="login.php">
        <div class="loginbox">
            <img src="../pic/run%20f.jpg" class="avatar"/>
            <h1>Login Here</h1>
             <p>User name</p>
             <input type="text" name="username" placeholder="Enter Username" required="">
             <p>Password</p>
             <input type="password" name="password" placeholder="Enter Password" required>
             <input type="submit" name="LOGIN" value="login">
        </div>
       </form>
    </section>

</body>

</html>