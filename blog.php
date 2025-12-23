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




<?php include 'navbar.php';  ?>


  <!-- End Header -->
  <main>
    <!-- Filter Buttons -->
    <div class="container new_space">
      <div class="filter_buttons redirect_section mt-4">
        <a href="blogs.php?service="><button class="redirect_blog_srivice">All</button></a>
        <a href="blogs.php?service=Bladder Cancer"><button class="redirect_blog_srivice">Bladder Cancer</button></a>
        <a href="blogs.php?service=Brain Cancer"><button class="redirect_blog_srivice">Brain Cancer</button></a>
        <a href="blogs.php?service=Cervical Cancer"><button class="redirect_blog_srivice">Cervical Cancer</button></a>
        <a href="blogs.php?service=Childhood Cancer"><button class="redirect_blog_srivice">Childhood Cancer</button></a>
        <a href="blogs.php?service=Colon Cancer"><button class="redirect_blog_srivice">Colon Cancer</button></a>
        <a href="blogs.php?service=Esophageal Cancer"><button class="redirect_blog_srivice">Esophageal Cancer</button></a>
        <a href="blogs.php?service=Kidney Cancer"><button class="redirect_blog_srivice">Kidney Cancer</button></a>
        <a href="blogs.php?service=Leiomyosarcoma Cancer"><button class="redirect_blog_srivice">Leiomyosarcoma Cancer</button></a>
        <a href="blogs.php?service=Leukemia Cancer"><button class="redirect_blog_srivice">Leukemia Cancer</button></a>
        <a href="blogs.php?service=Liver Cancer"><button class="redirect_blog_srivice">Liver Cancer</button></a>
        <a href="blogs.php?service=Lung Cancer"><button class="redirect_blog_srivice">Lung Cancer</button></a>
        <a href="blogs.php?service=Lymphoma Cancer"><button class="redirect_blog_srivice">Lymphoma Cancer</button></a>
        <a href="blogs.php?service=Melanoma Cancer"><button class="redirect_blog_srivice">Melanoma Cancer</button></a>
        <a href="blogs.php?service=Ovarian Cancer"><button class="redirect_blog_srivice">Ovarian Cancer</button></a>
        <a href="blogs.php?service=Pancreatic Cancer"><button class="redirect_blog_srivice">Pancreatic Cancer</button></a>
        <a href="blogs.php?service=Prostate Cancer"><button class="redirect_blog_srivice">Prostate Cancer</button></a>
        <a href="blogs.php?service=Sarcoma/Bone Cancer"><button class="redirect_blog_srivice">Sarcoma/Bone Cancer</button></a>
        <a href="blogs.php?service=Stomach Cancer"><button class="redirect_blog_srivice">Stomach Cancer</button></a>
        <a href="blogs.php?service=Testicular Cancer"><button class="redirect_blog_srivice">Testicular Cancer</button></a>
        <a href="blogs.php?service=Uterine Cancer"><button class="redirect_blog_srivice">Uterine Cancer</button></a>
        <a href="blogs.php?service=Head Neck Cancer"><button class="redirect_blog_srivice">Head & Neck Cancer</button></a>
        <a href="blogs.php?service=Breast Cancer"><button class="redirect_blog_srivice">Breast Cancer</button></a>
        <a href="blogs.php?service=Multiple Cancer"><button class="redirect_blog_srivice">Multiple Cancer</button></a>
        <a href="blogs.php?service=Honors Cancer"><button class="redirect_blog_srivice">Honors Cancer</button></a>





        <a href="blogs.php?service=Other"><button class="redirect_blog_srivice">Other Blog</button></a>



      </div>
    </div>

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
                                    <div class='grid-item col-sm-12 col-md-6 col-lg-4 mb-5 shadow_box'>
                                        <div class='post-box card_bg_div_box'>
                                            <figure>
                                                <a href='fullblog.php?id={$row['id']}'>
                                                    <img src='{$image_path}' alt='Blog Image' class='img-fluid blog_box_image'>
                                                </a>
                                            </figure>
                                            <div class='box-content'>
                                                <h5 class='box-title'><a  class='box-title' href='fullblog.php?id={$row['id']}'>" . htmlspecialchars($row['title']) . "</a></h5>
                                                <p class='post-desc  mt-5' style='text-align: justify;'>" . substr(strip_tags($row['main_content']), 0, 90) . "...</p>
                                                <a href='fullblog.php?id={$row['id']}'><button class='blog_main_btn'>Read More..</button></a>
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
  
  


  <?php include 'footer.php'; ?>
