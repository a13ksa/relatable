<?php
    include 'includes/dbconfig.php';
    include 'includes/functions.php';
    include 'includes/header.php';
    if(isset($_GET['id'])){
        $idPost = $_GET['id'];
    }
    if(isset($_GET['id']) && isset($_GET['value'])){
        $idPost = $_GET['id'];
        $value = $_GET['value'];
        if(!userLikedDisliked($_GET['id'], $_GET['value'])){
            relateSingle($idPost, $value);
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
<?php
    $query = "SELECT posts.id as idPost ,content ,publishDate ,idUser ,username 
              FROM `posts` INNER JOIN users ON posts.idUser = users.id
              WHERE posts.id = '$idPost'
              ORDER BY publishDate DESC";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="post">
        <div class="firstRow">
            <div class="username"><?php echo $row['username'];?></div>
            <div class="extend"><a href="homepage.php">Back</a></div>
        </div>
        <div class="content"><?php echo $row['content'];?></div>
        <div class="thirdRow">
            <div class="flexThird <?php if(userLikedDisliked($row['idPost'], 1)) echo 'related'?>">
                <a class="relate" href="singlepost.php?id=<?php echo $row['idPost']?>&value=1">Relate</a>
                <div class="numOfLikes"><?php if(numOfRelates($row['idPost'], 1) != 0) echo numOfRelates($row['idPost'], 1)?></div>
            </div>
            <div class="flexThird <?php if(userLikedDisliked($row['idPost'], 0)) echo 'cantrelated'?>">
                <a class="relate" href="singlepost.php?id=<?php echo $row['idPost']?>&value=0">Can't relate</a>
                <div class="numOfDislikes"><?php if(numOfRelates($row['idPost'], 0) != 0)echo numOfRelates($row['idPost'], 0)?></div>
            </div>
            <div class="flexThird">
                <a href="singlepost.php?id=<?php echo $row['idPost']?>">Reply</a>
            </div>
        </div>
        <div class="postComment">
            <form method="post" action="includes/comment.php?id=<?php echo $row['idPost']?>">
                <div class="postForm">
                <input class="postInput" type="text" name="content" placeholder="Comment your opinion..">
                <?php if(isset($error)) echo $error;?></p>
                <button class="postSubmit" type="submit" name="submit">Comment</button>
                </div>
            </form>
        </div>
            <div class="comments">
            <?php
            $querycom = "SELECT comments.id as idComment ,content, relate ,publishDate ,idUser ,username 
                      FROM `comments` INNER JOIN users ON comments.idUser = users.id
                      WHERE idPost = '$idPost'
                      ORDER BY publishDate DESC";
            $resultcom = mysqli_query($connection, $querycom);
            while($rowcom = mysqli_fetch_assoc($resultcom)){ ?>
                <div class="firstRow">
                    <div class="username"><?php echo $rowcom['username'];?></div>
                </div>
                <div class="secondRow">
                    <div class="comment"><?php echo $rowcom['content'];?></div>
                    <div class="com <?php if($rowcom['relate'] == 1)echo 'related'; else echo 'cantrelated';?>"></div>
                </div>
            <?php } ?>
            </div>
    </div>
    <?php } ?>
<?php include 'includes/footer.php';?>