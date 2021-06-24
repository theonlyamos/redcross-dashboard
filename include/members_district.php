<?php
require_once('connection.php');

$result = $conn->query('SELECT id, rank FROM users');
$users = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query('SELECT * FROM ranks');
$ranks = $result->fetch_all(MYSQLI_ASSOC);

foreach($ranks as $rank){
    $rank_id = $rank['id'];
    $rank_name = $rank['name'];

    foreach ($users as $user){
        $user_rank = trim(strtolower($user['rank']));
        $user_id = $user['id'];
        if ($user_rank == $rank['name']){
            $query = "UPDATE users SET rank_id = $rank_id WHERE users.id = $user_id";
            echo $query."\n";
            $result = $conn->query($query);
        }
    }
}

?>
