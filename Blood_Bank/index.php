<?php
session_start();
$rec_id = '';
if(!isset($_SESSION['name'])){
	$name = "you are logged out";
}else{
	$name = $_SESSION['name'];
	$rec_id = $_SESSION['r_id'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'link.php' ?>
</head>
<body>
	<div class="container">
		<div class="btn-group mt-4">
			<?php
			if($rec_id === ''){
			?>
		  <button type="button" class="btn btn-primary" onClick="window.location='login.php';">Login</button>
		  <?php
			}else{
		  ?>
		  <a href="logout.php">Logout</a>
		<?php
		}
		?>
		</div>
	<div class="center-div">
		<h4 class="text-center"><?php echo $name ?></h4>
		<br>
		<div class="table-respnsive">
			<table class="table table-hover table-bordered">
				<thead class="bg-dark text-white">
				  <tr>
				    <th>Sr no.</th>
				    <th>Hospital Name</th>
				    <th>Category</th>
				    <th>Available Blood</th>
				    <th>Last Update</th>
				    <th>Request Sample</th>
				  </tr>
				</thead>
				<tbody>
			<?php 

				include 'connection.php';

				$selectquery = "select * from hospital";

				$query = mysqli_query($con,$selectquery);

				$i = 0;

				while($res = mysqli_fetch_array($query)){

			?>
				  <tr>
				    <td><?php echo ++$i; ?></td>
				    <td><?php echo $res['hos_name']; ?></td>
				    <td><?php echo $res['category']; ?></td>
				    <td>
				    <?php
				    	$vvquery = " select * from blood_info where h_id='".$res['h_id']."' order by time desc";

						$vquery = mysqli_query($con,$vvquery);

						
						$array = mysqli_fetch_array($vquery);

						$time = $array['time'];
						$blood = $array['blood_type'];

						while($array = mysqli_fetch_array($vquery)){
							$blood .=' , ' . $array['blood_type'];
						}
						echo $blood;
						?>
					</td>
				    <td><?php echo $time; ?></td>
				    <td>
				    <?php
				    	$req_query = " select * from request where hos_id='".$res['h_id']."' and rec_id='$rec_id' ";

						$reqquery = mysqli_query($con,$req_query);

						$reqcount = mysqli_num_rows($reqquery);

						if($reqcount === 0){
				    	?>
				    	<form action="" method="POST">
				    		<input type="text" name="hos_id" value="<?php echo $res['h_id']; ?>" hidden>
				    		<button type="submit" name="request" class="btn btn-primary">Request</button>
				    	</form>
				    	<?php
				    	}else{
				    		?>
				    		<p>Requested</p>
				    		<?php
				    	}
				    	?>
				    </td>
				  </tr>
				  <?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	</div>

<!-- sending request sample -->
<?php
if(isset($_POST['request'])){
	if(!isset($_SESSION['name'])){
		header('location:login.php');
	}else{
		// check blood of reciver is present at hospital
		$hos_id = $_POST['hos_id'];
		$blood_type = $_SESSION['blood'];

		$b_query = " select * from blood_info where blood_type='$blood_type' and h_id='$hos_id' ";

		$blood_query = mysqli_query($con,$b_query);

		$b_count = mysqli_num_rows($blood_query);

		if($b_count > 0){
			
			$insert = "insert into request(hos_id,blood_type,rec_id) values('$hos_id','$blood_type','$rec_id')";
	    	$insert_query = mysqli_query($con,$insert);

			?>
			<script>alert("Request sent successfully!!");</script>
			<?php
			header('location:index.php');

		}else{

				?>
			<script>alert("Requested Blood group is not present!!");</script>
			<?php
		}

	}
}
?>
</body>
</html>