    <?php

require "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {

    $from = $_GET["f"];
    $to = $_GET["t"];

    if (empty($from) && empty($to)) {
        echo ("0");
    } else {

        $invoice_rs = Database::search("SELECT * FROM `invoice`");
        $invoice_num = $invoice_rs->num_rows;

        for ($x = 0; $x < $invoice_num; $x++) {
            $invoice_data = $invoice_rs->fetch_assoc();
            $sold_date = $invoice_data["date"];
            $date = explode(" ", $sold_date);

            $d = $date[0];
            $t = $date[1];

            if (!empty($from) && empty($to)) {
                if ($from <= $d) {
?>
                    <div class="row">

                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <?php
                            $product_rs =  Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <?php
                            $buyer_rs =  Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                            $buyer_data = $buyer_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold mt-1 mb-1">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid">
                            <?php
                            if ($invoice_data["status"] == 0) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Confirm Order</button>
                            <?php
                            } else if ($invoice_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Packing</button>
                            <?php
                            } else if ($invoice_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Dispatch</button>
                            <?php
                            } else if ($invoice_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Shipping</button>
                            <?php
                            } else if ($invoice_data["status"] == 4) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1 disabled" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Delivered</button>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                <?php
                }
            } else if (empty($from) && !empty($to)) {
                if ($to >= $d) {
                ?>
                    <div class="row">

                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <?php
                            $product_rs =  Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <?php
                            $buyer_rs =  Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                            $buyer_data = $buyer_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold mt-1 mb-1">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid">
                            <?php
                            if ($invoice_data["status"] == 0) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Confirm Order</button>
                            <?php
                            } else if ($invoice_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Packing</button>
                            <?php
                            } else if ($invoice_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Dispatch</button>
                            <?php
                            } else if ($invoice_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Shipping</button>
                            <?php
                            } else if ($invoice_data["status"] == 4) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1 disabled" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Delivered</button>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                <?php
                }
            } else if (!empty($from) && !empty($to)) {
                if ($from <= $d && $to >= $d) {
                ?>
                    <div class="row">

                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <?php
                            $product_rs =  Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <?php
                            $buyer_rs =  Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                            $buyer_data = $buyer_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold mt-1 mb-1">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid">
                            <?php
                            if ($invoice_data["status"] == 0) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Confirm Order</button>
                            <?php
                            } else if ($invoice_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Packing</button>
                            <?php
                            } else if ($invoice_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Dispatch</button>
                            <?php
                            } else if ($invoice_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Shipping</button>
                            <?php
                            } else if ($invoice_data["status"] == 4) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1 disabled" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Delivered</button>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
<?php
                }
            }
        }
    }
}

?>