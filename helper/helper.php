<?php 

    function ConnectDatabase($database)
    {
        $conn = mysqli_connect("localhost" , "root" , "" , $database);
    
        if(!$conn)
        {
            return "Error connecting" . mysqli_connect_error();
        }
        return $conn;
    }

    function CheckRequestMethod($method)
    {
        if($_SERVER["REQUEST_METHOD"] == $method)
        {
            return true;
        }
    }

    function sanitizeInput($input)
    {
        return trim(htmlspecialchars(htmlentities($input)));
    }

    function requireVal($input)
    {
        if(empty($input))
        {
            return true;
        }
        return false;
    }

    function checkVal($input)
    {
        if(is_numeric($input))
        {
            return true;
        }
        return false;
    }

    function redirect($path)
    {
        header("Location: $path");
    }






















?>