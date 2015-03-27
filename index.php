<?php 
ini_set("memory_limit","200M");
ini_set('max_executon_time',300);

require "pgm.php";

$pgm = new PGM;

$pgm->loadPGM('image.pgm');

/* Mean Pixel */

$range = 7;

for( $i = 0 ; $i < $pgm->height -1; $i++) {

	for( $j = 0 ; $j < $pgm->width ; $j++) {

		$averange = 0;
		$nr_of_pixels = 0;
		for( $i2 = $i - $range ; $i2 < $i+$range ; $i2++) {

			for( $j2 = $j - $range ; $j2 < $j+ $range ; $j2++) {

				if( ( $i2 >= 0 && $i2 < $pgm->height)  
						&& ( $j2>=0 && $j2<$pgm->width )
						&& $i2 * $pgm->width + $j2 < count($pgm->pixelArray) )
				{ 

					$averange += $pgm->pixelArray[$i2 * $pgm->width + $j2];
					
					$nr_of_pixels++;
				}

			}
		}

		$mean_arr[] = $averange / $nr_of_pixels;

	}
}
$old_arr = $pgm->pixelArray;

$pgm->pixelArray = $mean_arr;

$pgm->savePGM('image_mean.pgm');

$pgm->pixelArray = $old_arr;

/* Weighted average filter */

$range = 3;
$center_pixel_weight = 0.7;

for( $i = 0 ; $i < $pgm->height -1 ; $i++) {

	for( $j = 0 ; $j < $pgm->width ; $j++) {

		$averange = 0;
		$nr_of_pixels =0;
		for( $i2 = $i - $range ; $i2 < $i+$range ; $i2++) {

			for( $j2 = $j - $range ; $j2 < $j+ $range ; $j2++) {

				if( ( $i2 >= 0 && $i2 < $pgm->height)  && ( $j2>=0 && $j2<$pgm->width )
						&& $i2 * $pgm->width + $j2 < count($pgm->pixelArray) )
				{
					$averange += $pgm->pixelArray[$i2 * $pgm->width + $j2];
					$nr_of_pixels++;
				}

			}
		}
		$center_pixel = $pgm->pixelArray[$i * $pgm->width + $j];
		
		$averange -= $center_pixel;

		$wight_arr[] = ( $averange*( 1 - $center_pixel_weight ) + $center_pixel*$center_pixel_weight ) / $nr_of_pixels;

	}
}

$pgm->pixelArray = $wight_arr;

$pgm->savePGM('image_weight.pgm');


?>