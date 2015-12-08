<?php
error_reporting(-1);
ini_set('display_errors', 'on');

Class cocImage
{
	protected $sizeX = 40;
	protected $sizeY = 40;
	protected $tile, $tiles, $walls, $building, $background;

	public function showMap( $json ) {

		$images = $this->loadImages(); 

		// Use $json here > loop > run:
		$this->addItem( 1000001, 1, 37, 37 );
		$this->addItem( 1000001, 1, 3, 37 );

		return $this->background;

	}

	public function addItem( $bid, $level, $x, $y ) {

		$tile_size = 80/8;
		$posX = ( $x - 1 ) * 20 - 20;
		$posY = ( $y - 1 ) * 20 - 20;

		switch( [ $bid , $level ] ) {

			// Townhall - 1000001
			case array( 1000001, 1 ): $result = [ 4, $posX, $posY, 2, 0, 100 ]; break;

		}
		$this->addBuilding( $result[ 0 ], $result[ 1 ], $result[ 2 ], $result[ 3 ], $result[ 4 ], $result[ 5 ] );
	}

	public function addBuilding( $tiles, $pX, $pY, $cX, $cY, $size ) {
	
		$image_size = $tiles * 20;

		imageCopy( $this->background, $this->tile, $pX + 2, $pY + 2, 0, 0, $image_size - 4, $image_size - 4 );
		imagecopyresized( $this->background, $this->building, $pX, $pY, $cX, $cY, $image_size, $image_size, $size, $size ); 

	}

	public function addWall( $tiles, $pX, $pY, $cX, $cY, $size ) {
		
		$image_size = $tiles * 20;

		imageCopy( $this->background, $this->tile, $pX + 2, $pY + 2, 0, 0, $image_size - 4, $image_size - 4 );
		imagecopyresized( $this->background, $this->walls, $pX, $pY, $cX, $cY, $image_size, $image_size, $size, $size ); 
	}

	public function loadImages() {

		$this->tile = imagecreatefrompng( 'tile.png' );
		$this->walls = imagecreatefrompng( 'images/walls.png' );
		$this->building = imagecreatefrompng( 'images/buildings-sprite.png' );

		$this->createBackground();

	}

	public function createBackground() {


		// Tiles Image 40*40px
		$this->tiles = imagecreatefromjpeg( 'tiles.jpg' );

		// Center point 10*10px
		$this->middle = imagecreatefromjpeg( 'tile_center.jpg' );

		$this->background = imagecreatetruecolor( $this->sizeX * 20, $this->sizeY * 20 ) ;

		imagesettile( $this->background, $this->tiles );
		imagefilledrectangle( $this->background, 0, 0, $this->sizeX * 20, $this->sizeY * 20, IMG_COLOR_TILED );
		imageCopy( $this->background, $this->middle, $this->sizeX * 10 - 5, $this->sizeY * 10 - 5, 0, 0, 10, 10 ); 
	}

	public function renderImage( $image ) {
		header( 'Content-Type: image/png' );
		imagepng( $this->background );
	
		$this->clearImages();
	}

	public function encodeImage( $image ) {

		ob_start();
		imagepng( $this->background );
		$base64 = "data:image/jpeg;base64," . base64_encode(ob_get_contents());
		ob_end_clean();

		$this->clearImages();
	
		return $base64;
	}

	public function clearImages () {
		imagedestroy( $this->background );
		imagedestroy( $this->tiles );
		imagedestroy( $this->building );
		imagedestroy( $this->walls ); 
	}
}

//$map = new cocImage();
//$image = $map->showMap( "..json here.." );
//$result = $map->renderImage($image);
//$result = $map->encodeImage($image);
