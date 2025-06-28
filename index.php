<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewreport" content="width=device-width, initial-scale=1">

    <title>SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">

    <link rel="icon" href="resource/logoWolf.png">
    <link rel="stylesheet" href="bootstrap-icons.css">
</head>

<body class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center text-white title1">Hi, Welcome to SoftLK</p>
                    </div>
                    <div class="col-12">
                        <p class="text-center text-white title0">Get your favorite Games & Softwares in One place.</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-12 offset-lg-3 col-lg-6 bg-light bg-opacity-10 rounded-3 mb-5 py-3 px-4" id="signUpBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="text-white title2">Creat New Account</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-6" id="msg"></i>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label text-white fs-5">First Name</label>
                                <input type="text" id="f" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your first name.">
                            </div>

                            <div class="col-6">
                                <label class="form-label text-white fs-5">Last Name</label>
                                <input type="text" id="l" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your last name.">
                            </div>

                            <div class="col-12">
                                <label class="form-label text-white fs-5">Email</label>
                                <input type="email" id="e" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your email address.">
                            </div>

                            <div class="col-12">
                                <label class="form-label text-white fs-5">Password</label>
                                <input type="password" id="p" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your password.">
                            </div>

                            <div class="col-6">
                                <label class="form-label text-white fs-5">Mobile</label>
                                <input type="text" id="m" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your mobile number.">
                            </div>

                            <div class="col-6">
                                <label class="form-label text-white fs-5">Gender</label>
                                <select class="form-select fs-5 border-0 bg-light bg-opacity-75 shadow" id="g" style="height: 50px;">
                                    <?php

                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary-dark shadow" style="height: 50px;" onclick="signUp();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark shadow" style="height: 50px;" onclick="changeView();">Already have an account? Sign In</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 offset-lg-3 col-lg-6 d-none bg-light bg-opacity-10 rounded-3 mb-5 py-3 px-4" id="signInBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title2 text-white">Sign In</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv2">
                                <div class="alert alert-danger" role="alert" id="alertdiv2">
                                    <i class="bi bi-x-octagon-fill fs-6" id="msg2"></i>

                                </div>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12">
                                <label class="form-lable text-white fs-5">Email</label>
                                <input type="email" id="e2" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your email address." value="<?php echo ($email); ?>" />
                            </div>

                            <div class="col-12">
                                <label class="form-lable text-white fs-5">Password</label>
                                <input type="password" id="p2" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter your password." value="<?php echo ($password); ?>" />
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input border-0 opacity-75 shadow" type="checkbox" id="rememberme" />
                                    <label class="form-check-label text-white">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-6 text-end">
                                <a href="#" class="link-primary text-white" onclick="forgotPassword();">Forgot Password?</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary-dark shadow" style="height: 50px;" onclick="signIn();">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger shadow" style="height: 50px;" onclick="changeView();">No account? Creat now</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- content -->

            <!-- modal -->

            <div class="modal fade" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi">
                                        <button class="btn btn-outline-secondary" type="button" onclick="showPassword1();"><i id="e1" class="bi bi-eye-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp">
                                        <button class="btn btn-outline-secondary" type="button" onclick="showPassword2();"><i id="ee2" class="bi bi-eye-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Varification Code</label>
                                    <input type="text" class="form-control" id="vc">
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->

            <!-- footer -->

            <div class="col-12 fixed-bottom">
                <div class="row">
                    <p class="text-center text-decoration-underline Scurser text-white" onclick="window.location = 'adminLogin.php';">Admin Login</p>
                    <p class="text-center text-white">&copy; 2022 SoftLK.com&trade; || All Right Reserved</p>
                </div>
            </div>

            <!-- footer -->

        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>