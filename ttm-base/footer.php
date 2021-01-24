<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package TTM
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'ttm_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<?php ttm_site_info(); ?>

					</div><!-- .site-info -->

					<nav id="footer-nav" class="navbar navbar-dark bg-primary" aria-labelledby="footer-nav-label">
						<?php wp_nav_menu(
								[
										'theme_location' => 'footer',
										'menu_class'     => 'navbar-nav navbar-expand nav-fill',
										'container_id'   => 'footerNav',
										'menu_id'        => 'footer-menu',
										'depth'          => 1,
										'walker'         => new TTM_WP_Bootstrap_Navwalker(),
								]
						); ?>
					</nav>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

