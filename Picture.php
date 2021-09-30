<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');
$msg = "";
if (isset($_POST['id']) && !empty($_FILES['image']['name'])){

    $id = $_POST['id'];
    $image = $_FILES['image']['name'];
    $chips = $_FILES['image']['tmp_name'];
    $size = filesize($chips);

    if ($size > 1500000 ){
        $message = "Image size exceeds 1.5MB";
        echo $message;
    }


    $extension = pathinfo($image,PATHINFO_EXTENSION);
    $randomno=rand(0,100000);
    $rename = $id.date('YMD').$randomno;
    $newname=$rename.'.'.$extension;
    $target = "image/" . basename($newname);
//    print_r($target);
//    die();

    $firstSql = $connect->query("INSERT INTO `pictures`(`image`, `user_id`) VALUES ('$newname', '$id')");
    $sql = $connect->query("UPDATE `pictures` SET `image`= '$newname',`user_id`='$id' WHERE `user_id` = '$id'");
//    mysqli_query($connect, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }



}