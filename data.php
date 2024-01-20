<?php
include_once 'config.php';
echo DB_HOST;

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    throw new Exception("connection failed");
} else {
    echo "database connect successfully";
    //insert a record

    // mysqli_query($connection,"INSERT INTO tasks (task, date) VALUES ('FIRST task','2024-10-26')");
    // mysqli_query($connection,"INSERT INTO tasks (task, date) VALUES ('SECOND task','2024-10-26')");

    // $search_result = mysqli_query($connection, "SELECT * FROM tasks");
    // while ($data = mysqli_fetch_assoc($search_result)) {
    //     echo "<pre>";
    //     print_r($data);
    //     echo "</pre>";
    // }

    //$delete_query = mysqli_query($connection,"DELETE FROM tasks");

    //mysqli_close($connection);

}


