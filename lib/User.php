<?php
    include "Database.php";

class User{

    // User Registration
    public function userRegistration($data){
        $name     = $data['name'];
        $username = $data['username'];
        $email    = $data['email'];
        $password = $data['password'];

        $existEmail = $this->existingEmailCheck($email);

        if($name == "" || $username == "" || $email == "" || $password == ""){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty !!</div>";
            return $msg;
        }
        if(strlen($username) < 3){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Username is too short !!</div>";
            return $msg;
        }elseif (preg_match('/[^a-z0-9_-]+/i', $username)){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Username must only contain alphanumerical, dashes and underscore !!</div>";
            return $msg;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Email address is not valid !!</div>";
            return $msg;
        }
        if($existEmail == true){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Email address already exist !!</div>";
            return $msg;
        }

        $password = md5($data['password']);

        $sql = "INSERT INTO tbl_user(name, username, email, password) VALUES (:name, :username, :email, :password)";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $result = $stmt->execute();
        if($result){
            $msg = "<div class='alert alert-success'><strong>Success !</strong> Thanks you have been register.</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Sorry there has been problem !!</div>";
            return $msg;
        }
    }
    public function existingEmailCheck($email){
        $sql = "SELECT email FROM tbl_user WHERE email=:email";
        $stmt = Database::prepare($sql);
        $stmt->bindParam('email', $email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Read User Data
    public function getUserData(){
        $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
        $stmt = Database::prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // Read User Data by ID
    public function getUserDataById($id){
        $sql = "SELECT * FROM tbl_user WHERE id=:id";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    // User Data Update
    public function userDataUpdate($id, $data){
        $name     = $data['name'];
        $username = $data['username'];
        $email    = $data['email'];

        $existEmail = $this->existingEmailCheck($email);

        if($name == "" || $username == "" || $email == ""){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty !!</div>";
            return $msg;
        }
        if(strlen($username) < 3){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Username is too short !!</div>";
            return $msg;
        }elseif (preg_match('/[^a-z0-9_-]+/i', $username)){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Username must only contain alphanumerical, dashes and underscore !!</div>";
            return $msg;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Email address is not valid !!</div>";
            return $msg;
        }

        $sql = "UPDATE tbl_user SET name=:name, username=:username, email=:email WHERE id=:id";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if($result){
            $msg = "<div class='alert alert-success'><strong>Success !</strong> Data updated successfully..</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Sorry user data not updated !! !!</div>";
            return $msg;
        }
    }

    // User Login
    public function userLogin($data){
        $email = $data['email'];
        $password = md5($data['password']);

        $existEmail= $this->existingEmailCheck($email);

        if ($email == "" || $password == ""){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty !!</div>";
            return $msg;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Your email address is not valid !!</div>";
            return $msg;
        }
        if($existEmail == false){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Email Address Not Exist !!</div>";
            return $msg;
        }

        $sql = "SELECT * FROM tbl_user WHERE email=:email AND password=:password LIMIT 1";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result){
            Session::init();
            Session::set("login", true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
            Session::set("loginMsg", "<div class='alert alert-success'><strong>Success !</strong> You are login successfully !!</div>");
            header("Location: index.php");
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Data not found !!</div>";
            return $msg;
        }
    }
    // Change Password
    private function checkOldPassword($id, $checkpass){
        $password = md5($checkpass);
        $sql = "SELECT password FROM tbl_user WHERE password=:password AND id=:id LIMIT 1";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function updateUserPass($id, $data){
        $oldpass = $data['oldpass'];
        $newpass = $data['newpass'];

        if ($oldpass == "" || $newpass == ""){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty !!</div>";
            return $msg;
        }

        $chkPass = $this->checkOldPassword($id, $oldpass);
        if($chkPass == false){
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Password not exist !!</div>";
            return $msg;
        }
        $password = md5($newpass);
        $sql = "UPDATE tbl_user SET password=:password WHERE id=:id";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if($result){
            $msg = "<div class='alert alert-success'><strong>Success !</strong> Password update successfully.</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Password not updated !!</div>";
            return $msg;
        }
    }

}