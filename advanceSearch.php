    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Advance Search | SoftLK</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons.css">

        <link rel="icon" href="resource/logoWolf.png">
    </head>

    <body class="main-body">

        <div class="container-fluid">
            <div class="row bg-black bg-opacity-10">

                <?php include "header.php" ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 pt-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Advance search</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-12 bg-body mb-2 bg-opacity-50">
                    <div class="row">
                        <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">
                                <div class="col-2">
                                    <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                                </div>
                                <div class="col-10 text-center">
                                    <p class="fs-1 text-black-50 fw-bold mt-3 pt-2">Advance Search</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="offset-lg-2 col-12 col-lg-8 bg-body bg-opacity-50 rounded mb-2 shadow">
                    <div class="row">

                        <div class="offset-lg-1 col-12 col-lg-10">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-3 mb-1">
                                    <input type="text" class="form-control border-0 bg-light bg-opacity-50 shadow" placeholder="Type a keyword to search..." id="t">
                                </div>
                                <div class="col-12 col-lg-2 mt-3 mb-1 d-grid">
                                    <button class="btn btn-primary-dark-trns shadow" onclick="advancedSearch();">Search</button>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-3 border-secondary">
                                </div>
                            </div>
                        </div>

                        <div class="offset-lg-1 col-12 col-lg-10">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 mb-2">
                                            <select class="form-select border-0 bg-light bg-opacity-50 shadow">
                                                <option>Select Category</option>
                                                <option>PlayStation Games</option>
                                                <option>Xbox Games</option>
                                                <option>PC(Steam) Games</option>
                                                <option>Other Softwares</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3 mt-2">
                                            <input type="text" class="form-control border-0 bg-light bg-opacity-50 shadow" placeholder="Price From">
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3 mt-2">
                                            <input type="text" class="form-control border-0 bg-light bg-opacity-50 shadow" placeholder="Price To">
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="offset-lg-2 col-12 col-lg-8 bg-body bg-opacity-50 rounded mb-2 shadow">
                    <div class="row">
                        <div class="offset-4 offset-lg-8 col-8 col-lg-4 mt-2 mb-2">
                            <select class="form-select bg-light bg-opacity-25 border border-start-0 border-top-0 border-end-0 border-2 border-primary border-opacity-75 shadow-lg">
                                <option value="0">SORT BY</option>
                                <option value="1">PRICE HIGH TO LOW</option>
                                <option value="2">PRICE LOW TO HIGH</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="offset-lg-2 col-12 col-lg-8 bg-body bg-opacity-50 rounded mb-2 shadow">
                    <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10">
                            <div class="row justify-content-center gap-2">

                                <div class="card col-6 col-lg-2 mt-2 mb-2 bg-light bg-opacity-25 shadow border-0" style="width: 18rem;">
                                    <img src="mobile images/Samsung S22 5G_0_634ad46b37081.jpeg" style="height: 135px;" class="card-img-top img-thumbnail" height="200px">
                                    <div class="card-body ms-0 m-0 text-center">
                                        <h5 class="card-title">Samsung Galaxy S22 <span class="badge bg-info">New</span></h5>
                                        <span class="card-text text-primary">Rs. 150000 .00</span><br>
                                        <span class="card-text text-black fw-bold">In Stock</span><br>
                                        <span class="card-text text-black fw-bold">10 items Available</span><br><br>
                                        <button class="col-12 btn btn-success" onclick="window.location='singleProductView.php';">Buy Now</button><br>
                                        <button class="col-12 btn btn-danger mt-2">Add to Cart <i class="bi bi-cart2"></i>+</button>

                                        <button class="col-12 btn btn-secondary-light mt-2" onclick="addToWatchlist(9);">
                                            <i class="bi bi-heart-fill text-white" id="heart9"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card col-6 col-lg-2 mt-2 mb-2 bg-light bg-opacity-25 shadow border-0" style="width: 18rem;">
                                    <img src="mobile images/Samsung S22 5G_0_634ad46b37081.jpeg" style="height: 135px;" class="card-img-top img-thumbnail" height="200px">
                                    <div class="card-body ms-0 m-0 text-center">
                                        <h5 class="card-title">Samsung Galaxy S22 <span class="badge bg-info">New</span></h5>
                                        <span class="card-text text-primary">Rs. 150000 .00</span><br>
                                        <span class="card-text text-black fw-bold">In Stock</span><br>
                                        <span class="card-text text-black fw-bold">10 items Available</span><br><br>
                                        <button class="col-12 btn btn-success" onclick="window.location='singleProductView.php';">Buy Now</button><br>
                                        <button class="col-12 btn btn-danger mt-2">Add to Cart <i class="bi bi-cart2"></i>+</button>

                                        <button class="col-12 btn btn-secondary-light mt-2" onclick="addToWatchlist(10);">
                                            <i class="bi bi-heart-fill text-white" id="heart10"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card col-6 col-lg-2 mt-2 mb-2 bg-light bg-opacity-25 shadow border-0" style="width: 18rem;">
                                    <img src="mobile images/Samsung S22 5G_0_634ad46b37081.jpeg" style="height: 135px;" class="card-img-top img-thumbnail" height="200px">
                                    <div class="card-body ms-0 m-0 text-center">
                                        <h5 class="card-title">Samsung Galaxy S22 <span class="badge bg-info">New</span></h5>
                                        <span class="card-text text-primary">Rs. 150000 .00</span><br>
                                        <span class="card-text text-black fw-bold">In Stock</span><br>
                                        <span class="card-text text-black fw-bold">10 items Available</span><br><br>
                                        <button class="col-12 btn btn-success" onclick="window.location='singleProductView.php';">Buy Now</button><br>
                                        <button class="col-12 btn btn-danger mt-2">Add to Cart <i class="bi bi-cart2"></i>+</button>

                                        <button class="col-12 btn btn-secondary-light mt-2" onclick="addToWatchlist(11);">
                                            <i class="bi bi-heart-fill text-white" id="heart11"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php include "footer.php" ?>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>