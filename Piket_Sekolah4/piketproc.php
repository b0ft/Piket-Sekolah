<?php
	include "config.php";
	session_start();

	if(isset($_POST['submit'])){
		foreach ($_POST['id_piket'] as $id){
			$sq=mysqli_query($con, "SELECT * FROM siswa");
			$srow = mysqli_fetch_array($sq);
			echo $srow['name'];			
		}
		




	}





?>

