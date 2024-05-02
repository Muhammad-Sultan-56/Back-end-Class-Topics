<?php

include("config.php");


$qry = "SELECT * FROM `users`";
$result = mysqli_query($db_con, $qry);

$html = "<h3 class=1 p-1 mb-2'>View All <span class='text-primary'> User</span></h3> <hr>";
$html .= "<table class='table table-striped table-hover'>";
$html .= "<thead> <tr>";
$html .= "<th>#</th>";
$html .= "<th>First Name</th>";
$html .= "<th>Last Name</th>";
$html .= "<th>Actions</th>";
$html .= "</tr></thead>";
$html .= "<tbody>";

while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr>";
    $html .= "<td> $row[id]";
    $html .= "<td> $row[fname]";
    $html .= "<td> $row[lname]";
    $html .= "<td><button  class='btn btn-warning btn-sm mx-2' data-id=$row[id]>Edit</button>";
    $html .= "<button  class='btn btn-danger btn-sm mx-2'>Delete</button> </td>";
    $html .= "</tr>";
}

$html .= "</tobdy></table>";

echo $html;
