<?php

if( empty( $lines ) ) return;

if( $title ) echo '<h3 class="pull-top">' . $title . '</h3>';

echo '<ul class="history">';
    
    foreach( $lines as $item ) {
        
        $img = ( isset( $item['img'] ) && !empty( $item['img'] ) ) ? '<img src="' . $item['img'] . '" alt="" />' : '';
        
        echo '
        <li data-appear-animation="fadeInUp">
			<div class="thumb">
				' . $img . '
			</div>
			<div class="featured-box">
				<div class="box-content">
					<h4>' . $item['heading'] . '</h4>
					' . wpautop( $item['content'] ) . '
				</div>
			</div>
		</li>';
    }
    
echo '</ul>';
?>