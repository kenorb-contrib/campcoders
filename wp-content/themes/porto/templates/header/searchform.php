<?php if( get_setting( 'search_disable', false ) ) return; ?>
<div class="search">
	<form id="searchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="input-group">
			<input type="text" class="form-control search" name="s" id="s" placeholder="<?php get_setting_e( 'search_placeholder' ) ?>" value="<?php echo get_search_query(); ?>">
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="icon icon-search"></i></button>
			</span>
		</div>
	</form>
</div>