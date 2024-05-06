<!DOCTYPE html>
<html lang="en">

<head>
    <title>Insert Query</title>
    <!-- bootstrap links -->
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-75 shadow mx-auto mt-5 p-4">

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
        <div class="row my-4">
            <div class="col-md-12">
                <div class="d-flex my-2 justify-content-between align-items-center">
                    <h3 class="w-50">View All <span class='text-primary'> User</span></h3>
                    <input type="search" id="search" class="form-control w-50" placeholder="Search here...">
                </div>
                <hr>
                <!-- get data in table from ajax -->
                <div id="get_data">

                </div>


            </div> <!--col -->
        </div> <!--row -->



        <!-- modal with edit form -->

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- edit form in modal  -->
                        <form>
                            <input type="hidden" id="editId">
                            <div class="mb-3">
                                <label for="editFname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFname">
                            </div>

                            <div class="mb-3">
                                <label for="editLname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="editLname">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="updateBtn" class="btn btn-primary">Save changes</button>
                    </div>

                    </form>
                    <!-- form end -->
                </div>
            </div>
        </div>



        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- delete id form in modal  -->
                    <form>
                        <div class="modal-body text-end">
                            <input type="hidden" id="deleteId">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="deleteBtn" class="btn btn-danger">Delete</button>
                        </div>
                </div>

                </form>
                <!-- form end -->
            </div>
        </div>
    </div>


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
                    }) //insert ajax closing

                }

            }) // button click closing



            // show data from database in the table
            function loadData(query = null) {
                $.ajax({
                    url: "./select-qry.php",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(res) {
                        $("#get_data").html(res);
                    }
                }) // loadData ajax
            }

            loadData();


            // search function
            $("#search").on("keyup", function() {
                let searchText = $(this).val();
                loadData(searchText);
            })


            // edit form function of ajax by id
            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id")
                $.ajax({
                    url: "./single-record-qry.php",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        let data = JSON.parse(res)
                        // console.log(data.fname)

                        $("#editFname").val(data.fname);
                        $("#editLname").val(data.lname);
                        $("#editId").val(data.id);

                        $("#editModal").modal("show")
                    }
                }) // edit ajax 

            })


            // update query when information changed in modal
            $("#updateBtn").on("click", function() {

                if ($("#editFname").val() == "" || $("#editLname").val() == "") {
                    // run when empty inputs submited
                    $("#error").html("<b>Warning! </b> All fields are required....!").show();
                    setTimeout(() => {
                        $(".msg").hide();
                    }, 3000)
                    $("#editModal").modal("hide")

                } else {
                    $.ajax({
                        url: "update-qry.php",
                        type: "POST",
                        data: {
                            id: $("#editId").val(),
                            fname: $("#editFname").val(),
                            lname: $("#editLname").val(),
                        },
                        success: function(res) {
                            // run when query is successfully run
                            if (res == 1) {
                                $("#success").html("<b>Congratulations! </b> Operation Performed successfully....!").show();
                                setTimeout(() => {
                                    $(".msg").hide();
                                }, 3000)

                                $("#editModal").modal("hide")

                            } else {
                                // run when query is not run
                                $("#error").html("<b>Warning! </b> Something went wrong....!").show();
                                setTimeout(() => {
                                    $(".msg").hide();
                                }, 3000)
                                $("#editModal").modal("hide")
                            }
                            loadData()
                        }
                    }) //update ajax
                }
            })





            // get data form to delete function of ajax by id
            $(document).on("click", ".deleteBtn", function() {
                let id = $(this).data("id")

                $.ajax({
                    url: "./single-record-qry.php",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        let data = JSON.parse(res);

                        $("#deleteId").val(data.id);
                        $("#deleteModal").modal("show")
                    }
                }) // edit ajax 

            })



            // delete query when information is deleted
            $("#deleteBtn").on("click", function() {

                $.ajax({
                    url: "delete-qry.php",
                    type: "POST",
                    data: {
                        id: $("#deleteId").val(),

                    },
                    success: function(res) {
                        // run when query is successfully run
                        if (res == 1) {
                            $("#success").html("<b>Congratulations! </b> Operation Performed successfully....!").show();
                            setTimeout(() => {
                                $(".msg").hide();
                            }, 3000)

                            $("#deleteModal").modal("hide")

                        } else {
                            // run when query is not run
                            $("#error").html("<b>Warning! </b> Something went wrong....!").show();
                            setTimeout(() => {
                                $(".msg").hide();
                            }, 3000)
                            $("#deleteModal").modal("hide")
                        }
                        loadData()
                    }
                }) //update ajax

            })





        }) //document.ready closing
    </script>

</body>

</html>