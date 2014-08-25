<article class="post post-large-image">
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
		<?php the_excerpt(); ?>
		<div class="post-meta">
			<?php if( $author = get_the_author_link() ) { ?>
			<span><i class="icon icon-user"></i> By <?php echo $author; ?> </span>
            <?php } ?>
			<?php the_tags( '<span><i class="icon icon-tag"></i> ', ', ', ' </span>' ); ?>
            <span><i class="icon icon-comments"></i> <?php comments_popup_link( '0 Comments' ); ?></span>
			<a href="<?php the_permalink(); ?>" class="btn btn-xs btn-primary pull-right">Read more...</a>
		</div>
	</div>
</article>