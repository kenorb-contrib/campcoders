<?php global $asteria;?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://instamenu.campcoders.com/lib/jquery.elastic.source.js"></script>
<script type="text/javascript">
	$(window).load(function(){
		var url = document.location.href + '#cntctfrm_thanks';
		$('#cntctfrm_contact_form').attr('action',url);
	})
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=UTF-8" />	
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
<?php get_template_part('style');?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--Header-->
<div class="fixed_site">
<!--Maintenance Mode Message-->
<?php if((!empty($asteria['offline_id']))){ ?>
<div class="lgn_info"><?php _e('The Website is running in Maintenance Mode.', 'asteria'); ?></div>
<?php } ?>

<!--Get Header Type-->
<?php get_template_part('head4'); ?>
</div>