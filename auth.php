<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');

if(isset($_POST['login'])) {


$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);


//print_r($login);
//print_r(' ');
//print_r($pass);
//
//die();
$pass = md5($pass."abcdefg1234");
$query = "SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'";

$done = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($done);

if(empty($user)) {
    $user_err = "User Not Found";
    echo $user_err;
}

//session_start();
//$_SESSION["user"] = $user;

$cook = setcookie('user', $user['id'], time() + 3600, '/');

return $user;

//setcookie("user", $user['name'], time() + 3600, "/");
//$done->close();

}





