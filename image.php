<?php
/**
 * coc-baseimg 0.0.1
 *
 * Copyright 2015 Cteha
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author Cteha <github.com/Cteha>
 */

Class cocImage
{
	protected $sizeY = 40;
	protected $tile, $tiles, $walls, $building, $background;

	public function __construct()
	{
		$this->sizeX = 40;
		$this->sizeY = 40;
		$this->path = getcwd();
	}

	public function showMap( $villageJson ) {

		$images = $this->loadImages(); 

		foreach( $villageJson as $value) {
			$this->addItem( $value->data , $value->lvl + 1, $value->x, $value->y );
		}
		
		return $this->decodeImage( $this->background );
	}

	public function addItem( $bid, $level, $x, $y ) {

		$tile_size = 80/8;
		$posX = ( $x - 1 ) * 20 - 20;
		$posY = ( $y - 1 ) * 20 - 20;

		switch( [ $bid , $level ] ) {

			// Townhall - 1000001
			case array( 1000001, 1 ): $result = [ 4, $posX, $posY, 2, 0, 100 ]; break;
			case array( 1000001, 2 ): $result = [ 4, $posX, $posY, 105, 0, 100 ]; break;
			case array( 1000001, 3 ): $result = [ 4, $posX, $posY, 205, 0, 100 ]; break;
			case array( 1000001, 4 ): $result = [ 4, $posX, $posY, 305, 0, 100 ]; break;
			case array( 1000001, 5 ): $result = [ 4, $posX, $posY, 410, 0, 100 ]; break;
			case array( 1000001, 6 ): $result = [ 4, $posX, $posY, 512, 0, 100 ]; break;
			case array( 1000001, 7 ): $result = [ 4, $posX, $posY, 615, 0, 100 ]; break;
			case array( 1000001, 8 ): $result = [ 4, $posX, $posY, 715, 0, 100 ]; break;
			case array( 1000001, 9 ): $result = [ 4, $posX, $posY, 815, 0, 100 ]; break;
			case array( 1000001, 10 ): $result = [ 4, $posX, $posY, 918, 0, 100 ]; break;

			// Laboratoy - 1000007
			case array( 1000007, 1 ): $result = [ 3, $posX, $posY, 15, 122, 70 ]; break;
			case array( 1000007, 2 ): $result = [ 3, $posX, $posY, 116, 121, 70 ]; break;
			case array( 1000007, 3 ): $result = [ 3, $posX, $posY, 220, 119, 70 ]; break;
			case array( 1000007, 4 ): $result = [ 3, $posX, $posY, 320, 118, 70 ]; break;
			case array( 1000007, 5 ): $result = [ 3, $posX, $posY, 420, 117, 70 ]; break;
			case array( 1000007, 6 ): $result = [ 3, $posX, $posY, 523, 116, 70 ]; break;
			case array( 1000007, 7 ): $result = [ 3, $posX, $posY, 624, 116, 70 ]; break;
			case array( 1000007, 8 ): $result = [ 3, $posX, $posY, 726, 116, 70 ]; break;

			// Army Camp - 1000000
			case array( 1000000, 1 ): $result = [ 4, $posX, $posY, 12, 190, 100 ]; break;
			case array( 1000000, 2 ): $result = [ 4, $posX, $posY, 140, 194, 100 ]; break;
			case array( 1000000, 3 ): $result = [ 4, $posX, $posY, 268, 194, 100 ]; break;
			case array( 1000000, 4 ): $result = [ 4, $posX, $posY, 398, 194, 100 ]; break;
			case array( 1000000, 5 ): $result = [ 4, $posX, $posY, 528, 194, 100 ]; break;
			case array( 1000000, 6 ): $result = [ 4, $posX, $posY, 656, 194, 100 ]; break;
			case array( 1000000, 7 ): $result = [ 4, $posX, $posY, 784, 190, 100 ]; break;
			case array( 1000000, 8 ): $result = [ 4, $posX, $posY, 914, 190, 100 ]; break;

			// Clan Castle - 1000014
			case array( 1000014, 1 ): $result = [ 3, $posX, $posY, 0, 317, 80 ]; break;
			case array( 1000014, 2 ): $result = [ 3, $posX, $posY, 74, 312, 80 ]; break;
			case array( 1000014, 3 ): $result = [ 3, $posX, $posY, 148, 310, 80 ]; break;
			case array( 1000014, 4 ): $result = [ 3, $posX, $posY, 228, 307, 80 ]; break;
			case array( 1000014, 5 ): $result = [ 3, $posX, $posY, 300, 307, 80 ]; break;
			case array( 1000014, 6 ): $result = [ 3, $posX, $posY, 376, 307, 80 ]; break;
			case array( 1000014, 7 ): $result = [ 3, $posX, $posY, 453, 307, 80 ]; break;

			// Builder's Hut - 1000015
			case array( 1000015, 1 ): $result = [ 2, $posX, $posY, 694, 340, 44 ]; break;

			// Barbarian King - 1000022
			case array( 1000022, 1 ): $result = [ 3, $posX, $posY, 754, 332, 54 ]; break;

			// Archer Queen - 1000025
			case array( 1000025, 1 ): $result = [ 3, $posX, $posY, 830, 332, 54 ]; break;

			// Barracks - 1000006
			case array( 1000006, 1 ): $result = [ 3, $posX, $posY, 8, 419, 60 ]; break;
			case array( 1000006, 2 ): $result = [ 3, $posX, $posY, 84, 419, 60 ]; break;
			case array( 1000006, 3 ): $result = [ 3, $posX, $posY, 158, 419, 60 ]; break;
			case array( 1000006, 4 ): $result = [ 3, $posX, $posY, 237, 419, 60 ]; break;
			case array( 1000006, 5 ): $result = [ 3, $posX, $posY, 312, 419, 60 ]; break;
			case array( 1000006, 6 ): $result = [ 3, $posX, $posY, 388, 419, 60 ]; break;
			case array( 1000006, 7 ): $result = [ 3, $posX, $posY, 460, 418, 60 ]; break;
			case array( 1000006, 8 ): $result = [ 3, $posX, $posY, 538, 418, 60 ]; break;
			case array( 1000006, 9 ): $result = [ 3, $posX, $posY, 612, 418, 60 ]; break;
			case array( 1000006, 10 ): $result = [ 3, $posX, $posY, 690, 416, 60 ]; break;

			// Archer Tower - 1000006
			case array( 1000009, 1 ): $result = [ 3, $posX, $posY, 4, 508, 68 ]; break;
			case array( 1000009, 2 ): $result = [ 3, $posX, $posY, 78, 508, 68 ]; break;
			case array( 1000009, 3 ): $result = [ 3, $posX, $posY, 154, 508, 68 ]; break;
			case array( 1000009, 4 ): $result = [ 3, $posX, $posY, 231, 508, 68 ]; break;
			case array( 1000009, 5 ): $result = [ 3, $posX, $posY, 305, 508, 68 ]; break;
			case array( 1000009, 6 ): $result = [ 3, $posX, $posY, 382, 508, 68 ]; break;
			case array( 1000009, 7 ): $result = [ 3, $posX, $posY, 459, 508, 68 ]; break;
			case array( 1000009, 8 ): $result = [ 3, $posX, $posY, 534, 508, 68 ]; break;
			case array( 1000009, 9 ): $result = [ 3, $posX, $posY, 612, 508, 68 ]; break;
			case array( 1000009, 10 ): $result = [ 3, $posX, $posY, 686, 508, 68 ]; break;
			case array( 1000009, 11 ): $result = [ 3, $posX, $posY, 762, 508, 68 ]; break;
			case array( 1000009, 12 ): $result = [ 3, $posX, $posY, 840, 508, 68 ]; break;
			case array( 1000009, 13 ): $result = [ 3, $posX, $posY, 915, 508, 68 ]; break;

			// Archer Tower - 1000008
			case array( 1000008, 1 ): $result = [ 3, $posX, $posY, 8, 618, 60 ]; break;
			case array( 1000008, 2 ): $result = [ 3, $posX, $posY, 81, 618, 60 ]; break;
			case array( 1000008, 3 ): $result = [ 3, $posX, $posY, 159, 618, 60 ]; break;
			case array( 1000008, 4 ): $result = [ 3, $posX, $posY, 234, 618, 60 ]; break;
			case array( 1000008, 5 ): $result = [ 3, $posX, $posY, 310, 618, 60 ]; break;
			case array( 1000008, 6 ): $result = [ 3, $posX, $posY, 386, 618, 60 ]; break;
			case array( 1000008, 7 ): $result = [ 3, $posX, $posY, 463, 619, 60 ]; break;
			case array( 1000008, 8 ): $result = [ 3, $posX, $posY, 538, 619, 60 ]; break;
			case array( 1000008, 9 ): $result = [ 3, $posX, $posY, 613, 619, 60 ]; break;
			case array( 1000008, 10 ): $result = [ 3, $posX, $posY, 687, 619, 60 ]; break;
			case array( 1000008, 11 ): $result = [ 3, $posX, $posY, 767, 619, 60 ]; break;
			case array( 1000008, 12 ): $result = [ 3, $posX, $posY, 842, 619, 60 ]; break;

			// Air Defense - 1000012
			case array( 1000012, 1 ): $result = [ 3, $posX, $posY, 12, 716, 50 ]; break;
			case array( 1000012, 2 ): $result = [ 3, $posX, $posY, 86, 716, 50 ]; break;
			case array( 1000012, 3 ): $result = [ 3, $posX, $posY, 164, 716, 50 ]; break;
			case array( 1000012, 4 ): $result = [ 3, $posX, $posY, 240, 716, 50 ]; break;
			case array( 1000012, 5 ): $result = [ 3, $posX, $posY, 316, 716, 50 ]; break;
			case array( 1000012, 6 ): $result = [ 3, $posX, $posY, 392, 716, 50 ]; break;
			case array( 1000012, 7 ): $result = [ 3, $posX, $posY, 462, 705, 62 ]; break;
			case array( 1000012, 8 ): $result = [ 3, $posX, $posY, 533, 700, 70 ]; break;

			// X-Bow - 1000021
			case array( 1000021, 1 ): $result = [ 3, $posX, $posY, 698, 710, 64 ]; break;
			case array( 1000021, 2 ): $result = [ 3, $posX, $posY, 774, 710, 64 ]; break;
			case array( 1000021, 3 ): $result = [ 3, $posX, $posY, 850, 712, 64 ]; break;
			case array( 1000021, 4 ): $result = [ 3, $posX, $posY, 928, 712, 64 ]; break;

			// Gold Mine - 1000004
			case array( 1000004, 1 ): $result = [ 3, $posX, $posY, 10, 815, 60 ]; break;
			case array( 1000004, 2 ): $result = [ 3, $posX, $posY, 85, 815, 60 ]; break;
			case array( 1000004, 3 ): $result = [ 3, $posX, $posY, 162, 815, 60 ]; break;
			case array( 1000004, 4 ): $result = [ 3, $posX, $posY, 238, 816, 60 ]; break;
			case array( 1000004, 5 ): $result = [ 3, $posX, $posY, 312, 816, 60 ]; break;
			case array( 1000004, 6 ): $result = [ 3, $posX, $posY, 390, 815, 60 ]; break;
			case array( 1000004, 7 ): $result = [ 3, $posX, $posY, 466, 816, 60 ]; break;
			case array( 1000004, 8 ): $result = [ 3, $posX, $posY, 541, 814, 60 ]; break;
			case array( 1000004, 9 ): $result = [ 3, $posX, $posY, 618, 814, 60 ]; break;
			case array( 1000004, 10 ): $result = [ 3, $posX, $posY, 692, 812, 60 ]; break;
			case array( 1000004, 11 ): $result = [ 3, $posX, $posY, 767, 812, 60 ]; break;
			case array( 1000004, 12 ): $result = [ 3, $posX, $posY, 842, 809, 60 ]; break;

			// Gold Mine - 1000005
			case array( 1000005, 1 ): $result = [ 3, $posX, $posY, 9, 910, 60 ]; break;
			case array( 1000005, 2 ): $result = [ 3, $posX, $posY, 84, 908, 60 ]; break;
			case array( 1000005, 3 ): $result = [ 3, $posX, $posY, 160, 906, 60 ]; break;
			case array( 1000005, 4 ): $result = [ 3, $posX, $posY, 236, 906, 60 ]; break;
			case array( 1000005, 5 ): $result = [ 3, $posX, $posY, 312, 906, 60 ]; break;
			case array( 1000005, 6 ): $result = [ 3, $posX, $posY, 388, 906, 60 ]; break;
			case array( 1000005, 7 ): $result = [ 3, $posX, $posY, 465, 906, 60 ]; break;
			case array( 1000005, 8 ): $result = [ 3, $posX, $posY, 537, 904, 65 ]; break;
			case array( 1000005, 9 ): $result = [ 3, $posX, $posY, 614, 904, 65 ]; break;
			case array( 1000005, 10 ): $result = [ 3, $posX, $posY, 688, 904, 65 ]; break;
			case array( 1000005, 11 ): $result = [ 3, $posX, $posY, 763, 900, 68 ]; break;

			// Inferno Tower - 1000027
			case array( 1000027, 1 ): $result = [ 3, $posX, $posY, 884, 900, 68 ]; break;
			case array( 1000027, 2 ): $result = [ 3, $posX, $posY, 933, 899, 68 ]; break;
			case array( 1000027, 3 ): $result = [ 3, $posX, $posY, 983, 898, 68 ]; break;

			// Dark Barracks - 1000026
			case array( 1000026, 1 ): $result = [ 3, $posX, $posY, 8, 1002, 60 ]; break;
			case array( 1000026, 2 ): $result = [ 3, $posX, $posY, 82, 1000, 64 ]; break;
			case array( 1000026, 3 ): $result = [ 3, $posX, $posY, 156, 997, 68 ]; break;
			case array( 1000026, 4 ): $result = [ 3, $posX, $posY, 230, 994, 72 ]; break;
			case array( 1000026, 5 ): $result = [ 3, $posX, $posY, 303, 993, 74 ]; break;
			case array( 1000026, 6 ): $result = [ 3, $posX, $posY, 380, 992, 76 ]; break;

			// Dark Barracks - 1000020
			case array( 1000020, 1 ): $result = [ 3, $posX, $posY, 555, 1002, 60 ]; break;
			case array( 1000020, 2 ): $result = [ 3, $posX, $posY, 630, 1002, 60 ]; break;
			case array( 1000020, 3 ): $result = [ 3, $posX, $posY, 706, 1002, 60 ]; break;
			case array( 1000020, 4 ): $result = [ 3, $posX, $posY, 778, 1000, 66 ]; break;
			case array( 1000020, 5 ): $result = [ 3, $posX, $posY, 856, 1000, 64 ]; break;

			// Wizard Tower - 1000011
			case array( 1000011, 1 ): $result = [ 3, $posX, $posY, 3, 1086, 70 ]; break;
			case array( 1000011, 2 ): $result = [ 3, $posX, $posY, 78, 1086, 70 ]; break;
			case array( 1000011, 3 ): $result = [ 3, $posX, $posY, 154, 1086, 70 ]; break;
			case array( 1000011, 4 ): $result = [ 3, $posX, $posY, 231, 1086, 70 ]; break;
			case array( 1000011, 5 ): $result = [ 3, $posX, $posY, 307, 1086, 70 ]; break;
			case array( 1000011, 6 ): $result = [ 3, $posX, $posY, 383, 1086, 70 ]; break;
			case array( 1000011, 7 ): $result = [ 3, $posX, $posY, 458, 1086, 70 ]; break;
			case array( 1000011, 8 ): $result = [ 3, $posX, $posY, 535, 1086, 70 ]; break;

			// Dark Elixir Drill - 1000023
			case array( 1000023, 1 ): $result = [ 3, $posX, $posY, 652, 1095, 56 ]; break;
			case array( 1000023, 2 ): $result = [ 3, $posX, $posY, 727, 1095, 56 ]; break;
			case array( 1000023, 3 ): $result = [ 3, $posX, $posY, 802, 1093, 57 ]; break;
			case array( 1000023, 4 ): $result = [ 3, $posX, $posY, 880, 1093, 57 ]; break;
			case array( 1000023, 5 ): $result = [ 3, $posX, $posY, 954, 1092, 62 ]; break;
			case array( 1000023, 6 ): $result = [ 3, $posX, $posY, 1029, 1092, 62 ]; break;

			// Mortar - 1000013
			case array( 1000013, 1 ): $result = [ 3, $posX, $posY, 12, 1202, 50 ]; break;
			case array( 1000013, 2 ): $result = [ 3, $posX, $posY, 87, 1202, 50 ]; break;
			case array( 1000013, 3 ): $result = [ 3, $posX, $posY, 164, 1204, 50 ]; break;
			case array( 1000013, 4 ): $result = [ 3, $posX, $posY, 239, 1204, 50 ]; break;
			case array( 1000013, 5 ): $result = [ 3, $posX, $posY, 314, 1204, 50 ]; break;
			case array( 1000013, 6 ): $result = [ 3, $posX, $posY, 391, 1204, 50 ]; break;
			case array( 1000013, 7 ): $result = [ 3, $posX, $posY, 466, 1204, 50 ]; break;
			case array( 1000013, 8 ): $result = [ 3, $posX, $posY, 544, 1206, 50 ]; break;

			// Dark Elixir Storage - 1000024
			case array( 1000024, 1 ): $result = [ 3, $posX, $posY, 654, 1195, 60 ]; break;
			case array( 1000024, 2 ): $result = [ 3, $posX, $posY, 729, 1196, 60 ]; break;
			case array( 1000024, 3 ): $result = [ 3, $posX, $posY, 801, 1191, 66 ]; break;
			case array( 1000024, 4 ): $result = [ 3, $posX, $posY, 878, 1191, 66 ]; break;
			case array( 1000024, 5 ): $result = [ 3, $posX, $posY, 954, 1191, 66 ]; break;
			case array( 1000024, 6 ): $result = [ 3, $posX, $posY, 1030, 1191, 66 ]; break;

			// Elixir Collector - 1000002
			case array( 1000002, 1 ): $result = [ 3, $posX, $posY, 14, 1300, 50 ]; break;
			case array( 1000002, 2 ): $result = [ 3, $posX, $posY, 89, 1300, 50 ]; break;
			case array( 1000002, 3 ): $result = [ 3, $posX, $posY, 164, 1298, 50 ]; break;
			case array( 1000002, 4 ): $result = [ 3, $posX, $posY, 240, 1298, 50 ]; break;
			case array( 1000002, 5 ): $result = [ 3, $posX, $posY, 313, 1296, 56 ]; break;
			case array( 1000002, 6 ): $result = [ 3, $posX, $posY, 389, 1296, 56 ]; break;
			case array( 1000002, 7 ): $result = [ 3, $posX, $posY, 463, 1292, 60 ]; break;
			case array( 1000002, 8 ): $result = [ 3, $posX, $posY, 539, 1294, 60 ]; break;
			case array( 1000002, 9 ): $result = [ 3, $posX, $posY, 616, 1291, 60 ]; break;
			case array( 1000002, 10 ): $result = [ 3, $posX, $posY, 686, 1288, 64 ]; break;
			case array( 1000002, 11 ): $result = [ 3, $posX, $posY, 763, 1288, 64 ]; break;
			case array( 1000002, 12 ): $result = [ 3, $posX, $posY, 839, 1288, 64 ]; break;

			// Elixir Storage - 1000003
			case array( 1000003, 1 ): $result = [ 3, $posX, $posY, 14, 1400, 50 ]; break;
			case array( 1000003, 2 ): $result = [ 3, $posX, $posY, 89, 1400, 50 ]; break;
			case array( 1000003, 3 ): $result = [ 3, $posX, $posY, 164, 1400, 50 ]; break;
			case array( 1000003, 4 ): $result = [ 3, $posX, $posY, 240, 1400, 50 ]; break;
			case array( 1000003, 5 ): $result = [ 3, $posX, $posY, 316, 1397, 50 ]; break;
			case array( 1000003, 6 ): $result = [ 3, $posX, $posY, 392, 1397, 50 ]; break;
			case array( 1000003, 7 ): $result = [ 3, $posX, $posY, 466, 1397, 50 ]; break;
			case array( 1000003, 8 ): $result = [ 3, $posX, $posY, 539, 1394, 55 ]; break;
			case array( 1000003, 9 ): $result = [ 3, $posX, $posY, 612, 1382, 68 ]; break;
			case array( 1000003, 10 ): $result = [ 3, $posX, $posY, 687, 1382, 69 ]; break;
			case array( 1000003, 11 ): $result = [ 3, $posX, $posY, 763, 1382, 70 ]; break;

			// Dark Spell Factory - 1000029
			case array( 1000029, 1 ): $result = [ 3, $posX, $posY, 920, 1391, 60 ]; break;
			case array( 1000029, 2 ): $result = [ 3, $posX, $posY, 996, 1391, 60 ]; break;
			case array( 1000029, 3 ): $result = [ 3, $posX, $posY, 1072, 1391, 60 ]; break;

			// Hidden Tesla - 1000019
			case array( 1000019, 1 ): $result = [ 2, $posX, $posY, 0, 1491, 53 ]; break;
			case array( 1000019, 2 ): $result = [ 2, $posX, $posY, 45, 1491, 53 ]; break;
			case array( 1000019, 3 ): $result = [ 2, $posX, $posY, 95, 1491, 53 ]; break;
			case array( 1000019, 4 ): $result = [ 2, $posX, $posY, 145, 1491, 53 ]; break;
			case array( 1000019, 5 ): $result = [ 2, $posX, $posY, 193, 1491, 53 ]; break;
			case array( 1000019, 6 ): $result = [ 2, $posX, $posY, 240, 1491, 55 ]; break;
			case array( 1000019, 7 ): $result = [ 2, $posX, $posY, 292, 1491, 53 ]; break;
			case array( 1000019, 8 ): $result = [ 2, $posX, $posY, 342, 1491, 55 ]; break;

			// Air Sweeper - 1000028
			case array( 1000028, 1 ): $result = [ 2, $posX, $posY, 544, 1496, 54 ]; break;
			case array( 1000028, 2 ): $result = [ 2, $posX, $posY, 593, 1496, 54 ]; break;
			case array( 1000028, 3 ): $result = [ 2, $posX, $posY, 643, 1496, 54 ]; break;
			case array( 1000028, 4 ): $result = [ 2, $posX, $posY, 692, 1496, 54 ]; break;
			case array( 1000028, 5 ): $result = [ 2, $posX, $posY, 740, 1496, 54 ]; break;
			case array( 1000028, 6 ): $result = [ 2, $posX, $posY, 788, 1496, 54 ]; break;

			// Walls - 1000010
			case array( 1000010, 1 ): $resultw = [ 1, $posX, $posY, 77, 26, 20 ]; break;
			case array( 1000010, 2 ): $resultw = [ 1, $posX, $posY, 77, 78, 20 ]; break;
			case array( 1000010, 3 ): $resultw = [ 1, $posX, $posY, 78, 129, 20 ]; break;
			case array( 1000010, 4 ): $resultw = [ 1, $posX, $posY, 78, 174, 20 ]; break;
			case array( 1000010, 5 ): $resultw = [ 1, $posX, $posY, 77, 224, 20 ]; break;
			case array( 1000010, 6 ): $resultw = [ 1, $posX, $posY, 77, 275, 20 ]; break;
			case array( 1000010, 7 ): $resultw = [ 1, $posX, $posY, 77, 324, 20 ]; break;
			case array( 1000010, 8 ): $resultw = [ 1, $posX, $posY, 77, 374, 20 ]; break;
			case array( 1000010, 9 ): $resultw = [ 1, $posX, $posY, 79, 426, 20 ]; break;
			case array( 1000010, 10 ): $resultw = [ 1, $posX, $posY, 78, 475, 20 ]; break;
			case array( 1000010, 11 ): $resultw = [ 1, $posX, $posY, 78, 526, 20 ]; break;

		}
		if(isset($result)) $this->addBuilding( $result[ 0 ], $result[ 1 ], $result[ 2 ], $result[ 3 ], $result[ 4 ], $result[ 5 ] );
		if(isset($resultw)) $this->addWall( $resultw[ 0 ], $resultw[ 1 ], $resultw[ 2 ], $resultw[ 3 ], $resultw[ 4 ], $resultw[ 5 ] );
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

		$this->tile = imagecreatefrompng( $this->path.'/img/tile.png' );
		$this->walls = imagecreatefrompng( $this->path.'/img/walls.png' );
		$this->building = imagecreatefrompng( $this->path.'/img/buildings-sprite.png' );

		$this->createBackground();
	}

	public function createBackground() {

		$this->tiles = imagecreatefromjpeg( $this->path.'/img/tiles.jpg' );
		$this->middle = imagecreatefromjpeg( $this->path.'/img/tile_center.jpg' );
		$this->background = imagecreatetruecolor( $this->sizeX * 20, $this->sizeY * 20 ) ;

		imagesettile( $this->background, $this->tiles );
		imagefilledrectangle( $this->background, 0, 0, $this->sizeX * 20, $this->sizeY * 20, IMG_COLOR_TILED );
		imageCopy( $this->background, $this->middle, $this->sizeX * 10 - 5, $this->sizeY * 10 - 5, 0, 0, 10, 10 ); 
	}

	public function decodeImage( $image ) {

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
