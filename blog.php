<?php
include './db.connection/db_connection.php';

// Retrieve service filter
$service = isset($_GET['service']) ? $_GET['service'] : '';

// SQL query
$sql = "SELECT id, title, main_content, main_image, created_at FROM blogs";
if (!empty($service)) {
    $sql .= " WHERE service = ?";
}
$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);

if (!empty($service)) {
    $stmt->bind_param("s", $service);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; ?>

<main>

<h1 class="d-flex justify-content-center mt-5">Blogs</h1>

<div class="container blog-sidebar-list" style="padding-top:20px;padding-bottom:20px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="grid row">

                <?php
                // ===============================
                // IMAGE PATH CONFIG (FIXED)
                // ===============================

                // Browser path
                $imageBaseUrl = "admin/uploads/photos/";

                // Server path (for file_exists)
                $imageBaseDir = $_SERVER['DOCUMENT_ROOT'] . "/CarenConcern/admin/uploads/photos/";

                // Default image
                $defaultImage = "https://mailrelay.com/wp-content/uploads/2018/03/que-es-un-blog-1.png";

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        // Clean image name
                        $imageName = trim($row['main_image']);

                        if (!empty($imageName) && file_exists($imageBaseDir . $imageName)) {
                            $image_path = $imageBaseUrl . $imageName;
                        } else {
                            $image_path = $defaultImage;
                        }
                        ?>

                        <div class="grid-item col-sm-12 col-md-6 col-lg-4 mb-5">
                            <div class="post-box card_bg_div_box gallery-card">

                                <figure class="image-wrapper">
                                    <a href="fullblog.php?id=<?= $row['id']; ?>">
                                        <img src="<?= htmlspecialchars($image_path); ?>"
                                             alt="Blog Image"
                                             class="img-fluid blog_box_image hover-zoom">
                                    </a>
                                </figure>

                                <div class="box-content card-content">
                                    <h5 class="box-title card-title">
                                        <a class="box-title" href="fullblog.php?id=<?= $row['id']; ?>">
                                            <?= htmlspecialchars($row['title']); ?>
                                        </a>
                                    </h5>

                                    <p class="post-desc mt-3 card-desc">
                                        <?= substr(strip_tags($row['main_content']), 0, 90); ?>...
                                    </p>

                                    <a href="fullblog.php?id=<?= $row['id']; ?>">
                                        <button class="blog_main_btn card-btn">Read More..</button>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo "<p class='text-center'>No blog posts found.</p>";
                }
                ?>

            </div>
        </div>
    </div>
</div>

</main>

<?php include './footer.php'; ?>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
