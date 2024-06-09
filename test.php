<?php
require_once("./config.php");
if(isset($_POST['insert_test'])) {
    $t_1 = checker($_POST['q1']);
    $t_2 = checker($_POST['q2']);
    if($t_2 == 1) {
        $t_2 = checker($_POST['txt_q2']);
    }
    $t_3 = checker($_POST['q3']);
    $t_4 = checker($_POST['q4']);
    $t_5 = checker($_POST['q5']);
    $t_6 = checker($_POST['q6']);
    if($t_6 == 1) {
        $t_6 = checker($_POST['txt_q6']);
    }
    $t_7 = checker($_POST['q7']);
    $t_8 = checker($_POST['q8']);
    $t_9 = checker($_POST['q9']);
    if($t_9 == 1) {
        $t_9 = checker($_POST['txt_q9']);
    }
    $t_10 = checker($_POST['q10']);
    if($t_10 == 1) {
        $t_10 = checker($_POST['txt_q10']);
    }
    $t_11 = checker($_POST['q11']);
    $t_12 = checker($_POST['q12']);
    $t_13 = checker($_POST['q13']);

    $sql = "INSERT INTO testing VALUE (null, '{$t_1}', '{$t_2}', '{$t_3}', '{$t_4}', '{$t_5}', '{$t_6}', '{$t_7}', '{$t_8}', '{$t_9}', '{$t_10}', '{$t_11}', '{$t_12}', '{$t_13}')";
    if(mysqli_query($db, $sql)) {
        header('location: ./index.php?a_c_test=1');
    } else {
        echo $sql;
        die();
    }
}
$test_active = 1;

