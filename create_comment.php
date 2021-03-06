<?php
    include 'functions.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($_POST["comment"])) {
            setSession("emptyError", "Please fill all the required fields");
            header("Location: index.php");
            exit();
        }

        include 'db_config.php';

        $comment = $conn->real_escape_string(htmlspecialchars($_POST['comment']));

        $userId = $_SESSION["id"];
        
        $query = "INSERT INTO comments (user_id, comment)
                    VALUES ($userId, '$comment')";
                    
        if ($conn->query($query)) {
            $conn->close();
            header("Location: comments.php");
            exit();
        }

        else {
            setSession("datError", "Database Query Error");
            header("Location: index.php");
            exit();
        }
    }
