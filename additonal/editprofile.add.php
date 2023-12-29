<?php
session_start();
	if (isset($_POST["submit"]))
	{
		$usersName = $_POST["usersName"];
    $position = $_POST["position"];
    $mobile = $_POST["mobile"];
    $about = $_POST["about"];
    $address = $_POST["address"];
    $email=$_SESSION["email"];
		$check = strtoupper($_POST["step"]);


		if ($check=="OFF"){
			    $step =0;
		}

		if ($check=="ON"){
			    $step =1;
		}

		require_once 'dbh.add.php';
		require_once 'functions.add.php';

		 editprofile($conn,$usersName,$position,$mobile,$about, $address,$step,$email);
	}
