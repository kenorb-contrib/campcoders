<?php

/**
 * Post Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressPost extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
    }

    function register() {

        // Init Post Type
        $post = new SpyropressCustomPostType( 'Post' );
        
        // Add Meta Boxes
        $meta_fields['options'] = array(
            array(
                'label' => 'Portfolio',
                'type' => 'heading',
                'slug' => 'portfolio'
            ),
            
            array(
                'label' => 'Gallery',
                'desc' => 'Click to upload images',
                'id' => 'gallery',
                'type' => 'gallery'
            )
        );
        
        $post->add_meta_box( 'post_options', 'Post Options', $meta_fields, false, false, 'normal', 'high' );
    }
}

/**
 * Init the Component
 */
new SpyropressPost();
?>