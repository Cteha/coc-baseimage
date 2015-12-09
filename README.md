# coc-baseimage

![CoC Logo](https://clashofclans.com/img/logo/l.png?t=1449169311)

Base Layout Image Preview using PHP GD Library & village JSON

## Usage Example:

    // Initialize
    $map = new cocImage();
    
    // Define your API KEY
    CONST _API_ = '..API URL..';

    // Get the API JSON result
    $json = @file_get_contents(_API_);
    
    // Receive the villageJson (change this depending on the API) 
    $villageJson = @json_decode( @json_decode( $json )->player->village->json )->buildings;
    
    // Get the base64 encoded village image
    $image = $map->showMap( $villageJson );

    // Render the image
    echo "<img src='$image' />";

## Map Preview
![Base Preview](http://fs5.directupload.net/images/151208/336rm75m.png)

## Filter

    // Example: Brightness Filter
    $image = $map->showMap( $villageJson, IMG_FILTER_BRIGHTNESS, 100 );

    // Example: Negate Filter
    $image = $map->showMap( $villageJson, IMG_FILTER_NEGATE );

NAME | VAR
------------ | -------------
IMG_FILTER_BRIGHTNESS | -255 to 255
IMG_FILTER_CONTRAST | -255 to 255
IMG_FILTER_GRAYSCALE | n/a
IMG_FILTER_NEGATE | n/a
IMG_FILTER_EDGEDETECT | n/a
IMG_FILTER_EMBOSS | n/a
IMG_FILTER_GAUSSIAN_BLUR | n/a
IMG_FILTER_MEAN_REMOVAL | n/a
IMG_FILTER_SMOOTH | n/a
## Filter Preview
![Filter Preview](http://fs5.directupload.net/images/151209/v2irortm.jpg)

## Dependencies
PHP >5.4 & GDlib
