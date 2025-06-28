<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
</head>

<body>

    <div class="col-12 px-3">
        <div class="row mt-1 mb-1">

            <div class="col-12 col-lg-3 align-self-start mt-2">

                <?php

                require "connection.php";

                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                ?>

                    <img src="resource/headerlogo2.svg" class="ms-5" style="height: 50px;" onclick='window.location="home.php"'>
                    <span class="text-lg-start fw-bold text-white Scurser ms-5" onclick='window.location="userProfile.php"'>My Profile</span> <span class="text-white fw-bolder"></span>
                    <span class="text-lg-start fw-bold text-danger Scurser ms-5" onclick="signout();">Sign Out</span> <span class="text-white fw-bolder"></span>

                <?php

                } else {

                ?>
                    <img src="resource/headerlogo.svg" style="height: 50px;">
                    <a href="index.php" class="text-decoration-none fw-bold">Sign In</a> <span class="text-white fw-bolder"></span>

                <?php

                }

                ?>

            </div>

            <!-- search -->
            <div class="row col-12 col-lg-5 py-2">

                <div class="input-group bg-white bg-opacity-25 srch">
                    <input type="text" class="form-control bg-transparent border border-0 text-white outline" placeholder="Search in SoftLK..." aria-label="Text input with dropdown button" id="basic_search_txt">

                    <select class="form-select bg-transparent border border-1 border-white border-opacity-25 border-top-0 border-bottom-0 text-white" style="max-width: 160px;" id="basic_search_select">
                        <option class="bg-dark">All Categories</option>

                        <?php

                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>

                            <option class="bg-dark" value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["category_name"]; ?></option>

                        <?php
                        }
                        ?>

                    </select>
                    <button class="btn bg-transparent" onclick="basicSearch(0);"><i class="bi bi-search fs-4 Scurser text-white"></i></button>
                    <!-- <a href="advanceSearch.php" class="link-secondary text-decoration-none fw-bold">Advance Search</a> -->
                </div>

            </div>

            <!-- search -->

            <div class="col-12 col-lg-4 align-self-end justify-content-end" style="text-align: center;">
                <div class="row">

                    <ul class="headerList">
                        <li class="headerItem"><a class="headerText text-white" href="myProducts.php">My Products</a></li>
                        <li class="headerItem"><a class="headerText text-white" href="watchlist.php">Wishlist</a></li>
                        <li class="headerItem"><a class="headerText text-white" href="purchasedHistory.php">Purchased History</a></li>
                        <li class="headerItem"><a class="headerText text-primary" href="home.php">Home</a></li>
                        <li class="headerItem">
                            <div class="headerText" onclick="window.location='cart.php';">
                                <i class="bi bi-cart4 fs-4 Scurser text-white"></i>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>