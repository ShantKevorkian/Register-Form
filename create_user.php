<?php
    include 'funcSession.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Checks for empty form inputs
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
            session_start();
            setSession("emptyError", "Please fill all the required fields");
            header("Location: reg.php");
            exit();
        }

        include 'db_config.php';

        $name = $conn->real_escape_string(htmlspecialchars($_POST['name']));
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = md5($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session_start();
            setSession("emailInvalid", "Invalid email format");
            header("Location: reg.php");
            exit();
        }

        // Checks for password weakness
        if (strlen($password) < 6) {
            session_start();
            setSession("passWeak", "Password must be at least 6 characters");
            header("Location: reg.php");
            exit();
        }

        $selectEmail = "SELECT email from user_reg WHERE email = '$email'";

        if (!$conn->query($selectEmail)) {
            session_start();
            setSession("datError", "Database Query Error");
            header("Location: reg.php");
            exit();
        }

        else{

            // Checks if an email exists 
            if ($conn->query($selectEmail)->num_rows > 0) {
                session_start();
                setSession("emailExists", "Email already exists");
                header("Location: reg.php");
                exit();
            } 

            else {

                // Inserts the data into given database
                $query = "INSERT INTO user_reg (name, email, password)
                            VALUES ('$name', '$email', '$hashedPassword')";
                            
                if ($conn->query($query)) {
                    $conn->close();
                    header("Location: login.php");
                    exit();
                }
            }
        }
    }