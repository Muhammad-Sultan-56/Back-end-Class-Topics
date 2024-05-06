<?php

require_once "./config.php";

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

$sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname' WHERE `id`='$id'";

if (mysqli_query($db_con, $sql)) {
    echo 1;
} else {
    0;
}
