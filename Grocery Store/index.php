<!DOCTYPE html>
<html lang="zxx">

<head>

    <title>Ogani | Template</title>

    <!-- css links include -->
    <?php require_once("./includes/css-links.php") ?>
</head>

<body>

    <!-- header-section include -->
    <?php require_once("./includes/header.php") ?>

    <?php

    // get category 

    $categories = getCategories($con);

    $products = getProducts($con);
    ?>

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php while ($row = mysqli_fetch_assoc($categories)) {
                    ?>
                        <!-- make categories dynamic -->
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="<?php echo getImageUrl("categories", $row['image'])  ?>">
                                <h5><a href="#"><?= $row['category'] ?></a></h5>
                            </div>
                        </div>

                    <?php }
                    mysqli_data_seek($categories, 0);  ?>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>

                            <?php while ($ct = mysqli_fetch_assoc($categories)) {
                            ?>
                                <li data-filter=".<?= $ct['category'] ?>"><?= $ct['category'] ?></li>
                            <?php   } ?>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="row featured__filter">
                <!-- get products from database dynamically -->
                <?php while ($pt = mysqli_fetch_assoc($products)) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges <?php $ptc = getCategroyById($con, $pt['category_id']);
                                                                        echo $ptc['category'] ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="<?php echo getImageUrl("product", $pt['image']) ?>">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="product-details.php?id=<?= $pt['id'] ?>"><?= $pt['name'] ?></a></h6>
                                <h5>$<?= $pt['unit_price'] ?></h5>
                            </div>
                        </div>
                    </div>

                <?php  } ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- footer includes -->
    <?php require_once("./includes/footer.php")  ?>

    <!-- js links includes -->

    <?php require_once("./includes/javascript-links.php") ?>

</body>

</html>