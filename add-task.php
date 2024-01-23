<?php include('config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager using PHP and MySQL</title>
</head>
<body>
    <h1>TASK MANAGER</h1>
    <a href="<?php echo SITEURL?>">Home</a>
    <h3>Welcome to Add Task page</h3>

    <form method="POST" action="">
        <table>
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" placeholder="Enter the task name here" required></td>
            </tr>
            <tr>
                <td>Task Description:</td>
                <td>
                    <textarea name="task_description" placeholder="Enter the task description"></textarea>
                </td>
            </tr>
            <tr>
                <td>Select List:</td>
                <td>
                    <select name="list_id" id="">
                        <option value="1">ToDo</option>
                        <option value="2">Doing</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>