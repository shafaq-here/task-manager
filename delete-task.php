<?php include('config/constants.php') ?>
<?php
if(isset($_GET['task_id'])) {
    //perform the deletion

    $task_id = $_GET['task_id'] ;

    //connect to the database
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die() ;

    $db_select = mysqli_select_db($conn,DB_NAME) ;

    $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id" ;

    $res = mysqli_execute_query($conn,$sql) ;

    if($res==true) {
        //deletion was successful
        //create a session message and redirect to the home page and display the message there
        $_SESSION['delete-task-success'] = "The task was successfully deleted" ;
        header('location:'.SITEURL) ;
    } else {
        //unsuccessfull, so create the session message for failed to delete and redirect to home
        $_SESSION['delete-task-failed'] = "Failed to delete the task" ;
        header("location:".SITEURL) ;
    }
} 
else {
    //site was being accessed without a task id, so redirect to home page
    header('location:'.SITEURL) ;
}

?>