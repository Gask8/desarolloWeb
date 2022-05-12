<?php include './include/header.php';?>

<?php
  $juego = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if( isset($_SESSION['uid']) ){
        $juegoid=$_POST["juego"];
        $userid=$_SESSION["uid"];

        $con=mysqli_connect("localhost","root","","proyectofinal");

        // Check connection
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        mysqli_query($con,"INSERT INTO carrito (`id_usuario`, `id_producto`)
        VALUES ('$userid','$juegoid')");

        echo "<div class='alert alert-success' style='text-align: center;'>
        <strong>Exito!</strong> Se ha añadido el juego a tu carrito.
        <a class='btn btn-primary' href='carrito.php'>Ir a Carrito</a>
        </div>";

        mysqli_close($con);
  } else {
    echo "<div class='alert alert-danger' style='text-align: center;'>
    <strong>Error!</strong> Debes estar registrado.
    <a class='btn btn-primary' href='signUp.php'>Registrarte</a>
    </div>";
  }
}
?>


<?php
  $con=mysqli_connect("localhost","root","","proyectofinal");

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $result = mysqli_query($con,"SELECT * FROM productos;");

  mysqli_close($con);

?>

<div class="container">
    <div class="row vertical-offset-100">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Toda la Informacion</h3>
        </div>
          <div class="panel-body">
            <form accept-charset="UTF-8" role="form" action="tienda.php" method="post">
            <table class="table">
              <thead class="thead-dark">
            <tr>
            <th scope="col"></th>
            <th scope="col">Foto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Plataforma</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            </tr>
             </thead>
             <tbody>
            <?php while($row = mysqli_fetch_array($result)) {
              $urlimg = "./img/covers/".$row['fotos'];
              echo "<tr>";
              echo "<th><input type='radio' id='juego".$row['id']."' name='juego' value='".$row['id']."'></th>";
              echo "<th><img src='".$urlimg."' alt='juego' width='100' height='120'></th>";
              echo "<th>".$row['nombre']."</th>";
              echo "<th>".$row['descripcion']." - ".$row['fabricante']."</th>";
              echo "<th>".$row['origen']."</th>";
              echo "<th>".$row['precio']."$</th>";
              echo "<th>".$row['noalmacen']."</th>";
              echo "</tr>";
            } ?>
            </tbody>
            </table>
          </div>
          <input class="btn btn-primary" style="position: absolute;right: 25px;margin-top: 20px;" type="submit" value="Añadir al Carrito">
          </form>
      </div>
    </div>
  </div>
</div>

<?php include './include/footer.php';?>
