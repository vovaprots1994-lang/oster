<?php
/**
 * The template for displaying the footer
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>


			<?php //WP Footer
			wp_footer(); ?>
			</main>
			<footer itemscope itemtype="http://schema.org/Organization">
			    <meta itemprop="name" content="Name company">

			    <div class="container">
			        <div class="footer-top">
			            <a class="footer-logo" href="index.php" aria-label="Company logo">
			                <img width="108" height="35" src="<?php echo THEME_URI; ?>/img/logo.svg" alt="Company Logo" loading="lazy">
			            </a>

			            <div class="footer-grid">
			                <div class="footer-contact-wrap">
			                    <div class="footer-contact">
			                        <div class="contact-item">
			                            <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-clock.svg" alt="Icon" loading="lazy">

			                            <div class="contact-item-info">
			                                <a href="tel:+380000000000">
			                                    <span itemprop="telephone">+38 (000) 000 00 00</span>
			                                </a>
			                                <p>Пн-Нд 10:00 - 22:30</p>
			                            </div>
			                        </div>
			                    </div>

			                    <div class="footer-contact">
			                        <div class="contact-item">
			                            <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-location.svg" alt="Icon" loading="lazy">
			                            
			                            <div class="contact-item-info">
			                                <a href="https://maps.app.goo.gl/gD71jhU6MGYEfUnQA">
			                                    <span itemprop="address">м. Остер,<br>
			                                        Богдана Хмельницкого, 58в</span>
			                                </a>
			                            </div>
			                        </div>
			                    </div>
			                </div>

			                <div class="social">
			                    <ul>
			                        <li>
			                            <a href="#" target="_blank" aria-label="instagram">
			                                <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-instagram.svg" alt="Icon Instagram" loading="lazy">
			                            </a>
			                        </li>
			                        <li>
			                            <a href="#" target="_blank" aria-label="tiktok">
			                                <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-tiktok.svg" alt="Icon TikTok" loading="lazy">
			                            </a>
			                        </li>
			                        <li>
			                            <a href="#" target="_blank" aria-label="facebook">
			                                <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-facebook.svg" alt="Icon Facebook" loading="lazy">
			                            </a>
			                        </li>
			                    </ul>
			                </div>

			                <div class="footer-links-wrap">
			                    <nav class="footer-links">
			                        <ul>
			                            <li class="is-active"><a href="about.php">Про компанію</a></li>
			                            <li><a href="blog__page.php">Акції</a></li>
			                            <li><a href="checkout__delivery.php">Доставка та оплата</a></li>
			                            <li><a href="contacts.php">Контакти</a></li>
			                        </ul>
			                    </nav>

			                    <nav class="footer-links">
			                        <ul>
			                            <li class="is-active">
			                                <a href="product__category.php">
			                                    <img width="32" height="32" src="<?php echo THEME_URI; ?>/img/icons/icon-desserts.svg" alt="Icon" loading="lazy">
			                                    <b>Десерти</b>
			                                </a>
			                            </li>
			                            <li>
			                                <a href="product__category.php">
			                                    <img width="32" height="32" src="<?php echo THEME_URI; ?>/img/icons/icon-kebab.svg" alt="Icon" loading="lazy">
			                                    <b>Кебаб</b>
			                                </a>
			                            </li>
			                            <li>
			                                <a href="product__category.php">
			                                    <img width="32" height="32" src="<?php echo THEME_URI; ?>/img/icons/icon-drinks.svg" alt="Icon" loading="lazy">
			                                    <b>Напої</b>
			                                </a>
			                            </li>
			                            <li>
			                                <a href="product__category.php">
			                                    <img width="32" height="32" src="<?php echo THEME_URI; ?>/img/icons/icon-hot-dogs.svg" alt="Icon" loading="lazy">
			                                    <b>Хот-Доги</b>
			                                </a>
			                            </li>
			                        </ul>
			                    </nav>
			                </div>

			            </div>
			        </div>

			        <div class="footer-bottom">
			            <div class="footer-copy">Всі права захищено</div>

			            <div class="pay-type">
			                <img width="52" height="28" src="<?php echo THEME_URI; ?>/img/visa.png" alt="visa" loading="lazy">
			                <img width="48" height="28" src="<?php echo THEME_URI; ?>/img/mastercard.png" alt="mastercard" loading="lazy">
			            </div>

			            <nav class="footer-links">
			                <ul>
			                    <li><a href="privacy.php">Договір оферти</a></li>
			                    <li><a href="privacy.php">Політика конфіденційності</a></li>
			                </ul>
			            </nav>
			        </div>
			    </div>
			</footer>
		</div>
		 <!-- Popups -->
    	<div class="popup-wrapper" id="popups"></div>

				<!-- Cart -->
		<div class="cart" id="cart-popup-out"></div>

		<!-- Cart Informer -->
		<div class="cart-informer">
		    <div class="cart-informer-inner">
		        <div class="text"><b>Баскський чізкейк з соленою карамеллю</b> успішно додано у Ваш кошик</div>

		        <a class="btn btn-primary" href="checkout__page.php">
		            <b>Перейти до замовлення</b>
		        </a>
		    </div>
		</div>

	    <!-- Cookies -->
		<div class="cookies-informer">
		    <div class="cookies-informer-inner">
		        <div class="text">Цей веб-сайт використовує файли cookie, щоб забезпечити вам найкращий досвід. <a href="privacy.php">Політика конфіденційності</a></div>

		        <div class="cookies-btn-wrap">
		            <div class="btn-link close-cookies">
		                <b>Скасувати</b>
		            </div>
		            <div class="btn btn-primary set-cookie close-cookies">
		                <b>Прийняти</b>
		            </div>
		        </div>
		    </div>

		    <div class="btn-close close-cookies"></div>
		</div>


	    <!-- Informers -->
	    <div class="informer promotional-informer">
		    <div class="btn-close informer-close set-cookie"></div>

		    <div class="informer-img">
		        <picture>
		            <source srcset="img/informer-img-1.webp" type="image/webp">
		            <source srcset="img/informer-img-1.jpg" type="image/jpg">
		            <img width="667" height="359" src="#" alt="Content Image" loading="lazy">
		        </picture>
		    </div>

		    <div class="h4 title">Акція вихідного дня!<br> Отримуй знижку до 50%</div>

		    <div class="text">Дія акції розповсюджується на всі товари, крім товарів які вже беруть участь у інших акціях. Чекаємо на вас щодня <strong>з 10:00 до 23:00</strong></div>

		    <a class="btn btn-primary btn-lg" href="blog__page.php">
		        <b>Переглянути деталі</b>
		    </a>
		</div>

	    <!-- For Product -->

	</body>
</html>