?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once("./sections/head.php");?>
    <body>
        <?php require_once("./sections/navbar.php");?>

            <form class="container" method="post">
                <h1>แบบสอบถามศึกษาพฤติกรรมผู้บริโภค เกี่ยวกับโรคออฟฟิศซินโดรม</h1>
                <table class="table" style="">
                    <tbody>
                        <tr class="success"><th class="text-center" colspan="6">ข้อมูลส่วนตัว</th></tr>
                        <tr class="info"><th colspan="6">1. เพศ *</th></tr>
                        <tr class="active">
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q1" value="ชาย" required> ชาย</label></div></td>
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q1" value="หญิง"> หญิง</label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">2. อาชีพ *</th></tr>
                        <tr class="active">
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q2" value="พนักงานเอกชน" required> พนักงานเอกชน</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q2" value="ข้าราชการ"> ข้าราชการ</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q2" value="1" id="qq2"> อื่นๆ (โปรดระบุ)<input name="txt_q2" id="txt_q2" type="text"/></label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">3. รายได้ *</th></tr>
                        <tr class="active">
                            <td><div class="radio"><label><input type="radio" name="q3" value="ต่ำกว่า 10,000" required> ต่ำกว่า 10,000</label></div></td>
                            <td><div class="radio"><label><input type="radio" name="q3" value="10,000 - 14,999"> 10,000 - 14,999</label></div></td>
                            <td><div class="radio"><label><input type="radio" name="q3" value="15,000 - 19,999"> 15,000 - 19,999</label></div></td>
                            <td><div class="radio"><label><input type="radio" name="q3" value="20,000 - 24,999"> 20,000 - 24,999</label></div></td>
                            <td><div class="radio"><label><input type="radio" name="q3" value="25,000 - 30,000"> 25,000 - 30,000</label></div></td>
                            <td><div class="radio"><label><input type="radio" name="q3" value="30,000 ขึ้นไป"> 30,000 ขึ้นไป</label></div></td>
                        </tr>
                        <tr class="success"><th class="text-center" colspan="6">สภาพแวดล้อมการทำงาน</th></tr>
                        <tr class="info"><th colspan="6">4. คอมพิวเตอร์ที่ใช้ทำงานของคุณเป็นแบบใด *</th></tr>
                        <tr class="active">
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q4" value="โน๊ตบุ้ค (ไม่ต้องตอบข้อ 5)" required> โน๊ตบุ้ค (ไม่ต้องตอบข้อ 5)</label></div></td>
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q4" value="คอมพิวเตอร์ PC"> คอมพิวเตอร์ PC</label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">5. เก้าอี้นั่งทำงานของคุณเป็นแบบใด *</th></tr>
                        <tr class="active">
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q5" value="มีที่วางแขน" required> มีที่วางแขน</label></div></td>
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q5" value="ไม่มีที่วางแขน"> ไม่มีที่วางแขน</label></div></td>
                        </tr>
                        <tr class="success"><th class="text-center" colspan="6">พฤติกรรมการนั่งทำงาน</th></tr>
                        <tr class="info"><th colspan="6">6. ปกติคุณนั่งทำงานติดต่อกันนานแค่ไหนจึงจะพัก *</th></tr>
                        <tr class="active">
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q6" value="1 - 2 ชั่วโมง" required> 1 - 2 ชั่วโมง</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q6" value="3 - 4 ชั่วโมง"> 3 - 4 ชั่วโมง</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q6" value="1" id="qq6"> อื่นๆ (โปรดระบุจำนวนเวลา)<input name="txt_q6" id="txt_q6" type="text"/></label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">7. ระดับความสูงของจอคอมพิวเตอร์ ขณะนั่งทำงานของคุณเป็นแบบใด *</th></tr>
                        <tr class="active">
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q7" value="อยู่พอดีกับระดับสายตา" required> อยู่พอดีกับระดับสายตา</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q7" value="สูงกว่าระดับสายตา"> สูงกว่าระดับสายตา</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q7" value="ต่ำกว่าระดับสายตา"> ต่ำกว่าระดับสายตา</label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">8. ระดับความสูงของเก้าอี้ทำงานของคุณ เป็นแบบใด *</th></tr>
                        <tr class="active">
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q8" value="นั่งแล้วเท้าลอยจากพื้น" required> นั่งแล้วเท้าลอยจากพื้น</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q8" value="นั่งแล้วเท้าแตะพื้นเล็กน้อย"> นั่งแล้วเท้าแตะพื้นเล็กน้อย</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q8" value="นั่งแล้วเท้าสัมผัสพื้นทั้งเท้าได้พอดี"> นั่งแล้วเท้าสัมผัสพื้นทั้งเท้าได้พอดี</label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">9. ส่วนใหญ่คุณนั่งทำงานท่าไหน *</th></tr>
                        <tr class="active">
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q9" value="นั่งขัดสมาธิ" required> นั่งขัดสมาธิ</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q9" value="นั่งไขว่ห้าง"> นั่งไขว่ห้าง</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q9" value="นั่งเหยียดขา"> นั่งเหยียดขา</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q9" value="นั่งห้อยขา"> นั่งห้อยขา</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q9" value="1" id="qq9"> อื่นๆ (โปรดระบุ)<input type="text" id="txt_q9" name="txt_q9"></label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">10. ขณะนั่งทำงาน ส่วนใหญ่คุณวางแขนอย่างไร *</th></tr>
                        <tr class="active">
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q10" value="วางแขนบนที่วางแขนของเก้าอี้" required> วางแขนบนที่วางแขนของเก้าอี้</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q10" value="วางแขนบนโต๊ะทำงาน"> วางแขนบนโต๊ะทำงาน</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q10" value="วางแขนบนคีย์บอร์ด"> วางแขนบนคีย์บอร์ด</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q10" value="1" id="qq10"> อื่นๆ (โปรดระบุ)<input type="text" id="txt_q10" name="txt_q10"/></label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">11. คุณมีอาการปวดเมื่อยจากการนั่งทำงานหรือไม่ *</th></tr>
                        <tr class="active">
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q11" value="มี" required> มี</label></div></td>
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q11" value="ไม่มี (ข้ามไปตอบข้อ 15)"> ไม่มี (ข้ามไปตอบข้อ 15)</label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">12. คุณให้ความสำคัญโรคออฟฟิศซินโดรมระดับไหน *</th></tr>
                        <tr class="active">
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q12" value="สำคัญมาก ต้องใส่ใจ" required> สำคัญมาก ต้องใส่ใจ</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q12" value="สำคัญ"> สำคัญ</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q12" value="เฉยๆ"> เฉยๆ</label></div></td>
                            <td colspan="1"><div class="radio"><label><input type="radio" name="q12" value="ไม่ค่อยสำคัญ"> ไม่ค่อยสำคัญ</label></div></td>
                            <td colspan="2"><div class="radio"><label><input type="radio" name="q12" value="ไม่สำคัญเลย"> ไม่สำคัญเลย</label></div></td>
                        </tr>
                        <tr class="info"><th colspan="6">13. หากมีอุปกรณ์ที่สามารถป้องกัน หรือบรรเทาอาการปวดโรคออฟฟิศซินโดรมได้ คุณสนใจหรือไม่ *</th></tr>
                        <tr class="active">
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q13" value="สนใจ" required> สนใจ</label></div></td>
                            <td colspan="3"><div class="radio"><label><input type="radio" name="q13" value="ไม่สนใจ"> ไม่สนใจ</label></div></td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" name="insert_test" class="btn btn-block btn-success" value="ส่งแบบสอบถาม">
            </form>
    </body>

</html>

<script>
    $(document).ready(function () {
        $('#qq2').change(function(){
            alert('asdf');
            if($('#qq2').is(':checked')) {
                $('#txt_q2').prop('required', true);
            } else {
                $('#txt_q2').prop('required', false);
            }
        });

        $('#qq6').change(function(){
            if($('#qq6').is(':checked')) {
                $('#txt_q6').prop('required', true);
            } else {
                $('#txt_q6').prop('required', false);
            }
        });

        $('#qq9').change(function(){
            if($('#qq9').is(':checked')) {
                $('#txt_q9').prop('required', true);
            } else {
                $('#txt_q9').prop('required', false);
            }
        });

        $('#qq10').change(function(){
            if($('#qq10').is(':checked')) {
                $('#txt_q10').prop('required', true);
            } else {
                $('#txt_q10').prop('required', false);
            }
        });
    });
</script>