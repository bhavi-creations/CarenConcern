<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Care N Concern - Dashboard</title>

    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .card-custom {
            margin: 6px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- End Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include 'navbar.php'; ?>
            <!-- End Topbar -->

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h2 class="h2 mb-0 text-info mx-2">Published Blogs</h2>
                    <a href="newBlog.php" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Create Blog
                    </a>
                </div>

                <div class="row">

                    <?php
                    include '../../db.connection/db_connection.php';

                    // IMAGE BASE PATH (FROM admin/public/)
                    $imageBasePath = "../uploads/photos/";
                    $imageServerPath = __DIR__ . "/../uploads/photos/";

                    $sql = "SELECT id, title, main_content, main_image FROM blogs ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            if (!empty($row['main_image']) && file_exists($imageServerPath . $row['main_image'])) {
                                $imagePath = $imageBasePath . $row['main_image'];
                            } else {
                                $imagePath = "https://mailrelay.com/wp-content/uploads/2018/03/que-es-un-blog-1.png";
                            }
                            ?>

                            <div class="col-12 col-md-4">
                                <div class="card card-custom shadow">
                                    <img src="<?= $imagePath ?>" class="card-img-top" alt="Blog Image">

                                    <div class="card-body">
                                        <h5 class="card-title text-dark">
                                            <?= htmlspecialchars($row['title']); ?>
                                        </h5>

                                        <p class="card-text">
                                            <?= substr(strip_tags($row['main_content']), 0, 100); ?>...
                                        </p>

                                        <div class="row">
                                            <a href="editBlog.php?id=<?= $row['id']; ?>"
                                               class="btn btn-warning col-xl-4 mx-3 my-2">Edit</a>

                                            <a href="deleteBlog.php?id=<?= $row['id']; ?>"
                                               class="btn btn-danger col-xl-4 mx-3 my-2"
                                               onclick="return confirm('Are you sure?')">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo "<p class='text-center'>No blog posts found.</p>";
                    }

                    $conn->close();
                    ?>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <p style="color:black">
                        ©2024 Care N Concern. Designed & Developed by
                        <a href="https://bhavicreations.com/" target="_blank" style="color:black;text-decoration:none;">
                            Bhavi Creations
                        </a>
                    </p>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div>
</div>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
