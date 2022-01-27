<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php 

  include 'bd_connect.php';
  $deck = 1;
  if(isset($_GET["deck"]))
  {
    $deck = $_GET["deck"];
  }
  else
  {
    //redirect choice deck
  }

  $sql = 'SELECT * FROM cards';
  $result = mysqli_query($conn,$sql);

  $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($conn);
?>

<html>
  <head>
    <title>Xenex deckmaker</title>
  </head>
  <body>
    <div class ="container">
    <h1 class="text-center"></h1>

    <?= '<table style=\"border:5px solid black;\">' ?>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" ></th>
          <th scope="col" ><a href="test.php?orderby=1" class="btn btn-dark" role="button">Nom</a></th>
          <th scope="col"><a href="test.php?orderby=2" class="btn btn-dark" role="button">Origine</a></th>
          <th scope="col" style="text-align : center"><a href="test.php?orderby=3" class="btn btn-dark" role="button">Danger</a></th>
          <th scope="col" style="text-align : center"><a class="btn btn-dark">info</a></th>
        </tr>
      </thead>
      <tbody>

      <?php
        foreach($res as $key => $card)
        {
          echo '<tr>';
          echo "<th scope = \"row\">{$key}</th>";
    
          echo '<td>'; echo $card['nom']; echo '</td>';
          echo '<td>'; echo $card['origine']; echo '</td>';
          echo '<td style="text-align : center">'; echo $card['danger']; echo '</td>';
          echo '<td style="text-align : center">'; $ref = "info.php?{$card['nom']}"; echo "<a href=\"$ref\" class=\"btn btn-light\" role=\"button\">Info</a></td>";

          echo '</tr>';
        }
        //<div class="d-inline p-2 bg-dark text-white">d-inline</div>

      ?>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Creer un monstre</a>

  </div>
</html>