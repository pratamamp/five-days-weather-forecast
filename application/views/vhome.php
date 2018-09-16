<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Forecast</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/fonts/fonts.css" >
    <link rel="stylesheet" href="<?= asset_uri(); ?>css/styles.css" >
    

    <script src="<?= asset_uri(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= asset_uri(); ?>js/bootstrap.min.js"></script>

</head>
<body>
    

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" class="read-more" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= site_url() ?>">Home <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">City<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">List</a></li>
                            
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-green" type="button"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="second-tabs-content weather">
        <div class="container">
            <!-- today foreacast -->
            <div class="row">
                <?php $today_weather = $weather_data->consolidated_weather[0]; 
                      $image_name_state = array('c'=>'clear','lc'=>'light-cloud','hc'=>'heavy-cloud','s'=>'showers','lr'=>'light-rain','hr'=>'heavy-rain','t'=>'thunderstorm','h'=>'hail');

                      $item_img = $image_name_state[$today_weather->weather_state_abbr];
                ?>
                <div class="col-md-12">
                    <div class="section-heading">
                        <img src="<?= asset_uri().'image/'.$item_img.'.png'?>" class="today-img">
                        <div class="header-temp"><?= round($today_weather->the_temp,0) ?>&#176;
                            <div class="today-minmax"><span class="min-color"><?= round($today_weather->min_temp,0) ?>&#176;</span> / <span class="max-color"><?= round($today_weather->max_temp,0) ?>&#176;</span></div>
                        </div>
                    </div>
                    <div class="today-state min-color"><?= $today_weather->weather_state_name; ?></div>
                </div>
            </div>

            <!-- 5 days forecast -->
            <div class="row">
                <div class="wrapper">
                    <div class="col-md-12">
                        <div class="row">
                            <ul class="tabs clearfix" data-tabgroup="second-tab-group">
                                <?php for ($i=1; $i < count($weather_data->consolidated_weather); $i++) { 
                                        $item_day = $weather_data->consolidated_weather[$i];
                                        $day_name = date('l ', strtotime($item_day->applicable_date));
                                        $item_img = $image_name_state[$item_day->weather_state_abbr];
                                ?>
                                <li class="col-md-15 col-sm-12 col-xs-12">
                                    
                                    <div class="list-item min-color"> 
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
            </div>
        </div>
    </div>
</body>
</html>