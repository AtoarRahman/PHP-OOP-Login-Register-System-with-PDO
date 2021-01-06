<?php
    include "inc/header.php";
    include "lib/User.php";
    Session::checkLoginTrue();
    $user = new User();
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $usrLogin = $user->userLogin($_POST);
    }
?>
<div class="panel panel-default" style="background: #313131; border-color: #423f3f; color:#2cd8ff;">
    <div class="panel-heading" style="background: #313131; border-color: #423f3f; color:#df2cff;">
        <h4>User Login</h4>
    </div>
    <div class="panel-body">
        <div style="max-width: 500px;margin: 0px auto; border: 1px solid #ddd; padding: 50px;border-color: #423f3f">
     <form action="" method="post">
                <div class="form-group">
                    <lebel for="email">Email Address</lebel>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <lebel for="password">Password</lebel>
                    <input type="text" name="password" id="password" class="form-control">
                </div>
                <button type="submit" name="login" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"?>

