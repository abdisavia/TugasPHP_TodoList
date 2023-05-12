<?php 
require "connectDB.php";

if(isset($_GET["id"])){
    $listid = $_GET["id"];
    $result = mysqli_query($conn,"DELETE FROM list WHERE LISTID = $listid");
    if($result === true){
        echo "<script>
                alert('To do list berhasil dihapus');
              </script>";
        header("Location:todoList.php");
    }
}


?>