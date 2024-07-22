<?php
require_once("controller/controller.php");
$call->checkUserLoggedIn();
if(isset($_POST["submit"]) && !empty($_POST["submit"])){

$oldPass = $_POST["oldpassword"];
$newPass = $_POST["newpassword"];
$cPass = $_POST["cpassword"];
if(!empty($oldPass) && !empty($newPass) && !empty($cPass)){

  $msg = $call->UpdatePassword($oldPass, $newPass, $cPass);


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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css">
    <style>
        form{
            width: 70% !important;
            height: 70% !important;
            margin: 100px auto 200px !important;
            border: 2px solid green !important;
            border-radius: 50px !important;
            box-sizing: border-box !important;
            padding: 50px !important;
            box-shadow: 10px 10px 10px black !important;;
        }
        body {
    display: flex;
    flex-direction: row;
    /* justify-content: space-between; */
}
.type{
    position: relative;
    left: 15%;
    
}

    </style>
</head>
<body>
    <?php 
require_once("sidebar.php");

?>
<section >
<form action="" method="post" class="type row g-3">
<?php if (isset($msg) && !empty($msg)) 
    {
      if ($msg == 1) {
        ?> <p style="color: green ;border: 1px solid green;"><?php echo "Update successful" ?></p>
        <?php 
            } else {
                ?> <p style="color: red ;border: 1px solid red"> <?php echo $msg;  ?></p> 
                <?php
            }
     } else {
        ?> 
      
         <h2>UpDate User Password</h2> 
         <?php
    }?>
  
<div class="col-md-6">
    <label for="inputPassword4" class="form-label">old Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="oldpassword">
  </div>
<div class="col-md-6">
    <label for="inputPassword4" class="form-label">new Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="newpassword">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">repeat_Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="cpassword">
  </div>
  <div class="col-12">
    <input type="submit" value="update" class="btn btn-primary w-100" name="submit">
  </div>

</form>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>