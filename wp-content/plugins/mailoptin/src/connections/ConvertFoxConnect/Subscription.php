<?php

namespace MailOptin\ConvertFoxConnect;

use MailOptin\Core\Repositories\OptinCampaignsRepository;

class Subscription extends AbstractConvertFoxConnect
{
    public $email;
    public $name;
    public $list_id;
    public $extras;

    public function __construct($email, $name, $list_id, $extras)
    {
        $this->email   = $email;
        $this->name    = $name;
        $this->list_id = $list_id;
        $this->extras  = $extras;

        parent::__construct();
    }

    /**
     * Record / track event
     *
     * @param $campaign_id
     *
     * @return array
     * @throws \Exception
     */
    public function record_event()
    {
        $result = $this->convertfox_instance()->make_request('events', [
            // apparently, it's "name" not event_name as their doc states.
            // leaving event_name in case its corrected in future so it still works.
            'event_name' => 'mailoptin_lead',
            'name'       => 'mailoptin_lead',
            'email'      => $this->email,
            'properties' => [
                'optin_campaign' => OptinCampaignsRepository::get_optin_campaign_name(
                    $this->extras['optin_campaign_id']
                ),
                'conversion_url' => $this->extras['conversion_page'],
                'referrer_url'   => $this->extras['referrer'],
                'user_agent'     => $this->extras['user_agent']
            ]
        ],
            'post'
        );

        if (parent::is_http_code_not_success($result['status_code'])) {
            self::save_optin_error_log($this->email . ': ' . json_encode($result['body']->errors), 'convertfox', $this->extras['optin_campaign_id']);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function subscribe()
    {
        try {

            $lead_tags = array_map('trim',
                explode(',', $this->get_integration_data('ConvertFoxConnect_lead_tags'))
            );

            // remove empty array.
            $lead_tags = array_filter($lead_tags, function ($value) {
                return ! empty($value);
            });

            $lead_data = [
                'name'  => $this->name,
                'email' => $this->email,
            ];

            $lead_data['tags'] = $lead_tags;

            if ( ! apply_filters('mo_optin_convertfox_default_tag_disable', false)) {
                // always include mailoptin tag.
                array_push($lead_data['tags'], 'mailoptin');
            }

            if (isset($this->extras['mo-acceptance']) && $this->extras['mo-acceptance'] == 'yes') {
                $gdpr_tag = apply_filters('mo_connections_convertfox_acceptance_tag', 'gdpr');
                array_push($lead_data['tags'], $gdpr_tag);
            }

            $lead_data = array_filter($lead_data, [$this, 'data_filter']);

            $response = $this->convertfox_instance()->make_request('leads', $lead_data, 'post');

            if (parent::is_http_code_success($response['status_code'])) {
                $this->record_event();

                return parent::ajax_success();
            }

            self::save_optin_error_log(json_encode($response['body']), 'convertfox', $this->extras['optin_campaign_id']);

            return parent::ajax_failure(__('There was an error saving your contact. Please try again.', 'mailoptin'));

        } catch (\Exception $e) {
            self::save_optin_error_log($e->getCode() . ': ' . $e->getMessage(), 'convertfox', $this->extras['optin_campaign_id']);

            return parent::ajax_failure(__('There was an error saving your contact. Please try again.', 'mailoptin'));
        }
    }
}