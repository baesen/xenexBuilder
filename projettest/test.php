<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<html>
  <head>
    <title>Test PHP</title>
  </head>
  <body>
    <div class ="container">
    <h1 class="text-center">Catalogue</h1>

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

        include 'bd_connect.php';
        $by = 'nom';
        if(isset($_GET["orderby"]))
        {
          if($_GET["orderby"] == 1)$by = 'nom';
          else if($_GET["orderby"] == 2)$by = 'origine';
          else if($_GET["orderby"] == 3)$by = 'danger';
        }

        $sql = 'SELECT * FROM monstre ORDER BY '.$by;
        //$sql = 'SELECT * FROM monstre ORDER BY nom';
        $result = mysqli_query($conn,$sql);

        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);

        foreach($res as $key => $mob)
        {
          echo '<tr>';
          echo "<th scope = \"row\">{$key}</th>";
    
          echo '<td>'; echo $mob['nom']; echo '</td>';
          echo '<td>'; echo $mob['origine']; echo '</td>';
          echo '<td style="text-align : center">'; echo $mob['danger']; echo '</td>';
          echo '<td style="text-align : center">'; $ref = "info.php?{$mob['nom']}"; echo "<a href=\"$ref\" class=\"btn btn-light\" role=\"button\">Info</a></td>";

          echo '</tr>';
        }

      ?>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Creer un monstre</a>

  </div>
</html>