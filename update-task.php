<?php 
include('config/constants.php') ;

//check if a task id was submitted in the get request or not, if not then redirect to the homepage

if(isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'] ;

    //connect to the database

    $conn  = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die();

    $db_select = mysqli_select_db($conn,DB_NAME) ;

    $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id" ;

    $res = mysqli_execute_query($conn,$sql) ;

    if($res==true) {
        //fecth the details of the task as an associative array
        $row = mysqli_fetch_assoc($res) ;

        //extract the task details
        $task_name = $row['task_name'] ;
        $task_description = $row['task_description'] ;
        $list_id = $row['list_id'] ;
        $priority = $row['priority'] ;
        $deadline = $row['deadline'] ;
    }
    else {
        //if could not fecth the details for some reason, simply redirct to the homepage
        header('location:'.SITEURL) ;
    }
} 
else {
    //redirect to homepage
    header("location:".SITEURL) ;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager with PHP and MYSQL</title>
</head>
<body>
    <h1>TASK MANAGER</h1>

    <div class="menu">
        <a href="<?php echo SITEURL ?>">Home</a>
    </div>

    <h3>Update Task details here!</h3>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" value="<?php echo $task_name?>" required></td>
            </tr>

            <tr>
                <td>Task Description:</td>
                <td>
                    <textarea name="task_description">
                    <?php echo $task_description?>
                    </textarea>
                </td>
            </tr>

            <tr>
                <td>Select List:</td>
                <td>
                    <select name="list_id" >

                        <?php 
                            //here we will write the code to display the name of lists inside the dropdown

                            //first connect to the database
                            $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die();

                            //select the database
                            $db_select2 = mysqli_select_db($conn2,DB_NAME) ;

                            //write the query to select the lists from the tbl_lists
                            $sql2 = "SELECT * FROM tbl_lists" ;

                            //execute the sql
                            $res2 = mysqli_query($conn2,$sql2) ;

                            //check of result is successful
                            if($res2==true) {
                                //we need to know the number of rows to see if there is any data inside this table or not 
                                $no_of_rows = mysqli_num_rows($res2) ;

                                //if the no of rows is >0 then display all the name of the lists and use the list_id value as well
                                if($no_of_rows > 0) {
                                    //for each row inside the table print it using the dropdown, you might need to end and open new php for that
                                    while($row=mysqli_fetch_assoc($res2)) {
                                        $list_id_db = $row['list_id'] ;
                                        $list_name = $row['list_name'] ;

                                        ?>
                                        <option <?php if($list_id_db==$list_id) {echo "selected='selected'" ;}  ?> value="<?php echo $list_id_db ; ?>"><?php echo $list_name?></option>
                                        
                                        <?php
                                    }
                                }
                                else {
                                    //no rows hence no list found
                                    ?>
                                    <option <?php if($list_id==0) {echo "selected='selected'" ;} ?> value="0">None</option>

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
                    <select name="priority" >
                        <option <?php if($priority=="High"){echo "selected='selected'" ;} ?> value="High">High</option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'" ;} ?> value="Medium">Medium</option>
                        <option <?php if($priority=="Low"){echo "selected='selected'" ;} ?> value="Low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td>
                    <input type="date" name="deadline" value="<?php echo $deadline ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Update" name="submit">
                </td>
            </tr>  
        </table>
    </form>
</body>
</html>

<?php 
    if(isset($_POST['submit'])) {
        // echo 'Clicked' ;

        //get the values from the form
        $task_name = $_POST['task_name'] ;
        // $task_id = $_POST['task_id'] ;
        $task_description  = $_POST['task_description'] ;
        $list_id = $_POST['list_id'] ;
        $deadline = $_POST['deadline'] ;
        $priority = $_POST['priority'] ;

        //connect the database select and execute the update query
        $conn3 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;

        $db_select3 = mysqli_select_db($conn3,DB_NAME) ;

        $sql3 = "UPDATE tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'
            
            WHERE task_id = $task_id " ;

        $res3 = mysqli_execute_query($conn3,$sql3) ;
        
        if($res==true) {
            //means the update was successful, so create a session message and redirect to home page
            $_SESSION['task-update-success'] = "The Task was updated successfully" ;
            header('location:'.SITEURL) ;
        }
        else {
            //means failed to update so redirect to same page and create a message for same
            $_SESSION['task-update-failed'] = "Failed to update the task, Try Again!" ;
            header('location:'.SITEURL."update-task.php") ;
        }

    }