<?php
session_start();

require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';

if ($_SESSION['role'] != 2) {
    require_once 'userheader.php';
}

if ($_SESSION['role'] == 2) {
    require_once 'adminheader.php';
}

$email = $_SESSION['email'];

if (isset($_GET["error"]) && $_GET["error"] == "none") {
    echo "<br>";
    echo '<span style="color:#D16587; font-weight:bold; position:relative; left:95px; top:115px">Post Has been Created!</span>';
}

if (isset($_POST['submitPost'])) {
    createPost($conn, $_POST['title'], $_POST['body'], $_POST['author'], $_POST['visibility'], $email);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create a Post</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <style>
        body {
            background: #e2e8f0;
            color: black;
            font-family: 'Raleway', sans-serif;
        }

        h2 {
            text-align: center;
            color: #4C489D;
        }

        form {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(90deg, #5D54A4, #7C78B8);
            box-shadow: 0px 0px 24px #5C5696;
            border-radius: 10px;
            margin-top: 20px;
        }

        label {
            color: black;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-bottom: 2px solid #D1D1D4;
            border-radius: 0px !important;
            background: none;
            font-weight: 700;
            transition: .2s;
            color: black;
        }

     textarea {
          height: 300px;
          resize: vertical;
       }

        input[type="text"]:active,
        input[type="text"]:focus,
        input[type="text"]:hover,
        textarea:active,
        textarea:focus,
        textarea:hover,
        select:active,
        select:focus,
        select:hover {
            outline: none;
            border-bottom-color: #6A679E;
        }

        select {
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            background: url('https://cdn.iconscout.com/icon/free/png-256/drop-down-1767539-1496581.png') no-repeat right white;
            background-size: 20px;
            background-position-x: 95%;
        }

        input[type="submit"] {
            background: #fff;
            font-size: 14px;
            margin-top: 30px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            font-weight: 700;
            display: flex;
            align-items: center;
            width: 100%;
            color: #4C489D;
            box-shadow: 0px 2px 2px #5C5696;
            cursor: pointer;
            transition: .2s;
        }

        input[type="submit"]:active,
        input[type="submit"]:focus,
        input[type="submit"]:hover {
            border-color: #6A679E;
            outline: none;
        }

        .button__icon {
            font-size: 24px;
            margin-left: auto;
            color: #7875B5;
        }
    </style>
</head>
<body>

    <h2>Create a Post</h2>

    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="body">Body:</label>
        <textarea name="body" required></textarea><br>

        <label for="author">Author:</label>
        <input type="text" name="author" required><br>

        <label for="visibility">Visibility:</label>
        <select name="visibility" required>
            <option value="Public">Public</option>
            <option value="Admin">Admin</option>
            <option value="TA">TA</option>
            <option value="Faculty">Faculty</option>
        </select><br>

        <input type="submit" name="submitPost" value="Post">
    </form>

</body>
</html>
