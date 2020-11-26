<?php require_once "validations.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status === "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "Dashboard | ". $fetch_info['name'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<nav class="navbar">
        <a class="navbar-brand" href="/includes/index.php"><img src="/includes/circle-cropped.png" alt="todoLogo" width="50px" height="50px"></a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>

<h1>Welcome <?php echo $fetch_info['name']."!" ?></h1> 


