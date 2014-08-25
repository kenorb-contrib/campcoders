<?php

$options = get_post_meta( get_the_ID(), '_page_options', true );

if( empty( $options ) ) return;

if( isset( $options['slider'] ) && 'rev' == $options['slider'] ) {
    if( 'full' == $options['rev_slider_skin'] ) {
?>
<div class="slider-container slider-container-fullscreen hidden-xs">
    <?php RevSliderOutput::putSlider( $options['rev_slider'], '' ) ?>
</div>
<?php
    } else {
?>
<div class="slider-container <?php echo $options['rev_slider_skin'] ?>">
    <?php RevSliderOutput::putSlider( $options['rev_slider'], '' ) ?>
</div>
<?php
    }
}
elseif( isset( $options['slider'] ) && 'nivo' == $options['slider'] ) {
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <?php echo do_shortcode( '[slider id=' . $options['nivo_slider'] . ']' ) ?>
		</div>
	</div>
</div>
<?php } ?>