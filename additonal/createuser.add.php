<?php
session_start();
if (isset($_POST["submit"])) {

$name = $_POST["name"];
$email = $_POST["email"];
$role = $_POST["role"];
$pwd = $_POST["pwd"];
$rptpwd = $_POST["rptpwd"];
$active=1;

require_once 'dbh.add.php';
require_once 'functions.add.php';
if(emptyInputSignup($name, $email, $pwd, $rptpwd)!== false){
  header("location: ../createuser.php?error=emptyinput");
  exit();
}


if(invalidUid($email)){
  header("location: ../createuser.php?error=invaliduid");
  exit();
}

if(invalidEmail($email)!== false){
  header("location: ../createuser.php?error=invalidemail");
  exit();
}

if(pwdMatch($pwd, $rptpwd)!== false){
  header("location: ../createuser.php?error=passmissmatch");
  exit();
}

if(uidExists($conn, $email)!== false){
  header("location: ../createuser.php?error=usernametaken");
  exit();
}

  $sql="INSERT INTO users (usersName, usersEmail, usersPwd,role,active) VALUES (?,?,?,?,?);" ;
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../createuser.php?error=stmtfailed");
    exit();
  }

  $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssii", $name, $email, $hashedPwd,$role,$active);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../createuser.php?error=none");
    exit();
}

else {
  header("location: ../createuser.php");
}
