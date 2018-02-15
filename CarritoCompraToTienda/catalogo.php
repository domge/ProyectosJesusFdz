<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda de Pepe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      #CarritoCompra{position:fixed;right:0;top:0;background-color:#333;color:white;max-height:400px;overflow-y:auto;}    
    </style>
  </head>

  <body>
    <?php require 'cargarProductos.php';?>
    <div class="jumbotron text-center">
      <h1>Tienda de Pepe</h1>
    </div>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>      
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <li><a href="#" onclick="ListarCarroCompraUsandoAjax()">Ver Carrito</a></li>
        </ul>
      </div>
    </nav>


    <div class="container">
      <div class="row">
        <?php
          $arrlength = count($ListaProductos);
          for($x = 0; $x < $arrlength; $x++) {
        ?>

        <div class="col-sm-4">
          <h3><?php echo $ListaProductos[$x]->Nombre ?></h3>      
          <img class="img-responsive" src="<?php echo $ListaProductos[$x]->Imagen ?>" alt="<?php echo $ListaProductos[$x]->Nombre ?>">
          <p><?php echo $ListaProductos[$x]->Precio ?></p>
          <p>
            <button type="button" class="btn btn-default btn-sm" onclick="anadirCarro(<?php echo $ListaProductos[$x]->codProducto ?>)">
              <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
            </button>
          </p>
        </div>
        <?php  
          }
        ?>
      </div>
    </div>

    <script src="funciones.js"></script>
    <div id="CarritoCompra">
    </div>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </body>
</html>