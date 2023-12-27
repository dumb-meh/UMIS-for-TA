<?php
include_once 'header.php';
require_once 'additonal/dbh.add.php';

// Check if the ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = $_GET['id'];

    // Fetch the full post details based on the ID
    $sql = "SELECT * FROM posts WHERE id = $postId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        echo '<p style="color: red;">Error: Post not found</p>';
        exit;
    }
} else {
    echo '<p style="color: red;">Error: Invalid post ID</p>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Show Post</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #344a72;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .post-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            text-align: left;
            width: 60%;
            box-sizing: border-box;
        }

        .post-title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .post-body {
            font-size: 1em;
            color: #555;
            margin-bottom: 20px;
        }

        .post-author {
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>

<div class="post-container">
    <div class="post-title"><?php echo $post['title']; ?></div>
    <div class="post-body"><?php echo nl2br($post['body']); ?></div>
    <div class="post-author">Author: <?php echo $post['author']; ?></div>
</div>

</body>
</html>
