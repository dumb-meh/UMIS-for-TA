<?php
require_once 'adminheader.php';
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';


if (isset($_GET["success"])) {
    if ($_GET["success"] == "delete") {
        echo '<div style="color: black; text-align: center; margin-top: 20px;">Message deleted Successfully</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $messageId = $_POST["message_id"];
    deletemessage($conn,$messageId );


}


$recordsPerPage = 4;

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
    <title>Contact Us Messages</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
<div class=card1>
    <table width=800px border='10' cellpadding='10' style='border:3px solid skyblue; border-collapse:collapse'>
        <thead>
        <tr>
            <th width=150px>Name</th>
            <th width=200px>Email</th>
            <th width=100px>Phone</th>
            <th width=300px>Message</th>
            <th width=75px>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM contactUs LIMIT $recordsPerPage OFFSET $offset";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td align="center">' . $row['name'] . '</td>';
                echo '<td align="center">' . $row['email'] . '</td>';
                echo '<td align="center">' . $row['phone'] . '</td>';
                echo '<td align="center">' . $row['message'] . '</td>';

                echo '<td align="center">
                    <form action="" method="post" onsubmit="return confirm(\'Are you sure you want to delete this message?\');">
                        <input type="hidden" name="message_id" value="' . $row['contact_us_id'] . '">
                        <button class="button login__submit" type="submit" name="submit"><span class="button__text">Delete</span></button>
                    </form>
                </td>';
                echo '</tr>';
            }
        }
        ?>
        </tbody>
    </table>

    <?php
    // Pagination links
    $sql = "SELECT COUNT(*) AS total FROM contactUs";
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
