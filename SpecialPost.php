<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'additonal/dbh.add.php';
$role=$_SESSION['role'];
$email=$_SESSION['email'];
if ($role!==2)
{
  require_once 'userheader.php';
}

if ($role==2)
{
  require_once 'adminheader.php';
}


if(isset($_GET["success"])){
  if ($_GET["success"] == "delete") {
      echo '<div style="color:black; text-align: center; margin-top: 20px;">Post deleted Successfully</div>';
  }
}

function getSpecialPosts($conn, $page, $perPage, $role, $email)
{
    $offset = ($page - 1) * $perPage;

    if ($role == 0) {
        $sql = "SELECT * FROM posts WHERE visibility='TA' and email!='$email' LIMIT $perPage OFFSET $offset";
    } elseif ($role == 1) {
        $sql = "SELECT * FROM posts WHERE visibility='TA' or visibility='Faculty' and email!='$email' LIMIT $perPage OFFSET $offset";
    } elseif ($role == 2) {
        $sql = "SELECT * FROM posts WHERE email!='$email' LIMIT $perPage OFFSET $offset";
    }

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

$specialPosts = getSpecialPosts($conn, $page, $perPage,$role,$email);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Public Post Cards</title>

    <style>


        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            text-align: left;
            width: 30%;
            min-width: 250px;
            max-height: 300px;
            transition: box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        .cards-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
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
            align-self: center; /* Center the pagination */
        }

        .pagination a {
            color: white;
            margin: 0 5px;
            text-decoration: none;
        }

        .pagination .active {
            color: yellow;
        }

        .delete-button {
    display: inline-block;
    font-weight: 400;
    color: #dc3545;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    border: 1px solid #dc3545;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    text-decoration: none;
}

.delete-button:hover {
    cursor: pointer;
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
    </style>

</head>
<body>
  <div class="cards-container">
      <?php foreach ($specialPosts as $post): ?>
          <div class="card">
              <div class="card-title">Title: <?php echo $post['title']; ?></div>
              <div class="card-body-preview"><?php echo substr($post['body'], 0, 100); ?>...</div>
              <div class="card-author">Author- <?php echo $post['author']; ?></div>
              <div class="card-author">Visibility: <?php echo $post['visibility']; ?></div>

              <?php if ($role == 2): ?>
                <form action="deleteSpecialPost.php" method="post" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <button class="delete-button" type="submit" name="submit">Delete</button>
                </form>

              <?php endif; ?>

              <a class="card-show-more" href="showSpecialPost.php?id=<?php echo $post['id']; ?>">Show More</a>
          </div>
          <br>
      <?php endforeach; ?>
  </div>




  <div class="pagination">
      <span style="color:white;">Pages:</span>
      <?php
      if ($role == 0) {
          $sql = "SELECT COUNT(*) AS total FROM posts WHERE visibility='TA' and email!='$email'";
      } elseif ($role == 1) {
          $sql = "SELECT COUNT(*) AS total FROM posts WHERE visibility='TA' or visibility='Faculty' and email!='$email'";
      } elseif ($role == 2) {
          $sql = "SELECT COUNT(*) AS total FROM posts WHERE email!='$email'";
      }

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $totalRecords = $row['total'];
      $totalPages = ceil($totalRecords / $perPage);

      for ($i = 1; $i <= $totalPages; $i++) {
          echo '<a href="?page=' . $i . '" class="' . ($i == $page ? 'active' : '') . '">' . $i . '</a>';
      }

      ?>
  </div>


</div>

</body>
</html>
