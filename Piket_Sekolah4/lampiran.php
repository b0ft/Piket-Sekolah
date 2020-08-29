	<?php
	
	include 'config.php';
	session_start();

	// if ($_SESSION['access'] != 'admin') {
	//   header("location:index.php");

	// }

  if (!isset($_SESSION['admin'])) {
    header('location:index.php');
  }

	if(isset($_SESSION['username']) && isset($_SESSION['kelass'])){
		$user = $_SESSION['username'];	
    $kelas = $_SESSION['kelass'];    
    $nama = $_SESSION['nama'];
	    $query = mysqli_query($con,"SELECT * FROM piket ORDER BY tgl_piket DESC");
	    }


	    
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>
		Piket Sekolah
	</title>
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
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="datasiswa.php">Data Siswa</a>
              <a class="dropdown-item" href="inputsiswa.php">Tambah Siswa</a>              
            </div>
          </li>
      
      <li class="nav-item active">
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

    </ul>
  </div>
</nav>
<br>

  <?php
  
    $filess = "uploads/".$kelas."/Sebelum/*.*";
    $folder1 = "uploads/".$kelas."/Sebelum/";
    $fileglob = glob($filess);  
    $filess2 = "uploads/".$kelas."/Sesudah/*.*";
    $folder2 = "uploads/".$kelas."/Sesudah/";
    $fileglob2 = glob($filess2);

    // foreach (array_combine($fileglob, $fileglob2) as $gmbr1 => $gmbr2) {
    //   echo "<div class='container-fluid'><div class='row'>";      
    //   $a1 = str_replace($folder1, '', $gmbr1);
    //   $a2 = str_replace($folder2, '', $gmbr2);
    //   echo "<div class='col'><h5>".$a1."</h5></div>";
    //   echo "<div class='col'><h5>".$a2."</h5></div></div>";
    //   echo "<div class='row'><div class='col'><img src='".$gmbr1."' class='img-fluid float-left'></div>";
    //   echo "<div class='col'><img src='".$gmbr2."' class='img-fluid float-right'></div></div><br>";
    //   echo "</div>";
    //   // echo $a1;
    //   // echo $a2;
    //   echo $folder1."<br>";
    //   echo $a1."<br>";
    //   echo $gmbr1."<br>";
    //   $a3 = str_replace("(Sebelum)", "" , $a1);
    //   echo $a3."<br>";
    //   $a4 = str_replace($kelas,"", $a3);      
    //   echo $a4."<br>";
    //   $a5 = substr($a4, 0, 11 );
    //   echo $a5."<br>";      
    //   $a6 = date("Y-m-d", strtotime($a5));
    //   echo $a6;

    //   $tesfoto = mysqli_query($con,"SELECT * FROM foto");
      
    //   while ($rowfoto = mysqli_fetch_assoc($tesfoto)) {
    //     echo $rowfoto['tgl_kirim']."<br>";

    //   }
      
      
    // } 
 

    ?>

  
    <div class="container">
          <center><form action="" method="post">
            <h4 class='display-4' >Klik dibawah ini untuk memunculkan tanggal</h4>
            <input  type="text" class="datepicker" placeholder="Klik!" value="" id="pickyDate" name="dob" readonly>
            <input type="submit" name="submit" class="btn btn-outline-dark">
          </form></center>
    </div>

    <?php    
     if (isset($_POST['submit'])) {
      $dob = $_POST['dob'];
     
    
    
    $result = mysqli_query($con,"SELECT * FROM foto WHERE tgl_kirim = '$dob' AND kelas = '$kelas' "); 
    echo "<div class='container-fluid'><div class='row'>";   
    
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) { 

      

        // echo "" . $row['nama'] . ""; 
        // echo "" . $row['tgl_kirim'] . "";
        // echo "<img src='".$row['nama']."'>";
  
      echo "<div class='col'><center><h5>".substr($row['nama'], 23)."</h5></div></div>";
      echo "<div class='row'><div class='col'><center><img src='".$row['nama']."' class='img-fluid'></div></div>";
      echo "</div>";
      }
    }
    else if ($dob == "") {
      echo "<div class='container-fluid'><br><br><br><p class='display-3 text-center'>Pilih tanggal terlebih dahulu untuk memunculkan foto.</p></div>";
    }
    else{
      echo "<div class='container-fluid'><br><br><br><p class='display-3 text-center'>Foto pada tanggal ".$dob." tidak dapat ditemukan.</p></div>";
    }

 }

  ?>

</body>
</html>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );

   $(document).ready(function () {
        $('#pickyDate').datepicker({
            format: "yyyy-mm-dd"
        });
    });

</script>