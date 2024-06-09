<?php

require_once("../../config.php");


if(isset($_POST['av_insert_btn'])) {
    $av_body = checker($_POST['av_body']);
    $sql = "INSERT INTO `advices` ( `av_body`) VALUES ('{$av_body}')";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        echo $sql;
        die("Insert fail");
    } else {
        header("location:../advice.php");
    }
}

if(isset($_POST['av_update_btn'])) {
    $av_id = $_POST['av_id'];
    $av_body = checker($_POST['av_body']);
    $sql = "UPDATE `advices` SET `av_body`='{$av_body}' WHERE `av_id`='{$av_id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        echo $sql;
        die("Update fail");
    } else {
        header("location:../advice.php");
    }
}

if(isset($_GET['dAdvice'])) {
    $av_id = $_GET['av_id'];
    $sql = "DELETE FROM `advices` WHERE `av_id`='{$av_id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Delete fail");
    } else {
        header("location:../advice.php");
    }
}