<?php
require_once("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once("./sections/head.php");?>
    <body>
    <?php require_once("./sections/navbar.php");?>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="margin-top:15%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" id="ds_name"></h3>
                        </div>
                        <div class="panel-body">
                            <h4 id="st_q"></h4>
                            <a type="button" id="btn_n" class="btn btn-danger">ไม่ใช่</a>
                            <a type="button" id="btn_y" class="btn btn-success pull-right">ใช่</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>    
    $(document).ready(function () {
        var ds_name = $("#ds_name");
        var st_q = $("#st_q");
        var btn_y = $("#btn_y");
        var btn_n = $("#btn_n");
        var ds_id_val = '<?=$_GET['ds_id']?>';
        
        $.ajax({
            url: './admin/api/api_disease.php',
            type: 'POST',
            data: {getDiseaseById: 1, ds_id: ds_id_val},
            success: function(data){
                var data = JSON.parse(data);
                ds_name.text(data[0].ds_name);
                loadQue(data[0].ds_first_que);
            },
            error: function(){
                console.log('error');
            }
        });

        loadQue = function(req_id) {
            if(req_id==0){
                st_q.html('<u>ไม่มีคำตอบ</u>');
                $(".panel-body").addClass("bg-danger");
                btn_n.hide();
                btn_y.text("BACK");
                btn_y.attr("href", "./");
                return;
            }
            $.ajax({
                url: './admin/api/api_symptom.php',
                type: 'POST',
                data: {getSymptomById: 1, st_id: req_id},
                success: function(data){
                    var data = JSON.parse(data);
                    st_q.text(data[0].st_title +" ?");
                    if(data[0].st_isAns==1){
                        st_q.html('<u>คำตอบ</u>: '+data[0].st_title);
                        st_q.after('<a href="'+data[0].url+'">คำแนะนำ</a>')
                        $(".panel-body").addClass("bg-success");
                        btn_n.hide();
                        btn_y.text("BACK");
                        btn_y.attr("href", "./");
                    } else{
                        btn_y.attr("onClick", "loadQue("+data[0].st_y+")");
                        btn_n.attr("onClick", "loadQue("+data[0].st_n+")");
                    }
                },
                error: function(){
                    console.log('error');
                }
            });
        }
       
    });
</script>