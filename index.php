<?php
require_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    throw new Exception("connection failed");
}
$query = "SELECT * FROM " . DB_TABLE . " WHERE complete = 0 ORDER BY date ";
$result = mysqli_query($connection, $query);

$complete_task_query = "SELECT * FROM " . DB_TABLE . " WHERE complete = 1 ORDER BY date DESC";
$complete_task_result = mysqli_query($connection, $complete_task_query);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tasks projects</title>
    <link rel="stylesheet" href="assets/vendors/normalize.css">
    <link rel="stylesheet" href="assets/vendors/milligram.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2><a href="http://localhost/phptestbed/tasks/index.php">Task Manager</a></h2>
                <p>A sample project to perform CURD operations using mysql and PHP</p>
                <?php if (mysqli_num_rows($complete_task_result) == 0) {
                    echo "  <h4>No Complete Tasks Found</h4>";
                } else {
                ?>
                    <h4>Complete Tasks</h4>
                    <table>
                        <tr>
                            <th></th>
                            <th>Task ID</th>
                            <th>Task Title</th>
                            <th>Task Date</th>
                            <th width="30%">Actions</th>
                        </tr>
                        <?php while ($data = mysqli_fetch_assoc($complete_task_result)) {
                            $timestamp = strtotime($data['date']);
                            $date = date('dS M, Y', $timestamp); ?>
                            <tr>
                                <td><input type="checkbox" name="check" class="label-inline" value="1"></td>
                                <td><?php echo $data['id']; ?></td>
                                <td><?php echo $data['task']; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><a class="delete" data-delete_task_id="<?php echo $data['id']; ?>" href="#">Delete</a> | <a class="incomplete" href="#" data-incomplete_task_id="<?php echo $data['id']; ?>">incomplete</a></td>
                            </tr>
                        <?php }  ?>
                    </table>
                    <hr>
                <?php
                }  ?>

                <h4>ALL TASKS</h4>
                <?php if (mysqli_num_rows($result) == 0) {
                    echo "<h4>No Task Found</h4>";
                } else {
                ?>
                    <form action="task.php" method="POST">
                        <table>
                            <tr>
                                <th></th>
                                <th>Task ID</th>
                                <th>Task Title</th>
                                <th>Task Date</th>
                                <th width="30%">Actions</th>
                            </tr>
                            <?php
                            while ($data = mysqli_fetch_assoc($result)) {
                                $timestamp = strtotime($data['date']);
                                $date = date('dS M, Y', $timestamp);

                            ?>
                                <tr>
                                    <td><input type="checkbox" name="<?php echo 'task_ids[]'; ?>" class="label-inline" value="<?php echo $data['id']; ?>"></td>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['task']; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><a class="delete" data-delete_task_id="<?php echo $data['id']; ?>" href="#">Delete</a> | <a class="complete" data-task_id="<?php echo $data['id']; ?>" href="#">complete</a></td>
                                </tr>

                            <?php
                            }
                            ?>
                        </table>
                        <div>
                            <select id="bulk_action" name="action">
                                <option value="0">With Selected</option>
                                <option name="bulk_delete" value="bulk_delete">Delete</option>
                                <option name="bulk_complete" value="bulk_complete">Mark As Complete</option>
                            </select>
                            <input type="submit" value="Take Action" class="button-primary float-right">
                        </div>
                    </form>
                <?php
                }
                ?>
                <hr />
                <h4>Add New Task</h4>
                <?php
                $added = $_GET['added'] ?? '';
                if ('true' == $added) {
                ?>
                    <blockquote id="success-message">
                        Successfully save data
                        <span class="close-btn" onclick="closeSuccessMessage()">×</span>
                    </blockquote>
                <?php
                }
                ?>
                <form action="task.php" method="POST">
                    <fieldset>
                        <label for="task_title">Task Title</label>
                        <input type="text" name="task_title" id="task_title" placeholder="add new task title">
                        <label for="task_date">Task Date</label>
                        <input type="text" name="task_date" id="task_date" placeholder="add new task date">
                        <input type="submit" value="Add Task" class="button-primary">
                        <input type="hidden" name="action" id="action" value="add">
                    </fieldset>
                </form>
            </div>
        </div>


    </div> <!-- end the container of this site -->

    <!-- complete form  -->
    <form action="task.php" method="POST" id="complete-form">
        <input type="hidden" name="action" id="complete_action" value="complete">
        <input type="hidden" name="task_id" id="task_id">
    </form>
    <!-- incomplete form -->
    <form action="task.php" method="POST" id="incomplete-form">
        <input type="hidden" name="action" id="incomplete_action" value="incomplete">
        <input type="hidden" name="incomplete_task_id" id="incomplete_task_id">
    </form>
    <!-- delete form -->
    <form action="task.php" method="POST" id="delete-form">
        <input type="hidden" name="action" id="delete_action" value="delete">
        <input type="hidden" name="delete_task_id" id="delete_task_id">
    </form>
    <script src="assets/main.js"></script>
</body>

</html>