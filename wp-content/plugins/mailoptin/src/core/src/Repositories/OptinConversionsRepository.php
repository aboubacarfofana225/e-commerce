<?php
/**
 * Copyright (C) 2016  Agbonghama Collins <me@w3guy.com>
 */

namespace MailOptin\Core\Repositories;


class OptinConversionsRepository extends AbstractRepository
{

    /**
     * Add new conversion data to database.
     *
     *
     * @param array $data {
     *     Array of conversion data
     *
     * @type string $optin_id
     * @type string $optin_type
     * @type string $name
     * @type string $email
     * @type string $user_agent
     * @type string $conversion_page
     * @type string $referrer
     * }
     *
     * @return false|int
     */
    public static function add($data)
    {
        $response = parent::wpdb()->insert(
            parent::conversions_table(),
            array(
                'optin_id'        => $data['optin_campaign_id'],
                'optin_type'      => $data['optin_campaign_type'],
                'name'            => $data['name'],
                'email'           => $data['email'],
                'custom_fields'   => $data['custom_fields'],
                'user_agent'      => $data['user_agent'],
                'conversion_page' => $data['conversion_page'],
                'referrer'        => $data['referrer'],
                'date_added'      => current_time('mysql')
            ),
            array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );

        return ! $response ? $response : self::wpdb()->insert_id;
    }

    /**
     * Update existing conversion data to database.
     *
     * @param int $id
     * @param array $data {
     *     Array of conversion data
     *
     * @type string $optin_id
     * @type string $optin_type
     * @type string $name
     * @type string $email
     * @type string $user_agent
     * @type string $conversion_page
     * @type string $referrer
     * }
     *
     * @return false|int
     */
    public static function update($id, $data)
    {
        $update_data = array(
            'optin_id'        => $data['optin_campaign_id'],
            'optin_type'      => $data['optin_campaign_type'],
            'name'            => $data['name'],
            'email'           => $data['email'],
            'user_agent'      => $data['user_agent'],
            'conversion_page' => $data['conversion_page'],
            'referrer'        => $data['referrer'],
            'date_added'      => current_time('mysql')
        );

        $update_data = array_filter($update_data, function ($value) {
            return ! empty($value);
        });

        return parent::wpdb()->update(
            parent::conversions_table(),
            $update_data,
            array('id' => $id),
            '%s'
        );
    }

    /**
     * Get a conversion data
     *
     * @param int $conversion_id
     *
     * @return string
     */
    public static function get($conversion_id)
    {
        $table = parent::conversions_table();

        return self::wpdb()->get_row("SELECT * FROM $table WHERE id = '$conversion_id'", 'ARRAY_A');
    }

    /**
     * Get conversions data by IDs
     *
     * @param array $conversion_ids
     *
     * @return string
     */
    public static function get_conversions_by_ids($conversion_ids)
    {
        $table          = parent::conversions_table();
        $conversion_ids = implode(',', $conversion_ids);

        return self::wpdb()->get_results("SELECT * FROM $table WHERE id IN ($conversion_ids)", 'ARRAY_A');
    }

    /**
     * Retrieve conversion data from the database
     *
     * @param int $limit
     * @param int $offset
     *
     * @return mixed
     */
    public static function get_conversions($limit = null, $offset = 1, $search = null)
    {
        if (is_null($search) && ! empty($_POST['s'])) {
            $search = $_POST['s'];
        }

        $table = parent::conversions_table();
        $sql   = "SELECT * FROM {$table}";

        if ( ! empty($search)) {
            $search = esc_sql(sanitize_text_field($search));
            $sql    .= " WHERE name LIKE '%$search%'";
            $sql    .= " OR email LIKE '%$search%'";
        }

        $sql .= " ORDER BY id DESC";
        if ( ! is_null($limit)) {
            $sql .= " LIMIT $limit";
        }
        if ( ! is_null($limit)) {
            $offset = ($offset - 1) * $limit;
            if ($offset > 1) {
                $sql .= "  OFFSET $offset";
            }
        }

        $result = parent::wpdb()->get_results($sql, 'ARRAY_A');

        return $result;
    }

    /**
     * Delete a conversion record.
     *
     * @param int $id conversion ID
     *
     * @return false|int
     */
    public static function delete($id)
    {
        return parent::wpdb()->delete(
            parent::conversions_table(),
            array('id' => $id),
            array('%d')
        );
    }

    /**
     * Return count of optin conversion made today.
     *
     * @return null|string
     */
    public static function today_conversion_count()
    {
        $table = parent::conversions_table();

        return parent::wpdb()->get_var("SELECT COUNT(*) FROM $table WHERE DATE(date_added) = CURDATE()");
    }

    /**
     * Return count of optin conversion this month.
     *
     * @return int
     */
    public static function month_conversion_count()
    {
        $table = parent::conversions_table();

        return absint(parent::wpdb()->get_var("SELECT COUNT(*) FROM $table WHERE MONTH(date_added) = MONTH(CURRENT_DATE())"));
    }
}