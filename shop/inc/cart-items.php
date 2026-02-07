<?php 

    echo '<pre>';
    file_put_contents(__DIR__ .'/get_cart.txt', print_r(WC()->cart->get_cart(), true));
    echo '</pre>';

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

       $product = $cart_item['data'];
       $product_id = $cart_item['product_id'];
       $variation_id = $cart_item['variation_id'];
       $quantity = $cart_item['quantity'];

       $price = $product->get_price();

       $line_total = $cart_item['line_subtotal'];

       var_dump($line_total);
       $attributes = !empty($item['attributes']) ? $item['attributes'] : '';
       $link = $product->get_permalink( $cart_item );

        $post_thumbnail_id = get_post_thumbnail_id( $product_id );
        $thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
        $thumbnail_attachment = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
        if(!empty($thumbnail_attachment[0])){
            $image_webp = eatgo_get_webp_url($thumbnail_attachment[0]);
            $post_image = '<picture>
            <source srcset="'.$image_webp.'" type="image/webp">
            <img src="'.$thumbnail_attachment[0].'" alt="image" loading="lazy" />
            </picture>';
        } else{
            $post_image = '<picture>
            <source srcset="'.THEME_URI.'/img/no_image_square.jpg" type="image/webp">
            <img src="'.THEME_URI.'/img/no_image_square.jpg" alt="image" loading="lazy" />
            </picture>';
        }
        ?>


       <div class="prd-horiz js_product" data-price="<?php echo $price; ?>">
            <a class="prd-horiz-img" href="product__detail.php">
                <?php 
                    echo $post_image;
                ?>
            </a>

            <div class="prd-horiz-info">
                <a class="prd-horiz-title" href="product__detail.php"><?php echo get_the_title($product_id); ?></a>
                <?php 
                if (!empty($attributes)) { ?>
                    <div class="prd-horiz-desc">
                        <b>Гострота:</b> Півгострий, <b>Мʼясо:</b> Курка
                    </div>
                <?php } ?>

                <div class="prd-horiz-addons-inner">
                    <div class="prd-horiz-addons-title">Додатки: <i></i></div>
                    <div class="prd-horiz-addons-wrap">
                        <div class="prd-horiz-addons">
                            <div class="prd-horiz-addon js_addon_delete_prd-horiz" data-price="30">Сир моцарела <i></i></div>
                            <div class="prd-horiz-addon js_addon_delete_prd-horiz" data-price="40">Бельгійська Фрі <i></i></div>
                        </div>
                    </div>
                </div>

                <div class="prd-horiz-controls">
                    <div class="stepper" data-key="<?php echo $cart_item_key; ?>">
                        <button class="decr" type="button" aria-label="decrement"></button>
                        <input class="currentQty" value="<?php echo $quantity; ?>" tabindex="-1" readonly>
                        <button class="incr" type="button" aria-label="increment"></button>
                    </div>

                    <div class="price-wrap">
                        <div class="price" itemprop="price"><b id="price"><?php echo $line_total; ?></b>грн</div>
                    </div>
                </div>
            </div>
            <style>
                
                .loading2 {
                    
                    position: absolute;
                    z-index: 2;
                    top: var(--cart-inset);
                    right: var(--cart-inset);
                    will-change: transform;
                    transform: translateX(100%);
                    transition: var(--transition-1);
                    width: min(32.8125rem, 100%);
                    height: calc(100% - var(--cart-inset) * 2);
                    max-height: 100%;
                    display: flex;
                    flex-direction: column;
                    background: var(--clr-white);
                    border-radius: 1.5rem;
                }
                .loading2 .cart-products {
                    position: relative;
                }
                .loading2 .cart-products::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    backdrop-filter: blur(5px);
                    -webkit-backdrop-filter: blur(5px);
                    background: rgba(255, 255, 255, 0.5);
                    z-index: 998;
                    pointer-events: auto;
                    border-radius: 1.5rem;
                }

                .loading2::after {
                    content: '';
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 40px;
                    height: 40px;
                    background-image: url(<?php echo get_template_directory_uri(); ?>/img/loader.gif);
                    background-repeat: no-repeat;
                    background-size: contain;
                    z-index: 999;
                    pointer-events: none;
                }
            </style>
            <button class="delete-btn js_product_remove" aria-label="delete button">
                <svg width="24" height="24">
                    <use xlink:href="<?php echo THEME_URI; ?>/img/icons/icons_global.svg#delete" fill="none"></use>
                </svg>
            </button>
        </div>
<?php 

    }
?>

