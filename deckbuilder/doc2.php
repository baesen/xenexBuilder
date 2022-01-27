<?php

  include 'bd_connect.php';
  $sql = 'SELECT pseudo FROM users';

  $result = mysqli_query($conn,$sql);

  $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($conn);

?>

<!DOCTYPE HTML>
<html>
  <h1>Database</h1>
  <?php
  foreach($res as $key => $value)
  {
    echo $value['pseudo'];
    echo '<br>';
  }

  //print_r($u);
  ?>
  <?php
    echo $_GET["name"];
?>

</html>