<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wishlist| SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

    <link rel="icon" href="resource/logoWolf.png">
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            if (isset($_SESSION["u"])) {
            ?>

                <div class="col-12" id="basicSearchResult">
                    <div class="row bg-black bg-opacity-10">

                        <div class="col-12 pt-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                        </div>

                        <div class="col-12 border border-3 border-dark border-opacity-25 rounded mb-2">
                            <div class="row">

                                <div class="col-12">
                                    <label class="col-3 form-label fs-1 fw-bolder text-white">Wishlist ❤️</label>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <hr>
                                </div>

                                <div class="col-12 col-lg-8 offset-lg-2">
                                    <div class="row">
                                        <div class="input-group bg-white bg-opacity-25 srch">
                                            <input type="text" class="form-control bg-transparent border border-0 text-white outline" placeholder="Search in Wishlist" aria-label="Text input with dropdown button" id="basic_search_txt">
                                            <button class="btn bg-transparent" onclick="basicSearch(0);"><i class="bi bi-search fs-4 Scurser text-white"></i></button>
                                            <!-- <a href="advanceSearch.php" class="link-secondary text-decoration-none fw-bold">Advance Search</a> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>
                                <?php
                                $user = $_SESSION["u"]["email"];

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12" style="min-height: 40vh;">
                                        <div class="row">
                                            <div class="col-12"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold text-white-50">Wishlist is Empty</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-outline-dark text-white-50 fs-5 fw-bold">Browse the Latest Games now!</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                <?php

                                } else {
                                ?>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watch_num; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                $seller_data = $seller_rs->fetch_assoc();
                                                $seller = $seller_data["fname"] . " " . $seller_data["lname"];


                                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id`='" . $product_data["brand_id"] . "'");
                                                $brand_data = $brand_rs->fetch_assoc();
                                                $brand = $brand_data["brand_name"];

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $image_data = $image_rs->fetch_assoc();
                                                $image_path = $image_data["code"];

                                            ?>
                                                <!-- have Products -->
                                                <div class="card mb-3 mx-0 mx-lg-2 col-12 bg-light bg-opacity-50 border-0 shadow">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php

                                                            ?>
                                                            <img src="<?php echo ($image_path); ?>" class="img-fluid rounded" style="max-width: 200px;">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $product_data["title"]; ?></h5>
                                                                <span class="fs-5 fw-bold text-black-50">Console : <?php echo $brand ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black-50">Type : <?php if ($product_data["type_id"] == 1) {
                                                                                                                    echo ("Digital key");
                                                                                                                } else {
                                                                                                                    echo ("DVD");
                                                                                                                } ?></span><br>

                                                                <span class="fs-5 fw-bold text-black-50">Price : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo ($product_data["price"]); ?> .00</span><br>
                                                                <span class="fs-5 fw-bold text-black-50">Quantity : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"] ?> Items Available</span><br>
                                                                <span class="fs-5 fw-bold text-black-50">Seller : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo ($seller) ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a class="btn btn-outline-success mb-2" href='<?php echo "singleProductView.php?id=" . $product_data["id"] ?>'>Buy now</a>
                                                                <a class="btn btn-outline-warning mb-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add To Cart</a>
                                                                <a class="btn btn-outline-danger mb-2" onclick='removeFromWatchlist(<?php echo $watch_data["id"] ?>);'>Remove <i class="bi bi-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- have Products -->
                                        <?php

                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                header("location:home.php");
            }

            ?>

            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>