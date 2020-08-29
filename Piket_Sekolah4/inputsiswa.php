<?php

	include 'config.php';
	session_start();

  if (!isset($_SESSION['admin'])) {
    header('location:index.php');
  }

	if(isset($_SESSION['username']) && isset($_SESSION['kelass'])){
		$user = $_SESSION['username'];
    $kelas = $_SESSION['kelass'];
    $nama = $_SESSION['nama'];
		$query = mysqli_query($con,"SELECT * FROM siswa ORDER BY kelas, no");


  
if(isset($_POST['submit'])){
    $no = $_POST['no'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $gender = $_POST['genderr'];
    $kelas = $_POST['kelas'];
    $piket = $_POST['harii'];
    $klsdb = mysqli_query($con,"SELECT * FROM kelas WHERE kd_kelas = '$kelas'");
    $rowklsdb = mysqli_num_rows($klsdb);        
      if($rowklsdb > 0){
        $updt = mysqli_query($con,"INSERT INTO siswa(no,nis,name,gender,hari,kelas) VALUES('$no','$nis','$nama','$gender','$piket','$kelas')");
          header('location:datasiswa.php');
      }
      else{        
        echo $err="<center><h6 class='display-6 text-danger'>Incorrect Class</h6></center>";
      }


  }

?>


<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    #myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
</style>
  </style>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>
    Piket Sekolah
  </title>
    <style type="text/css">
    #back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
}
  input {
    margin-right: : 50%;
  }
  </style>
      <link href="css/signin2.css" rel="stylesheet">
</head>
<body>
  
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
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="datasiswa.php">Data Siswa</a>
              <a class="dropdown-item active" href="inputsiswa.php">Tambah Siswa</a>              
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
              <a class="dropdown-item" href="changepw2.php">Ganti Password</a>
            <a class="dropdown-item" href="logoutproc.php">Keluar</a>
            </div>
          </li>
      </ul>
    
  </div>
</nav>

    <form class="form-signin" method="post"><form method="post">
<div class="form-signin">
<center>
  <h4 class="display-4">Tambah Data</h4><br>
      <label for="inputNo" class="sr-only">No</label>
      <input type="text" name="no" id="inputNo" class="form-control"  placeholder="No" value=""><br>
      <label for="inputNIS" class="sr-only">NIS</label>
      <input type="text" name="nis" id="inputNis" class="form-control"  placeholder="NIS" value=""><br>
      <label for="inputNama" class="sr-only">Nama</label>
      <input type="text" name="nama" id="inputNama" class="form-control" placeholder="Nama" value="" required ><br>
      <label for="inputGender" class="sr-only">Gender</label>

      <select name="genderr" class="custom-select">
          <?php
              if ($gender == 'L') {
                  $a = 'P';

              }
              else{
                $a = 'L';
              }

            ?>
        <option value='L'>L</option>
        <option value='P'>P</option>
      </select><br><br>
      <label for="inputKelas" class="sr-only">Kelas</label>
      <select name="kelas" id='kelas_id' class="custom-select">
        <?php
        $querykls = mysqli_query($con,"SELECT * FROM kelas");
        foreach ($querykls as $datakls) {
          $klss = $datakls['kd_kelas'];
        
      ?>
        <option value='<?php echo $klss; ?>'><?php echo $klss; ?></option>
        <?php
          }
        ?>
        </select><br><br>
      
      <select name="harii" class="custom-select">
        <option value='Senin'>Senin</option>
        <option value='Selasa'>Selasa</option>
        <option value='Rabu'>Rabu</option>
        <option value='Kamis'>Kamis</option>
        <option value='Jumat'>Jumat</option>       
      </select>


<br><br>
<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Kirim</button> 
    </form>



<?php
}
// // else {
// // 	header('location:login.php');
// }


?>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$('#myInput').keypress(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
      $('#kelas_id').val('<?php echo $kelasss ?>');
  })
</script>