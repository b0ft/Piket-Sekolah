<?php
  require 'config.php';
  session_start();

  if (!isset($_SESSION['admin'])) {
    header('location:index.php');
  }



  if(isset($_POST['oldpass'])){
    $username = $_SESSION['username'];
    $nama = $_SESSION['nama'];
    $kelas = $_SESSION['kelass']; 
  $oldPass = md5($_POST['oldpass']);
  $newpass = md5($_POST['newpass']);
  $confirm = md5($_POST['newpass1']);

  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$oldPass'";

  $result = mysqli_query($con,$query);
  $finalResult = mysqli_fetch_assoc($result);

  if($finalResult){
    if($newpass == $confirm){
      $query = "UPDATE users set password = '$newpass' WHERE username = '$username'";
      if(mysqli_query($con,$query)){        
        header("location:login.php");
      }
    }else{
      echo "<script>alert('Password Tidak Sesuai!')</script>";
    }
  }else{
    echo "<script>alert('Password Lama Tidak Cocok!')</script>";
  }
  
  }
if(isset($_SESSION['username']) && isset($_SESSION['kelass'])){
    $user = $_SESSION['username'];     
    $kelas = $_SESSION['kelass']; 
    $nama = $_SESSION['nama'];
?>

<!doctype html>
<html lang="en">
  <head>
  <script>
        function validate(){

    if(!document.getElementById("password").value==document.getElementById("confirm_password").value)alert("Passwords do no match");
    return document.getElementById("password").value==document.getElementById("confirm_password").value;
   return false;
    }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Halaman Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signin2.css" rel="stylesheet">

  </head>

  <body class="text-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="indexp.php"><img class='img-thumbnail' src="img/smkn24.png" width="30" height="30" alt=''></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="indexp.php">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="datasiswa.php">Data Siswa</a>
              <a class="dropdown-item" href="inputsiswa.php">Tambah Siswa</a>              
            </div>
          </li>
      <li class="nav-item">
        <a class="nav-link" href="lampiran.php">Lampiran</a>
      </li>
    </ul>
    <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nama." (Wali Kelas ".$kelas.")"; ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item active" href="changepw2.php">Ganti Password</a>
            <a class="dropdown-item" href="logoutproc.php">Keluar</a>

            </div>
          </li>
      </ul>
<?php
}
?>
    </ul>
  </div>
</nav>
    <!-- Custom styles for this template -->

    <form class="form-signin" method="post" action="">
     
      <h1 class="h3 mb-3 font-weight-normal">Ganti Password</h1>

      
      <label for="inputPassword" name="password" class="sr-only">Old Password</label>
      <input type="password" name="oldpass" id="inputPassword" class="form-control" placeholder="Password Sekarang" required>
      


      
      <label for="inputPassword" name="password" class="sr-only">New Password</label>
      <input type="password" name="newpass" id="inputPassword" class="form-control" placeholder="Password Baru" required>
      


      
      <label for="inputPassword" name="password" class="sr-only">Confirm Password</label>
      <input type="password" name="newpass1" id="inputPassword" class="form-control" placeholder="Konfirmasi Password" required>
      <div class="checkbox mb-3">
        <label>
        
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Kirim</button>
      
      
    </form>
  </body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>