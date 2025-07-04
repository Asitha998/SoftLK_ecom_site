<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

    <link rel="icon" href="resource/logoWolf.png">
</head>

<body class="mt-2 main-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];
            ?>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 btn-toolbar justify-content-end bg-light bg-opacity-50">
                    <button class="btn btn-dark me-2" onclick="printInvoice();"> <i class="bi bi-printer-fill"></i> print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 bg-light bg-opacity-50" id="page">
                    <div class="row">

                        <div class="col-6">
                            <div class="ms-5 invoiceHeaderImage"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-black text-decoration-underline text-end">
                                    <h2>SoftLK</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Colombo 10, Sri Lanka</span><br>
                                    <span>+94 112 785694</span><br>
                                    <span>softlk@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary">
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                    $address_data = $address_rs->fetch_assoc();
                                    ?>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span><?php echo $address_data["line1"] . ", " . $address_data["line2"]; ?></span><br>
                                    <span><?php echo $umail; ?></span>
                                </div>
                                <?php
                                $invoce_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `invoice_item` ON `invoice`.`id` = `invoice_item`.`invoice_id` WHERE `invoice`.`id`='" . $oid . "'");
                                $invoce_data = $invoce_rs->fetch_assoc();
                                ?>
                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-black">INVOICE ID <?php echo $oid; ?></h1>
                                    <span class="fw-bold">Date & Time of Invoice : </span><br>
                                    <span><?php echo $invoce_data["date"]; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">

                                <thead>
                                    <tr class="border-0 border-white bg-secondary bg-opacity-25">
                                        <th>#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-secondary text-white fs-3 pt-3">1</td>
                                        <td>
                                            <span class="fw-bold text-black text-decoration-underline p-2"><?php echo $oid ?></span><br>
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoce_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold text-black fs-3 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-4 bg-secondary bg-opacity-75 text-white">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="fw-bold fs-6 text-end pt-4"><?php echo $invoce_data["qty"]; ?></td>
                                        <?php

                                        $total_price = $product_data["price"] * $invoce_data["qty"];

                                        ?>
                                        <td class="fw-bold fs-6 text-end pt-4 bg-secondary bg-opacity-75 text-white">Rs. <?php echo $total_price; ?> .00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;
                                    if ($city_data["district_id"] == 1) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }
                                    $t = $invoce_data["total"];
                                    $g = $t - $delivery;
                                    ?>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $g; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                        <td class="text-end border-primary">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold text-black border-primary">GRAND TOTAL</td>
                                        <td class="text-end text-black border-primary">Rs. <?php echo $t; ?> .00</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-success">Thank You !</span>
                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>
            <?php
            } else {
                header("location:home.php");
            }
            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>