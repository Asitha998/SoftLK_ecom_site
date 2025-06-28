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
                        <p class="text-center text-white title1">Admin Login</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 offset-lg-3 col-lg-6 bg-light bg-opacity-10 rounded-3 mb-5 py-3 px-4">
                <div class="row g-2">

                    <div class="col-12">
                        <p class="title2 text-white">Log In</p>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-lable text-white fs-5">Email</label>
                        <input type="email" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px; border-radius: 100px;" placeholder="*Enter admin email address." id="e" />
                    </div>

                    <!-- <div class="col-12">
                        <label class="form-lable text-white fs-5">Password</label>
                        <input type="password" class="form-control fs-5 border-0 bg-light bg-opacity-75 shadow" style="height: 50px;" placeholder="*Enter admin password." />
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input border-0 opacity-75 shadow" type="checkbox" id="rememberme" />
                            <label class="form-check-label text-white">Remember Me</label>
                        </div>
                    </div>

                    <div class="col-6 text-end">
                        <a href="#" class="link-primary text-white">Forgot Password?</a>
                    </div> -->

                    <div class="col-12 col-lg-6 d-grid">
                        <button class="btn btn-primary-dark shadow" style="height: 50px; border-radius: 100px;" onclick="adminVerificationCode();">Log In via Verification code</button>
                    </div>

                    <div class="col-12 col-lg-6 d-grid">
                        <button class="btn btn-danger shadow" style="height: 50px; border-radius: 100px;" onclick="window.location = 'index.php';">Go to Customer Login</button>
                    </div>

                    <!-- modal -->
                    <div class="modal" tabindex="-1" id="verificationModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Admin Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Enter Your Verification Code</label>
                                    <input type="text" class="form-control" id="vcode">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="adminVerify();">Verify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->

                </div>
            </div>

        </div>
    </div>
    <!-- content -->

    <!-- footer -->

    <div class="col-12 fixed-bottom">
        <div class="row">
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