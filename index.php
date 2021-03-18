<?php
    session_start();

    if (isset($_SESSION['id'])) {

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
            <h3 class="d-flex align-items-center justify-content-center">
                <?php
                    if(isset($_SESSION['userWelcome']))  {
                        echo $_SESSION['userWelcome']; 
                    }
                ?>
            </h3>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3">
                <?php
                    if(isset($_SESSION['emptyError']))  {
                        echo $_SESSION['emptyError']; 
                    }

                    if(isset($_SESSION['datError']))  {
                        echo $_SESSION['datError']; 
                    }
                ?>
            </h6> <br>
            <form action = "create_comment.php" method = "POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name = "name" id="fullName" placeholder="John Doe" required>
                </div> <br>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" name = "comment" id="textArea" rows="5" placeholder="Enter Text..."></textarea>
                </div> <br>
                <input type="submit" name = "submit" class="btn btn-primary col-md-4 offset-md-4" value = "Submit">
                <a href="logout.php" class="btn btn-danger col-md-4 offset-md-4  mt-4">Logout</a>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    }
    else {
        header("Location: login.php");
        exit();
    }
?>