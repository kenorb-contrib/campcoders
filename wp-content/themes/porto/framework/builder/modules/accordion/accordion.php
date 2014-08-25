<?php

/**
 * Module: Accordion
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Accordions extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.

        $this->cssclass = '';
        $this->description = __( 'Accordion Builder.', 'spyropress' );
        $this->id_base = 'accordion';
        $this->name = __( 'Accordions', 'spyropress' );

        // Fields
        $this->fields = array(
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text'
            ),
            
            array(
                'label' => 'Animation',
                'id' => 'animation',
                'type' => 'select',
                'options' => spyropress_get_options_animation()
            ),
            
            array(
                'label' => __( 'Accordion', 'spyropress' ),
                'id' => 'accordions',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Icon', 'spyropress' ),
                        'id' => 'icon',
                        'type' => 'select',
                        'options' => spyropress_get_options_fontawesome_icons(),
                        'desc' => 'See the <a target="_blank" href="http://fontawesome.io/icons/">icons here</a>.'
                    ),
                    
                    array(
                        'label' => __( 'Accordion Bucket', 'spyropress' ),
                        'id' => 'bucket',
                        'type' => 'select',
                        'desc' => 'If you want to use complex html instead of plain text.',
                        'options' => spyropress_get_buckets()
                    ),
                    
                    array(
                        'label' => __( 'Content', 'spyropress' ),
                        'id' => 'content',
                        'type' => 'textarea',
                        'rows' => 7
                    )
                )
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        extract( $args ); extract( $instance );
        // get view to render
        include $this->get_view();
    }

}
global $accordion_ids;
spyropress_builder_register_module( 'Spyropress_Module_Accordions' );
?>