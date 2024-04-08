<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup</title>
    <!-- Bootstrap link -->
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
    <script src="./Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="row m-0 my-5">
        
        <div class="col-lg-4 col-md-5 col-sm-7 p-5 mx-auto shadow">
            <form method="POST" action="./signup_qry.php">
                <h3 class="text-center">Signup Form</h3>
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter here...">
                </div>

                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter here...">
                </div>

                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter here..." name="password" id="exampleInputPassword1">
                </div>


                <button type="submit" name="signup" class="btn btn-primary d-block w-100 mx-auto" value="submit">Submit</button>

                <p class="mt-3">Already Registered? <a href="login-form.php" class="text-decoration-none">Login Now</a></p>

            </form>
        </div>
    </div>
</body>

</html>