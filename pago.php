<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con =$db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;


$lista_carrito = array();

if ($productos !=null){
    foreach ($productos as $clave => $cantidad){

        $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: Productos.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.5.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
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
    <title>PAGO</title>
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
            <img src="img/carrito.png" height="40px"><span id="num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light"><?php echo $num_cart; ?></span>
        </a>
</nav>


<main>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h4>Detalles de Pago</h4>
                <div id="paypal-button-container"></div>
            </div>
            
            <div class="col-6">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>PRODUCTO</th>
                            <th>SUBTOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($lista_carrito == null) {
                            echo '<tr><td colspan="5" class="h2 text-center"><b>Lista Vacia</b></td></tr>'; 
                        } else {
                            $total = 0;
                            foreach($lista_carrito as $producto){
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $cantidad = $producto['cantidad'];
                                $subtotal = $cantidad * $precio;
                                $total += $subtotal;
                           ?>
                        
                        <tr>
                            <td><?php echo $nombre ?></td>
                            <td>
                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo 
                                MONEDA . number_format($subtotal, 2, '.',','); ?></div>
                            </td>
                        </tr>
                        <?php } ?>

                        <tr>
                            </td>
                            <td><h3>TOTAL</h3></td>
                            <td colspan="2">
                                <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                            </td>
                        </tr>
                    </tbody>
                        <?php } ?>
                 </table>
                </div>

            </div>
        </div>
    </div>
</main>

 <script src="https://www.paypal.com/sdk/js?client-id=AfVypyWXelbpBILVajsQwui91p4_6MFKo3TdhFMDxtQTavj_zFFK4i5Yw-McMjR_ZJaPGSBi3usNG9q5&currency=MXN"></script>

	<script>
		paypal.Buttons({
			style:{
				color: 'blue',
				shape: 'pill',
				label: 'pay'
			},
			createOrder: function(data, actions){
				return actions.order.create({
					purchase_units: [{
						amount: {
							value: <?php echo $total; ?>
						}
					}]
				});
			},

			onApprove: function(data, actions){
			    let URL = 'clases/captura.php'
				actions.order.capture().then(function (detalles){
				    
                   
                   console.log(detalles)
                   
                    let url = 'clases/captura.php'
                    
                   return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })
                    }).then(function(response){
                        window.location.href = "completado.php";  
                    }) 
				});
			},

			onCancel: function(data){
				alert("Pago Cancelado");
				console.log(data);
			}
		}).render('#paypal-button-container');
	</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    
</body>
</html>