<?php
include '../../db.connection/db_connection.php'; // DB connection

// Get blog ID from URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($blog_id > 0) {
    // Fetch blog data
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();
        $title = $blog['title'];
        $service = $blog['service'];
        $main_content = $blog['main_content'];
        $full_content = $blog['full_content'];
        $main_image = $blog['main_image'];
        $video = $blog['video'];
        $section_contents = [
            1 => $blog['section1_content'],
            2 => $blog['section2_content'],
            3 => $blog['section3_content']
        ];
        $section_images = [
            1 => $blog['section1_image'],
            2 => $blog['section2_image'],
            3 => $blog['section3_image']
        ];
    } else {
        echo "Blog not found.";
        exit;
    }
    $stmt->close();
} else {
    echo "Invalid blog ID.";
    exit;
}

// Fetch all services dynamically
$services_result = $conn->query("SELECT id, service_name FROM services ORDER BY service_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Edit Blog - Care n Concern Hospital</title>

<!-- Custom fonts and styles -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include 'navbar.php'; ?>
            <!-- End of Topbar -->

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Blog</h1>
                </div>

                <div class="row">
                    <div class="col-xl-11">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">Edit Content</h6>
                            </div>
                            <div class="card-body">

                                <form id="editblogform" action="addBlog.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $blog_id; ?>">

                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Title</label>
                                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
                                    </div>

                                    <!-- Service Dropdown -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Select Service</label>
                                        <select name="service" class="form-control" required>
                                            <option value="">Select a Service</option>
                                            <?php
                                            if ($services_result->num_rows > 0) {
                                                while ($row = $services_result->fetch_assoc()) {
                                                    $selected = ($service == $row['service_name']) ? 'selected' : '';
                                                    echo '<option value="'.htmlspecialchars($row['service_name']).'" '.$selected.'>'
                                                        .htmlspecialchars($row['service_name']).'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Main Content -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Main Content</label>
                                        <div id="mainEditor" style="height:200px;"></div>
                                        <input type="hidden" name="main_content" id="mainContentData">
                                    </div>

                                    <!-- Main Image -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Main Image</label>
                                        <input type="file" name="main_image" class="form-control">
                                        <?php if (!empty($main_image)) { ?>
                                            <img src="uploads/blogs/<?php echo $main_image; ?>" class="img-thumbnail mt-2" style="max-width:200px;">
                                        <?php } ?>
                                    </div>

                                    <!-- Video -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Video</label>
                                        <input type="file" name="video" class="form-control">
                                        <?php if (!empty($video)) { ?>
                                            <video width="300" controls class="mt-2">
                                                <source src="uploads/blogs/<?php echo $video; ?>" type="video/mp4">
                                            </video>
                                        <?php } ?>
                                    </div>

                                    <!-- Full Content -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Full Content</label>
                                        <div id="fullEditor" style="height:400px;"></div>
                                        <input type="hidden" name="full_content" id="fullContentData">
                                    </div>

                                    <!-- Sections -->
                                    <?php for ($i=1; $i<=3; $i++): ?>
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Section <?php echo $i; ?> Content</label>
                                        <div id="editor<?php echo $i; ?>" style="height:200px;"></div>
                                        <input type="hidden" name="section<?php echo $i; ?>_content" id="sectionContent<?php echo $i; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Section <?php echo $i; ?> Image (optional)</label>
                                        <input type="file" name="section<?php echo $i; ?>_image" class="form-control">
                                        <?php if (!empty($section_images[$i])) { ?>
                                            <img src="uploads/blogs/<?php echo $section_images[$i]; ?>" class="img-thumbnail mt-2" style="max-width:200px;">
                                        <?php } ?>
                                    </div>
                                    <?php endfor; ?>

                                    <div class="d-flex gap-2 mt-3">
                                        <button type="reset" class="btn btn-danger">Clear</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    const quillMain = new Quill('#mainEditor', { theme: 'snow' });
    const quillFull = new Quill('#fullEditor', { theme: 'snow' });
    const quillSections = [];
    for(let i=1;i<=3;i++){
        quillSections[i] = new Quill('#editor'+i, { theme:'snow' });
    }

    // Load existing content
    quillMain.root.innerHTML = <?php echo json_encode($main_content); ?>;
    quillFull.root.innerHTML = <?php echo json_encode($full_content); ?>;
    <?php for($i=1;$i<=3;$i++): ?>
        quillSections[<?php echo $i; ?>].root.innerHTML = <?php echo json_encode($section_contents[$i]); ?>;
    <?php endfor; ?>

    // On submit, update hidden fields
    document.querySelector('#editblogform').onsubmit = function(){
        document.querySelector('#mainContentData').value = quillMain.root.innerHTML;
        document.querySelector('#fullContentData').value = quillFull.root.innerHTML;
        <?php for($i=1;$i<=3;$i++): ?>
            document.querySelector('#sectionContent<?php echo $i; ?>').value = quillSections[<?php echo $i; ?>].root.innerHTML;
        <?php endfor; ?>
    };
</script>

<!-- Bootstrap core JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
