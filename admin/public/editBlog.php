<?php
// DB Connection
include '../../db.connection/db_connection.php';

// Blog ID
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($blog_id <= 0) {
    echo "Invalid blog ID";
    exit;
}

// Fetch blog
$stmt = $conn->prepare("
    SELECT 
        title,
        main_content,
        full_content,
        service,
        telugu_title,
        telugu_main_content,
        telugu_full_content,
        video,
        section1_image
    FROM blogs
    WHERE id = ?
");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$stmt->bind_result(
    $title,
    $main_content,
    $full_content,
    $service,
    $telugu_title,
    $telugu_main_content,
    $telugu_full_content,
    $video,
    $section1_image
);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">
<?php include 'sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include 'navbar.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Edit Blog</h1>

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Edit Blog Content</h6>
</div>

<div class="card-body">

<form id="editblogform" action="addBlog.php" method="POST" enctype="multipart/form-data">

<!-- ENGLISH TITLE -->
<div class="mb-3">
    <label class="text-primary">Title (English)</label>
    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($title) ?>" required>
</div>

<!-- TELUGU TITLE -->
<div class="mb-3">
    <label class="text-primary">Title (Telugu)</label>
    <input type="text" name="telugu_title" class="form-control" value="<?= htmlspecialchars($telugu_title) ?>">
</div>

<!-- SERVICE -->
<div class="mb-3">
<label class="text-primary">Service</label>
<select name="service" class="form-control" required>
<?php

foreach ($services as $s) {
    $sel = ($service == $s) ? "selected" : "";
    echo "<option value='$s' $sel>$s</option>";
}
?>
</select>
</div>

<!-- MAIN CONTENT EN -->
<div class="mb-3">
<label class="text-primary">Main Content (English)</label>
<div id="mainEditor" style="height:200px"></div>
<input type="hidden" name="main_content" id="mainContentData">
</div>

<!-- MAIN CONTENT TE -->
<div class="mb-3">
<label class="text-primary">Main Content (Telugu)</label>
<div id="teluguMainEditor" style="height:200px"></div>
<input type="hidden" name="telugu_main_content" id="teluguMainContentData">
</div>

<!-- FULL CONTENT EN -->
<div class="mb-3">
<label class="text-primary">Full Content (English)</label>
<div id="fullEditor" style="height:300px"></div>
<input type="hidden" name="full_content" id="fullContentData">
</div>

<!-- FULL CONTENT TE -->
<div class="mb-3">
<label class="text-primary">Full Content (Telugu)</label>
<div id="teluguFullEditor" style="height:300px"></div>
<input type="hidden" name="telugu_full_content" id="teluguFullContentData">
</div>

<!-- MAIN IMAGE -->
<div class="mb-3">
<label class="text-primary">Main Image</label>
<input type="file" name="main_image" class="form-control">
</div>

<!-- VIDEO -->
<div class="mb-3">
<label class="text-primary">Video</label>
<input type="file" name="video" class="form-control">
<?php if ($video) { ?>
<small>
Current Video :
<a href="../../uploads/videos/<?= $video ?>" target="_blank">View</a>
</small>
<?php } ?>
</div>

<!-- 🔥 SECTION 1 IMAGE -->
<div class="mb-3">
<label class="text-primary">Section 1 Image</label>
<input type="file" name="section1_image" class="form-control">

<?php if ($section1_image) { ?>
<div class="mt-2">
    <small>Current Image:</small><br>
    <img src="../../uploads/photos/<?= $section1_image ?>"
         style="max-width:220px;border:1px solid #ccc;padding:5px;">
</div>
<?php } ?>
</div>

<input type="hidden" name="id" value="<?= $blog_id ?>">
<input type="hidden" name="old_section1_image" value="<?= $section1_image ?>">

<div class="row mt-4">
<div class="col-md-8"></div>
<button type="reset" class="btn btn-danger col-md-2">Clear</button>
<button type="submit" class="btn btn-success col-md-2">Update</button>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
const quillMain = new Quill('#mainEditor',{theme:'snow'});
const quillTeluguMain = new Quill('#teluguMainEditor',{theme:'snow'});
const quillFull = new Quill('#fullEditor',{theme:'snow'});
const quillTeluguFull = new Quill('#teluguFullEditor',{theme:'snow'});

// Load data safely
quillMain.root.innerHTML = <?= json_encode($main_content) ?>;
quillTeluguMain.root.innerHTML = <?= json_encode($telugu_main_content) ?>;
quillFull.root.innerHTML = <?= json_encode($full_content) ?>;
quillTeluguFull.root.innerHTML = <?= json_encode($telugu_full_content) ?>;

document.getElementById('editblogform').onsubmit = function () {
    document.getElementById('mainContentData').value = quillMain.root.innerHTML;
    document.getElementById('teluguMainContentData').value = quillTeluguMain.root.innerHTML;
    document.getElementById('fullContentData').value = quillFull.root.innerHTML;
    document.getElementById('teluguFullContentData').value = quillTeluguFull.root.innerHTML;
};
</script>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>



$services = ["Root Canal", "Wisdom Tooth Removal", "Bad Breath Treatment", "Gum Treatment", "Teeth Cleaning", "Orthodontic Treatment", "Dental Crown & Bridge", "Invisible Aligners", "Dental Veneers", "Smile Makeover", "Teeth Whitening", "Dental Implants", "Dentures", "Smile Designing", "Full Mouth Rehabilitation Treatment"];

