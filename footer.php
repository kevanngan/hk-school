<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HK_School
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<nav><?php echo wp_get_attachment_image( 100, 'full'); ?></nav>

			<section class="footer-credits">
				<h2>Credits</h2>
				<p><?php printf( esc_html__( 'Created by %s' ), '<a href="https://kevanngan.com/school">Kevan Ngan & Hojin Chang</a>' ); ?></p>
				<p>Photos courtesy of <a href="https://www.shopify.com/stock-photos">Burst.</a></p>
			</section>

			<nav class="footer-nav">
				<h2>Links</h2>
				<ul id="menu-footer-navigation" class="menu"></ul>
			</nav>

		</div><!-- .site-info -->

		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
