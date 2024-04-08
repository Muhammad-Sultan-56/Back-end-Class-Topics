<?php
    require_once "db_con.php";

    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['login'] == "submit") {

        $username = $_POST['username'];
        $password = $_POST['password'];

       // verify inputs are correct ?

       if($username == "" || $password == ""){
        die("all fields are required");
       }

        // verify user is exist ?
        $sel_sql = "SELECT * FROM user_data WHERE username='$username' ";
        $exists = mysqli_query($con, $sel_sql);

        if(mysqli_num_rows($exists) === 0 ) {
            die("invalid credentials");
        }

        // if user exists then verify its password is correct ?
        $user = mysqli_fetch_assoc($exists);

        if(password_verify($password, $user['password']) === false) {
            die("invalid credentials");
        }

        session_start();

        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];

        header("Location:profile.php");

    }