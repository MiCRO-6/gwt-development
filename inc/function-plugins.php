<<<<<<< HEAD
<?php
/**
 * Log all the plugin events such as installation, activation, deactivation, and deletion.
 *
 * @package GWT
 * @since Government Website Template v27.1
 * eol-73
 */

function gwhs_get_plugin_log_path() {
    $log_dir = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/gwhs.txt';

    if (!file_exists($log_dir)) {
        if (!mkdir($log_dir, 0755, true) && !is_dir($log_dir)) {
            error_log("Failed to create log directory: $log_dir");
            return false;
        }
    }

    return $log_file;
}

function gwhs_log_plugin_event($action, $plugin_slug) {
    $log_file = gwhs_get_plugin_log_path();
    if (!$log_file) return;

    $datetime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $log_time = $datetime->format('Y-m-d H:i:s P');

    // Get user info
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user = "{$current_user->user_login} (ID: {$current_user->ID})";
    } else {
        $user = 'Unknown';
    }

    // Get user agent and IP info
    $user_agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown Agent';
    $client_ip    = $_SERVER['HTTP_CLIENT_IP'] ?? 'No Client IP';
    $forwarded_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'No Forwarded IP';
    $remote_ip    = $_SERVER['REMOTE_ADDR'] ?? 'No Remote IP';

    $ip_address = "Client IP: {$client_ip} | Forwarded IP: {$forwarded_ip} | Remote IP: {$remote_ip}";
    $message = "[{$log_time}] [Plugin {$action}] {$plugin_slug} | by: {$user} | {$ip_address} | Agent: {$user_agent}" . PHP_EOL;

    file_put_contents($log_file, $message, FILE_APPEND | LOCK_EX);
}


add_action('upgrader_process_complete', function($upgrader_object, $options) {
    if ($options['type'] === 'plugin' && $options['action'] === 'install') {
        if (isset($upgrader_object->result['destination_name'])) {
            $plugin_slug = $upgrader_object->result['destination_name'];
            gwhs_log_plugin_event('Installed', $plugin_slug);
        } else {
            gwhs_log_plugin_event('Installed', 'Unknown Plugin');
        }
    }
}, 10, 2);

add_action('activated_plugin', function($plugin, $network_wide) {
    gwhs_log_plugin_event('Activated', $plugin);
}, 10, 2);

add_action('deactivated_plugin', function($plugin, $network_wide) {
    gwhs_log_plugin_event('Deactivated', $plugin);
}, 10, 2);

add_action('deleted_plugin', function($plugin_slug, $deleted) {
    gwhs_log_plugin_event('Deleted', $plugin_slug);
=======
<?php
/**
 * Log all the plugin events such as installation, activation, deactivation, and deletion.
 *
 * @package GWT
 * @since Government Website Template v27.1
 * eol-73
 */

function gwhs_get_plugin_log_path() {
    $log_dir = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/gwhs.txt';

    if (!file_exists($log_dir)) {
        if (!mkdir($log_dir, 0755, true) && !is_dir($log_dir)) {
            error_log("Failed to create log directory: $log_dir");
            return false;
        }
    }

    return $log_file;
}

function gwhs_log_plugin_event($action, $plugin_slug) {
    $log_file = gwhs_get_plugin_log_path();
    if (!$log_file) return;

    $datetime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $log_time = $datetime->format('Y-m-d H:i:s P');

    // Get user info
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user = "{$current_user->user_login} (ID: {$current_user->ID})";
    } else {
        $user = 'Unknown';
    }

    // Get user agent and IP info
    $user_agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown Agent';
    $client_ip    = $_SERVER['HTTP_CLIENT_IP'] ?? 'No Client IP';
    $forwarded_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'No Forwarded IP';
    $remote_ip    = $_SERVER['REMOTE_ADDR'] ?? 'No Remote IP';

    $ip_address = "Client IP: {$client_ip} | Forwarded IP: {$forwarded_ip} | Remote IP: {$remote_ip}";
    $message = "[{$log_time}] [Plugin {$action}] {$plugin_slug} | by: {$user} | {$ip_address} | Agent: {$user_agent}" . PHP_EOL;

    file_put_contents($log_file, $message, FILE_APPEND | LOCK_EX);
}


add_action('upgrader_process_complete', function($upgrader_object, $options) {
    if ($options['type'] === 'plugin' && $options['action'] === 'install') {
        if (isset($upgrader_object->result['destination_name'])) {
            $plugin_slug = $upgrader_object->result['destination_name'];
            gwhs_log_plugin_event('Installed', $plugin_slug);
        } else {
            gwhs_log_plugin_event('Installed', 'Unknown Plugin');
        }
    }
}, 10, 2);

add_action('activated_plugin', function($plugin, $network_wide) {
    gwhs_log_plugin_event('Activated', $plugin);
}, 10, 2);

add_action('deactivated_plugin', function($plugin, $network_wide) {
    gwhs_log_plugin_event('Deactivated', $plugin);
}, 10, 2);

add_action('deleted_plugin', function($plugin_slug, $deleted) {
    gwhs_log_plugin_event('Deleted', $plugin_slug);
>>>>>>> origin/main
}, 10, 2);