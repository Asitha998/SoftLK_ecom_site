<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | SolfLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

    <link rel="icon" href="resource/logoWolf.png">

</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row gy-3">

            <?php include "header.php"; ?>

            <?php
            if (isset($_SESSION["u"])) {
            ?>

                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="h2 text-primary fw-bold text-white">Add New Product</h2>
                        </div>

                        <div class="col-12">
                            <hr style="border-width: 3px;" class="border-white">
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-4 border-end border-dark border-opacity-50">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white" style="font-size: 20px;">Select Product Category</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select text-center bg-light bg-opacity-50 shadow border-0 border-bottom" id="category" onchange="load_brand();">
                                                <option value="0">Select Category</option>
                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["category_name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4  border-end border-dark border-opacity-50">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white" style="font-size: 20px;">Select Product Brand</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select text-center bg-light bg-opacity-50 shadow border-0 border-bottom" id="brand" onchange="load_type();">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["brand_name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white" style="font-size: 20px;">Select Product Type</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select  text-center bg-light bg-opacity-50 shadow border-0 border-bottom" id="type">
                                                <option value="0">Select Type</option>
                                                <?php

                                                $type_rs = Database::search("SELECT * FROM `type`");
                                                $type_num = $type_rs->num_rows;

                                                for ($x = 0; $x < $type_num; $x++) {
                                                    $type_data = $type_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $type_data["id"]; ?>"><?php echo $type_data["type"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr style="border-width: 3px;" class="border-white">
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white" style="font-size: 20px;">
                                                Add a Title to Your Product
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <input type="text" placeholder="Add a title..." class="form-control bg-light bg-opacity-50 shadow border-0 border-bottom" id="title">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white" style="font-size: 20px;">
                                                Add trailer link
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <input type="text" placeholder="Add a trailer link from youtube..." class="form-control bg-light bg-opacity-50 shadow border-0 border-bottom" value="<?php echo $product["trailer"]; ?>" id="link">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr style="border-width: 3px;" class="border-white">
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-4 border-end border-dark border-opacity-50">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-white" style="font-size: 20px;">Add Product Quantity</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="number" class="form-control bg-light bg-opacity-50 shadow border-0 border-bottom" value="0" min="1" id="qty">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 border-end border-dark border-opacity-50">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-white" style="font-size: 20px;">Cost per Item</label>
                                                </div>
                                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control bg-light bg-opacity-50 shadow border-0 border-bottom" id="cost">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-white" style="font-size: 20px;">Approved Payment Methods</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                        <div class="col-2 pm pm2"></div>
                                                        <div class="col-2 pm pm3"></div>
                                                        <div class="col-2 pm pm4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="border-width: 3px;" class="border-white">
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-white" style="font-size: 20px;">Delivery Cost</label>
                                                </div>
                                                <div class="col-12 col-lg-6 border-end border-dark border-opacity-50">
                                                    <div class="row">
                                                        <div class="col-12 offset-lg-1 col-lg-3">
                                                            <label class="form-label text-white">Delivery cost Withing Colombo</label>
                                                        </div>
                                                        <div class="col-12 col-lg-8">
                                                            <div class="input-group mb-2 mt-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control bg-light bg-opacity-50 shadow border-0 border-bottom" id="dwc">
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12 offset-lg-1 col-lg-3">
                                                            <label class="form-label text-white">Delivery cost out of Colombo</label>
                                                        </div>
                                                        <div class="col-12 col-lg-8">
                                                            <div class="input-group mb-2 mt-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control bg-light bg-opacity-50 shadow border-0 border-bottom" id="doc">
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="border-width: 3px;" class="border-white">
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-white" style="font-size: 20px;">Product Description</label>
                                                </div>
                                                <div class="col-12">
                                                    <textarea cols="30" rows="5" class="form-control bg-light bg-opacity-50 border-0 shadow" id="desc"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="border-width: 3px;" class="border-white">
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-white" style="font-size: 20px;">Add Product Images</label>
                                                </div>
                                                <div class="offset-lg-3 col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-4 bg-light border-0 bg-opacity-50 rounded shadow">
                                                            <img src="resource/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i0">
                                                        </div>
                                                        <div class="col-4 bg-light border-0 bg-opacity-50 rounded shadow">
                                                            <img src="resource/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i1">
                                                        </div>
                                                        <div class="col-4 bg-light border-0 bg-opacity-50 rounded shadow">
                                                            <img src="resource/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="offset-lg-3 col-12 col-lg-6 mt-3">
                                                    <input type="file" class="d-none" id="imageUploader" multiple />
                                                    <label for="imageUploader" class="col-12 btn btn-primary shadow" onclick="changeProductImage();">Upload Images</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="border-width: 3px;" class="border-white">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white" style="font-size: 20px;">Notice...</label>
                                            <br>
                                            <label class="form-label text-white">
                                                We are taking 5% of the product from price from every
                                                product as a service charge.
                                            </label>
                                        </div>

                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                            <button class="btn btn-success shadow" onclick="addProduct();">Save Product</button>
                                        </div>

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

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>