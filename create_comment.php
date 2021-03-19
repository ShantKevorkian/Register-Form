<?php
    include 'funcSession.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($_POST["comment"])) {
            session_start();
            setSession("emptyError", "Please fill all the required fields");
            header("Location: index.php");
            exit();
        }

        include 'db_config.php';

        $comment = $conn->real_escape_string(htmlspecialchars($_POST['comment']));

        session_start();
        $userId = $_SESSION["id"];
        
        $query = "INSERT INTO comments (user_id, comment)
                    VALUES ($userId, '$comment')";
                    
        if ($conn->query($query)) {
            session_start();
            $conn->close();
            $_SESSION['editButton'] = "<form action = 'edit.php' method = 'POST'><input type='submit' name = 'submit' class='btn btn-primary col-md-4 offset-md-4' value = 'Edit'></form>";
            header("Location: comments.php");
            exit();
        }

        else {
            session_start();
            setSession("datError", "Database Query Error");
            header("Location: index.php");
            exit();
        }
    }
