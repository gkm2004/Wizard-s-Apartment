<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selected_tag = isset($_GET['tag']) ? trim($_GET['tag']) : null;

$result = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");

$images = [];
$all_tags = [];

while ($row = $result->fetch_assoc()) {
    $tags = array_map('trim', explode(',', $row['tags']));
    $row['tag_array'] = $tags;
    $images[] = $row;

    foreach ($tags as $tag) {
        if ($tag) {
            $all_tags[$tag] = true;
        }
    }
}

$filtered_images = [];
foreach ($images as $img) {
    if (!$selected_tag || in_array($selected_tag, $img['tag_array'])) {
        $filtered_images[] = $img;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>✨ My Gallery ✨</title>
    <link rel="stylesheet" href="css/gallery.css">
</head>
<body>
<h1 id="heading">✨ My Gallery ✨</h1>
    </a>
    <nav>
    <a href="index.html"> home/</a>
    <a href="projects.html">projects/</a>
        <a href="blog.php">blog</a>
    </nav>

    <div class="tag-list">
        <?php foreach ($all_tags as $tag => $_): ?>
            <a href="gallery.php?tag=<?= urlencode($tag) ?>" class="tag<?= ($selected_tag === $tag ? ' active' : '') ?>">#<?= htmlspecialchars($tag) ?></a>
        <?php endforeach; ?>
    </div>

    <?php if ($selected_tag): ?>
        <div class="filter-notice">
            Showing images tagged: <strong>#<?= htmlspecialchars($selected_tag) ?></strong>
            <a href="gallery.php">(clear)</a>
        </div>
    <?php endif; ?>

    <div class="gallery-container" id="gallery-area">
        <?php foreach ($filtered_images as $img): ?>
            <div class="gallery-card" data-tags="<?= htmlspecialchars($img['tags']) ?>">
                <img src="<?= htmlspecialchars($img['image_path']) ?>" alt="Gallery image" width="250">
                <p><?= htmlspecialchars($img['description']) ?></p>
                <small><?= htmlspecialchars($img['tags']) ?> | <?= date('F j, Y', strtotime($img['uploaded_at'])) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
