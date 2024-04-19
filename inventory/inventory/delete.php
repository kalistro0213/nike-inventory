<?php

include 'connect.php';

//Used in deleting data from the table
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM sneaker WHERE id = $id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header("location:index.php");
    }else{
        die(mysqli_error($conn));
    }

}
?>