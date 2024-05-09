<?php


// get categories from databse
function getCategories($con)
{
    $select_category = "SELECT * FROM categories";
    $select_category_run =  mysqli_query($con, $select_category);
    return $select_category_run;
}


// get categories by id
function  getCategroyById($con, $id)
{
    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($con, $sql);
    $categroy = mysqli_fetch_assoc($result);
    return $categroy;
}

// function for image path
function getImageUrl($folder, $image)
{
    return "admin/images/$folder/$image";
}



// get products from database 
function getProducts($con, $category = null, $id = null)
{
    // get all products
    $sql = "SELECT * FROM products LIMIT 8 ";

    // with id
    if ($category != null) {
        $sql .= "WHERE category = '$category' ";
    }

    // with id and category
    if ($id != null && $category != null) {
        $sql .= "AND id = '$id' ";
    } else if ($id != null && $category == null) {
        $sql .= "WHERE id = '$id' ";
    }

    $result = mysqli_query($con, $sql);

    //@todo  check if products are null then return false or null

    return $result;
}
