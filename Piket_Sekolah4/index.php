	<?php

	
	session_start();
	include 'config.php';
	$errwarn = "";

	// if ($_SESSION['access'] != 'user') {
	// 	header("location:indexp.php");	
	// 	exit;
	// }
	// else if($_SESSION['access'] == 'user'){
	// 	header("location:index.php");
	// 	exit();
	// }

	$query = "";
	$err = "";
	$err2 = "";

	if (!isset($_SESSION['user'])) {
		$_SESSION['batal'] = header('location:indexp.php');
	}

	  // if($_SESSION['access'] != 'user'){
	 	// header('location:indexp.php');
	  // }

	if(isset($_SESSION['username']) && isset($_SESSION['kelass'])){
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
	    else
	    {
	    	$err = "Tidak ada jadwal piket untuk hari ini.";

	    }


	    
?>

<?php
	
if (isset($_POST['submit'])) {	


$target_dir = "uploads/".$kelas."/Sebelum/";
$base1 = explode(".", $_FILES["sebelumPiket"]["name"]);
$target_file = $target_dir . basename("(Sebelum) ".date('d-m-Y')." ".$kelas.".".end($base1));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$newfilename = round(microtime(true));


$target_dir2 = "uploads/".$kelas."/Sesudah/";
$base2 = explode(".", $_FILES["sesudahPiket"]["name"]);
$target_file2 = $target_dir2 . basename("(Sesudah) ".date('d-m-Y')." ".$kelas.".".end($base2));

$uploadOk2 = 1;
$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
$newfilename2 = round(microtime(true));


// Check if image file is a actual image or fake iconv(in_charset, out_charset, str)mage
    // $check = getimagesize($_FILES["sebelumPiket"]["tmp_name"]);

    // if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else if($check == false) {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }

if ($_FILES['sebelumPiket']['size'] == 0 || $_FILES['sesudahPiket']['size'] == 0) {
	$errwarn = "File tidak dapat ditemukan.";
}



// Check if file already exists
else if (file_exists($target_file) || file_exists($target_file2)) {    
    $errwarn = "File sudah ada.";
    $uploadOk = 0;
}
// Check file size
else if ($_FILES["sebelumPiket"]["size"] > 10000000 || $_FILES['sesudahPiket']['size'] > 10000000) {
    $errwarn = "Ukuran file terlalu besar.";
    $uploadOk = 0;
}
// Allow certain file formats
else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType2 != "jpg" &&
	$imageFileType2 != "png" && $imageFileType2 != "jpeg") {
    $errwarn = "Hanya file JPG, PNG & JPEG yang dapat di unggah.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
else if ($uploadOk == 0 || $uploadOk2 == 0) {
    $errwarn = "Maaf, file belum terunggah.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["sebelumPiket"]["tmp_name"], $target_file) && move_uploaded_file($_FILES['sesudahPiket']['tmp_name'], $target_file2)) {
	$tambahFoto = mysqli_query($con,"INSERT INTO foto(nama,tgl_kirim,kelas) values('$target_file',CURRENT_DATE(),'$kelas')");
	$tambahFoto2 = mysqli_query($con,"INSERT INTO foto(nama,tgl_kirim,kelas) values('$target_file2',CURRENT_DATE(),'$kelas')");    	
        if (isset($_POST['nis'])) {
        	   	foreach ($_POST['nis'] as $nis){
					
				$ss=mysqli_query($con,"SELECT * FROM siswa WHERE nis='$nis'");
				$srow=mysqli_fetch_array($ss);
				$snis = $srow['nis'];
				$sname = $srow['name'];
				$skelas = $srow['kelas'];				
				if($ss == TRUE)
				{
					$tambahPiket = mysqli_query($con,"INSERT INTO piket(nis,nama,kelas,tgl_piket,status) values('$snis','$sname','$skelas',
													CURRENT_DATE(),'1')");					
				}
		
    }
        }     
     } else {
        $errwarn = "Maaf, file tidak terunggah.";
    }    
}
}

$target_dir = "uploads/".$kelas."/Sebelum/";
$filess = "uploads/".$kelas."/Sebelum/(Sebelum) ".date('d-m-Y')."*";
$target_dir2 = "uploads/".$kelas."/Sesudah/";
$filess2 = "uploads/".$kelas."/Sesudah/(Sesudah) ".date('d-m-Y')."*";

