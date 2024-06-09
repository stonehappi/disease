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
                    <div class="panel-heading"> อาการ <a href="./add_symptom.php" class="label label-success">เพิ่มอาการ</a></div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th>ชื่ออาการ</th>
                                <th width="90px">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_ds = "SELECT * FROM `diseases`";
                            $query_ds = mysqli_query($db, $sql_ds);
                            $index_ds = 1;
                            if (mysqli_num_rows($query_ds) > 0) {
                                while($row_ds = mysqli_fetch_assoc($query_ds)) {
                                    echo '
                                    <tr class="success">
                                        <th>'. $index_ds.'</th>
                                        <th colspan="2">'. $row_ds['ds_name'] .'</th>
                                    </tr>
                                    ';
                                    
                                    $sql = "SELECT * FROM `symptoms` WHERE `ds_id`=".$row_ds['ds_id'];
                                    $query = mysqli_query($db, $sql);
                                    $index_st = 1;
                                    if (mysqli_num_rows($query) > 0) {
                                        while($row = mysqli_fetch_assoc($query)) { ?>
                                            <tr>
                                                <td><?=$index_ds.'.'.$index_st?></td>
                                                <td><a href="#" onClick="openModalDetail(<?=$row['st_id']?>)"><?=$row['st_title']?></a></td>
                                                <td>
                                                    <a href="./edit_symptom.php?st_id=<?=$row['st_id']?>" class="label label-primary">แก้ไข</a>
                                                    <a href="./api/api_symptom.php?dSymptom=true&st_id=<?=$row['st_id']?>" class="label label-danger">ลบ</a>
                                                </td>
                                            </tr>
                                        <?php
                                            $index_st++;
                                        }
                                    } else {
                                        echo '<tr><td align="center" colspan="3">ไม่มีรายการอาการ</td></tr>';
                                    }
                                    $index_ds++;
                                }
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
<!-- form Modal -->
<!-- <div class="modal fade" id="symptomModal" role="dialog" aria-labelledby="SymptomModal">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="POST" action="./api/api_symptom.php">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="st_title_lb"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" id="st_id" name="st_id">
                <label for="st_title">อาการ</label>
                <textarea type="text" class="form-control" id="st_title" name="st_title" required autofocus></textarea>
            </div>
            <div class="form-group">
                <label for="st_y">คำตอบใช่</label>
                <select class="form-control" id="st_y" name="st_y"></select>
            </div>
            <div class="form-group">
                <label for="st_n">คำตอบไม่ใช่</label>
                <select class="form-control" id="st_n" name="st_n"></select>
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
        </div>
        <div class="modal-footer">
            <button type="submit" id="st_btn" class="btn btn-sm"></button>
      </div>
    </form>
  </div>
</div> -->

<!-- <script>
    $(document).ready(function () {

        var st_title_lb = $("#st_title_lb");
        var st_action_form = $("#st_action_form");
        var st_id = $("#st_id");
        var st_title = $("#st_title");
        var st_y = $("#st_y");
        var st_n = $("#st_n");
        var ds_id = $("#ds_id");
        var st_isAns = $("#st_isAns");
        var st_btn = $("#st_btn");
        
        
        // openModal = function(id) {
        //     if(id) {
        //         st_title_lb.text("แก้ไขอาการ");
        //         st_id.val(id);
                
        //         $.ajax({
        //             url: './api/api_symptom.php',
        //             type: 'POST',
        //             data: {getSymptomById: 1, st_id: id},
        //             success: function(data){
        //                 var data = JSON.parse(data);
        //                 st_title.val(data[0].st_title);
        //                 loadSymptom(st_y, data[0].st_y);
        //                 loadSymptom(st_n, data[0].st_n);
        //                 loadDiseases(ds_id, data[0].ds_id);
        //                 if(data[0].st_isAns==1)
        //                     st_isAns.prop( "checked", true );
        //                 else st_isAns.prop( "checked", false );
        //             }
        //         });

        //         st_btn.text("บันทึก");

        //         if(st_btn.hasClass("btn-success"))
        //             st_btn.removeClass("btn-success");
        //         st_btn.addClass("btn-primary");
        //         st_btn.attr("name","st_update_btn");
        //     } else {
        //         st_title_lb.text("เพิ่มอาการ");
        //         st_id.val("");
        //         loadSymptom(st_y);
        //         loadSymptom(st_n);
        //         loadDiseases(ds_id);
        //         st_isAns.prop("checked", false);
        //         st_btn.text("เพิ่ม");

            
        //         if(st_btn.hasClass("btn-primary"))
        //             st_btn.removeClass("btn-primary");
        //         st_btn.addClass("btn-success");
        //         st_btn.attr("name","st_insert_btn");
        //     }
        //     $("#symptomModal").modal({backdrop:'static', keyboard:true});
        // }

        // loadSymptom = function(element, id = null) {
        //     var html = '<option value="">(เหลือก)</option>';
        //     $.ajax({
        //         url: './api/api_symptom.php',
        //         type: 'POST',
        //         data: {getSymptoms: 1},
        //         success: function(data){
        //             var data = JSON.parse(data);
        //             for (var i = 0; i < data.length; i++) {
        //                 if(id) {
        //                     if(data[i].st_id == id)
        //                         html += '<option value="' + data[i].st_id + '" selected>' + data[i].st_title + '</option>';
        //                     else html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
        //                 }
        //                 else html += '<option value="' + data[i].st_id + '">' + data[i].st_title + '</option>';
        //             }
        //             element.html(html);
        //         },
        //         error: function(){
        //             console.log('error');
        //         }
        //     });
        // }

        // loadDiseases = function(element, id = null) {
        //     var html = '<option value="">(เหลือก)</option>';
        //     $.ajax({
        //         url: './api/api_disease.php',
        //         type: 'POST',
        //         data: {getDiseases: 1},
        //         success: function(data){
        //             var data = JSON.parse(data);
        //             for (var i = 0; i < data.length; i++) {
        //                 if(id) {
        //                     if(data[i].ds_id == id)
        //                         html += '<option value="' + data[i].ds_id + '" selected>' + data[i].ds_name + '</option>';
        //                     else html += '<option value="' + data[i].ds_id + '">' + data[i].ds_name + '</option>';
        //                 }
        //                 else html += '<option value="' + data[i].ds_id + '">' + data[i].ds_name + '</option>';
        //             }
        //             element.html(html);
        //         },
        //         error: function(){
        //             console.log('error');
        //         }
        //     });
        // }
    });
</script> -->
