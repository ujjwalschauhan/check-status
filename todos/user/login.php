<?php
require('db.php');

$errors = [];

if (isset($_POST['login'])) {

    if (empty($_POST['email'])) {
        $errors['email'] = "You must fill in the email";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "You must fill in the password";
    }
    if (empty($errors)) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $encript_password = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$encript_password' ";
        $result = mysqli_query($conn, $sql);
        $check = mysqli_fetch_array($result);
        if (isset($check)) {
            
            session_start();
            $_SESSION["user_id"] = $check['id'];
            if (isset($_SESSION["user_id"])) {
            header('location: index.php?login successfully');
            }
            // echo 'success';
        } else {
            header('location: login.php?invalid email or password');
            echo 'failure';
        }

        
    }
}

?>

<?php
require('header.php');
?>
<div class="container">

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
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
        <button type="submit" name="login" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
require('footer.php');
?>