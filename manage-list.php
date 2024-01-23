<?php include('config/constants.php') ; ?>
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

    <!-- this is the messages section below, the p -->
    <p>
        <?php 
            if(isset($_SESSION['add-message'])){
                //display the successful message
                echo $_SESSION['add-message'] ;
                //should always unset it to remove from screen
                unset($_SESSION['add-message']) ;
            }

            if(isset($_SESSION['delete'])) {
                //print the successful message
                echo $_SESSION['delete'] ;
                unset($_SESSION['delete']) ;
            }

            if(isset($_SESSION['delete-failed'])) {
                //print the failed message
                echo $_SESSION['delete_failed'] ;
                unset($_SESSION['delete_failed']) ;
            }

            //session messages for update list page

            if(isset($_SESSION['update'])) {
                //print the message
                echo $_SESSION['update'] ;

                //then unset it so that it does not stay there forever
                unset($_SESSION['update']) ;
            }

        ?>
    </p>
    <!-- the messaage section ends here -->
    <h3>Manage your lists here</h3>
    <a href="<?php echo SITEURL?>add-list.php">Add List</a>

    <!-- Table to display lists starts -->
    <div class="all-list">
        <table>
            <tr>
                <th>S.N.</th>
                <th>List Name</th>
                <th>Actions</th>
            </tr>

            <?php
                //connect to the database
                $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;
            
                //need to select the database
                $db_select = mysqli_select_db($conn,DB_NAME) ;

                //write the sql query
                $sql = "SELECT * FROM tbl_lists" ;

                //execute the query
                $res = mysqli_execute_query($conn,$sql) ;

                //check for failure or success
                if($res==true) {
                    //query execution was successful so work furthur to display the result

                    $count_row = mysqli_num_rows($res) ;

                    //create a serial number to be displayed in list
                    $serial_no = 1 ;

                    if($count_row<=0) {
                        //no data found in database
                        ?>

                        <tr>
                            <td colspan="3">
                                No lists found.
                            </td>
                        </tr>
                        <?php
                    }
                    
                    else {
                        while($row = mysqli_fetch_assoc($res)) {
                            $list_id = $row['list_id'] ;
                            $list_name = $row['list_name'] ;

                            ?>
                            
                        <tr>
                            <td><?php echo $serial_no ;?></td>
                            <td><?php echo $list_name ;?> </td>
                            <td>
                                <a href="<?php echo SITEURL ?>update-list.php?list_id=<?php echo $list_id ;?>">Update</a>
                                <a href="<?php echo SITEURL ?>delete-list.php?list_id=<?php echo $list_id ;?>">Delete</a>
                            </td>
                        </tr>
                        <?php 
                        $serial_no += 1 ;
                        }
                    }
                    
                } 
                else {

                }
            ?>
            
        </table>
    </div>
    <!-- Table to display and manage lists ends here  -->
</body>

</html>