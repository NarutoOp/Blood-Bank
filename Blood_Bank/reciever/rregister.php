<?php
session_start();

include '../link.php'; 
include '../connection.php';

if(isset($_POST['rsubmit'])){

  $name = mysqli_real_escape_string($con,$_POST['rname']);
  $gender = mysqli_real_escape_string($con,$_POST['gender']);
  $age = mysqli_real_escape_string($con,$_POST['age']);
  $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
  $rec_bg = mysqli_real_escape_string($con,$_POST['rec_bg']);
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

  $pass = password_hash($password, PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

  $valquery = " select * from reciever where email='$email' or mobile='$mobile' ";

  $valquery = mysqli_query($con,$valquery);

  $valcount = mysqli_num_rows($valquery);

  if($valcount>0){
    ?>
      <script>alert("Email or Mobile no. already exists!!");</script>
    <?php
  }else{
    if($password === $cpassword){

      $insertquery = "insert into reciever(name,gender,age,mobile,blood_group,email,password,cpassword) values('$name','$mobile','$gender','$age','$rec_bg','$email','$pass','$cpass')";

      $rec = mysqli_query($con,$insertquery);

      if($rec){
        ?>
        <script>
          alert("Registered Successfully");
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
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="formContent" class="bg-info">
  <br>
  <h3 class="text-light font-weight-bold">Reciever Registration</h3>
  <br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" class="form-control" id="rname" placeholder="Enter your Name" name="rname" required>
    </div>
    <div class="form-group col-md-5 ml-4 mt-1">
      <select name="gender" class="custom-select" id="gender">
        <option selected value="" hidden disabled>Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="number" class="form-control" id="age" placeholder="Enter your Age" name="age" required>
    </div>
    <div class="form-group col-md-6">
      <input type="text" class="form-control" id="mobile" placeholder="Enter your Mobile no" name="mobile" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-5 mt-1 ml-4 mr-4">
      <select name="rec_bg" class="custom-select" id="rec_bg">
        <option selected value="" hidden disabled>Select Blood Group</option>
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
    <div class="form-group col-md-6">
      <input type="email" class="form-control" id="email" placeholder="Enter your Email-Id" name="email" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
    <div class="form-group col-md-6">
      <input type="password" class="form-control" id="cpassword" placeholder="Repeat password" name="cpassword" required>
    </div>
  </div>
  <div id="formFooter">
    <div class="row">
      <div class="col-md-6">
        <button type="submit" name="rsubmit" class="btn btn-primary">Register</button>
      </div>
      <a class="underlineHover col-md-6" href="../login.php">Login</a>
    </div>
  </div>
</form>
</div>
</body>
</html>

