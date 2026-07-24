<nav>

<div class="logo">

Login System

</div>

<div class="menu">

<a href="signup.php">Signup</a>

<a href="login.php">Login</a>

<?php

if(isset($_SESSION['username'])){

?>

<a href="welcome.php">Dashboard</a>

<a href="logout.php">Logout</a>

<?php

}

?>

</div>

</nav>