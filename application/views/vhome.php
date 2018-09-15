<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Forecast</title>
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/font/fonts.css" >
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/styles.css" >

</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="wrapper">
                <div class="col-md-12">
                    <div class="row">
                        <?php $today_weather = $weather_data->consolidated_weather[0]; ?>
                        <div class="col-md-4 today-img"></div>
                        <div class="col-md-4 today-img">
                            <img src="<?=asset_uri()?>image/clear.png">
                        </div>
                        <div class="col-md-4 today-img"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-6 today-temp">
                            <?= round($today_weather->the_temp,0) ?>&#176;
                       </div>
                       <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 today-minmax"><span class="blue"><?= round($today_weather->min_temp,0) ?>&#176;</span> / <span class="red"><?= round($today_weather->max_temp,0) ?>&#176;</span></div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="wrapper">
                <div class="col-md-12">
                    <div class="row">
                        <ul class="tabs clearfix">
                            <?php for ($i=1; $i < count($weather_data->consolidated_weather); $i++) { 
                                    $item_day = $weather_data->consolidated_weather[$i];
                                    $day_name = date('l ', strtotime($item_day->applicable_date));
                                    $image_name_state = array('c'=>'clear','lc'=>'light-cloud','hc'=>'heavy-cloud','s'=>'showers','lr'=>'light-rain','hr'=>'heavy-rain','t'=>'thunderstorm','h'=>'hail');
                                    $item_img = $image_name_state[$item_day->weather_state_abbr];
                            ?>
                            <li class="col-md-15 col-sm-12 col-xs-12">
                                <div class="list-item">
                                    <h4><?= $day_name ?></h4>
                                    <hr>
                                    <img src="<?= asset_uri().'image/'.$item_img.'.png'?>" class="cons-img" >
                                </div>
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>