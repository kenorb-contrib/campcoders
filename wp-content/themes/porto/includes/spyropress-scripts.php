<?php

/**
 * Enqueue scripts and stylesheets
 *
 * @category Core
 * @package SpyroPress
 *
 */

function dequeue_rev_styles() {
    
    if( defined( 'WPCF7_VERSION' ) ) {
        wp_dequeue_style( 'contact-form-7' );
        wp_dequeue_script( 'contact-form-7' );
    }
}

/**
 * Register StyleSheets
 */
function spyropress_register_stylesheets() {

    // Web Fonts
    $gurl = 'http' . ( is_ssl() ? 's' : '' ) . '://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light';
    wp_enqueue_style( 'google-fonts', $gurl );

    // Libs CSS
    wp_enqueue_style( 'bootstrap', assets_css() . 'bootstrap.css' );
    wp_enqueue_style( 'font-awesome', assets_css() . 'fonts/font-awesome/css/font-awesome.css' );
    wp_enqueue_style( 'flexslider', assets() . 'vendor/flexslider/flexslider.css' );
    wp_enqueue_style( 'magnific-popup', assets() . 'vendor/magnific-popup/magnific-popup.css' );
    wp_enqueue_style( 'jquery-isotope', assets() . 'vendor/isotope/jquery.isotope.css' );
    
    // Theme CSS
    wp_enqueue_style( 'theme', assets_css() . 'theme.css' );
    wp_enqueue_style( 'theme-elements', assets_css() . 'theme-elements.css' );
    wp_enqueue_style( 'theme-animate', assets_css() . 'theme-animate.css' );
    wp_enqueue_style( 'theme-blog', assets_css() . 'theme-blog.css' );
    
    // Current Page Styles
    wp_enqueue_style( 'nivoslider', assets() . 'vendor/nivo-slider/nivo-slider.css' );
    wp_enqueue_style( 'nivo-theme', assets() . 'vendor/nivo-slider/themes/default/default.css' );
    wp_enqueue_style( 'circle-flip-slideshow', assets() . 'vendor/circle-flip-slideshow/css/component.css' );
    
    // Skin
    if( !current_theme_supports( 'theme-demo' ) )
        wp_enqueue_style( 'skin', assets_css() . 'skins/' . get_setting( 'theme_skin', 'blue' ) . '.css' );
    
    // Responsive CSS
    $is_responsive = !get_setting( 'responsive', false );
    if( $is_responsive ) {
        wp_enqueue_style( 'theme-responsive', assets_css() . 'theme-responsive.css' );
    }
    
    wp_enqueue_style( 'main-css', child_url() . 'style.css' );
    
    // Custom CSS
    wp_enqueue_style( 'custom-theme', assets_css() . 'custom.css', false );
    
    // Dynamic StyleSheet
    if ( file_exists( dynamic_css_path() . 'dynamic.css' ) )
        wp_enqueue_style( 'dynamic', dynamic_css_url() . 'dynamic.css', false, '2.0.0' );

    // Builder StyleSheet
    if ( file_exists( dynamic_css_path() . 'builder.css' ) )
        wp_enqueue_style( 'builder', dynamic_css_url() . 'builder.css', false, '2.0.0' );

    // modernizr
    wp_enqueue_script( 'modernizr', assets() . 'vendor/modernizr.js', array( 'jquery' ), '2.6.2', false );
}

/**
 * Enqueque Scripts
 */
