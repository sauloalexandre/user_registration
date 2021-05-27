<?php
$url= 'http://maps.google.com/maps/api/geocode/json?address='.$endereco.'&sensor=false';
$geocode= file_get_contents($url);
$output= json_decode($geocode);

#	Se não foi possível carregar o mapa, então mostra mensagem
if(!isset($output->results[0]) ) { ?>

	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Alerta!</strong> Parece que não foi possível carregar o mapa, verifique se o endereço cadastrado está correto.
	</div>

<?php } else {#	Senão, mostra o mapa ?>
	
	<?php
	$lat = $output->results[0]->geometry->location->lat;
	$long = $output->results[0]->geometry->location->lng;
	$mapa= $lat.",".$long;
	?>


	<script type="text/javascript">
		function initialize() {
			var latlng = new google.maps.LatLng(<?php echo $mapa; ?>);
			var opt = 
				{
					center:latlng
					, zoom:16
					, mapTypeId: google.maps.MapTypeId.ROADMAP
					, disableAutoPan:false
					, navigationControl:true
					, navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL }
					, mapTypeControl:true
					, mapTypeControlOptions: {style:google.maps.MapTypeControlStyle.DROPDOWN_MENU}
				};


			var map = new google.maps.Map(document.getElementById("map"),opt);
			var marker= new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo $mapa; ?>)
				, clickable: true
				, map: map
				, icon: 'img/ic_mapa.png'
				, title: "teste"
			});


			var infiwindow = new google.maps.InfoWindow(
			{
				content:'<div style="max-width:400px;">'+
									'<div style="float:left; width:35%; text-align:center;">'+
										'<img src="<?php echo $legenda["foto"]; ?>"/>'+
									'</div>'+
									'<div style="float:left; width:65%;">'+
										'<strong><?php echo $legenda["nome"]; ?></strong>'+
										'<br /><?php echo $legenda["endereco"]; ?>.'+
									'</div>'+
								'</div>'
			});


			google.maps.event.addListener(marker,'click',function(){
				infiwindow.open(map,marker);
			});

			infiwindow.open(map,marker);

		}
	</script>


	<style type"text/css">
		#map {
			width:99%;
			height:500px;
			border: solid 4px #EFEFEF;
			margin: 0px 0px 0px 0px;
			padding:0px;
			text-align:left;
		}
	</style>


	<div id="map"></div>


	<script type="text/javascript">
		initialize();
	</script>


<?php }//fim mapa ?>