<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get slug from URL
$slug = $_GET['slug'] ?? '';

// Prepare and execute query
$stmt = $conn->prepare("SELECT title, content, cover_image, published_at FROM blogposts WHERE slug = ? AND status = 'published' LIMIT 1");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= $post ? htmlspecialchars($post['title']) : 'Post Not Found' ?> - Witch's Blog</title>
    <link rel="stylesheet" href="css/style1.css" />
</head>
<body>
   
    <h1 id="heading">✨Blog✨</h1>
    
    <nav>
        <a href="gallery.php">gallery/</a>
        <a href="projects.html">projects/</a>
        <a href="wizards-closet.html">home/</a>
        <a href="blog.php">back</a>
    </nav>

    <section class="section">
   <?php if ($post) {
    echo '    <h2>' . htmlspecialchars($post['title']) . '</h2>';
    echo '    <small>' . date('F j, Y', strtotime($post['published_at'])) . '</small>';
    echo '    <div class="post-body">';
    echo '    <div class="post-image">';
    echo '        <img src="' . htmlspecialchars($post['cover_image']) . '" alt="Cover Image" />';
    echo '    </div>';
    echo       nl2br(htmlspecialchars($post['content']));
    echo '    </div>';
    } else {
    echo '    <p> Sorry, this post does not exist or is unpublished.</p>';
}
?>
    </section>
</body>
</html>

<?php
$conn->close();
?>
