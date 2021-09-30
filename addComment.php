<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');

$error = '';
$user_id = $_POST['user_id'];

$comment_name = $_POST['comment_name'];

$comment_id = $_POST["comment_id"];
$comment_content = $_POST['comment_content'];


if (empty($_POST["comment_content"])) {
    $error .= '<p class="text-danger">Comment is required</p>';
}

if ($error == '') {

    $query = "
 INSERT INTO `tbl_comment`
 (`parent_comment_id`, `comment`, `comment_sender_name` , `user_id`) 
 VALUES ('$comment_id', '$comment_content', '$comment_name', '$user_id')
 ";
    mysqli_query($connect, $query);

    $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
    'error' => $error
);

echo json_encode($data);


