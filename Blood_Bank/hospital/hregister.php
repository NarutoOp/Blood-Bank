<?php
session_start();

include '../link.php'; 
include '../connection.php';

if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($con,$_POST['username']);
  $hos_name = mysqli_real_escape_string($con,$_POST['hos_name']);
  $city = mysqli_real_escape_string($con,$_POST['city']);
  $category = mysqli_real_escape_string($con,$_POST['category']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

  $pass = password_hash($password, PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

  $valquery = " select * from hospital where username='$username' and city='$city' ";

  $valquery = mysqli_query($con,$valquery);

  $valcount = mysqli_num_rows($valquery);

  if($valcount>0){
    ?>
      <script>alert("username already exists!!");</script>
    <?php
  }else{
    if($password === $cpassword){

      $insertquery = "insert into hospital(username,hos_name,city,category,password,cpassword) values ('$username','$hos_name','$city','$category','$pass','$cpass')";

      $re = mysqli_query($con,$insertquery);

      if($re){
        ?>
        <script>
          alert("Successfully Registered");
          location.replace("../login.php");
        </script>
        <?php
      }else{
        echo mysqli_error($con);
        ?>
        <script>alert("Not inserted");</script>
        <?php
      }
    }else{
      ?>
        <script>alert("password is not matching");</script>
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
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="formContent" class="bg-secondary">
  <br>
  <h3 class="text-light font-weight-bold">Hospital Registration</h3>
  <br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" class="form-control" id="username" placeholder="Enter unique username" name="username" required>
    </div>
    <div class="form-group col-md-6">
      <input type="text" class="form-control" placeholder="Enter Hospital Name" name="hos_name" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" class="form-control" placeholder="Enter city" name="city" required>
    </div>
    <div class="form-group col-md-5 ml-4 mt-2">

      <select name="category" class="custom-select" id="category">
        <option selected value="" hidden disabled>Select Category</option>
        <option value="Govt">Govt</option>
        <option value="Charitable">Charitable</option>
        <option value="Red Cross">Red Cross</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
    </div>
    <div class="form-group col-md-6">
      <input type="password" class="form-control" id="cpassword" placeholder="Repeat Password" name="cpassword" required>
    </div>
  </div>
 
  <div id="formFooter">
    <div class="row">
      <div class="col-md-6">
        <button type="submit" name="submit" class="btn btn-primary">Register</button>
      </div>
      <a class="underlineHover col-md-6" href="../login.php">Login</a>
    </div>
  </div>
</form>
</div>
</body>
</html>

