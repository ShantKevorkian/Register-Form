<?php
    session_start();
    $comment_id = $_SESSION["userID"];
    date_default_timezone_set("Europe/Moscow");
    $updated_date = date("Y-m-d H:i:s");

    if (!isset($_SESSION["id"])) {
        header("location: comments.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($_POST["editComment"])) {
            header("Location: edit.php");
            exit();
        }

        include "db_config.php";
        $edit_comment = $conn->real_escape_string(htmlspecialchars($_POST['editComment']));

        $queryUpdate = "UPDATE comments
                            SET comment = '$edit_comment', updated_at = '$updated_date'
                                WHERE id = $comment_id";

        if ($conn->query($queryUpdate)) {
            session_start();
            $conn->close();
            header("Location: comments.php");
            exit();
        }
    }