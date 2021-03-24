<?php

    include 'db_config.php';
    include 'functions.php';
    
    $weatherData = getWeather();

    $sqlSelect = "SELECT c.user_id, u.name, c.comment, c.id, c.created_at
                    FROM comments c INNER JOIN user_reg u ON (u.id = c.user_id)
                    ORDER BY c.created_at DESC";

    $runQuery = $conn->query($sqlSelect);

    if (!$runQuery) {
        $conn->close();
        echo "Database Error";
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comment Page</title>
    </head>
    <script>
        $(document).ready(function() {
            $("#btnSearch").click(function() {
                var txt = $("#txtSearch").val();
                if($("#txtSearch").val()) {
                    $.ajax({
                        type: "POST",
                        url: 'search.php',
                        data: {
                            txt: txt
                        }, 
                        success: function(response){
                            $("#tbl").empty();
                            $("#blank").hide();
                            $("#commSearch").css("display", "block");
                            $("#commSearch").html(response);
                        }
                    });
                }
                else {
                    $("#blank").html("You have to search for something");
                }
            });
        });
    </script>
    <body>
        <div class = "container">
            <div class = "col-md-10 offset-md-1 border p-3 bg-light mt-5">
                <a href="logout.php" class="btn btn-danger float-end">Logout</a>
                <h6>Location: <?=$weatherData['city_name']?></h6>
                <h6>Temperature: <?=$weatherData['temperature']?></h6>
                <div>
                    <input type = "text" class = "pt-1 pb-1 border border-secondary rounded" placeholder = "Search" style = "outline: none; text-indent: 5px;" id = "txtSearch">
                    <input type = "submit" class = "btn btn-outline-secondary pl-1 pr-1 pt-1 pb-1 mb-1" value = "Search" id = "btnSearch">
                </div>
                <span id = "blank" class = "text-danger ml-5"> </span>
                <h3 class = "d-flex align-items-center justify-content-center" style = "clear: both;">
                    <?php if(isset($_SESSION['username'])): ?>
                        Welcome <?=$_SESSION['username'] ?>
                    <?php else: ?>
                        Anonymous User
                    <?php endif; ?>
                </h3>
                <h6 class="d-flex align-items-center justify-content-center text-danger mt-3 mb-3">
                    <?php
                        getSession('otherComment');
                    ?>
                </h6>
                <table id="commSearch" style = "display: none;">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <table class = "table table-borderless" id = "tbl" style = "border-collapse: separate; border-spacing: 15px;">
                        <tr class = "pb-5">
                            <th scope="col">Name</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Edit</th>
                        </tr> 
                    <?php if ($runQuery->num_rows > 0): ?>
                        <?php while($row = $runQuery->fetch_assoc()): ?>
                            <tr><td><?=$row['name']?></td>
                            <td><?=$row['comment']?></td>
                            <td><?=$row['created_at']?></td>
                            <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']): ?>
                                <td class = "m-0 p-0"><a class = "btn btn-dark" href = "edit.php?id=<?=$row["id"]?> ">Edit </a></td></tr>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <h5 class = 'd-flex align-items-center justify-content-center mb-5 text-danger'>No Comments Written in the Database</h3>
                    <?php endif;
                        $conn->close();
                    ?>
                    </div>
                </table>
            </div>
        </div>
    </body>
</html>