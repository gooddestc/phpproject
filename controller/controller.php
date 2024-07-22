

<?php
// user presence check
if (!session_id()) {
    ob_start();
    session_start();
}
// creating global variables
$localhost ="";
$username = "root";
$password = "";
$dbname = "projectdb";
$user = "users";
$admin = "admin";

class Project{
  private  $localhost ="";
  private $username = "root";
  private  $password = "";
  private  $dbname = "projectdb";
  private  $user = "users";
  private  $admin = "admin";


//    connecting to db
public function  dbconnect() {
    $link = mysqli_connect($this->localhost, $this->username, $this->password, $this->dbname);
if (mysqli_select_db($link, $this->dbname)){

        return $link;
    } else {
        print 'Not connected' . mysqli_connect_error();
    }
}


// query database
public function sql_query($sql){
    $link = $this->dbconnect();
    $query = mysqli_query($link, $sql);
    if ($query){

        return $query;
    } else {
        print 'Database error'."---". mysqli_error( $link);
    }
}

// validate password
public function validate_password($pass,$cpass)
{
    if ($pass == $cpass){
        return (1);
    } else {
        return (0);
    }
}


// generate dateTime
public function getDateTime(){
    date_default_timezone_set("Europe/London");
   $date=  date("Y-m-d ");
return $date;
}


// passwoard hash
public function hashPass($pass){
    $hashP=  password_hash($pass,PASSWORD_DEFAULT);
    return $hashP;
  }


// rgistering  the user
public function registerUser($firstName, $middleName, $lastName,$userName,$gender, $password,$cpassword,$email ,$occupation,$country ){
  $checkedPass = $this->validate_password($password,$cpassword);
  $passHashed = $this->hashPass($password);
  $date = $this->getDateTime();
  $checkEmail =  $this->sql_query("SELECT * FROM $this->user WHERE `email` ='".$email."'  ");

if ( $checkedPass) {
    
    if(mysqli_num_rows($checkEmail) > 0){
print " user already exists";
    } else {
        if (strlen($password) > 8 && strlen($password) < 16) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){ 


                $sql = "INSERT INTO $this->user  VALUES (null,'".$firstName."', '".$middleName."', '".$lastName."','".$email."', '".$userName."','".$gender."',null, '".$passHashed."','".$country."',  '".$occupation."',  '".$date."')";
                $query = $this->sql_query($sql);
                header("Location:login.php");
                if($query) {
                   
                    return 0;
                   
                } else {
                    print "user not registered";
                }



            } else {
print "<p stytle='color:red'>invalid email address</p>";
            }




        } else {
            print "password must be between 8 and 16 characters";
        }



    }

} else {
print "password does not match";
}




}

// user login
public function userLogin($info,$password){
    $checkUser= $this->sql_query( "SELECT * FROM $this->user WHERE `email` =  '".$info."' OR `username` = '".$info."' ");
    if(mysqli_num_rows($checkUser) > 0 ) {
        $row = mysqli_fetch_assoc( $checkUser) ;
        $passwordDb = $row['password'];
       $passwordHash = $this->hashPass($password);
       if ( $passwordHash == password_verify($password,$passwordDb )) {

        $_SESSION["user_logged"] = $row['email'];
header("Location:Home.php");

       } else {
        print "password or email does not match";
       }
      
    } else {
        print "password or email does not match";
    }

}

// to set login session for the user
public function setUserLogin(){
    if (isset($_SESSION["user_logged"]) && !empty($_SESSION["user_logged"])){
      $_SESSION['logged_in'] = $_SESSION["user_logged"];
    }
}

// check if user have loggedin
public function checkUserLoggedIn(){
    if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])){

    } else{
        header("location:login.php");
    }
}





