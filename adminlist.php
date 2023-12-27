<?php
require_once 'adminheader.php';
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';

// Number of records per page
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
    <title></title>
    <link rel="stylesheet" href="test.css">

</head>
<body>
<?php
if (isset($_GET["success"])) {


    if ($_GET["success"] == "delete") {
        echo '<div style="color:black; text-align: center; margin-top: 20px;">Account deleted Successfully</div>';
    }
}
$email=$_SESSION['email'];

?>
<div class=card1>
    <table width=800px border='10' cellpadding='10' style='border:3px solid skyblue; border-collapse:collapse'>
        <thead>
        <tr>
            <th width=150px>Name</th>
            <th width=200px>Email</th>
            <th width=100px>Role</th>
            <th width=100px>Position</th>
            <th width=75px>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM users WHERE active='1' and role='2' and usersEmail!='$email' LIMIT $recordsPerPage OFFSET $offset";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td align="center">' . $row['usersName'] . '</td>';
                echo '<td align="center">' . $row['usersEmail'] . '</td>';
                echo '<td align="center">';
                if ($row['role'] == 0) {
                    echo "TA";
                } elseif ($row['role'] == 1) {
                    echo "Faculty";
                } elseif ($row['role'] == 2) {
                    echo "Admin";
                }
                echo '</td>';

                echo '<td align="center">' . $row['position'] . '</td>';

                echo '<td align="center">
                    <form action="deleteaccount.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this?\');">
                        <input type="hidden" name="email" value="' . $row['usersEmail'] . '">
                        <input type="hidden" name="value" value=3">
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
    $sql = "SELECT COUNT(*) AS total FROM users WHERE active='1' and role='2' and usersEmail!='$email'";
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
