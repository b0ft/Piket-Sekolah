<?php

	include 'config.php';
	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['kelass'])){
		$user = $_SESSION['username'];
    $kelas = $_SESSION['kelass'];
		$query = mysqli_query($con,"SELECT * FROM siswa where kelas='$kelas' ORDER BY no ASC");

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>
    Piket Sekolah
  </title>
</head>
<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="indexp.php"><img class='img-thumbnail' src="img/smkn24.png" width="30" height="30" alt=''></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="indexp.php">Home <span class="sr-only">(current)</span></a>
      </li>
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item active" href="datasiswa.php">Data Siswa</a>
              <a class="dropdown-item" href="inputsiswa.php">Input Siswa</a>              
            </div>
          </li>
       
      <li class="nav-item">
        <a class="nav-link" href="changepw2.php">Change Password</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link" href="logoutproc.php">Logout</a>
      </li>     
    </ul>
    <form class="form-inline my-2 my-lg-0">      
      <input class="form-control mr-sm-2" type="text" id="myInput" placeholder="Search.." aria-label="Search">      
    </form>
  </div>
</nav>
<form>
<table class="table text-center p-3">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">No</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama</th>
      <th scope="col">Gender</th>
      <th scope="col">Piket</th>
    </tr>
  </thead>
  <tbody>   
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
  <?php echo "</tr>";

}
  ?>
  

  </tbody>
  <select>
  <option>1</option>
  <option>2</option>
</select>
</table>
</form> 

<?php
}else {
	header('location:login.php');
}


?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>