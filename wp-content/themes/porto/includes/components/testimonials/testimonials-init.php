<?php

/**
 * Testomonial Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressTestomonial extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_filter( 'builder_include_modules', array( $this, 'register_module' ) );
    }

    function register() {

        // Init Post Type
        $args = array(
            'supports' => array( 'title', 'thumbnail' ),
            'title' => 'Enter name here..',
            'has_archive'   => false,
            'exclude_from_search' => true
        );
        $post = new SpyropressCustomPostType( 'Testimonial', 'testimonial', $args );

        // Add Taxonomy
        $post->add_taxonomy( 'Testimonial Category', '', 'Categories', array( 'hierarchical' => true ) );
        
        // Add Meta Boxes
        $meta_fields['testimonial'] = array(
            array(
                'label' => 'Testimonial',
                'type' => 'heading',
                'slug' => 'testimonial'
            ),

            array(
                'label' => 'Designation',
                'id' => 'designation',
                'type' => 'text'
            ),

            array(
                'label' => 'Company',
                'id' => 'website',
                'type' => 'text'
            ),

            array(
                'label' => 'Testimonial',
                'id' => 'testimonial',
                'type' => 'editor'
            )
        );

        $post->add_meta_box( 'testimonial_info', 'Testimonial', $meta_fields, '_testimonial', false, 'normal', 'high' );
    }

    function register_module( $modules ) {

        $modules[] = $this->path . '/module/module.php';

        return $modules;
    }
}

/**
 * Init the Component
 */
new SpyropressTestomonial();

?>