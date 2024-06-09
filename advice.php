<?php
require_once("./config.php");
if(!isset($_GET['av_id'])){
    header('location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./sections/head.php");?>

<body>
    <?php require_once("./sections/navbar.php");?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top:5%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">คำแนอนำ</h3>
                    </div>
                    <div class="panel-body">
                    <?php
                        $sql = "SELECT * FROM `advices` WHERE `av_id` = ". $_GET['av_id'];
                        $query = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_assoc($query)){
                            $body = $row['av_body'];
                        }
                        echo html_entity_decode($body);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
$(document).ready(function(){
        
    openModal = function(id) {
        
        $.ajax({
            url: 'admin/api/api_disease.php',
            type: 'POST',
            data: {getDiseaseDetail: 1, ds_id: id},
            success: function(data){
                data = JSON.parse(data);
                $('#title').text('รายละเอียด ' + data[0].ds_name);
                $('#detail').html(data[0].ds_detail);
                $('#detailModal').modal();
            }
        });
        
    }
});

</script>

</html>
<div class="modal fade" id="detailModal" role="dialog" aria-labelledby="SymptomModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" method="POST" action="./api/api_symptom.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">รายละเอียด</h4>
            </div>
            <div class="modal-body">
                <p id="detail"></p>
            </div>
        </div>
    </div>
</div>