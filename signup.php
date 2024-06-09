<?php
require_once("./config.php");
if(isset($_POST['signin_btn'])) {
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['u_pass'];
    $sql = "SELECT * FROM `admins` WHERE `u_email` = '{$u_email}' AND `u_pass` = '{$u_pass}'";
    $query = mysqli_query($db, $sql);
    if(mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['u_id'] = $row['u_id'];
        header('location:./admin');
    } else {
        $a_f_signin = 1;
        header("location:./index.php?a_f_signin=1");
    }
}


?>
