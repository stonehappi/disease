<?php
require_once("../config.php");
$advice_active = true;

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./sections/head.php"); ?>
<body>
    <?php require_once("./sections/navbar.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2" id="sidebar">
                <?php require_once("./sections/aside.php"); ?>
            </div>
            <div class="col-md-9 col-lg-10" id="content">
                <div class="panel panel-info">
                    <div class="panel-heading"> คำแนะนำ <a href="./add_advice.php" class="label label-success">เพิ่มคำแนะนำ</a></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="">URL</th>
                                <th width="">เนื่อหา</th>
                                <th width="10%">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `advices`";
                            $query = mysqli_query($db, $sql);
                            $index = 1;
                            if (mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_assoc($query)){
                                    ?>
                                    <tr>
                                        <th><?=$index?></th>
                                        <td>http://localhost/M/advice.php?av_id=<?=$row['av_id']?></td>
                                        <td><?=$row['av_body']?></td>
                                        <td>
                                            <a href="./edit_advice.php?av_id=<?=$row['av_id']?>" class="label label-primary">แก้ไข</a>
                                            <a href="./api/api_advice.php?dAdvice=true&av_id=<?=$row['av_id']?>" class="label label-danger">ลบ</a>
                                        </td>
                                    </tr>
                                <?php
                                    $index++;
                                }
                            } else {
                                echo '<tr><td align="center" colspan="4">ไม่มีรายการโรค</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
