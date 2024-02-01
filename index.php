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
        <a href="<?php echo SITEURL ?>" style="margin-right: 20px;">Home</a>

        <!-- this is the list of existng lists that are displayed dynamically -->
        <?php 
        //we want to display the lists as links so first we connect to the database and select the list data from list table

        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;

        $db_select2 = mysqli_select_db($conn2,DB_NAME) ;

        $sql2 = "SELECT * FROM tbl_lists" ;

        $res2 = mysqli_execute_query($conn2,$sql2) ;

        if($res2==true) {
            //means now fetch the data as associative array
            while($row2=mysqli_fetch_assoc($res2)) {
                $list_name = $row2['list_name'] ;
                $list_id = $row2['list_id'] ;
                ?>
                <a href="<?php echo SITEURL ?>list-task.php?list_id=<?php echo $list_id ?>"><?php echo $list_name?></a>

                <?php
            }
        }
        ?>
        <!-- list of lists end here, we can write the php code to display the lists dynamically -->
        <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>
    </div>
    <!-- Menu ends here -->

    <p>
        <?php
        if (isset($_SESSION['add-task-success'])) {
            echo $_SESSION['add-task-success'];
            unset($_SESSION['add-task-success']);
        }
        if(isset($_SESSION['delete-task-success'])) {
            echo $_SESSION['delete-task-success'] ;
            unset($_SESSION['delete-task-success']) ;
        }
        if(isset($_SESSION['delete-task-failed'])) {
            echo $_SESSION['delete-task-failed'] ;
            unset($_SESSION['delete-task-failed']) ;
        }
        if(isset($_SESSION['task-update-success'])) {
            echo $_SESSION['task-update-success'] ;
            unset($_SESSION['task-update-success']) ;
        }
        
        ?>
    </p>

    <!-- Tasks secion starts here -->
    <div class="all-tasks" style="margin-top: 20px;">
        <a href="<?php SITEURL ?>add-task.php">Add Task</a>
        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <tr>
                <?php
                //we need to display the name, priority, and deadline for the tasks inside the tasks table

                //connect
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();

                //select the database

                $db_select = mysqli_select_db($conn, DB_NAME);

                //wtite the query to select the data 
                $sql = "SELECT * FROM tbl_tasks";

                //execute the query
                $res = mysqli_execute_query($conn, $sql);

                if ($res == true) {
                    //count the number of rows first 
                    $no_of_rows  = mysqli_num_rows($res);

                    //create a sn no variable
                    $sn_number = 1;

                    if ($no_of_rows <= 0) {
                ?>
            <tr>
                <td colspan="5">
                    No Task found.
                </td>
            </tr>
            <?php
                    } else {
                        while ($row = mysqli_fetch_assoc($res)) {
                            //extract the data from each row
                            $task_name = $row['task_name'];
                            $task_id = $row['task_id'];
                            $task_priority = $row['priority'];
                            $task_deadline = $row['deadline'];

            ?>
                <tr>
                    <td><?php echo $sn_number ?></td>
                    <td><?php echo $task_name ?></td>
                    <td><?php echo $task_priority ?></td>
                    <td><?php echo $task_deadline ?></td>
                    <td>
                        <a href="<?php echo SITEURL ; ?>update-task.php?task_id=<?php echo $task_id ; ?>">Update</a>
                        <a href="<?php echo SITEURL ; ?>delete-task.php?task_id=<?php echo $task_id ; ?>">Delete</a>
                    </td>
                </tr>
    <?php

                            $sn_number += 1;
                        }
                    }
                } else {
                    die();
                }
    ?>



    </tr>
        </table>
    </div>
    <!-- Tasks end here -->
</body>

</html>