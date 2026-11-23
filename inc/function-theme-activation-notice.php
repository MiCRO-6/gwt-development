<?php

add_action( 'after_switch_theme', 'gwt_theme_activation_notice' );
function gwt_theme_activation_notice() {
    set_transient( 'gwt_show_activation_notice', true, 30 );
}

add_action( 'admin_notices', 'gwt_display_activation_popup_notice' );
function gwt_display_activation_popup_notice() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( get_transient( 'gwt_show_activation_notice' ) ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><strong>NOTICE</strong></p>
            <p><strong>Reminder:</strong> Please use only the <a href="https://bit.ly/List-of-approved-plugins" target="_blank" rel="noopener noreferrer"><strong>Plugins Approved</strong></a> by the GWHS Team to avoid compatibility and security issues.</p>
            <p><strong>Reminder:</strong> If you encounter any bugs or unexpected errors, please contact the <a href="https://mail.google.com/mail/u/0/?fs=1&to=gwhssupport@dict.gov.ph&tf=cm" target="_blank" rel="noopener noreferrer">GWHS Team</a>.</p>
        </div>
        <?php
        delete_transient( 'gwt_show_activation_notice' );
    }
}
