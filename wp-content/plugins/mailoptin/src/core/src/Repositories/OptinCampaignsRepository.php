<?php

namespace MailOptin\Core\Repositories;


use MailOptin\Core\Admin\Customizer\OptinForm\AbstractCustomizer;
use MailOptin\Core\PluginSettings\Settings;

class OptinCampaignsRepository extends AbstractRepository
{
    /**
     * @todo consider using it more for queries that get called frequenly on single page request.
     * @var array
     */
    private static $cache = [];

    /**
     * Check if an optin campaign name already exist.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function campaign_name_exist($name)
    {
        $campaign_name = sanitize_text_field($name);
        $table         = parent::campaigns_table();
        $result        = parent::wpdb()->get_var(parent::wpdb()->prepare("SELECT name FROM $table WHERE name = '%s'", $campaign_name));

        return ! empty($result);
    }

    /**
     * Is CTA button active for optin?
     *
     * @param $optin_campaign_id
     *
     * @return string
     */
    public static function is_cta_button_active($optin_campaign_id)
    {
        return self::get_merged_customizer_value($optin_campaign_id, 'display_only_button') === true;
    }

    public static function has_device_targeting_active($optin_campaign_id)
    {
        if (self::is_activated($optin_campaign_id)) {
            if (self::get_customizer_value($optin_campaign_id, 'device_targeting_hide_desktop', false)) {
                return true;
            }

            if (self::get_customizer_value($optin_campaign_id, 'device_targeting_hide_tablet', false)) {
                return true;
            }

            if (self::get_customizer_value($optin_campaign_id, 'device_targeting_hide_mobile', false)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Is optin campaign a split test variant?
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function is_split_test_variant($optin_campaign_id)
    {
        $optin_campaign_id = absint($optin_campaign_id);

        // implemented cache to ensure subsequent calls for same optin id
        // in single request return previous value.
        $cache_key = 'is_split_test_' . $optin_campaign_id;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            $parent_optin_id = self::$cache[$cache_key];
        } else {
            $parent_optin_id = self::$cache[$cache_key] = OptinCampaignMeta::get_campaign_meta(
                $optin_campaign_id,
                'split_test_parent',
                true
            );
        }

        if ( ! empty($parent_optin_id)) {
            return true;
        }

        return false;
    }

    /**
     * Check if optin campaign is a parent split test. That is, does it has variants?
     *
     * @param int $parent_optin_id
     *
     * @return bool
     */
    public static function is_split_test_parent($parent_optin_id)
    {
        $cache_key = 'is_split_test_parent_' . $parent_optin_id;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            $response = self::$cache[$cache_key];
        } else {
            $response = self::$cache[$cache_key] = OptinCampaignMeta::get_optin_id_by_meta_key_value('split_test_parent', $parent_optin_id);
        }

        if ( ! empty($response)) {
            return true;
        }

        return false;
    }

    /**
     * Get all AB test variants belong to a parent optin ID.
     *
     * @param int $parent_optin_id
     */
    public static function get_split_test_variant_ids($parent_optin_id)
    {
        $cache_key = 'get_split_test_variant_ids_' . $parent_optin_id;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        return self::$cache[$cache_key] = OptinCampaignMeta::get_optin_id_by_meta_key_value('split_test_parent', $parent_optin_id);
    }

    /**
     * Check if the split test campaign is active. That is, it isn't paused.
     *
     * @param int $parent_optin_id
     *
     * @return bool
     */
    public static function is_split_test_active($parent_optin_id)
    {
        $variant_ids = self::get_split_test_variant_ids($parent_optin_id);

        // from the array of returned variants, use the first to determine if split test is active.
        return self::is_activated($variant_ids[0]);
    }

    /**
     * Pick a variant from group of variants including parent optin.
     *
     * @param $optin_campaign_id
     *
     * @return int
     */
    public static function choose_split_test_variant($optin_campaign_id)
    {
        $variant_ids = OptinCampaignsRepository::get_split_test_variant_ids($optin_campaign_id);

        $parent_optin_campaign_id = $optin_campaign_id;

        if ( ! empty($variant_ids)) {
            // Merge the main optin with the split tests,
            // shuffle the array, and set the optin to the first item in the array.
            $variant_ids[] = $optin_campaign_id;
            shuffle($variant_ids);
            $optin_campaign_id = $variant_ids[0];
        }

        if ( ! OptinCampaignsRepository::is_activated($optin_campaign_id)) {
            $optin_campaign_id = $parent_optin_campaign_id;
        }

        return absint($optin_campaign_id);
    }

    /**
     * Count number of optin campaigns
     *
     * @return int
     */
    public static function campaign_count()
    {
        $table = parent::campaigns_table();

        return absint(parent::wpdb()->get_var("SELECT COUNT(*) FROM $table"));
    }

    /**
     * Add new optin campaign to database.
     *
     * @param string $name
     * @param string $class
     * @param string $type
     *
     * @return false|int
     */
    public static function add_optin_campaign($uuid, $name, $class, $type)
    {
        $response = parent::wpdb()->insert(
            parent::campaigns_table(),
            array(
                'uuid'        => $uuid,
                'name'        => stripslashes($name),
                'optin_class' => $class,
                'optin_type'  => $type
            ),
            array(
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );

        self::burst_optin_ids_cache();

        return ! $response ? $response : parent::wpdb()->insert_id;
    }

    /**
     * optin campaign UUID.
     *
     * @param int $optin_campaign_id
     *
     * @return string
     */
    public static function get_optin_campaign_uuid($optin_campaign_id)
    {
        $table = parent::campaigns_table();
        /**
         * @todo consider adding wp_cache_* for unchanging values to probably all database query methods to speed things up.
         */
        $cache_key = "campaign_uuid_$optin_campaign_id";

        if (wp_cache_get($cache_key) !== false) {
            return wp_cache_get($cache_key);
        }

        $result = parent::wpdb()->get_var("SELECT uuid FROM $table WHERE id = '$optin_campaign_id'");
        // expiration is not set thus making it not expire-able because uuid never changes. take note.
        wp_cache_set($cache_key, $result);

        return $result;
    }

    /**
     * optin campaign name.
     *
     * @param int $optin_campaign_id
     *
     * @return string
     */
    public static function get_optin_campaign_name($optin_campaign_id)
    {
        $table = parent::campaigns_table();

        return parent::wpdb()->get_var("SELECT name FROM $table WHERE id = '$optin_campaign_id'");
    }

    /**
     * The optin campaign optin campaign PHP class.
     *
     * @param int $optin_campaign_id
     *
     * @return string
     */
    public static function get_optin_campaign_class($optin_campaign_id)
    {
        $cache_key = 'get_optin_campaign_class_' . $optin_campaign_id;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        $table = parent::campaigns_table();

        return self::$cache[$cache_key] = parent::wpdb()->get_var("SELECT optin_class FROM $table WHERE id = '$optin_campaign_id'");
    }

    /**
     * Changes the optin campaign class
     *
     * @param int $optin_campaign_id
     *
     * @return string
     */
    public static function set_optin_campaign_class($optin_campaign_id, $class)
    {
        //Burst cache
        self::burst_cache($optin_campaign_id);

        return parent::wpdb()->update(
            parent::campaigns_table(),
            array(
                'optin_class' => $class
            ),
            array('id' => $optin_campaign_id),
            '%s',
            '%d'
        );
    }

    /**
     * The optin campaign ID from class name.
     *
     * @param string $optin_campaign_class_name
     *
     * @return string
     */
    public static function get_optin_campaign_id_from_class_name($optin_campaign_class_name)
    {
        $table = parent::campaigns_table();

        return parent::wpdb()->get_var("SELECT id FROM $table WHERE optin_campaign_class = '$optin_campaign_class_name'");
    }

    /**
     * The optin campaign type.
     *
     * @param int $optin_campaign_id
     *
     * @return string
     */
    public static function get_optin_campaign_type($optin_campaign_id)
    {
        $cache_key = 'get_optin_campaign_type_' . $optin_campaign_id;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        $table = parent::campaigns_table();

        return self::$cache[$cache_key] = parent::wpdb()->get_var("SELECT optin_type FROM $table WHERE id = '$optin_campaign_id'");
    }

    /**
     * Array of optin campaign IDs
     *
     * @param array $optin_types_exclude optin type to exclude from fetch.
     *
     * @return array
     */
    public static function get_optin_campaign_ids($optin_types_exclude = null)
    {
        $table = parent::campaigns_table();

        $sql = "SELECT id FROM $table";

        if ( ! empty($optin_types_exclude)) {

            // add single quote to the imploded optin types to exclude so that SQL is correct.
            $excludes = "'" . implode("', '", $optin_types_exclude) . "'";

            $sql .= " WHERE NOT optin_type IN ($excludes)";
        }

        return parent::wpdb()->get_col($sql);
    }

    /**
     * Array of sidebar optin campaign IDs
     *
     * @return array
     */
    public static function get_sidebar_optin_ids()
    {
        $table = parent::campaigns_table();

        return parent::wpdb()->get_col("SELECT id FROM $table WHERE optin_type = 'sidebar'");
    }

    /**
     * Array of in-post optin campaign IDs
     *
     * @return array
     */
    public static function get_inpost_optin_ids()
    {
        $table = parent::campaigns_table();

        return parent::wpdb()->get_col("SELECT id FROM $table WHERE optin_type = 'inpost'");
    }

    /**
     * Array of optin campaigns
     *
     * @return array
     */
    public static function get_optin_campaigns()
    {
        $cache_key = 'get_optin_campaigns';

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        $table = parent::campaigns_table();

        return self::$cache[$cache_key] = parent::wpdb()->get_results("SELECT * FROM $table", 'ARRAY_A');
    }

    /**
     * Get optin camapign by campaign ID.
     *
     * @param int $optin_campaign_id
     *
     * @return array|null|object
     */
    public static function get_optin_campaign_by_id($optin_campaign_id)
    {
        $table = parent::campaigns_table();

        return parent::wpdb()->get_row("SELECT * FROM $table WHERE id = '$optin_campaign_id'", 'ARRAY_A');
    }

    /**
     * Get optin campaign by its UUID.
     *
     * @param string $optin_uuid
     *
     * @return array|null|object
     */
    public static function get_optin_campaign_by_uuid($optin_uuid)
    {
        $cache_key = 'get_optin_campaign_by_uuid' . $optin_uuid;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        $table = parent::campaigns_table();

        return self::$cache[$cache_key] = parent::wpdb()->get_row("SELECT * FROM $table WHERE uuid = '$optin_uuid'", 'ARRAY_A');
    }

    /**
     * Get optin campaign ID by its UUID.
     *
     * @param string $optin_uuid
     *
     * @return int|string
     */
    public static function get_optin_campaign_id_by_uuid($optin_uuid)
    {
        $cache_key = 'get_optin_campaign_id_by_uuid_' . $optin_uuid;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        $table = parent::campaigns_table();

        return self::$cache[$cache_key] = parent::wpdb()->get_var("SELECT id FROM $table WHERE uuid = '$optin_uuid'");
    }

    /**
     * Optin data as stored in wp_option table.
     *
     * @return mixed
     */
    public static function get_optin_saved_customizer_data()
    {
        $cache_key = 'get_optin_saved_customizer_data';

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            return self::$cache[$cache_key];
        }

        // disable cache for customizer interface
        return self::$cache[$cache_key] = get_option(MO_OPTIN_CAMPAIGN_WP_OPTION_NAME, []);
    }

    /**
     * Get customizer value for optin.
     *
     * @param int $optin_campaign_id
     * @param string $settings_name
     * @param string $default
     *
     * @return mixed
     */
    public static function get_customizer_value($optin_campaign_id, $settings_name, $default = '')
    {
        $settings = self::get_optin_saved_customizer_data();
        $value    = isset($settings[$optin_campaign_id][$settings_name]) ? $settings[$optin_campaign_id][$settings_name] : null;

        $data = ! is_null($value) ? $value : $default;

        return apply_filters('mo_get_customizer_value', $data, $settings_name, $default, $optin_campaign_id);
    }

    /**
     * Return value of a optin form customizer settings or the default settings value if not found.
     *
     * @param int $optin_campaign_id
     * @param string $optin_form_setting
     *
     * @return string
     */
    public static function get_merged_customizer_value($optin_campaign_id, $settings_name)
    {
        $customizer_defaults = (new AbstractCustomizer($optin_campaign_id))->customizer_defaults;

        $default = isset($customizer_defaults[$settings_name]) ? $customizer_defaults[$settings_name] : '';

        return self::get_customizer_value($optin_campaign_id, $settings_name, $default);
    }

    /**
     * Get custom fields belonging to an optin form.
     *
     * @param int $optin_campaign_id
     *
     * @return array
     */
    public static function form_custom_fields($optin_campaign_id)
    {
        $custom_fields = self::get_merged_customizer_value($optin_campaign_id, 'fields');

        if (empty($custom_fields)) return [];

        $custom_fields = json_decode($custom_fields, true);

        return $custom_fields;
    }

    /**
     * Get the field type of a custom field.
     *
     * @param $cid
     * @param $optin_campaign_id
     *
     * @return mixed
     */
    public static function get_custom_field_type_by_id($cid, $optin_campaign_id)
    {
        $fields = self::form_custom_fields($optin_campaign_id);

        foreach ($fields as $field) {
            if ($field['cid'] == $cid) {
                return $field['field_type'];
            }
        }
    }

    /**
     * Check if an optin has a specific custom field type.
     *
     * @param int $optin_campaign_id
     * @param string $field_type
     *
     * @return bool
     */
    public static function has_custom_field_type($optin_campaign_id, $field_type)
    {
        $fields = self::form_custom_fields($optin_campaign_id);

        $has_field = false;
        foreach ($fields as $field) {
            if (in_array($field['field_type'], [$field_type])) {
                $has_field = true;
                break;
            }
        }

        return $has_field;
    }

    /**
     * Retrieve all optin campaign settings.
     *
     * @return array
     */
    public static function get_settings()
    {
        return self::get_optin_saved_customizer_data();
    }

    /**
     * Retrieve a optin campaign settings by its ID.
     *
     * @param int $optin_campaign_id
     *
     * @return mixed
     */
    public static function get_settings_by_id($optin_campaign_id)
    {
        $settings = self::get_settings();

        return isset($settings[$optin_campaign_id]) ? $settings[$optin_campaign_id] : '';
    }

    /**
     * Update campaign title / name.
     *
     * @param string $title
     * @param int $optin_campaign_id
     *
     * @return false|int
     */
    public static function updateCampaignName($title, $optin_campaign_id)
    {
        $table = parent::campaigns_table();

        return parent::wpdb()->update(
            $table,
            array(
                'name' => $title
            ),
            array('id' => absint($optin_campaign_id)),
            array(
                '%s'
            ),
            array('%d')
        );
    }

    /**
     * Update all optin campaign settings.
     *
     * @param array $campaignSettings
     *
     * @return bool
     */
    public static function updateSettings($campaignSettings)
    {
        return update_option(MO_OPTIN_CAMPAIGN_WP_OPTION_NAME, $campaignSettings);
    }

    /**
     * Is optin campaign enabled or activated?
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function is_activated($optin_campaign_id)
    {
        $campaign_settings = self::get_settings_by_id($optin_campaign_id);

        return isset($campaign_settings['activate_optin']) && ($campaign_settings['activate_optin'] === true);
    }

    /**
     * Check to determine if optin should be shown base on whether global success and interaction cookie is set and active
     *
     * @return bool
     */
    public static function global_cookie_check_result()
    {
        $global_exit_cookie = Settings::instance()->global_cookie();
        $global_exit_cookie = ! empty($global_exit_cookie) ? absint($global_exit_cookie) : 0;

        $global_success_cookie = Settings::instance()->global_success_cookie();
        $global_success_cookie = ! empty($global_success_cookie) ? absint($global_success_cookie) : 0;

        // Do not show if global interaction/exit cookie is set
        if (isset($_COOKIE['mo_global_cookie']) && $_COOKIE['mo_global_cookie'] === 'true' && $global_exit_cookie > 0) return false;

        // Do not show if global success cookie is set
        if (isset($_COOKIE['mo_global_success_cookie']) && $_COOKIE['mo_global_success_cookie'] === 'true' && $global_success_cookie > 0) return false;

        return true;
    }

    /**
     * True if optin form has successfully received opt-in from current visitor/user.
     *
     * @param int $optin_campaign_uuid
     *
     * @return bool
     */
    public static function user_has_successful_optin($optin_campaign_uuid)
    {
        $result = isset($_COOKIE['mo_success_' . $optin_campaign_uuid]) && $_COOKIE['mo_success_' . $optin_campaign_uuid] === 'true';

        return apply_filters('mo_user_has_successful_optin', $result, $optin_campaign_uuid);
    }

    /**
     * Activate optin campaign.
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function activate_campaign($optin_campaign_id)
    {
        $optin_campaign_id = absint($optin_campaign_id);
        // update the "activate_optin" setting to true
        $all_settings = self::get_settings();

        if ($all_settings[$optin_campaign_id]['activate_optin'] === true) return true;

        $all_settings[$optin_campaign_id]['activate_optin'] = true;

        return self::updateSettings($all_settings);
    }

    /**
     * Deactivate optin campaign.
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function deactivate_campaign($optin_campaign_id)
    {
        $optin_campaign_id = absint($optin_campaign_id);
        // update the "activate_optin" setting to true
        $all_settings                                       = self::get_settings();
        $all_settings[$optin_campaign_id]['activate_optin'] = false;

        return self::updateSettings($all_settings);
    }


    /**
     * Is optin campaign in test mode
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function is_test_mode($optin_campaign_id)
    {
        $cache_key = 'is_test_mode_' . $optin_campaign_id;

        if ( ! is_customize_preview() && isset(self::$cache[$cache_key])) {
            $campaign_settings = self::$cache[$cache_key];
        } else {
            $campaign_settings = self::$cache[$cache_key] = self::get_settings_by_id($optin_campaign_id);
        }

        return isset($campaign_settings['test_mode']) && ($campaign_settings['test_mode'] === true);
    }


    /**
     * Enable test mode for optin campaign.
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function enable_test_mode($optin_campaign_id)
    {
        // update the "activate_optin" setting to true
        $all_settings                                  = self::get_settings();
        $all_settings[$optin_campaign_id]['test_mode'] = true;

        return self::updateSettings($all_settings);
    }


    /**
     * Disable test mode for optin campaign.
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function disable_test_mode($optin_campaign_id)
    {
        // update the "activate_optin" setting to true
        $all_settings                                  = self::get_settings();
        $all_settings[$optin_campaign_id]['test_mode'] = false;

        return self::updateSettings($all_settings);
    }


    /**
     * Delete an optin campaign from record.
     *
     * @param int $optin_campaign_id optin_form ID
     */
    public static function delete_optin_campaign($optin_campaign_id)
    {
        parent::wpdb()->delete(
            parent::campaigns_table(),
            array('id' => $optin_campaign_id),
            array('%d')
        );

        OptinCampaignsRepository::delete_settings_by_id($optin_campaign_id);

        OptinCampaignMeta::delete_campaign_meta($optin_campaign_id, 'split_test_parent');
    }


    /**
     * Delete all settings data of an optin campaign.
     *
     * @param int $optin_campaign_id
     *
     * @return bool
     */
    public static function delete_settings_by_id($optin_campaign_id)
    {
        $all_optin_campaign_settings = self::get_settings();
        unset($all_optin_campaign_settings[$optin_campaign_id]);

        return self::updateSettings($all_optin_campaign_settings);
    }

    /**
     * Delete all optin campaign (structure/body) cache.
     */
    public static function burst_all_cache()
    {
        $optin_ids = self::get_optin_campaign_ids();

        foreach ($optin_ids as $optin_id) {
            self::burst_cache($optin_id);
        }
    }

    /**
     * Burst or delete optin campaign cache.
     *
     * @param $optin_campaign_id
     */
    public static function burst_cache($optin_campaign_id)
    {
        delete_transient("mo_get_optin_form_structure_{$optin_campaign_id}");
        delete_transient("mo_get_optin_form_fonts_{$optin_campaign_id}");
    }

    /**
     * Burst or delete optin campaign ID cache.
     */
    public static function burst_optin_ids_cache()
    {
        delete_transient("mo_get_optin_ids_footer_display");
        delete_transient("mo_get_optin_ids_inpost_display");
    }
}