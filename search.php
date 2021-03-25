<?php
    if(isset($_POST['txt'])) {
        $text = $_POST['txt'];

        include 'db_config.php';

        $return_arr = array();

        $querySearch = "SELECT comment, name 
                        FROM comments c, user_reg u
                        WHERE comment LIKE '%$text%'
                        AND c.user_id = u.id";

        $runQuery = $conn->query($querySearch);

        if($runQuery->num_rows > 0) {
            while($row = $runQuery->fetch_assoc()) {
                echo "<tr><th>Name:</th><td>" . $row['name'] . "</td>";
                echo "<th>Comment:</th><td>" . $row['comment'] . "</td><tr>";
            }
        }
        else {
            echo "No comments found";
        }
    }
    else {
        header("Location: comments.php");
        exit();
    }