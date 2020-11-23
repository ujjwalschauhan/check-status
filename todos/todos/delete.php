
<?php if (isset($_POST['del_task'])) {
  $id = $_POST['del_task'];
  mysqli_query($conn, "DELETE FROM tasks WHERE id=" . $id);
  header('location: index.php?deleted=true');
  exit;
}
require('header.php');