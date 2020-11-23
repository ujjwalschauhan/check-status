<?php
require('db.php');
$priorities = array(1 => "High", 2 => "Moderate", 3 => "Low");
$prioritiesColor = array("1" => "btn btn-danger", "2" => "btn btn-warning", "3" => "btn btn-success");
$errors = [];

if (isset($_POST['createTodo'])) {

  if (empty($_POST['task'])) {
    $errors['task'] = "Title can't be empty!";
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

    $sql = "INSERT INTO tasks (task, description, due_date, priority, user_id) VALUES ('$task', '$description' , '$date', '$priority','$user_id')";
    mysqli_query($conn, $sql);
    header('location: index.php?saved');
  }
}
?>
<?php require('delete.php'); ?>

<body>

  <div class="container">
  <nav class="navbar navbar-dark bg-dark">
        <div class="d-flex justify-content-center">
          <h2 class="text-light">Todo App</h2>
        </div>
</nav>
    <?php
    if (isset($_GET['saved'])) {
    ?>
      <p class="alert alert-success"><?php echo ($_GET['saved']) ? 'todo saved successfully!' : ''; ?></p>
    <?php
    }
    if (isset($_GET['deleted'])) {
    ?>
      <p class="alert alert-success"><?php echo ($_GET['deleted']) ? 'todo deleted successfully!' : ''; ?></p>
    <?php
    }
    if (isset($_GET['updated'])) {
    ?>
    <p class="alert alert-success"><?php echo ($_GET['updated']) ? 'todo updated successfully! ' : '' ; ?></p>
    <?php
    }
    ?>
    <form method="post">

      <div class="form-group">
      <div><br></div>
        <label for="task">Task Title</label>
        <input type="text" class="form-control" name="task" id="task" >
        <span class="badge badge-danger"><?php echo isset($errors['task']) ? $errors['task'] : '' ?></span>
      </div>
      <div class="form-group">
        <label for="description">Enter Task Description</label>
        <input type="text" class="form-control" id="description" name="description" value="<?php echo  isset($_POST['description']) ?  $_POST['description'] : ''; ?>">
        <span class="badge badge-danger"><?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
      </div>
      <div class="form-group">
        <label for="date">Enter Due Date: </label>
        <input type="date" class="form-control" id="date" name="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo  isset($_POST['date']) ?  $_POST['date'] : ''; ?>" required>
        <span class="badge badge-danger"><?php echo isset($errors['date']) ? $errors['date'] : '' ?></span>
      </div>
      <div class="form-group">
        <label for="Priority">Choose Priority:</label>
        <select class="form-control" name="priority" id="priority">
          <option value="1">High</option>
          <option value="2">Moderate</option>
          <option value="3">Low</option>
        </select>
      </div>

      <div class="text-center">
      <button type="submit" name="createTodo" id="add_btn" class="btn btn-outline-success my-2 my-sm-0">Create Todo</button>
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
        $tasks = mysqli_query($conn, "SELECT * FROM tasks");

        $count=1;
        while ($row = mysqli_fetch_array($tasks)) { ?>
          <tr>
            <td> <?php echo $count++;?> </td>
            <td> <?php echo $row['task']; ?> </td>
            <td> <?php echo $row['description']; ?> </td>
            <td> <?php echo $row['due_date']; ?> </td>
            <td class="text-center"><?php echo $priorities[$row['priority']]; ?></td>
            <td><form method="POST" action="status.php">
                <input type="hidden" name="task_id" value=<?php echo $row['id']; ?>>
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="status" value="<?php echo $row['status'];  ?>">
                  <?php echo ($row['status'] === '0') ? 'Pending' : ' Done' ?> </buton>
                </form>
            </td>
            <td>
              <form action="edit.php" method="post" class="form-inline">
                <input type="hidden" name="task_id" value=<?php echo $row['id']; ?>>
                <button type="submit" name="edit" class="btn btn-outline-warning my-2 my-sm-0">Update</button>
              </form>
            </td>
            <td>
                <form method="POST" action="">
                  <button type="submit" name="del_task" value=<?php echo $row['id']; ?> class="btn btn-outline-danger my-2 my-sm-0">Delete</button>
                </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <!--/div-->
<?php
require('footer.php');
?>
