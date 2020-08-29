	<?php

	
	session_start();
	include 'config.php';

	// if ($_SESSION['access'] != 'user') {
	// 	header("location:indexp.php");	
	// 	exit;
	// }
	// else if($_SESSION['access'] == 'user'){
	// 	header("location:index.php");
	// 	exit();
	// }


	if(isset($_SESSION['username'])&& isset($_SESSION['kelass'])){
		$user = $_SESSION['username'];
		$kelas = $_SESSION['kelass'];
		$nama = $_SESSION['nama'];
	    if (date('D')=='Mon') {
	      $query = mysqli_query($con,"SELECT * FROM siswa where hari='senin' and kelas='$kelas' ORDER BY no ASC");
	      $haridb="senin";
	    }

	    elseif (date('D')=='Tue') {
	      $query = mysqli_query($con,"SELECT * FROM siswa where hari='selasa' and kelas='$kelas' ORDER BY no ASC");
	      $haridb="selasa";
	    }

	    elseif (date('D')=='Wed') {
	      $query = mysqli_query($con,"SELECT * FROM siswa where hari='rabu' and kelas='$kelas' ORDER BY no ASC");
	      $haridb="rabu";
	    }

	    elseif (date('D')=='Thu') {
	      $query = mysqli_query($con,"SELECT * FROM siswa where hari='kamis' and kelas='$kelas' ORDER BY no ASC");
	      $haridb="kamis";
	    }
	    
	    elseif (date('D')=='Fri') {
	      $query = mysqli_query($con,"SELECT * FROM siswa where hari='jumat' and kelas='$kelas' ORDER BY no ASC");
	      $haridb="jumat";
	    }


	    
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
	<title>
		Piket Sekolah
	</title>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><img class='img-thumbnail' src="img/smkn24.png" width="30" height="30" alt=''></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jadwalpiket.php">Jadwal Piket</a>
      </li>
  </ul>
<ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nama." (Anggota Piket ".$kelas.")"; ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="changepw1.php">Ganti Password</a>     
            <a class="dropdown-item" href="logoutproc.php">Keluar</a>
            </div>
          </li>
      </ul>    
    </ul>
  </div>
</nav>	

<br><br><br><br>
<center><h1 class="display-1">Anda sudah mengirim data.</h1></center>
<?php
}else {
	header('location:login.php');
}


?>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</html>