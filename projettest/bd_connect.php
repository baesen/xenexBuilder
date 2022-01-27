<?php 

    //connection to the base
    $conn = mysqli_connect('localhost','root','','first');

    if($conn === false)
    {
        die("connection error");
    }
?>