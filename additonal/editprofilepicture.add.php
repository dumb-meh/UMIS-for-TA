<?php
session_start();
require_once 'dbh.add.php';
require_once 'functions.add.php';

if (isset($_POST['button'])){
  $email = $_SESSION["email"];
  $image = $_FILES['justwork']['name'];
  $sql = "UPDATE users SET image=? WHERE usersEmail=?;";
  $stmt = mysqli_stmt_init($conn);

  $extension = pathinfo($_FILES['justwork']['name'], PATHINFO_EXTENSION);
  $new_file_name = "profile_" . $email . "." . $extension;
  $destination_path = "../img/profilepic/" . $new_file_name;

  $old_file_name = "profile_" . $email . ".*";
  $old_files = glob("../img/profilepic/" . $old_file_name);
  foreach ($old_files as $old_file) {
    unlink($old_file);
  }

  if (!move_uploaded_file($_FILES["justwork"]["tmp_name"], $destination_path)) {
    header("location: ../profile.php?error=uploadfailed");
    exit();
  }

  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../profile.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $new_file_name, $email);
  $run = mysqli_stmt_execute($stmt);
  if ($run) {
    header("location: ../profile.php?error=none2");
    exit();
  }
}
