<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tag = $_GET['tag'] ?? '';

if ($tag === 'all') {
    $query = "SELECT * FROM gallery ORDER BY uploaded_at DESC";
    $stmt = $conn->prepare($query);
} else {
    $query = "SELECT * FROM gallery WHERE tags LIKE ? ORDER BY uploaded_at DESC";
    $stmt = $conn->prepare($query);
    $like = "%" . $tag . "%";
    $stmt->bind_param("s", $like);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo '<div class="gallery-card" data-tags="' . htmlspecialchars($row['tags']) . '">';
    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Gallery image">';
    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
    echo "<small>" . date('F j, Y', strtotime($row['uploaded_at'])) . "</small>\n\n";
    echo '<small>' . htmlspecialchars($row['tags']) . '</small>';
    echo '</div>';
}

$conn->close();
?>
