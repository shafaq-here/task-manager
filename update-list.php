<?php
include('config/constants.php');

if(isset($_GET['list_id'])) {
    //get the id value 
    $list_id = $_GET['list_id'] ;

    //conn to the mysql
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;

    //select the database
    $db_select = mysqli_select_db($conn,DB_NAME) or die() ;

    //sql query to get the current data for the list to be display as plsceholder
    $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id" ;

    //execute the sql command
    $res =  mysqli_execute_query($conn,$sql) ;

    if($res==true) {
        //fetch the row from the current list_id
        $row = mysqli_fetch_assoc($res) ;

        //get the data from the row in variables
        $list_name = $row['list_name'] ;
        $list_description = $row['list_description'] ;
    }
    else {
        //redirect back to manage list page
        header('location:'.SITEURL.'manage-list.php') ;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php TITLE ?></title>
</head>

<body>
    <h1>TASK MANAGER</h1>

    <div class="menu">
        <a href="<?php echo SITEURL ?>">Home</a>
        <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>
    </div>

    <h3>Update List data here!</h3>
    <p>
        <?php
        //same type of failed update message
                if(isset($_SESSION['update-failed'])) {
                    //print the message for filed update
                    echo $_SESSION['update-failed'] ;

                    //unset it 
                    unset($_SESSION['update-failed']) ;
                }

        ?>
    </p>
   
    <form action="" method="POST">
        <table>
            <tr>
                <td>List Name:</td>
                <td><input type="text" name="list_name" value="<?php echo $list_name?>" required></td>
            </tr>

            <tr>
                <td>List Description:</td>
                <td>
                    <textarea name="list_description">
                    <?php echo $list_description?>
                    </textarea>
                </td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="UPDATE"></td>
            </tr>   
        </table>
    </form>
</body>

</html>



<?php 
    //we will now write the code to update the data in this row

    //first we need to check if the submit button is clicked or not
    if(isset($_POST['submit'])) {
        // echo "form submitted" ;

        //we get the variables from the form and store them
        $list_name = $_POST['list_name'] ;
        $list_description = $_POST['list_description'] ;

        //now we need to start a new database connection to update the database with the new values
        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;

        //we select the database again
        $db_select2 = mysqli_select_db($conn2,DB_NAME) or die() ;

        //wrtte the sql query to updata the database
        $sql2 = "UPDATE tbl_lists SET
        list_name = '$list_name',
        list_description = '$list_description'
        WHERE list_id = '$list_id' " ;

        //then we execute the query
        $res2 = mysqli_execute_query($conn2,$sql2) ;

        if($res==true) {
            //that the update was successful
            //add a session variable for update message
            $_SESSION['update'] = "List was updated successfully" ;

            //and then redirect back to the manage-list page
            header('location:'.SITEURL.'manage-list.php') ;
        }
        else {
            //and if the update failed for some reason, create a sessionn variable to be passed to other pages(manage list page) for the failed update message
            $_SESSION['update-failed'] = "List update failed, try again!" ;

            //and redired to the same page when the update was failed, notice that we want to redirect the user back to the same page which it was before submitting, which is the update list page with the current list_id, so it is to be directed to the update list page with the param list id 
            header('location:'.SITEURL.'update-list.php?list_id='.$list_id) ;
        }
    }
?>