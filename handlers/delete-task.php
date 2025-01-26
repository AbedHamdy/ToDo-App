<?php 

    session_start();
    require_once("../helper/helper.php");

    $errors = [];

    if(CheckRequestMethod("GET"))
    {
        $id = sanitizeInput($_GET["id"]);

        if(requireVal($id))
        {
            $errors[] = "Don't play in front end and the input is required";
        }

        if(!checkVal($id))
        {
            $errors[] = "Don't play in front end and id must be numbers";
        }
        
        if(!empty($errors))
        {
            $_SESSION['errors'] = $errors;
            redirect("../index.php");
            exit;
        }
        else 
        {
            $conn = ConnectDatabase("todoapp");
            
            $sql = "SELECT * FROM `tasks` WHERE `id` = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            
            if(!$row)
            {
                $errors[] = "Don't play in front end and the id is not exist";
                $_SESSION['errors'] = $errors;
            }
            else 
            {
                $sql = "DELETE FROM `tasks` WHERE `id` = $id";
                mysqli_query($conn, $sql);
        
                if(mysqli_affected_rows($conn) == 1)
                {
                    $_SESSION["success"] = "Data deleted successfully";
                }
            }        
            redirect("../index.php");
        }


    }



?>