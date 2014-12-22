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
	$(window).load(function(){
	    resize();
	    $(window).resize(function(){
		resize();
	    })
	    $('#menu-item-213').click(function(){
		$('#cntctfrm_contact_name').focus();
	    })
	    $('#cntctfrm_contact_form').attr('action','http://campcoders.com/#cpr');
	    $('.slider-wrapper').css('height',$(window).height()-85);
	    var current_cate  = <?php echo json_encode(get_the_category()[0]->slug); ?>;
	    if(current_cate == 'portfolio'){
	    	gtTop('rpjc_widget_cat_recent_posts-4');
	    }
	    if(current_cate == 'blog'){
	    	gtTop('rpjc_widget_cat_recent_posts-3');
	    }
	    function resize(){
		if(findBootstrapEnvironment()=='xs'){
		    $('.widget').css('width','95%');
	        }else{
		    $('.widget').removeAttr('style');
	        }
	    }
	    function gtTop(id){
	    	var e = $('#'+id);
	    	e.addClass('notCl');
	    	$(e).prependTo('#sidebar .widgets');
	    	e.find('.menu').addClass('collapse');
	    	e.find('.menu').collapse('toggle');
	    	e.find('.widgettitle').attr('onclick',"showCollapse('"+e.attr('id')+"')");
	    	var notClTitle = e.find('.widgettitle').text();
	    		notClTitle += '<span class="caret" style="margin-left: 10px"></span>';
	    	e.find('.widgettitle').html(notClTitle);
	    	var collapse = $('#sidebar .widgets > div:not(.notCl)');
	    		collapse.addClass('cl');
	    		collapse.find('ul').addClass('collapse');
	    		collapse.find('.widgettitle').each(function(){
	    			$(this).attr('onclick',"showCollapse('"+$(this).parent().parent().attr('id')+"')");
	    			var title = $(this).text();
	    			title += '<span class="caret" style="margin-left: 10px"></span>';
	    			$(this).html(title);
	    		})
	    }
	function findBootstrapEnvironment() {
    	    var envs = ['xs', 'sm', 'md', 'lg'];
	    $el = $('<div>');
	    $el.appendTo($('body'));

	    for (var i = envs.length - 1; i >= 0; i--) {
            var env = envs[i];

            $el.addClass('hidden-'+env);
            if ($el.is(':hidden')) {
                $el.remove();
                return env
            }
    	    };
	}

	})
	function showCollapse(id){
	    $('#'+id).find('ul').collapse('toggle');
	}
	
</script>

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