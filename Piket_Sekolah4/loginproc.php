<?php
include "config.php";
session_start();

	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' and password = '$password'");
		$gettype = mysqli_fetch_assoc($query);

		echo $gettype['access'];
		$check = mysqli_num_rows($query);
		
		if ($check > 0) {
			if($gettype['access']=='user'){
				$_SESSION['access'] = 'user';
				$_SESSION['username'] = $gettype['username'];
				$_SESSION['user'] = '1';
				$_SESSION['nama'] = $gettype['name'];
				header('location:index.php');
				

			}
			else if ($gettype['access']=='admin') {
				$_SESSION['access']== 'admin';
				$_SESSION['username'] = $gettype['username'];
				$_SESSION['admin'] = '1';
				$_SESSION['nama'] = $gettype['name'];
				header('location:indexp.php');
				

			}



			foreach ($query as $data) {
				
				$_SESSION['kelass'] = $data['kelas'];
			}
		}
		else{			
			header("location: logingagal.php");
		}

	}


?>
