<?php
/**
 *  Block the site from being displayed in an iframe.
 *
 * @package GWT
 * @since Government Website Template v27.1.0
 * eol-13
 */

function block_frames() {
    header('X-FRAME-OPTIONS: SAMEORIGIN');
}
add_action('send_headers', 'block_frames', 10);