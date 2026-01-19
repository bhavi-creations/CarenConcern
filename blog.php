<?php
include './db.connection/db_connection.php';

// Get service filter
$service = isset($_GET['service']) ? trim($_GET['service']) : '';

// Base SQL
$sql = "SELECT id, title, main_content, main_image, created_at FROM blogs";
if (!empty($service)) {
  $sql .= " WHERE service = ?";
}
$sql .= " ORDER BY created_at DESC";

// Prepare
$stmt = $conn->prepare($sql);

// Bind if filter exists
if (!empty($service)) {
  $stmt->bind_param("s", $service);
}

// Execute
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; ?>



<main>

  <!-- Blog List -->
  <div class="container blog-sidebar-list">
    <h1 class="d-flex justify-content-center my-5 about_dental_section">blogs</h1>
    <div class="row">
      <div class="col-lg-12 ">
        <div class="row ">

          <?php
          if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

              // IMAGE FIX
              $upload_dir = "./admin/uploads/photos/";
              $default_image = "./assets/img/default-blog.jpg";

              if (!empty($row['main_image']) && file_exists($upload_dir . $row['main_image'])) {
                $image_path = $upload_dir . $row['main_image'];
              } else {
                $image_path = $default_image;
              }
          ?>
              <div class="col-sm-12 col-lg-4 mb-5">
                <div class="post-box card_bg_div_box">

                  <figure>
                    <a href="fullblog.php?id=<?= $row['id']; ?>">
                      <img src="<?= $image_path; ?>" class="img-fluid blog_box_image" alt="Blog Image">
                    </a>
                  </figure>

                  <div class="box-content">
                    <h5 class="box-title">
                      <a href="fullblog.php?id=<?= $row['id']; ?>">
                        <?= htmlspecialchars($row['title']); ?>
                      </a>
                    </h5>

                    <p class="post-desc mt-3" style="text-align: justify;">
                      <?= substr(strip_tags($row['main_content']), 0, 90); ?>...
                    </p>

                    <a href="fullblog.php?id=<?= $row['id']; ?>">
                      <button class="blog_main_btn">Read More..</button>
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
<script>
  window.addEventListener("pageshow", function(event) {
    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
      window.location.reload();
    }
  });
</script>

<?php include 'footer.php'; ?>