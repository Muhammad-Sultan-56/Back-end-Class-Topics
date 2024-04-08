<?php
session_start();
require_once "db_con.php";

if (!isset($_SESSION['login'])  || $_SESSION['login'] == false) {
    header("location: login-form.php");
}

$sel_sql = "SELECT * FROM user_data WHERE id='$_SESSION[user_id]' ";
$exists = mysqli_query($con, $sel_sql);


$row = mysqli_fetch_assoc($exists);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <!-- Bootstrap link -->
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
    <script src="./Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!--============= Navbar Start ========= -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sessions in <span class="text-primary">PHP</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- username -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <h5>Welcome <span class="text-primary me-4"> <?= $row['username'] ?></span></h5>
                </ul>

                <!-- logout btn -->
                <a href="./logout.php" class="btn btn-primary btn-sm"> Logout</a>

                <?php 
                
                if($row['role'] == 1){
                    echo "                
                    <a href='all-users.php' class='btn btn-primary btn-sm mx-3'> All Usrs</a>
                    ";
                }
                ?>

            </div>
        </div>
    </nav>

    <!--============= Navbar End  ========= -->

    <div class="container my-3">
        <h3>Registered Users</h3>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php

                // connection with database
                // require_once("./db_con.php");
                // $user_id = $_SESSION['user_id'];

                // $select_q = "SELECT * FROM emails where user_id=$user_id";
                // $result = mysqli_query($con, $select_q);

                // if (mysqli_num_rows($result) > 0) {

                //     while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <th scope="row"><?= $row['id'] ?></th>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><a href="" class="btn btn-warning btn-sm">Edit</a>
                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                
                
            </tbody>
        </table>
    </div>

</body>

</html>