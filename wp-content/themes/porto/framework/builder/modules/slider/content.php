<?php

if( empty( $slides ) ) return;

$options = array(
    'controlNav' => false,
    'directionNav' => false,
    'animation' => 'slide',
    'animationLoop' => false,
    'slideshow' => false
);

if( $controlNav ) $options['controlNav'] = true;
if( $directionNav ) $options['directionNav'] = true;
if( $animation ) $options['animation'] = $animation;
if( $animationLoop ) $options['animationLoop'] = true;
if( $slideshow ) $options['slideshow'] = true;   

echo '<div class="row center"><div class="flexslider unstyled" data-plugin-options=\'' . json_encode( $options ) . '\'><ul class="slides">';
    foreach( $slides as $slide ) {
        echo '
        <li>
            <div class="col-md-12">
                ' . do_shortcode( wpautop( $slide['content'] ) ) . '
            </div>
        </li>';
    }
echo '</ul></div></div>';