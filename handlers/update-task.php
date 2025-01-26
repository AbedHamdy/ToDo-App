<?php 

    session_start();
    require_once("../helper/helper.php");

    $errors = [];
    
    $idFact = $_SESSION["id"];    

    $id = $_GET["id"];

    if($idFact != $id)
    {
        $errors[] = "Don't play with URL";
        $_SESSION["errors"] = $errors;
        redirect("../update.php?id=$idFact");
        exit;
    }

    
    if(CheckRequestMethod("POST"))
    {
        $title = sanitizeInput($_POST["title"]);
        

        if(requireVal($title))
        {
            $errors[] = "The title is required";
            $_SESSION["errors"] = $errors; 
            redirect("../update.php?id=$id");
            exit;
        }
    
        $conn = ConnectDatabase("todoapp");
        $sql = "UPDATE `tasks` SET `title` = '$title' WHERE `id` = '$id' ";
        $result = mysqli_query( $conn,$sql);

        if($result)
        {
            $_SESSION["success"] = "Data updated successfully";
            redirect("../index.php");
            die;
        }
        else 
        {
            $errors[] = "error in connection";
            $_SESSION["errors"] = $errors;
            redirect("../update.php?id=$id");
            die;
        }
    }
    else 
    {
        if(!isset($_SESSION["errors"]))
        {
            $errors[] = "Don't play with request";
            $_SESSION["errors"] = $errors;
        }
        redirect("../update.php?id=$id");
        exit;
    }
?>