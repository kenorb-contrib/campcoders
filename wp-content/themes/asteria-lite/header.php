<?php global $asteria;?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="wp-content/themes/asteria-lite/js/jquery.nicescroll.min.js"></script>
<script>
 var current_cate  = <?php echo json_encode(get_the_category()[0]->slug); ?>;
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/pvh-campcoders.js"></script>

</script>
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
