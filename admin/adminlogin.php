<?php 
require_once("../controller/controller.php");

if (isset($_POST["submit"]) && !empty($_POST["submit"])){

 

  $info = $_POST['email'];
  $password = $_POST['password'];
  

  if ( !empty($info) && !empty($password)  ){
  $msg = $call->adminLogin($info,$password);
  } else {
   $msg = "All fields are required";
   
  }

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        form{
            width: 60% !important;
            height: 70% !important;
            margin: 100px auto 200px !important;
            border: 2px solid green !important;
            border-radius: 50px !important;
            box-sizing: border-box !important;
            padding: 50px !important;
            box-shadow: 10px 10px 10px black !important;;
        }
    </style>
</head>
<body>

<form action="" method="post" class="row g-3">
<?php if (isset($msg) && !empty($msg)) 
    { ?>
      <p style="color:red"><?php print $msg ?> </p>
    <?php } else {
        ?> 
      
         <h2>Admin login</h2> 
         <?php
    }?>


  <div class="col-12">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4" name="email">
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="password">
  </div>
  
  
  
 
  <div class="col-12">
    <input type="submit" value="Sign in" class="btn btn-primary w-100" name="submit">
  </div>

</form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>