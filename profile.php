<?php
session_start();
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';
if ($_SESSION["role"]!=2){
require_once 'userheader.php';
}
if ($_SESSION["role"]==2){
require_once 'adminheader.php';
}



if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];

    $sql = "SELECT * FROM users WHERE usersEmail=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: profile.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $imagePath = "img/profilepic/" . $row['image'];
        $profileName = $row['usersName'];
        $email = $row['usersEmail'];
        $about = $row['about'];
        $mobile = $row['mobile'];
        $address = $row['adress'];
        $position = $row['position'];
        $role = $row['role'];
        $step = $row['2step'];

    } else {
        $imagePath = "img/profilepic/default.png";
    }
?>

<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="profile.css">
</head>
<body class="body1">
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?php echo $imagePath; ?>" alt="Profile Picture" class="rounded-circle" width="150">
                                <form class="card-body2" action="editprofilepicture.php" method="post">
                                    <button type="submit" class="btn btn-primary" name="button">Change Profile Picture</button>
                                </form>
                                <div class="mt-3">
                                    <h4><?php if ($role==0){echo "Teaching Assistant";} elseif($role==1){echo "Faculty";} ?></h4>
                                    <p class="text-secondary mb-1"><?php echo $about; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $profileName; ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">2 factor authentication</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php if($step==0){echo "Off";} elseif($step==1){echo "On";} ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $email; ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Position</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $position; ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $mobile; ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $address; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info" onclick="window.location.href ='editprofile.php';">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php } ?>
