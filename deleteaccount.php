<?php
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $email = $_POST["email"];
    $value = intval($_POST["value"]);

deleteaccount($conn, $email,$value);
}
?>
