<?php
require_once 'additonal/dbh.add.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $email = $_POST["email"];
    

    $sql = "UPDATE users SET active = 1 WHERE usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        header("Location: accountapprove.php?success=approve");
        exit();
    } else {

        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
