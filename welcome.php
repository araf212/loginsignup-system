<?php

session_start();

if(!isset($_SESSION['username'])){

header("Location: login.php");
exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include("navbar.php"); ?>

<div class="overlay">

<div class="welcome-box">

<h1>

Welcome,

<?php echo htmlspecialchars($_SESSION['username']); ?>

🎉

</h1>

<p>

You have successfully logged into your account.

</p>

<br>

<h3>Your Information</h3>

<br>

<p>

<b>Username :</b>

<?php echo htmlspecialchars($_SESSION['username']); ?>

</p>

<br>

<p>

<b>Email :</b>

<?php echo htmlspecialchars($_SESSION['email']); ?>

</p>

<br><br>

<a href="logout.php">

<button class="btn">

Logout

</button>

</a>

</div>

</div>

</body>

</html>