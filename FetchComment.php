<?php
$connect = mysqli_connect('localhost', 'root','','register-bd');

//$id = $_POST['id'];
//
//$picQuery  = mysqli_query($connect, "SELECT * FROM `pictures` WHERE `user_id` = '$id'");
//$short = mysqli_fetch_array($picQuery);
//$pic = $short['image'];






$query = "
SELECT * FROM `tbl_comment`
WHERE `parent_comment_id` = '0' 
ORDER BY `comment_id` DESC
";




$statement = mysqli_query($connect, $query);

while ($res = mysqli_fetch_array($statement)) {

    $user_id = $res["user_id"];

    $picQuery  = mysqli_query($connect, "SELECT * FROM `pictures` WHERE `user_id` = '".$user_id."' ");
$short = mysqli_fetch_array($picQuery);
$pic = $short['image'];


        $output = '
 <div class="panel panel-default">
 
  <div class="panel-heading"><img class="card-img-top rounded-circle" style="width: 50px;height: 50px;" src="image/' .$pic. '"> By <b>' . $res["comment_sender_name"] . '</b> on <i>' . $res["date"] . '</i></div><br>
  <div class="panel-body">' . $res["comment"] . '</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="' . $res["comment_id"] . '">Reply</button></div>
 </div>
 ';
        $output .= get_reply_comment($connect, $res["comment_id"]);

echo $output;
}

function get_reply_comment($connect, $parent_id = 0)
{
    $query = "
 SELECT * FROM `tbl_comment` WHERE `parent_comment_id` = '" . $parent_id . "'
 ";

    $statement = mysqli_query($connect, $query);

    $output = '';

        while ($res = mysqli_fetch_array($statement)) {

            $user_id = $res["user_id"];

            $picQuery  = mysqli_query($connect, "SELECT * FROM `pictures` WHERE `user_id` = '".$user_id."' ");
            $short = mysqli_fetch_array($picQuery);
            $pic = $short['image'];

            $output .= ' 
   <div class="panel panel-default" style="margin-left:100px">
    <div class="panel-heading"><img class="card-img-top rounded-circle" style="width: 50px;height: 50px;" src="image/' .$pic. '"> Reply By <b>' . $res["comment_sender_name"] . '</b> on <i>' . $res["date"] . '</i></div><br>
    <div class="panel-body">' . $res["comment"] . '</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="' . $res["comment_id"] . '">Reply</button></div>
   </div>
   ';
            $output .= get_reply_comment($connect, $res["comment_id"]);
        }

        return $output;

}
?>
