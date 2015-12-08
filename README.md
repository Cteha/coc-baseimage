# coc-baseimage

![CoC Logo](https://clashofclans.com/img/logo/l.png?t=1449169311)

Base Layout Image using PHP GD Librarys (created trough village json)

Usage:

    $map = new cocImage();
    $json = file_get_contents('http://...API..?id=xxx&home=xxx');
    $image = $map->showMap( $json );

    // Render the image directly
    $result = $map->renderImage($image);
    
    // Retrieve image base64 encoded
    $result = $map->encodeImage($image);
    
    

- [x] All Buildings
- [X] JSON support
- [ ] Examples
- [ ] Documentation

## Preview
![Base Preview](http://fs5.directupload.net/images/151208/336rm75m.png)
