<?php

/**
 * Module: Progress Bars
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Progress_Bars extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path = dirname( __FILE__ );
        
        $this->description = __( 'Display count as progres bars.', 'spyropress' );
        $this->id_base = 'spyroress_progress_bars';
        $this->name = __( 'Progress Bars', 'spyropress' );
        
        // Fields
        $this->fields = array(
            
            array(
                'label' => __( 'Bars', 'spyropress' ),
                'id' => 'bars',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => 'Counter',
                        'id' => 'count',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => 'Bar Skin',
                        'id' => 'skin',
                        'type' => 'select',
                        'options' => spyropress_get_options_bs_skins(),
                        'std' => 'primary'
                    ),
                    
                    array(
                        'label' => 'Extra Options',
                        'id' => 'extra',
                        'type' => 'multi_select',
                        'options' => array(
                            'progress-striped' => 'Striped',
                            'active' => 'Animate',
                        )
                    ),
                )
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        extract( $args ); extract( $instance );
        
        if( empty( $bars ) ) return;
        
        // get view to render
        include $this->get_view();
    }

}
spyropress_builder_register_module( 'Spyropress_Module_Progress_Bars' );
?>