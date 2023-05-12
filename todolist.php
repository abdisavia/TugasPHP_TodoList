<?php
session_start();

if(!isset($_SESSION["id"])){
    header("Location:Login.php");
}
require "connectDB.php";

if(isset($_POST["add"])){
    $todo = $_POST["todo"];
    $checked = false;
    $idAkun = $_SESSION['id'];
    $result = mysqli_query($conn,"INSERT INTO list (LISTID,todo,AKUNID) VALUES('','$todo',$idAkun)");

    if($result === false){
        echo "error exception : " . mysqli_error($conn);
    }
    echo "<script>
            alert('todolist berhasil ditambahkan');
        </script>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>To Do List</title>
    <style>
        body{

            background-image:url("img/loginBackground.jpg");
            background-position: center;
            color:#F1F6F9;
            min-height:100vh;
        }
        .container{
            min-height: 100vh;
        }

        .rounded-form{
            border-radius:50px;
            background-color: rgba(57, 72, 103,0.1);
            width:70%;
            
        }

        .text_Todo{
            width:300px;
            border-radius:25px 5px 5px 25px;
            border:none;
            height:37px;
            
        }

        
        
        </style>
</head>
<body>
    <div class="container">
        
        <h1 class="mt-3 mb-5 fw-bold text-center">To Do List</h1>
        <form action="" method="post" class="d-flex justify-content-center align-items-center gap-2">
            <div class="row"></div>
            <input type='text' name="todo" class="text_Todo ps-3 text-end" placeholder="Masukkan List">
            <button type="submit" name="add" class="btn btn-primary ">add</button>
        </form>
        <div class="d-flex justify-content-center position-relative mt-4">
            <div class="w-50" >
                <table class="table table-striped">
                    <tr>
                        <th>No.</th>
                            <th>To Do</th>
                            <th>Done</th>
                        </tr>
                <?php
                $list = mysqli_query($conn, "SELECT * FROM list");
                $idAkun = $_SESSION['id'];
                $index = 1;
                if($list===false){
                    echo"Error Exception : ".mysqli_error($conn);
                }
                if(mysqli_num_rows($list) > 0){?>
                <?php while($row = mysqli_fetch_assoc($list)){ ?>
                    <?php      if($row['AKUNID'] == $idAkun){ ?>
                        <tr>
                            <td>
                                    <?=$index?>
                                </td>
                                <td>
                                    <?= $row["todo"]; ?>
                                    </td>
                                    <td><a href="delete.php?id=<?=$row["LISTID"];?>">delete</a></td>
                                  </tr>
                                  <?php }?>
                     <?php }
                     $index += 1;?>
                <?php }?>
            </table>
                    
            
        </div>  
        
    </div>         
    <br>
    <a href="logout.php" class="fixed-bottom me-5 pe-5 mb-3 d-flex justify-content-end"><img src="img/logout.png" alt="" width="70px" height="70px"></a> 
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>