<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class = "bg-dark">
    <div class = "container">
        <div class = "col-md-4 offset-md-4 p-5 bg-light mt-5 rounded">
            <h3 class="d-flex align-items-center justify-content-center">Sign in</h3>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3 mb-3">
                <?php
                    include 'functions.php';
                    getSession("emptyError");
                    getSession("failure");
                    getSession("emailInvalid");
                    getSession("datError");
                    session_destroy();
                ?> 
            </h6>
            <form action = "user_login.php" method = "POST">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name = "email" id="emailReg" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name = "password" id="passReg" required>
                </div>
                <input type="submit" name = "submit" class="btn btn-dark col-md-4 offset-md-4" value = "Login">
                <div>
                    <p class = "d-flex align-items-center justify-content-center mt-3">You don't have an account?</p>
                    <a href="reg.php" class="d-flex align-items-center justify-content-center text-decoration-none">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>