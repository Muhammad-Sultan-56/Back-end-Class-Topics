<?php  

session_start();
require_once "db_con.php";



$sel_sql = "SELECT * FROM user_data WHERE id='$_SESSION[user_id]' ";
$exists = mysqli_query($con, $sel_sql);


$row = mysqli_fetch_assoc($exists);

if ($row['role'] == 0 || $_SESSION['login'] == false) {
    header("location: login-form.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Usres</title>
        <!-- Bootstrap link -->
        <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
    <script src="./Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
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

               

                $sel_sql = "SELECT * FROM user_data ";
                $exists = mysqli_query($con, $sel_sql);


                if (mysqli_num_rows($exists) > 0) {
                    while ($row = mysqli_fetch_assoc($exists)) {;



                ?>

                        <tr>
                            <th scope="row"><?= $row['id'] ?></th>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><a href="" class="btn btn-warning btn-sm">Edit</a>
                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                <?php }
                } ?>
</body>

</html>