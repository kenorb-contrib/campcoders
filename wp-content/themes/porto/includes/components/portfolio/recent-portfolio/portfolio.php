<?php

/**
 * Module: Portfolio Carousel
 * Display a list of portfolio in carousel
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Recent_Portfolio_Carousel extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path = dirname( __FILE__ );
        
        $this->description = __( 'Display a list of portfolio.', 'spyropress' );
        $this->id_base = 'recent_portfolio';
        $this->name = __( 'Portfolio', 'spyropress' );

        // Templates
        $this->templates['listing'] = array(
            'label' => 'Listing'
        );
        
        $this->templates['carousel'] = array(
            'label' => 'Carousel',
            'view' => 'carousel.php'
        );
        
        // Fields
        $this->fields = array(

            array(
                'label' => __( 'Templates', 'spyropress' ),
                'id' => 'template',
                'type' => 'select',
                'options' => $this->get_option_templates(),
                'std' => 'listing',
                'class' => 'enable_changer section-full'
            ),
            
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text',
                'std' => $this->name
            ),

            array(
                'label' => __( 'Number of items', 'spyropress' ),
                'id' => 'limit',
                'type' => 'range_slider',
                'std' => 6
            ),
            
            array(
                'label' => __( 'Number of Columns', 'spyropress' ),
                'id' => 'columns',
                'class' => 'template listing section-full',
                'type' => 'range_slider',
                'std' => 2,
                'max' => 4
            ),
                
            array(
                'label' => __( 'Portfolio Category', 'spyropress' ),
                'id' => 'cat',
                'type' => 'multi_select',
                'options' => spyropress_get_taxonomies( 'portfolio_category' )
            ),
            
            array(
                'id' => 'filters',
                'type' => 'checkbox',
                'class' => 'template listing section-full',
                'options' => array(
                    1 => 'Show portfolio filters'
                )
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {
        
        // extracting info
        extract( $args );
        
        $template = isset( $instance['template'] ) ? $instance['template'] : '';
        $title = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : '';

        // get view to render
        include $this->get_view( $template );
    }
    
    function query( $atts, $content = null ) {

        $default = array (
            'post_type' => 'portfolio',
            'limit' => -1,
            'columns' => false,
            'pagination' => false,
            'callback' => array( $this, 'generate_item' ),
            'item_class' => 'isotope-item'
        );
        $atts = wp_parse_args( $atts, $default );
    
        if ( ! empty( $atts['cat'] ) ) {
    
            $atts['tax_query']['relation'] = 'OR';
            if ( ! empty( $atts['cat'] ) ) {
                $atts['tax_query'][] = array(
                    'taxonomy' => 'portfolio_category',
                    'field' => 'slug',
                    'terms' => $atts['cat'],
                    );
                unset( $atts['cat'] );
            }
        }
        
        if ( $content )
            return token_repalce( $content, spyropress_query_generator( $atts ) );
    
        return spyropress_query_generator( $atts );
    }
    
    // Item HTML Generator
    function generate_item( $post_ID, $atts ) {
        
        // images
        $width = ( 2 == $atts['columns'] ) ? 600 : 450;
        $image = array(
            'post_id' => $post_ID,
            'echo' => false,
            'width' => $width,
            'responsive' => true,
            'class' => 'img-responsive'
        );
        $image_tag = get_image( $image );
        
        // cats
        $cat = $cat_name = array();
        $terms = get_the_terms( $post_ID, 'portfolio_category' );
        if( !empty( $terms ) && !is_wp_error( $terms ) ) {
            foreach( $terms as $item ) {
                $cat[] = $item->slug;
                $cat_name[] = $item->name;
            }
        }
        
        // item tempalte
        $item_tmpl = '
        <li class="' . $atts['column_class'] . ' ' . join( ' ', $cat ) . '">
			<div class="portfolio-item img-thumbnail">
				<a href="' . get_permalink() . '" class="thumb-info">
					' . $image_tag . '
					<span class="thumb-info-title">
						<span class="thumb-info-inner">' . get_the_title() . '</span>
						<span class="thumb-info-type">' . join( ', ', $cat_name ) . '</span>
					</span>
					<span class="thumb-info-action">
						<span title="Universal" href="#" class="thumb-info-action-icon"><i class="icon icon-link"></i></span>
					</span>
				</a>
			</div>
		</li>';
        
        return $item_tmpl;
    }
    
    function generate_item_carousel( $post_ID, $atts ) {
        
        // images
        $image = array(
            'post_id' => $post_ID,
            'echo' => false,
            'width' => 450,
            'responsive' => true,
            'class' => 'img-responsive'
        );
        $image_tag = get_image( $image );
        
        $image['width'] = get_option( 'large_size_w' );
        $image['class'] = 'img-thumbnail img-responsive';
        $full_image = get_image( $image );
        
        // live url
        $live_url = get_post_meta( $post_ID, 'project_url', true );
        $live_url = ( $live_url ) ? $live_url : '#';
        
        // cats
        $cat_name = array();
        $terms = get_the_terms( $post_ID, 'portfolio_category' );
        if( !empty( $terms ) && !is_wp_error( $terms ) ) {
            foreach( $terms as $item ) {
                $cat_name[] = $item->name;
            }
        }
        
        $services = '';
        $terms = get_the_terms( $post_ID, 'portfolio_service' );
        if( !empty( $terms ) && !is_wp_error( $terms ) ) {
            foreach( $terms as $term ) {
                $services .= '<li><i class="icon icon-check"></i> ' . $term->name . '</li>';
            }
        }
        
        // item tempalte
        $item_tmpl = '
		<div class="' . $atts['column_class'] . '">
			<div class="portfolio-item thumbnail">
				<a class="thumb-info lightbox" href="#popupProject' . $post_ID . '" data-plugin-options=\'{"type":"inline", preloader: false}\'>
					' . $image_tag . '
					<span class="thumb-info-title">
						<span class="thumb-info-inner">' . get_the_title() . '</span>
						<span class="thumb-info-type">' . join( ', ', $cat_name ) . '</span>
					</span>
					<span class="thumb-info-action">
						<span title="Universal" href="#" class="thumb-info-action-icon"><i class="icon icon-link"></i></span>
					</span>
				</a>
			</div>
            <div id="popupProject' . $post_ID . '" class="popup-inline-content">
				<h2>' . get_the_title() . '</h2>
				<div class="row">
					<div class="col-md-6">
						' . $full_image . '
					</div>

					<div class="col-md-6">
						<h4>Project <strong>' . get_setting( 'portfolio_desc_title' ) . '</strong></h4>
						' . get_the_content() . '
						
                        <a href="' . $live_url . '" class="btn btn-primary" target="_blank">' . get_setting( 'portfolio_preview_title' ) . '</a> <span class="arrow hlb"></span>
						<h4 class="pull-top">' . get_setting( 'portfolio_service_title' ) . '</h4>
						<ul class="list icons list-unstyled">
							' . $services . '
						</ul>

					</div>
				</div>
			</div>
        </div>';
        
        return $item_tmpl;
    }
}

spyropress_builder_register_module( 'Spyropress_Module_Recent_Portfolio_Carousel' );
?>