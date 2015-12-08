# coc-baseimage

![CoC Logo](https://clashofclans.com/img/logo/l.png?t=1449169311)

Base Layout Image using PHP GD Librarys (created trough village json)

Usage:

    $map = new cocImage();
    $image = $map->showMap( "..json here.." );

    // Render the image directly
    $result = $map->renderImage($image);
    
    // Retrieve image base64 encoded
    $result = $map->encodeImage($image);
    
    

- [x] All Buildings
- [ ] JSON support
- [ ] Examples
- [ ] Documentation
