<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class = "container">
        <div class = "col-md-4 offset-md-4 border p-5 bg-light mt-5">
            <h3 class="d-flex align-items-center justify-content-center">Login</h3>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3">
                <?php
                    session_start();
                    if(isset($_SESSION['emptyError']))  {
                        echo $_SESSION['emptyError']; 
                    }

                    if(isset($_SESSION['failure']))  {
                        echo $_SESSION['failure']; 
                    }

                    if(isset($_SESSION['emailInvalid']))  {
                        echo $_SESSION['emailInvalid']; 
                    }

                    if(isset($_SESSION['datError']))  {
                        echo $_SESSION['datError']; 
                    }
            
                    session_unset();
                    session_destroy();
                ?> 
            </h6> <br>
            <form action = "user_login.php" method = "POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name = "email" id="emailReg" required>
                </div> <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name = "password" id="passReg" required>
                </div> <br>
                <input type="submit" name = "submit" class="btn btn-primary col-md-4 offset-md-4" value = "Login">
                <div>
                    <p class = "d-flex align-items-center justify-content-center mt-3">You don't have an account?</p>
                    <a href="reg.php" class="d-flex align-items-center justify-content-center">Register</a>
                </div>
                </form>
        </div>
    </div>
</body>
</html>