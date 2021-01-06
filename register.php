<?php
    include "inc/header.php";
    include "lib/User.php";
    Session::checkLoginTrue();
    $user = new User();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'])){
        $usrReg = $user->userRegistration($_POST);
    }
?>

<div class="panel panel-default" style="background: #313131; border-color: #423f3f; color:#2cd8ff;">
    <div class="panel-heading" style="background: #313131; border-color: #423f3f; color:#df2cff;">
        <h4>User Registration</h4>
    </div>
    <div class="panel-body">
        <div style="max-width: 500px;margin: 0px auto; border: 1px solid #ddd; padding: 50px; border-color: #423f3f"">
<?php
    if(isset($usrReg)){
        echo $usrReg;
    }
?>
            <form action="" method="post">
                <div class="form-group">
                    <lebel for="name"l>Your Name</lebel>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <lebel for="username">Username</lebel>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <lebel f or="email">Email Address</lebel>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <lebel for="password">Password</lebel>
                    <input type="text" name="password" id="password" class="form-control">
                </div>
                <button type="submit" name="registration" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"?>

