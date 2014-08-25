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
    $position = get_setting( 'blog_single_sidebar_position', 'right' );
    spyropress_before_loop();
    while( have_posts() ) {
        the_post();

        spyropress_before_post();
    ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
            get_template_part( 'templates/post', 'top' );
            spyropress_before_post_content();
        ?>
            <div class="container">
                <div class="row">
                    <?php if( 'left' == $position ) { ?>
                    <div class="col-md-3">
                        <aside class="sidebar">
                            <?php dynamic_sidebar( 'blog' ); ?>
                        </aside>
                    </div>
                    <?php } ?>
                	<div class="col-md-9">
                        <div class="blog-posts single-post">
        					<article class="post post-large-image blog-single-post">
                                <?php
                                if( $ids = get_post_meta( get_the_ID(), 'gallery', true ) ) {
                                    
                                    $ids = explode( ',', str_replace( array( '[gallery ids=', ']', '"' ), '', $ids ) );
                                    
                                    if ( !empty( $ids ) ) {
                                ?>
                                <div class="post-image">
                                    <div class="flexslider" data-plugin-options='{"directionNav":false, "animation":"slide"}'>
                                		<ul class="slides">
                                        <?php
                                            foreach( $ids as $id ) {
                                                $image = get_image( array(
                                                    'attachment' => $id,
                                                    'echo' => false,
                                                    'width' => 9999,
                                                    'responsive' => true,
                                                    'class' => 'img-rounded'
                                                ));
                                                echo '<li>' . $image . '</li>';
                                            }
                                        ?>
                                		</ul>
                                	</div>
                                </div>
                                <?php
                                    }
                                }
                                elseif( has_post_thumbnail() ) {
                                ?>
                                <div class="post-image">
                                    <div class="flexslider" data-plugin-options='{"directionNav":false, "animation":"slide"}'>
                                        <ul class="slides">
                                            <?php
                                                $image = get_image( array(
                                                    'attachment' => get_post_thumbnail_id(),
                                                    'echo' => false,
                                                    'width' => 9999,
                                                    'responsive' => true,
                                                    'class' => 'img-rounded'
                                                ));
                                                echo '<li>' . $image . '</li>';
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="post-date">
                                    <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                                    <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                                </div>

        						<div class="post-content">

        							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        							<div class="post-meta">
        								<?php if( $author = get_the_author_link() ) { ?>
                                        <span><i class="icon icon-user"></i>By <?php echo $author; ?> </span>
                                        <?php } ?>
                                        <?php the_tags( '<span><i class="icon icon-tag"></i> ', ', ', ' </span>' ); ?>
        								<span><i class="icon icon-comments"></i> <?php comments_popup_link( '0 Comments' ); ?></span>
        							</div>

        							<?php the_content(); ?>
                                    
                                    <?php
                                        wp_link_pages( array(
                                            'before' => '<ul class="pagination pull-right">',
                                            'after' => '</ul><div class="clearfix"></div>',
                                        ) );
                                    ?>
                                    <?php if( get_setting( 'post_social_sharing' ) ) : ?>
                                    <div class="post-block post-share">
                                        <h3><i class="icon icon-share"></i><?php get_setting_e( 'post_share_title' ); ?></h3>
                                        <?php get_template_part( 'templates/add', 'this' ); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php get_template_part( 'templates/author', 'box' ); ?>

                                    <?php comments_template( '', true ); ?>
        						</div>
        					</article>
        				</div>
                	</div>
                    <?php if( 'right' == $position ) { ?>
                    <div class="col-md-3">
                        <aside class="sidebar">
                            <?php dynamic_sidebar( 'blog' ); ?>
                        </aside>
                    </div>
                    <?php } ?>
                </div>
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