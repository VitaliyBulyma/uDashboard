<?php

require_once 'dbConnection.php';
require_once 'User.php';
require_once 'Survey.php';


//         User 


// need to get this value from the $_SESSION

$user_id = 2;

$dbcon = Database::getDb();

$s = new User();
// $users = $s->listUsers($dbcon); 


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



// List the surveys

$dbcon = Database::getDb();

$s = new Survey();

// show Surveys that are related to the user

$allsurveys = $s->displaySurveys($dbcon, $user_id);

// var_dump ($allsurveys[0]);
// echo count($allsurveys);
// $survey_id= $surveys->survey_id;
// $survey_title=$surveys->survey_title;
// $category_name=$surveys->category_name;

// below are also available in $surveys array
// user_fname;
// user_lname;
// user_email;
// user_password;
// user_isAdmin;


// END List the surveys

?>


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
<div .class="inline-block">

  <a class="btn btn-primary btn-lg" href="#" role="button">Create New Survey</a>
   
            <!-- <select class="custom-select">
                <option selected="">Select Ownership</option>
                <option value="1">Author</option>
                <option value="2">User</option>            
            </select> -->
    
</div> 

</div>

<!-- end Top Buttons -->
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Survey ID</th>
      <th scope="col">Survey Name</th>
      <th scope="col">Survey Category</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
<?php 
    for ($i=0; $i<count($allsurveys); $i++ ){
      echo '<tr class="table-primary">';

      echo '<td scope="row">'.$allsurveys[$i]->survey_id.'</td>';
      echo '<td scope="row"><a href="#">'.$allsurveys[$i]->survey_title.'</a></td>';
      echo '<td scope="row">'.$allsurveys[$i]->category_name.'</td>';
      echo '<td scope="row">'.$allsurveys[$i]->user_fname.'</td>';
      echo '<td scope="row">'.$allsurveys[$i]->user_lname.'</td>';
      echo '<td scope="row">';
        if ($allsurveys[$i]->user_lname == 0){
        echo "User";
        }else{
          echo "Admin";
        }
      echo '</td>';

      echo '</tr>';
    }


    

?>
  </tbody>
</table> 

<div class="jumbotron profile">
  <!-- <h1 class="display-3">Hello, <?= $user_fname ?></h1> -->
  <div class="profileImage">
<!-- https://www.iconfinder.com/icons/131511/account_boss_caucasian_chief_director_directory_head_human_lord_main_male_man_manager_profile_user_icon -->
  <!-- <img src="img/face.png" alt="generic face photo"></br> -->
 </div> 
<form action="" method="POST">
  <fieldset> 
    <input type="text" class="hidden" id="sid" name="sid" value="<?=$user_id;?>" />     
    <label for="uid">User ID</label>
        <input type="text" id="uid" name="uid" value="<?=$user_id;?>" disabled /></br>
    <label for="userisAdmin">Role</label>
        <input type="text" id="userisAdmin" name="userisAdmin" 
        value="<?php if ($user_isAdmin == 0){
                echo "User";
        }else{
          echo "Admin";
        }
        ?>" disabled  /></br>
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
      </fieldset>  
  
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