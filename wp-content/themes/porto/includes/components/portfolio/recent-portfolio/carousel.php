<?php

// Setup Instance for view
$instance = spyropress_clean_array( $instance );
$instance['callback'] = array( $this, 'generate_item_carousel' );
$instance['row_container'] = 'li';
$instance['columns'] = 4;
$instance['row_class'] = '';

// tempalte
$tmpl = '{content}';
    
echo '<h1>' . $title . '</h1>';

echo '<div class="row"><div class="flexslider flexslider-top-title unstyled" data-plugin-options=\'{"controlNav":false, "slideshow": false, "animationLoop": true, "animation":"slide", "maxItems": 4}\'><ul class="slides">';
    
    // output content
    echo $this->query( $instance, $tmpl );

echo '</ul></div></div>';
?>