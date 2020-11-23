<?php
include_once('db.php');
include_once('header.php');
$errors = [];

if (isset($_POST['register'])) {

    if (empty($_POST['username'])) {
        $errors['username'] = "username can't be empty";
    }
    if (empty($_POST['email'])) {
        $errors['email'] = "email can't be empty";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Password can't be empty";
    }
    if (empty($errors)){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwd = $_POST['password'];
        $encryptedPasswd= password_hash($passwd, PASSWORD_BCRYPT);
        $token= bin2hex(random_bytes(8));



        $sql = "INSERT INTO users (name, email, password, token, status) VALUES ('$username', '$email' ,'$EncryptedPassword', '$token', 'inactive')";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0){
            echo "email aleardy exists";
        }

        else {

        if($res)
         {
             $subject= 'Email Activation Link!';
             $body= 'Click on this link to activate your account http://todomain.test/activate.php?token='.$token;
             $headers = 'From: 4325uschauhan@gmail.com' . "\r\n" .
             'Reply-To: 4658uschauhan@gmail.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

             if(mail($email, $subject, $body, $headers)){
                 $_SESSION['msg']= "check your email to activate your account $email ";
                 header('location:login.php');
             } else {
                 echo "Email sending failed...";
             }

      header('location: login.php');
    }
}

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- login form navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Todo</a>
            <div class="navbar" id="navbarCol">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                </ul>

            </div>
    </div>
</nav>

<div class="container">
<div class="login-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>NEW USER REGISTRATION</strong></div>
                    <div class="card-body">

                        <form class="form-horizontal" method="post" action="">

                            <div class="form-group">
                             <label for="username" class="cols-sm-2 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your Username" required/>
                                     </div>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button name="regstrBtn" type="button" class="btn btn-outline-success btn-lg  login-button">submit</button>
                        </div>
                        <div class="login-register">
                            <a href="index.php"></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
