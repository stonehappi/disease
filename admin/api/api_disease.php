<?php

require_once("../../config.php");

if(isset($_POST['getDiseases'])) {
    $sql = "SELECT * FROM `diseases`";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['getDiseaseById'])) {
    $ds_id = $_POST['ds_id'];
    $sql = "SELECT * FROM `diseases` WHERE `ds_id`='{$ds_id}'";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['getDiseaseDetail'])) {
    $ds_id = $_POST['ds_id'];
    $sql = "SELECT * FROM `diseases` WHERE `ds_id`='{$ds_id}'";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['ds_insert_btn'])) {
    $ds_name = checker($_POST['ds_name']);
    $ds_detail = checker($_POST['ds_detail']);
    $sql = "INSERT INTO `diseases` (`ds_name`, `ds_detail`) VALUES ('{$ds_name}', '{$ds_detail}')";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        echo $sql;
        die("Insert fail");
    } else {
        header("location:../index.php");
    }
}

if(isset($_POST['ds_update_btn'])) {
    $ds_id = $_POST['ds_id'];
    $ds_name = checker($_POST['ds_name']);
    $ds_first_que = $_POST['ds_first_que'];
    $ds_detail = checker($_POST['ds_detail']);
    $sql = "UPDATE `diseases` SET `ds_name`='{$ds_name}', `ds_first_que`='{$ds_first_que}', `ds_detail`='{$ds_detail}' WHERE `ds_id`='{$ds_id}'";
    $query = mysqli_query($db, $sql);
    
    if(!$query) {
        die("Update fail");
    } else {
        header("location:../index.php");
    }
}

if(isset($_GET['dDiseases'])) {
    $ds_id = $_GET['ds_id'];
    $sql = "DELETE FROM `diseases` WHERE `ds_id`='{$ds_id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Delete fail");
    } else {
        header("location:../index.php");
    }
}