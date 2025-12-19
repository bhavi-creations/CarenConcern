<?php
include './db.connection/db_connection.php';

// SERVICE FILTER
$service = isset($_GET['service']) ? $_GET['service'] : '';

// BASE QUERY
$sql = "SELECT id, title, main_content, main_image, created_at FROM blogs";

// APPLY SERVICE FILTER
if (!empty($service)) {
    $sql .= " WHERE service = ?";
}

$sql .= " ORDER BY created_at DESC";

// PREPARE
$stmt = $conn->prepare($sql);

// BIND IF FILTER EXISTS
if (!empty($service)) {
    $stmt->bind_param("s", $service);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; ?>

<main>

<!-- FILTER BUTTONS -->
<div class="container">
  <div class="filter_buttons redirect_section mt-4">
    <a href="blogs_srinivasa_multispeciality_dental_hospital.php"><button class="redirect_blog_srivice">All</button></a>
    <a href="?service=Root Canal"><button class="redirect_blog_srivice">Root Canal</button></a>
    <a href="?service=Dental Braces"><button class="redirect_blog_srivice">Dental Braces</button></a>
    <a href="?service=Clear Aligners"><button class="redirect_blog_srivice">Clear Aligners</button></a>
    <a href="?service=Dental Implant"><button class="redirect_blog_srivice">Dental Implant</button></a>
    <a href="?service=Crown Bridge"><button class="redirect_blog_srivice">Crown & Bridge</button></a>
    <a href="?service=Teeth Filling"><button class="redirect_blog_srivice">Teeth Filling</button></a>
    <a href="?service=Dentures"><button class="redirect_blog_srivice">Dentures</button></a>
    <a href="?service=Teeth Scaling"><button class="redirect_blog_srivice">Teeth Scaling</button></a>
    <a href="?service=Tooth Extraction"><button class="redirect_blog_srivice">Tooth Extraction</button></a>
    <a href="?service=Teeth Cleaning"><button class="redirect_blog_srivice">Teeth Cleaning</button></a>
    <a href="?service=Teeth Whitening"><button class="redirect_blog_srivice">Teeth Whitening</button></a>
    <a href="?service=Smile Makeover"><button class="redirect_blog_srivice">Smile Makeover</button></a>
    <a href="?service=Full Mouth Restoration"><button class="redirect_blog_srivice">Full Mouth Restoration</button></a>
  </div>
</div>

<!-- BLOG LIST -->
<div class="container blog-sidebar-list py-4">
  <div class="row">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $image_path = !empty($row['main_image'])
                ? "admin/uploads/photos/{$row['main_image']}"
                : "default_image.png";

            echo "
            <div class='col-sm-12 col-lg-4 mb-5'>
              <div class='post-box card_bg_div_box'>
                <figure>
                  <a href='service_detsils.php?id={$row['id']}'>
                    <img src='{$image_path}' class='img-fluid blog_box_image'>
                  </a>
                </figure>
                <div class='box-content'>
                  <h5 class='box-title'>
                    <a href='service_detsils.php?id={$row['id']}'>
                      ".htmlspecialchars($row['title'])."
                    </a>
                  </h5>
                  <p class='post-desc mt-3' style='text-align:justify;'>
                    ".substr(strip_tags($row['main_content']),0,90)."...
                  </p>
                  <a href='service_detsils.php?id={$row['id']}'>
                    <button class='blog_main_btn'>Read More..</button>
                  </a>
                </div>
              </div>
            </div>";
        }
    } else {
        echo "<p class='text-center'>No blog posts found.</p>";
    }
    ?>
  </div>
</div>

</main>

<?php
$stmt->close();
$conn->close();
include 'footer.php';
?>
