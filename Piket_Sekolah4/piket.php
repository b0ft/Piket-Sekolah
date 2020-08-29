<?php
   define("HOST", "localhost"); //Define a hostname
   define("USER", "root");      //Define a username
   define("PASSWORD", "");		//Define a password
   define("DB", "piket");  //Define a database

   $con = mysqli_connect(HOST, USER, PASSWORD, DB) OR DIE("Error in  connecting DB : " . mysqli_connect_error());  //Database connection
	
	if((!empty($_POST['startDate'])&&(!empty($_POST['endDate'])))) {	// Check whether the date is empty			
		$startDate = date('Y-m-d',strtotime($_POST['startDate']));
		$endDate = date('Y-m-d',strtotime($_POST['endDate']));
		
		$result = mysqli_query($con,'SELECT * from piket where tgl_piket between  "'.$startDate.'" and "'.$endDate.'"');  // Execute the query
		$num_rows = mysqli_num_rows($result); //Check whether the result is 0 or greater than 0.
		if($num_rows > 0){
			$str = '<div class="media">';
    		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){  //Fetching the data from the database
				$str.='<div class="well">
				<div class="row">
				<div class="col-sm-8">
				<a class="pull-left" href="#">
				<img class="media-object"  alt="64x64" style="height: 80px;" src="flag/'.strtolower($row['countries_iso_code']).'.png">
					</a><div class="media-body">
					<p id="cname"><strong>'.$row['countries_name'].'</strong></p> 
					<p><strong>ISO Code :</strong>'.$row['countries_iso_code'].'</p>
					<p><strong>ISD Code :</strong>'.$row['countries_isd_code'].'</p>
					
					</div></div>
					<div class="col-sm-4"><p class="pull-right"><strong>Created Date: </strong>'.$row['date'].'</p></div>
					</div></div><hr>';
			}
			$str.= '</div>';
			echo $str;
		}else{
			echo "<p class='alert alert-warning'>No record found</p>";	
		}
	
	} else{
		echo "<p class='alert alert-warning'>No record found</p>";
	}
?>
