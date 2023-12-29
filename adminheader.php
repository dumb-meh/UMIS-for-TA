<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TA Management</title>

  <style>
    body {
      font-family: "Quicksand", sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden; /* Hide horizontal scrollbar */
      background-color: #e2e8f0 !important;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: white;
      padding: 10px;
      color: black;
    }

    .header img {
      width: 50px;
      height: auto;
    }

    .navigation {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: -250px;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
      z-index: 1;
    }

    .navigation a {
      padding: 15px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
      transition: 0.3s;
    }

    .navigation a:hover {
      background-color: #555;
    }

    .menu-icon {
      font-size: 30px;
      cursor: pointer;
    }

    .logo-and-logout {
      display: flex;
      align-items: center;
    }

    .logout-btn {
      margin-left: 10px;
      padding: 10px;
      background-color: #555;
      color: white;
      border: none;
      cursor: pointer;
    }

    .main-content {
      margin-left: 0;
      transition: margin-left 0.5s;
      padding: 16px;
    }
  </style>
</head>
<body>

  <div id="mySidenav" class="navigation">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; <span >Close</span></a>
    <a href="profile.php">Home</a>
    <a href="messages.php">Messages</a>
    <a href="accountapprove.php">Approve Account</a>
    <a href="personalpost.php">Personal Post</a>
    <a href="checkprofile.php">Profiles</a>
    <a href="facultylist.php">Faculty List</a>
    <a href="talist.php">TA List</a>
    <a href="adminlist.php">Admin List</a>
    <a href="createuser.php">Create User</a>
    <a href="SpecialPost.php">Posts</a>
  </div>

  <div class="main-content">
    <header class="header">
      <span class="menu-icon" onclick="openNav()">&#9776; Menu</span>
      <div class="logo-and-logout">
        <img alt="Picture" class="rounded" src="logo2.png">
        <button class="logout-btn" onclick="window.location.href = 'additonal/logout.add.php';">Log Out</button>
      </div>
    </header>

    <!-- Rest of your page content goes here -->
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.left = "0";
      document.getElementById("main-content").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.left = "-250px";
      document.getElementById("main-content").style.marginLeft = "0";
    }
  </script>

</body>
</html>
