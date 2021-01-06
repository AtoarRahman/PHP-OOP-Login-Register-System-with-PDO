<?php
    include "inc/header.php";
    include "lib/User.php";
    Session::checkLoginFalse();
    if(isset($_GET['id'])){
        $userId = $_GET['id'];
    }
    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])){
        $chngPass = $user->updateUserPass($userId, $_POST);
    }
?>
<?php
    $sesId = Session::get("id");
    if($userId != $sesId){
        header("Location: index.php");
    }
?>
<div class="panel panel-default" style="background: #313131; border-color: #423f3f; color:#2cd8ff;">
    <div class="panel-heading" style="background: #313131; border-color: #423f3f; color:#df2cff;">
        <h4>Change Password <span class="pull-right"><a href="profile.php?id=<?php echo $userId; ?>" class="btn btn-primary">Back</a></span></h4>
    </div>
    <div class="panel-body">
        <div style="max-width: 500px;margin: 0px auto; border: 1px solid #ddd; padding: 50px; border-color: #423f3f;">
        <?php
            if(isset($chngPass)){
                echo $chngPass;
            }
        ?>
            <form action="" method="post">
                <div class="form-group">
                    <lebel for="oldpass"l>Old Password</lebel>
                    <input type="password" name="oldpass" id="oldpass" class="form-control">
                </div>
                <div class="form-group">
                    <lebel for="newpass">New Password</lebel>
                    <input type="password" name="newpass" id="newpass" class="form-control">
                </div>
                <button type="submit" name="updatepass" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"?>

