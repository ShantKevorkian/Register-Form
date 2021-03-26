<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body class = "bg-dark">
    <div class = "container">
        <div class = "col-md-4 offset-md-4 border p-5 bg-light mt-5 rounded">
            <h3 class="d-flex align-items-center justify-content-center">Register</h3>
            <h6 class="d-flex align-items-center justify-content-center text-danger mt-3 mb-3">
                <?php 
                    include 'functions.php';
                    getSession("emptyError");
                    getSession("passWeak");
                    getSession("emailInvalid");
                    getSession("emailExists");
                    getSession("datError");
                    session_destroy();
                ?> 
            </h6>
            <form action = "create_user.php" method = "POST">
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name = "name" id="fullName" placeholder="John Doe" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name = "email" id="emailReg" placeholder="example@gmail.com" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name = "password" id="passReg" required>
                </div>
                <input type="submit" name = "submit" class="btn btn-dark col-md-4 offset-md-4" value = "Register">
                <div>
                    <p class = "d-flex align-items-center justify-content-center mt-3">You already have an account?</p>
                    <a href="login.php" class="d-flex align-items-center justify-content-center text-decoration-none">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>