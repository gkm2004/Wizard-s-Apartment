<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT tags FROM gallery");
$r = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My mini camera roll</title>
    <script defer src="js/script.js"></script>
    <link rel="stylesheet" href="css/gallery.css">
</head>
<body>
    <a href="gallery.php">
    <h1 id="heading">✨ My Gallery ✨</h1>
    </a>
    <nav>
    <a href="index.html"> home/</a>
    <a href="projects.html">projects/</a>
        <a href="blog.php">blog</a>
    </nav>

    <!-- ✅ Tag List -->
    <div class="tag-list">
    <?php
    $tag_set = [];

    while ($row = $result->fetch_assoc()) {
        $tags = explode(',', $row['tags']);
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag && !isset($tag_set[$tag])) {
                echo '<a href="#" class="tag" data-tag="' . htmlspecialchars($tag) . '">#' . htmlspecialchars($tag) . '</a>';
                $tag_set[$tag] = true;
            }
        }
    }
    ?>
    </div>

    <div class="gallery-container" id="gallery-area">
    <?php while ($row = $r->fetch_assoc()): ?>
        <div class="gallery-card" data-tags="<?= htmlspecialchars($row['tags']) ?>">
            <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Gallery image" />
            <p><?= htmlspecialchars($row['description']) ?></p>
            <small> <?=date('F j, Y', strtotime($row['uploaded_at']))?> </small>
            <small><?= htmlspecialchars($row['tags']) ?></small>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>

<?php $conn->close(); ?>
