<?php
    include 'funcSession.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Checks for empty form inputs
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            setSession("emptyError", "Please fill all the required fields");
            header("Location: login.php");
            exit();
        }

        include 'db_config.php';

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = md5($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            setSession("emailInvalid", "Invalid email format");
            header("Location: reg.php");
            exit();
        }

        $selectEmail = "SELECT id, name FROM user_reg WHERE email = '$email' and password = '$hashedPassword'";

        $runQuery = $conn->query($selectEmail);

        if (!$runQuery) {
            setSession("datError", "Database Query Error");
            header("Location: login.php");
            exit();
        }

        else {

            $count = $runQuery->num_rows;
            $row = $runQuery->fetch_assoc();

            // Checks if form inputs exist in the database
            if ($count == 1) {
                $_SESSION["userWelcome"] = "Welcome " . $row['name'];
                $_SESSION["id"] = $row['id'];
                header("Location: index.php");
                exit();
            } 

            else {
                setSession("failure", "Email or Password incorrect");
                header("Location: login.php");
                exit();
            }
        }

    }
