<?php 
    $server = "localhost";
    $username="root";
    $password="";
    $db  = "user1824";
    $conn = mysqli_connect($server,$username,$password,$db);
    if(!$conn)
    {
        die("connection failed ".mysqli_connect_error());
    }
?>