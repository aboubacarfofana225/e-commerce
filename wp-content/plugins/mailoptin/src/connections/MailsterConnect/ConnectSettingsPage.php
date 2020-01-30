<?php

namespace MailOptin\MailsterConnect;

use MailOptin\Core\Connections\AbstractConnect;

class ConnectSettingsPage
{
    public function __construct()
    {
        add_filter('mailoptin_connections_settings_page', array($this, 'connection_settings'), 10, 99);
        add_action('wp_cspa_settings_after_title', array($this, 'output_error_log_link'), 10, 2);
    }

    public function connection_settings($arg)
    {
        if (AbstractMailsterConnect::is_connected()) {
            $status = sprintf('<span style="color:#008000">(%s)</span>', __('Connected', 'mailoptin'));
        } else {
            $status = sprintf('<span style="color:#FF0000">(%s)</span>', __('Not Connected', 'mailoptin'));
        }

        if (function_exists('mailster')) {
            $settingsArg[] = array(
                'section_title_without_status' => __('Mailster', 'mailoptin'),
                'section_title'                => __('Mailster Connection', 'mailoptin') . " $status",
                'type'                         => AbstractConnect::EMAIL_MARKETING_TYPE,
                'mailster_activate'            => array(
                    'type'        => 'arbitrary',
                    'description' => sprintf(
                        __('%sThis integration is enabled because Mailster is currently installed and activated.%s', 'mailoptin'),
                        '<p style="text-align: center">',
                        '</p>'
                    )
                ),
                'disable_submit_button'        => true,
            );
        } else {
            $settingsArg[] = array(
                'section_title_without_status' => __('Mailster', 'mailoptin'),
                'section_title'                => __('Mailster Connection', 'mailoptin') . " $status",
                'type'                         => AbstractConnect::EMAIL_MARKETING_TYPE,
                'mailster_not_found'           => array(
                    'type'        => 'arbitrary',
                    'description' => sprintf(
                        __('%sThis integration is disabled because you currently do not have Mailster installed and activated.%s', 'mailoptin'),
                        '<p style="text-align: center">',
                        '</p>'
                    ),
                ),
                'disable_submit_button'        => true,
            );
        }

        return array_merge($arg, $settingsArg);
    }

    public function output_error_log_link($option, $args)
    {
        //Not a mailster connection section
        if (MAILOPTIN_CONNECTIONS_DB_OPTION_NAME !== $option || ! isset($args['mailster_activate'])) {
            return;
        }

        //Output error log link if  there is one
        echo AbstractConnect::get_optin_error_log_link('mailster');

    }

    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}