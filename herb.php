<?php
require_once("./config.php");
$herb_active = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once("./sections/head.php");?>
    <body>
        <?php require_once("./sections/navbar.php");?>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">วินิฉัยโรค</h3>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-inf" width="5%">ลำดับ</th>
                            <th class="bg-inf" width="20%">ชื่อสมุนไพร</th>
                            <th class="bg-inf" width="30%">ชื่อสมุนไพรอื่นๆ</th>
                            <th class="bg-inf" width="45%">ประโยชน์</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `herbs`";
                        $query = mysqli_query($db, $sql);
                        $index = 1;
                        if (mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <th class="bg-inf"><?=$index?></th>
                                    <td><?=$row['h_name']?></td>
                                    <td><?=$row['h_nickname']?></td>
                                    <td><?=$row['h_benefit']?></td>
                                </tr>
                            <?php
                                $index++;
                            }
                        } else {
                            echo '<tr><td align="center" colspan="5">ไม่มีรายการอาการ</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>    