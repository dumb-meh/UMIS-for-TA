<?php
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id = $_POST["id"];


deletePost($conn, $id);
}
?>
