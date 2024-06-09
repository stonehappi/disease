<?php
require_once("../config.php");
$symptom_active = true;

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
                    <div class="panel-heading"> เพิ่มอาการ</div>
                    <form class="panel-body" method="POST" action="./api/api_symptom.php">
                        <div class="form-group">
                            <label for="st_title">อาการ</label>
                            <textarea type="text" class="form-control" id="st_title" name="st_title" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ds_id">อยู่ในโรคใด</label>
                            <select class="form-control" id="ds_id" name="ds_id" required></select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="st_isAns" name="st_isAns"> เป็นคำตอบสุดท้าย
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="st_title">คำแนะนำ(URL)</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="http://example.com"/>
                        </div>
                        <div class="form-group">
                            <label for="st_y">คำตอบใช่</label>
                            <select class="form-control chosen" id="st_y" name="st_y"></select>
                        </div>
                        <div class="form-group">
                            <label for="st_n">คำตอบไม่ใช่</label>
                            <select class="form-control" id="st_n" name="st_n"></select>
                        </div>
                        <button type="submit" id="st_btn" class="btn btn-block btn-success" name="st_insert_btn">เพิ่มอาการ</button>
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
        url.prop('disabled', true);
        
        loadDiseases(ds_id);
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
            loadSymptom(st_y);
            loadSymptom(st_n);
        });
        

        openModal = function(id) {
            if(id) {
                st_title_lb.text("แก้ไขอาการ");
                st_id.val(id);
                
                $.ajax({
                    url: './api/api_symptom.php',
                    type: 'POST',
                    data: {getSymptomById: 1, st_id: id},
                    success: function(data){
                        var data = JSON.parse(data);
                        st_title.val(data[0].st_title);
                        loadDiseases(ds_id, data[0].ds_id);
                        loadSymptom(st_y, data[0].st_y);
                        loadSymptom(st_n, data[0].st_n);
                        if(data[0].st_isAns==1)
                            st_isAns.prop( "checked", true );
                        else st_isAns.prop( "checked", false );
                    }
                });

                st_btn.text("บันทึก");

                if(st_btn.hasClass("btn-success"))
                    st_btn.removeClass("btn-success");
                st_btn.addClass("btn-primary");
                st_btn.attr("name","st_update_btn");
            } else {
                st_title_lb.text("เพิ่มอาการ");
                st_id.val("");
                loadSymptom(st_y);
                loadSymptom(st_n);
                loadDiseases(ds_id);
                st_isAns.prop("checked", false);
                st_btn.text("เพิ่ม");

            
                if(st_btn.hasClass("btn-primary"))
                    st_btn.removeClass("btn-primary");
                st_btn.addClass("btn-success");
                st_btn.attr("name","st_insert_btn");
            }
            $("#symptomModal").modal({backdrop:'static', keyboard:true});
        }

        function loadSymptom(element) {
            var html = '<option value="">(เหลือก)</option>';
            $.ajax({
                url: './api/api_symptom.php',
                type: 'POST',
                data: {getSymptoms: 1, ds_id : ds_id.val()},
                success: function(data){
                    var data = JSON.parse(data);
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
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
                        html += '<option value="' + data[i].ds_id + '">' + data[i].ds_name + '</option>';
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
