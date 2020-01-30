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
 * Class License.
 */
class License extends Container implements Helper
{
    /**
     * Get license key.
     *
     * @return string
     */
    public function getKey()
    {
        $optionsHelper = vchelper('Options');

        return $optionsHelper->get('license-key');
    }

    /**
     * Set license key.
     *
     * @param string $licenseKey
     */
    public function setKey($licenseKey)
    {
        $optionsHelper = vchelper('Options');
        $optionsHelper->set('license-key', trim($licenseKey));
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $optionsHelper = vchelper('Options');
        $optionsHelper->set('license-type', $type);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        $optionsHelper = vchelper('Options');

        return $optionsHelper->get('license-type');
    }

    /**
     * @param $expiration
     */
    public function setExpirationDate($expiration)
    {
        $optionsHelper = vchelper('Options');
        $optionsHelper->set('license-expiration', $expiration);
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        $optionsHelper = vchelper('Options');

        return $optionsHelper->get('license-expiration');
    }

    /**
     * @return bool
     */
    public function isFreeActivated()
    {
        return (bool)$this->getKey() && $this->getType() === 'free';
    }

    /**
     * @param string $redirectTo
     */
    public function refresh($redirectTo = 'vcv-update')
    {
        $token = vchelper('Token')->getToken(true);
        if ($token !== 'free-token') {
            // License is upgraded: fire check for update
            $optionsHelper = vchelper('Options');
            $optionsHelper->deleteTransient('lastBundleUpdate');
            $noticeHelper = vchelper('Notice');
            $noticeHelper->addNotice(
                'license-refresh',
                __('License data have been refreshed successfully.', 'visualcomposer'),
                'success',
                true
            );
            vcevent('vcv:hub:checkForUpdate', ['token' => $token]);
            wp_redirect(admin_url('admin.php?page=' . $redirectTo));
            exit;
        }
    }

    /**
     * @return bool
     */
    public function isAnyActivated()
    {
        return (bool)$this->getKey() && $this->getType();
    }

    /**
     * @return bool
     */
    public function isPremiumActivated()
    {
        return (bool)$this->getKey() && $this->getType() !== 'free';
    }

    /**
     * @param $errorCode
     *
     * @codingStandardsIgnoreStart
     * @return string|void
     */
    public function licenseErrorCodes($errorCode)
    {
        $message = '';
        switch ($errorCode) {
            case 'expired':
            case 1:
                $message = __('Visual Composer Website Builder license has expired.', 'visualcomposer');
                break;
            case 'missing':
            case 'item_name_mismatch':
            case 2:
                $message = __('Couldn\'t find a valid Visual Composer Website Builder license.', 'visualcomposer');
                break;
            case 'invalid':
            case 'site_inactive':
            case 'disabled':
            case 'revoked':
            case 3:
                $message = __('Visual Composer Website Builder license has been deactivated.', 'visualcomposer');
                break;
            case 4:
                $message = __('License key is missing, please enter a valid license key.', 'visualcomposer');
                break;
            case 5:
                $message = __('Url is missing, please try again.', 'visualcomposer');
                break;
            case 6:
                $message = __('Visual Composer Website Builder license is already activated.', 'visualcomposer');
                break;
            case 7:
                $message = __('Activation failed, please try again.', 'visualcomposer');
                break;
            case 'no_activations_left':
                $message = __('Your license key has reached its activation limit.', 'visualcomposer');
                break;
            default:
                $message = __('An error occurred, please try again.', 'visualcomposer');
                break;
        }

        // @codingStandardsIgnoreEnd
        return $message;
    }
}
