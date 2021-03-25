<?php
    if(isset($_POST['txt'])) {
        $text = $_POST['txt'];

        include 'db_config.php';

        $return_arr = array();

        $querySearch = "SELECT comment, created_at, name 
                        FROM comments c, user_reg u
                        WHERE comment LIKE '%$text%'
                        AND c.user_id = u.id";

        $runQuery = $conn->query($querySearch);

        if($runQuery->num_rows > 0) {
            while($row = $runQuery->fetch_assoc()) {
                echo "	<tr>
                            <td>".$row['name']."</td>
                            <td>".$row['comment']."</td>
                            <td>".$row['created_at']."</td>
                        </tr>";
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