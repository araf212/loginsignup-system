<?php
session_start();
include("connection.php");

$message = "";
$messageClass = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($email) || empty($password)){

        $message = "Please fill all fields.";
        $messageClass = "error";

    }else{

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows==1){

            $user = $result->fetch_assoc();

            if(password_verify($password,$user['password'])){

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                header("Location: welcome.php");
                exit();

            }else{

                $message = "Incorrect Password.";
                $messageClass = "error";

            }

        }else{

            $message = "Email not found.";
            $messageClass = "error";

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="overlay">

<div class="container">

<h1>Login</h1>

<?php

if($message!=""){

echo "<div class='$messageClass'>$message</div>";

}

?>

<form method="POST">

<div class="input-box">

<label>Email</label>

<input type="email" name="email" placeholder="Enter Email">

</div>

<div class="input-box">

<label>Password</label>

<input type="password" name="password" placeholder="Enter Password">

</div>

<button class="btn" type="submit" name="login">

Login

</button>

</form>

<p>

Don't have an account?

<a href="signup.php">

Create Account

</a>

</p>

</div>

</div>

</body>

</html>