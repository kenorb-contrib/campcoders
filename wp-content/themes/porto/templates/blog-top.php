<section class="page-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
                    <li><a href="<?php echo home_url(); ?>"><?php get_setting_e( 'home_title' )?></a></li>
                    <li class="active"><?php
    					if ( is_category() ) :
    						_e( 'Category Archives', 'spyropress' );
                        elseif ( is_tag() ) :
    						_e( 'Tag Archives', 'spyropress' );
                        elseif ( is_day() ) :
    						_e( 'Daily Archives', 'spyropress' );
    					elseif ( is_month() ) :
    						_e( 'Monthly Archives', 'spyropress' );
    					elseif ( is_year() ) :
    						_e( 'Yearly Archives', 'spyropress' );
    					elseif ( is_home() ) :
    						_e( 'Blog', 'spyropress' );
                        elseif ( is_search() ) :
    						_e( 'Search Results', 'spyropress' );
                        else :
    						_e( 'Archives', 'spyropress' );
    					endif;
    				?></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2><?php
					if ( is_category() ) :
						single_cat_title();
                    elseif ( is_tag() ) :
						single_tag_title();
                    elseif ( is_day() ) :
						echo get_the_date();
					elseif ( is_month() ) :
						echo get_the_date( 'F Y' );
					elseif ( is_year() ) :
						echo get_the_date( 'Y' );
                    elseif ( is_home() ) :
                        _e( 'Blog', 'spyropress' );
                    elseif ( is_search() ) :
						echo __( 'Term: ', 'spyropress' ) . get_search_query();
					else :
						_e( 'Archives', 'spyropress' );
					endif;
				?></h2>
			</div>
		</div>
	</div>
</section>