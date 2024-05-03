<?php

include("config.php");

$query = (isset($_GET['query']) && !empty($_GET['query'])) ? trim($_GET['query']) : null;

$select_qry = "SELECT * FROM `users` ";

if ($query !== null) {
    $select_qry .= " WHERE fname OR lname LIKE '%" . $query . "%'";
}

$result = mysqli_query($db_con, $select_qry);

$html = "<table class='table table-striped table-hover'>";
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
    $html .= "<td><button  class='btn btn-warning btn-sm mx-2 editBtn' data-id='$row[id]'>Edit</button>";
    $html .= "<button  class='btn btn-danger btn-sm mx-2'>Delete</button> </td>";
    $html .= "</tr>";
}

$html .= "</tobdy></table>";

echo $html;
