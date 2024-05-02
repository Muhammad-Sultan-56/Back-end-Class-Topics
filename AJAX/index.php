<!DOCTYPE html>
<html lang="en">

<head>
    <title>Insert Query</title>
    <!-- bootstrap links -->
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-75 shadow mx-auto mt-5 p-5">

        <h3 class=" p-1 mb-2">Add <span class="text-primary"> User</span> Information</h3>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <!-- alert for success -->
                <div class="alert alert-success alert-dismissible fade show msg" id="success" role="alert" style="display: none;">

                </div>
                <!-- alert for error -->
                <div class="alert alert-danger alert-dismissible fade show msg" id="error" role="alert" style="display: none;">
                </div>
            </div>
        </div>

        <!-- form to get data from user -->
        <div class="row ">
            <div class="col-md-4 px-3 mt-2">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control  mb-3" id="fname" placeholder="Enter here..." />
            </div>

            <div class="col-md-4 px-3 mt-2">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control mb-3" id='lname' placeholder="Enter here..." />
            </div>

            <div class="col-md-4 mt-3 mx-auto">
                <label class="form-label"></label>
                <input type="submit" id="send" class="btn btn-primary w-100" name="submit" value="Submit" />
            </div>
        </div>

        <!-- Show Data in table -->
        <div class="row my-3">
            <div class="col-md-12">

                <!-- get data in table from ajax -->
                <div id="get_data">

                </div>


            </div> <!--col -->
        </div> <!--row -->
    </div> <!--container -->


    <!-- js links -->
    <script src="./Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./jquery/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {

            var btn = $("#send");

            // insert data function 
            btn.click(function() {
                var fname = $("#fname").val();
                var lname = $("#lname").val();

                if (fname == "" || lname == "") {
                    // run when empty inputs submited
                    $("#error").html("<b>Warning! </b> All fields are required....!").show();
                    setTimeout(() => {
                        $(".msg").hide();
                    }, 3000)
                } else {

                    // send data on insert qry page
                    $.ajax({
                        url: "./insert-qry.php",
                        type: "POST",
                        data: {
                            firstName: fname,
                            lastName: lname
                        },
                        success: function(response) {

                            // show alerts base on success / error
                            if (response == 1) {
                                // run when data inserted in database successfully
                                $("#success").html("<b>Congratulations! </b> Operation Performed successfully....!").show();
                                setTimeout(() => {
                                    $(".msg").hide();
                                }, 3000)

                            } else if (response == 0) {
                                // run when data is not inserted in database
                                $("#error").html("<b>Warning! </b> Something went wrong....!").show();
                                setTimeout(() => {
                                    $(".msg").hide();
                                }, 3000)
                            }
                            // empty input after insertion
                            $("#fname").val("");
                            $("#lname").val("");
                            loadData();
                        }
                    }) //ajax closing

                }

            }) // button click closing


            // show data from database in the table
            function loadData() {
                $.ajax({
                    url: "./select-qry.php",
                    type: "POST",
                    success: function(res) {
                        $("#get_data").html(res);
                    }
                })
            }

            loadData();



            // edit form function of ajax by id



        }) //document.ready closing
    </script>

</body>

</html>