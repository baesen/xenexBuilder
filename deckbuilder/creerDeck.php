<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<html>
  <head>
    <title>Xenex builder</title>
    </head>
    <body>
        <div class ="container">
            <h1 class="text-center">Creer un deck</h1>

            <div class ="container border border-primary border-3 rounded pt-3">
                <form action="create2.php" method="get">

                <div class="form-group">
                    <input type="text" class="form-control" name="nom" placeholder="Nom du deck">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="maker" placeholder="Autheur">
                </div>
                <div class="container text-center">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>

                </form>
            </div>

        </div>
    </body>
</html>