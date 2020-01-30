<?php

namespace MailOptin\GetResponseConnect;

use MailOptin\Core\Connections\ConnectionInterface;

class Connect extends AbstractGetResponseConnect implements ConnectionInterface
{
    /**
     * @var string key of connection service. its important all connection name ends with "Connect"
     */
    public static $connectionName = 'GetResponseConnect';

    public function __construct()
    {
        ConnectSettingsPage::get_instance();

        add_filter('mailoptin_registered_connections', array($this, 'register_connection'));

        parent::__construct();
    }

    public static function features_support($connection_service = '')
    {
        return [
            self::OPTIN_CAMPAIGN_SUPPORT,
            self::EMAIL_CAMPAIGN_SUPPORT,
            self::OPTIN_CUSTOM_FIELD_SUPPORT
        ];
    }

    /**
     * Register GetResponse Connection.
     *
     * @param array $connections
     *
     * @return array
     */
    public function register_connection($connections)
    {
        $connections[self::$connectionName] = __('GetResponse', 'mailoptin');

        return $connections;
    }

    /**
     * Replace placeholder tags with actual GetResponse tags.
     *
     * {@inheritdoc}
     */
    public function replace_placeholder_tags($content, $type = 'html')
    {
        $search = [
            '{{webversion}}',
            '{{unsubscribe}}'
        ];

        $replace = [
            '[[view]]',
            '[[remove]]'
        ];

        $content = str_replace($search, $replace, $content);

        return $this->replace_footer_placeholder_tags($content);
    }

    /**
     * {@inherit_doc}
     *
     * Return array of email list
     *
     * @return mixed
     */
    public function get_email_list()
    {
        try {
            $response = (array)$this->getresponse_instance()->getCampaigns();

            // sample error response.
            //            array (size=7)
            //  'httpStatus' => int 401
            //  'code' => int 1014
            //  'codeDescription' => string 'Problem during authentication process, check headers!' (length=53)
            //  'message' => string 'Unable to authenticate request. Check credentials or authentication method details' (length=82)
            //  'moreInfo' => string 'https://apidocs.getresponse.com/en/v3/errors/1014' (length=49)
            //  'context' =>
            //    object(stdClass)[1532]
            //      public 'authenticationType' => string 'auth_token' (length=10)
            //  'uuid' => string '761751b5-xxxxx' (length=36)

            if (isset($response['message'], $response['moreInfo'])) {
                self::save_optin_error_log(json_encode($response), 'getresponse');
            }

            // an array with list id as key and name as value.
            $lists_array = array();

            if ( ! empty($response)) {
                foreach ($response as $list) {
                    if (isset($list->campaignId, $list->name))
                        $lists_array[$list->campaignId] = $list->name;
                }
            }

            return $lists_array;


        } catch (\Exception $e) {
            self::save_optin_error_log($e->getMessage(), 'getresponse');
        }
    }

    public function get_optin_fields($list_id = '')
    {
        try {

            $response = (array)$this->getresponse_instance()->getCustomFields();

            if (is_array($response) && ! empty($response)) {
                $custom_fields_array = [];
                foreach ($response as $customField) {
                    $customFieldId   = $customField->customFieldId;
                    $customFieldName = $customField->name;

                    $custom_fields_array[$customFieldId] = $customFieldName;
                }

                return $custom_fields_array;
            }

            return self::save_optin_error_log(json_encode($response), 'getresponse');

        } catch (\Exception $e) {
            self::save_optin_error_log($e->getMessage(), 'getresponse');
        }
    }

    /**
     * @param int $email_campaign_id
     * @param int $campaign_log_id
     * @param string $subject
     * @param string $content_html
     * @param string $content_text
     *
     * @throws \Exception
     *
     * @return array
     */
    public function send_newsletter($email_campaign_id, $campaign_log_id, $subject, $content_html, $content_text)
    {
        return (new SendCampaign($email_campaign_id, $campaign_log_id, $subject, $content_html, $content_text))->send();
    }

    /**
     * @param string $email
     * @param string $name
     * @param string $list_id ID of email list to add subscriber to
     * @param mixed|null $extras
     *
     * @return mixed
     */
    public function subscribe($email, $name, $list_id, $extras = null)
    {
        return (new Subscription($email, $name, $list_id, $extras))->subscribe();
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