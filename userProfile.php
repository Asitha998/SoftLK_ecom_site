<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="font-awesome.min.css">

    <link rel="icon" href="resource/logoWolf.png">
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php" ?>

            <?php

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                // $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_image` ON 
                // user.email=profile_image.user_email INNER JOIN `user_has_address` ON 
                // user.email=user_has_address.user_email INNER JOIN `city` ON 
                // user_has_address.city_id=city.id INNER JOIN `district` ON
                // city.district_id=district.id INNER JOIN `province` ON 
                // district.province_id=province.id INNER JOIN `gender` ON
                // gender.id=user.gender_id WHERE `email`='" . $email . "'");

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
                gender.id=user.gender_id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_id=city.id INNER JOIN `district` ON
                city.district_id=district.id INNER JOIN `province` ON 
                district.province_id=province.id WHERE `user_email`='" . $email . "'");

                $userdata = $details_rs->fetch_assoc();
                $imagedata = $image_rs->fetch_assoc();
                $addressdata = $address_rs->fetch_assoc();

            ?>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 rounded mt-4 mb-4">
                            <div class="row g-2 offset-lg-2">

                                <div class="col-md-3 bg-light bg-opacity-25 rounded me-4">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (!empty($imagedata["path"])) {

                                        ?>

                                            <img src="<?php echo $imagedata["path"]; ?>" class="rounded mt-5" style="width: 150px;" id="viewImg" />

                                        <?php

                                        } else {

                                        ?>

                                            <img src="profile images/new_user.svg" class="rounded mt-5" style="width: 150px;" id="viewImg" />

                                        <?php

                                        }

                                        ?>

                                        <span class="fw-bold fs-4 text-white"><?php echo $userdata["fname"]; ?> <?php echo $userdata["lname"]; ?></span>
                                        <span class="fw-bold text-white-50"><?php echo $userdata["email"]; ?></span><br>

                                        <input type="file" class="d-none" id="profileimg" accept="image/*">
                                        <label for="profileimg" class="btn btn-primary" onclick="changeImage();">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-6 bg-light bg-opacity-25 rounded">
                                    <div class="p-3 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold text-white-50">Profile Settings</h4>
                                        </div>
                                        <hr class="text-white-50">
                                        <div class="row mt-4">

                                            <div class="col-6">
                                                <label class="form-label text-white">First Name</label>
                                                <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["fname"]; ?>" id="fname" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label text-white">Last Name</label>
                                                <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["lname"]; ?>" id="lname" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-white">Mobile</label>
                                                <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["mobile"]; ?>" id="mobile" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-white">Email</label>
                                                <input type="email" disabled class="form-control text-white-50 bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["email"]; ?>">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-white">Password</label>
                                                <div class="input-group">
                                                    <input type="password" disabled class="form-control text-white-50 bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["password"]; ?>">
                                                    <span class="input-group-text btn btn-secondary-light " id="basic-addon2"><i class="bi bi-eye-slash-fill text-black"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-white">Registered Date</label>
                                                <input type="datetime-local" disabled class="form-control text-white-50 bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["joined_date"]; ?>">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label text-white">Gender</label>
                                                <input type="text" disabled class="form-control text-white-50 bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $userdata["gender_name"] ?>">
                                                <hr>
                                            </div>

                                            <?php

                                            if (!empty($addressdata["line1"])) {

                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label text-white">Address Line 1</label>
                                                    <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $addressdata["line1"]; ?>" id="line1" />
                                                </div>

                                            <?php

                                            } else {

                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label text-white">Address Line 1</label>
                                                    <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" id="line1" />
                                                </div>

                                            <?php

                                            }

                                            if (!empty($addressdata["line2"])) {

                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label text-white">Address Line 2</label>
                                                    <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $addressdata["line2"]; ?>" id="line2" />
                                                </div>

                                            <?php

                                            } else {

                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label text-white">Address Line 2</label>
                                                    <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" id="line2" />
                                                </div>

                                            <?php

                                            }

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label text-white">Province</label>
                                                <select class="form-select text-white border-0  bg-light bg-opacity-25" id="province">

                                                    <option value="0" class="text-primary fw-bold">Select Province</option>

                                                    <?php
                                                    $p_rs = Database::search("SELECT * FROM `province`");
                                                    $p_n = $p_rs->num_rows;

                                                    for ($p = 0; $p < $p_n; $p++) {
                                                        $p_data = $p_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $p_data["id"]; ?>" <?php if (!empty($addressdata["province_id"])) {
                                                                                                            if ($p_data["id"] == $addressdata["province_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>><?php echo $p_data["province_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label text-white">District</label>
                                                <select class="form-select text-white border-0  bg-light bg-opacity-25" id="district">

                                                    <option value="0" class="text-primary fw-bold">Select your District</option>

                                                    <?php
                                                    $d_rs = Database::search("SELECT * FROM `district`");
                                                    $d_n = $d_rs->num_rows;

                                                    for ($s = 0; $s < $d_n; $s++) {
                                                        $d_data = $d_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $d_data["id"]; ?>" <?php if (!empty($addressdata["district_id"])) {
                                                                                                            if ($d_data["id"] == $addressdata["district_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>><?php echo $d_data["district_name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label text-white">City</label>
                                                <select class="form-select text-white border-0  bg-light bg-opacity-25" id="city">

                                                    <option value="0" class="text-primary fw-bold">Select your City</option>

                                                    <?php
                                                    $c_rs = Database::search("SELECT * FROM `city`");
                                                    $c_n = $c_rs->num_rows;

                                                    for ($c = 0; $c < $c_n; $c++) {
                                                        $c_data = $c_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $c_data["id"]; ?>" <?php if (!empty($addressdata["city_id"])) {
                                                                                                            if ($c_data["id"] == $addressdata["city_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>><?php echo $c_data["city_name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <?php
                                            if (!empty($addressdata["postal_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label text-white">Postal Code</label>
                                                    <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" value="<?php echo $addressdata["postal_code"]; ?>" id="pcode" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label text-white">Postal Code</label>
                                                    <input type="text" class="form-control text-white bg-light bg-opacity-25 border-0 text-white bg-light bg-opacity-25" id="pcode" />
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-12">
                                                <br>
                                                <button class="btn btn-outline-success text-white col-12" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {
                header("Location:home.php");
            }
            ?>



            <?php include "footer.php" ?>

        </div>
    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>