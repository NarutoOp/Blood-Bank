<?php
session_start();
if(!isset($_SESSION['h_id'])){
  header('location:../login.php');
}
include '../link.php'; 
include '../connection.php';

if(isset($_POST['submit'])){
  $h_id = $_SESSION['h_id'];
  $blood_type = mysqli_real_escape_string($con,$_POST['blood_type']);

  $vquery = " select * from blood_info where h_id='$h_id' and blood_type='$blood_type' ";

  $valquery = mysqli_query($con,$vquery);

  $valcount = mysqli_num_rows($valquery);

  if($valcount>0){
    ?>
      <script>alert("blood type already exists!!");</script>
    <?php
  }else{

      $insertquery = "insert into blood_info(h_id,blood_type) values('$h_id','$blood_type')";

      $re = mysqli_query($con,$insertquery);

      if($re){
        ?>
        <script>alert("Data inserted");</script>
        <?php
      }else{
        echo mysqli_error($con);
        ?>
        <script>alert("Not inserted");</script>
        <?php
      }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link href="../css/login.css" rel="stylesheet"></link>
</head>
<body>
<div class="wrapper">
  <div class="btn-group mt-4">
    <button type="button" class="btn btn-primary" onClick="window.location='../index.php';">Home</button>
    <button type="button" class="btn btn-danger" onClick="window.location='view_request.php';">Request</button>
  </div>
  <br>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="formContent" class="bg-info">
  <br>
  <h3 class="text-light font-weight-bold">Add Blood Info</h3>
  <br>
  <div class="form-row">
    <div class="col-md-3"></div>
    <div class="form-group col-md-6">
      <select name="blood_type" class="custom-select" id="blood_type">
        <option selected value="Null">Not available</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
      </select>
    </div>
    <div class="col-md-3"></div>
  </div>
  <div id="formFooter">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>

