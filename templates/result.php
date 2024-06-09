
<?php
require_once("./config.php");
$ds_id = $_GET['ds_id'];
$sql = "SELECT * FROM `symptoms` INNER JOIN `analyses` ON `symptoms`.`st_id` = `analyses`.`st_id` WHERE `analyses`.`ds_id` = '{$ds_id}'";
$query = mysqli_query($db, $sql);
$num_st = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once("./sections/head.php");?>
    <body>
        <?php require_once("./sections/navbar.php");?>

            <form class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?=$_GET['ds_name']?><span id="question_lb" class="label label-primary pull-right"></span></h3> 
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10%">ลำดับ</th>
                                <th width="70%">ชื่ออาการ</th>
                                <th width="10%">ใช่</th>
                                <th width="10%">ไม่ใช่</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ( $num_st > 0) {
                            $index = 1;
                            while($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?=$index++?></td>
                                    <td><?=$row['st_name']?></td>
                                    <td>
                                        <label class="radio-inline text-info">
                                            <input type="radio" name="st_<?=$row['st_id']?>" id="<?=$row['st_id']?>" required> ใช่
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline text-danger">
                                            <input type="radio" name="st_<?=$row['st_id']?>" id="<?=$row['st_id']?>" required> ไม่ใช่
                                        </label>
                                    </td>
                                </tr>
                            <!-- <li class="list-group-item">'. $row['st_name'] .'<p class="pull-right"><input type="radio" name="check'. $row['st_id'] .'"/>ไม่ใช่<input type="radio" name="check'. $row['st_id'] .'"/>ใช่</p> -->
                        <?php  }
                        } ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-block btn-info">วิเคราะห์</button>
            </form>

    </body>

</html>

<script>
    $(document).ready(function () {
        var question_lb = $("#question_lb");
        var st_num = <?=$num_st?>;
        question_lb.text("คำถามที่");

        analyse = function() {
            for(int i = 0; i < st_num; i++) {

            }
        }
    });
</script>