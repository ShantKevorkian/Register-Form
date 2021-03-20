<?php

    session_start();

    if (!isset($_SESSION["id"]) || !isset($_GET['id'])) {
        header("location: comments.php");
        exit();
    }

    $comment_id = (int) $_GET['id'];
    $_SESSION["userID"] = $comment_id;
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
<body>
    <div class = "container">
        <div class = "col-md-4 offset-md-4 border p-5 bg-light mt-5">
            <h3 class="d-flex align-items-center justify-content-center mb-5">
                <?php
                    if(isset($_SESSION['userWelcome']))  {
                        echo $_SESSION['userWelcome']; 
                    }
                ?>
            </h3>
            <h4 class = "d-flex align-items-center justify-content-center text-secondary">Edit your comment</h4>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3">
                <?php  
                    include 'funcSession.php';
                    getSession("emptyError");
                    getSession("datError");
                ?>
            </h6> <br>
            <form action = "edit_comment.php" method = "POST">
                <div class="form-group">
                    <textarea class="form-control" name = "editComment" id="textArea" rows="5" placeholder="Enter Text..."></textarea>
                </div> <br>
                <input type="submit" name = "submit" class="btn btn-primary col-md-4 offset-md-4" value = "Edit">
                <a href="logout.php" class="btn btn-danger col-md-4 offset-md-4  mt-4">Logout</a>
            </form>
        </div>
    </div>
</body>
</html>