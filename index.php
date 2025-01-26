<?php 
    session_start(); 
    require_once("./helper/helper.php");

    $conn = ConnectDatabase("todoapp");

    $sql = "SELECT * FROM `tasks`";
    $result = mysqli_query($conn , $sql);
    
?>


<?php require_once("./inc/header.php"); ?>


<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <form action="./handlers/store-task.php" method="POST" class="form border p-2 my-5">
                <?php if(isset($_SESSION["success"])) : ?>
                    <div class="alert alert-success text-center">
                        <?= $_SESSION["success"]; ?>
                    </div>
                <?php 
                    endif; 
                    unset($_SESSION["success"]);
                ?>
                <?php 
                    if(isset($_SESSION["errors"])) : 
                        foreach($_SESSION["errors"] as $error) :
                ?>
                            <div class="alert alert-danger text-center">
                            <?= $error; ?>
                </div>
                <?php 
                        endforeach;
                    endif; 
                    unset($_SESSION["errors"]);
                ?>
                <input type="text" name="title" class="form-control my-3 border border-success" placeholder="add new todo">
                <input type="submit" value="Add" class="form-control btn btn-primary my-3 " placeholder="add new todo">
            </form>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $count = 1;
                        while($row = mysqli_fetch_assoc($result)) : 
                    ?>
                        <tr>
                            <td><?= $count++; ?></td>
                            <td><?= $row["title"]; ?></td>
                            <td>
                                <a href="./handlers/delete-task.php?id=<?= $row["id"]; ?>" class="btn btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                <a href="./update.php?id=<?= $row["id"]; ?>" class="btn btn-info">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<?php require_once("./inc/footer.php"); ?>