<?php
require 'config.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    // Insert blog post into the database
    $stmt = $conn->prepare("INSERT INTO blogposts (title, author, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $content);
    $stmt->execute();
    $blog_id = $stmt->insert_id; // Get the inserted blog post ID
    $stmt->close();

    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = "uploads/";
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['images']['name'][$key]);
            $target_file = $upload_dir . time() . "_" . $file_name;

            if (move_uploaded_file($tmp_name, $target_file)) {
                // Store image URL in the database
                $stmt = $conn->prepare("INSERT INTO blog_images (blog_id, image_url) VALUES (?, ?)");
                $stmt->bind_param("is", $blog_id, $target_file);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Redirect back to blog list
    header("Location: blog.php?success=1");
    exit();
} else {
    header("Location: write_blog.php");
    exit();
}
?>
