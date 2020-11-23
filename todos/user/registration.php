<?php
require('db.php');
$errors = [];

if (isset($_POST['register'])) {

    if (empty($_POST['username'])) {
        $errors['username'] = "You must fill in the username";
    }
    if (empty($_POST['email'])) {
        $errors['email'] = "You must fill in the email";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "You must fill in the password";
    }
    if (empty($errors)) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $encript_password = md5($password);
        // echo $encript_password;
        // die();
        $sql = "INSERT INTO users (name,  email, password) VALUES ('$username', '$email' ,'$encript_password')";
        mysqli_query($conn, $sql);
        header('location: login.php');
        exit;
    }
}

?>

<?php
require('header.php');
?>
<div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       
        <div class="form-group">
            <label for="username" class="row-sm-2">Username:</label>
            <input type="text" class="row-sm-2 form-control" name="username" id="username" placeholder="Enter username" value="<?php echo  isset($_POST['username']) ?  $_POST['username'] : ''; ?>">
            <span><?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
        </div>
        <div class="form-group">
            <label for="email" class="row-sm-2">Email:</label>
            <input type="text" class="row-sm-2 form-control" name="email" id="email" placeholder="Enter email address" value="<?php echo  isset($_POST['email']) ?  $_POST['email'] : ''; ?>">
            <span><?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
        </div>
        <div class="form-group">
            <label for="password" class="row-sm-2">Password</label>
            <input type="password" class="row-sm-2 form-control" name="password" id="password" placeholder="Password" value="<?php echo  isset($_POST['password']) ?  $_POST['password'] : ''; ?>">
            <span><?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <button type="submit" name="register" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
require('footer.php');
?>