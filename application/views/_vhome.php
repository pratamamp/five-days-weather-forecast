<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Forecast</title>
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/font/fonts.css" >
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/styles_misc.css" >

    <script src="<?= asset_uri(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= asset_uri(); ?>js/bootstrap.min.js"></script>

</head>
<body>
    
        <div class="container">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div id="main-nav" class="collapse navbar-collapse">
                        <ul class="menu-first nav navbar-nav" style="margin-right: 20px;">
                            <li class="active"><a href="#">Home</a></li>                                
                        </ul>
                        <div class="input-group md-form form-sm form-1 pl-0">
    <div class="input-group-prepend">
        <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fa fa-search text-white" aria-hidden="true"></i></span>
    </div>
    <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
</div>                                    
                    </div>
                </div>
            </nav>
        </div>
        
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
                       <div class="col-md-6 heading-temp">
                            <?= round($today_weather->the_temp,0) ?>&#176;
                       </div>
                       <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 today-minmax"><span class="min-color"><?= round($today_weather->min_temp,0) ?>&#176;</span> / <span class="max-color"><?= round($today_weather->max_temp,0) ?>&#176;</span></div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
           
                    <div class="row">
                        <ul class="tabs clearfix">
                            <?php for ($i=1; $i < count($weather_data->consolidated_weather); $i++) { 
                                    $item_day = $weather_data->consolidated_weather[$i];
                                    $day_name = date('l ', strtotime($item_day->applicable_date));
                                    $image_name_state = array('c'=>'clear','lc'=>'light-cloud','hc'=>'heavy-cloud','s'=>'showers','lr'=>'light-rain','hr'=>'heavy-rain','t'=>'thunderstorm','h'=>'hail');
                                    $item_img = $image_name_state[$item_day->weather_state_abbr];
                            ?>
                            <li class="col-md-15">
                                <div class="list-item">
                                    <h4><?= $day_name ?></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="<?= asset_uri().'image/'.$item_img.'.png'?>" class="cons-img" >
                                        </div>
                                        <div class="col-md-6">
                                            <p class="small-text min-color"><?=round($item_day->min_temp,0); ?>&#176;</p>
                                            <p class="small-text max-color"><?=round($item_day->max_temp,0); ?>&#176;</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                
        </div>
    </div>
    

    <script src="js/vendor/jquery-1.11.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>


    <script type="text/javascript">
    $(document).ready(function() {
        
        // mobile nav toggle
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });
    </script>
</body>
</html>