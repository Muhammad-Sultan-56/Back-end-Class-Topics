<?php

include("config.php");


$query = (isset($_GET['query']) && !empty($_GET['query'])) ? trim($_GET['query']) : null;

$select_qry = "SELECT * FROM `users` ";



// for pagination  get page from the function

$page = $_GET['page'];
$limit = 3;
$offset = ($page - 1) * $limit;

if ($query !== null) {
    $select_qry .= " WHERE lname LIKE '%" . $query . "%' OR fname LIKE '%" . $query . "%' ";
}

$select_qry .= " LIMIT $limit OFFSET $offset";

$result = mysqli_query($db_con, $select_qry);

$html = "<table class='table table-striped table-hover'>";
$html .= "<thead> <tr>";
$html .= "<th>#</th>";
$html .= "<th>First Name</th>";
$html .= "<th>Last Name</th>";
$html .= "<th>Actions</th>";
$html .= "</tr></thead>";
$html .= "<tbody>";

$sr = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr>";
    $html .= "<td> $sr </td>";
    $html .= "<td> $row[fname] </td>";
    $html .= "<td> $row[lname] </td>";
    $html .= "<td><button  class='btn btn-warning btn-sm mx-2 editBtn' data-id='$row[id]'>Edit</button>";
    $html .= "<button  class='btn btn-danger btn-sm mx-2 deleteBtn' data-id='$row[id]'>Delete</button> </td>";
    $html .= "</tr>";
    $sr++;
}

$html .= "</tobdy></table>";

// total records in numbers
$total_records = "SELECT COUNT(*) as total FROM users  ";


if ($query !== null) {
    $total_records .= " WHERE lname LIKE '%" . $query . "%' OR fname LIKE '%" . $query . "%' ";
}

$result2 = mysqli_query($db_con, $total_records);
$totals = mysqli_fetch_array($result2);

$total_pages = ceil($totals['total'] / $limit);

$html .= "<nav> <ul class='pagination pagination-sm'>";

for ($i = 1; $i <= $total_pages; $i++) {
    if ($page == $i) {
        $html .= "<li class='page-item active'><a class='page-link page' href='#' data-page=" . $i . ">" . $i . "</a></li>";
    } else {
        $html .= "<li class='page-item'><a class='page-link page' href='#' data-page=" . $i . ">" . $i . "</a></li>";
    }
}

$html .= "</ul></nav>";

echo $html;
