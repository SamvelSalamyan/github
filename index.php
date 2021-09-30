<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');
include 'Dbh.php';
$testObj = new Test();

?>
<!doctype html>
<html lang = "ru">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<head>
<title>My Project</title>

<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<style>
    .card {
    background-color: aliceblue;
        margin-top: 20px;
    }

   .panel-default {
        padding: 30px;
        box-shadow: 0 0 10px 0 #000;
        border-radius: 10px;
        margin-top: 20px;
    }
   .panel-heading {

       border-radius: 5px;
       padding: 10px;
       box-shadow: 0 0 10px 0 #000;
   }
   .Imageform {
       padding: 10px;
   }



</style>


</head>
<body>
<?php
require "blocks/header.php";
if(isset ($_COOKIE['user'])):

?>


<!--    <button class="btn btn-danger" type="button" name="endCook" id="endCook">Log Out</button> <br><br>-->
    <?php
    $id = $_COOKIE['user'];
    $query = "SELECT * FROM `users` WHERE `id` = '$id'";
    $done = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($done);
    ?>

    <div class="container">

<?php

?>


        <div class="card mt-10" style="width: 18rem;">

            <div id="bodyCard" class="card-body"></div>
            <div id="info" class="card-text"><h3><p style="margin:20px;text-align:center;"><?php $testObj->getUsersStmt($id); ?></p></h3></div>

        <form id="Imageform" class="Imageform" action="" method="post" enctype="multipart/form-data">

            <div>
                <div>
                    <input id="uploadImage"  type="file" accept="image/*" name="image">

                </div> <br>
                <div>
                    <input type="hidden" id="id" class="id" name="id" value="<?php echo $user['id']; ?>">
                </div>
                <span id="errspan10"><div style="color: red" id="errorMessImg"> </div></span><br>
                <div>
                    <button class="btn btn-success btn-block uploadImg" id="uplImg" type="submit"  name="upload">Add Image</button>
                </div>
            </div>
        </form>
        </div><br>

        <div>

            <form method="POST" id="comment_form" >
                <div class="form-group">
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo $user['id']; ?>"/>
                    <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="<?php echo $user['name']; ?>" />
                </div>
                <div class="form-group">
                    <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Make a Post, Whats on your mind?" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Post" />
                </div>
            </form>
            <span id="comment_message"></span>
            <br />
            <div id="display_comment"></div>

        </div>
        </div>
    </div>

<?php else:?>


    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 h-100" src="image/bmw1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-100" src="image/bmw2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/bmw3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


<?php endif; ?>
<script>

    $(document).ready(function (){
        readRecords1();
    });

    function readRecords1() {
        let readRecords1 = "readRecords1";
        // let id = $(".smallPic").attr("id");
        let userId = $('#id').val();

        $.ajax({
            url: 'showPic.php',
            type: 'POST',
            cache: false,
            data: {
                readRecords1: readRecords1,
                // id: id,
                userId: userId
            },
            success: function (result ,userId) {
                let jpg = '.jpg';
                if (result) {

                    // $(".card-body").html('<img class="card-img-top" style="width: 239px;height: 254px;" src="image/' + userId + jpg + '">');
                    // $("#bodyCard").load(" #bodyCard");
                    $(".card-body").html('<img class="card-img-top rounded-circle" style="width: 239px;height: 254px;" src="image/' + result + '">');
                }
                else {
                    $(".card-body").html('<img style="width: 239px;height: 254px;" src="image/prof.png">');
                }
            }
        });
    }


    $(document).ready(function(e) {
        $('#Imageform').on('submit',( function (e) {
            e.preventDefault();
            let id = $('#id').val();

            $.ajax({
                url: 'Picture.php',
                type: 'POST',
                cache: false,
                data: new FormData(this),

                contentType: false,
                processData:false,
                success: function (message) {

                    if (message !== ' ') {
                        $("#errorMessImg").append(message);
                    }
                    $("#Imageform")[0].reset();
                    readRecords1();

                }
            });

        }));
    });


    $(document).ready(function(){

        $('#comment_form').on('submit', function(event){
            event.preventDefault();
            let comment_name = $(this).attr("name");

            var form_data = $(this).serialize();
            $.ajax({
                url:"addComment.php",
                method:"POST",
                // data:form_data,
                data:new FormData(this),
                contentType: false,
                processData:false,
                dataType:"JSON",
                success:function(data)
                {
                    if(data.error != '')
                    {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment()
        {
             let id = $('#id').val();

            $.ajax({
                url:"FetchComment.php",
                method:"POST",
                data: {
                    id:id
                },
                success:function(data)
                {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function(){
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
            $('html,body').animate({
                    scrollTop: $("#comment_form").offset().top},
                'slow');
        });

    });




</script>


<?php require "blocks/footer.php" ?>
</body>
</html>
