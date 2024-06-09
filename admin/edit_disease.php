<?php
require_once("../config.php");
$disease_active = true;
if(!isset($_GET['ds_id'])){
    header('./disease.php');
} else {
    $sql = "SELECT * FROM `diseases` WHERE `ds_id` = " .$_GET['ds_id'];
    $query = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($query)) {
        $ds_id = $row['ds_id'];
        $ds_name = $row['ds_name'];
        $ds_detail = $row['ds_detail'];
        $ds_first_que = $row['ds_first_que'];
    }
}
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
                            <input type="hidden" name="ds_id" value="<?=$ds_id?>">
                            <label for="ds_name">ชื่อโรค</label>
                            <input type="text" class="form-control" id="ds_name" name="ds_name" value="<?=$ds_name?>" placeholder="ชื่อโรค" required autofocus>
                        </div>
                        <div class="form-group" id="form_fq">
                            <label for="ds_first_que">เริ่มด้วยคำถามไหน</label>
                            <select class="form-control" id="ds_first_que" name="ds_first_que"></select>
                        </div>
                        <div class="form-group">
                            <label for="ds_name">รายละเอี่ยดโรค</label>
                            <textarea type="text" class="form-control" id="ds_detail" name="ds_detail" placeholder="รายละเอี่ยดโรค" required><?=$ds_detail?></textarea>
                        </div>
                        <button type="submit" id="ds_btn" class="btn btn-block btn-primary" name="ds_update_btn">บันทึกโรค</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
<!-- Modal -->
<script>
    $(document).ready(function () {
        var ds_title_lb = $("#ds_title_lb");
        var ds_action_form = $("#ds_action_form");
        var ds_id = $("#ds_id");
        var ds_name = $("#ds_name");
        var ds_first_que = $("#ds_first_que");
        var ds_btn = $("#ds_btn");
        
        $.ajax({
            url: './api/api_symptom.php',
            type: 'POST',
            data: {getSymptomByDiseaseId: 1, ds_id: <?=$ds_id?>},
            success: function(data){
                var data = JSON.parse(data);
                var html = "";
                for (var i = 0; i < data.length; i++) {
                    if(data[i].st_id == <?=$ds_first_que?>) 
                        html += '<option value="' + data[i].st_id + '" selected>' + data[i].st_title + '</option>';
                    else html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
                }
                ds_first_que.html(html);
            },
            error: function(){
                console.log('error');
            }
        });

    });
</script>