//** */ getting user information by session
public function getUserData($value){

    $sql = $this->sql_query(" SELECT * FROM $this->user WHERE `email` = '" .$_SESSION['logged_in']."'  ");
     $row = mysqli_fetch_assoc($sql); 
  
  return $row[$value];
  }
  
  //** */ getting user information by id
  
  public function getUserId($value,$id){
      $sql = $this->sql_query(" SELECT * FROM $this->user WHERE `id` = '" .$id."'  ");
      $row = mysqli_fetch_assoc($sql); 
  
      return $row[$value];
  
  }
  




public function ProfileEdit($firstName,$middleName,$lastName,$userName,$gender,$country,$occupation){
    $sql = $this->sql_query("UPDATE $this->user SET `firstname`='" . $firstName . "',`middlename`='" . $middleName . "',`lastname`='" . $lastName . "',`username`='". $userName ."',`gender`='".$gender."', `country`='" . $country . "',`occupation`='" . $occupation . "' WHERE `email`='" . $_SESSION['logged_in'] . "'");
if($sql){
    return 1;
} else {
    return "update failed !!!";
}

}



// profileImage
public function changeProfileImage($profileImage) {
    if(!empty($profileImage)){

        $sql = $this->sql_query("UPDATE $this->user SET `profileimage`='" . $profileImage. "' WHERE `email`='" . $_SESSION['logged_in'] . "'");
        if($sql){
            return 1;
        } else {
            return "image update failed !!!";
        }
    } else {
        return "please select image";
    }

}


// delete profile image
public function deleteProfileimage($imageId) {

    $query = $this->sql_query("UPDATE $this->user SET `profileimage`='" . $imageId. "' WHERE `email`='" . $_SESSION['logged_in'] . "'");
if( $query){
return 1;
} else{
return "Delete unsuccess";
}

}



//update user password by loggedin session
public function UpdatePassword($oldpass, $newpass, $cpass)
{
    $check = $this->sql_query("SELECT * FROM $this->user WHERE `email`='" . $_SESSION['logged_in'] . "'");
    $row = mysqli_fetch_assoc($check);
    $hashP = $this->hashPass($oldpass);
    // verify user password
    if ($hashP == password_verify($oldpass, $row['password'])) {



 //verify user new password if it matches
 $checkpass = $this->validate_password($newpass, $cpass);
 if ($checkpass == 1) {


     if (strlen($newpass) < 8 || (strlen($newpass)) > 16) {
         return ("PASSWORD MUST BE BETWEEN 8-16 CHARACTERS!!!");
     } else {
         $hashnewpass = $this->hashPass($newpass);
         $update = $this->sql_query("UPDATE $this->user SET `password`='" . $hashnewpass . "' WHERE `email`='" . $_SESSION['logged_in'] . "'");
         if ($update) {
             return 1;
         } else {
             return "Password update failed!!!";
         }

         }
          } else {
            return "password does not match";
          }
    } else {
       return " incorrect password";
    }


}




// administrator


// rgistering  the administrator
public function registerAdmin($fullName,$email ,$password, $cpassword){
    $checkedPass = $this->validate_password($password,$cpassword);
    $passHashed = $this->hashPass($password);
    $date = $this->getDateTime();
    $checkEmail =  $this->sql_query("SELECT * FROM $this->admin WHERE `email` ='".$email."'  ");
  
  if ( $checkedPass) {
      
      if(mysqli_num_rows($checkEmail) > 0){
  print " admin info already exists";
      } else {
          if (strlen($password) > 8 && strlen($password) < 16) {
              if (filter_var($email, FILTER_VALIDATE_EMAIL)){ 
  
  
                  $sql = "INSERT INTO $this->admin VALUES (null,'".$fullName."',null,'".$email."', '".$passHashed."', '".$date."')";
                  $query = $this->sql_query($sql);
                  
                  if($query) {
                     
                      return 1;
                     
                  } else {
                      print "admin not registered";
                  }
  
  
  
              } else {
  print "<p stytle='color:red'>invalid email address</p>";
              }
  
  
  
  
          } else {
              print "password must be between 8 and 16 characters";
          }
  
  
  
      }
  
  } else {
  print "password does not match";
  }
  
  
  
  
  }
  


