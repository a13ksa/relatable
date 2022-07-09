<?php

function usernameExists($username){
    global $connection;
    $query = "SELECT * 
              FROM users 
              WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result))
        return true;
    return false;
    }

function login($username, $password){
    global $connection;
    if(usernameExists($username)){
        $query = "SELECT * 
              FROM users 
              WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        $resultarray = mysqli_fetch_assoc($result);
        if($password == $resultarray['password']) { 
            $_SESSION['idUser'] = $resultarray['id']; 
            $_SESSION['username'] = $resultarray['username']; ?>
            <script>
                alert('Login successful!');
                window.location.href='homepage.php';
            </script>
        <?php } else { ?>
                <script> 
                    alert('Login failed!');
                    window.location.href='index.php'; 
                </script>
        <?php }
    } else { ?>
    <script> 
        alert('Login failed!'); 
    </script>
    <?php }
    }

function register($username, $password){
    global $connection;
    $query = "INSERT INTO `users`(`username`, `password`) 
              VALUES ('$username','$password')";
    $result = mysqli_query($connection, $query);
    if(isset($result)) { ?>
        <script> 
            alert('Successfully register!');
            window.location.href='index.php';
        </script>
    <?php } else ?>
        <script> 
            alert('Registration failed!'); 
        </script>
<?php } 

function relate($idPost, $value){
    global $connection;
    $idUser = $_SESSION['idUser'];
    deleteRelate($idPost);
    $query = "INSERT INTO `userpost`(`relate`, `idPost`, `idUser`) 
              VALUES ($value,$idPost,$idUser)";
    $result = mysqli_query($connection, $query);
    header("location: ./homepage.php");
}

function relateSingle($idPost, $value){
    global $connection;
    $idUser = $_SESSION['idUser'];
    deleteRelate($idPost);
    $query = "INSERT INTO `userpost`(`relate`, `idPost`, `idUser`) 
              VALUES ($value,$idPost,$idUser)";
    $result = mysqli_query($connection, $query);
    header("location: ./singlepost.php?id=$idPost");
}

function deleteRelate($idPost){
    global $connection;
    $idUser = $_SESSION['idUser'];
    $query = "DELETE
              FROM userpost
              WHERE idPost = '$idPost' and idUser = '$idUser'";
    $result = mysqli_query($connection, $query);
}

function userLikedDisliked($idPost, $value){
    global $connection;
    $idUser = $_SESSION['idUser'];
    $query = "SELECT *
              FROM userpost
              WHERE idPost = '$idPost' and idUser = '$idUser' and relate = '$value'";
    $result = mysqli_query($connection, $query);
    return (mysqli_num_rows($result) == 0) ? false : true;
}

function didUserRelated($idPost){
    global $connection;
    $idUser = $_SESSION['idUser'];
    $query = "SELECT *
              FROM userpost
              WHERE idPost = '$idPost' and idUser = '$idUser'";
    $result = mysqli_query($connection, $query);
    return (mysqli_num_rows($result) == 0) ? false : true;
}

function userLikedOrDisliked($idPost){
    global $connection;
    $idUser = $_SESSION['idUser'];
    $query = "SELECT *
              FROM userpost
              WHERE idPost = '$idPost' and idUser = '$idUser'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return ($row['relate']);
}

function numOfRelates($idPost, $value){
    global $connection;
    $query = "SELECT count(*) as numOfRelates
              FROM userpost
              WHERE idPost = '$idPost' and relate = '$value'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['numOfRelates'];
}

?>