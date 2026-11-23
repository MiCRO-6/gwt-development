<<<<<<< HEAD
<?php
/**
 * This file logs user activity to a specific file in the theme directory.
 * It creates a directory if it doesn't exist and appends log entries with timestamps.
 * @package GWT
 * @since Government Website Template v27.1
 * eol-61
 */
add_action('user_register', function($user_id) {
    $new_user = get_userdata($user_id);

    $log_dir = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/gwhs.txt';

    if (!file_exists($log_dir)) {
        if (!mkdir($log_dir, 0755, true) && !is_dir($log_dir)) {
            error_log("Failed to create log directory: $log_dir");
            return;
        }
    }

    if (is_user_logged_in()) {
        $creator = wp_get_current_user();
        $creator_info = "{$creator->user_login} (ID: {$creator->ID})";
    } else {
        $creator_info = 'Self-registered (frontend)';
    }

    $role = !empty($new_user->roles) ? $new_user->roles[0] : 'none';

    $datetime = new DateTime('now', new DateTimeZone('Asia/Manila')); 
    $log_time = $datetime->format('Y-m-d H:i:s P'); 

    $log_entry = "[{$log_time}] [Created] New User: {$new_user->user_login} (Role: {$role}) | Created by: {$creator_info}" . PHP_EOL;

    if (!file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX)) {
        error_log("Failed to write to log file: $log_file");
    }
});

add_action('delete_user', function($user_id) {
    $deleted_user = get_userdata($user_id);
    $log_dir = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/gwhs.txt';

    if (is_user_logged_in()) {
        $deleter = wp_get_current_user();
        $deleter_info = "{$deleter->user_login} (ID: {$deleter->ID})";
    } else {
        $deleter_info = 'Unknown (possible system action)';
    }

    $datetime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $log_time = $datetime->format('Y-m-d H:i:s P'); 

    $log_entry = "[{$log_time}] [Deleted] User: {$deleted_user->user_login} (ID: {$deleted_user->ID}) | Deleted by: {$deleter_info}" . PHP_EOL;

    if (!file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX)) {
        error_log("Failed to write to log file: $log_file");
    }
=======
<?php
/**
 * This file logs user activity to a specific file in the theme directory.
 * It creates a directory if it doesn't exist and appends log entries with timestamps.
 * @package GWT
 * @since Government Website Template v27.1
 * eol-61
 */
add_action('user_register', function($user_id) {
    $new_user = get_userdata($user_id);

    $log_dir = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/gwhs.txt';

    if (!file_exists($log_dir)) {
        if (!mkdir($log_dir, 0755, true) && !is_dir($log_dir)) {
            error_log("Failed to create log directory: $log_dir");
            return;
        }
    }

    if (is_user_logged_in()) {
        $creator = wp_get_current_user();
        $creator_info = "{$creator->user_login} (ID: {$creator->ID})";
    } else {
        $creator_info = 'Self-registered (frontend)';
    }

    $role = !empty($new_user->roles) ? $new_user->roles[0] : 'none';

    $datetime = new DateTime('now', new DateTimeZone('Asia/Manila')); 
    $log_time = $datetime->format('Y-m-d H:i:s P'); 

    $log_entry = "[{$log_time}] [Created] New User: {$new_user->user_login} (Role: {$role}) | Created by: {$creator_info}" . PHP_EOL;

    if (!file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX)) {
        error_log("Failed to write to log file: $log_file");
    }
});

add_action('delete_user', function($user_id) {
    $deleted_user = get_userdata($user_id);
    $log_dir = get_stylesheet_directory() . '/inc/vendors/.1095';
    $log_file = $log_dir . '/gwhs.txt';

    if (is_user_logged_in()) {
        $deleter = wp_get_current_user();
        $deleter_info = "{$deleter->user_login} (ID: {$deleter->ID})";
    } else {
        $deleter_info = 'Unknown (possible system action)';
    }

    $datetime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $log_time = $datetime->format('Y-m-d H:i:s P'); 

    $log_entry = "[{$log_time}] [Deleted] User: {$deleted_user->user_login} (ID: {$deleted_user->ID}) | Deleted by: {$deleter_info}" . PHP_EOL;

    if (!file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX)) {
        error_log("Failed to write to log file: $log_file");
    }
>>>>>>> origin/main
});