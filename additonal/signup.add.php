<?php
if (isset($_POST["submit"])) {

$name = $_POST["name"];
$email = $_POST["email"];
$role = $_POST["role"];
$pwd = $_POST["pwd"];
$rptpwd = $_POST["rptpwd"];

require_once 'dbh.add.php';
require_once 'functions.add.php';

if(emptyInputSignup($name, $email, $pwd, $rptpwd)!== false){
  header("location: ../signup.php?error=emptyinput");
  exit();
}


if(invalidUid($email)){
  header("location: ../signup.php?error=invaliduid");
  exit();
}

if(invalidEmail($email)!== false){
  header("location: ../signup.php?error=invalidemail");
  exit();
}

if(pwdMatch($pwd, $rptpwd)!== false){
  header("location: ../signup.php?error=passmissmatch");
  exit();
}

if(uidExists($conn, $email)!== false){
  header("location: ../signup.php?error=usernametaken");
  exit();
}
createUser($conn,$name, $email, $pwd,$role);
}

else {
  header("location: ../signup.php");
}
