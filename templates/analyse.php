<?php
require_once("../config.php");
$analyse_active = true;

if(isset($_POST['analyse_insert_btn'])) {
    $ds_id = $_POST['ds_id'];
    $st_id = $_POST['st_id'];
    $sql = "INSERT INTO `analyses` (`ds_id`, `st_id`) VALUES ('{$ds_id}', '{$st_id}')";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        echo $sql;
        die("Insert fail");
    }
}

if(isset($_GET['dAnalyse'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `analyses` WHERE `id`='{$id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Delete fail");
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
            <div class="col-md-3 col-lg-2">
                <?php require_once("./sections/aside.php"); ?>
            </div>
            <div class="col-md-9 col-lg-10">
                <div class="panel panel-info">
                    <div class="panel-heading"> การวิเคราะห์</div>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
                    $sql = "SELECT * FROM `diseases`";
                    $query = mysqli_query($db, $sql);
                    $index = 1;
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) {                             
                    ?>
                        <div class="panel panel-warning">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$row['ds_id']?>" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        #<?=$index . " " . $row['ds_name']?>
                                    </a>
                                    <p class="pull-right">
                                        <a href="#" onClick="openModal(<?=$row['ds_id']?>)" class="label label-success">เพิ่มอาการ</a>
                                    </p>
                                </h4>
                                </div>
                                <div id="collapse<?=$row['ds_id']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                
                                <?php
                                $sub_sql = "SELECT `id`, `st_name` FROM `analyses` INNER JOIN `symptoms` ON `analyses`.`st_id` = `symptoms`.`st_id` WHERE `analyses`.`ds_id` = ". $row['ds_id'];
                                $sub_query = mysqli_query($db, $sub_sql);
                                if (mysqli_num_rows($sub_query) > 0) {
                                    echo '<ul class="list-group">';
                                    while($sub_row = mysqli_fetch_assoc($sub_query)) {
                                        echo 
                                        '
                                        <li class="list-group-item">' . $sub_row['st_name'] . '<p class="pull-right"><a href="' . $_SERVER['PHP_SELF'] .'?dAnalyse=true&id='. $sub_row['id'].'" class="label label-danger">ลบอาการ</a></p></li>
                                        ';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo '<div class="panel-body">ไม่รายการอาการ</div>';
                                }
                                ?>
                                
                            </div>
                        </div>
                    <?php
                            $index++;
                        }
                    } else {
                        echo 'ไม่มีรายการการวิเคราะห์โรค';
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
<!-- Modal -->
<div class="modal fade" id="diseasesModal" role="dialog" aria-labelledby="diseasesModal">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ds_title_lb">เพิ่มอาการ</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" id="ds_id" name="ds_id">
                <label for="st_id">เหลือกอาการ</label>
                <select multiple class="form-control list-group" id="st_id" name="st_id" required>
                    <option class="list-group-item">()</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="ds_btn" class="btn btn-success btn-sm" name="analyse_insert_btn">เพิ่ม</button>
      </div>
    </form>
  </div>
</div>

<script>
    $(document).ready(function () {

        var ds_id = $("#ds_id");
        var sp_select = $("#st_id");

        var data_symptoms;
        
        openModal = function(id) {
            
            ds_id.val(id);

            $.ajax({
                url : './helper.php',
                type : 'POST',
                data : {id:id, getSymptom:true},
                success : function(data){
                    data_symptoms = JSON.parse(data);
                    //console.log(data_symptoms[0].st_name);
                    var html = '<option value="'+ data_symptoms[0].st_id +'" class="list-group-item">'+ data_symptoms[0].st_name +'</option>';
                    for(var i = 1; i < data_symptoms.length; i++) {
                        html += '<option value="'+ data_symptoms[i].st_id +'" class="list-group-item">'+ data_symptoms[i].st_name +'</option>';
                    }
                    sp_select.html(html);
                }
            });
            
            $("#diseasesModal").modal({backdrop:'static'});
        }
    });
</script>
