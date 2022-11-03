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

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.5.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style2.css">
<!--<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet" type='text/css'>-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Kreon&display=swap" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="icon" href="img/ordenador-personal.png" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: rgb(110, 143, 181);">
	<a class="navbar-brand" href="index.php">
		<?xml version="1.0" encoding="iso-8859-1"?>
<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) -->
 		<img src="img/logo-oso.png" height="65px" width="65px">
			F I M E T R O N I C A
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item "><a class="nav-link" href="index.php">Inicio</a></li>
			<li class="nav-item "><a class="nav-link" href="Contacto.php">Contacto</a></li>
		<!--	<li class="nav-item "><a class="nav-link" href="Galería.html">Videos</a></li> 
			<li class="nav-item "><a class="nav-link" href="Descargas.html">Equipo 2</a></li> -->
			<li class="nav-item active"><a class="nav-link" href="Productos.php">Productos</a></li>
		 </ul>
	</div>
			 	   <a href="checkout.php" class="btn position-relative" aling="right">
            <img src="img/carrito.png" height="40px"><span id="num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light"><?php echo $num_cart; ?></span>
        </a>
</nav>


<main>
    
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-1 align-items-center rounded border shadow-lg">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1">Productos de Fimetronica</h1>
        <p class="lead">En este apartado estan todos los Productos que ofrecemos al consumidor</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden">
          <img class="rounded-lg-3" src="https://iconape.com/wp-content/files/hi/194343/svg/194343.svg" alt="" width="720">
      </div>
    </div>
  </div>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($resultado as $row) { ?> 
      <div id="Cartas" class="col mb-3">
            <div data-aos="zoom-in-up" data-aos-duration="1000" class="card shadow-sm">
                <?php

                  $id = $row['id'];
                  $imagen = "img/Productos/" . $id . "/principal.jpg";

                  if(!file_exists($imagen)) {
                    $imagen = "img/no-photo.jpg";
                  }
                ?>
             
              <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>"><img src="<?php echo $imagen; ?>" class="d-block w-100" height="350px"></a>
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                <p class="cartd-text"><?php echo number_format($row['precio'], 2, '.' , ','); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                  
                </div>
                <button data-bs-toggle="modal" data-bs-target="#carritoModal"  class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al Carrito</button>
              </div>

            </div>
          </div>
        </div>
        <?php } ?>  
        </div>
</main>

<!-- Modal -->
<div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="carritoModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Se agrego al Carrito!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>  

<script>
    function addProducto(id, token) {
        let url = 'clases/carrito.php'
        let formData = new FormData()
        formData.append('id', id)
        formData.append('token', token)

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
            }
        })
    }
</script>
 
<script>

    var option =
    {
        animation : true,
        delay : 2000
    };
    
    function Toasty ()
    {
        var toastHTMLElement = document.getElementById( "liveToast" );
        
        var toastElement = new bootstrap.Toast( toastHTMLElement, option );
        
        toastElement.show();
    }
</script>    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
    
</body>
</html>
