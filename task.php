<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    throw new Exception("failed to connect database");
} else {

    $action = $_POST['action'] ?? '';
    if (!$action) {
        header('location: index.php');
    } else {
        if ('add' == $action) {
            $task_title = $_POST['task_title'];
            $task_date = $_POST['task_date'];
            if ($task_title && $task_date) {
                $query = "INSERT INTO " . DB_TABLE . " (task, date) VALUES ('{$task_title}','{$task_date}')";
                mysqli_query($connection, $query);
                header('location: index.php?added=true');
            }
        } else if ('complete' == $action) {
            $taskId = $_POST['task_id'];
            $query_update = "UPDATE " . DB_TABLE . " SET complete = 1 WHERE id={$taskId} LIMIT 1";
            mysqli_query($connection, $query_update);
            header('location: index.php');
        } else if ('incomplete' == $action) {
            $IncompleteTaskId = $_POST['incomplete_task_id'];
            echo $IncompleteTaskId;
            $query_update = "UPDATE " . DB_TABLE . " SET complete = 0 WHERE id={$IncompleteTaskId} LIMIT 1";
            mysqli_query($connection, $query_update);
            header('location: index.php');
        } else if ('delete' == $action) {
            $deleteTaskId = $_POST['delete_task_id'];
            echo $deleteTaskId;
            $query_update = "DELETE FROM " . DB_TABLE . " WHERE id={$deleteTaskId} LIMIT 1";
            mysqli_query($connection, $query_update);
            header('location: index.php');
        }
    }
}
