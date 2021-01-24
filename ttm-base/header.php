<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package TTM
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('ttm_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php ttm_body_attributes(); ?>>
<?php do_action('wp_body_open'); ?>
<div class="site" id="page">
	<header id="main-header">
		<!-- ******************* The Navbar Area ******************* -->
		<nav id="brand-nav" class="navbar navbar-expand-lg" aria-labelledby="main-nav-label">
			<?php if ('container' === $container) { ?>
			<div class="container">
				<?php } ?>

				<div class="logo-wrapper">
					<!-- Your site title as branding in the menu -->
					<?php if (!has_custom_logo()) { ?>

						<?php if (is_front_page() && is_home()) { ?>

							<h1 class="navbar-brand"><a rel="home" href="<?php
								echo esc_url(home_url('/')); ?>" itemprop="url"><?php
									bloginfo('name'); ?></a></h1>

						<?php } else { ?>

							<a class="navbar-brand" rel="home" href="<?php
							echo esc_url(home_url('/')); ?>" itemprop="url"><?php
								bloginfo('name'); ?></a>

						<?php } ?>

						<?php
					} else {
						the_custom_logo();
					}
					?>
				</div><!-- end custom logo -->
				<div class="navbar-wrapper">
					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
							[
									'theme_location' => 'top',
									'menu_class' => 'navbar-nav nav-fill',
									'container_class' => 'collapse navbar-collapse',
									'container_id' => 'topNav',
									'fallback_cb' => '',
									'menu_id' => 'top-menu',
									'depth' => 1,
									'walker' => new TTM_WP_Bootstrap_Navwalker(),
							]
					); ?>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
						aria-controls="mainNav" aria-expanded="false"
						aria-label="<?php esc_attr_e('Toggle navigation', '_themename'); ?>">
					Toggle navigation
				</button>
				<?php if ('container' === $container) { ?>

			</div><!-- .container -->
		<?php } ?>
		</nav><!-- .site-navigation -->
		<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-primary" aria-labelledby="main-nav-label">
			<?php if ('container' === $container) { ?>
			<div class="container"><!-- .container -->
				<?php } ?>
				<?php wp_nav_menu(
						[
								'theme_location' => 'primary',
								'menu_class' => 'navbar-nav nav-fill',
								'container_class' => 'collapse navbar-collapse',
								'container_id' => 'mainNav',
								'menu_id' => 'main-menu',
								'depth' => 2,
								'walker' => new TTM_WP_Bootstrap_Navwalker(),
						]
				);
				?>
				<?php if ('container' === $container) { ?>
			</div><!-- .container -->
		<?php } ?>
		</nav>
	</header>