function spyropress_register_scripts() {

    /**
     * Register Scripts
     */
    // threaded comments
    if ( is_single() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Plugins
    wp_register_script( 'jquery-plugins', assets() . 'js/plugins.js', false, false, true );
    wp_register_script( 'jquery-easing', assets() . 'vendor/jquery.easing.js', false, false, true );
    wp_register_script( 'jquery-appear', assets() . 'vendor/jquery.appear.js', false, false, true );
    wp_register_script( 'bootstrap', assets() . 'vendor/bootstrap.js', false, false, true );
    wp_register_script( 'twitterjs', assets() . 'vendor/twitterjs/twitter.js', false, false, true );
    wp_register_script( 'jquery-flexslider', assets() . 'vendor/flexslider/jquery.flexslider.js', false, false, true );
    wp_register_script( 'jquery-flipshow', assets() . 'vendor/circle-flip-slideshow/js/jquery.flipshow.js', false, false, true );
    wp_register_script( 'jquery-magnific', assets() . 'vendor/magnific-popup/magnific-popup.js', false, false, true );
    wp_register_script( 'jquery-validate', assets() . 'vendor/jquery.validate.js', false, false, true );
    
    wp_register_script( 'selectnav', assets() . 'vendor/selectnav.js', false, false, true );
    wp_register_script( 'nivoslider', assets() . 'vendor/nivo-slider/jquery.nivo.slider.js', false, false, true );    
    wp_register_script( 'jquery-stellar', assets() . 'vendor/jquery.stellar.js', false, false, true );
    wp_register_script( 'jquery-jflickrfeed', assets() . 'vendor/jflickrfeed/jflickrfeed.js', false, false, true );
    wp_register_script( 'jquery-isotope', assets() . 'vendor/isotope/jquery.isotope.js', false, false, true );
    wp_register_script( 'jquery-knob', assets() . 'vendor/jquery.knob.js', false, false, true );
    
    wp_register_script( 'jquery-theme', assets() . 'js/theme.js', false, false, true );
    
    // gmap
    wp_register_script( 'gmap-api', 'http://maps.google.com/maps/api/js?sensor=false', false, false, true );
    wp_register_script( 'jquery-gmap', assets() . 'vendor/jquery.gmap.js', false, false, true );
    
    // style switcher
    wp_register_script( 'jquery-cookie', assets() . 'vendor/jquery.cookie.js', false, false, true );
    wp_register_script( 'style-switcher', assets() . 'master/style-switcher/style.switcher.js', false, false, true );
    
    $deps = array(
        'jquery-plugins',
        'jquery-easing',
        'jquery-appear'
    );
    
    if( current_theme_supports( 'theme-demo' ) ) {
        $deps[] = 'jquery-cookie';
        $deps[] = 'style-switcher';
    }
    
    $deps = array_merge( $deps, array(
        'bootstrap',
        'twitterjs',
        'selectnav',
        'jquery-flexslider',
        'jquery-flipshow',
        'jquery-magnific',
        'jquery-validate',
        'nivoslider',
        'jquery-knob',
        'jquery-stellar',
        'jquery-jflickrfeed'
    ));
    
    // contact form 7
    if( defined( 'WPCF7_VERSION' ) ) {
        wp_register_script( 'contact-form', assets_js( 'contactform-script.js' ), array( 'jquery', 'jquery-form' ), WPCF7_VERSION, true );
        $deps[] = 'contact-form';
    }
    
    $deps[] = 'jquery-theme';
    
    // custom scripts
    wp_register_script( 'custom-script', assets_js() . 'custom.js', $deps, '2.1', true );

    /**
     * Enqueue All
     */
    wp_enqueue_script( 'custom-script' );
    
    $ajax_loader = function_exists( 'wpcf7_ajax_loader' ) ? wpcf7_ajax_loader() : '';
    $theme_settings = array(
        'ajaxURL' => admin_url( 'admin-ajax.php' ),
        'twitter_feed' => admin_url( 'admin-ajax.php?action=spyropress_twitter_tweets' ),
        'loaderUrl' => $ajax_loader,
		'sending' => __( 'Sending ...', 'wpcf7' ),
        'assets' => assets()
    );
    
    if ( defined( 'WP_CACHE' ) && WP_CACHE )
		$theme_settings['cached'] = 1;

	if ( function_exists( 'wpcf7_support_html5_fallback' ) && wpcf7_support_html5_fallback() )
		$theme_settings['jqueryUi'] = 1;
    
    wp_localize_script( 'jquery-easing', 'theme_settings', $theme_settings );
}

function spyropress_conditional_scripts() {

    $content = '
  		<!--[if IE]>
			<link rel="stylesheet" href="' . assets_css() . 'ie.css">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="' . assets() . 'vendor/respond.js"></script>
		<![endif]-->';

    echo get_relative_url( $content );
}
?>