<?php
    include 'includes/dbconfig.php';
    include 'includes/functions.php';
    include 'includes/header.php';
    if(isset($_GET['id']) && isset($_GET['value'])){
        $idPost = $_GET['id'];
        $value = $_GET['value'];
        if(!userLikedDisliked($_GET['id'], $_GET['value'])){
            relate($idPost, $value);
        }
        else deleteRelate($idPost);
    }
?>
<div class="header">
    <div class="heading1">
        <h1>Relatable.</h1>
        <h3>The place where you connect with the similar one</h3>
    </div>
    <div class="heading2">
        <h1>Home Page</h1>
        <a href="includes/logout.php">Log Out</a>
    </div>
</div>
<div class="post">
    <form method="post" action="includes/post.php">
        <div class="postForm">
        <input class="postInput" type="text" name="content" placeholder="What's on your mind?">
        <?php if(isset($error)) echo $error;?></p>
        <button class="postSubmit" type="submit" name="submit">Post</button>
        </div>
    </form>
</div>

    <?php
    $query = "SELECT posts.id as idPost ,content ,publishDate ,idUser ,username 
              FROM `posts` INNER JOIN users ON posts.idUser = users.id
              ORDER BY publishDate DESC";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="post">
        <div class="firstRow">
            <div class="username"><?php echo $row['username'];?></div>
            <div class="extend"><a href="singlepost.php?id=<?php echo $row['idPost']?>">Extend</a></div>
        </div>
        <div class="content"><?php echo $row['content'];?></div>
        <div class="thirdRow">
            <div class="flexThird <?php if(userLikedDisliked($row['idPost'], 1)) echo 'related'?>">
                <a class="relate" href="homepage.php?id=<?php echo $row['idPost']?>&value=1">Relate</a>
                <div class="numOfLikes"><?php if(numOfRelates($row['idPost'], 1) != 0) echo numOfRelates($row['idPost'], 1)?></div>
            </div>
            <div class="flexThird <?php if(userLikedDisliked($row['idPost'], 0)) echo 'cantrelated'?>">
                <a class="relate" href="homepage.php?id=<?php echo $row['idPost']?>&value=0">Can't relate</a>
                <div class="numOfDislikes"><?php if(numOfRelates($row['idPost'], 0) != 0)echo numOfRelates($row['idPost'], 0)?></div>
            </div>
            <div class="flexThird">
                <a href="singlepost.php?id=<?php echo $row['idPost']?>">Reply</a></div>
        </div>
        </div>
    <?php } ?>

<?php include 'includes/footer.php';?>