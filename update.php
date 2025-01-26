<?php 
    session_start();
    require_once("./helper/helper.php");

    $conn = ConnectDatabase("todoapp");

    $id = $_GET["id"];
    $sql = "SELECT * FROM `tasks`  WHERE `id` = '$id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(!$row){
        $errors[] = "data not exists !";
        $_SESSION['errors'] = $errors;
        redirect("./update.php?id=$id");
        exit;
    }

?>
<?php require_once("./inc/header.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form action="./handlers/update-task.php?id=<?= $_GET["id"]; ?>" method="POST" class="form border p-2 my-5">
                    <?php 
                        if(isset($_SESSION['errors'])): 
                            foreach($_SESSION['errors'] as $error): 
                    ?>
                                <div class="alert alert-danger text-center">
                                    <?= $error; ?>
                                </div>
                    <?php
                            endforeach;
                        unset($_SESSION['errors']); 
                        endif; 
                    ?>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>"  class="form-control my-3 border border-success" placeholder="add new todo">
                    <input type="submit" value="Save"  class="form-control btn btn-primary my-3 " placeholder="add new todo">
                </form>
            </div>
        
        </div>
    </div>

<?php require_once("./inc/footer.php"); ?>