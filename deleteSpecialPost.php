<?php
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  echo "Form submitted!";
    $id = $_POST["post_id"];
  $sql = "DELETE FROM posts WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (mysqli_stmt_prepare($stmt, $sql)) {
      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);

      if (mysqli_stmt_affected_rows($stmt) > 0) {
          mysqli_stmt_close($stmt);
          header("Location: SpecialPost.php?success=delete");
          exit();
      } else {
          echo "No rows affected. Post may not exist or has already been deleted.";
      }
  } else {
      echo "Error: " . mysqli_error($conn);
  }



  }



?>
