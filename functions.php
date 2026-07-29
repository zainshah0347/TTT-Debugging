<?php

// Database connection
$host = "localhost";
$user = "u419293759_blog";
$password = "NM[JkBPmW2j*";
$database = "u419293759_blog";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new post
function addPost($title, $content, $image, $date_posted, $slug) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO posts (title, content, image, date_posted, slug) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $content, $image, $date_posted, $slug);
    $stmt->execute();
    $stmt->close();
}

// Get all posts
function getPosts() {
    global $conn;
    $result = $conn->query("SELECT * FROM posts ORDER BY date_posted DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get a single post by slug
function getPostBySlug($slug) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM posts WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Update post
function updatePost($id, $title, $content, $image, $date_posted, $slug) {
    global $conn;
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, image = ?, date_posted = ?, slug = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $title, $content, $image, $date_posted, $slug, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete post
function deletePost($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
