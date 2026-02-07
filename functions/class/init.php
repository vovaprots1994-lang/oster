<?php
class WPRS_Theme {

	public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'get_footer', [ $this, 'enqueue_footer_styles' ] );
    }
    public function enqueue_scripts() {
        // Styles
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
        
        wp_dequeue_style('brands-styles');
        wp_deregister_style('brands-styles');

        wp_dequeue_style( 'wc-blocks-style' );
        wp_deregister_style( 'wc-blocks-style' );


        // Script
        if (is_front_page() || is_home()) {
            wp_dequeue_style('contact-form-7');
            wp_deregister_style('contact-form-7');
            wp_dequeue_script('contact-form-7');
            wp_deregister_script('contact-form-7');
        }

        wp_dequeue_script( 'jquery-blockui' );
        wp_deregister_script( 'jquery-blockui' );

        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_script( 'wc-checkout' );
        wp_dequeue_script( 'wc-cart' );
        

        wp_enqueue_style( 'main', THEME_URI . '/css/main.css', [], SCRIPT_VER );

        // JavaScript
        wp_deregister_script('jquery');
        wp_enqueue_script( 'jquery',        THEME_URI . '/js/vendors/jquery.min.js', [], null, [ 'strategy'  => 'defer']);
        wp_enqueue_script( 'global',        THEME_URI . '/js/app-global.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'inputmask',     THEME_URI . '/js/vendors/jquery.inputmask.min.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'sumoselect',    THEME_URI . '/js/vendors/jquery.sumoselect.min.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'moment',        THEME_URI . '/js/vendors/moment.min.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'lightpick',     THEME_URI . '/js/vendors/lightpick.min.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'appform',       THEME_URI . '/js/app-form.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'swiperbundle',  THEME_URI . '/js/vendors/swiper-bundle.min.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'appswiper',     THEME_URI . '/js/app-swiper.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'cookies',       THEME_URI . '/js/app-cookies.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'product',       THEME_URI . '/js/app-product.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'product2',       THEME_URI . '/js/wp-js.js', [ 'jquery' ], SCRIPT_VER, true );

        wp_enqueue_script( 'lightgallery',  THEME_URI . '/js/vendors/lightgallery-all.min.js', [ 'jquery' ], SCRIPT_VER, true );
        wp_enqueue_script( 'gallery',       THEME_URI . '/js/app-gallery.js', [ 'jquery' ], SCRIPT_VER, true );
        
        if(is_page_template('templates/contact.php')){
            $google_api = get_field('map_api_key', 'options');
            wp_enqueue_script( 'googleapis',        "https://maps.googleapis.com/maps/api/js?key=".$google_api."&libraries=geometry,places&sensor=true&v=3&language=en", null, SCRIPT_VER, true);
            wp_enqueue_script( 'infobox',           THEME_URI . '/js/vendors/infobox.js', [ 'jquery' ], SCRIPT_VER, true );
            wp_enqueue_script( 'markerclusterer',   THEME_URI . '/js/vendors/markerclusterer.js', [ 'jquery' ], SCRIPT_VER, true );
            wp_enqueue_script( 'appmap',            THEME_URI . '/js/app-map.js', [ 'jquery' ], SCRIPT_VER, true );
        }
        if(is_checkout() || is_page_template('templates/delivery.php')){
            $google_api = get_field('map_api_key', 'options');
            wp_enqueue_script( 'googleapis',        "https://maps.googleapis.com/maps/api/js?key=".$google_api."&libraries=geometry,places&sensor=true&v=3&language=en", null, SCRIPT_VER, true);
            wp_enqueue_script( 'infobox',           THEME_URI . '/js/vendors/infobox.js', [ 'jquery' ], SCRIPT_VER, true );
            wp_enqueue_script( 'appmapcheckout',    THEME_URI . '/js/app-map-checkout.js', [ 'jquery' ], SCRIPT_VER, true );
        }

        if(!is_front_page()){
            wp_enqueue_script( 'inputmask',     THEME_URI . '/js/vendors/jquery.inputmask.min.js', array('jquery'), SCRIPT_VER, true );
        }

        // Add AJAX URL
        wp_localize_script( 'product2', 'ajaxurl', [
            'url'   => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'eatgoajax-nonce' ),
        ] );

    }

    public function enqueue_footer_styles() {
        wp_enqueue_style( 'bootstrap',      THEME_URI . '/css/vendors/bootstrap-grid.css', [], SCRIPT_VER );
        wp_enqueue_style( 'style',          THEME_URI . '/css/style.css', [], SCRIPT_VER );
        wp_enqueue_style( 'swiper',         THEME_URI . '/css/swiper-style.css', [], SCRIPT_VER );
        wp_enqueue_style( 'sumoselect',     THEME_URI . '/css/vendors/sumoselect.min.css', [], SCRIPT_VER );
        wp_enqueue_style( 'form-style',     THEME_URI . '/css/form-style.css', [], SCRIPT_VER );

        wp_enqueue_style( 'lightgallery',   THEME_URI . '/css/vendors/lightgallery.min.css', [], SCRIPT_VER );
        wp_enqueue_style( 'gallery',        THEME_URI . '/css/gallery-style.css', [], SCRIPT_VER );

        wp_enqueue_style( 'wp-style', get_stylesheet_uri(), [], SCRIPT_VER );
    }
}

new WPRS_Theme();