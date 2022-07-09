<?php
include 'dbconfig.php';
include 'functions.php';
if(isset($_POST['submit'])){
        $content = $_POST['content'];
        if(strlen($content)<3)
            $error="Post must have 3 or more characters";
        if(strlen($content)>200)
            $error="Post cannot have more than 200 characters";
        if(empty($error))
            post($content);
        else{ ?>
            <script> 
                alert('Post failed!');
                window.location.href='../homepage.php';
            </script>
    <?php }
}

function post($content){
    global $connection;
    $datetime = date('Y-m-d H:i:s');
    $idUser = $_SESSION['idUser'];
    $query = "INSERT INTO `posts`(`content`, `publishDate`, `idUser`) 
              VALUES ('$content','$datetime', $idUser)";
    $result = mysqli_query($connection, $query);
    if(isset($result)) { ?>
        <script> 
            alert('Successfully posted!');
            window.location.href='../homepage.php';
        </script>
    <?php } else { ?>
        <script> 
            alert('Post failed!');
            window.location.href='../homepage.php';
        </script>
<?php }
}
?>