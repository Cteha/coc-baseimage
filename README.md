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

## Preview
![Base Preview](http://fs5.directupload.net/images/151208/336rm75m.png)

## Dependencies
PHP >5.4 & GDlib
