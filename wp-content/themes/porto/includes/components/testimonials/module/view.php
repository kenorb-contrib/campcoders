<?php

// Setup Instance for view
$instance = spyropress_clean_array( $instance );

if ( $instance['title'] ) echo '<h2>' . $instance['title'] . '</h2>';

echo '<div class="row"><div class="flexslider flexslider-top-title unstyled" data-plugin-options=\'{"controlNav":false, "slideshow": false, "animationLoop": true, "animation":"slide"}\'><ul class="slides">';

    // output content
    echo $this->query( $instance, '{content}' );

echo '</ul></div></div>';
?>