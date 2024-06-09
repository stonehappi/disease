<?php
require_once("../config.php");
$advice_active = true;

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
                    <div class="panel-heading"> เพิ่มคำแนะนำ</div>
                    <form class="panel-body" method="POST" action="./api/api_advice.php">
                        <div class="form-group">
                            <label for="av_body">เนื้อหา</label>
                            <textarea type="text" class="form-control" id="av_body" name="av_body"></textarea>
                        </div>
                        <button type="submit" id="av_btn" class="btn btn-block btn-success" name="av_insert_btn">เพิ่มคำแนะนำ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
</body>

</html>
