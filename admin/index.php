<?php
require_once("../config.php");
$disease_active = true;

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
                    <div class="panel-heading"> โรค <a href="./add_disease.php" class="label label-success">เพิ่มโรค</a></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="">ชื่อโรค</th>
                                <th width="">เริ่มด้วยคำถาม</th>
                                <th width="10%">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `diseases`";
                            $query = mysqli_query($db, $sql);
                            $index = 1;
                            if (mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_assoc($query)) { 
                                    $sql_st = "SELECT `st_title` FROM `symptoms` WHERE `st_id` = ".$row['ds_first_que'];
                                    $row_st = mysqli_fetch_assoc(mysqli_query($db, $sql_st));
                                    ?>
                                    <tr>
                                        <th><?=$index?></th>
                                        <td><?=$row['ds_name']?></td>
                                        <td><?=$row_st['st_title']?></td>
                                        <td>
                                            <a href="./edit_disease.php?ds_id=<?=$row['ds_id']?>" class="label label-primary">แก้ไข</a>
                                            <a href="./api/api_disease.php?dDiseases=true&ds_id=<?=$row['ds_id']?>" class="label label-danger">ลบ</a>
                                        </td>
                                    </tr>
                                <?php
                                    $index++;
                                }
                            } else {
                                echo '<tr><td align="center" colspan="3">ไม่มีรายการโรค</td></tr>';
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
