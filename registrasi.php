<?php
session_start();
if(isset($_SESSION["id"])){
    header("Location:todolist.php");
}
require "connectDB.php";

$conn = $conn;

if(isset($_POST['register'])){
    if(registrasi($_POST)>0){
        echo "<script>
        alert('Selamat Akun Berhasil Dibuat');
        </script>";
    }
}else if(isset($_POST['Login'])){
    header("Location:Login.php");
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);
    
    if($username === ""){
        echo "<script>
                alert('Harap masukkan username');
                window.location.href = 'registrasi.php';
            </script>";
        return false;
    }

    if($password === ""){
        echo "<script>
        alert('Harap masukkan password');
        window.location.href = 'registrasi.php';
            </script>";
        return false;
    }

    $result = mysqli_query($conn,"SELECT username FROM akun WHERE username = '$username'");
    
    if(mysqli_num_rows($result)>0){
        echo"<script>
                alert('Username sudah ada');
                window.location.href = 'registrasi.php';
            </script>";
        return false;
    }

    if($password !== $password2){
        echo"<script>
            alert('konfirmasi password tidak sesuai!')
            window.location.href = 'registrasi.php';
            </script>";
            return false;
        }
        
    $password = password_hash($password,PASSWORD_DEFAULT);
    
    $result = mysqli_query($conn,"INSERT INTO akun VALUES('$username','$password','')");
    if($result === false){
        echo "error executing query : ". mysqli_error($conn);
    }
    
    header("Location:Login.php");
    
    return mysqli_affected_rows($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registrasi</title>
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
            <h1 class="mb-3 text-center text-white">Registrasi</h1>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label text-white">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username"> 
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password2">
            </div>
            <button type="submit" class="btn btn-Login px-4" name="register">Submit</button>
            <button type="submit" class="btn btn-Login px-4" name="Login">sudah punya akun</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

