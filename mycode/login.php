<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>login</title>
</head>
<body>
<!-- login form navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Todo</a>
            <div class="navbar" id="navbarCol">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registration.php">Register</a>
                    </li>
                </ul>

            </div>
    </div>
</nav>
<!-- boostrap card for form -->
<div class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">MEMBER LOGIN</div>
                        <div class="card-body">

                            <!-- FORM -->
                            <form action="login.php" method="GET">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Enter Username
                                    <span style="color:red"><b>*</b></span></label>
                                    <div class="col-md-6">
                                        <input type="username" id="username" class="form-control" name="username" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Enter Email
                                    <span style="color:red"><b>*</b></span></label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Enter Password
                                    <span style="color:red"><b>*</b></span></label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <div class="text-center">
                                       <button type="submit" class="btn btn-success btn-md  login-button">
                                            Login
                                       </button> 
                                    </div>
                                </div>
                            </form>
                       </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>