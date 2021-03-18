<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Checks for empty form inputs
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            session_start();
            $_SESSION["emptyError"] = "Please fill all the required fields";
            header("Location: login.php");
            exit();
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "internship";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . "<br>" . $conn->connect_error);
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = md5($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session_start();
            $_SESSION["emailInvalid"] = "Invalid email format";
            header("Location: reg.php");
            exit();
        }

        $selectEmail = "SELECT id, name FROM user_reg WHERE email = '$email' and password = '$hashedPassword'";

        $runQuery = $conn->query($selectEmail);

        if (!$runQuery) {
            session_start();
            $_SESSION["datError"] = "Database query error";
            header("Location: login.php");
            exit();
        }

        else {

            $count = $runQuery->num_rows;
            $row = $runQuery->fetch_assoc();

            // Checks if form inputs exist in the database
            if ($count == 1) {
                session_start();
                $_SESSION["userWelcome"] = "Welcome " . $row['name'];
                $_SESSION["id"] = $row['id'];
                header("Location: index.php");
                exit();
            } 

            else {
                session_start();
                $_SESSION["failure"] = "Email or Password incorrect";
                header("Location: login.php");
                exit();
            }
        }

    }
?>