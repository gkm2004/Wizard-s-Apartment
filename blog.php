<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blogposts
$sql = "SELECT * FROM blogposts ORDER BY published_at DESC;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Witch's Blog</title>
    <link rel="stylesheet" href="css/style1.css" />
</head>
<body>
    <h1 id="heading">✨Blog✨</h1>
    <nav>
        <a href="gallery.php">gallery/</a>
        <a href="projects.html">projects/</a>
        <a href="index.html"> home</a>
    </nav>

    <section class="section">
    <p>Posts:</p>
    <?php 
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<a href="post.php?slug=' . htmlspecialchars($row['slug']) . '">';
        echo '<strong>' . htmlspecialchars($row['title']) . '</strong></a><br>';
        echo '<small>' . date('F j, Y', strtotime($row['published_at'])) . '</small>';        
        echo '</div>';
    }
    ?>
</section>

</body>
</html>

<?php
$conn->close();
?>
