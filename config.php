<?php
session_start();
$db = mysqli_connect("localhost", "root","","herb") or die("Connect database fail!");
mysqli_set_charset($db,"utf8");
function checker($field) {
    global $db;
    return (htmlentities(trim(mysqli_real_escape_string($db, $field))));
}
