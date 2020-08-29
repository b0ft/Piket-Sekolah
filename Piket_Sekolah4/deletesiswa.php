<?php  

	include 'config.php';
    
    $nis = $_GET['nis'];
  	
    $hps = mysqli_query($con,"DELETE FROM siswa WHERE nis = $nis");
    header('location:datasiswa.php');
?>