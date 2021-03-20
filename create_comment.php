<?php
    include 'funcSession.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($_POST["comment"])) {
            setSession("emptyError", "Please fill all the required fields");
            header("Location: index.php");
            exit();
        }

        include 'db_config.php';

        $comment = $conn->real_escape_string(htmlspecialchars($_POST['comment']));

        $userId = $_SESSION["id"];
        
        $query = "INSERT INTO comments (user_id, comment, updated_at)
                    VALUES ($userId, '$comment', '')";
                    
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
