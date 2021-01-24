<?php
/**
 * Custom hooks
 *
 * @package TTM
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ttm_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function ttm_site_info() {
		do_action( 'ttm_site_info' );
	}
}

add_action( 'ttm_site_info', 'ttm_add_site_info' );
if ( ! function_exists( 'ttm_add_site_info' ) ) {
	/**
	 * Add site info content.
	 */
	function ttm_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = [];

		$site_info[] = sprintf( // WPCS: XSS ok.
			esc_html__( '&copy;2020 %1$s', '_themename' ),
			get_field( 'company_name', 'option' )
		);

		$site_info[] = sprintf( // WPCS: XSS ok.
			esc_html__( 'Registered address: %1$s.', '_themename' ),
			implode( ", ", explode( "\r\n", get_field( 'address', 'option' ) ) )
		);

		$site_info[] = sprintf( // WPCS: XSS ok.
			esc_html__( 'Company Registration Number: %1$s', '_themename' ),
			get_field( 'company_registration_number', 'option' )
		);

		$site_info[] = sprintf( // WPCS: XSS ok.
			esc_html__( 'VAT Number: %1$s', '_themename' ),
			get_field( 'vat_number', 'option' )
		);

		$site_info[] = sprintf( // WPCS: XSS ok.
			__( '<a href="%1$s" target="_blank" rel="noopener" title="%2$s">%3$s</a>', '_themename' ),
			"https://www.talktomedia.co.uk/",
			"Web Design Doncaster",
			"Web Design Doncaster by Talk To Media"
		);

		echo implode(" ", $site_info);
	}
}
