<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');
?>
<header class="p-3 bg-dark text-white mb-4">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img class="bi me-2" width="400" height="90" role="img" aria-label="Bootstrap" src="image/bmw.png"><use xlink:href="/"></use>
            </a>

            <p style="margin: 50px; color: wheat;">"Changing Lanes"  official podcast of BMW. Featuring new episodes each week. Welocme</p>


            <div class="text-end" style="display: grid;">

                <?php
                if(!isset ($_COOKIE['user'])):
                ?>
                <button type="button" class="btn btn-outline-light me-2 log"><a style="color: wheat" href="/authorisation.php">Log in</a></button>
                    <button type="button" class="btn btn-outline-light me-2 reg"><a style="color: wheat" href="/registration.php">Register</a></button>
                <?php else:?>
                    <?php
                    $id = $_COOKIE['user'];
                    $query = "SELECT * FROM `users` WHERE `id` = '$id'";
                    $done = mysqli_query($connect, $query);
                    $user = mysqli_fetch_assoc($done);
                    ?>

                   <button class="btn btn-outline-light me-2 log" style="color: wheat" type="button" name="endCook" id="endCook">Log Out</button>
                    <button type="button" class="btn btn-outline-light me-2 reg" style="color: wheat"><?php echo $user['name']; ?></button>
                <?php endif; ?>


            </div>
        </div>
    </div>
</header>

<body style="background-color: aliceblue;"></body>

<script>

    $('#endCook').on('click',function(){
        $.ajax({

            url: 'exit.php',
            type: 'POST',
            cache: false,
            dataType: 'html',
            // data: {
            //     login:login,
            //     pass:pass
            // },
            success: function () {

                // console.log(id);
                window.location.replace("index.php");
            }
        });
    });
</script>







