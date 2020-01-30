<?php

namespace MailOptin\ElementorConnect;

use MailOptin\Core\Connections\AbstractConnect;

class ConnectSettingsPage
{
    public function __construct()
    {
        add_filter('mailoptin_connections_settings_page', array($this, 'connection_settings'), 10, 99);
    }

    public function connection_settings($arg)
    {
        if (Connect::is_connected()) {
            $status = sprintf('<span style="color:#008000">(%s)</span>', __('Connected', 'mailoptin'));
        } else {
            $status = sprintf('<span style="color:#FF0000">(%s)</span>', __('Not Connected', 'mailoptin'));
        }

        $settingsArg[] = array(
            'section_title_without_status'             => __('Elementor', 'mailoptin'),
            'section_title' => __('Elementor Connection', 'mailoptin') . " $status",
            'type' => AbstractConnect::OTHER_TYPE,
            'elementor_activate' => array(
                'type' => 'checkbox',
                'label' => __('Elementor Integration', 'mailoptin'),
                'description' => sprintf(
                    __('Check this to enable MailOptin integration with Elementor WordPress page builder. %sLearn More%s', 'mailoptin'),
                    '<a href="https://mailoptin.io/article/connect-mailoptin-with-elementor/" target="_blank">', '</a>'
                ),
            ),
        );

        return array_merge($arg, $settingsArg);
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