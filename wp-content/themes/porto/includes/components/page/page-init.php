<?php

/**
 * Page Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressPage extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
    }

    function register() {

        // Init Post Type
        $post = new SpyropressCustomPostType( 'Page' );
        
        // Add Meta Boxes
        $meta_fields['options'] = array(
            array(
                'label' => 'Slider',
                'type' => 'heading',
                'slug' => 'options'
            ),
            
            array(
                'label' => 'Slider',
                'type' => 'sub_heading',
            ),
            
            array(
                'label' => 'Slider Type',
                'id' => 'slider',
                'type' => 'select',
                'class' => 'enable_changer',
                'options' => array(
                    'nivo' => 'Nivo Slider',
                    'rev' => 'Revolution Slider'
                )
            ),
            
            array(
                'label' => 'Nivo Slider',
                'id' => 'nivo_slider',
                'type' => 'select',
                'class' => 'slider nivo',
                'options' => spyropress_get_sliders()
            ),
        );
        
        if( class_exists( 'RevSlider' ) ) {
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSlidersShort();
        
            $meta_fields['options'][] = array(
                'label' => 'Revolution Slider',
                'id' => 'rev_slider',
                'type' => 'select',
                'class' => 'slider rev',
                'options' => $arrSliders
            );
            
            $meta_fields['options'][] = array(
                'label' => 'Revolution Slider Skin',
                'id' => 'rev_slider_skin',
                'type' => 'select',
                'class' => 'slider rev',
                'options' => array(
                    'dark' => 'Dark',
                    'light' => 'Light',
                    'full' => 'FullScreen'
                ),
                'std' => 'dark'
            );
        }
        
        $meta_fields['options'][] = array(
            'label' => 'Header',
            'type' => 'sub_heading',
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Header Type',
            'id' => 'top_header',
            'type' => 'select',
            'class' => 'enable_changer',
            'options' => array(
                'none' => 'None',
                'default' => 'Default',
                'custom' => 'Custom Header'
            ),
            'std' => 'default'
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Custom Header Bucket',
            'id' => 'bucket',
            'type' => 'select',
            'class' => 'top_header custom',
            'options' => spyropress_get_buckets()
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Custom Header Background',
            'id' => 'background',
            'type' => 'background',
            'class' => 'top_header custom'
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Top Border color',
            'id' => 'border_top',
            'type' => 'colorpicker',
            'class' => 'top_header custom'
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Bottom Border color',
            'id' => 'border_bottom',
            'type' => 'colorpicker',
            'class' => 'top_header custom'
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Layout',
            'type' => 'sub_heading',
        );
        
        $meta_fields['options'][] = array(
            'label' => 'Layout Type',
            'id' => 'layout_type',
            'type' => 'select',
            'options' => array(
                'full' => 'Full Width',
                'left' => 'Left Sidebar',
                'right' => 'Right Sidebar'
            ),
            'std' => 'full'
        );
        
        $post->add_meta_box( 'page_options', 'Page Options', $meta_fields, '_page_options', false, 'normal', 'high' );
    }
}

/**
 * Init the Component
 */
new SpyropressPage();
?>