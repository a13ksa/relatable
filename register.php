<?php
    include 'includes/dbconfig.php';
    include 'includes/functions.php';
    include 'includes/header.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $errors = array('username' => '', 'password' => '');
        if(usernameExists($username))
            $errors['username'] = 'Korisnicko ime vec postoji';
        if(strlen($username) < 5)
            $errors['username'] = 'Korisnicko ime mora sadrzati 5 ili vise karaktera';
        if(strlen($username) > 14)
            $errors['username'] = 'Korisnicko ime ne sme sadrzati vise od 14 karaktera';
        if(strlen($password) < 6)
            $errors['password'] = 'Sifra mora sadrzati 6 ili vise karaktera';
        if(strlen($password) > 16)
            $errors['password'] = 'Sifra ne sme sadrzati vise od 16 karaktera';
        foreach($errors as $key => $value){
            if(empty($value)){
                unset($errors[$key]);
            }
        }
        if(empty($errors)){
            register($username, $password);
        } 
    }
?>
<div class="loginPage">
    <div class="quote">
        <h1>Relatable.</h1>
        <h3>The place where you connect with the similar one</h3>
    </div>
    <div class="login">
        <form class="registerForm" method="post">
            <input class="loginInput" type="text" name="username" placeholder="Enter username">
            <p><?php if(isset($errors['username'])) echo $errors['username']?></p>
            <input class="loginInput" type="password" name="password" placeholder="Enter password">
            <p><?php if(isset($errors['password'])) echo $errors['password']?></p>
            <button class="loginSubmit" type="submit" name="submit">Register</button>
        </form>
        <div class="register">
            <a href="index.php">Cancel</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php';?>