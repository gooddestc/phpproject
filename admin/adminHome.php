<?php
require_once ("../controller/controller.php");

if (isset($_GET['delid']) && !empty($_GET['delid'])) {
    $delid = $_GET['delid'];
    $msgd = $call->deleteUser($delid);
} else {
    $msgd = "No user selected for deletion.";
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
        section {
           width: 100%;
        }
        body {
            background-color: black !important;
            color: white !important;
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
        z-index: 5;
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






#content{
    background-color: gray;
}

    </style>
</head>
<body>
    <section>
       <!-- dropdown -->
<div id="mom">
<img id="pi" src="../uploads/userAvater.jpg " alt="">
<div id="droplist">
    <a href="editadmin.php" class="list">Edit profile details</a>
    <!-- <a href="profileImage.php" class="list">Edit profile image</a> -->
    <a href="adminlogout.php" class="list">Logout</a>
</div>

</div>

<!-- display users -->



<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content container p-4 mt-5">
    <div class="layout-px-spacing">
        <div class="col-lg-6" style="margin-top: 50px;">
   
            <!--  -->
<?php if (isset($msgd) && !empty($msgd)  ) {

          if ( ($msgd == 1)) { ?>
                <div class="alert alert-success">
                    User Deleted!!!
                </div>
            <?php } else { ?>
                <div class="alert alert-danger">
                    User Not Deleted!!!
                </div>
            <?php } 
            
        } else {
            ?>
<h1>Admin table</h1>

<?php
        }
            ?>
        </div>
        <div class="table-responsive mt-4">
            <table class="table mb-4 ">
               
                <thead>
                    <tr>
                        <th colspan="11"> All User </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>firstName</th>
                        <th>middleName</th>
                        <th>lastName</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>gender</th>
                        <th>Profile image</th>
                      
                        <th>Action</th>
                    </tr>
                </thead>
                <?php

                $sql = $call->sql_query("SELECT * FROM $user ORDER BY id DESC");
                if (mysqli_num_rows($sql) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($sql)) {
                  
                    


                ?>
                        <tbody>
                            <tr>
                                <td><?php print $i; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['middlename']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><img src="../uploads/<?php $row['profileimage'] == true ? print $row['profileimage']: print "userAvater.jpg"  ; ?>" alt="user image" width="100px" height="100px" ?></td>
                                

                         
                        </td>
                          
                                <td>
                                    <div class="btn-group">

                               
                                        <a href="adminHome.php?delid=<?php print $row['id']; ?>" class="btn btn-danger"  title="Delete User" >Delete</a>
                                    </div>
                                </td>
                            </tr>
                        
                           
                            <!-- Modal -->
                            <div id="myModalDELETE<?php print $row['id']; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title">Delete User?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this user?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-danger" href="adminHome.php?delid=<?php print $row['id']; ?>">Delete User</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </tbody>
                <?php $i++;
                    }
                } else {
                    print "<tr><td class='alert alert-warning text-dark' colspan='7'> Data not found</td></tr>";
                }
                ?>
            </table>
        </div>

    </div>







    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>