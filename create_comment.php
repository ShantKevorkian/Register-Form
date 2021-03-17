<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($_POST["name"]) || empty($_POST["comment"])) {
            session_start();
            $_SESSION["emptyError"] = "Please fill all the required fields";
            header("Location: index.php");
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

        $name = $conn->real_escape_string(htmlspecialchars($_POST['name']));
        $comment = $_POST['comment'];

        $query = "INSERT INTO comments (name, comment)
                    VALUES ('$name', '$comment')";
                    
        if ($conn->query($query)) {
            $conn->close();
            header("Location: comments.php");
            exit();
        }

        else {
            session_start();
            $_SESSION["datError"] = "Database query error";
            header("Location: index.php");
            exit();
        }
    }
?>