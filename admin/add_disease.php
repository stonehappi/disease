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
                    <div class="panel-heading"> เพิ่มโรค</div>
                    <form class="panel-body" method="POST" action="./api/api_disease.php">
                        <div class="form-group">
                            <label for="ds_name">ชื่อโรค</label>
                            <input type="text" class="form-control" id="ds_name" name="ds_name" placeholder="ชื่อโรค" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="ds_name">รายละเอี่ยดโรค</label>
                            <textarea type="text" class="form-control" id="ds_detail" name="ds_detail" placeholder="รายละเอี่ยดโรค" required></textarea>
                        </div>
                        <button type="submit" id="ds_btn" class="btn btn-block btn-success" name="ds_insert_btn">เพิ่มโรค</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
