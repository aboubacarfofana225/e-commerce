<?php
//if uninstall not called from WordPress exit
use MailOptin\Core\Core;
use MailOptin\Core\Repositories\OptinCampaignsRepository;

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

// Load MailOptin file
include_once('mailoptin.php');

$remove_plugin_data = \MailOptin\Core\PluginSettings\Settings::instance()->remove_plugin_data();

if ($remove_plugin_data == 'true') {

    OptinCampaignsRepository::burst_all_cache();

    wp_clear_scheduled_hook('mo_daily_recurring_job');
    wp_clear_scheduled_hook('mo_hourly_recurring_job');

    /** Delete plugin options */
    delete_option(MAILOPTIN_CONNECTIONS_DB_OPTION_NAME);
    delete_option(MAILOPTIN_SETTINGS_DB_OPTION_NAME);
    delete_option(MO_OPTIN_CAMPAIGN_WP_OPTION_NAME);
    delete_option(MO_OPTIN_TEMPLATE_WP_OPTION_NAME);

    delete_option('mo_wp_user_unsubscribers');
    delete_option('mo_mailjet_double_optin_bucket');
    delete_option('mo_install_date');
    delete_option('mo_dismiss_leave_review_forever');
    delete_option('mo_plugin_activated');
    delete_option('mo_license_status');
    delete_option('mo_license_expired_status');
    delete_option('mo_license_key');
    delete_option('mo_price_id');
    delete_option('mo_state_repository');
    delete_option('mo_db_ver');
    // legacy reason where we were saving this option multisite-wide
    delete_site_option('mo_db_ver');
    // do not remove mo_license_once_active option
    // delete_option('mo_license_once_active');

    global $wpdb;
    $db_prefix = $wpdb->prefix;

    $drop_tables = array();

    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::optin_campaign_meta_table_name;
    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::email_campaign_meta_table_name;
    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::campaign_log_meta_table_name;
    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::campaign_log_table_name;
    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::optin_campaigns_table_name;
    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::conversions_table_name;
    $drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}" . Core::email_campaigns_table_name;

    $drop_tables = apply_filters('mo_drop_database_tables', $drop_tables, $db_prefix);

    foreach ($drop_tables as $tables) {
        $wpdb->query($tables);
    }
}