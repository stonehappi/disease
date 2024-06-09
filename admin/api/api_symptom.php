<?php

require_once("../../config.php");

if(isset($_POST['getSymptoms'])) {
    $ds_id = $_POST['ds_id'];
    $sql = "SELECT * FROM `symptoms` WHERE ds_id = $ds_id";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['getSymptomById'])) {
    //echo "id ". $_POST['st_id'];
    $st_id = $_POST['st_id'];
    $sql = "SELECT * FROM `symptoms` WHERE `st_id`='{$st_id}'";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['getSymptomByDiseaseId'])) {
    $ds_id = $_POST['ds_id'];
    $sql = "SELECT * FROM `symptoms` WHERE `ds_id`='{$ds_id}'";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['st_insert_btn'])) {
    $st_title = checker($_POST['st_title']);
    $st_y = $_POST['st_y'];
    $st_n = $_POST['st_n'];
    $st_isAns = isset($_POST['st_isAns']) ? 1 : 0;
    if($st_isAns == 1) {
        $st_y = 0;
        $st_n = 0;
        $url = $_POST['url'];
    } else {
        $url = "#";
    }
    $ds_id = $_POST['ds_id'];
    $sql = "INSERT INTO `symptoms` (`st_title`, `st_y`, `st_n`, `st_isAns`, `ds_id`, `url`) VALUES ('{$st_title}', '{$st_y}', '{$st_n}', '{$st_isAns}', '{$ds_id}', '{$url}')";
    echo $sql;
    $query = mysqli_query($db, $sql);
    if(!$query) {
        echo $sql;
        die("Insert fail");
    } else {
        header("location:../symptom.php");
    }
}

if(isset($_POST['st_update_btn'])) {
    $st_id = $_POST['st_id'];
    $st_title = checker($_POST['st_title']);
    $st_y = $_POST['st_y'];
    $st_n = $_POST['st_n'];
    $st_isAns = isset($_POST['st_isAns']) ? 1 : 0;
    if($st_isAns == 1) {
        $st_y = 0;
        $st_n = 0;
        $url = $_POST['url'];
    } else {
        $url = "#";
    }
    $ds_id = $_POST['ds_id'];
    $sql = "UPDATE `symptoms` SET `st_title`='{$st_title}', `st_y`='{$st_y}', `st_n`='{$st_n}', `st_isAns`='{$st_isAns}', `ds_id`='{$ds_id}', `url` = '{$url}' WHERE `st_id`='{$st_id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Update fail");
    } else {
        header("location:../symptom.php");
    }
}

if(isset($_GET['dSymptom'])) {
    $st_id = $_GET['st_id'];
    $sql = "DELETE FROM `symptoms` WHERE `st_id`='{$st_id}'";
    echo $sql;
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Delete fail");
    } else {
        header("location:../symptom.php");
    }
}