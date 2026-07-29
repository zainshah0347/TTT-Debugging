<?php
include('functions.php');

// Handle new post submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $date_posted = date('Y-m-d');
    $slug = strtolower(str_replace(' ', '-', $title));

    addPost($title, $content, $image, $date_posted, $slug);
    header("Location: dashboard.php"); // Redirect after adding a post
}

$posts = getPosts(); // Fetch all posts
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Dashboard</title>
</head>
<body>

    <h1>Blog Dashboard</h1>

    <form method="POST">
        <input type="text" name="title" placeholder="Post Title" required><br>
        <textarea name="content" placeholder="Post Content" required></textarea><br>
        <input type="text" name="image" placeholder="Image URL" required><br>
        <button type="submit" name="add_post">Add Post</button>
    </form>

    <h2>Existing Posts</h2>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <a href="post.php?slug=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
                <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $post['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
