<?php
require_once("controller/controller.php");

$call->checkUserLoggedIn();

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $file = $_FILES['file'];


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
   
            
            $destination = 'uploads/'.$fileName;
            if (move_uploaded_file($fileTem, $destination)) {
                $msg = $call->changeProfileImage($fileName);
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

if (isset($_POST['del']) && !empty($_POST['del'])){

    $imageId =  "userAvater.jpg" ;
   
    $megs = $call->deleteProfileimage($imageId);
    header("Location: profileimage.php");

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <style>
        h2, p {
            color: black!important;
            width: 40%;
            margin-left: 30%;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: thistle;
            display: flex;
            flex-direction: column;
        }
        input {
            width: 200px;
            height: 30px;
            display: block;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        #conx{
            margin: 10% auto 0;
            
            background-color: teal;
            
            box-shadow: 2px 2px 8px black;
          
            position: absolute;
            top: 100px;
            left: 78%;
        }
        #con {
            margin: 10% auto 0;
            width: 60%;
            height: 300px;
            background-color: teal;
            background-image: url("uploads/<?php echo $call->getUserData('profileimage')  ?>");
            background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
            box-shadow: 2px 2px 8px black;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            left: 38%;
        }
        .rom{
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 1px solid black;
            box-shadow: 2px 2px 8px black;
            position: relative;
            left: 40%;
            top: 10%;
            z-index: 1;
        }
    </style>
</head>
<body>
<?php
require_once("sidebar.php");
?>

<section class="correct type">
  
    
  
<img src="uploads/<?php echo $call->getUserData('profileimage')  ?>" class="rom" alt="">



<?php 
    if (isset($msg) && !empty($msg)) { 
        if ($msg == 1) { 
    ?> 
    <p style="color: green; border: 1px solid green;"><?php echo "image upload Successful"; ?></p>
    <?php 
        } else { 
    ?> 
    <p style="color: red; border: 1px solid red;"><?php echo $msg; ?></p> 
    <?php 
        } 
    } else { 
    ?>  
    <h2 class=" ">Edit Profile Image</h2> 
    <?php 
    }
    ?>

    <form action="" method="post" id="con" enctype="multipart/form-data">
        
        <input type="file" name="file" class="vin">
        <input type="submit" value="submit" style="padding: 10px; border-radius: 10px; background-color:transparent; color: white; width: 20%;" class="sub feild" name="submit">
    </form>

    <!-- delete profile -->
    <form action="" id="conx" method="post" >

    <!-- <input type="text" value="avatar3.png"  name="img"> -->
        <input type="submit" name="del" class="" value="Delete Profile Image" style="padding: 10px; border-radius: 10px; background-color:
        red; color: white; width: 100%;" >

    </form>
</section>
</body>
</html>
