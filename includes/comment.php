<?php
include 'dbconfig.php';
include 'functions.php';
if(isset($_POST['submit']) && isset($_GET['id'])){
        $content = $_POST['content'];
        $idPost = $_GET['id'];
        if(strlen($content)<3)
            $error="Comment cannot be empty!";
        if(strlen($content)>150)
            $error="Post cannot have more than 150 characters";
        if(!didUserRelated($idPost))
            $error="First you need to relate";
        if(empty($error))
            comment($content, $idPost, userLikedOrDisliked($idPost));
        else
            header("location: ../singlepost.php?id=$idPost");
}

function comment($content, $idPost, $value){
    global $connection;
    $datetime = date('Y-m-d H:i:s');
    $idUser = $_SESSION['idUser'];
    $query = "INSERT INTO `comments`(`content`, `relate`, `publishDate`, `idPost`, `idUser`) 
              VALUES ('$content', '$value', '$datetime', '$idPost', $idUser)";
    $result = mysqli_query($connection, $query);
    if(isset($result)) {
        header("location: ../singlepost.php?id=$idPost");
    } else {
        header("location: ../singlepost.php?id=$idPost");
    }
}
?>