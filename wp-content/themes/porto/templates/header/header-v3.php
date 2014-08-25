<header class="flat-menu clean-top">
	<div class="header-top">
		<div class="container">
			<?php include_once 'topbar.php'; ?>
			<?php spyropress_social_icons( 'header_social' ); ?>
		</div>
	</div>
	<div class="container">
		<?php spyropress_logo( 'tag=h1' ); ?>
        <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="icon icon-bars"></i>
		</button>
    </div>
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container">
    		<?php
                spyropress_get_nav_menu( array(
                    'container_class' => 'nav-main mega-menu',
                    'menu_class' => 'nav nav-pills nav-main',
                    'menu_id' => 'mainMenu'
                ) );
            ?>
    	</div>
     </div>
</header>