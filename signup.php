<?php
include("connection.php");

$message = "";
$messageClass = "";

if(isset($_POST['signup'])){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if(empty($username) || empty($email) || empty($password) || empty($confirmPassword)){
        $message = "Please fill all fields.";
        $messageClass = "error";
    }

    elseif($password != $confirmPassword){
        $message = "Password does not match.";
        $messageClass = "error";
    }

    else{

        // Email Check

        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s",$email);
        $check->execute();
        $result = $check->get_result();

        if($result->num_rows>0){

            $message="Email already exists.";
            $messageClass="error";

        }

        else{

            $hashPassword=password_hash($password,PASSWORD_DEFAULT);

            $insert=$conn->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");

            $insert->bind_param("sss",$username,$email,$hashPassword);

            if($insert->execute()){

                $message="Registration Successful. Please Login.";
                $messageClass="success";

            }

            else{

                $message="Something went wrong.";
                $messageClass="error";

            }

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Signup</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="overlay">

<div class="container">

<h1>Create Account</h1>

<?php

if($message!=""){

echo "<div class='$messageClass'>$message</div>";

}

?>

<form method="POST">

<div class="input-box">

<label>Username</label>

<input type="text" name="username" placeholder="Enter Username">

</div>

<div class="input-box">

<label>Email</label>

<input type="email" name="email" placeholder="Enter Email">

</div>

<div class="input-box">

<label>Password</label>

<input type="password" name="password" placeholder="Enter Password">

</div>

<div class="input-box">

<label>Confirm Password</label>

<input type="password" name="confirm_password" placeholder="Confirm Password">

</div>

<button class="btn" type="submit" name="signup">

Sign Up

</button>

</form>

<p>

Already have an account?

<a href="login.php">

Login

</a>

</p>

</div>

</div>

</body>

</html>