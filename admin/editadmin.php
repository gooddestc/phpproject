<?php 
require_once("../controller/controller.php");
$call->checkAdminLoggedIn();

// edit other details

if (isset($_POST["submit"]) && !empty($_POST["submit"])){

  $fullName = $_POST['fullname'];
  $oldPassword = $_POST['oldpassword'];
  $newPassword = $_POST['newpassword'];
  $cNewPassword = $_POST['cnewpassword'];

  if (!empty($fullName )  &&  !empty($oldPassword) && !empty($newPassword) && !empty($cNewPassword) ){
  $msg = $call->editAdmin($fullName,$oldPassword,$newPassword,$cNewPassword);
  } else {
   $msg = "All fields are required";
   
  }

}

// edit profile picture
if (isset($_POST['submit2']) && !empty($_POST['submit2'])) {
  $file = $_FILES['pics'];


  $fileName = $file['name'];
  $fileTem =$file['tmp_name'];
  $fileType = $file['type'];
  $fileError = $file['error'];
  $fileSize = $file['size'];


    $fileExt = explode(".",$fileName);
    $fileActualExt = strtolower(end($fileExt));
$extAllowed= ["png", "jpg", "jpeg", "pdf","gif","webp","svg","ico"];

if(in_array($fileActualExt, $extAllowed)){

  if ($fileSize < 5000000) {
      if ($fileError == 0) {
 
          
          $destination = '../uploads/'.$fileName;
          if (move_uploaded_file($fileTem, $destination)) {
              $msg = $call->changeAdminProfileImage($fileName);
          } else {
              $msg = 'Picture Upload Failed!';
          }

      } else {
$msg = "there was an error uploading this file";
      }
      } else {
$msg = "File format not supported";
      }
} else {
  $msg = "You can only upload file of type: ".implode(", ",$extAllowed);
}
}
// delete method
if (isset($_POST['del']) && !empty($_POST['del'])){

  $imageId =  "userAvater.jpg" ;
 
  $megs = $call->deleteAdminProfileimage($imageId);
  header("Location: editadmin.php");

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
        #form2{
            width: 60% !important;
            height: 70% !important;
            margin: 100px auto 200px !important;
            border: 2px solid green !important;
            border-radius: 50px !important;
            box-sizing: border-box !important;
            padding: 50px !important;
            box-shadow: 10px 10px 10px black !important;;
        }
        #form1{
          width: 200px;
            height: 200px;
            border-radius: 5%;
            border: 1px solid black;
            box-shadow: 2px 2px 8px black;
            position: relative;
            left: 70%;
            top: 10%;
            z-index: 1;
            background-image: url("../uploads/<?php $call->getAdminData('profileimage') == true ? print $call->getAdminData('profileimage') : print "userAvater.jpg" ?> ");
            background-size: cover;

        }
        .pic{
          opacity: 0;
          width: 100%;
          cursor: pointer;
          height: 100%;
        }
        #conx{
          width: 200px;
            height: 40px;
            border-radius: 20%;
            border:0;
            box-shadow: 2px 2px 8px black;
            position: absolute;
            left: 70%;
            top: 40%;
          
           
        }
    </style>
</head>
<body>

<a href="adminHome.php">back to home page</a>
<!-- edit admin profile pics -->
<form id="form1" action="" method="post" enctype="multipart/form-data">
<input type="file" class="pic" name="pics" >
<div class="col-12">
    <input type="submit" value="update pics" class="btn btn-primary w-100" name="submit2">
  </div>
</form>

<!-- delete admin profile image -->
<form action="" id="conx" method="post" >
    <input type="submit" name="del" class="btn btn-danger" value="Delete Profile Image" style="padding: 10px; border:0;height:100%; width: 100%;border-radius:10%" >

</form>

<!-- edit admin other details -->
<form id="form2" action="" method="post" class="row g-3">
<?php if (isset($msg) && !empty($msg)) 
    {
      if ($msg == 1) {
        ?> <p style="color: green ;border: 1px solid green;"><?php echo "success" ?></p>
        <?php 
            } else {
                ?> <p style="color: red ;border: 1px solid red"> <?php echo $msg;  ?></p> 
                <?php
            }
     } else {
        ?> 
      
         <h2>Update Admin info</h2> 
         <?php
    }?>
    <div class="row g-3">
  <div class="col-12">
    <input type="text" class="form-control" value="<?php print $call->getAdminData('fullname') ?>" placeholder="Full name" aria-label="First name" name="fullname">
  </div>
  
</div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" value="<?php print $call->getAdminData('email') ?>" disabled id="inputEmail4" name="email">
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">old Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="oldpassword">
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">new Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="newpassword">
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">repeat_New Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="cnewpassword">
  </div>
  
  
 
  <div class="col-12">
    <input type="submit" value="update" class="btn btn-primary w-100" name="submit">
  </div>

</form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>