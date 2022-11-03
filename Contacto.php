<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con =$db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

//session_destroy();

//print_r($_SESSION);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>	
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.5.1.min.js"> </script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Kreon&display=swap" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/23516debb3.js" crossorigin="anonymous"></script>
	<link rel="icon" href="img/ordenador-personal.png" type="image/png">



</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: rgb(110, 143, 181);">
	<a class="navbar-brand" href="index.php">
		<?xml version="1.0" encoding="iso-8859-1"?>
 		<img src="img/logo-oso.png" height="65px" width="65px">
				F I M E T R O N I C A
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
			<li class="nav-item active "><a class="nav-link" href="Contacto.php">Contacto</a></li>
	<!--		<li class="nav-item "><a class="nav-link" href="Galería.html">Videos</a></li>
			<li class="nav-item "><a class="nav-link" href="Descargas.html">Equipo 2</a></li> -->
			<li class="nav-item "><a class="nav-link" href="Productos.php">Productos</a></li>
		 </ul>
	</div>
	   <a href="checkout.php" class="btn position-relative" aling="right">
            <img src="img/carrito.png" height="40px"><span id="num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light"><?php echo $num_cart; ?></span>
        </a>
</nav>
<!--HASTA AQUI COPEAR -->

<!--REDES-->
<br><br>
<div class="texto-titulo">
		<h1> ¡Tu opinión nos interesa! </h1>
		<h2> Escríbenos </h2>
</div>

<div class="Redes-container">
	<ul>
		<li>
			<a href="https://www.facebook.com/GEIASFIME" target="_BLANK" class="facebook">
				<i class="fab fa-facebook-square"></i>
			</a>	
		</li>
		<li>
			<a href="https://twitter.com/FIME_Oficial" target="_BLANK" class="twitter">
				<i class="fab fa-twitter"></i>
			</a>
		</li>
		<li>
			<a href="https://instagram.com/geiasfime?igshid=cgsrtcgmcu9y" target="_BLANK" class="instagram">
				<i class="fab fa-instagram"></i>
			</a>	
		</li>
		<li>
			<a href="https://www.youtube.com/channel/UCFu1vkownvHVpzXnQ617GsA" target="_BLANK" class="youtube">
				<i class="fab fa-youtube"></i>
			</a>	
		</li>
	</ul>
</div>

<!--COMENTARIOS-->
<div class="container">
<form method="post">
	<input type="text" name="name" id="name" class="name" placeholder="NOMBRE">
	<input type="text" name="mail" id="mail" class="email" placeholder="CORREO">
	<textarea name="message" class="message" placeholder="MENSAJE ... " id="message"></textarea>
			<div class="col-md-8"> 
</div>
</form>
		<br>
        <div class="clear"></div>
    <div class="d-grid gap-3 col-1 mx-auto">
        <button data-bs-toggle="modal" data-bs-target="#contactoModal" type="submit" class="btn btn-primary">ENVIAR</button>
    </div>

</div>

</div>
<br><br><br>

<!-- Modal -->
<div class="modal fade" id="contactoModal" tabindex="-1" aria-labelledby="contactoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactoModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Se envio tu Opinion!!<br>
      </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>  

<FOOTER>
	<h2 class="titulo-final"> FACULTAD DE INGENIERÍA MECÁNICA Y ELÉCTRICA | EQUIPO 2 </h2>
</footer>	

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    
</body>
</html>