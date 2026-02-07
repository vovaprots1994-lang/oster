<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); 

$product_id = get_the_ID();
$product = wc_get_product($product_id);
$attachment_ids = $product->get_gallery_image_ids();
$main_image_id = $product->get_image_id();
$main_image_alt = get_post_meta($main_image_id, '_wp_attachment_image_alt', true);

$stock_status_array = [
  'instock' => 'Товар в наявності', 
  'outofstock' => 'Товар під замовлення', 
  'onbackorder' => 'Немає в наявності'
];

?>

<div class="section prd-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="prd-detail-slider">
				    <div class="swiper-entry swiper-thumbs-top">
				        <div class="swiper-container" data-options='{
				                "watchSlidesVisibility": true,
				                "watchSlidesProgress": true,
				                "effect": "fade",
				                "fadeEffect": {"crossFade": true}
				            }'>
				            <div class="swiper-wrapper">
				            	<?php 

				            	if ($main_image_id) {
                            	$main_image_url = wp_get_attachment_image_url($main_image_id, 'full');
                            	$main_image_webp = eatgo_get_webp_url($main_image_url);
				            	?>
					                <div class="swiper-slide">
					                    <div class="prd-detail-img">
					                        <picture>
					                            <source srcset="<?php echo esc_url($main_image_webp); ?>" type="image/webp">
					                            <img width="360" height="360" src="<?php echo esc_url($main_image_url); ?>" alt="Banner Image">
					                        </picture>
					                    </div>
					                </div>
				            	<?php } ?>
				            	<?php foreach($attachment_ids as $attachment_id) { 
				            		$image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
		                            $image_url = wp_get_attachment_image_url($attachment_id, 'full');
		                            $image_webp = eatgo_get_webp_url($image_url);
		                            ?>
					                <div class="swiper-slide">
					                    <div class="prd-detail-img">
					                        <picture>
		                                        <source srcset="<?php echo esc_url($image_webp); ?>" type="image/webp">
		                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy">
		                                    </picture>
					                    </div>
					                </div>
				            	<?php } ?>
				            </div>
				            <div class="swiper-pagination swiper-pagination-relative"></div>
				        </div>

					    <ul class="prd-labels">
						    <?php if ( has_term( 'novelty', 'product_tag', get_the_ID() ) ) {
						        $term = get_term_by( 'slug', 'novelty', 'product_tag' );
						    ?>
						        <li class="prd-label" style="background-color: #4147D5;">
						            <img width="18" height="18"
						                 src="<?php echo THEME_URI; ?>/img/label-new.svg"
						                 alt="Icon" loading="lazy">
						            <b><?php echo esc_html( $term->name ); ?></b>
						        </li>
						    <?php } ?>

						    <?php if ( has_term( 'sale', 'product_tag', get_the_ID() ) ) {
						        $term = get_term_by( 'slug', 'sale', 'product_tag' );
						    ?>
						        <li class="prd-label" style="background-color: #EF0405;">
						            <img width="18" height="18"
						                 src="<?php echo THEME_URI; ?>/img/label-action.svg"
						                 alt="Icon" loading="lazy">
						            <b><?php echo esc_html( $term->name ); ?></b>
						        </li>
						    <?php } ?>
						</ul>

				        <div class="prd-slider-decor page-decor">
				            <img width="201" height="119" src="<?php echo THEME_URI; ?>/img/about-decor-3.svg" alt="Decor Image" loading="lazy">
				        </div>
				        <div class="prd-slider-decor-2">
				            <img width="134" height="100" src="<?php echo THEME_URI; ?>/img/prd-decor-5.svg" alt="Decor Image" loading="lazy">
				        </div>
				    </div>
				</div>
            </div>

            <?php 
            $product_title = $product->get_name();
            $product_desc = $product->get_description();
            ?>

            <div class="col-lg-6">
                <div class="prd-detail-content js_product" data-price="149">
                    <!-- Product Status -->
					<h1 class="prd-detail-title js_product_title" itemprop="name"><?php echo esc_html($product_title); ?></h1>

					<div class="text text-md">
					    <p><?php echo esc_html($product_desc); ?></p>
					</div>
                    <div class="product_detail-calories">
					    <div class="prd-info">
					        <div class="prd-info-item">
					            <img width="20" height="20" src="<?php echo THEME_URI; ?>/img/icons/icon-weight.svg" alt="Icon" loading="lazy">
					            <b>145 г</b>
					        </div>
					        <div class="prd-info-item">
					            <img width="20" height="20" src="<?php echo THEME_URI; ?>/img/icons/icon-fire.svg" alt="Icon" loading="lazy">
					            <b>803 - 921,3 ккал</b>
					        </div>
					    </div>
					    <div class="calories-wrapp">
					        <div class="calories-item text text-sm">
					            <p>Калорії</p>
					            <p><b>125,6кКал</b></p>
					        </div>
					        <div class="calories-item text text-sm">
					            <p>Білки</p>
					            <p><b>125,6кКал</b></p>
					        </div>
					        <div class="calories-item text text-sm">
					            <p>Жири</p>
					            <p><b>5,5г</b></p>
					        </div>
					        <div class="calories-item text text-sm">
					            <p>Вуглеводи</p>
					            <p><b>12,8г</b></p>
					        </div>
					    </div>
					    <div class="text text-sm">*енергетична цінність вказана за <b>100г</b></div>
					</div>

					<?php if ($product->is_type('variable')) { 
						$available_variations = $product->get_available_variations();
						$active_variation = 0;
						$price = 0;
						$sale_price = 0;

						if (!empty($available_variations[$active_variation])) {
							$price = $available_variations[$active_variation]['display_regular_price'];
							if ($available_variations[$active_variation]['display_price'] != $available_variations[$active_variation]['display_regular_price']) {
								$sale_price = $available_variations[$active_variation]['display_price'];
							}
							var_dump($sale_price);
						}
						
						$attributes = $product->get_attributes();
						
						if (!empty($available_variations)) {
					?>
						<div class="attr_wrapper">
							<form data-product_variations='<?php 
	                            $variations_json = wp_json_encode($available_variations);
	                            $variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);
	                            echo $variations_attr;
	                        ?>'>
	                        <?php if (!empty($attributes) && is_array($attributes)) { ?>
	                        	<?php 
                                foreach ($attributes as $attribute_name => $options) { 
                                    $attribute_label = wc_attribute_label($attribute_name);
                                    $attribute = $attributes[$attribute_name]; 
                                    
                                    ?>
				                    <div class="variation-selector-wrapp">
									    <div class="prd-caption"><?php echo esc_html($attribute_label); ?></div>
									    <div class="variation-selector">
									    	<?php foreach($options->get_options() as $index => $option) {
									    		$term = get_term_by('id', $option, $attribute_name);
									    		?>
										        <label class="ch-box-filter">
										            <input 
                                                        type="radio" 
                                                        name="attribute_<?php echo esc_attr($attribute_name); ?>" 
                                                        data-attr-slug="<?php echo esc_attr($term->slug); ?>"
                                                        value="<?php echo esc_attr($term->term_id); ?>"
                                                        <?php echo ($index === 0) ? 'checked' : ''; ?>
                                                    >
										            <span class="ch-box-filter__label"><?php echo esc_html($term->name); ?></span>
										        </label>
									    	<?php } ?>
									    </div>
									</div>
								<?php } ?>
							<?php } ?>
							</form>
						</div>

						<?php } ?>
					<?php } ?>

                    <div class="addons-wrapp">
					    <div class="prd-caption">Додатки</div>
					    <div class="addons js-addons">
					        <?php
					        $addon_ids = get_field('add_dodatok', $product_id);
					        
					        if ($addon_ids) {
					            foreach ($addon_ids as $addon_id) {
					                $addon_title = get_the_title($addon_id);
					                $addon_price = get_field('price', $addon_id);
					                $addon_image = get_the_post_thumbnail_url($addon_id, 'full');
					                ?>
					                <div class="addon js-addon" data-addon-id="<?php echo $addon_id; ?>" data-addon-price="<?php echo $addon_price; ?>">
					                    <div class="addon__prices">
					                        <div class="addon__price">+ <?php echo $addon_price; ?>₴</div>
					                    </div>
					                    <div class="addon__image image-cover">
					                        <?php if ($addon_image) { ?>
					                            <img src="<?php echo esc_url($addon_image); ?>" loading="lazy" alt="<?php echo esc_attr($addon_title); ?>">
					                        <?php } ?>
					                    </div>
					                    <div class="addon__title">
					                        <?php echo esc_html($addon_title); ?>
					                    </div>
					                    <div class="stepper addons-stepper">
					                        <button class="decr" type="button" aria-label="decrement"></button>
					                        <input value="0" tabindex="-1" readonly>
					                        <button class="incr" type="button" aria-label="increment"></button>
					                    </div>
					                </div>
					            <?php }
					        } ?>
					    </div>
					</div>

                    <div class="prd-detail-controls">
					    <div class="price-wrap">
					        <div class="price old"><b><?php echo esc_html($price); ?></b> грн</div>
					        <div class="price" itemprop="price"><b><?php echo esc_html($sale_price); ?></b> ₴</div>
					    </div>
					    <div class="stepper prd-stepper">
					        <button  class="decr" type="button"></button>
					        <input value="1" readonly="" tabindex="-1">
					        <button  class="incr" type="button"></button>
					    </div>
					    <div class="btn btn-primary js_order_btn add-to-cart" 
						     data-id="<?php echo $product_id; ?>" 
						     data-count-prd="1"
						     data-product-type="variable">
						    <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-cart-add.svg" alt="Icon">
						    <b>Додати в кошик</b>
						</div>
					</div>
					
                </div>
            </div>
        </div>

    </div>


	<div class="section section_popular">
	    <div class="container">
	        <h2 class="h1 title mb-sm text-center">Популярні</h2>

	        <div class="swiper-entry prd-slider" itemscope itemtype="http://schema.org/Product">
	            <div class="prd-grid">
	                <?php 
	                    $single_prod_popular = get_field('single_prod_popular', $product_id);
	                    if($single_prod_popular && is_array($single_prod_popular)) {
	                        foreach($single_prod_popular as $popular_id) {
	                ?>
	                <?php get_template_part('shop/inc/shop-product', null, ['product_id' => $popular_id]); ?>
	                <?php 
	                        }
	                    }
	                ?>
	            </div>
	        </div>
	    </div>
	    
	    <div class="prd-decor-1 page-decor">
	        <img width="218" height="127" src="img/prd-decor-1.svg" alt="Decor Image" loading="lazy">
	    </div>
	</div>

	<div class="section section_like">
	    <div class="container">
	        <h2 class="h1 title mb-sm text-center">Можливо, вам сподобається</h2>

	        <div class="prd-grid">
	            <?php 
	                $maybe_like_product = get_field('maybe_like_product', $product_id);
	                
	                if($maybe_like_product && is_array($maybe_like_product) && count($maybe_like_product) > 0) {
	                    foreach($maybe_like_product as $like_id) {
	            ?>
	            <?php get_template_part('shop/inc/shop-product', null, ['product_id' => $like_id]); ?>
	            <?php 
	                    }
	                }
	            ?>
	        </div>
	    </div>
	    
	    <div class="prd-decor-2 page-decor">
	        <img width="218" height="127" src="img/prd-decor-4.svg" alt="Decor Image" loading="lazy">
	    </div>
	</div>


    <div class="prd-content-decor page-decor">
        <img width="201" height="119" src="<?php echo THEME_URI; ?>/img/prd-decor-6.svg" alt="Decor Image" loading="lazy">
    </div>

</div>


<style>
	.variation-selector-wrapp {
		margin-top: 20px;
	}
	.section_popular {
		margin-top: 40px;
	}
	.section_like {
		margin-bottom: 50px;
	}
</style>
<?php
get_footer(); ?>