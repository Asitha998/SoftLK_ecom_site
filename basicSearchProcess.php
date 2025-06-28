<?php

require "connection.php";

session_start();

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product`";

if (!empty($txt) && $select == "All Categories") {
    $query .= " WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != "All Categories") {
    $query .= " WHERE `category_id`='" . $select . "'";
} else if (!empty($txt) && $select != "All Categories") {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' AND `category_id`='" . $select . "'";
}

?>

<!-- pagination -->

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center" style="margin-top: 100px;">
        <div class="row gap-2">

            <?php

            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>

                <div class="card col-6 col-lg-2 mt-2 mb-2 bg-light bg-opacity-25 border-0 cd" style="width: 18rem;">

                    <?php

                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "' ");
                    $image_data = $image_rs->fetch_assoc();

                    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id`='" . $selected_data["brand_id"] . "'");
                    $brand_data = $brand_rs->fetch_assoc();

                    ?>
                    <div class="card-body ms-0 m-0">

                        <span class="text-white-50 fs-6"><?php echo $brand_data["brand_name"]; ?></span>
                        <h5 class="card-title text-white"><?php echo $selected_data["title"]; ?></h5>

                        <div class="align-content-center justify-content-center" style="height: 250px;">
                            <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" style="max-height: 100%;">
                        </div>

                        <span class="card-text text-white fs-4 fw-bold mb-3 me-1"><span class="fs-6 fw-light">LKR</span><?php echo $selected_data["price"]; ?>.00</span>

                        <?php

                        if ($selected_data["qty"] > 0) {

                        ?>
                            <a type="button" class="btn btn-success ms-5 rounded-circle" href='<?php echo "singleProductView.php?id=" . $selected_data["id"] ?>' data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Buy Now"><i class="bi bi-bag-check fs-6"></i></a><br>
                            <hr class="text-white-50 mb-1">
                            <button class="btn bg-transparent text-white-50 fs-5 fw-bold" onclick="addToCart(<?php echo $selected_data['id']; ?>);">Add to cart <i class="bi bi-cart2"></i>+&nbsp;&nbsp;<span class="text-white-50 fw-light fs-5">|</span></button>

                        <?php

                        } else {

                        ?>

                            <span class="badge text-white text-bg-danger fw-bold mb-2">Out of Stock</span><br>
                            <hr class="text-white-50 mb-1">
                            <span class="btn bg-transparent disabled border-0 text-white fs-5">Add to wishlist</span>
                            <?php

                        }

                        if (isset($_SESSION["u"])) {

                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $selected_data["id"] . "' AND 
                                                            `user_email`='" . $_SESSION["u"]["email"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {
                            ?>
                                <button class="btn bg-transparent rounded-circle" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                    <i class="bi bi-heart-fill text-danger" id='heart<?php echo $selected_data["id"]; ?>'></i>
                                </button>
                            <?php
                            } else {
                            ?>
                                <button class="btn bg-transparent rounded-circle" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                    <i class="bi bi-heart-fill text-white" id='heart<?php echo $selected_data["id"]; ?>'></i>
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
    <!--  -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link border-0 bg-black bg-opacity-50" <?php if ($pageno <= 1) {
                                                                                echo ("#");
                                                                            } else {
                                                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link border-0 bg-black bg-opacity-50" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link border-0 bg-black bg-opacity-50" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link border-0 bg-black bg-opacity-50" <?php if ($pageno >= $number_of_pages) {
                                                                                echo ("#");
                                                                            } else {
                                                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->
</div>

<!-- pagination -->