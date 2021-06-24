<?php
    require_once 'include/database.php';
    $sql = "SELECT * FROM users";

    /*
    if (!empty($_GET['name'])){
        $search_name = $_GET['name'];
        $sql.=" where (name like '%$search_name%');";
    }
    */

    $result = $mysqli->query($sql);
    $usersCount = $result->num_rows;
    $users = $result->fetch_all(MYSQLI_ASSOC);

    $districts = [];
    $ranks = [];
    $designations = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRC DASHBOARD</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" type="text/css" href="./public/css/all.css">
</head>

<body>
    <main class="d-flex flex-column w-100 h-100 overflow-hidden align-items-center justify-content-center">
      <div class="card login-card p-2">
        <div class="text-center fs-2em text-primary">Login</div>
        <form action="" method="post" class="d-flex flex-column">
          <div class="form-group d-flex align-items-center mt-2">
            <i class="fas fa-envelope fa-fw"></i>
            <input type="text" name="email" class="form-control w-90" placeholder="Email Address" required>
          </div>
          <div class="form-group d-flex align-items-center mt-2"">
            <i class="fas fa-unlock-alt fa-fw"></i>
            <input type="password" name="password" class="form-control w-90" placeholder="Password" required>
          </div>
          <div class="submit mt-2 w-100 d-flex justify-content-end">
              <button type="submit" class="d-flex align-items-center rounded-0 border-0 px-2 py-1 bg-primary text-white shadow">
                  <i class="fas fa-sign-in-alt fa-fw"></i> <span class="fw-700">Login</span>
              </button>
          </div>
        </form>
      </div>
    </main>
</body>

</html>
