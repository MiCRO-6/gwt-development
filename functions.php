<?php
/**
 * gwt_wp functions and definitions
 *
 * @package gwt_wp
 * eol-129
 */

/**
 * Template Initialize
 */
require get_template_directory() . '/inc/function-initialize.php';

/**
 * Register widgetized area
 */
require get_template_directory() . '/inc/function-widget.php';

/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/function-breadcrumbs.php';

/**
 * Govph Excerpt
 */
require get_template_directory() . '/inc/function-excerpt.php';

/**
 * Enqueue scripts and styles
 */
require get_template_directory() . '/inc/function-enqueue_scripts.php';

/**
 * Disable comment functions
 */
require get_template_directory() . '/inc/function-disable_comments.php';

/**
 * GovPH default widgets
 */
require get_template_directory() . '/inc/govph-widget.php';

/**
 * Default sidebar contents
 */
require get_template_directory() . '/inc/sidebar.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Post Types
 */
// require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Theme Options Page.
 */
require get_template_directory() . '/inc/function-options.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
* Access
*/
require get_template_directory() . '/inc/function-access.php';

/**
*  Activity
*/
require get_template_directory() . '/inc/function-activity.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Envato Flexslider
 */
require get_template_directory() . '/inc/vendors/envato-flex-slider/envato-flex-slider.php';

/**
* Disable rest api for users additions.
*/
require get_template_directory() . '/inc/function-disable_api.php';

/**
 * Minimum WordPress Version Check
 * Ensures that the theme only runs on WordPress 6.7 or higher.
 * Displays an admin notice and prevents activation on older versions.
 */
require get_template_directory() . '/inc/function-wp_required-version.php';

/**
* Anti-Click Jacking
*/
require get_template_directory() . '/inc/addsec.php';

/**
* Open external links in a new tab 
*/
//require get_template_directory() . '/inc/function-target_blank.php';

/**
* Theme Activation Notice
*/
require get_template_directory() . '/inc/function-theme-activation-notice.php';