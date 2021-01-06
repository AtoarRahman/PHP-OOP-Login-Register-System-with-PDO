<?php
    include "inc/header.php";
    include "lib/User.php";
    Session::checkLoginFalse();
    if(isset($_GET['id'])){
        $usrId = $_GET['id'];
    }
    $user = new User();
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        $usrReg = $user->userDataUpdate($usrId, $_POST);
    }
?>
<div class="panel panel-default" style="background: #313131; border-color: #423f3f; color:#2cd8ff;">
    <div class="panel-heading" style="background: #313131; border-color: #423f3f; color:#df2cff;">
        <h4>Profile Update <span class="pull-right"><a href="index.php" class="btn btn-primary">Back</a></span></h4>
    </div>
    <div class="panel-body">
        <div style="max-width: 500px;margin: 50px auto; border: 1px solid #ddd; padding: 50px; border-color: #423f3f;">
<?php
    if(isset($usrReg)){
        echo $usrReg;
    }
?>
<?php
    $userData = $user->getUserDataById($usrId);
    if(isset($userData)){
?>
            <form action="" method="post">
                <div class="form-group">
                    <lebel for="name"l>Your Name</lebel>
                    <input type="text" name="name" id="name" value="<?php echo $userData->name; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <lebel for="username">Username</lebel>
                    <input type="text" name="username" id="username" value="<?php echo $userData->username; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <lebel for="email">Email Address</lebel>
                    <input type="text" name="email" id="email" value="<?php echo $userData->email; ?>" class="form-control">
                </div>

                <?php
                    $sesId = Session::get("id");
                    if($usrId == $sesId){
                ?>
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                        <a class="btn btn-primary" href="changepass.php?id=<?php echo $userData->id; ?>">Password Change</a>
                <?php } ?>
            </form>
<?php } ?>
        </div>
    </div>
</div>

<?php include "inc/footer.php"?>

