<?php
require_once("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./sections/head.php");?>

<body>
    <?php require_once("./sections/navbar.php");?>
    <div class="container">
        <?=isset($_GET['a_c_pass']) ? '<div class="alert alert-danger" role="alert">Register fail! Password and Confirm Password not match!!!</div>' : ''?>
        <?=isset($_GET['a_s_signup']) ? '<div class="alert alert-success" role="alert">Register success! Please sign in!!!</div>' : ''?>
        <?=isset($_GET['a_f_signin']) ? '<div class="alert alert-danger" role="alert">Sign in fail! Please try again!!!</div>' : ''?>
        <?=isset($_GET['a_c_test']) ? '<div class="alert alert-success" role="alert">ส่งแบบสอบถามสำเร็จแล้ว!!!</div>' : ''?>
        <div class="row">
            <div id="section" class="col-md-8 col-md-offset-2"> <!-- คนมีอาการอะไร? -->
                <div class="">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active "><a href="#diseases" aria-controls="signup" role="tab" data-toggle="tab">คนมีอาการอะไร?</a></li>
                        <li role="presentation" class="<?= isset($_SESSION['u_id'])? 'hidden' : ''?>"><a href="#signin" aria-controls="signin" role="tab" data-toggle="tab">Sign In</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="diseases">
                            <ul class="list-group">
                                <?php
                                $sql = "SELECT * FROM `diseases`";
                                $query = mysqli_query($db, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                                        echo '<li class="list-group-item"><a href="#" onclick="openModal(' . $row['ds_id'] . ')" class="label label-primary">รายละเอียด</a><a href="analysis.php?ds_id=' . $row['ds_id'] . '" class="label label-success">วินิจฉัยเบื้องต้น</a> ' . $row['ds_name'] . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="signin">
                            <div class="panel-body bg-dark">
                                <form method="post" action="./signup.php">
                                    <div class="form-group">
                                        <label for="u_mail">Email address</label>
                                        <input type="email" class="form-control" id="mail" name="u_email" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_pass">Password</label>
                                        <input type="password" class="form-control" id="pass" name="u_pass" placeholder="Password" required>
                                    </div>
                                    <button type="submit" name="signin_btn" class="btn btn-info btn-block">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding-top: 20px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">การสังเกตอาการ ออฟฟิตซินโดรม</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-inf" width="10%">ระดับของอาการ</th>
                                <th class="bg-inf" width="40%">การสังเกตอาการ</th>
                                <th class="bg-inf" width="50%">แนวทางแก้ใข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ระดับที่ 1</td>
                                <td>อาการเกิดขึ้น เมื่อทำงานไประยะหนึ่ง พักแล้วดีขึ้นทันที่</td>
                                <td>
                                    <ul>
                                        <li>พักสลับทำงานเป็ฯระยะๆ</li>
                                        <li>ยืืดกล้ามเนื้อเพี่อผ่อนคล้าย</li>
                                        <li>นวดผ่อนคล้าย</li>
                                        <li>ออกกำลังกาย</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>ระดับที่ 2</td>
                                <td>อาการเกิดขึ้น พักนอนหลับแล้ว แต่ยังคงมีอาการอยู่</td>
                                <td>
                                    <ul>
                                        <li>ปรับเปลี่ยนพฤติกรรมการทำงาน</li>
                                        <li>รับการรักษาที่ถูกต้อง</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>ระดับที่ 3</td>
                                <td>อาการปวดมากแม้ทำงานเพียงเบาๆ พักแล้วอาการก็ยังไม่ทุเลาลง</td>
                                <td>
                                    <ul>
                                        <li>พักงาน ปรับเปลี่ยนงาน</li>
                                        <li>รับการรักษาที่ถูกต้อง</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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