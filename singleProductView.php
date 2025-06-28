<?php

require "connection.php";

session_start();

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"] ?> | SoftLK</title>

            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="bootstrap-icons.css">

            <link rel="icon" href="resource/logoWolf.png">
        </head>

        <body class="main-body">

            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 bg-black bg-opacity-75 d-none" id="trailer" style="height: 100vh; position: fixed; z-index: 100000;">
                        <div class="row">

                            <div class="offset-10 col-2 d-flex align-content-end justify-content-end">
                                <button class="btn bg-transparent shadow rounded-circle" onclick='trailerView();'>
                                    <i class="bi bi-x-circle-fill text-white fs-2"></i>
                                </button>
                            </div>

                            <div class="col-12 offset-0 offset-lg-2 col-lg-8 d-flex align-item-center py-5" style="height: 87vh;">
                                <iframe width="100%" class="rounded-5" src="<?php echo $product_data['trailer'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </div>

                            <!-- //iframe ek database ekt damm wada karanne nathi case ekk thiynwa URL ek waradi kiynwa ? -->

                        </div>
                    </div>

                    <!-- header -->

                    <div class="col-12 pt-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-12 mt-0 singleProduct">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <!-- <div class="offset-lg-1 col-12 col-lg-3 mb-1">
                                        <div class="row"> -->
                                    <div class="offset-lg-1 col-12 col-lg-3 mb-1 bg-white bg-opacity-25 align-items-center rounded kkkk" style="overflow: hidden;" id="imgBox">
                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;
                                        $image_data = $image_rs->fetch_assoc();

                                        if ($image_num != 0) {
                                        ?>
                                            <img src="<?php echo $image_data["code"] ?>" class="mt-1 mb-1" style="transform-origin: center; object-fit: cover; width: 100%;" id="boxImg" />
                                        <?php

                                        } else {
                                        ?>
                                            <img src="resource/empty.svg" class="mt-1 mb-1" style="width: 100%;" />
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- </div>
                                    </div> -->

                                    <script>
                                        const imgBox = document.getElementById("imgBox");
                                        const img = document.getElementById("boxImg");

                                        // imgBox.addEventListener("mouseenter", () => {
                                        //     img.classList.toggle("Scurser");
                                        // })

                                        imgBox.addEventListener("mousemove", (e) => {
                                            const x = e.clientX - e.target.offsetLeft;
                                            const y = e.clientY - e.target.offsetTop;

                                            img.style.transformOrigin = `${x}px ${y}px`;
                                            img.style.transform = "scale(2)"
                                        })

                                        imgBox.addEventListener("mouseleave", () => {
                                            img.style.transformOrigin = "center";
                                            img.style.transform = "scale(1)"
                                        })
                                    </script>

                                    <div class="col-12 col-lg-7 order-3 bg-white bg-opacity-25 rounded ms-lg-2 mb-1">
                                        <div class="row d-flex">

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-1 text-white fw-bold"><?php echo $product_data["title"] ?></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 my-2 mb-4">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-half text-warning fs-5"></i>
                                                            &nbsp;&nbsp;
                                                            <label class="fs-5 text-dark text-white-50"> 94% 👍 Global users</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id`='" . $product_data["brand_id"] . "'");
                                                $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                <div class="row border-bottom border-2 border-secondary border-opacity-25 pb-lg-4">
                                                    <div class="col-12 my-2">

                                                        <?php

                                                        if ($product_data["category_id"] == 1) {
                                                        ?>
                                                            <span class="fs-4 fw-bold text-black badge text-bg-primary bg-opacity-100"><?php echo $brand_data["brand_name"]; ?></span>
                                                        <?php
                                                        } elseif ($product_data["category_id"] == 2) {
                                                        ?>
                                                            <span class="fs-4 fw-bold text-black badge text-bg-success bg-opacity-100"><?php echo $brand_data["brand_name"]; ?></span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="fs-4 fw-bold text-black badge text-bg-secondary bg-opacity-100"><?php echo $brand_data["brand_name"]; ?></span>
                                                        <?php
                                                        }

                                                        ?>


                                                        <span class="fs-5 text-white">&nbsp;&nbsp;<b class="text-white-50 fs-5">Availability : </b>Only <?php echo $product_data["qty"] ?> items available</span>
                                                    </div>
                                                </div>
                                                <div class="row border-bottom border-2 border-secondary border-opacity-25">
                                                    <div class="col-6 col-lg-4 my-lg-2 border-end border-white border-opacity-25 ps-5">
                                                        <span class="btn bg-transparent disabled border-0 text-white fs-5">Add to wishlist</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                                        <?php
                                                        if (isset($_SESSION["u"])) {

                                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data['id'] . "' AND 
                                                        `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;

                                                            if ($watchlist_num == 1) {
                                                        ?>
                                                                <button class="btn bg-transparent shadow rounded-circle" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-danger" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                                </button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button class="btn bg-transparent shadow rounded-circle" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-white" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                                </button>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <span class="badge text-primary fw-bold mb-2">Please Sign in</span><br>
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>

                                                    <div class="col-6 col-lg-4 my-2 ps-4">
                                                        <?php
                                                        if (isset($_SESSION["u"])) {

                                                            if ($product_data["qty"] > 0) {
                                                        ?>
                                                                <button class="btn bg-transparent text-danger fs-5 fw-bold" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to cart&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-cart2"></i>+<span class="text-white-50 fw-light fs-5"></span></button>
                                                            <?php
                                                            } else {

                                                            ?>
                                                                <span class="badge text-white text-bg-danger fw-bold mb-2">Out of Stock</span><br>
                                                        <?php

                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-12 row">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="col-12 row border-bottom border-2 border-secondary border-opacity-25">
                                                            <div class="col-12 my-2 mb-4">
                                                                <div class="row">
                                                                    <span class="text-white-50 fs-5 mb-2">Delivery cost</span>
                                                                    <span class="ms-3 text-white fs-6">In Colombo : LKR <?php echo $product_data["delivery_fee_colombo"] ?>.00</span>
                                                                    <span class="ms-3 text-white fs-6">Outer Colombo : LKR <?php echo $product_data["delivery_fee_other"] ?>.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 row mt-2 border-bottom border-2 border-secondary border-opacity-25 rounded">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 my-2">
                                                                        <div class="row g-2">
                                                                            <div class="bg-opacity-25 rounded overflow-hidden float-left mt-1 position-relative product-qty shadow">
                                                                                <div class="col-12">
                                                                                    <span class="fs-5 text-white-50">Quantity : </span>
                                                                                    <input type="text" class="border-0 fs-5 fw-bold text-start rounded bg-light bg-opacity-50" readonly style="outline: none;" pattern="[0-9]" value="1" id="qtyInput" onkeyup='checkValue();' />
                                                                                    <div class="position-absolute border-start border-secondary border-opacity-50 qty-buttons">
                                                                                        <div class="justify-content-center d-flex flex-column align-items-center border-bottom border-1 border-secondary border-opacity-50 qty-inc">
                                                                                            <i class="bi bi-caret-up-fill text-primary fs-5" onclick="qty_inc(<?php echo $product_data['qty']; ?>);"></i>
                                                                                        </div>
                                                                                        <div class="justify-content-center d-flex flex-column align-items-center border-top border-1 border-secondary border-opacity-50 qty-dec">
                                                                                            <i class="bi bi-caret-down-fill text-primary fs-5" onclick="qty_dec();"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-2">
                                                            <div class="col-12 my-2">
                                                                <div class="row ps-3">
                                                                    <span class="card-text text-white fs-4 fw-bold mb-3 me-1"><span class="fs-6 fw-light">LKR</span><?php echo $product_data["price"]; ?>.00</span>

                                                                    <div>
                                                                        <?php
                                                                        if (isset($_SESSION["u"])) {

                                                                            $total = 0;

                                                                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                                            $address_date = $address_rs->fetch_assoc();

                                                                            if ($address_date["city_id"] == 1) {

                                                                                $total = $product_data["price"] + $product_data["delivery_fee_colombo"];
                                                                        ?>
                                                                                <div class="col-12 bg-white bg-opacity-10 rounded row mb-3">
                                                                                    <span class="mt-2 ms-3 text-white fs-6">Delivery cost : LKR <?php echo $product_data["delivery_fee_colombo"] ?>.00</span>
                                                                                    <span class="ms-3 mb-2 text-danger fw-bold fs-6">Discounts : 0%</span>
                                                                                    <span class="text-white-50 fs-5 mb-2 fw-bold">Total : LKR <?php echo $total ?></span>
                                                                                </div>
                                                                            <?php
                                                                            } else {

                                                                                $total = $product_data["price"] + $product_data["delivery_fee_other"];

                                                                            ?>
                                                                                <div class="col-12 bg-white bg-opacity-10 rounded row mb-3">
                                                                                    <span class="mt-2 ms-3 text-white fs-6">Delivery cost : LKR <?php echo $product_data["delivery_fee_other"] ?>.00</span>
                                                                                    <span class="ms-3 mb-2 text-danger fw-bold fs-6">Discounts : 0%</span>
                                                                                    <span class="text-white-50 fs-5 mb-2 fw-bold">Total : <?php echo $total ?></span>
                                                                                </div>
                                                                        <?php

                                                                            }
                                                                        }

                                                                        ?>
                                                                    </div>

                                                                    <div class="col-6 my-2 border-end border-2 border-white border-opacity-25 ps-5 pt-2">
                                                                        <button class="col-10 btn btn-success shadow-lg" style="border-radius: 100px;" type="submit" id="payhere-payment" onclick="payNow(<?php echo $product_data['id']; ?>);"><i class="bi bi-bag-check fs-6"></i>&nbsp;&nbsp;&nbsp;Buy Now</button>
                                                                    </div>
                                                                    <div class="col-6 my-2">
                                                                        <span class="btn bg-transparent disabled border-0 text-white fs-5">Watch trailer</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                                                        <button class="btn btn-outline-danger shadow rounded-circle" onclick="trailerView();">
                                                                            <i class="bi bi-play fs-4 text-white"></i>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6 ">
                                                        <div class="col-12 d-flex align-items-center justify-content-center" style="height: 400px;">
                                                            <model-viewer class="col-12" style="height: 100%;" src="3dModels/Controller.glb" ar poster="3dModels/controller.png" 
                                                            shadow-intensity="1" camera-controls touch-action="pan-y" auto-rotate>
                                                            </model-viewer>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 offset-lg-1 col-lg-10 bg-white bg-opacity-25 rounded">
                                <div class="row mt-4 mb-3">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold text-white">Description</span>
                                    </div>

                                    <!-- model viewer -->

                                    <!-- <div class="col-12" style="height:400px;">
                                    <model-viewer style="height: 100%;" 
                                        src="https://modelviewer.dev/assets/ShopifyModels/GeoPlanter.glb" ar 
                                        
                                        poster="https://modelviewer.dev/assets/ShopifyModels/GeoPlanter.webp" 
                                        shadow-intensity="1" camera-controls disable-zoom touch-action="pan-y">
                                    </model-viewer>
                                    </div> -->



                                    <!-- <div class="col-12 sketchfab-embed-wrapper"> <iframe title="{{8*9}} {8*9} "><img/src="x"onerror=prompt(2)>" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/714477ee6a1246aca4c787229043add3/embed?ui_theme=dark"> </iframe> <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;"> <a href="https://sketchfab.com/3d-models/89-89-imgsrcxonerrorprompt2-714477ee6a1246aca4c787229043add3?utm_medium=embed&utm_campaign=share-popup&utm_content=714477ee6a1246aca4c787229043add3" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> {{8*9}} {8*9} "><img/src="x"onerror=prompt(2)> </a> by <a href="https://sketchfab.com/testsssusersss?utm_medium=embed&utm_campaign=share-popup&utm_content=714477ee6a1246aca4c787229043add3" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> {{8*9}} {8*9} ${8*9} </a> on <a href="https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=714477ee6a1246aca4c787229043add3" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a></p></div> -->
                                    <div class="col-12">
                                        <textarea cols="60" rows="15" class="form-control border-0 fs-4 bg-light bg-opacity-25 mb-2" readonly disabled><?php echo $product_data["description"] ?></textarea>

                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;
                                        $img = array();

                                        if ($image_num != 0) {

                                            for ($x = 0; $x < $image_num; $x++) {
                                                $image_data = $image_rs->fetch_assoc();
                                                $img[$x] = $image_data["code"];
                                            }

                                            // Start loop from 1 to skip the first image
                                            for ($x = 1; $x < $image_num; $x++) {
                                        ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary rounded mb-1 smallImg">
                                                    <img src="<?php echo $img["$x"]; ?>" class="mt-1 mb-1" style="height: 100%; max-width: 100%;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                </li>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 offset-lg-1 col-lg-10 bg-white bg-opacity-25 mt-2 rounded">
                                <div class="row mt-4 mb-3 px-3">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold text-white">Related Games</span>
                                    </div>
                                    <hr class="mt-2 text-white-50 fw-bold">
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
                                    <div class="col-12 mb-3" id="productbox"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>

            <script>
                loadProductsByBrand(0, '<?php echo $product_data['brand_id']; ?>', '<?php echo $brand_data['brand_name']; ?>');
            </script>
            <!-- <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script> -->
            <script src="script.js"></script>
            <script type="module" src="model-viewer.min.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Somthing went wrong!!!");
}

?>