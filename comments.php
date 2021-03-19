<?php
    session_start();

    include 'db_config.php';

    $sqlSelect = "SELECT c.user_id, u.name, c.comment
                    FROM comments c INNER JOIN user_reg u ON u.id = c.user_id";

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
        <h3 class = "d-flex align-items-center justify-content-center">
            <?php
                if(isset($_SESSION['userWelcome']))  {
                    echo $_SESSION['userWelcome']; 
                }
            ?>
        </h3>
        <h5 class = "d-flex align-items-center justify-content-center">Comments written in the database:</h5>
        <table class = "table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Edit</th>
                </tr>
            </thead>
        <p class = "d-flex align-items-center justify-content-center">
            <?php  
                if ($runQuery->num_rows > 0) {
                    while($row = $runQuery->fetch_assoc()) {
                        echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["comment"] . "</td></tr>";
                        if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) {
                            echo "<tr style = 'margin-left = 300px;'><td>" . $_SESSION['editButton'] . "</td></tr>";
                        }
                    }
                } else {
                        echo "No Comment Written in the Database";
                }
            ?>
        </p>
        </table>
        </div>
    </div>
</body>
</html>
<?php
    }
?>