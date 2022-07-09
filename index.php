<?php
    include 'includes/dbconfig.php';
    include 'includes/functions.php';
    include 'includes/header.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username, $password);
    }
?>
<div class="loginPage">
    <div class="quote">
        <h1>Relatable.</h1>
        <h3>The place where you connect with the similar one</h3>
    </div>
    <div class="login">
        <form class="loginForm" method="post">
            <input class="loginInput" type="text" name="username" placeholder="Enter username">
            <input class="loginInput" type="password" name="password" placeholder="Enter password">
            <button class="loginSubmit" type="submit" name="submit">Login</button>
        </form>
        <div class="register">Don't have an account yet? <a href="register.php"><strong>Register Now!</strong></a></div>
    </div>
</div>

<?php include 'includes/footer.php';?>