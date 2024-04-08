<?php
require_once("./db_con.php");

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST['signup'] === "submit") {

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);


    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 0;

    // verify username should be unique
    $select_q = "SELECT * FROM user_data WHERE username='$username' ";
    $result = mysqli_query($con, $select_q);

    if (mysqli_num_rows($result)  === 1) {
        die("$username is already registered");
    }
    // insert
    $sql = "INSERT INTO user_data (`username`, `email`, `password` , `role`) VALUES('$username', '$email', '$password' , '$role') ";

    if (mysqli_query($con, $sql)) {

        header("Location:signup-form.php");
    }
}
