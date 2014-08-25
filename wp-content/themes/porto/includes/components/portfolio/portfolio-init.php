<?php

/**
 * Portfolio Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressPortfolio extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_filter( 'builder_include_modules', array( $this, 'register_module' ) );
        add_filter( 'spyropress_register_widgets', array( $this, 'register_widgets' ) );
    }

    function register() {

        // Init Post Type
        $args = array(
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'   => false,
            'exclude_from_search' => true
        );
        $post = new SpyropressCustomPostType( 'Portfolio', '', $args );
        
        // Add Taxonomy
        $post->add_taxonomy( 'Category', 'portfolio_category', 'Portfolio Categories', array( 'hierarchical' => true ) );
        $post->add_taxonomy( 'Services', 'portfolio_service', 'Services', array( 'hierarchical' => false ) );
        
        // Add Meta Boxes
        $meta_fields['portfolio'] = array(
            array(
                'label' => 'Portfolio',
                'type' => 'heading',
                'slug' => 'portfolio'
            ),
    
            array(
                'label' => 'Project URL',
                'id' => 'project_url',
                'type' => 'text'
            ),
            
            array(
                'label' => 'Client',
                'id' => 'project_client',
                'type' => 'text'
            ),
            
            array(
                'label' => 'Client Testimonial',
                'id' => 'project_testimonial',
                'type' => 'textarea',
                'rows' => 7
            ),
            
            array(
                'label' => 'Showcase Type',
                'id' => 'p_type',
                'type' => 'select',
                'options' => array(
                    'gallery' => 'Gallery',
                    'video' => 'Video'
                ),
                'class' => 'enable_changer'
            ),
            
            array(
                'label' => 'Gallery',
                'desc' => 'Click to upload images',
                'id' => 'gallery',
                'type' => 'gallery',
                'class' => 'p_type gallery'
            ),
            
            array(
                'label' => 'Video',
                'id' => 'video',
                'type' => 'textarea',
                'rows' => 5,
                'class' => 'p_type video'
            ),
            
        );
        
        $post->add_meta_box( 'portfolio', 'Portfolio Details', $meta_fields, false, false, 'normal', 'high' );
    }
    
    function register_module( $modules ) {

        $modules[] = $this->path . '/recent-portfolio/portfolio.php';

        return $modules;
    }
    
    function register_widgets( $widgets ) {
        $widgets[] = $this->path . '/recent-works/widget.php';
        
        return $widgets;
    }
}

/**
 * Init the Component
 */
new SpyropressPortfolio();
?>