<?php
    if(isset($_POST['txt'])) {
        $text = $_POST['txt'];

        include 'db_config.php';

        $arrData = [];

        $querySearch = "SELECT name, comment, created_at, c.id 
                        FROM comments c INNER JOIN  user_reg u
                        ON (c.user_id = u.id) 
                        WHERE comment LIKE '%$text%'";

        $runQuery = $conn->query($querySearch);

        if($runQuery->num_rows > 0) {
            while($row = $runQuery->fetch_assoc()) {
                $return_arr[] = array($row);
            }
            usleep(200000);
            echo json_encode(["error" => false, "message" => $return_arr]);
        }
        else {
            usleep(200000);
            echo json_encode(["error" => true, "message" => "No Comments Found"]) ;
        }
    }
    else {
        header("Location: comments.php");
        exit();
    }