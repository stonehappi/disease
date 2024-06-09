<?php

require_once("../../config.php");

if(isset($_POST['getHerbs'])) {
    $sql = "SELECT * FROM `herbs`";
    $query = mysqli_query($db, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['getHerbById'])) {
    $data = array();
    $h_id = $_POST['h_id'];
    $sql = "SELECT * FROM `herbs` WHERE `h_id`='{$h_id}'";
    if($query = mysqli_query($db, $sql)) {
        if(mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
    } else {
        echo $sql;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE );
}

if(isset($_POST['h_insert_btn'])) {
    $h_name = checker($_POST['h_name']);
    $h_nickname = checker($_POST['h_nickname']);
    $h_benefit = checker($_POST['h_benefit']);
    $sql = "INSERT INTO `herbs` (`h_name`, `h_nickname`, `h_benefit`) VALUES ('{$h_name}', '{$h_nickname}', '{$h_benefit}')";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        echo $sql;
        die("Insert fail");
    } else {
        header("location:../index.php");
    }
}

if(isset($_POST['h_update_btn'])) {
    $h_id = $_POST['h_id'];
    $h_name = checker($_POST['h_name']);
    $h_nickname = checker($_POST['h_nickname']);
    $h_benefit = checker($_POST['h_benefit']);
    $sql = "UPDATE `herbs` SET `h_name`='{$h_name}', `h_nickname`='{$h_nickname}', `h_benefit`='{$h_benefit}' WHERE `h_id`='{$h_id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Update fail");
    } else {
        header("location:../index.php");
    }
}

if(isset($_GET['dHerb'])) {
    $h_id = $_GET['h_id'];
    $sql = "DELETE FROM `herbs` WHERE `h_id`='{$h_id}'";
    $query = mysqli_query($db, $sql);
    if(!$query) {
        die("Delete fail");
    } else {
        header("location:../index.php");
    }
}