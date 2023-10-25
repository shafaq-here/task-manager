<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>TAsk Manager with PHP and MYsql</title>
</head>

<body>
    <h1>TASK MANAGER</h1>
    <!-- Mwnu starts here -->
    <div class="menu">
        <a href="#">Home</a>
        <a href="#">ToDo</a>
        <a href="#">Doing</a>
        <a href="#">Done</a>

        <a href="#">Manage Lists</a>
    </div>
    <!-- Menu ends here -->

    <!-- Tasks secion starts here -->
    <div class="all-tasks">
        <a href="#">Add Task</a>
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
                <td><a href="#">Update</a> <a href="3">Delete</a></td>


            </tr>
        </table>
    </div>
</body>

</html>