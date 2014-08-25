<section class="page-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
                    <li><a href="<?php echo home_url(); ?>"><?php get_setting_e( 'home_title' )?></a></li>
                    <li class="active"><?php get_setting_e( 'blog_title' )?></li>
                </ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2><?php the_title(); ?></h2>
			</div>
		</div>
	</div>
</section>