<?php

/**
 * Module: Feature List
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Feature_List extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path = dirname( __FILE__ );
        
        $this->cssclass = 'feature';
        $this->description = __( 'List your features.', 'spyropress' );
        $this->id_base = 'feature';
        $this->name = __( 'Features', 'spyropress' );
        
        $this->templates['list'] = array(
            'label' => 'Features List'
        );
        
        $this->templates['list2'] = array(
            'label' => 'Features List 2'
        );
        
        $this->templates['boxes'] = array(
            'label' => 'Features Boxes',
            'view' => 'boxes.php'
        );
        
        // Fields
        $this->fields = array(
            
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text',
            ),
            
            array(
                'label' => 'Animation',
                'id' => 'animation',
                'type' => 'select',
                'options' => spyropress_get_options_animation()
            ),
            
            array(
                'label' => 'Styles',
                'id' => 'style',
                'type' => 'select',
                'options' => $this->get_option_templates(),
                'std' => 'list'
            ),
            
            array(
                'label' => 'Columns',
                'id' => 'columns',
                'type' => 'select',
                'options' => array(
                    1 => '1 Column',
                    2 => '2 Column',
                    3 => '3 Column',
                    4 => '4 Column',
                )
            ),
            
            array(
                'label' => __( 'Feature', 'spyropress' ),
                'id' => 'features',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text',
                    ),
                    
                    array(
                        'label' => __( 'Teaser', 'spyropress' ),
                        'id' => 'teaser',
                        'type' => 'textarea',
                        'rows' => 5
                    ),
                    
                    array(
                        'label' => __( 'Icon', 'spyropress' ),
                        'id' => 'icon',
                        'type' => 'select',
                        'options' => spyropress_get_options_fontawesome_icons(),
                        'desc' => 'See the <a target="_blank" href="http://fontawesome.io/icons/">icons here</a>.'
                    ),
                    
                    array(
                        'label' => 'Skin',
                        'id' => 'skin',
                        'type' => 'select',
                        'options' => array(
                            'primary' => 'Primary',
                            'secundary' => 'Secondary',
                            'tertiary' => 'Tertiary',
                            'quaternary' => 'Quaternary',
                        ),
                        'std' => 'primary'
                    ),   
                )
            )
        );

        $this->create_widget();
    }
    
    function generate_item( $item, $atts ) {
        
        return '
        <div class="' . $atts['column_class'] . '">
            <div class="feature-box' . $atts['box_class'] . '">
    			<div class="feature-box-icon">
    				<i class="icon ' . $item['icon'] . '"></i>
    			</div>
    			<div class="feature-box-info">
    				<h4 class="shorter">' . $item['title'] . '</h4>
    				<p class="tall">' . $item['teaser'] . '</p>
    			</div>
    		</div>
        </div>';
    }
    
    function generate_box_item( $item, $atts ) {
        
        return '
        <div class="' . $atts['column_class'] . '">
			<div class="featured-box featured-box-' . $item['skin'] . '">
				<div class="box-content">
					<i class="icon-featured icon ' . $item['icon'] . '"></i>
					<h4>' . $item['title'] . '</h4>
					<p>' . $item['teaser'] . '</p>
				</div>
			</div>
		</div>';
    }

    function widget( $args, $instance ) {

        // extracting info
        extract( $args ); extract( $instance );
        
        // get view to render
        include $this->get_view( $style );
    }

}
spyropress_builder_register_module( 'Spyropress_Module_Feature_List' );

?>