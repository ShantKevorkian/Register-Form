<?php

    include 'db_config.php';
    include 'functions.php';
    
    $weatherData = getWeather();

    $sqlSelect = "SELECT user_id, name, comment, c.id, created_at
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
        $(function() {
            let xhr = null;
            $("#txtSearch").keyup(function() {    
                let q = $("#txtSearch").val();
                if(q.length > 2) {
                    xhr = $.ajax({
                        type: "POST",
                        url: "search.php",
                        data: {
                            txt: q
                        },
                        dataType: "json",
                        beforeSend: function() {
                            if(xhr != null) {
                                xhr.abort();
                            }
                        },
                        success: function(response){
                            $("#commSearch").empty();
                            $("#blank").hide();
                            if(response.error) {
                                $('#commSearch').append(response.message);
                            }
                            else {
                                $.each(response["message"], function(key, value) {
                                    let result = 
                                    "<tr><td>" + value.name + "</td>" +
                                    "<td>" + value.comment + "</td>" +
                                    "<td>" + value.created_at + "</td>";
                                    if(<?=$_SESSION['id']?> == value.user_id) {
                                        result += "<td class = 'm-0 p-0'><a class = 'btn btn-dark' href = 'edit.php?id=" + value.id + " '>Edit </a></td></tr>";
                                    }
                                    else {
                                        result += "</tr>";
                                    }
                                    $('#commSearch').append(result);
                                });
                            }
                        }
                    });
                }
                else {
                    $("#blank").html("At least 3 characters required");
                }
            });
        });
    </script>
    <body class = "bg-dark">
        <div class = "container">
            <div class = "col-md-10 offset-md-1 border p-3 bg-light mt-5 rounded">
                <a href="logout.php" class="btn btn-danger float-end">Logout</a>
                <h6>Location: <?=$weatherData['city_name']?></h6>
                <h6>Temperature: <?=$weatherData['temperature']?></h6>
                <div>
                    <input type = "text" class = "p-0 border border-secondary rounded" placeholder = "Search" style = "outline: none; text-indent: 5px;" id = "txtSearch">
                </div>
                <span id = "blank" class = "text-danger"> </span>
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
                <table class = "table table-borderless" style = "border-collapse: separate; border-spacing: 5px;">
                    <tr class = "pb-5">
                        <th scope="col">Name</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Date</th>
                        <th scope="col">Edit</th>
                    </tr> 
                    <tbody id="commSearch">
                    <?php if ($runQuery->num_rows > 0): ?>
                        <?php while($row = $runQuery->fetch_assoc()): ?>
                            <tr><td><?=$row['name']?></td>
                            <td><?=$row['comment']?></td>
                            <td><?=$row['created_at']?></td>
                            <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']): ?>
                                <td class = "m-0 p-0"><a class = "btn btn-dark pt-1 pb-1" href = "edit.php?id=<?=$row["id"]?> ">Edit </a></td></tr>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <h5 class = 'd-flex align-items-center justify-content-center mb-5 text-danger'>No Comments Written in the Database</h3>
                    <?php endif;
                        $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>