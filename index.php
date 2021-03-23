<?php
    include 'functions.php';

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
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
    <title>Create Comment</title>
</head>
<body>
    <div class = "container">
        <div class = "col-md-4 offset-md-4 border p-5 bg-light mt-5">
                <? if(isset($_SESSION['username'])): ?>
                    <h3 class="d-flex align-items-center justify-content-center mb-5">Welcome <?=$_SESSION['username']?></h3>
                <? endif; ?>
            <h4 class = "d-flex align-items-center justify-content-center text-secondary">Comment Your Thoughts</h4>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3 mb-3">
                <?php  
                    getSession("emptyError");
                    getSession("datError");
                ?>
            </h6>
            <form action = "create_comment.php" method = "POST">
                <div class="form-group mb-3">
                    <textarea class="form-control" name = "comment" id="textArea" rows="5" placeholder="Enter Text..."></textarea>
                </div>
                <input type="submit" name = "submit" class="btn btn-primary col-md-4 offset-md-4" value = "Submit">
                <a href="logout.php" class="btn btn-danger col-md-4 offset-md-4  mt-4">Logout</a>
            </form>
        </div>
    </div>
</body>
</html>