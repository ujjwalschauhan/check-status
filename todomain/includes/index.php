<?php
/*including database connection file */
session_start();

include_once('db.php'); 
include_once('header.php');
include('delete.php');
$priorities = array("high" => "High", "moderate" => "Moderate", "low" => "Low");
$errors = [];

if (isset($_POST['createTodo'])) {

  if (empty($_POST['task'])) {
    $errors['task'] = "Title can't be empty and MUST be unique!";
  }

  if (empty($_POST['description'])) {
    $errors['description'] = "Description can't be empty!";
  }
  if (isset($_POST['date'])) {
    $currentdate = new DateTime('Today');
    $userdate = new DateTime($_POST['date']);
    if ($currentdate > $userdate)
      $errors['date'] = "Due Date can't be empty!</b>";
  }
  if (!empty($_POST['priority'])) {
    $priority = $_POST['priority'];
  }
  if(!empty($_POST['status'])){
    $status =$_POST['status'];
  }
  if (empty($errors)) {

    $task = $_POST['task'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `tasks` (`task`, `description`, `priority`, `due_date`, `status`, `user_id`) VALUES ('$task', '$description', '$priority', '$date', '$status' , $)";
    mysqli_query($conn, $sql);
    header('location: index.php?saved=true');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav class="navbar">
            <a class="navbar-brand" href="../home.php"><img src="/includes/circle-cropped.png" alt="todoLogo" width="50px" height="50px"></a>
            <a class="signup-time"><button type="button" class="btn btn-light"><a href="/user-profile/index.php">update profile</a></button></a>
    </nav> 
    
 <?php
    if (isset($_GET['saved'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?php echo ($_GET['saved']) ? 'todo created successfully!' : ''; ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php }?>
    <?php
    if (isset($_GET['deleted'])) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?php echo ($_GET['deleted']) ? 'Deleted successfully!' : ''; ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<?php }
if (isset($_GET['updated'])) { ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><?php echo ($_GET['updated']) ? 'Updated successfully!' : ''; ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>
<div class="container">
<br><br><br><br><br><br><br>
    <form method="post">               
          <div class="form-group">
          <label for="task">Enter Task Title</label>
          <input type="text" class="form-control" name="task" id="task" >
          <span class="badge badge-danger"><?php echo isset($errors['task']) ? $errors['task'] : '' ?></span>
        </div>
        <div class="form-group ">
          <label for="description">Enter Task Description</label>
          <input type="text" class="form-control" id="description" name="description" value="<?php echo  isset($_POST['description']) ?  $_POST['description'] : ''; ?>">
          <span class="badge badge-danger"><?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
        </div>
        <div class="form-group ">
          <label for="date">Enter Due Date: </label>
          <input type="date" class="form-control" id="date" name="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo  isset($_POST['date']) ?  $_POST['date'] : ''; ?>">
          <span class="badge badge-danger"><?php echo isset($errors['date']) ? $errors['date'] : '' ?></span>
        </div>
        <div class="form-group ">
          <label for="Priority">Choose Priority:</label>
          <select class="form-control" name="priority" id="priority">
            <option value="high">High</option>
            <option value="moderate">Moderate</option>
            <option value="low">Low</option>
          </select><br>

        <div class="text-center">
        <button type="submit" name="createTodo" id="createBtn" class="btn btn-info btn-lg my-2 my-sm-0">Create Task</button>
        </div>
        <br>
    </form>

      <table class="table table-hover table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Due Date</th>
          <th>Priority</th>
          <th>Status</th>
          <th class="text-center" colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $tasks = mysqli_query($conn, "SELECT * FROM tasks ORDER BY priority ASC , due_date DESC");
        $count=1;
        while ($row = mysqli_fetch_array($tasks)) { ?>
          <tr>
            <td> <?php echo $count++;?> </td>
            <td> <?php echo $row['task']; ?> </td>
            <td> <?php echo $row['description']; ?> </td>
            <td> <?php echo $row['due_date']; ?> </td>
            <td class="text-center"><?php echo $row['priority']; ?></td>
            <td><form method="POST" action="status.php">
                <input type="hidden" name="task_id" value=<?php echo $row['id']; ?>>
                <button class="btn btn-outline-primary my-2 my-sm-0"  type="submit" name="status" value="<?php echo $row['status'];  ?>">
                  <?php echo ($row['status'] === '0') ? 'Pending' : ' Done' ?> </button>
                </form>
            </td>
            <td>
              <form action="edit.php" method="post" class="form-inline">
                  <input type="hidden" name="task_id" value=<?php echo $row['id']; ?>>
                  <button type="submit" name="edit" class="btn btn-warning my-2 my-sm-0">Update</button>
              </form>
            </td>
            <td>
                <form method="POST" action="">
                    <button type="submit" name="del_task" class="btn btn-danger my-2 my-sm-0" value= <?php echo $row['id']; ?>>Delete</button>
                </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
<div>
<?php
include_once('footer.php');
?>

