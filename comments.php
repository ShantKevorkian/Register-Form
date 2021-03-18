<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "internship";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . "<br>" . $conn->connect_error);
    }

    $sqlSelect = "SELECT id, name, comment from comments";

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
    <div class = "col-md-4 offset-md-4 border p-5 bg-light mt-5">
        <h3 class = "d-flex align-items-center justify-content-center">
            <?php
                session_start();
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
                </tr>
            </thead>
        <p class = "d-flex align-items-center justify-content-center">
            <?php  
                if ($runQuery->num_rows > 0) {
                    while($row = $runQuery->fetch_assoc()) {
                        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["comment"] . "</td></tr>";
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