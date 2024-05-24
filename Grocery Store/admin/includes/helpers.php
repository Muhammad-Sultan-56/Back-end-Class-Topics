<?php

function uploadImage($targetDir, $file, $size, $direct)
{
    $targetDir = "images/$targetDir/";
    $newName   = time() . $file['name'];

    $data = ['errors' => false, 'result' => null];

    $max_size = $size * 1024 * 1024;
    $types = ['image/jpg', 'image/png', 'image/jpeg'];

    // print_r($file);
    // exit;

    if ($file['error'] === 0) {

        if ($file['size'] > $max_size) {
            $_SESSION['imgErr'] = "Image size is too large";
            header("Location:$direct.php");
            exit;
        }

        // check image extension
        if (in_array($file['type'], $types) === false) {
            $_SESSION['imgErr'] = "Image size is too large";
            header("Location:$direct.php");
            exit;
        }

        if (move_uploaded_file($file['tmp_name'], $targetDir . $newName) == true) {
            $data['errors'] = false;
            $data['result'] = $newName;
            return $data;
        }
    } else {

        $_SESSION['imgErr'] = "something went wrong";
        header("Location:$direct.php");
    }

    return $data;
}


function pp($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
}


// get order of customer
function getOrderByCustomer($con, $id)
{
    $sql = "SELECT * FROM orders WHERE customer_id = $id AND status = 'pending' ";
    $result = mysqli_query($con, $sql);
    $order = mysqli_fetch_assoc($result);
    return $order;
}

// create new order
function createOrder($con, $customer_id, $product, $qty)
{
    $total_price = $product['unit_price'] * $qty;

    $order_sql = "INSERT INTO `orders` (`id`, `customer_id`, `grand_total`, `status`) VALUES (NULL, $customer_id, $total_price, 'pending') ";
    mysqli_query($con, $order_sql);

    // get last order id
    $order_id = mysqli_insert_id($con);

    // create products / items
    $pid = $product['id'];
    $uprice = $product['unit_price'];

    $item_sql = "INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `unit_price`, `quantity`, `total_price`) VALUES (NULL, $order_id, $pid, $uprice, $qty, $total_price) ";
    mysqli_query($con, $item_sql);

    return $order_id;
}

// update order with products
function updateOrder($con, $order, $product, $qty)
{
    $order_id = $order['id'];
    $pid = $product['id'];
    $uprice = $product['unit_price'];
    $total_price = $product['unit_price'] * $qty;

    $item_sql = "INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `unit_price`, `quantity`, `total_price`) VALUES (NULL, $order_id, $pid, $uprice, $qty, $total_price) ";
    mysqli_query($con, $item_sql);

    return $order_id;
}
