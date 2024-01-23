<?php include('config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager with PHP and MySQL</title>
</head>

<body>
    <h1>TASK MANAGER</h1>
    <!-- Menu starts here -->
    <div class="menu">
        <a href="<?php echo SITEURL?>"  style="margin-right: 20px;">Home</a>
        
    <!-- this is the list of existng lists that are displayed dynamically -->
        <a href="#">To-Do</a>
        <a href="#">Doing</a>
        <a href="#">Done</a>
    <!-- list of lists end here, we can write the php code to display the lists dynamically -->
        <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>
    </div>
    <!-- Menu ends here -->

    <!-- Tasks secion starts here -->
    <div class="all-tasks" style="margin-top: 20px;">
        <a href="<?php SITEURL?>add-task.php">Add Task</a>
        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Design a website</td>
                <td>Medium</td>
                <td>23/05/2023</td>
                <td>
                    <a href="#">Update</a> 
                    <a href="#">Delete</a>
                </td>


            </tr>
        </table>
    </div>
    <!-- Tasks end here -->
</body>

</html>