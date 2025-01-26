<?php 

    session_start();
    require_once("../helper/helper.php");

    $conn = ConnectDatabase("todoapp");

    $errors = [];

    if(CheckRequestMethod("POST"))
    {
        $title = sanitizeInput($_POST["title"]);
        
        if(requireVal($title))
        {
            $errors[] = "Title is required";
            $_SESSION["errors"] = $errors;
            redirect("../index.php");
            exit;
        }
        
        $sql = "INSERT INTO `tasks` (`title`) VALUES ('$title')";
        $result = mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn) == 1)
        {
            $_SESSION["success"] = "Data inserted successfully";
        }
        redirect("../index.php");
    }
    else 
    {
        $errors[] = "Don't play with request";
        $_SESSION["errors"] = $errors;
        redirect("../index.php");
    }
    // var_dump($_SERVER["REQUEST_METHOD"]);
    



















?>