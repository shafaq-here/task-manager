<?php 
//include the constants
include('config/constants.php') ;

//check if we have the list_id param in the get method

if(isset($_GET['list_id'])) {
    //perform the deletion

    //get the list id value from the get method glocal variable

    $list_id = $_GET['list_id'] ;
    //connect to the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD) or die();

    //select the database
    $db_select = mysqli_select_db($conn, DB_NAME) ;

    //write the sql query to delete the list
    $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id" ;

    //execute the sql query
    $res = mysqli_execute_query($conn,$sql) ;



    //check wheter the query was successful
    if($res==true) {
        //create a session variable for successful so that it can be displayed in the manage list page, in practical, when the list is so large taht going to look for such list would get impossible so a sophisticated message to print when a successful deletion happens the seesion variable is a great choice

        $_SESSION['delete'] = "Deletion was successful" ;

        //redirect to the previous page
        header("location:".SITEURL."manage-list.php") ;

    }

    else {
        //when the deletion fails, create a message for tht as well

        $_SESSION['delete_failed'] = "Failed to delete the list" ;

        //redirect to the previous page
        header("location:".SITEURL."manage-list.php") ;

    }


}
else {
    //redirect to the manage-list page, ......this situation might arise when somebody wants to access the delete page without any list id param
    header("location:".SITEURL."manage-list.php") ;
}


