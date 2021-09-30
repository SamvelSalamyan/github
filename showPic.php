<?php

$connect = mysqli_connect('localhost', 'root', '', 'register-bd');

if (isset($_POST['readRecords1'])) {
    $userId = $_POST['userId'];


//                $id = $_POST['id'];


    $done = mysqli_query($connect, "SELECT * FROM `pictures` WHERE `user_id` = '$userId'");
    $short = mysqli_fetch_array($done);
    $result = $short['image'];
    $bastard = $short['id'];
    $clean = $connect->query("DELETE FROM `pictures` WHERE `id` != '$bastard' AND `user_id` = '$userId'");

    echo $result;
}