<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function emptyInputSignup($name, $email, $pwd, $rptpwd){
  $result;
  if (empty($name) || empty($email)  || empty($pwd) || empty($rptpwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUid($email) {
  return !(substr($email, -9) === "ewubd.edu");
}


function invalidEmail($email){
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result=true;
  }
  else {
    $result=false;
  }
  return $result;

}

function pwdMatch($pwd, $rptpwd){
  if ($pwd !== $rptpwd){
    $result=true;
  }
  else {
    $result=false;
  }
  return $result;
}

function uidExists($conn,$email){
  $sql="SELECT * FROM users WHERE  usersEmail =?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData= mysqli_stmt_get_result($stmt);
  if ($row= mysqli_fetch_assoc($resultData)){
    return $row;
  }
  else {
    $result=false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn,$name, $email, $pwd,$role){
  $sql="INSERT INTO users (usersName, usersEmail, usersPwd,role) VALUES (?,?,?,?);" ;
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

$hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $hashedPwd,$role);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();

}

function emptyInputLogin($email, $password)
	{
		$result;
		if( empty($email) || empty($password) )
		{
			$result = true;
		}
		else
		{
			$result = false;
		}
		return $result;
	}


function loginUser($conn, $email, $password)
	{

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';


		$uidExists = uidExists($conn, $email);

		if ($uidExists === false)
		{
			header("location: ../login.php?error=wronglogin1");
			exit();
		}

    if ($uidExists["active"]==0){
      header("location: ../login.php?error=inactive");
			exit();
    }

		$hashedPassword = $uidExists["usersPwd"];
		$checkPassword = password_verify($password, $hashedPassword);
    $role=$uidExists["role"];
    $verifaction=$uidExists["2step"];
    $name=$uidExists["usersName"];

		if ( !$checkPassword )
		{
			header("location: ../login.php?error=wronglogin");
			exit();
		}
		else if ( $checkPassword === true )
		{
			session_start();
			$_SESSION["email"] = $uidExists["usersEmail"];
      $_SESSION["role"] = $uidExists["role"];
      $_SESSION["name"] = $uidExists["usersName"];

      if ($verifaction==1){
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+3 minute"));
        $subject= "Your OTP for Login";
        $message="Your OTP is: $otp";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'omorfaruk549@gmail.com'; //host email
        $mail->Password = 'oylcdpfogzquewql ';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('omorfaruk549@gmail.com', 'TA Management System');//Sender's Email & Name
        $mail->addAddress($email,$name); //Receiver's Email and Name
        $mail->Subject = ("$subject");
        $mail->Body = $message;
        $mail->send();

        $sql1 = "UPDATE users SET otp='$otp', otp_expiry='$otp_expiry' WHERE usersEmail='$email'";
        $query1 = mysqli_query($conn, $sql1);

        $_SESSION['temp_user'] = ['id' => $uidExists['usersId'], 'otp' => $otp];




        header("location: ../otp.php");
        exit();
      }


        setcookie("user_email", $email, time() + 86400, "/");
        header("location: ../profile.php");
  			exit();


		}
	}





      function deleteaccount($conn, $email,$value){
        $sql = "DELETE FROM users WHERE usersEmail = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);


            if ($value == 0) {
                header("Location: accountapprove.php?success=delete");
                exit();
            } elseif ($value == 1) {
                header("Location: talist.php?success=delete");
                exit();
            } elseif ($value == 2) {
                header("Location: facultylist.php?success=delete");
                exit();
            } elseif ($value == 3) {
                header("Location: adminlist.php?success=delete");
                exit();
            }
        } else {

            echo "Error deleting record: " . mysqli_error($conn);
        }


        }


function deletemessage($conn,$messageId ){
  $sql = "DELETE FROM contactUs WHERE contact_us_id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (mysqli_stmt_prepare($stmt, $sql)) {
      mysqli_stmt_bind_param($stmt, "i", $messageId);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_close($stmt);

      header("Location:messages.php?success=delete");
      exit();
  } else {
      echo "Error deleting message: " . mysqli_error($conn);
  }

          }


          function deletePost($conn,$id ){
            $sql = "DELETE FROM posts WHERE id = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);

                header("Location:personalpost.php?success=delete");
                exit();
            } else {
                echo "Error deleting message: " . mysqli_error($conn);
            }

                    }

function editprofile($conn,$usersName,$position,$mobile,$about, $address,$step,$email){
            $sql1="UPDATE  users SET usersName=? WHERE usersEmail =? ;";
            $sql2="UPDATE  users SET position=? WHERE usersEmail =? ;";
            $sql3="UPDATE  users SET mobile=? WHERE usersEmail =? ;";
            $sql4="UPDATE  users SET about=? WHERE usersEmail =? ;";
            $sql5="UPDATE  users SET adress=? WHERE usersEmail =? ;";
            $sql6="UPDATE  users SET 2step=? WHERE usersEmail =? ;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql1)){
              header("location: ../profile.php?error=stmtfailed");
              exit();
            }

            mysqli_stmt_bind_param($stmt, "ss",$usersName,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql2)){
              header("location: ../profile.php?error=stmtfailed");
              exit();
            }
            mysqli_stmt_bind_param($stmt, "ss",$position,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql3)){
              header("location: ../profile.php?error=stmtfailed");
              exit();
            }
            mysqli_stmt_bind_param($stmt, "ss",$mobile,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql4)){
              header("location: ../profile.php?error=stmtfailed");
              exit();
            }
            mysqli_stmt_bind_param($stmt, "ss",$about,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql5)){
              header("location: ../profile.php?error=stmtfailed");
              exit();
            }
            mysqli_stmt_bind_param($stmt, "ss",$address,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql6)){
              header("location: ../profile.php?error=stmtfailed");
              exit();
            }
            mysqli_stmt_bind_param($stmt, "ss",$step,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("location: ../profile.php?error=none");
            exit();

            }





  function contactUs($name, $email, $phone, $message, $conn) {
              $stmt = $conn->prepare("INSERT INTO contactUs (name, email, phone, message) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $phone, $message);
                $stmt->execute();
                $stmt->close();
                header("location: contact.php?error=none");
                exit();
              }


  function createPost($conn, $title, $body, $author, $visibility,$email) {

              $sql = "INSERT INTO posts (title, body, author, visibility,email) VALUES (?, ?, ?, ?,?)";
              $stmt = mysqli_stmt_init($conn);

              if (mysqli_stmt_prepare($stmt, $sql)) {
                     mysqli_stmt_bind_param($stmt, "sssss", $title, $body, $author, $visibility,$email);
                     mysqli_stmt_execute($stmt);
                     mysqli_stmt_close($stmt);

                     header("location:createpost.php?error=none");
                     exit();
                  } else {
                             echo '<p>Error creating post: ' . mysqli_error($conn) . '</p>';
                              }
                        }
