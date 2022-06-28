<?php
session_start();
if(!isset($_SESSION['h_id'])){
	header('location:../login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include '../link.php' ?>
</head>
<body>
	<div class="container">
	<div class="btn-group mt-4">
	  <button type="button" class="btn btn-primary" onClick="window.location='../index.php';">Home</button>
	  <button type="button" class="btn btn-danger" onClick="window.location='add_blood_info.php';">Add Blood</button>
	</div>
	<div class="center-div mt-3">
		<h2 class="text-center">Blood Sample Requests</h2>
		<a href="logout.php">Logout</a>
		<div class="table-respnsive">
			<table class="table table-hover table-bordered">
				<thead class="bg-dark text-white">
				  <tr>
				    <th>Sr no.</th>
				    <th>Reciever Name</th>
				    <th>Blood Group</th>
				  </tr>
				</thead>
				<tbody>
			<?php 

				include '../connection.php';
				$h_id = $_SESSION['h_id'];

				$selectquery = "select * from request inner join reciever on request.rec_id = reciever.r_id where hos_id=$h_id ";

				$query = mysqli_query($con,$selectquery);

    			if($query){
					$i = 0;
					while($res = mysqli_fetch_array($query)){
				?>
					  <tr>
					    <td><?php echo ++$i; ?></td>
					    <td><?php echo $res['name']; ?></td>
					    <td><?php echo $res['blood_type']; ?></td>

					  </tr>
					  <?php
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
	</div>



</body>
</html>