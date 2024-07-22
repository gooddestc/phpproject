<?php 
require_once("controller/controller.php");

if (isset($_POST["submit"]) && !empty($_POST["submit"])){

  $firstName = $_POST['firstname'];
  $middleName = $_POST['middlename'];
  $lastName = $_POST['lastname'];
  $userName = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $country = $_POST['country'];
  $occupation = $_POST['occupation'];

  if (!empty($firstName ) && !empty($middleName) && !empty($lastName) && !empty( $userName) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($country) && !empty($occupation)){
  $msg = $call->registerUser($firstName, $middleName, $lastName,$userName, $password,$cpassword,$email ,$occupation,$country );
  } else {
   $msg = "All fields are required";
   
  }

}





?>
