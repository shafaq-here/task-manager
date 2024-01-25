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
        </table>
    </form>
</body>
</html>