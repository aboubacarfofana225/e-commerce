<?php

namespace MailOptin\ElementorConnect;

use MailOptin\Core\Connections\AbstractConnect;


class Connect
{
    /**
     * @var string key of connection service. its important all connection name ends with "Connect"
     */
    public static $connectionName = 'ElementorConnect';

    public function __construct()
    {
        ConnectSettingsPage::get_instance();
        add_filter('mailoptin_registered_connections', array($this, 'register_connection'));
        Init::get_instance();
    }

    public static function features_support($connection_service = '')
    {
        $flag = [];

        if ($connection_service == \MailOptin\ConvertFoxConnect\Connect::$connectionName) {
            $flag[AbstractConnect::NON_EMAIL_LIST_SUPPORT];
        }

        return $flag;
    }

    /**
     * Is Elementor successfully connected to?
     *
     * @return bool
     */
    public static function is_connected()
    {
        $db_options = get_option(MAILOPTIN_CONNECTIONS_DB_OPTION_NAME);

        return !empty($db_options['elementor_activate']) && $db_options['elementor_activate'] == 'true';
    }

    /**
     * Register EmailOctopus Connection.
     *
     * @param array $connections
     *
     * @return array
     */
    public function register_connection($connections)
    {
        $connections[self::$connectionName] = __('Elementor', 'mailoptin');

        return $connections;
    }

    /**
     * Singleton poop.
     *
     * @return Connect|null
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}