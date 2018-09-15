<!DOCTYPE html>
<html lang="en">
<head>
	<title>Weather Forecast</title>
	<link rel="stylesheet" type="text/css" href="<?= asset_uri() ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= asset_uri() ?>css/styles.css">
</head>
<body>
	<div class="container">
		<div id="header-widget">
			<div class="row">
				<?php $today_weather = $weather_data->consolidated_weather[0]; ?>
				<div class="today-img">
					<img src="<?=asset_uri()?>image/clear.png">
				</div>
					
			</div>
			<div class="row">
				<div class="left-widget">
					<div class="today-temp"><?= round($today_weather->the_temp,0) ?>&#176;</div>
					<span class="blue"><?= round($today_weather->min_temp,0) ?>&#176;</span> / <span class="red"><?= round($today_weather->max_temp,0) ?>&#176;</span>
				</div>
			</div>
			
			

		</div>
		<div class="row">
			<?php for ($i=1; $i < count($weather_data->consolidated_weather); $i++) { ?> 
				<div class="col widget-box"><?= $i ?> of 5</div>
			<?php } ?>
			
			
		</div>	
	</div>
</body>
</html>