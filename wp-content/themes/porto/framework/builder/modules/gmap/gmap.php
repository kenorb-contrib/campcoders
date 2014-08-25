<?php

/**
 * Module: Gmap
 * Add headings into the page layout wherever needed.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Gmap extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->description = __( 'Add google map markers work with google map row only.', 'spyropress' );
        $this->id_base = 'gmap_markers';
        $this->name = __( 'Google Map Markers', 'spyropress' );

        // Fields
        $this->fields = array(

            array(
                'labels' => 'Markers',
                'id' => 'markers',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Description', 'spyropress' ),
                        'id' => 'desc',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Address', 'spyropress' ),
                        'id' => 'address',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Latitude', 'spyropress' ),
                        'id' => 'lat',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Longitude', 'spyropress' ),
                        'id' => 'long',
                        'type' => 'text'
                    )
                )
            ),
            
            array(
                'label' => __( 'Initial Location', 'spyropress' ),
                'type' => 'sub_heading',
                'desc' => 'Find the Latitude and Longitude of your address:<br />
                        - http://universimmedia.pagesperso-orange.fr/geo/loc.htm<br />
                        - http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/'
            ),
            
            array(
                'label' => __( 'Latitude', 'spyropress' ),
                'id' => 'init_lat',
                'type' => 'text',
                'std' => '37.09024'
            ),
            
            array(
                'label' => __( 'Longitude', 'spyropress' ),
                'id' => 'init_long',
                'type' => 'text',
                'std' => '-95.71289'
            ),
            
            array(
                'label' => 'Google Map Options',
                'type' => 'toggle'
            ),
            
            
            array(
                'label' => __( 'Zoom Level', 'spyropress' ),
                'id' => 'zoom',
                'type' => 'range_slider',
                'min' => 1,
                'max' => 20,
                'std' =>16
            ),
            
            array(
                'type' => 'toggle_end'
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        extract( $args ); extract( $instance );

        if( empty( $markers ) ) return;
        
        wp_enqueue_script( 'gmap-api' );
        wp_enqueue_script( 'jquery-gmap' );
        
        $zoom = ( $zoom ) ? $zoom : 5;
        
        $markers_js = '';
        $count = count( $markers );
        foreach( $markers as $marker ) {
            $anchor = '';
            if( !empty( $marker['lat'] ) && !empty( $marker['long'] ) )
                $anchor = '<br><br><a href=\'#\' onclick=\'mapCenterAt({latitude: ' . $marker['lat'] . ', longitude: ' . $marker['long'] . ', zoom: 16}, event)\'>[+] zoom here</a>';
            
            $popup = ( 1 == $count ) ? ',popup: true' : '';
            $markers_js .= '
            {
                address: "' . $marker['address'] . '",
				html: "<strong>' . $marker['title'] . '</strong><br>' . $marker['desc'] . $anchor . '",
				icon: {
					image: "' . assets_img( 'pin.png' ) . '",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				}
                ' . $popup . '
			},';
        }
        
        $markers_js = '// Map Markers' . "\n" . 'var mapMarkers = [' . $markers_js . '];';
        
        $markers_js .= "\n\n" . '// Map Initial Location' . "\n";
        $markers_js .= 'var initLatitude = ' . $init_lat . ';' . "\n";
        $markers_js .= 'var initLongitude = ' . $init_long . ';' . "\n";
        
        $markers_js .= "\n\n" . '// Map Extended Settings' . "\n";
        $markers_js .= '
        var mapSettings = {
            controls: {
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true
			},
            scrollwheel: false,
			markers: mapMarkers,
			latitude: initLatitude,
            longitude: initLongitude,
            zoom: ' . $zoom . '
        };
        
        var map = $("#googlemaps").gMap(mapSettings);';
        
        $centerat_js = "\n\n" . '// Map Center At' . "\n";
        $centerat_js .= '
        var mapCenterAt = function(options, e) {
            e.preventDefault();
            jQuery("#googlemaps").gMap("centerAt", options);
        }';
        
        add_jquery_ready( $markers_js );
        add_inline_js( $centerat_js );
    }
}

spyropress_builder_register_module( 'Spyropress_Module_Gmap' );

?>