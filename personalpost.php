<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';

if($_SESSION['role']!=2){
  require_once 'userheader.php';
}

if($_SESSION['role']==2){
  require_once 'adminheader.php';
}

$recordsPerPage = 5;
$email=$_SESSION['email'];
if(isset($_GET["success"])){
  if ($_GET["success"] == "delete") {
      echo '<div style="color:black; text-align: center; margin-top: 20px;">Post deleted Successfully</div>';
  }
}

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1;
}

$offset = ($currentPage - 1) * $recordsPerPage;

?>

<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>View Posts</title>
    <link rel="stylesheet" href="test.css">


</head>
<body>
<div class="card1" >
  <form action="createpost.php" method="post" >
      <button class="button login_submit2" type="submit" name="submit"><span class="button__text">Create Post</span></button>
      <br>
      <br>
  </form>
    <table width="800px" border='10' cellpadding='10' style='border:3px solid skyblue; border-collapse:collapse'>
        <thead>
        <tr>
            <th width="150px">Title</th>
            <th width="200px">Body</th>
            <th width="100px">Author</th>
            <th width="100px">Visibility</th>
            <th width=75px>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM posts where email='$email' LIMIT $recordsPerPage OFFSET $offset";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td align="center">' . $row['title'] . '</td>';
                echo '<td align="center">' . $row['body'] . '</td>';
                echo '<td align="center">' . $row['author'] . '</td>';
                echo '<td align="center">' . $row['visibility'] . '</td>';
                echo '<td align="center">
                    <form action="deletepost.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this?\');">
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <button class="button login__submit" type="submit" name="submit"><span class="button__text">Delete</span></button>
                    </form>
                </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4" align="center">No posts found</td></tr>';
        }
        ?>
        </tbody>
    </table>

    <?php
    $sql = "SELECT COUNT(*) AS total FROM posts where email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalRecords = $row['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

    echo '<div style="margin-top: 20px; width: 100px; color: white;">';
    echo "<p style='color: black; display: inline-block; margin-right: 10px;'>Pages:</p>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '" style="color: black !important; display: inline-block; margin-right: 5px;">' . $i . '</a>';
    }
    echo '</div>';

    ?>
</div>
</body>
</html>
