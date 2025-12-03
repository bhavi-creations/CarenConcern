<?php
include './db.connection/db_connection.php'; // Include your database connection file

// Retrieve service filter from GET request
$service = isset($_GET['service']) ? $_GET['service'] : '';

// Prepare SQL query with optional service filter
$sql = "SELECT id, title, main_content, main_image, created_at FROM blogs";
if (!empty($service)) {
  $sql .= " WHERE service = ?";
}
$sql .= " ORDER BY created_at DESC";

// Initialize statement
$stmt = $conn->prepare($sql);

// Bind parameters if service is set
if (!empty($service)) {
  $stmt->bind_param("s", $service);
}

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
?>


<?php include 'header.php'; ?>


<main>
  <!-- Filter Buttons -->
  <h1 class="d-flex justify-content-center">blogs </h1>

  <!-- Blogs Section -->
  <div class="container blog-sidebar-list" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="row">
      <div class="col-lg-12">
        <div class="grid row">
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $image_path = !empty($row['main_image']) ? "admin/uploads/photos/{$row['main_image']}" : "default_image.png";
              echo "
                        <div class='grid-item col-sm-12 col-md-6 col-lg-4 mb-5'>
                            <div class='post-box card_bg_div_box gallery-card'>
                                <figure class='image-wrapper'>
                                    <a href='service_detsils.php?id={$row['id']}'>
                                        <img src='{$image_path}' alt='Blog Image' class='img-fluid blog_box_image hover-zoom'>
                                    </a>
                                </figure>

                                <div class='box-content card-content'>
                                    <h5 class='box-title card-title'>
                                        <a class='box-title' href='service_detsils.php?id={$row['id']}'>
                                            " . htmlspecialchars($row['title']) . "
                                        </a>
                                    </h5>

                                    <p class='post-desc mt-3 card-desc'>
                                        " . substr(strip_tags($row['main_content']), 0, 90) . "...
                                    </p>

                                    <a href='service_detsils.php?id={$row['id']}'>
                                        <button class='blog_main_btn card-btn'>Read More..</button>
                                    </a>
                                </div>
                            </div>
                        </div>";
            }
          } else {
            echo "<p>No blog posts found.</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- ======= Footer ======= -->
<?php include('./footer.php'); ?>

<!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

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