<?php
/**
 * Front page
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
    
    <!-- Seo Section 3 -->
    
	<div class="section seo-section">
	    <div class="container">
	        <div class="seo-block">
	            <div class="h4">ЇжаGo - найсмачніша доставка</div>

	            <article class="lest-content text">
	                <p>ЇжаGO — це сучасний сервіс доставки їжі, створений для тих, хто цінує свій час та якість продуктів. Ми співпрацюємо з найкращими ресторанами та кафе, щоб щодня тішити вас улюбленими стравами прямо вдома або в офісі. Наша місія — зробити замовлення їжі максимально простим і швидким. Завдяки зручному онлайн-сервісу та мобільному застосунку ви можете обрати будь-які страви лише у кілька кліків. ЇжаGO — це більше, ніж просто доставка. Це сервіс, який піклується про ваш комфорт та задоволення кожної миті.</p>
	            </article>

	            <div class="more-content">
	                <article class="text">
	                    <p>ЇжаGO — це сучасний сервіс доставки їжі, створений для тих, хто цінує свій час та якість продуктів. Ми співпрацюємо з найкращими ресторанами та кафе, щоб щодня тішити вас улюбленими стравами прямо вдома або в офісі. Наша місія — зробити замовлення їжі максимально простим і швидким. Завдяки зручному онлайн-сервісу та мобільному застосунку ви можете обрати будь-які страви лише у кілька кліків. ЇжаGO — це більше, ніж просто доставка. Це сервіс, який піклується про ваш комфорт та задоволення кожної миті.</p>
	                </article>
	            </div>

	            <div class="seo-btn btn-link" data-toggle-more="Показати більше" data-toggle-less="Показати менше"><i></i></div>

	            <div class="seo-decor-1 page-decor">
	                <img width="146" height="95" src="<?php echo THEME_URI; ?>/img/seo-decor-1.svg" alt="Decor Image" loading="lazy">
	            </div>

	            <div class="seo-decor-2 page-decor">
	                <img width="142" height="107" src="<?php echo THEME_URI; ?>/img/seo-decor-2.svg" alt="Decor Image" loading="lazy">
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Banner Slider -->
	<div class="section banner-section">
	    <div class="container">
	        <div class="swiper-entry banner-slider">
	            <div class="swiper-container" data-options='{
	                    "slidesPerView": 1,
	                    "spaceBetween": 12,    
	                    "loop": true,
	                    "speed": 1000,
	                    "arrowsOut": true,
	                    "autoplay": {
	                        "delay": 4000
	                    },
	                    "breakpoints" : {
	                        "576":{ "spaceBetween" : 12, "slidesPerView" : 2},
	                        "1200":{ "spaceBetween" : 20, "slidesPerView" : 2}
	                    }
	                }'>
	                <div class="swiper-wrapper">
	                    <div class="swiper-slide">
	                        <a href="about.php" class="banner-slider-img">
	                            <picture>
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-1.webp" type="image/webp">
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-1.jpg" type="image/jpg">
	                                <img width="850" height="600" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                            </picture>
	                        </a>
	                    </div>

	                    <div class="swiper-slide">
	                        <div class="banner-slider-img">
	                            <picture>
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-2.webp" type="image/webp">
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-2.jpg" type="image/jpg">
	                                <img width="850" height="600" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                            </picture>
	                        </div>
	                    </div>

	                    <div class="swiper-slide">
	                        <div class="banner-slider-img">
	                            <picture>
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-1.webp" type="image/webp">
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-1.jpg" type="image/jpg">
	                                <img width="850" height="600" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                            </picture>
	                        </div>
	                    </div>

	                    <div class="swiper-slide">
	                        <a href="blog__page.php" class="banner-slider-img">
	                            <picture>
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-2.webp" type="image/webp">
	                                <source srcset="<?php echo THEME_URI; ?>/img/banner-img-2.jpg" type="image/jpg">
	                                <img width="850" height="600" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                            </picture>
	                        </a>
	                    </div>
	                </div>

	                <div class="swiper-pagination swiper-pagination-relative d-xl-none"></div>
	            </div>

	            <div class="swiper-button-prev">
	                <svg width="24" height="24">
	                    <use xlink:href="img/icons/icons_global.svg#arrow-left" fill="none"></use>
	                </svg>
	            </div>
	            <div class="swiper-button-next">
	                <svg width="24" height="24">
	                    <use xlink:href="img/icons/icons_global.svg#arrow-left" fill="none"></use>
	                </svg>
	            </div>
	        </div>

	        <div class="banner-decor-1 page-decor">
	            <img width="264" height="176" src="<?php echo THEME_URI; ?>/img/banner-decor-1.svg" alt="Decor Image" loading="lazy">
	        </div>

	        <div class="banner-decor-2 page-decor">
	            <img width="134" height="160" src="<?php echo THEME_URI; ?>/img/banner-decor-2.svg" alt="Decor Image" loading="lazy">
	        </div>
	    </div>
	</div>
	<!-- Category Slider -->
	<div class="section">
	    <div class="container">
	        <div class="swiper-entry cat-slider">
	            <div class="swiper-container" data-options='{ 
	                "slidesPerView": 1.7,
	                "spaceBetween": 12,
	                "arrowsOut": true,
	                "breakpoints" : {
	                    "576":{ "spaceBetween" : 12, "slidesPerView" : 2},
	                    "992":{ "spaceBetween" : 12, "slidesPerView" : 3}, 
	                    "1200":{ "spaceBetween" : 24, "slidesPerView" : 4}
	                }}'>
	                <div class="swiper-wrapper">
	                    <div class="swiper-slide">
	                        <a class="cat-card" href="product__category.php">
	                            <div class="cat-img">
	                                <picture>
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-1.webp" type="image/webp">
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-1.jpg" type="image/jpg">
	                                    <img width="408" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                                </picture>

	                                <div class="cat-label">
	                                    <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-1.webp" alt="Content Image" loading="lazy">
	                                </div>
	                            </div>

	                            <div class="h3 title">Кебаб</div>
	                        </a>
	                    </div>
	                    <div class="swiper-slide">
	                        <a class="cat-card" href="product__category.php">
	                            <div class="cat-img">
	                                <picture>
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-2.webp" type="image/webp">
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-2.jpg" type="image/jpg">
	                                    <img width="408" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                                </picture>

	                                <div class="cat-label">
	                                    <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-2.webp" alt="Content Image" loading="lazy">
	                                </div>
	                            </div>

	                            <div class="h3 title">Хот-Доги</div>
	                        </a>
	                    </div>
	                    <div class="swiper-slide">
	                        <a class="cat-card" href="product__category.php">
	                            <div class="cat-img">
	                                <picture>
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-3.webp" type="image/webp">
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-3.jpg" type="image/jpg">
	                                    <img width="408" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                                </picture>

	                                <div class="cat-label">
	                                    <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-3.webp" alt="Content Image" loading="lazy">
	                                </div>
	                            </div>

	                            <div class="h3 title">Напої</div>
	                        </a>
	                    </div>
	                    <div class="swiper-slide">
	                        <a class="cat-card" href="product__category.php">
	                            <div class="cat-img">
	                                <picture>
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-4.webp" type="image/webp">
	                                    <source srcset="<?php echo THEME_URI; ?>/img/cat-img-4.jpg" type="image/jpg">
	                                    <img width="408" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                                </picture>

	                                <div class="cat-label">
	                                    <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-4.webp" alt="Content Image" loading="lazy">
	                                </div>
	                            </div>

	                            <div class="h3 title">Десерти</div>
	                        </a>
	                    </div>
	                </div>
	                <div class="swiper-pagination swiper-pagination-relative d-none d-sm-block"></div>
	            </div>

	            <div class="swiper-button-prev">
	                <svg width="24" height="24">
	                    <use xlink:href="img/icons/icons_global.svg#arrow-left" fill="none"></use>
	                </svg>
	            </div>
	            <div class="swiper-button-next">
	                <svg width="24" height="24">
	                    <use xlink:href="img/icons/icons_global.svg#arrow-left" fill="none"></use>
	                </svg>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Product Grid -->

	<div class="section">
	    <div class="container">
	        <h2 class="h1 title mb-sm text-center">Новинки</h2>

	        <?php 

	        	$args = [
					'post_type' => 'product',
					'post_status' => 'publish',
					'fields' => 'ids',
					'posts_per_page' => -1
				];
				$product_ids = get_posts($args);
	        ?>


		<div class="prd-grid">
			<?php 
				foreach($product_ids as $product_id){ 
			?>
			<?php get_template_part('shop/inc/shop-product', null, ['product_id' => $product_id]); ?>
			<?php } ?>
		</div>
	</div>

	<!-- Product Slider -->
	<div class="section">
	    <div class="container">
	        <h2 class="h1 title mb-sm text-center">Популярні</h2>

	        <div class="swiper-entry prd-slider" itemscope itemtype="http://schema.org/Product">
	            <div class="swiper-container" data-options='{
	                "slidesPerView": 1.25,
	                "spaceBetween": 12,
	                "breakpoints":{
	                    "576":{"slidesPerView": 2, "spaceBetween": 12},
	                    "1200":{"slidesPerView": 3, "spaceBetween": "60"}
	                }}'>

	                <div class="swiper-wrapper">
	                    <div class="swiper-slide">
	                        <div class="prd-card js_product" data-filter="kebabs" data-price="128">
							    <ul class="prd-labels">
							        <li class="prd-label" style="background-color: #4147D5;">
							            <img width="18" height="18" src="<?php echo THEME_URI; ?>/img/label-new.svg" alt="Icon" loading="lazy">
							            <b>новинка</b>
							        </li>
							        <li class="prd-label" style="background-color: #EF0405;">
							            <img width="18" height="18" src="<?php echo THEME_URI; ?>/img/label-action.svg" alt="Icon" loading="lazy">
							            <b>акція</b>
							        </li>
							        <li class="prd-label" style="background-color: #009340;">
							            <img width="18" height="18" src="<?php echo THEME_URI; ?>/img/label-top.svg" alt="Icon" loading="lazy">
							            <b>топ</b>
							        </li>
							    </ul>

							    <a class="prd-img" href="product__detail.php">
							        <picture>
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-1.webp" type="image/webp">
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-1.png" type="image/jpg">
							            <img src="<?php echo THEME_URI; ?>/#" width="456" height="386" alt="Product Image" loading="lazy">
							        </picture>

							        <div class="cat-label">
							            <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-1.webp" alt="Content Image" loading="lazy">
							        </div>
							    </a>

							    <div class="prd-head">
							        <a class="prd-title js_product_title" href="product__detail.php" itemprop="name">Кебаб M</a>

							        <div class="price-wrap">
							            <div class="price old"><b>149</b> грн</div>
							            <div class="price" itemprop="price"><b>128</b> грн</div>
							        </div>
							    </div>

							    <div class="prd-desc">Соковите м’ясо на вибір (свинина, курятина або мікс) загорнуте в ніжний лаваш, доповнене свіжими помідорами, хрустким салатом “Айсберг” та пікантною цибулею. Оберіть свій улюблений соус: гострий, напівгострий або негострий.</div>

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

							    <div class="btn btn-primary btn-block js_order_btn" data-count-prd="1">
							        <button class="decr" type="button" aria-label="decrement"></button>
							        <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-cart.svg" alt="Icon">
							        <b>В кошик <span>(<i class="js_prd_count">1</i>)</span></b>
							        <button class="incr" type="button" aria-label="increment"></button>
							    </div>
							</div>
	                    </div>
	                    <div class="swiper-slide">
	                        <div class="prd-card js_product" data-filter="kebabs" data-price="139">
							    <ul class="prd-labels">
							        <li class="prd-label" style="background-color: #4147D5;">
							            <img width="18" height="18" src="<?php echo THEME_URI; ?>/img/label-new.svg" alt="Icon" loading="lazy">
							            <b>новинка</b>
							        </li>
							        <li class="prd-label" style="background-color: #EF0405;">
							            <img width="18" height="18" src="<?php echo THEME_URI; ?>/img/label-action.svg" alt="Icon" loading="lazy">
							            <b>акція</b>
							        </li>
							    </ul>

							    <a class="prd-img" href="product__detail.php">
							        <picture>
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-2.webp" type="image/webp">
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-2.png" type="image/jpg">
							            <img src="<?php echo THEME_URI; ?>/#" width="456" height="386" alt="Product Image" loading="lazy">
							        </picture>

							        <div class="cat-label">
							            <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-1.webp" alt="Content Image" loading="lazy">
							        </div>
							    </a>

							    <div class="prd-head">
							        <a class="prd-title js_product_title" href="product__detail.php" itemprop="name">Кебаб L</a>

							        <div class="price-wrap">
							            <div class="price" itemprop="price"><b>139</b> грн</div>
							        </div>
							    </div>

							    <div class="prd-desc">Соковите м’ясо на вибір (свинина, курятина або мікс) загорнуте в ніжний лаваш, доповнене свіжими помідорами, хрустким салатом “Айсберг” та пікантною цибулею. Оберіть свій улюблений соус: гострий, напівгострий або негострий.</div>

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

							    <div class="btn btn-primary btn-block open-popup" data-rel="4">
							        <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-cart.svg" alt="Icon">
							        <b>Виберіть складники</b>
							    </div>
							</div>
	                    </div>
	                    <div class="swiper-slide">
	                        <div class="prd-card js_product" data-price="128">
							    <a class="prd-img" href="product__detail.php">
							        <picture>
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-4.webp" type="image/webp">
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-4.png" type="image/jpg">
							            <img src="<?php echo THEME_URI; ?>/#" width="456" height="386" alt="Product Image" loading="lazy">
							        </picture>

							        <div class="cat-label">
							            <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-4.webp" alt="Content Image" loading="lazy">
							        </div>
							    </a>

							    <div class="prd-head">
							        <a class="prd-title js_product_title" href="product__detail.php" itemprop="name">Пиріжок вишневий</a>

							        <div class="price-wrap">
							            <div class="price" itemprop="price"><b>128</b> грн</div>
							        </div>
							    </div>

							    <div class="prd-desc">Соковите м’ясо на вибір (свинина, курятина або мікс) загорнуте в ніжний лаваш, доповнене свіжими помідорами, хрустким салатом “Айсберг” та пікантною цибулею. Оберіть свій улюблений соус: гострий, напівгострий або негострий.</div>

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

							    <div class="btn btn-primary btn-block js_order_btn" data-count-prd="1">
							        <button class="decr" type="button" aria-label="decrement"></button>
							        <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-cart.svg" alt="Icon">
							        <b>В кошик <span>(<i class="js_prd_count">1</i>)</span></b>
							        <button class="incr" type="button" aria-label="increment"></button>
							    </div>
							</div>
	                    </div>
	                    <div class="swiper-slide">
	                        <div class="prd-card js_product" data-price="149">
							    <ul class="prd-labels">
							        <li class="prd-label" style="background-color: #EF0405;">
							            <img width="18" height="18" src="<?php echo THEME_URI; ?>/img/label-action.svg" alt="Icon" loading="lazy">
							            <b>акція</b>
							        </li>
							    </ul>

							    <a class="prd-img" href="product__detail.php">
							        <picture>
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-5.webp" type="image/webp">
							            <source srcset="<?php echo THEME_URI; ?>/img/prd-img-5.png" type="image/jpg">
							            <img src="<?php echo THEME_URI; ?>/#" width="456" height="386" alt="Product Image" loading="lazy">
							        </picture>

							        <div class="cat-label">
							            <img width="77" height="61" src="<?php echo THEME_URI; ?>/img/cat-label-4.webp" alt="Content Image" loading="lazy">
							        </div>
							    </a>

							    <div class="prd-head">
							        <a class="prd-title js_product_title" href="product__detail.php" itemprop="name">Баскський чізкейк з соленою карамеллю</a>

							        <div class="price-wrap">
							            <div class="price old"><b>169</b> грн</div>
							            <div class="price" itemprop="price"><b>149</b> грн</div>
							        </div>
							    </div>

							    <div class="prd-desc">Соковите м’ясо на вибір (свинина, курятина або мікс) загорнуте в ніжний лаваш, доповнене свіжими помідорами, хрустким салатом “Айсберг” та пікантною цибулею. Оберіть свій улюблений соус: гострий, напівгострий або негострий.</div>

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

							    <div class="btn btn-primary btn-block js_order_btn" data-count-prd="1">
							        <button class="decr" type="button" aria-label="decrement"></button>
							        <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-cart.svg" alt="Icon">
							        <b>В кошик <span>(<i class="js_prd_count">1</i>)</span></b>
							        <button class="incr" type="button" aria-label="increment"></button>
							    </div>
							</div>
	                    </div>
	                </div>

	                <div class="swiper-pagination swiper-pagination-relative d-none d-sm-flex"></div>
	            </div>
	        </div>
	    </div>
	    
	    <div class="prd-decor-1 page-decor">
	        <img width="218" height="127" src="<?php echo THEME_URI; ?>/img/prd-decor-1.svg" alt="Decor Image" loading="lazy">
	    </div>
	</div>
	<!-- Icon Block -->
	<div class="section">
	    <div class="container">
	        <div class="icon-cards col-xl-10 mx-auto">
	            <div class="icon-card">
	                <img width="120" height="120" src="<?php echo THEME_URI; ?>/img/icon-info-1.svg" alt="Icon" loading="lazy">
	            </div>
	            <div class="icon-card">
	                <img width="120" height="120" src="<?php echo THEME_URI; ?>/img/icon-info-2.svg" alt="Icon" loading="lazy">
	            </div>
	            <div class="icon-card">
	                <img width="120" height="120" src="<?php echo THEME_URI; ?>/img/icon-info-3.svg" alt="Icon" loading="lazy">
	            </div>
	            <div class="icon-card">
	                <img width="120" height="120" src="<?php echo THEME_URI; ?>/img/icon-info-4.svg" alt="Icon" loading="lazy">
	            </div>
	        </div>
	    </div>
	</div>
	<!-- About Block -->
	<div class="section">
	    <div class="container">
	        <div class="about-block">
	            <div class="about-decor page-decor">
	                <img width="342" height="292" src="<?php echo THEME_URI; ?>/img/about-decor.svg" alt="Decor Image" loading="lazy">
	            </div>

	            <div class="about-img">
	                <picture>
	                    <source srcset="<?php echo THEME_URI; ?>/img/about-img-1.webp" type="image/webp">
	                    <source srcset="<?php echo THEME_URI; ?>/img/about-img-1.jpg" type="image/jpg">
	                    <img width="705" height="718" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                </picture>

	                <div class="about-decor-2 page-decor">
	                    <img width="250" height="213" src="<?php echo THEME_URI; ?>/img/about-decor-2.svg" alt="Decor Image" loading="lazy">
	                </div>

	                <div class="about-decor-3 page-decor">
	                    <img width="201" height="119" src="<?php echo THEME_URI; ?>/img/about-decor-3.svg" alt="Decor Image" loading="lazy">
	                </div>
	            </div>

	            <div class="about-content">
	                <h2 class="h1 title">Будьмо знайомі</h2>

	                <div class="text">
	                    <p>ЇжаGO — це сучасний сервіс доставки їжі, створений для тих, хто цінує свій час та якість продуктів. Ми співпрацюємо з найкращими ресторанами та кафе, щоб щодня тішити вас улюбленими стравами прямо вдома або в офісі.</p>
	                    <p>Наша місія — зробити замовлення їжі максимально простим і швидким. Завдяки зручному онлайн-сервісу та мобільному застосунку ви можете обрати будь-які страви лише у кілька кліків.</p>
	                    <p>ЇжаGO — це більше, ніж просто доставка. Це сервіс, який піклується про ваш комфорт та задоволення кожної миті.</p>
	                </div>

	                <a href="about.php" class="btn btn-primary">
	                    <b>Про компанію</b>
	                    <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-rocket.svg" alt="Icon">
	                </a>
	            </div>

	            <div class="about-decor-1 page-decor">
	                <img width="117" height="160" src="<?php echo THEME_URI; ?>/img/about-decor-1.svg" alt="Decor Image" loading="lazy">
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Marquee Logo -->
	<div class="section marquee-logo-section">
	    <div class="container">

	        <div class="marquee-wrap">
	            <div class="marquee-line" data-speed="0.015" data-mobile="0.015" data-direction="false">
	                <div class="marquee-item">
	                    <div class="marquee-content">
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/icons/icon-kebab.svg" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/cat-label-1.png" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/icons/icon-desserts.svg" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/cat-label-4.png" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/icons/icon-drinks.svg" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/cat-label-3.png" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/icons/icon-hot-dogs.svg" alt="Content Image" loading="lazy">
	                        </div>
	                        <div class="marquee-logo">
	                            <img width="60" height="110" src="<?php echo THEME_URI; ?>/img/cat-label-2.png" alt="Content Image" loading="lazy">
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Benefits -->
	<div class="section">
	    <div class="container">
	        <div class="benefits">
	            <div class="benefit-item">
	                <div class="benefit-img">
	                    <picture>
	                        <source srcset="<?php echo THEME_URI; ?>/img/benefit-img-1.webp" type="image/webp">
	                        <source srcset="<?php echo THEME_URI; ?>/img/benefit-img-1.jpg" type="image/jpg">
	                        <img width="560" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                    </picture>
	                </div>

	                <div class="h4 title">Найсвіжіші продукти</div>

	                <div class="text">Ми готуємо лише зі свіжих інгредієнтів, щоб кожна страва була смачною та корисною.</div>
	            </div>

	            <div class="benefit-item">
	                <div class="benefit-img">
	                    <picture>
	                        <source srcset="<?php echo THEME_URI; ?>/img/benefit-img-2.webp" type="image/webp">
	                        <source srcset="<?php echo THEME_URI; ?>/img/benefit-img-2.jpg" type="image/jpg">
	                        <img width="560" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                    </picture>
	                </div>

	                <div class="h4 title">Приготовано з любовʼю</div>

	                <div class="text">Наші кухарі вкладають у кожне замовлення турботу та натхнення, щоб ви відчули справжній смак.</div>
	            </div>

	            <div class="benefit-item">
	                <div class="benefit-img">
	                    <picture>
	                        <source srcset="<?php echo THEME_URI; ?>/img/benefit-img-3.webp" type="image/webp">
	                        <source srcset="<?php echo THEME_URI; ?>/img/benefit-img-3.jpg" type="image/jpg">
	                        <img width="560" height="400" src="<?php echo THEME_URI; ?>/#" alt="Content Image" loading="lazy">
	                    </picture>
	                </div>

	                <div class="h4 title">У нас завжди атмосферно</div>

	                <div class="text">Ми створюємо сервіс із теплом і комфортом, щоб кожне замовлення приносило задоволення.</div>
	            </div>
	        </div>
	    </div>
	</div>


<?php get_footer();