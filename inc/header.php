<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Session.php";
    Session::init();
?>
<?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout'){
        Session::destroy();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP OOP © Login & Register System with PDO</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"                               integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!--  JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"                                                 integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"                                                                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
	<style>
	
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    border-color: #403b3b !important;
}
	</style>

</head>
<body style="background:#1f1f1f;">
<div class="container">
    <nav class="navbar navbar-default" style="margin-top:15px; background: #313131; border-color: #423f3f;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a style="color:#9dde1f;" href="index.php" class="navbar-brand">PHP OOP © Login & Register System with PDO</a>
            </div>
            <ul class="nav navbar-nav pull-right">
            <?php
                $userId = Session::get("id");
                $userLogin = Session::get('login');
                if($userLogin == true){
            ?>
                <li><a style="color: #de8601;" href="index.php">Home</a></li>
                <li><a style="color: #de8601;" href="profile.php?id=<?php echo $userId; ?>">Profile</a></li>
                <li><a style="color: #de8601;" href="?action=logout">Logout</a></li>

            <?php }else{ ?>

                <li><a style="color: #de8601;" href="login.php">Login</a></li>
                <li><a style="color: #de8601;" href="register.php">Registration</a></li>
            <?php } ?>
            </ul>
        </div>
    </nav>
