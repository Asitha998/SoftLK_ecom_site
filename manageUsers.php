<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | SoftLK</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

    <link rel="icon" href="resource/logo.svg">
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row">

            <div class="col-1 bg-light py-2">
                <label class="form-label text-dark Scurser" onclick="window.location = 'adminPanel.php'"><i class="bi bi-arrow-left-circle fs-3 fw-bold"></i></label>
            </div>
            <div class="col-10 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage All Users</label>
            </div>
            <div class="col-1 bg-light"></div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-1 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-primary py-2">
                        <span class="fs-5 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-3 col-lg-1 bg-white"></div>
                </div>
            </div>

            <?php

            $query = "SELECT * FROM `user`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

            $results_per_page = 7;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>
                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-1 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-4 fw-bold"><?php echo $x + 1; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <?php

                            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $selected_data["email"] . "' ");
                            $image_num = $image_rs->num_rows;
                            if ($image_num == 0) {
                            ?>
                                <img src="profile images/new_user.svg" class="rounded-circle" style="height: 40px;margin-left: 80px;">
                            <?php
                            } else {
                                $image_data = $image_rs->fetch_assoc();

                            ?>
                                <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle" style="height: 40px;margin-left: 80px;">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2">
                            <span class="fs-5 fw-bold"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-3">
                            <span class="fs-6 fw-bold"><?php echo $selected_data["email"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-primary py-2">
                            <span class="fs-4 fw-bold"><?php echo $selected_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-4 fw-bold"><?php echo $selected_data["joined_date"]; ?></span>
                        </div>
                        <div class="col-3 col-lg-1 bg-white py-2 d-grid">
                            <?php
                            if ($selected_data["status"] == 1) {
                            ?>
                                <button id="ub<?php echo $selected_data['email'] ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email'] ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="ub<?php echo $selected_data['email'] ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email'] ?>');">Unblock</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!--msg modal -->

                <div class="modal fade" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body overflow-auto" style="height: 250px;">
                                <!-- received -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-8 rounded bg-success">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="text-white fs-6">2022-11-06 00:00:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- received -->
                                <!-- sent -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="offset-4 col-8 rounded bg-primary">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="text-white fs-6">2022-11-06 00:00:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- sent -->
                            </div>

                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="msgtxt">
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button type="button" class="btn btn-primary" onclick="sendAdminMsg('<?php echo $selected_data['email'] ?>')">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--msg modal -->

            <?php
            }
            ?>

            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="<?php if ($pageno <= 1) {
                                                            echo ("#");
                                                        } else {
                                                            echo "?page=" . ($pageno - 1);
                                                        } ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x) ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                            echo ("#");
                                                        } else {
                                                            echo "?page=" . ($pageno + 1);
                                                        } ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- pagination -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>