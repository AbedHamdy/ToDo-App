<?php 

    // connect with Database
    $conn = mysqli_connect("localhost" , "root" , "");
    
    if(!$conn)
    {
        echo "Error connecting" . mysqli_connect_error();
    }

    $sql = "CREATE DATABASE IF NOT EXISTS todoapp";
    
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    // create tables in database
    $conn = ConnectDatabase("todoapp");

    $sql = 
        "CREATE TABLE IF NOT EXISTS `tasks`
        (
            id int primary key auto_increment,
            title varchar(255) NOT NULL
        )";
    
    $result = mysqli_query($conn, $sql);
    
    echo mysqli_error($conn);
    // close connection
    mysqli_close($conn);

    var_dump($conn);





?>