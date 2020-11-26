<?php
include("database.php");

function fetch_data(){
 global $conn;
  $query="SELECT * from user_details ORDER BY id DESC";
  $exec=mysqli_query($conn, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$fetchData= fetch_data();
show_data($fetchData);
?>

<?php
function show_data($fetchData){
 echo '<table border="1">
        <tr>
            <th>S.N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>Role</th>
        </tr>';

 if(count($fetchData)>0){
      $sn=1;
      foreach($fetchData as $data){ 

  echo "<tr>
          <td>".$sn."</td>
          <td>".$data['name']."</td>
          <td>".$data['email']."</td>
          <td>".$data['phone']."</td>
          <td>".$data['city']."</td>
          <td>".$data['role']."</td>

   </tr>";
       
  $sn++; 
     }
}else{
     
  echo "<tr>
        <td colspan='7'>No Data Found</td>
       </tr>"; 
}
  echo "</table>";
}


?>
