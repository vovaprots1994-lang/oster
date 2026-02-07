<?php 
/**
 * General functions
 * Text Domain: wprs //please change text domain globally
 */

//--constants
define( 'THEME_URI', 		get_template_directory_uri() );
define( 'THEME_URL',		get_template_directory() );
define( 'THEME_HOME_URL', 	home_url('/') );
define( 'SCRIPT_VER', 		"5.3");


//--includes
get_template_part ('functions/class-aq_resize');
get_template_part ('functions/taxonomy');
get_template_part ('functions/class/init');
get_template_part ('functions/convert_to_webp');


//--Sets up theme defaults and registers support for various WordPress features.--//
function wprs_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	//-- localization support --//
	$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
    load_textdomain( 'wprs', THEME_URL . '/lang/wprs-' . $locale . '.mo' );
    load_theme_textdomain( 'wprs', THEME_URL . '/lang' );

	//--This theme uses wp_nav_menu() in two locations.--//
	register_nav_menus( array(
		'primary_menu'     => 'Primary Menu'
	) );
}
add_action( 'after_setup_theme', 'wprs_setup' );

get_template_part ('shop/class/class-shop');


function register_custom_addons_post_type() {
    $labels = array(
        'name'                  => 'Мої додатки',
        'singular_name'         => 'Додаток',
        'menu_name'             => 'Мої додатки',
        'add_new'               => 'Додати новий',
        'add_new_item'          => 'Додати новий додаток',
        'edit_item'             => 'Редагувати додаток',
        'new_item'              => 'Новий додаток',
        'view_item'             => 'Переглянути додаток',
        'search_items'          => 'Шукати додатки',
        'not_found'             => 'Додатків не знайдено',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=product',
        'menu_icon'             => 'dashicons-products',
        'supports'              => array('title', 'editor', 'thumbnail'),
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'my-addons'),
    );

    register_post_type('my_addon', $args);
}
add_action('init', 'register_custom_addons_post_type');

add_action('woocommerce_before_calculate_totals', function($cart) {

	if (did_action('woocommerce_before_calculate_totals') >= 2) return;
	foreach ($cart->get_cart() as $cart_item){
		if (isset($cart_item['modifiers_ids']) && !empty($cart_item['modifiers_ids'])){
			$base_price = $cart_item['data']->get_price();
			$addon_total = 0;
			foreach ($cart_item['modifiers_ids'] as $addon_id){
				$addon_price = get_field('price', $addon_id);
				$addon_total += floatval($addon_price);
			}
			$cart_item['data']->set_price($base_price + $addon_total);
		}
	}
    
});