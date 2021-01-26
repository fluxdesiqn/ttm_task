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
	<header id="main-header c-header">
		<!-- ******************* The Navbar Area ******************* -->
		<nav id="brand-nav" class="navbar navbar-expand-lg" aria-labelledby="main-nav-label">
			<?php if ('container' === $container) { ?>
			<div class="container">
				<?php } ?>
				<div class="logo-wrapper c-header-logo">
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
				<div class="c-header-navigation d-lg-flex justify-content-lg-end d-none">
					<div class="navbar-wrapper c-header-navigation--desktop mr-2">
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
					<div class="c-header-call-back js-nav-call-back mr-2">
						<span>Request a call back</span>
					</div>
					<div class="c-header-search js-nav-search">
						<span><img src="/wp-content/uploads/2021/01/search-line.png" alt="search icon"></span>
					</div>
				</div>
				<div class="c-header-navigation--mobile d-flex d-lg-none">
					<div class="c-header-call-back--mobile js-nav-call-back--mobile">
						<a href="tel:01302123456"><img src="/wp-content/uploads/2021/01/phone-fill.png" alt="phone icon"></a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
							aria-controls="mainNav" aria-expanded="false"
							aria-label="<?php esc_attr_e('Toggle navigation', '_themename'); ?>">
						<img src="/wp-content/uploads/2021/01/menu-3-fill.png" alt="menu icon">
					</button>
				</div>
				<?php if ('container' === $container) { ?>

			</div><!-- .container -->
		<?php } ?>
		</nav><!-- .site-navigation -->
		<div class="c-header-search--mobile bg-primary w-100 d-inline-flex d-lg-none">
			<input type="text" class="js-nav-search--mobile" name="search" placeholder="Search...">
			<img class="ml-auto" src="/wp-content/uploads/2021/01/search-line-1.png" alt="search icon">
		</div>
		<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-primary c-header-menu" aria-labelledby="main-nav-label">
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
