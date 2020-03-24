<?php

class User {

    public function listUsers($dbcon){
        $sql = "SELECT * FROM users";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $users = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }


    public function deleteUser($dbcon,$user_id){
        $sql = "DELETE FROM users WHERE user_id = :user_id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $count = $pst->execute();
        return $count;
    }
    public function displayUser($dbcon, $user_id){

        $sql = "SELECT * FROM users where user_id = :user_id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $pst->execute();
        $pageuser = $pst->fetch(PDO::FETCH_OBJ);
        return $pageuser;
    }
    public function updateUser($dbcon,$user_id, $user_fname, $user_lname, $user_email, $user_password, $user_isAdmin){
      $sql = "Update users
                set
                user_fname    = :user_fname,
                user_lname    = :user_lname,
                user_email    = :user_email,
                user_password = :user_password,
                user_isAdmin  = :user_isAdmin
                WHERE user_id = :user_id
        
        ";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':user_fname', $user_fname);
        $pst->bindParam(':user_lname', $user_lname);
        $pst->bindParam(':user_email', $user_email);
        $pst->bindParam(':user_password', $user_password);
        $pst->bindParam(':user_isAdmin', $user_isAdmin);
        $pst->bindParam(':user_id', $user_id);
        
        $count = $pst->execute();
        return $count;
       
    }
}

?>