<?php 
defined('ABSPATH') || exit;

$product_id = $args['product_id'] ?? 0;

if (!$product_id) {
    return;
}

$product = wc_get_product($product_id);
$product_type = $product ? $product->get_type() : '';
$title   = get_the_title($product_id);
$excerpt = get_the_excerpt($product_id);
$stock_status_array = [
  'instock' => 'Товар в наявності', 
  'outofstock' => 'Товар під замовлення', 
  'onbackorder' => 'Немає в наявності'
];

$post_thumbnail_id    = get_post_thumbnail_id($product_id);
$thumbnail_alt        = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
$thumbnail_attachment = wp_get_attachment_image_src($post_thumbnail_id, 'full');
?>
<div class="prd-card js_product" data-product-id="<?php echo $product_id; ?>" data-filter="kebabs" data-price="128">

    <ul class="prd-labels">
        <li class="prd-label" style="background-color: #4147D5;">
            <img width="18" height="18" src="<?php echo get_template_directory_uri(); ?>/img/label-new.svg" alt="Icon" loading="lazy">
            <b>новинка</b>
        </li>
        <li class="prd-label" style="background-color: #EF0405;">
            <img width="18" height="18" src="<?php echo get_template_directory_uri(); ?>/img/label-action.svg" alt="Icon" loading="lazy">
            <b>акція</b>
        </li>
        <li class="prd-label" style="background-color: #009340;">
            <img width="18" height="18" src="<?php echo get_template_directory_uri(); ?>/img/label-top.svg" alt="Icon" loading="lazy">
            <b>топ</b>
        </li>
    </ul>

    <a class="prd-img" href="<?php echo get_permalink($product_id); ?>">
	    <picture>
	        <img
	            src="<?php echo $thumbnail_attachment[0]; ?> "width="456" height="386" alt="<?php echo esc_attr($thumbnail_alt); ?>"loading="lazy"
	        >
	    </picture>
	    <div class="cat-label">
	        <img
	            width="77" height="61" src="<?php echo get_template_directory_uri(); ?>/img/cat-label-1.webp" alt="Category" loading="lazy"
	        >
	    </div>
	</a>
    <div class="prd-head">
        <a class="prd-title js_product_title" href="product__detail.php" itemprop="name"><?php echo $title; ?> </a>

        <div class="price-wrap">
            <?php 
            $price         = $product->get_price();
			$price_regular = $product->get_regular_price();
            if ($product->is_type('variable')) {
                    $min_price = $product->get_variation_price('min', true);
                    $max_price = $product->get_variation_price('max', true); ?>
                    <div class="price" itemprop="price"><b><?php echo $min_price; ?></b> - <?php echo $max_price; ?></b></div>
                <?php } else{ ?>
                <?php if($price_regular != $price){
                    echo '<div class="price old"><b>'.$price_regular.'</b>'.'</div>';
                } ?>
                <div class="price" itemprop="price"><b><?php echo $price; ?></b> </div>
            <?php } ?>
        </div>
    </div>

    <div class="prd-desc"> <?php echo $product->get_description(); ?></div>

    <div class="prd-info">
        <div class="prd-info-item">
            <img width="20" height="20" src="<?php echo get_template_directory_uri(); ?>/img/icons/icon-weight.svg" alt="Icon" loading="lazy">
            <b>145 г</b>
        </div>
        <div class="prd-info-item">
            <img width="20" height="20" src="<?php echo get_template_directory_uri(); ?>/img/icons/icon-fire.svg" alt="Icon" loading="lazy">
            <b>803 - 921,3 ккал</b>
        </div>
    </div>

    <?php 
    $stock_status = $product->get_stock_status(); 

    if ($stock_status === 'outofstock') { 
    ?>
        <div class="btn btn-primary btn-block btn-disabled" disabled style="background-color: gray;">
            <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/img/icons/icon-cart.svg" alt="Icon">
            <b>Немає в наявності</b>
        </div>
    <?php } else { 
        if ($product_type == "simple") { ?>
            <div class="btn btn-primary btn-block js_order_btn add-to-cart" data-id="<?php echo $product_id; ?>" data-count-prd="1">
                <button class="decr" type="button" aria-label="decrement"></button>
                <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/img/icons/icon-cart.svg" alt="Icon">
                <b>В кошик <span>(<i class="js_prd_count">1</i>)</span></b>
                <button class="incr" type="button" aria-label="increment"></button>
            </div>
        <?php } else { ?>
            <div class="btn btn-primary btn-block product_plus_modificator" data-id="<?php echo $product_id; ?>">
                <button class="decr" type="button" aria-label="decrement"></button>
                <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/img/icons/icon-cart.svg" alt="Icon">
                <b>Виберіть складники <span>(<i class="js_prd_count">1</i>)</span></b>
                <button class="incr" type="button" aria-label="increment"></button>
            </div>
        <?php } 
    } ?>

    
</div>