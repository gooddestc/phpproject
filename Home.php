
<?php 
require_once("controller/controller.php");
$call->checkUserLoggedIn();
function htime() {
    $time = date("H:i:s");
    $timeArray = explode(":", $time);
    if ($timeArray[0] < 12) {
        return "morning";
    } elseif ($timeArray[0] < 18) {
        return "afternoon";
    } else {
        return "evening";
    }
}

$greeting = "";
switch (htime()) {
    case "morning":
        $greeting = "Good morning!";
        break;
    case "afternoon":
        $greeting = "Good afternoon!";
        break;
    case "evening":
        $greeting = "Good evening!";
        break;
}
if($call->getUserData('gender') == 'male') {
$title = " mr ";
} elseif ($call->getUserData('gender') == 'female'){
$title = " mrs ";
} else {
$title = "you gay";
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
 body {
    display: flex;
    flex-direction: row;
    /* justify-content: space-between; */
}
.type{
    position: relative;
    left: 30%;
    width: 70%;
}
#pi{
    width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid teal;
            /* box-shadow: 2px 2px 8px black; */
            position: relative;
            left:80%;
            top: 0;
            z-index: 1;
}
#veiw{
        width: 200px;
        height: 200px;
        border-radius: 50%;
       
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border: 1px solid black;
        margin-bottom: 10px;
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
       }
       #mom{
        width: 100px;
        position: absolute;
        right: 15%;
        top: 0;
        
       }
       
       #droplist{
        width: 150px;
        margin: auto;
        position: absolute;
        display: none;
left: 50%;
top: 100px;
       }
       #mom:hover #droplist{
        display: block;
       }
       .list{
text-align: center;
font-size: 15px;
color:white;
text-decoration: none;
display: block;
background-color: teal;
padding: 10px;
       }
       .list:hover{
        background-color: aqua;
       }

    </style>
</head>
<body>
<?php
require_once("sidebar.php")
?>
<section class="type">
<div>
<h3>Hello <?php echo $greeting; ?> <?php echo $title ?> <?php echo $call->getUserData('firstname') ?></h3>
<!-- dropdown -->
<div id="mom">
<img id="pi" src="uploads/<?php  $call->getUserData('profileimage') == true ?  print $call->getUserData('profileimage') : print "userAvater.jpg" ?>" alt="">
<div id="droplist">
    <a href="editprofile.php" class="list">Edit profile details</a>
    <a href="profileImage.php" class="list">Edit profile image</a>
    <a href="logout.php" class="list">Logout</a>
</div>

</div>


</div>
</section>
</body>
</html>