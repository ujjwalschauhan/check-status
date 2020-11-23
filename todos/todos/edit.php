<?php
$errors = [];
require('db.php');
$id = $_POST['task_id'];
$priorities = array(1 => "High", 2 => "Medium", 3 => "Low");

// updating task
if (isset($_POST['edit'])) {
  $sql = "select * from tasks where id=" . $id;
  $task_record = mysqli_query($conn, $sql);
  $task_array = mysqli_fetch_array($task_record);
}

if (isset($_POST['update'])) {
  if (empty($_POST['task'])) {
    $errors['task'] = "Title can't be empty!";
  }

  if (empty($_POST['description'])) {
    $errors['description'] = "Description can't be empty!";
  }

  if (empty($_POST['date'])) {
    $errors['date'] = "Due Date can't be empty!";
  }

  if (!empty($_POST['priority'])) {
    $priority = $_POST['priority'];
  }
  if (empty($errors)) {
    $task = $_POST['task'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $priority = $_POST['priority'];
    $sql = "UPDATE tasks set task= '$task', description = '$description', due_date = '$date', priority = '$priority' where id =" . $id;
    mysqli_query($conn, $sql);
    header('location: index.php');
  }
}
require('header.php');
?>

<body>
  <div class="container">
    <form method="post" action="">
      <input type="hidden" name="task_id" value=<?php echo ('"' . $id . '"') ?>>
      <div class="form-group">
        <label for="task">Title</label>
        <input type="text" class="form-control" name="task" id="task" value="<?php echo isset($_POST['task']) ?  $_POST['task'] : $task_array['task']; ?>">
        <span><?php echo isset($errors['task']) ? $errors['task'] : '' ?></span>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="<?php echo isset($_POST['description']) ?  $_POST['description'] : $task_array['description']; ?>">
        <span><?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
      </div>
      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo  isset($_POST['date']) ?  $_POST['date'] : $task_array['due_date']; ?>">
        <span><?php echo isset($errors['date']) ? $errors['date'] : '' ?></span>
      </div>
      <div class="form-group">
        <label for="Priority">Priority:</label>
        <select name="priority" id="priority">
          <?php foreach ($priorities as $index => $value) { ?>
            <option value="<?php echo $index ?>" <?php echo ($index == $task_array['priority']) ? 'selected' : '' ?>><?php echo $value ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" name="update" id="update" class="btn btn-primary btn-lg btn-block">Update</button>
    </form>
  </div>
</body>
<?php
require('footer.php');
?>
