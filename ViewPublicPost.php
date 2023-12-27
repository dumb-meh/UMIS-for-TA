<?php
include_once 'header.php';
require_once 'additonal/dbh.add.php';

function getPublicPosts($conn, $page, $perPage)
{
    $offset = ($page - 1) * $perPage;

    $sql = "SELECT * FROM posts WHERE visibility='Public' LIMIT $perPage OFFSET $offset";
    $result = mysqli_query($conn, $sql);


    if ($result) {
        $posts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }

        mysqli_free_result($result);

        return $posts;
    } else {

        return false;
    }
}

$perPage = 6;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;


$publicPosts = getPublicPosts($conn, $page, $perPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Public Post Cards</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #344a72;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 100px;
    }

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; 
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 20px;
        text-align: left;
        width: 30%;
        min-width: 350px;
        min-height: 300px;
        transition: box-shadow 0.3s ease;
        box-sizing: border-box;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-body-preview {
        font-size: 1em;
        color: #555;
        margin-bottom: 10px;
    }

    .card-author {
        font-size: 0.9em;
        color: #888;
    }

    .card-show-more {
        background-color: #4caf50;
        color: white;
        padding: 8px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9em;
        text-decoration: none;
        display: inline-block;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        color: white;
        margin: 0 5px;
        text-decoration: none;
    }

    .pagination .active {
        color: yellow;
    }

    </style>
</head>
<body>
    <div class="cards-container">
        <?php foreach ($publicPosts as $post): ?>
            <div class="card">
                <div class="card-title">Title: <?php echo $post['title']; ?></div>
                <div class="card-body-preview"><?php echo substr($post['body'], 0, 100); ?>...</div>
                <div class="card-author">Author- <?php echo $post['author']; ?></div>
                <a class="card-show-more" href="showpost.php?id=<?php echo $post['id']; ?>">Show More</a>
            </div>
            <br>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <span style="color:white;">Pages:</span>
        <?php
        $sql = "SELECT COUNT(*) AS total FROM posts WHERE visibility='Public'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalRecords = $row['total'];
        $totalPages = ceil($totalRecords / $perPage);

        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '" class="' . ($i === $page ? 'active' : '') . '">' . $i . '</a>';
        }
        ?>
    </div>
</body>

</html>
