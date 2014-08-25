<?php

/**
 * Module: Posts
 * Display a list of recent posts
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Recent_Posts extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path = dirname( __FILE__ );

        $this->description = __( 'Display a list of recent posts.', 'spyropress' );
        $this->id_base = 'srecent_posts';
        $this->cssclass = 'recent-posts';
        $this->name = __( 'Recent Posts', 'spyropress' );

        // Fields
        $this->fields = array(

            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text',
                'std' => $this->name
            ),

            array(
                'label' => __( 'Number of items per page', 'spyropress' ),
                'id' => 'limit',
                'type' => 'text',
                'std' => 6
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
                'label' => __( 'Category', 'spyropress' ),
                'id' => 'cat',
                'type' => 'multi_select',
                'options' => spyropress_get_taxonomies( 'category' )
            ),

            array(
                'id' => 'url_enable',
                'type' => 'checkbox',
                'options' => array(
                    '1' => 'Show Archive Link'
                )
            ),

            array(
                'label' => __( 'Link to Text', 'spyropress' ),
                'id' => 'url_text',
                'type' => 'text',
                'std' => 'View All'
            ),
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        extract( $args );

        // get view to render
        include $this->get_view();
    }

    function query( $atts, $content = null ) {

        $default = array (
            'post_type' => 'post',
            'limit' => -1,
            'row_container' => 'li',
            'row_class' => '',
            'columns' => 2,
            'pagination' => false,
            'callback' => array( $this, 'generate_item' )
        );
        $atts = wp_parse_args( $atts, $default );

        if ( ! empty( $atts['cat'] ) ) {

            $atts['tax_query']['relation'] = 'OR';
            if ( ! empty( $atts['cat'] ) ) {
                $atts['tax_query'][] = array(
                    'taxonomy' => 'category',
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

        // these arguments will be available from inside $content
        $image = array(
            'post_id' => $post_ID,
            'echo' => false,
        );
        $image_tag = get_image( $image );

        // item tempalte
        $item_tmpl = '
        <div class="' . $atts['column_class'] . '">
			<article>
				<div class="date">
					<span class="day">' . get_the_date( 'j' ) . '</span>
					<span class="month">' . get_the_date( 'M' ) . '</span>
				</div>
				<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
                <p>' . spyropress_get_excerpt( 'by=words&length=18&link_to_post=0&ellipsis=&before_text=&after_text=' ) . '
                <a href="' . get_permalink() . '" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
			</article>
		</div>';

        return $item_tmpl;
    }
}

spyropress_builder_register_module( 'Spyropress_Module_Recent_Posts' );
?>