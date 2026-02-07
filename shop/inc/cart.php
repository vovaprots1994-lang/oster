
    <div class="cart-overlay js_cart_close"></div>

    <div class="cart-inner">
        <div class="btn-close js_cart_close"></div>

        <div class="cart-products">
            <?php get_template_part('shop/inc/cart-items'); ?>
        </div>

        <div class="cart-bottom">
            <div class="cart-total">
                <div class="text">Сума:</div>
                <div class="cart-total-price">
                    <span class="js_cart_total"><?php echo WC()->cart->subtotal; ?></span> грн  
                </div>
            </div>
            <a class="btn btn-primary" href="checkout__page.php">
                <b>Оформити замовлення</b>
            </a>
        </div>

        <!-- Shows when empty cart -->
        <div class="cart-empty">
            <div class="h4 title">Ваш кошик пустий</div>
            <div class="text">Наповніть його товарами</div>
        </div>

        <div class="cart-bottom cart-bottom-empty">
            <a class="btn btn-primary btn-block" href="product__catalog.php">
                <b>Перейти до меню</b>
            </a>
        </div>
    </div>


