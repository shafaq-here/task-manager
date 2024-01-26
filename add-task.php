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

    <p>
        <?php
        if(isset($_SESSION['add-task-failed'])) {
            echo $_SESSION['add-task-failed'] ;
            unset($_session['add-task-failed']) ;
        } 
        ?>
    </p>
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
                    <select name="list_id" >

                        <?php 
                            //here we will write the code to display the name of lists inside the dropdown

                            //first connect to the database
                            $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die();

                            //select the database
                            $db_select = mysqli_select_db($conn,DB_NAME) ;

                            //write the query to select the lists from the tbl_lists
                            $sql = "SELECT * FROM tbl_lists" ;

                            //execute the sql
                            $res = mysqli_query($conn,$sql) ;

                            //check of result is successful
                            if($res==true) {
                                //we need to know the number of rows to see if there is any data inside this table or not 
                                $no_of_rows = mysqli_num_rows($res) ;

                                //if the no of rows is >0 then display all the name of the lists and use the list_id value as well
                                if($no_of_rows > 0) {
                                    //for each row inside the table print it using the dropdown, you might need to end and open new php for that
                                    while($row=mysqli_fetch_assoc($res)) {
                                        $list_id = $row['list_id'] ;
                                        $list_name = $row['list_name'] ;

                                        ?>
                                        <option value="<?php echo $list_id ?>"><?php echo $list_name?></option>
                                        
                                        <?php
                                    }
                                }
                                else {
                                    //no rows hence no list found
                                    ?>
                                    <option value="0">None</option>

                                    <?php
                                }
                            }
                        ?>
                        
                        
                    </select>
                </td>
            </tr>
            <tr>
                <td>Priority:</td>
                <td>
                    <select name="priority" id="">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td>
                    <input type="date" name="deadline">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Save" name="submit">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php 
    //check if the form was submitted
    if(isset($_POST['submit'])) {
        //echo $_POST['priority'] ;
        $task_name = $_POST['task_name'] ;
        $task_description = $_POST['task_description'] ;
        $list_id = $_POST['list_id'] ;
        $priority = $_POST['priority'] ;
        $deadline = $_POST['deadline'] ;

        //we have the data from the form now we will insert the data into the database

        //connedt to the database
        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;

        $db_select2 = mysqli_select_db($conn2,DB_NAME);

        //write the sql query to insert the data into the task table
        $sql2 = "INSERT INTO tbl_tasks SET
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = $list_id,
        priority = '$priority',
        deadline = '$deadline'
        " ;

        //execute the sql query
        $res2 = mysqli_execute_query($conn2,$sql2) ;

        if($res2==true) {
            //query was successful so set a session message for successful addition of task and redirect to home
            $_SESSION['add-task-success'] = "Task was successfully added" ;

            header('location:'.SITEURL) ;
        }
        else {
            //failed to add the task for some reason so redirect back to add-task page to try again
            $_SESSION['add-task-failed'] = "Failed to add task, Try Again!";
            header('location:'.SITEURL.'add-task.php') ;
        }
    }
?>
