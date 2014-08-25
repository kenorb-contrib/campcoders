<?php

/**
 * Pricing Table Component
 *
 * @package		SpyroPress
 * @category	Components
 */

/**
 * SpyropressPricingTable
 *
 * @package Default-WP
 * @author phpdesigner
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class SpyropressPricingTable extends SpyropressComponent {

    private $path;

    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_shortcode( 'pricing_table',  array( $this, 'shortcode_handler' ) );
    }

    function register() {

        // Init Post Type
        $args = array(
            'public' => false,
            'show_in_admin_bar' => true,
            'supports' => array( 'title' ),
            'has_archive' => false,
            'query_var' => false
        );
        $post_type = new SpyropressCustomPostType( 'Pricing Table', 'pricingtable', $args );

        // Shortcode Meta Box
        $instructions = '<p>' . __( 'Display price table anywhere into your posts, pages, custom post types or widgets by using the shortcode below:', 'spyropress' ) . '</p>';
        $instructions .= '<p><code>[pricing_table id={post_id}]</code></p>';

        $sc_fields['shortcode'] = array(
            array(
                'label' => 'shortcode',
                'type' => 'heading',
                'slug' => 'shortcode'
            ),

            array(
                'id' => 'instruction_info',
                'type' => 'raw_info',
                'function' => array( $this, 'set_post_id' ),
                'desc' => $instructions,
            ),

            array(
                'id' => 'columns',
                'label' => 'Columns',
                'type' => 'select',
                'class' => 'section-full',
                'options' => array(
                    3 => '3 Columns',
                    4 => '4 Columns',
                )
            ),
            
            array(
                'label' => 'Currency',
                'id' => 'currency',
                'class' => 'section-full',
                'type' => 'text'
            ),
            
            array(
                'label' => 'Button Text',
                'id' => 'btn_text',
                'class' => 'section-full',
                'type' => 'text'
            ),
            
            array(
                'label' => 'Popular Text',
                'id' => 'popular_text',
                'class' => 'section-full',
                'type' => 'text',
                'std' => 'Popular'
            ),
        );

        $post_type->add_meta_box( 'shortcode', 'Shortcode', $sc_fields, false, false, 'side' );

        // Add Meta Boxes
        $meta_fields['table'] = array(
            array(
                'label' => 'Table',
                'type' => 'heading',
                'slug' => 'table'
            ),

            array(
                'label' => __( 'Table', 'spyropress' ),
                'type' => 'repeater',
                'id' => 'tables',
                'item_title' => 'title',
                'hide_label' => true,
                'fields' => array(

                    array(
                        'id' => 'recommended',
                        'type' => 'checkbox',
                        'options' => array(
                            '1' => 'Most Popular'
                        )
                    ),

                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),

                    array( 'type' => 'row' ),

                        array( 'type' => 'col', 'size' => 6 ),

                            array(
                                'label' => __( 'Price', 'spyropress' ),
                                'id' => 'price',
                                'type' => 'text'
                            ),

                        array( 'type' => 'col_end' ),

                        array( 'type' => 'col', 'size' => 6 ),

                            array(
                                'label' => __( 'Button URL', 'spyropress' ),
                                'id' => 'url',
                                'type' => 'text'
                            ),

                        array( 'type' => 'col_end' ),

                    array( 'type' => 'row_end' ),

                    array(
                        'label' => __( 'Features', 'spyropress' ),
                        'type' => 'repeater',
                        'id' => 'features',
                        'item_title' => 'title',
                        'fields' => array(
                            array(
                                'label' => __( 'Title', 'spyropress' ),
                                'id' => 'title',
                                'type' => 'text'
                            )
                        )
                    )
                )
            )
        );

        $post_type->add_meta_box( 'tables', 'Tables', $meta_fields, false, false );
    }

    /**
     * Callback for post_ID for instruction box
     */
    function set_post_id( $output ) {
        global $post;
        return str_replace( '{post_id}', $post->ID, $output );
    }

    /**
     * Shortcode handler
     */
    function shortcode_handler( $atts, $content = '' ) {

        // check
        if( ! isset( $atts['id'] ) || empty( $atts['id'] ) ) return;

        $slider_id = $atts['id'];

        return $this->render_table( $slider_id );
    }

    function render_table( $slider_id ) {
        
        // get slider meta
        $meta = get_post_custom( $slider_id );

        // get slider type
        $columns = maybe_unserialize( $meta['tables'][0] );
        $currency = maybe_unserialize( $meta['currency'][0] );
        $popular_text = maybe_unserialize( $meta['popular_text'][0] );
        $btn_text = maybe_unserialize( $meta['btn_text'][0] );
        $count = maybe_unserialize( $meta['columns'][0] );
        
        if( empty( $columns ) ) return;
        
        $tables = '';
        foreach( $columns as $column ) {

            $class = ( 4 == $count ) ? 'col-md-3' : 'col-md-4';
            $plan_class = 'plan';
            $popular = '';
            if( isset( $column['recommended'] ) ) {
                $class .= ' center';
                $plan_class .= ' most-popular';
                $popular = '<div class="plan-ribbon-wrapper"><div class="plan-ribbon">' . $popular_text . '</div></div>';
            }

            $features = '';
            if( !empty( $column['features'] ) ) {
                foreach( $column['features'] as $feature ) {
                    $features .= '<li>' . $feature['title'] . '</li>';
                }
            }

            $tables .= '
            <div class="' . $class . '">
				<div class="' . $plan_class . '">
                    ' . $popular . '
					<h3>' . $column['title'] . '<span>' . $currency . $column['price'] . '</span></h3>
					<a class="btn btn-lg btn-primary" href="' . $column['url'] . '">' . $btn_text . '</a>
					<ul>' . $features . '</ul>
				</div>
			</div>';
        }
        return '<div class="row"><div class="pricing-table">' . $tables . '</div></div>';
    }
}

/**
 * Init the Component
 */
new SpyropressPricingTable();
?>