<?php

require_once 'dbConnection.php';
require_once 'User.php';
require_once 'Survey.php';


//         User 


// need to get this value from the $_SESSION

$user_id = 2;

$dbcon = Database::getDb();

$s = new User();
$users = $s->listUsers($dbcon); 


// show user
$pageuser = $s->displayUser($dbcon, $user_id);

$user_fname=$pageuser->user_fname;
$user_lname=$pageuser->user_lname;
$user_email=$pageuser->user_email;
$user_password=$pageuser->user_password;
$user_isAdmin=$pageuser->user_isAdmin;

// end show user

// update User 

        // Update User
        if(isset($_POST['updUser'])) {
            $user_fname = $_POST['userfname'];
            $user_lname = $_POST['userlname'];
            $user_email = $_POST['useremail'];
            $user_password = $_POST['userpassword'];
            // $user_isAdmin = $_POST['userisAdmin'];
            // $user_id = $_POST['sid'];

            $dbcon = Database::getDb();
            $s = new User();

            $count = $s->updateUser($dbcon, $user_id, $user_fname, $user_lname, $user_email, $user_password, $user_isAdmin);
          
            if($count){
                
                $message="Record Updated!";
                // echo "<script async type='text/javascript'>alert('$message');</script>";
                header("user_dashboard.php");
            } else {
                echo "problem updating a user";
            }
        }


        // Delete User

        if(isset($_POST['deleteUser'])){
            $user_id = $_POST['sid'];

            $dbcon = Database::getDb();

            $s = new User();
            $count = $s->deleteUser($dbcon,$user_id);

            if($count){
                header("Location: createAccount.php");
            }
            else {
                echo " Problem Deleting your profile";
            }
        }

        // End Delete User

// end update User
?>



<!-- begin test -->

<!-- end test -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/darkly/bootstrap.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/userDashboard.css">
    <title>User Dashboard</title>
</head>
<body>
<main class="main">
<!-- Top buttons -->
<div .class="inline-block"><a class="btn btn-primary btn-lg" href="#" role="button">Create New Survey</a>
    
            <select class="custom-select">
                <option selected="">Select Ownership</option>
                <option value="1">Author</option>
                <option value="2">User</option>            
            </select>
    
</div>

</div>

<!-- end Top Buttons -->
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Survey ID</th>
      <th scope="col">Survey Name</th>
      <th scope="col">Description</th>
      <th scope="col">Created</th>
      <th scope="col">Status </th>
      <th scope="col">Ownership</th>
    </tr>
  </thead>
  <tbody>

    <tr class="table-primary">
      <th scope="row">1</th>
      <td> <a href="#"> Costco shopping</a></td>
      <td>Survey about Costco shopping satisfaction</td>
      <td>April 1, 1996</td>
      <td>Completed</td>
      <td>Author</td>
     
      
    </tr>
    <tr class="table-primary">
      <th scope="row">2</th>
      <td> <a href="#">Web Development at Humber College</a> </td>
      <td>Alumni satisfaction survey for Web Development program at humber college</td>
      <td>April 1, 2019</td>
      <td>Not Started</td>
      <td>User</td>
      
    </tr>
  </tbody>
</table> 

<div class="jumbotron profile">
  <!-- <h1 class="display-3">Hello, <?= $user_fname ?></h1> -->
  <div class="profileImage">
<!-- https://www.iconfinder.com/icons/131511/account_boss_caucasian_chief_director_directory_head_human_lord_main_male_man_manager_profile_user_icon -->
  <img src="img/face.png" alt="generic face photo"></br>
 </div> 
<form action="" method="POST">

    <label for="sid">User ID</label>
        <input type="text" id="sid" name="sid" value="<?=$user_id;?>" /></br>
    <label for="userisAdmin">User Role</label>
        <input type="text" id="userisAdmin" name="userisAdmin" value="<?=$user_isAdmin;?>" disabled  /></br>
    <label for="userfname">First Name: </label>
        <input type="text" id="userfname" name="userfname" value="<?=$user_fname?>" /> </br>
    <label for="userlname">Last Name: </label>
        <input type="text" id="userlname" name="userlname" value="<?=$user_lname?>" /></br>
    <label for="useremail">Email: </label>
        <input type="text" id="useremail" name="useremail" value="<?=$user_email?>" /></br>
    <label for="userpassword">Password: </label>
        <input type="password" id="userpassword" name="userpassword" value="<?=$user_password?>" /></br>
  
    <button type="submit" name="updUser" id="updUser"> Update User</button>
    <button type="submit" name="deleteUser" id="deleteUser"> Delete Account</button>
    
  
</form>
<div> 
        <?php if(isset($message)){
        echo $message;
        } 
        ?>
</div>


</main>   
</body>
</html>