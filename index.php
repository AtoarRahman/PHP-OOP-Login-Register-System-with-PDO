<?php
    include "inc/header.php";
    include "lib/User.php";
    Session::checkLoginFalse();
    $user = new User();
    $usrData = $user->getUserData();
?>
<?php
    $logMsg = Session::get("loginMsg");
    if(isset($logMsg)){
        echo $logMsg;
    }
    Session::set("loginMsg", NULL);
?>
        <div class="panel panel-default" style="background: #313131; border-color: #423f3f; color:#2cd8ff;">
            <div class="panel-heading" style="background: #313131; border-color: #423f3f; color:#df2cff;">
                <h4>User List <span class="pull-right"><strong>Welcome! </strong>
                    <?php
                        $loginUsrName = Session::get("name");
                        echo $loginUsrName;
                    ?>
                    </span></h4>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
				<tr style="background-color: #1f1f1f;">
                    <th width="10%">Serial</th>
                    <th width="30%">Name</th>
                    <th width="20%">Username</th>
                    <th width="30%">Email Address</th>
                    <th width="10%">Action</th>
				</tr>	
<?php
    if(isset($usrData)){
        $i = 0;
        foreach ($usrData as $data){
            $i++;
?>
                    <tr style="background-color: #292929;">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><a class="btn btn-success" href="profile.php?id=<?php echo $data['id']; ?>">View</a></td>
                    </tr>
<?php }}else{?>
                    <tr style="background-color: #292929;">
                        <td colspan="5">
                            <h3>User data not found...</h3>
                        </td>
                    </tr>
<?php } ?>

                </table>
            </div>
        </div>

<?php include "inc/footer.php"?>

