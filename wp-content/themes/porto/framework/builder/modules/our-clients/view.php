<?php

if( empty( $clients ) ) return;

echo '<div class="row center"><div class="flexslider unstyled" data-plugin-options=\'{ "directionNav":false, "animation":"slide", "slideshow": false, "maxVisibleItems": 6 }\'><ul class="slides">';
    
    $count = 0;
    foreach( $clients as $client ) {
        $count++;
        
        if( 1 == $count )
            echo '<li>';
        
        echo '<div class="col-md-2"><img class="img-responsive" alt="" src="' . $client['logo'] . '"></div>';
        
        if( 6 == $count ) {
            $count = 0;
            echo '</li>';
        }
    }
    
    if( $count > 0 && $count < 6 )
        echo '</li>';

echo '</ul></div></div>';
?>