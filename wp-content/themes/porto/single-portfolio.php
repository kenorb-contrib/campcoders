<?php

/**
 * Default Page Template
 */
?>
<?php get_header(); ?>

<?php spyropress_before_main_container(); ?>
<!-- content -->
<div role="main" class="main">
    <div id="content" class="content full">
    <?php
    spyropress_before_loop();
    while( have_posts() ) {
        the_post();

        spyropress_before_post();
    ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
            get_template_part( 'templates/page-top', 'portfolio' );
            spyropress_before_post_content();
        ?>
            <div class="container">
                <div class="portfolio-title">
                    <div class="row">
                    <?php if( 'title' == get_setting( 'portfolio_header_style', 'title' ) )  { ?>
                        <div class="col-md-12">
                            <h2 class="shorter"><?php the_title(); ?></h2>
                        </div>
                    <?php } else { ?>
						<div class="portfolio-nav-all col-md-1">
							<a href="<?php echo home_url( '/portfolio/' ) ?>" rel="tooltip" data-original-title="Back to list"><i class="icon icon-th"></i></a>
						</div>
						<div class="col-md-10 center">
							<h2 class="shorter"><?php the_title(); ?></h2>
						</div>
						<div class="portfolio-nav col-md-1">
                            <?php echo spyropress_get_next_prev_portfolio_link(); ?>
						</div>
                    <?php } ?>
                    </div>
				</div>

				<hr class="tall">
        
                <div class="row">
                	<div class="col-md-6">
                        <?php
                        if( $ids = get_post_meta( get_the_ID(), 'gallery', true ) ) {
                            $ids = explode( ',', str_replace( array( '[gallery ids=', ']', '"' ), '', $ids ) );
                        
                            if ( !empty( $ids ) ) {
                        ?>
                		<div class="flexslider" data-plugin-options='{"animation":"slide", "animationLoop": true, "maxItems": 1}'>
                			<ul class="slides">
                            <?php
                                foreach( $ids as $id ) {
                                    $image = get_image( array(
                                        'attachment' => $id,
                                        'echo' => false,
                                        'width' => 9999,
                                        'responsive' => true,
                                        'class' => 'img-responsive'
                                    ));
                                    
                                    echo '<li>' . $image . '</li>';
                                }
                            ?>
                			</ul>
                		</div>
                        <?php
                            }
                        }
                        elseif( has_post_thumbnail() ) {
                        ?>
                		<div class="flexslider" data-plugin-options='{"animation":"slide", "animationLoop": true, "maxItems": 1}'>
                			<ul class="slides">
                            <?php
                                $image = get_image( array(
                                    'attachment' => get_post_thumbnail_id(),
                                    'echo' => false,
                                    'width' => 9999,
                                    'responsive' => true,
                                    'class' => 'img-responsive'
                                ));
                                
                                echo '<li>' . $image . '</li>';
                            ?>
                            </ul>
                        </div>
                       <?php } ?>
                       <?php if( get_setting( 'portfolio_social_sharing' ) ) : ?>
                            <?php get_template_part( 'templates/add', 'this' ); ?>
                       <?php endif; ?>
                	</div>
                
                	<div class="col-md-6">
                        
                        <div class="portfolio-info">
							<div class="row">
								<div class="col-md-12 center">
									<ul>
										<li>
                                            <a href="#" rel="tooltip" data-original-title="View"><i class="icon icon-eye"></i><?php spyropress_post_views( get_the_ID(), '', '' ) ?></a>
										</li>
										<li>
											<i class="icon icon-calendar"></i> <?php the_date(); ?>
										</li>
                                        <?php the_terms( get_the_ID(), 'portfolio_category', '<li><i class="icon icon-tags"></i> ', ', ', '</li>' ); ?>
									</ul>
								</div>
							</div>
						</div>
                		<h4><?php get_setting_e( 'portfolio_desc_title' ); ?></h4>
                		<?php the_content(); ?>
                        
                        <?php
                        // live url
                        $live_url = get_post_meta( get_the_ID(), 'project_url', true );
                        if( $live_url )
                            echo '<a href="' . $live_url . '" class="btn btn-primary btn-icon"><i class="icon icon-external-link"></i>' . get_setting( 'portfolio_preview_title' ) . '</a> <span class="arrow hlb hidden-phone" data-appear-animation="rotateInUpLeft" data-appear-animation-delay="800"></span>';
                        ?>
                        <ul class="portfolio-details">
                            <?php
                            $terms = get_the_terms( get_the_ID(), 'portfolio_service' );
                            if( !empty( $terms ) && !is_wp_error( $terms ) ) {
                            ?>
        					<li>
        						<p><strong><?php get_setting_e( 'portfolio_service_title' ) ?>:</strong></p>
        
        						<ul class="list list-skills icons list-unstyled list-inline">
       							<?php
                                foreach( $terms as $term ) {
                                    echo '<li><i class="icon icon-check-circle"></i> ' . $term->name . '</li>';
                                } 
                                ?>
        						</ul>
        					</li>
                            <?php } ?>
                            <?php if( $client = get_post_meta( get_the_ID(), 'project_client', true ) ) { ?>
        					<li>
        						<p><strong><?php get_setting_e( 'portfolio_client_title', 'Client' ) ?>:</strong></p>
        						<p><?php echo $client ?></p>
        					</li>
                            <?php } ?>
                            <?php if( $testimonial = get_post_meta( get_the_ID(), 'project_testimonial', true ) ) { ?>
        					<li>
        						<p><strong><?php get_setting_e( 'portfolio_testimonial_title', 'Client Testimonial' ) ?>:</strong></p>
        						<blockquote>
        							<?php echo $testimonial ?>
        						</blockquote>
        					</li>
                            <?php } ?>
        				</ul>
                	</div>
                </div>
                
                <hr class="tall" />
                
                <?php get_template_part( 'templates/related', 'works' ); ?>
            </div>
            <?php spyropress_after_post_content(); ?>
        </div>
    <?php

        spyropress_after_post();
    }
    spyropress_after_loop();
    ?>
    </div>
</div>
<!-- /content -->
<?php spyropress_after_main_container(); ?>
<?php get_footer(); ?>