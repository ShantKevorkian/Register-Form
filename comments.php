<?php
    session_start();

    include 'db_config.php';

    $sqlSelect = "SELECT c.user_id, u.name, c.comment, c.id, c.created_at
                    FROM comments c INNER JOIN user_reg u ON (u.id = c.user_id)
                    ORDER BY c.created_at";

    $runQuery = $conn->query($sqlSelect);

    if (!$runQuery) {
        $conn->close();
        echo "Database Error";
    }
    
    else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Page</title>
</head>
<body>
    <div class = "container">
        <div class = "col-md-10 offset-md-1 border p-5 bg-light mt-5">
        <a href="logout.php" class="btn btn-danger float-end">Logout</a>
            <h3 class = "d-flex align-items-center justify-content-center mb-5" style = "clear: both;">
                <?php
                    if(isset($_SESSION['userWelcome']))  {
                        echo $_SESSION['userWelcome']; 
                    }

                    else {
                        echo "Anonymous User";
                    }
                ?>
            </h3>
            <table class = "table table-borderless" style = "border-collapse: separate; border-spacing: 15px;">
                    <tr class = "pb-5">
                        <th scope="col">Name</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Edit</th>
                    </tr>
                <?php  
                    if ($runQuery->num_rows > 0) {
                        while($row = $runQuery->fetch_assoc()) {
                            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['comment'] . "</td><td>" . $row['created_at'] . "</td>";
                            if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) {
                                echo '<td class = "m-0 p-0"><a class = "btn btn-dark" href = "edit.php?id='. $row["id"]. ' " >Edit </a></td></tr>';
                            }
                        }
                    } else {
                            echo "<h5 class = 'd-flex align-items-center justify-content-center mb-5 text-danger'>No Comments Written in the Database</h3>";
                    }
                    $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
<?php
    }
?>