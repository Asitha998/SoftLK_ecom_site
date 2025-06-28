<?php require "connection.php";
session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="nouislider.min.css"> -->

    <link rel="icon" href="resource/logoWolf.png">
</head>

<body class="main-body">

    <div class="container-fluid ">
        <div class="row bg-black bg-opacity-10">

            <div class="d-none d-lg-block header0" style="position: fixed;" id="header0-large"></div>

            <div class="d-block d-lg-none header0" id="header0-small"></div>

            <div class="col-12" style="width: 100vw;" id="basicSearchResult">
                <div class="row">

                    <!-- Sliders -->

                    <div class="col-12" style="width: 100vw;">
                        <div class="row">

                            <div id="carouselExampleIndicators" class="col-12 carousel slide" data-bs-ride="true" style="width: 100vw;">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                </div>
                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <img src="slider images/3.png" class=" poster-img-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="slider images/1.png" class="d-block poster-img-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="slider images/2.png" class="d-block poster-img-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="slider images/5.png" class="d-block poster-img-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="slider images/4.png" class="d-block poster-img-1">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- Sliders -->

                    <div class="col-12">
                        <div class="row">

                            <div class="d-none d-lg-block col-lg-3">
                                <div class="row p-3">
                                    <div class="col-12 bg-white bg-opacity-10 rounded p-3">
                                        <h3 class="text-white-50 fw-bold mb-3">Find By</h3>

                                        <div class="d-none bg-black bg-opacity-25 rounded p-2 mb-2" id="activefilterbox">
                                            <div class="row">
                                                <h4 class="col-8 text-white-50 fw-bold">Active Filters</h4>
                                                <div class="col-4 text-white-50 text-end"><a class="btn text-decoration-none bg-danger bg-opacity-50 text-white-50" onclick="clearfilters(); loadProductsByCat(0,0,'All Games');">Clear</a></div>
                                            </div>

                                            <ul class="">
                                                <li class="headerItem text-white-50"><a class="headerText text-white">Min(LKR) :</a><span class="fs-5" id="minvalue">0</span>.00</li>
                                                <li class="headerItem text-white-50"><a class="headerText text-white">Max(LKR) :</a><span class="fs-5" id="maxvalue">0</span>.00</li>
                                            </ul>
                                        </div>

                                        <div class="bg-black bg-opacity-25 rounded p-2 mb-2">
                                            <h4 class="text-white-50 fw-bold">Categories</h4>
                                            <ul class="">

                                                <li class="headerItem"><a class="headerText text-white" onclick="loadProductsByCat(0,0,'All Games');">All</a></li>
                                                <?php

                                                $c_rs = Database::search("SELECT * FROM `category`");
                                                $c_num = $c_rs->num_rows;

                                                for ($a = 0; $a < $c_num; $a++) {
                                                    $cdata = $c_rs->fetch_assoc();
                                                ?>

                                                    <li class="headerItem"><a class="headerText text-white" onclick="loadProductsByCat(0,'<?php echo $cdata['id']; ?>','<?php echo $cdata['category_name']; ?>');"><?php echo $cdata["category_name"]; ?></a></li>

                                                <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>

                                        <hr class="text-white-50">

                                        <div class="bg-black bg-opacity-25 rounded p-2 mb-2">
                                            <h4 class="text-white-50 fw-bold">Brands</h4>
                                            <ul class="">

                                                <li class="headerItem"><a class="headerText text-white" onclick="loadProductsByBrand(0,0,'All Games');">All</a></li>
                                                <?php

                                                $b_rs = Database::search("SELECT * FROM `brand`");
                                                $b_num = $b_rs->num_rows;

                                                for ($a = 0; $a < $b_num; $a++) {
                                                    $bdata = $b_rs->fetch_assoc();
                                                ?>

                                                    <li class="headerItem"><a class="headerText text-white" onclick="loadProductsByBrand(0,'<?php echo $bdata['id']; ?>','<?php echo $bdata['brand_name']; ?>');"><?php echo $bdata["brand_name"]; ?></a></li>

                                                <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>

                                        <hr class="text-white-50">

                                        <div class="bg-black bg-opacity-25 rounded p-2 mb-2">
                                            <h4 class="text-white-50 fw-bold">Filter by price</h4>

                                            <div class="double-slider-box">
                                                <div class="range-slider">
                                                    <span class="slider-track"></span>
                                                    <input type="range" name="min_val" class="min-val" min="2500" max="35000" value="2500" oninput="slideMin()">
                                                    <input type="range" name="max_val" class="max-val" min="2500" max="35000" value="35000" oninput="slideMax()">
                                                    <div class="tooltip min-tooltip"></div>
                                                    <div class="tooltip max-tooltip"></div>
                                                </div>
                                                <div class="input-box">
                                                    <div class="min-box">
                                                        <div class="input-wrap">
                                                            <span class="input-addon">$</span>
                                                            <input type="text" name="min_input" class="input-field min-input" onchange="setMinInput()">
                                                        </div>
                                                    </div>
                                                    <div class="max-box">
                                                        <div class="input-wrap">
                                                            <span class="input-addon">$</span>
                                                            <input type="text" name="max_input" class="input-field max-input" onchange="setMaxInput()">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="input-group mb-3 mt-3">
                                                <span class="input-group-text border border-0 bg-white bg-opacity-25 text-white" id="basic-addon1">Min</span>
                                                <input type="numfmt_format_currency" class="form-control border border-0 bg-white bg-opacity-10 text-white" value="00" aria-label="Username" aria-describedby="basic-addon1" id="minpr">
                                                <span class="text-white-50 fw-bold fs-5 mx-2">-</span>
                                                <span class="input-group-text border border-0 bg-white bg-opacity-25 text-white" id="basic-addon1">Max</span>
                                                <input type="numfmt_format_currency" class="form-control border border-0 bg-white bg-opacity-10 text-white" value="5000" aria-label="Username" aria-describedby="basic-addon1" id="maxpr"><br>

                                            </div> -->
                                            <button class="col-4 offset-8 btn bg-success bg-opacity-25 text-white mb-2" onclick="setfilters();">Set Filters</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-9 border-2 border-0 border-start border-white border-opacity-25 mt-3">

                                <!-- Category names -->

                                <div class="col-12 mb-3 px-3 d-flex">
                                    <a class="text-decoration-none text-white-50 fw-bold fs-3" style="margin-right: auto;" id="cate">All Games (Recent)</a>&nbsp;&nbsp;

                                </div>

                                <!-- Category names -->

                                <!-- Products -->

                                <div class="col-12 mb-3" id="productbox">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="row justify-content-center gap-2">

                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id` WHERE `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 10");
                                                $product_num = $product_rs->num_rows;

                                                $product_rs2 = Database::search("SELECT `product`.`id` AS `product_id` FROM `product` INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id` WHERE `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 10");

                                                for ($z = 0; $z < $product_num; $z++) {
                                                    $product_data = $product_rs->fetch_assoc();
                                                    $product_data2 = $product_rs2->fetch_assoc();

                                                ?>

                                                    <div class="card col-6 col-lg-2 mt-2 mb-2 bg-light bg-opacity-25 border-0 cd" style="width: 18rem; ">

                                                        <?php

                                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data2["product_id"] . "' ");
                                                        $image_data = $image_rs->fetch_assoc();

                                                        ?>
                                                        <div class="card-body ms-0 m-0">

                                                            <span class="text-white-50 fs-6"><?php echo $product_data["brand_name"]; ?></span>
                                                            <h5 class="card-title text-white"><?php echo $product_data["title"]; ?></h5>

                                                            <div class="align-content-center justify-content-center" style="height: 250px;">
                                                                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" style="max-height: 100%;">
                                                            </div>

                                                            <span class="card-text text-white fs-4 fw-bold mb-3 me-1"><span class="fs-6 fw-light">LKR</span><?php echo $product_data["price"]; ?>.00</span>

                                                            <?php

                                                            if ($product_data["qty"] > 0) {

                                                            ?>
                                                                <a type="button" class="btn btn-success ms-5 rounded-circle" href='<?php echo "singleProductView.php?id=" . $product_data2["product_id"] ?>' data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Buy Now"><i class="bi bi-bag-check fs-6"></i></a><br>
                                                                <hr class="text-white-50 mb-1">
                                                                <button class="btn bg-transparent text-white-50 fs-5 fw-bold" onclick="addToCart(<?php echo $product_data2['product_id']; ?>);">Add to cart <i class="bi bi-cart2"></i>+&nbsp;&nbsp;<span class="text-white-50 fw-light fs-5">|</span></button>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <span class="badge text-white text-bg-danger fw-bold mb-2">Out of Stock</span><br>
                                                                <hr class="text-white-50 mb-1">
                                                                <span class="btn bg-transparent disabled border-0 text-white fs-5">Add to wishlist</span>
                                                                <?php

                                                            }

                                                            if (isset($_SESSION["u"])) {

                                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data2['product_id'] . "' AND 
                                                            `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                                $watchlist_num = $watchlist_rs->num_rows;

                                                                if ($watchlist_num == 1) {
                                                                ?>
                                                                    <button class="btn bg-transparent rounded-circle" onclick='addToWatchlist(<?php echo $product_data2["product_id"]; ?>);'>
                                                                        <i class="bi bi-heart-fill text-danger" id='heart<?php echo $product_data2["product_id"]; ?>'></i>
                                                                    </button>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button class="btn bg-transparent rounded-circle" onclick='addToWatchlist(<?php echo $product_data2["product_id"]; ?>);'>
                                                                        <i class="bi bi-heart-fill text-white" id='heart<?php echo $product_data2["product_id"]; ?>'></i>
                                                                    </button>
                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                        </div>

                                        <div class="col-12 text-center">
                                            <a class="text-decoration-none text-white-50 fs-6" style="cursor: pointer;" onclick="loadProductsByCat(0,0,'All Games');">View all Games</a>
                                        </div>

                                    </div>
                                </div>

                                <!-- Products -->
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script>
        function loadHeader() {
            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (window.innerWidth >= 992) {
                        document.getElementById("header0-large").innerHTML = this.responseText;
                    } else {
                        document.getElementById("header0-small").innerHTML = this.responseText;
                    }
                }
            };
            x.open("GET", "header.php", true);
            x.send();
        }

        loadHeader();

        window.onresize = function() {
            loadHeader();
        };

        // document.addEventListener("DOMContentLoaded", function() {
        //     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        //     var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        //         return new bootstrap.Tooltip(tooltipTriggerEl);
        //     });
        // });

        window.addEventListener("scroll", function() {
            var header = document.getElementById("header0-large");
            header.classList.toggle("sticky", window.scrollY > 0);
        });

        window.addEventListener("scroll", function() {
            var header = document.getElementById("header0-small");
            header.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>

    <script src="script.js"></script>
    <!-- <script src="bootstrap.js"></script> -->
    <script src="bootstrap.bundle.min.js"></script>
    <!-- <script src="nouislider.js"></script> -->
</body>

</html>