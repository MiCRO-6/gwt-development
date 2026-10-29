<?php
function log_user_login_info($user_login, $user) {
    $datetime   = new DateTime('now', new DateTimeZone('Asia/Manila')); // GMT+8
    $log_time   = $datetime->format('Y-m-d H:i:s P'); // Include offset as +08:00

    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown Agent';
    $role       = !empty($user->roles) ? implode(', ', $user->roles) : 'no role';

    $log_message = "[{$log_time}] User logged in: {$user_login} | Role: {$role} | Agent: {$user_agent}" . PHP_EOL;

    $log_dir  = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/MiCRO.txt';

    if (!file_exists($log_dir)) {
        if (!mkdir($log_dir, 0755, true) && !is_dir($log_dir)) {
            error_log("Failed to create log directory: $log_dir");
            return;
        }
    }

    if (!file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX)) {
        error_log("Failed to write login log to: $log_file");
    }
}
add_action('wp_login', 'log_user_login_info', 10, 2);

//Capture user before logout
function cache_user_before_logout() {
    if (is_user_logged_in()) {
        global $logout_user;
        $logout_user = wp_get_current_user();
    }
}
add_action('init', 'cache_user_before_logout');

function log_user_logout_info() {
    global $logout_user;

    if (!isset($logout_user) || empty($logout_user->user_login)) {
        return;
    }

    $datetime   = new DateTime('now', new DateTimeZone('Asia/Manila')); // GMT+8
    $log_time   = $datetime->format('Y-m-d H:i:s P'); // Include offset as +08:00

    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown Agent';

    $log_message = "[{$log_time}] User logged out: {$logout_user->user_login} | Agent: {$user_agent}" . PHP_EOL;

    $log_dir  = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/MiCRO.txt';

    if (!file_exists($log_dir)) {
        if (!mkdir($log_dir, 0755, true) && !is_dir($log_dir)) {
            error_log("Failed to create log directory: $log_dir");
            return;
        }
    }

    if (!file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX)) {
        error_log("Failed to write logout log to: $log_file");
    }
}
add_action('wp_logout', 'log_user_logout_info');