// administrator login
public function adminLogin($info,$password){
    $checkUser= $this->sql_query( "SELECT * FROM $this->admin WHERE `email` =  '".$info."'  ");
    if(mysqli_num_rows($checkUser) > 0 ) {
        $row = mysqli_fetch_assoc( $checkUser) ;
        $passwordDb = $row['password'];
       $passwordHash = $this->hashPass($password);
       if ( $passwordHash == password_verify($password,$passwordDb )) {

        $_SESSION["admin_logged"] = $row['email'];
header("Location:adminHome.php");

       } else {
        print "<p style='red'>password or email does not match</p>";
       }
      
    } else {
        print "password or email does not match";
    }

}

// to set login session for the administrator
public function setAdminLogin(){
    if (isset($_SESSION["admin_logged"]) && !empty($_SESSION["admin_logged"])){
      $_SESSION['adminlogged_in'] = $_SESSION["admin_logged"];
    }
}

// check if administrator have loggedin
public function checkAdminLoggedIn(){
    if (isset($_SESSION["adminlogged_in"]) && !empty($_SESSION["adminlogged_in"])){

    } else{
        header("location:adminlogin.php");
    }
}
public function editAdmin($fullName,$oldPassword,$newPassword,$cNewPassword){

    $check = $this->sql_query("SELECT * FROM $this->admin WHERE `email`='" . $_SESSION['adminlogged_in'] . "'");
    $row = mysqli_fetch_assoc($check);
    $hashP = $this->hashPass($oldPassword);
    // verify user password
    if ($hashP == password_verify($oldPassword, $row['password'])) {



 //verify user new password if it matches
 $checkpass = $this->validate_password($newPassword, $cNewPassword);
 if ($checkpass == 1) {


     if (strlen($newPassword) < 8 || (strlen($newPassword)) > 16) {
         return ("PASSWORD MUST BE BETWEEN 8-16 CHARACTERS!!!");
     } else {
         $hashnewpass = $this->hashPass($newPassword);
         $update = $this->sql_query("UPDATE $this->admin SET`fullname`= '".$fullName."', `password`='" . $hashnewpass . "' WHERE `email`='" . $_SESSION['adminlogged_in'] . "'");
         if ($update) {
             return 1;
         } else {
             return "update failed!!!";
         }

         }
          } else {
            return "password does not match";
          }
    } else {
       return " incorrect password";
    }



}


//** */ getting user information by session
public function getAdminData($value){

    $sql = $this->sql_query(" SELECT * FROM $this->admin WHERE `email` = '" .$_SESSION['adminlogged_in']."'  ");
     $row = mysqli_fetch_assoc($sql); 
  
  return $row[$value];
  }
  


// Admin profileImage
public function changeAdminProfileImage($profileImage) {
    if(!empty($profileImage)){

        $sql = $this->sql_query("UPDATE $this->admin SET `profileimage`='" . $profileImage. "' WHERE `email`='" . $_SESSION['adminlogged_in'] . "'");
        if($sql){
            return 1;
        } else {
            return "image update failed !!!";
        }
    } else {
        return "please select image";
    }

}



// delete admin profile image
public function deleteAdminProfileimage($imageId) {

    $query = $this->sql_query("UPDATE $this->admin SET `profileimage`='" . $imageId. "' WHERE `email`='" . $_SESSION['adminlogged_in'] . "'");
if( $query){
return 1;
} else{
return "Delete unsuccess";
}

}


// delete users
public function deleteUser($delid)
{
    $sql = $this->sql_query("DELETE FROM $this->user WHERE `id`='" . $delid . "'");
    if ($sql) {
        return (1);
    } else {
        return (0);
    }
}
// last closing bracket
}

$call = new Project;
$call->setUserLogin();
$call->setAdminLogin();