foreach (array_combine(glob($filess), glob($filess2)) as $filefound => $filefound2) {
 	if(file_exists($filefound) && file_exists($filefound2) && isset($_SESSION['user'])){
 		$_SESSION['done'] = header('location:done.php');
 	}
}
 
 

	// if(isset($_POST['submit']) && isset($_FILES['sebelumPiket'])){		
	// 	// if{

	// 	// }

	// 		foreach ($_POST['nis'] as $nis){
	// 			echo $data['nis'];				
	// 			$ss=mysqli_query($con,"SELECT * FROM siswa WHERE nis='$nis'");
	// 			$srow=mysqli_fetch_array($ss);
	// 			$snis = $srow['nis'];
	// 			$sname = $srow['name'];
	// 			$skelas = $srow['kelas'];				
	// 			if($ss == TRUE)
	// 			{
	// 				$tambahPiket = mysqli_query($con,"INSERT INTO piket(nis,nama,kelas,tgl_piket,status) values('$snis','$sname','$skelas',
	// 												CURRENT_DATE(),'1')");		
					
	// 				$_SESSION['done'] = header('location:done.php');
					
	// 			}
	// 			// else if($_POST['nis'] == NULL)
	// 			// {
	// 			// 	echo "Gagal menginput data. Centang minimal satu orang.";
	// 			// }
	// 			//$sq=mysqli_query($con, "INSERT INTO piket (nis,name,kelas,tgl_piket,status) values('".$data['nis']."','".$data['name']."'
	// 			//	,'".$data['kelas']."',CURRENT_DATE(),'1'");
	// 			//$srow = mysqli_fetch_array($sq);				
	// 		}


	// 	}
	// 	else if (isset($_POST['submit'])&&empty($_FILES['sebelumPiket'])) {
	// 		echo "Error";
	// 	}

		// $aa=mysqli_query($con,"SELECT * FROM piket WHERE tgl_piket=CURRENT_DATE() AND kelas='$kelas'");
		// $arow=mysqli_num_rows($aa);
		// if ($arow > 0) {
		// 	header('location:done.php');
		// }	

	



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
  </div>
</nav>
<form method="post" id="my_form" enctype="multipart/form-data">
<table class="table text-center p-3">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">No</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Piket</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody id="myTable">		
<?php

	if ($query!="") {
		
	while($data= mysqli_fetch_array($query))
		{
	//$kelas = $data['kelas'];

	echo "<tr>";
	echo "<td>".$data['no']."</td>";
	echo "<td>".$data['nis']."</td>";
	echo "<td>".$data['name']."</td>";
	echo "<td>".$data['gender']."</td>";
	echo "<td>".$data['hari']."</td>";?>
<td><input type='checkbox' name='nis[]'  value="<?php echo $data['nis'];?>"></td>
	<?php echo "</tr>";

		}
	}
	else{
		$err2 = "Data tidak ditemukan";
	}
?>
  </tbody>
</table>

    <center><h5>Masukkan file berupa foto sebelum piket:   </h5>
    <input type="file" name="sebelumPiket" id="sebelumPiket" class="btn btn-primary btn-outline-dark"><br><br>

    <h5>Masukkan file berupa foto sesudah piket:</h5>
    <input type="file" name="sesudahPiket" id="sesudahPiket" class="btn btn-primary btn-outline-dark"></center>    <br>

<button class="btn btn-outline-success my-2 my-sm-0 float-right col-md-4 ml-auto" type="button"  data-toggle="modal" data-target="#exampleModal">Kirim</button><br><br>

<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <input type="submit" name="submit" class="btn btn-primary" name="submit" value="Kirim" data-confirm="modal">
      </div>
    </div>
  </div>
</div>




<font style="color: red; float: right; margin-right: 1%;"><h5><label><i>Centang Siswa Yang Tidak Melaksanakan Piket.</i></label></h5></font>

<?php
	echo "<h1 class='display-4 text-danger'>".$errwarn."<br>".$err."<br>".$err2."</h1>";
?>

</form>	

<?php
}
// }else {
// 	header('location:login.php');
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


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</html>