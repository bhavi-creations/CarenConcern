<?php
include './db.connection/db_connection.php';

/* ---------------- BLOG ID ---------------- */
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($blog_id <= 0) {
    echo "Invalid Blog ID";
    exit;
}

/* ---------------- PATH CONFIG ---------------- */
$photoUrl = "admin/uploads/photos/";
$photoDir = __DIR__ . "/admin/uploads/photos/";
$videoUrl = "admin/uploads/videos/";
$videoDir = __DIR__ . "/admin/uploads/videos/";
$defaultImage = "https://mailrelay.com/wp-content/uploads/2018/03/que-es-un-blog-1.png";

/* ---------------- FETCH BLOG ---------------- */
$stmt = $conn->prepare("
    SELECT 
        title, main_content, full_content,
        title_image, main_image, video,
        telugu_title, telugu_main_content, telugu_full_content,
        section1_image
    FROM blogs WHERE id=?
");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$stmt->bind_result(
    $title,
    $main_content,
    $full_content,
    $title_image,
    $main_image,
    $video,
    $telugu_title,
    $telugu_main_content,
    $telugu_full_content,
    $section1_image
);
$stmt->fetch();
$stmt->close();

/* ---------------- LIKE / DISLIKE ---------------- */
$count_stmt = $conn->prepare("
    SELECT 
        SUM(reaction='like'),
        SUM(reaction='dislike')
    FROM blog_reactions WHERE blog_id=?
");
$count_stmt->bind_param("i", $blog_id);
$count_stmt->execute();
$count_stmt->bind_result($likes_count, $dislikes_count);
$count_stmt->fetch();
$count_stmt->close();

/* ---------------- IMAGE RESOLVE ---------------- */
$sectionImg = (!empty($section1_image) && file_exists($photoDir.$section1_image))
    ? $photoUrl.$section1_image : $defaultImage;

$mainImg = (!empty($main_image) && file_exists($photoDir.$main_image))
    ? $photoUrl.$main_image : '';

$videoPath = (!empty($video) && file_exists($videoDir.$video))
    ? $videoUrl.$video : '';

$conn->close();
?>

<?php include 'header.php'; ?>

<main>
<div class="container blog-detailed" style="padding-top:50px;">

<!-- SECTION IMAGE -->
<div class="text-center mb-4">
    <img src="<?= $sectionImg ?>" class="img-fluid" style="max-width:600px;">
</div>

<!-- VIDEO / IMAGE -->
<div class="text-center mb-4">
<?php if ($videoPath): ?>
    <video controls style="max-width:700px;">
        <source src="<?= $videoPath ?>" type="video/mp4">
    </video>
<?php elseif ($mainImg): ?>
    <img src="<?= $mainImg ?>" class="img-fluid" style="max-width:700px;">
<?php endif; ?>
</div>

<!-- TITLE -->
<h4 class="blog-title text-center mt-5" style="color:#283779;font-weight:800;">
    <?= htmlspecialchars($title) ?>
</h4>

<!-- CONTENT -->
<div class="main-content" style="text-align:justify;">
    <?= $main_content ?>
</div>

<div class="full-content">
    <?= $full_content ?>
</div>

<!-- LIKE / DISLIKE -->
<div class="d-flex justify-content-center mt-4">
    <button id="like-btn" class="btn btn-outline-success me-3">
        👍 Like (<span id="like-count"><?= $likes_count ?? 0 ?></span>)
    </button>
    <button id="dislike-btn" class="btn btn-outline-danger">
        👎 Dislike (<span id="dislike-count"><?= $dislikes_count ?? 0 ?></span>)
    </button>
</div>

</div>

<!-- LATEST BLOGS -->
<div class="container my-5">
<h1 class="text-center mb-4">LATEST BLOGS</h1>

<div class="swiper blog-swiper">
<div class="swiper-wrapper">

<?php
include './db.connection/db_connection.php';
$res = $conn->query("SELECT id,title,main_image FROM blogs ORDER BY created_at DESC");

while ($row = $res->fetch_assoc()):
    $sideImg = (!empty($row['main_image']) && file_exists($photoDir.$row['main_image']))
        ? $photoUrl.$row['main_image'] : $defaultImage;
?>
<div class="swiper-slide">
    <div class="custom-card text-center">
        <img src="<?= $sideImg ?>" class="img-fluid" style="height:250px;object-fit:cover;">
        <a href="fullblog.php?id=<?= $row['id'] ?>">
            <p class="mt-2"><?= substr($row['title'],0,50) ?>...</p>
        </a>
    </div>
</div>
<?php endwhile; $conn->close(); ?>

</div>
</div>
</div>
</main>

<?php include 'footer.php'; ?>

<!-- LIKE SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded",()=>{
const blogId=<?= json_encode($blog_id) ?>;
const likeBtn=document.getElementById("like-btn");
const dislikeBtn=document.getElementById("dislike-btn");
let voted=localStorage.getItem("blog_vote_"+blogId);
if(voted){likeBtn.disabled=true;dislikeBtn.disabled=true;}

function vote(type){
fetch("update_vote.php",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`blog_id=${blogId}&vote_type=${type}`})
.then(r=>r.json()).then(d=>{
document.getElementById("like-count").textContent=d.new_likes;
document.getElementById("dislike-count").textContent=d.new_dislikes;
localStorage.setItem("blog_vote_"+blogId,type);
likeBtn.disabled=true;dislikeBtn.disabled=true;
});
}
likeBtn.onclick=()=>vote("like");
dislikeBtn.onclick=()=>vote("dislike");
});
</script>

<script>
new Swiper(".blog-swiper",{slidesPerView:3,spaceBetween:20,loop:true,
breakpoints:{0:{slidesPerView:1},768:{slidesPerView:2},1024:{slidesPerView:3}}});
</script>

</body>
</html>
