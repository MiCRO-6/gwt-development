<?php
/**
 * GWT back compat functionality
 *
 * Prevents GWT from running on WordPress versions prior to 6.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 6.7.
 *
 * @package GWT
 * @since Government Website Template v27.1.0
 * eol-165
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GWT_MIN_WP_VERSION', '6.7' );

/**
 * --------------------------------------------------------
 * SECURITY VALIDATION FUNCTIONS
 * --------------------------------------------------------
 */

/**
 * Validate rollback execution safety
 */
function gwt_validate_environment() {

	// Admin capability check
	if ( ! current_user_can( 'switch_themes' ) ) {
		return false;
	}

	// Verify previous theme option integrity
	$previous_theme = sanitize_text_field(
		get_option( 'gwt_previous_theme' )
	);

	if ( empty( $previous_theme ) ) {
		return false;
	}

	// Check if theme actually exists
	$theme = wp_get_theme( $previous_theme );

	if ( ! $theme->exists() ) {
		return false;
	}

	// Version protection check
	if ( version_compare( $GLOBALS['wp_version'], GWT_MIN_WP_VERSION, '>=' ) ) {
		return false;
	}

	return $previous_theme;
}


/**
 * Save previous theme before switching
 */
add_action( 'switch_theme', function() {

	if ( ! current_user_can( 'switch_themes' ) ) {
		return;
	}

	$active_theme = wp_get_theme()->get_stylesheet();

	update_option(
		'gwt_previous_theme',
		sanitize_text_field( $active_theme ),
		false
	);

});


/**
 * Rollback handler
 */
function gwt_switch_theme() {

	$rollback_theme = gwt_validate_environment();

	if ( ! $rollback_theme ) {

		// Fallback to default core theme
		switch_theme( WP_DEFAULT_THEME );

		return;
	}

	switch_theme( $rollback_theme );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'gwt_upgrade_notice' );
}

if ( version_compare( $GLOBALS['wp_version'], GWT_MIN_WP_VERSION, '<' ) ) {
	add_action( 'after_switch_theme', 'gwt_switch_theme' );
}


/**
 * Admin Notice
 */
function gwt_upgrade_notice() {

	printf(
		'<div class="notice notice-error"><p>%s</p></div>',
		sprintf(
			esc_html__(
				'Government Website Template (GWT) requires at least WordPress version %1$s. You are running version %2$s.',
				'gwt'
			),
			GWT_MIN_WP_VERSION,
			$GLOBALS['wp_version']
		)
	);
}


/**
 * Prevent Customizer Access
 */
add_action( 'load-customize.php', function() {

	if ( version_compare( $GLOBALS['wp_version'], GWT_MIN_WP_VERSION, '<' ) ) {

		wp_die(
			esc_html__(
				'WordPress version is not supported for Government Website Template.',
				'gwt'
			),
			esc_html__( 'WordPress Version Error', 'gwt' ),
			array( 'back_link' => true )
		);
	}

});


/**
 * Prevent Theme Preview
 */
add_action( 'template_redirect', function() {

	if (
		version_compare( $GLOBALS['wp_version'], GWT_MIN_WP_VERSION, '<' )
		&& isset( $_GET['preview'] )
	) {

		wp_die(
			esc_html__(
				'Theme preview is disabled due to compatibility restrictions.',
				'gwt'
			)
		);
	}

});