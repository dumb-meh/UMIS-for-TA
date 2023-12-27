<?php
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';
require_once 'userheader.php';

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
        $usersName = $row['usersName'];
        $position = $row['position'];
        $mobile = $row['mobile'];
        $about = $row['about'];
        $address = $row['adress'];
        $step = $row['2step'];
    } else {
        header("location: profile.php?error=usernotfound");
        exit();
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
<body class="body">
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <form class="card-body1" action="additonal/editprofile.add.php" method="post">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="usersName" placeholder="Full Name.." value="<?php echo $usersName; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Position</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="position" placeholder="Position" value="<?php echo $position; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">2 factor verifaction</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="step" id=step placeholder="Position" value="<?php if($step==0){echo "Off";} elseif($step==1){echo "On";} ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="mobile" placeholder="Mobile No.." value="<?php echo $mobile; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">About</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="about" placeholder="About (Text under profile picture).." value="<?php echo $about; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="address" placeholder="Address.." value="<?php echo $address; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <button type="submit" class="btn btn-primary px-4" name="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php } ?>
