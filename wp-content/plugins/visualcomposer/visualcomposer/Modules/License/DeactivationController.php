<?php

namespace VisualComposer\Modules\License;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Container;
use VisualComposer\Framework\Illuminate\Support\Module;
use VisualComposer\Helpers\License;
use VisualComposer\Helpers\Options;
use VisualComposer\Helpers\Request;
use VisualComposer\Helpers\Traits\EventsFilters;

/**
 * Class DeactivationController
 * @package VisualComposer\Modules\License
 */
class DeactivationController extends Container implements Module
{
    use EventsFilters;

    /**
     * DeactivationController constructor.
     */
    public function __construct()
    {
        /** @see \VisualComposer\Modules\License\DeactivationController::pingDeactivation */
        $this->addFilter('vcv:ajax:license:deactivation:ping', 'pingDeactivation');

        /** @see \VisualComposer\Modules\License\DeactivationController::deactivate */
        $this->addFilter('vcv:ajax:license:deactivate:adminNonce', 'deactivate');
    }

    /**
     * Force license deactivation
     *
     * @param \VisualComposer\Helpers\Request $requestHelper
     * @param \VisualComposer\Helpers\License $licenseHelper
     * @param \VisualComposer\Helpers\Options $optionsHelper
     *
     * @return array
     */
    protected function pingDeactivation(Request $requestHelper, License $licenseHelper, Options $optionsHelper)
    {
        $code = $requestHelper->input('code');
        if ($code && $licenseHelper->isAnyActivated()) {
            if ($code === sha1($licenseHelper->getKey())) {
                $optionsHelper->deleteTransient('lastBundleUpdate');
            }
        }

        return ['status' => true];
    }

    /**
     * @param $response
     * @param $payload
     * @param \VisualComposer\Helpers\License $licenseHelper
     */
    protected function deactivate($response, $payload, License $licenseHelper)
    {
        if (vchelper('AccessCurrentUser')->wpAll('manage_options')->get()) {
            // data to send in our API request
            $params = [
                'edd_action' => 'deactivate_license',
                'license' => $licenseHelper->getKey(),
                'item_name' => 'Visual Composer',
                'url' => VCV_PLUGIN_URL,
            ];
            // Send the remote request
            $request = wp_remote_post(
                vcvenv('VCV_HUB_URL'),
                [
                    'body' => $params,
                    'timeout' => 30,
                ]
            );

            if (wp_remote_retrieve_response_code($request) === 200) {
                $licenseHelper->setKey('');
                $licenseHelper->setType('');
                $licenseHelper->setExpirationDate('');

                wp_redirect(admin_url('admin.php?page=vcv-getting-started'));
                vcvdie();
            }
        }

        wp_redirect(admin_url('admin.php?page=vcv-settings'));
        vcvdie();
    }
}
