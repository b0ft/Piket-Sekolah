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

      <li class="nav-item">
        <a class="nav-link" href="changepw1.php">Ganti Password</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="logoutproc.php">Keluar</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" id="myInput" placeholder="Cari.." aria-label="Search">      
    </form>
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
  ?>
	

  </tbody>
</table>

    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" multiple><br><br>
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
	if(isset($_POST['submit']) && isset($_FILES['fileToUpload'])){		
		// if{

		// }

			foreach ($_POST['nis'] as $nis){
				echo $data['nis'];				
				$ss=mysqli_query($con,"SELECT * FROM siswa WHERE nis='$nis'");
				$srow=mysqli_fetch_array($ss);
				$snis = $srow['nis'];
				$sname = $srow['name'];
				$skelas = $srow['kelas'];				
				if($ss == TRUE)
				{
					$tambahPiket = mysqli_query($con,"INSERT INTO piket(nis,nama,kelas,tgl_piket,status) values('$snis','$sname','$skelas',
													CURRENT_DATE(),'1')");		
					
					$_SESSION['done'] = header('location:done.php');
					
				}
				// else if($_POST['nis'] == NULL)
				// {
				// 	echo "Gagal menginput data. Centang minimal satu orang.";
				// }
				//$sq=mysqli_query($con, "INSERT INTO piket (nis,name,kelas,tgl_piket,status) values('".$data['nis']."','".$data['name']."'
				//	,'".$data['kelas']."',CURRENT_DATE(),'1'");
				//$srow = mysqli_fetch_array($sq);				
			}

$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

		}
		else if (isset($_POST['submit'])&&empty($_FILES['fileToUpload'])) {
			echo "Error";
		}

		$aa=mysqli_query($con,"SELECT * FROM piket WHERE tgl_piket=CURRENT_DATE() AND kelas='$kelas'");
		$arow=mysqli_num_rows($aa);
		if ($arow > 0) {
			header('location:done.php');
		}	

	

?>


</form>	
<?php
}else {
	header('location:login.php');
}


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