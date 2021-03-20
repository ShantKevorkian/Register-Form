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
    <a href="logout.php" class="btn btn-danger col-md-1 float-end">Logout</a>
        <h3 class = "d-flex align-items-center justify-content-center" style = "clear: both;">
            <?php
                if(isset($_SESSION['userWelcome']))  {
                    echo $_SESSION['userWelcome']; 
                }
            ?>
        </h3>
        <h5 class = "d-flex align-items-center justify-content-center mb-5">Comments written in the database:</h5>
        <div class="row border-bottom border-dark mb-5">
            <div class="col-sm">
            Name
            </div>
            <div class="col-sm">
            Comment
            </div>
            <div class="col-sm">
            Created At
            </div>
            <div class="col-sm">
            Edit
            </div>
        </div>
        <p class = "d-flex align-items-center justify-content-center">
            <?php  
                if ($runQuery->num_rows > 0) {
                    while($row = $runQuery->fetch_assoc()) {
                        echo "<div class = 'row border-bottom text-primary' style = 'width: 77%;'><div class='col-sm'>" . $row["name"] . "</div><div class='col-sm'>" . $row["comment"] . "</div><div class='col-sm'>" . $row["created_at"] . "</div></div> <br>";
                        if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) {
                            echo '<a class = "btn btn-dark col-md-1 offset-md-10" style = "margin-top: -70px; margin-bottom: 25px;" href = "edit.php?id='. $row["id"]. ' " >Edit </a>';
                        }
                    }
                } else {
                        echo "No Comment Written in the Database";
                }
            ?>
        </p>
        </div>
    </div>
</body>
</html>
<?php
    }
?>