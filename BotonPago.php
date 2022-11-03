<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Boton</title>


	<!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AfVypyWXelbpBILVajsQwui91p4_6MFKo3TdhFMDxtQTavj_zFFK4i5Yw-McMjR_ZJaPGSBi3usNG9q5&currency=MXN"></script>
</head>
<body>	
	<div id="paypal-button-container"></div>


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
							value: 100
						}
					}]
				});
			},

			onApprove: function(data, actions){
				actions.order.capture().then(function (detalles){
					window.location.href="completado.html"
				});
			},

			onCancel: function(data){
				alert("Pago Cancelado");
				console.log(data);
			}
		}).render('#paypal-button-container');
	</script>

</body>
</html>