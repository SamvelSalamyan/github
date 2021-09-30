<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');
?>
<!doctype html>
<html lang = "ru">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Registration</title>

<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

<style>

    .loginForm {
        width: ;
        padding: 30px;
        box-shadow: 0 0 10px 0 #000;
        border-radius: 10px;
    }

    .inlog {

        text-align: center;
        justify-content: center;
        /* align-content: center; */
        display: grid;
    }
</style>

</head>
<body>


<?php
require "blocks/header.php";
?>
<div class="butt">
    <button class="btn back" style="background-color: #6b7c8e; border: wheat 1px solid;" type="button" name="return"><a style=" color: wheat" href="/index.php">Main Page</a></button>
</div>
<?php
if(!isset ($_COOKIE['user'])):

    ?>

    <div class="container mt-4">

        <div class="row">
            <div class="col inlog">
                <h1>Authorisation Form</h1>
                <form class="loginForm" action="" method="post" id="formLog">
                    <input type="text" class="form-control" name="login" id="loginin" placeholder="Enter your login">
                    <span id="errspan7"><div style="color: red" id="errorMessLogged"> </div></span><br>

                    <input type="password" class="form-control" name="pass" id="passin" placeholder="Enter your password">
                    <span id="errspan8"><div style="color: red" id="errorMessPassed"> </div></span><br>
                    <span id="errspan9"><div style="color: red" id="errorMessUser"> </div></span><br>

                    <button class="btn btn-success btn-block log"  type ="button" >Log In</button>
                </form>
            </div>


        </div>
    </div>
<?php else:?>

    <?php header("Location: index.php");
    exit();
    ?>



<?php endif; ?>

<script>



    $(document).on('click', '.log', function(){

        let login = $("#loginin").val().trim();
        let pass = $("#passin").val().trim();


        if (login == "") {
            $("#errorMessLogged").text("Enter your Login");
            return false;
        } else {
            $("#errorMessLogged").text("");
        }

        if (pass == "") {
            $("#errorMessPassed").text("Enter your Password");
            return false;
        } else {
            $("#errorMessPassed").text("");
        }



        $.ajax({

            url: 'auth.php',
            type: 'POST',
            cache: false,
            dataType: 'html',
            data: {
                //     data: new FormData(this),
                login:login,
                pass:pass
            },
            success: function (user_err,user) {

                if (user_err !== '') {
                    $("#errorMessUser").append(user_err);
                    $("#formLog")[0].reset();
                }
                else {
                    location.reload();
                    console.log(user);
                    $("#info").text(user);

                }
            }

        });
    });

</script>

<?php require "blocks/footer.php" ?>
</body>
</html>