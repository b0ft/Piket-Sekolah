<?php

	include 'config.php';
	session_start();

  if (!isset($_SESSION['user'])) {
    header('location:indexp.php');
  }

	if(isset($_SESSION['username']) && isset($_SESSION['kelass'])){
		$user = $_SESSION['username'];
    $kelas = $_SESSION['kelass'];
    $nama = $_SESSION['nama'];
		$query = mysqli_query($con,"SELECT * FROM siswa where kelas='$kelas' ORDER BY no ASC");

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">  
  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>
    Piket Sekolah
  </title>

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
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
  width: 5%;
}

#myBtn:hover {
  background-color: #555;
}
</style>
</head>
<body>  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><img class='img-thumbnail' src="img/smkn24.png" width="30" height="30" alt=''></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
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
<br>
<div class="container-fluid">
<form>
<table class="table text-center table-bordered p-3 table-hover" id="table_id">
  <thead>
    <tr>
      
      <th scope="col">No</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Piket</th>
 
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
  echo "<td>".$data['hari']."</td>";  ?>
  <?php echo "</tr>";

}
  ?>
  

  </tbody>
</table>
</form> 
</div>

<?php
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
</script>