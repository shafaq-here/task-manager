<?php include('config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Task manager using PHP and MySQL</title>
    </head>

    <body>
        <h1>TASK MANAGER</h1>


        <a href="<?php echo SITEURL?>">Home</a>
        <a href="<?php echo SITEURL
        ?>manage-list.php">Back to Manage Lists</a>

        <p>
            <?php 
            //check for if there is a session message set or not
                if(isset($_SESSION['add-failed-message']))  {
                    // if set then display the message
                    echo $_SESSION['add-failed-message'];
                    //right after displaying the message, unset it to remove, otherwise it stays which is not right
                    unset($_SESSION['add-failed-message']) ;
                }   
            ?>
        </p>
        <h3>Let's add a new list here</h3>
        <!-- form to add new list starts here  -->
        <form action="" method="POST">
            <table>
                <tr>
                    <td>List Name: </td>
                    <td><input type="text" name="list_name" placeholder="Type list name here" required></td>
                </tr>
                <tr>
                    <td>List Description:</td>
                    <td><textarea name="list_description" placeholder="Lets describe your list."></textarea></td>
                </tr>

                <tr>
                    <td>
                        <button type="submit" name="submit">Save</button>
                    </td>
                </tr>
            </table>
        </form>
        <!-- form to add list ends here   -->
    </body>

</html>

<?php 
    //checking wheter the form is submitted or not
    if(isset($_POST['submit'])) {

        //get the variables from the form and store them in variables
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'] ;
     

        //connect the database

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die($conn) ;

        //select the database

        $db_select = mysqli_select_db($conn,DB_NAME) ; 
        if($db_select==false) {
            echo "Database not selected" ;
        }


        //write the sql query to instert into the database
        $sql = "INSERT INTO tbl_lists SET list_name='$list_name',
        list_description='$list_description'" ;

        //Execute query and to insert into database
        $res = mysqli_query($conn,$sql) ;

        //check if the query executed successfully or not , the $res holds value true or false 
        if($res==true) {
            //data inserted successfully
            $_SESSION['add-message'] = "Message says list was inserted successfully, hence redirected" ;
            
            //redirect back to manage-list.php
            header('location:'.SITEURL.'manage-list.php') ;

        } else {
            //data insertion failed
            // if failed, redirect back to add list page
            $_SESSION['add-failed-message'] = "Message says list was not inserted, hence try again" ;
            
            header('location:'.SITEURL.'add-list.php') ;
        }
    }
    ?>