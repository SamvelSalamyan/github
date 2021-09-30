<?php
$mysql = new mysqli('localhost', 'root', '', 'register-bd');
if(isset($_POST['name'])) {

    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $number = filter_var(trim($_POST['number']), FILTER_SANITIZE_STRING);
    $gender = filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING);
    $country = filter_var(trim($_POST['country']), FILTER_SANITIZE_STRING);
    $pass = md5($pass . "abcdefg1234");



    if (mb_strlen($login) < 2 || mb_strlen($login) > 90) {
        echo "Недопустимая длина логина";
        exit;
    } else if (mb_strlen($name) < 2 || mb_strlen($name) > 50) {
        echo "Недопустимая длина имени";
        exit;
   }
// else if (mb_strlen($pass) < 2 || mb_strlen($pass) > 6) {
//        echo "Недопустимая длина пароля(от 2 до 6 символов)";
//        exit;
//    }


    $sql_u = "SELECT * FROM `users` WHERE `login`='$login'";
    $res_u = mysqli_query($mysql, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        $login_error = "Sorry... username already taken";
        echo $login_error;

    }
else{




//$mysql->query("INSERT INTO `users` ( `login`, `pass`, `name`, `email`, `number`, `gender`, `country`)
//VALUES ('$login', ('$pass'), '$name', '$email', '$number', '$gender', '$country')");


    $test = "INSERT INTO `users` (`email`, `age`, `gender`, `country`, `login`, `pass`, `name`)
                VALUES ('$email', '$number', '$gender', '$country', '$login', '$pass', '$name')";
    $done = mysqli_query($mysql, $test);
//print_r($name);
//die();

//    $mysql->close();
}
}
?>