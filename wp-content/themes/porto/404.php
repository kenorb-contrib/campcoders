<?php

/**
 * Default Page Template
 */
?>
<?php get_header(); ?>

<?php spyropress_before_main_container(); ?>
<!-- content -->
<div role="main" class="main">
    <?php get_template_part( 'templates/page-top', '404' ); ?>
    <div class="container">
        <section class="page-not-found">
    		<div class="row">
    			<div class="col-md-6 col-md-offset-1">
    				<div class="page-not-found-main">
    					<h2><?php get_setting_e( '404_page_title' ); ?><i class="icon icon-file"></i></h2>
    					<p><?php get_setting_e( '404_page_description' ); ?></p>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<h4><?php get_setting_e( '404_page_link_title' ); ?></h4>
    				<?php
                        spyropress_get_nav_menu( array(
                            'container' => false,
                            'menu_class' => 'nav nav-list primary'
                        ), 'page-404' );
                    ?>
    			</div>
    		</div>
    	</section>
     </div>
</div>
<!-- /content -->
<?php spyropress_after_main_container(); ?>
<?php get_footer(); ?>