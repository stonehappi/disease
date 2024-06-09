<?php
require_once("../config.php");
$symptom_active = true;
if(!isset($_GET['st_id'])){
    header('./symptom.php');
} else {
    $sql = "SELECT * FROM `symptoms` WHERE `st_id` = " .$_GET['st_id'];
    $query = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($query)) {
        $st_id = $row['st_id'];
        $st_title = $row['st_title'];
        $st_n = $row['st_n'];
        $st_y = $row['st_y'];
        $st_isAns = $row['st_isAns'];
        $ds_id = $row['ds_id'];
        $url = $row['url'];
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
                    <div class="panel-heading"> แก้ไขอาการ</div>
                    <form class="panel-body" method="POST" action="./api/api_symptom.php">
                        <div class="form-group">
                            <input type="hidden" id="st_id" name="st_id" value="<?=$st_id?>">
                            <label for="st_title">อาการ</label>
                            <textarea type="text" class="form-control" id="st_title" name="st_title" required><?=$st_title?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ds_id">อยู่ในโรคใด</label>
                            <select class="form-control" id="ds_id" name="ds_id" required></select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="st_isAns" name="st_isAns" <?=$st_isAns == 1 ? 'checked' :''?>> เป็นคำตอบสุดท้าย
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="st_title">คำแนะนำ(URL)</label>
                            <input type="text" class="form-control" id="url" name="url" value="<?=$url?>" placeholder="http://example.com"/>
                        </div>
                        <div class="form-group">
                            <label for="st_y">คำตอบใช่</label>
                            <select class="form-control" id="st_y" name="st_y"></select>
                        </div>
                        <div class="form-group">
                            <label for="st_n">คำตอบไม่ใช่</label>
                            <select class="form-control" id="st_n" name="st_n"></select>
                        </div>
                        <button type="submit" id="st_btn" class="btn btn-block btn-primary" name="st_update_btn">บันทึกอาการ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
<script>
    $(document).ready(function () {

        var st_title_lb = $("#st_title_lb");
        var st_action_form = $("#st_action_form");
        var st_id = $("#st_id");
        var st_title = $("#st_title");
        var st_y = $("#st_y");
        var st_n = $("#st_n");
        var url = $("#url");
        var ds_id = $("#ds_id");
        var st_isAns = $("#st_isAns");
        var st_btn = $("#st_btn");

        
        loadDiseases(ds_id);
        loadSymptom(st_y, <?=$ds_id?>, 1);
        loadSymptom(st_n, <?=$ds_id?>, 2);
        if(<?=$st_isAns?> == 1) {
            st_y.prop('disabled', true);
            st_n.prop('disabled', true);
            url.prop('disabled', false);
        } else {
            url.prop('disabled', true);
        }

        st_isAns.change(function(){
            if(st_isAns.is(':checked')){
                st_y.prop('disabled', true);
                st_n.prop('disabled', true);
                url.prop('disabled', false);
            } else {
                st_y.prop('disabled', false);
                st_n.prop('disabled', false);
                url.prop('disabled', true);
            }
        });
        ds_id.change(function(){
            loadSymptom(st_y, ds_id.val(), 0);
            loadSymptom(st_n, ds_id.val(), 0);
        });

        function loadSymptom(element, ds_id, onload) {
            var html = '<option value="">(เหลือก)</option>';
            $.ajax({
                url: './api/api_symptom.php',
                type: 'POST',
                data: {getSymptoms: 1, ds_id : ds_id},
                success: function(data){
                    var data = JSON.parse(data);
                    for (var i = 0; i < data.length; i++) {
                        if(onload == 0) {
                            html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
                        } else if(onload == 1) {
                            if(data[i].st_id == <?=$st_y?>) {
                                html += '<option value="' + data[i].st_id + '" selected>' + data[i].st_title + '</option>';
                            } else {
                                html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
                            }
                        } else if(onload == 2) {
                            if(data[i].st_id == <?=$st_n?>){
                                html += '<option value="' + data[i].st_id + '" selected>' + data[i].st_title + '</option>';
                            } else {
                                html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
                            }
                        }
                    }
                    element.html(html);
                    element.chosen();
                },
                error: function(){
                    console.log('error');
                }
            });
        }

        function loadDiseases(element) {
            var html = '<option value="">(เหลือก)</option>';
            $.ajax({
                url: './api/api_disease.php',
                type: 'POST',
                data: {getDiseases: 1},
                success: function(data){
                    var data = JSON.parse(data);
                    for (var i = 0; i < data.length; i++) {
                        if(data[i].ds_id == <?=$ds_id?>) {
                            html += '<option value="' + data[i].ds_id + '" selected>' + data[i].ds_name + '</option>';
                        } else {
                            html += '<option value="' + data[i].ds_id + '">' + data[i].ds_name + '</option>';
                        }
                    }
                    element.html(html);
                },
                error: function(){
                    console.log('error');
                }
            });
        }
    });
</script>
