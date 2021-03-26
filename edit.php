<?php
    include 'db_config.php';
    include 'functions.php';

    $comment_id = (int) $_GET['id'];

    if (!isset($_SESSION["id"]) || !isset($_GET['id']) || empty($_GET['id'])) {
        header("location: comments.php");
        exit();
    }

    $queryComment = "SELECT comment, id FROM comments 
                        WHERE id = $comment_id AND user_id = ".$_SESSION["id"];

    $runQuery = $conn->query($queryComment);
    
    if (!$runQuery) {
        $conn->close();
        setSession("datError", "Database query error");
    }

    $row = $runQuery->fetch_assoc();

    if(!$row) {
        setSession("otherComment", "You can't change someone else's comment");
        header("location: comments.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>
<body class = "bg-dark">
    <div class = "container">
        <div class = "col-md-4 offset-md-4 border p-5 bg-light mt-5 rounded">
            <h3 class="d-flex align-items-center justify-content-center mb-5">
                <?php
                    if(isset($_SESSION['username']))  {
                        echo "Welcome ". $_SESSION['username']; 
                    }
                ?>
            </h3>
            <h4 class = "d-flex align-items-center justify-content-center text-secondary">Edit your comment</h4>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3">
                <?php  
                    getSession("emptyError");
                    getSession("datError");
                ?>
            </h6> <br>
            <form action = "edit_comment.php" method = "POST">
                <div class="form-group mb-3">
                    <textarea class="form-control" name = "editComment" id="textArea" rows="5"><?=$row['comment'] ?></textarea>
                </div>
                <input type="hidden" name="id" value="<?=$row['id'] ?>">
                <input type="submit" name = "submit" class="btn btn-dark col-md-4 offset-md-4" value = "Edit">
                <a href="logout.php" class="btn btn-danger col-md-4 offset-md-4  mt-4">Logout</a>
            </form>
        </div>
    </div>
</body>
</html>