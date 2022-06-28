<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'link.php' ?>
<link href="css/login.css" rel="stylesheet"></link>
</head>
<body>
<!-- Backend -->
<?php
include 'connection.php';
if(isset($_POST['submit'])){

  $loginAs = $_POST['desig'];
  $login = mysqli_real_escape_string($con,$_POST['login']);
  $password = mysqli_real_escape_string($con,$_POST['password']);

  if($loginAs === 'a Reciever'){

    $email_search = " select * from reciever where email='$login' ";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
      $email_pass = mysqli_fetch_assoc($query);

      $db_pass = $email_pass['password'];

      $_SESSION['name'] = $email_pass['name'];
      $_SESSION['r_id'] = $email_pass['r_id'];
      $_SESSION['blood'] = $email_pass['blood_group'];

      $pass_decode = password_verify($password, $db_pass);

      if($pass_decode){
        echo "login Successful";
        ?>
        <script>
          location.replace("index.php");
        </script>
        <?php
      }else{
        echo "password incorrect";
      }
    }else{
      echo "Invalid email";
    }

  }else if($loginAs === 'a Hospital'){

    $username_search = " select * from hospital where username='$login' ";
    $query = mysqli_query($con,$username_search);

    $username_count = mysqli_num_rows($query);

    if($username_count){
      $username_pass = mysqli_fetch_assoc($query);

      $username_db_pass = $username_pass['password'];

      $_SESSION['h_id'] = $username_pass['h_id'];
      $_SESSION['hos_name'] = $username_pass['hos_name'];
      // $_SESSION['blood'] = $username_pass['blood_group'];

      $user_pass_decode = password_verify($password, $username_db_pass);

      if($user_pass_decode){
        echo "login Successful";
        ?>
        <script>
          location.replace("hospital/view_request.php");
        </script>
        <?php
      }else{
        echo "password incorrect";
      }
    }else{
      echo "Invalid username";
    }

  }else{
    alert('select login option !!');
  }

}
?>

<!-- Frotend -->
<div class="wrapper fadeInDown">
  <div class="jumbotron bg-danger">
    <a href="index.php"><h1 class="text-light">| ------  Blood Bank  ------ |</h1></a>
  </div>
  <div id="formContent">
    <br>
    <div class="fadeIn first">
      <div class="loginas"> 
        <b>Login</b> as <b><span class="spanDesig"><button class="desig">--</button> </b> </span>
        <div class="options">
          <div class="hospital val"><button class="opt" value="a Hospital">Hospital</button></div>
          <div class="reciever val"><button class="opt" value="a Reciever">Reciever</button></div>
        </div> 
      </div>
    </div>
    <br>

    <!-- Login Form -->
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
      <input type="text" name="desig" id="desig" hidden>


      <input type="text" data-toggle="tooltip" title="Use email for reciever and username for hospital" id="login" class="fadeIn second" name="login" placeholder="login" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required>
      <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
    </form>
    <div id="formFooter">
      <p>Register here</p>
      <a class="underlineHover" href="hospital/hregister.php">Hospital</a>
      <a class="underlineHover" href="reciever/rregister.php">Reciever</a>
    </div>

  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

  $(document).ready(function() {
      desig = "";
      $(".desig").click( function(e) {
        e.preventDefault();
        // $(this).hide();
        $(".options").slideToggle();
        $(".val button").click(function(e) {
          e.preventDefault();
          let temp = $(this).val();
          if (temp === "a Reciever" || temp ===  "a Hospital") {
            $(".spanDesig").html(temp)
            $(".options").css("display", "none");
            $(".desigErr").html(" ");
            desig = $(this).val();
          } else {
            console.log("Please refresh the page");
          }
          
          })
        })
    // transfer to input
    $(".opt").click(function() {
      $("#desig").val($(this).val());
    })
  });
</script>
</body>
</html>