<?php

namespace VisualComposer\Helpers;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Container;
use VisualComposer\Framework\Illuminate\Support\Helper;

/**
 * Class Token.
 */
class Token extends Container implements Helper
{
    /**
     * @param boolean $force
     *
     * @return bool|string|array
     */
    public function getToken($force = false)
    {
        $licenseHelper = vchelper('License');
        if ($licenseHelper->isAnyActivated()) {
            if (!$force && $licenseHelper->isFreeActivated()) {
                $token = 'free-token';

                return $token;
            }

            $body = [
                'hoster_id' => 'account',
                'id' => VCV_PLUGIN_URL,
                'domain' => get_site_url(),
                'url' => VCV_PLUGIN_URL,
                'vcv-version' => VCV_VERSION,
            ];
            $body['license-key'] = $licenseHelper->getKey();

            $url = $licenseHelper->isPremiumActivated() ? vcvenv('VCV_PREMIUM_TOKEN_URL') : vcvenv('VCV_TOKEN_URL');
            $url = vchelper('Url')->query($url, $body);

            $result = wp_remote_get(
                $url,
                [
                    'timeout' => 30,
                ]
            );

            return $this->getTokenResponse($result);
        }

        return false;
    }

    /**
     * @param $result
     *
     * @return string|bool
     */
    protected function getTokenResponse($result)
    {
        $loggerHelper = vchelper('Logger');
        $noticeHelper = vchelper('Notice');
        $licenseHelper = vchelper('License');
        $optionsHelper = vchelper('Options');

        $body = [];
        if (is_array($result) && isset($result['body'])) {
            $body = json_decode($result['body'], true);
        }

        if ($body && isset($body['error'], $body['error']['type'], $body['error']['code'])) {
            $code = $body['error']['code'];
            $licenseHelper->setKey('');
            $licenseHelper->setType('');
            $licenseHelper->setExpirationDate('');
            $loggerHelper->log(
                $licenseHelper->licenseErrorCodes($code),
                [
                    'result' => $body,
                ]
            );
            $noticeHelper->addNotice(
                'license:expiration',
                $licenseHelper->licenseErrorCodes($code)
            );

            return false;
        }

        if (!empty($body) && !vcIsBadResponse($result)) {
            if (is_array($body) && isset($body['data'], $body['success']) && $body['success']) {
                $token = $body['data']['token'];
                if (isset($body['data']['price_id'])) {
                    $previousType = $licenseHelper->getType();
                    $priceId = $body['data']['price_id'];
                    if ($priceId !== '4' && $previousType !== 'premium') {
                        $optionsHelper->deleteTransient('lastBundleUpdate');
                        $licenseHelper->setType('premium');
                    }
                    $licenseHelper->setExpirationDate($body['data']['expiration']);
                }

                $this->checkLicenseExpiration($body['data'], $noticeHelper);

                return $token;
            }
        }

        return false;
    }

    /**
     * @param $data
     * @param \VisualComposer\Helpers\Notice $noticeHelper
     */
    protected function checkLicenseExpiration($data, Notice $noticeHelper)
    {
        if (isset($data['expiration'])) {
            // if soon (<7 days) then show warning
            if ($data['expiration'] !== 'lifetime' && intval($data['expiration']) < (time() + WEEK_IN_SECONDS)) {
                $message = sprintf(
                    __('Your Visual Composer Website Builder License will expire soon - %s', 'visualcomposer'),
                    date(
                        get_option('date_format') . ' ' . get_option('time_format'),
                        $data['expiration']
                    )
                );
                $noticeHelper->addNotice('license:expiration', $message);
            } else {
                $noticeHelper->removeNotice('license:expiration');
            }
        }
    }
}
