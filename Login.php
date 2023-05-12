<?php 
session_start();
if(isset($_SESSION["id"])){
    header("Location:todolist.php");
}
require "connectDB.php";

if(isset($_POST['login'])){
    if($_POST['username'] === ""){
        echo "<script>
        alert('Harap masukkan username terlebih dahulu');
        window.location.href = 'Login.php';
        </script>";
        return false;
    }
    
    if($_POST['password'] === ""){
        echo "<script>
        alert('Hapar masukkan password terlebih dahulu');
        window.location.href = 'Login.php';
        </script>";
        return false;
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn,"SELECT * FROM akun WHERE username = '$username'");
    if($result === false){
        echo"error execute: " . mysqli_error($conn);
    }
    

    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            echo "<script>
            alert('login Berhasil');
            </script>";
            
            $_SESSION["id"] = $row['id'];
            header("Location:todolist.php");
            return false;
        }else{
            echo "<script>
            alert('password salah');
            window.location.href = 'Login.php';
            </script>";
            return false;
        }
    }else{
        echo "<script>
        alert('Username tidak ditemukan');
        window.location.href = 'Login.php';
        </script>";
        return false;
    }
    
}
else if (isset($_POST['regis'])){
    header("Location:registrasi.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
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
            width:50%;
            
        }

        .btn-Login{
            background-color: #F1F6F9;
            border-radius: 50px;
            font-weight: 500;
            color: black;
        }
        .btn-Login:hover{
            background-color: #9BA4B5;
            color:white;
        }

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <form class=" m-auto p-5 rounded-form" action="" method="post">
            <h1 class="mb-3 text-center text-white">LOGIN</h1>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label text-white">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
              <div id="emailHelp" class="form-text text-white">We'll never share your username with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-Login px-4" name="login">Login</button>
            <button type="submit"  class="btn btn-Login px-4" name="regis">Registrasi</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
