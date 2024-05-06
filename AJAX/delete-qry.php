<?php

require_once "./config.php";

$id = $_POST['id'];

$sql = "DELETE FROM `users` WHERE `id`='$id'";

if (mysqli_query($db_con, $sql)) {
    echo 1;
} else {
    0;
}
