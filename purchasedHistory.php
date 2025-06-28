<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Purchased History | SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

    <link rel="icon" href="resource/logoWolf.png">
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row bg-black bg-opacity-10">

            <?php include "header.php";
            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `invoice_item` ON `invoice`.`id` = `invoice_item`.`invoice_id` WHERE `user_email`='" . $umail . "'");
                $invoice_num = $invoice_rs->num_rows;

            ?>
                <div class="mb-4" id="basicSearchResult">
                    <div class="col-12 pt-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Purchased History</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-12 offset-lg-1 col-lg-10 rounded bg-light bg-opacity-50">
                        <div class="row">

                            <div class="col-12 ps-4">
                                <label class="form-label fs-1 fw-bolder">Purchased History <i class="bi bi-credit-card fs-1"></i></i></label>
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <?php
                            if ($invoice_num == 0) {
                            ?>
                                <div class="col-12 bg-body text-center" style="height: 450px;">
                                    <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">You have not Purchased any product yet...</span>
                                </div>
                            <?php
                            } else {
                            ?>

                                <div class="col-12 mb-3 px-5">
                                    <div class="row p-3 bg-light bg-opacity-50 rounded shadow">

                                        <div class="col-12 pt-1 bg-secondary bg-opacity-25 rounded">
                                            <div class="row">
                                                <div class="col-3 col-lg-3">
                                                    <label class="form-label fw-bold">Title (x qty)</label>
                                                </div>
                                                <div class="col-3 col-lg-2">
                                                    <label class="form-label fw-bold">Amount</label>
                                                </div>
                                                <div class="col-3 col-lg-2">
                                                    <label class="form-label fw-bold">Date</label>
                                                </div>
                                                <div class="col-3 col-lg-3">
                                                    <label class="form-label fw-bold">Payment Method</label>
                                                </div>
                                                <div class="col-lg-2 d-none d-lg-block">
                                                    <label class="form-label fw-bold">Seller Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        <?php

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();
                                        ?>

                                            <div class="col-12">
                                                <div class="row mt-3">
                                                    <?php
                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                                    $product_data = $product_rs->fetch_assoc();

                                                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                    $seller_data = $seller_rs->fetch_assoc();
                                                    ?>
                                                    <div class="col-3 col-lg-3">
                                                        <label class="form-label"></i>&nbsp;<?php echo $product_data["title"]; ?>&nbsp;(x&nbsp;<?php echo $invoice_data["qty"]; ?>)</label>
                                                    </div>

                                                    <div class="col-3 col-lg-2">
                                                        <label class="form-label">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                                                    </div>
                                                    <div class="col-3 col-lg-2">
                                                        <label class="form-label"><?php echo $invoice_data["date"]; ?></label>
                                                    </div>
                                                    <div class="col-3 col-lg-3">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-7">
                                                                <label class="form-label">Payment via Visa Card</label>
                                                            </div>
                                                            <div class="col-lg-5 d-none d-lg-block pmh pm1 mb-1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 d-none d-lg-block">
                                                        <label class="form-label"><?php echo $product_data["user_email"]; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            <?php
                            }
            ?>

        <?php
            } else {
                header("location:home.php");
            }

            include "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>