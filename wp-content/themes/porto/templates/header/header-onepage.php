<header class="single-menu flat-menu">
	<div class="container">
		<?php spyropress_logo( 'tag=h1' ); ?>
		<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
			<i class="icon icon-bars"></i>
		</button>
	</div>
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container">
            <?php spyropress_social_icons( 'header_social' ); ?>
            <?php
                $menu = spyropress_get_nav_menu( array(
                    'container_class' => 'nav-main',
                    'menu_class' => 'nav nav-pills nav-main',
                    'menu_id' => 'mainMenu',
                    'echo' => false,
                ), 'one-page' );
                
                $url = ( is_front_page() || is_page_template( 'one-page.php' ) ) ? '#' : home_url('/#');
                echo str_replace( '#HOME_URL#', $url, $menu );
            ?>
	   </div>
    </div>
</header>