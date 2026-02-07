<?php 
class cart{
	public function __construct() {
        add_action('wp_ajax_update_cart_product', [ $this, 'update_cart_product' ]);
		add_action('wp_ajax_nopriv_update_cart_product', [ $this, 'update_cart_product' ]);
		add_action('wp_ajax_open_cart', [ $this, 'open_cart' ]);
		add_action('wp_ajax_nopriv_open_cart', [ $this, 'open_cart' ]);
		add_action('wp_ajax_remove_cart_product', [ $this, 'remove_cart_product' ]);
        add_action('wp_ajax_nopriv_remove_cart_product', [ $this, 'remove_cart_product' ]);
    }
    
	public function update_cart_product(){
		file_put_contents(__DIR__.'/result.txt', print_r($_POST, true));
		if (empty($_POST['id']) && empty($_POST['key']))  {
		    die(json_encode( array(
		        'success'    => false,
		    )));
		}
		$id = intval($_POST['id']);
		$key = $_POST['key'];
		$qty = !empty($_POST['qty']) ? intval($_POST['qty']) : 1;
		$variation_id = !empty($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
		
		$modifiers_ids = array();
		if (!empty($_POST['addons'])) {
			$addons = json_decode(stripslashes($_POST['addons']), true);
			foreach ($addons as $addon_id => $addon_qty) {
				for ($i = 0; $i < $addon_qty; $i++) {
					$modifiers_ids[] = intval($addon_id);
				}
			}
		}

		$cart_item_data = array();
		if (!empty($modifiers_ids)) {
			$cart_item_data['modifiers_ids'] = $modifiers_ids;
			$cart_item_data['modifiers_ids_unique'] = md5(json_encode($modifiers_ids));
		}

		if (!empty($key)) {
			$result = WC()->cart->set_quantity($key, $qty);
		} else {
			if ($variation_id) {
				$key = WC()->cart->add_to_cart($id, $qty, $variation_id, array(), $cart_item_data);
			} else {
				$key = WC()->cart->add_to_cart($id, $qty, 0, array(), $cart_item_data);
			}
		}
		
		$cart = WC()->cart->get_cart();
		$line_subtotal = isset($cart[$key]) ? $cart[$key]['line_subtotal'] : 0;
		
		if (!empty($key) || !empty($result)) {
			die(json_encode( array(
		        'success'    => true,
		        'count' => WC()->cart->get_cart_contents_count(),
		        'total' => WC()->cart->get_subtotal(),
		        'subtotal' => $line_subtotal
		    )));
		}
	}
	
	public function remove_cart_product(){
    	if (empty($_POST['key'])) {
	        die();
	    }
	    
	    $key = $_POST['key'];
	    $result = WC()->cart->remove_cart_item($key);
	    
	    if ($result) {
	        die(json_encode(array(
	            'success' => true,
	            'count' => WC()->cart->get_cart_contents_count(),
	            'total' => WC()->cart->get_subtotal()
	        )));
	    } 
	}
	
	public function open_cart() {
	    ob_start();
	    get_template_part('shop/inc/cart');
	    $cartHtml = ob_get_clean();
	    
	    file_put_contents(__DIR__.'/cartHtml.txt', print_r($cartHtml, true));
	    die(json_encode( array(
	        'success'    => true,
	        'cartHtml' => $cartHtml,
	        'count' => WC()->cart->get_cart_contents_count(),
	    )));
	}
}
	
new cart();

add_filter('woocommerce_get_cart_item_from_session', function($cart_item, $values) {
    if (isset($values['modifiers_ids'])) {
        $cart_item['modifiers_ids'] = $values['modifiers_ids'];
    }
    return $cart_item;
}, 10, 2);



?>