<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con =$db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    echo 'Error al procesar la petición';
    exit;
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp) {

        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) {

            $sql = $con->prepare("SELECT nombre, Descripción, precio, info, enlaces FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $Descripción = $row['Descripción'];
            $Informacion = $row['info'];
            $enlaces = $row['enlaces'];
            $precio = $row['precio'];
            $dir_images = 'img/Productos/'.$id.'/';

            $rutaImg = $dir_images . 'principal.jpg';

            if(!file_exists($rutaImg)){
                $rutaImg = 'img/no-photo.jpg';
            }

            $imagenes = array();
            $dir = dir($dir_images);
            
            while (($archivo = $dir->read()) != false) {
                if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
                    $imagenes[] = $dir_images . $archivo;
                }
            }
            $dir->close();
        }

    } else {
        echo 'Error al procesar la petición';
        exit;
    }
    
}

$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

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
<link rel="icon" href="img/ordenador-personal.png" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETALLES DEL PRODUCTO</title>
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
			<li class="nav-item "><a class="nav-link" href="Productos.php">Productos</a></li>
		 </ul>
	</div>
	   <a href="checkout.php" class="btn position-relative" aling="right">
            <img src="img/carrito.png" height="40px"><span id="num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning"><?php echo $num_cart; ?></span>
        </a>
</nav>


<main>
    
    <div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-md4 oreder-md-1">
                <img src="<?php echo $rutaImg; ?>" aling="center"height="350px" ="FOTO">
            </div>
            <div class="col-md4 oreder-md-3">
                <h2><?php echo $nombre; ?></h2>
                <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h2>
                <p id="descripcionpro" class="lead">
                    <?php echo $Descripción; ?>
                </p>
                           <div class="d-grid gap-6 col-10 mx-auto">
                    <a href="pago.php" class="btn btn-primary" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Comprar Ahora</a>
                    <button data-bs-toggle="modal" data-bs-target="#carritoModal" class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al Carrito</button>
                    
                    <!--data-bs-toggle="modal" data-bs-target="#pagoModal -->
                </div>
    </div>
  </div>

            </div>
            
             <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"></h1>
        <p class="col-md-8 fs-4"><?php echo $Informacion; ?></p>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
          <?php foreach($imagenes as $img) ?>
        <div class="h-100 p-5 text-bg-dark rounded-3">
           <img src="<?php echo $img; ?>" aling="center"height="350px" ="FOTO">
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
           <?php echo $enlaces; ?> 
        
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022
    </footer>
  </div>

        </div>


    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="pagoModal" tabindex="-1" aria-labelledby="pagoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pagoModalLabel">Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Su Pago se realizo con Exito!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>  

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    
    
</body>
</html>