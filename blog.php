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


<?php include 'header.php';?>


  <main>
    <!-- Filter Buttons -->
   <div class="container">
      <!-- <div class="filter_buttons redirect_section mt-4">
        <a href="blogs.php?service="><button class="redirect_blog_srivice">All</button></a>
        <a href="blogs.php?service=Root Canal"><button class="redirect_blog_srivice">Root Canal</button></a>
        <a href="blogs.php?service=Teeth Braces"><button class="redirect_blog_srivice">Teeth Braces</button></a>
        <a href="blogs.php?service=Pediatric Dentist"><button class="redirect_blog_srivice"> Pediatric Dentist</button></a>
        <a href="blogs.php?service=Paedodontist Doctors"><button class="redirect_blog_srivice">Paedodontist Doctors </button></a>
        <a href="blogs.php?service=Clear Aligners"><button class="redirect_blog_srivice"> Clear Aligners</button></a>
        <a href="blogs.php?service=Laminate Veneers"><button class="redirect_blog_srivice">Laminate Veneers</button></a>
        <a href="blogs.php?service=Crown Bridge"><button class="redirect_blog_srivice">Crown & Bridge</button></a>
        <a href="blogs.php?service=Dental Implant"><button class="redirect_blog_srivice">Dental Implant</button></a>
        <a href="blogs.php?service=Dentures Treatments"><button class="redirect_blog_srivice">Dentures Treatments</button></a>
        <a href="blogs.php?service=Invisalign"><button class="redirect_blog_srivice">Invisalign </button></a>
        <a href="blogs.php?service=Jaw Corrective"><button class="redirect_blog_srivice">Jaw Corrective</button></a>
        <a href="blogs.php?service=Laser Gum"><button class="redirect_blog_srivice">Laser & Gum</button></a>
        <a href="blogs.php?service=Smile Designing"><button class="redirect_blog_srivice">Smile Designing</button></a>
        <a href="blogs.php?service=Smile Makeover"><button class="redirect_blog_srivice">Smile Makeover</button></a>
        <a href="blogs.php?service=Teeth Alignment"><button class="redirect_blog_srivice"> Teeth Alignment</button></a>
        <a href="blogs.php?service=Tooth Extraction"><button class="redirect_blog_srivice">Tooth Extraction</button></a>
        <a href="blogs.php?service=Tooth Cleaning"><button class="redirect_blog_srivice">Tooth Cleaning</button></a>
        <a href="blogs.php?service=Gum Depigment"><button class="redirect_blog_srivice">Gum Depigment</button></a>
        <a href="blogs.php?service=Teeth Whitening"><button class="redirect_blog_srivice">Teeth Whitening</button></a>
        <a href="blogs.php?service=Laser Gum Surgery"><button class="redirect_blog_srivice">Laser Gum Surgery</button></a>
        <a href="blogs.php?service=Mouth Ulcers"><button class="redirect_blog_srivice">Mouth Ulcers</button></a>
        <a href="blogs.php?service=Precancerous Lesion"><button class="redirect_blog_srivice">Precancerous Lesion</button></a>
        <a href="blogs.php?service=Laser Crown Lengthening"><button class="redirect_blog_srivice">Laser Crown Lengthening</button></a>
      </div> -->
  <h1 class="d-flex justify-content-center"> blogs</h1>
  
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
                                    <div class='grid-item col-sm-12 col-lg-4 mb-5'>
                                        <div class='post-box card_bg_div_box'>
                                            <figure>
                                                <a href='service_detsils.php?id={$row['id']}'>
                                                    <img src='{$image_path}' alt='Blog Image' class='img-fluid blog_box_image'>
                                                </a>
                                            </figure>
                                            <div class='box-content'>
                                                <h5 class='box-title'><a  class='box-title' href='service_detsils.php?id={$row['id']}'>" . htmlspecialchars($row['title']) . "</a></h5>
                                                <p class='post-desc  mt-5' style='text-align: justify;'>" . substr(strip_tags($row['main_content']), 0, 90) . "...</p>
                                                <a href='service_detsils.php?id={$row['id']}'><button class='blog_main_btn'>Read More..</button></a>
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