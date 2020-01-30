<?php

namespace Authifly\Provider;

use Authifly\Adapter\OAuth2;
use Authifly\Exception\InvalidArgumentException;

use Authifly\Exception\UnexpectedApiResponseException;
use Authifly\Data;

/**
 * Facebook OAuth2 provider adapter.
 *
 * Example:
 *
 *   $config = [
 *       'callback' => Authifly\HttpClient\Util::getCurrentUrl(),
 *       'keys'     => [ 'id' => '', 'secret' => '' ],
 *       'scope'    => 'email, user_status, user_posts'
 *   ];
 *
 *   $adapter = new Authifly\Provider\Facebook( $config );
 *
 *   try {
 *       $adapter->authenticate();
 *
 *       $userProfile = $adapter->getUserProfile();
 *       $tokens = $adapter->getAccessToken();
 *       $response = $adapter->setUserStatus("Authifly test message..");
 *   }
 *   catch( Exception $e ){
 *       echo $e->getMessage() ;
 *   }
 */
class Facebook extends OAuth2
{
    /**
     * {@inheritdoc}
     */
    protected $scope = 'email, public_profile, user_friends, publish_actions';
    /**
     * {@inheritdoc}
     */
    protected $apiBaseUrl = 'https://graph.facebook.com/v3.0/';
    /**
     * {@inheritdoc}
     */
    protected $authorizeUrl = 'https://www.facebook.com/dialog/oauth';
    /**
     * {@inheritdoc}
     */
    protected $accessTokenUrl = 'https://graph.facebook.com/oauth/access_token';
    /**
     * {@inheritdoc}
     */
    protected $apiDocumentation = 'https://developers.facebook.com/docs/facebook-login/overview';

    /**
     * {@inheritdoc}
     */
    protected function initialize()
    {
        parent::initialize();
        // Require proof on all Facebook api calls
        // https://developers.facebook.com/docs/graph-api/securing-requests#appsecret_proof
        if ($accessToken = $this->getStoredData('access_token')) {
            $this->apiRequestParameters['appsecret_proof'] = hash_hmac('sha256', $accessToken, $this->clientSecret);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUserProfileId()
    {
        $response = $this->apiRequest('me?fields=id');
        $data = new Data\Collection($response);
        if (!$data->exists('id')) {
            throw new UnexpectedApiResponseException('Provider API returned an unexpected response.');
        }

        return $data->get('id');
    }

    /**
     * @see https://developers.facebook.com/docs/marketing-api/audiences-api
     *
     * @param $accountId
     * @param $name
     * @param $description
     * @return bool
     * @throws InvalidArgumentException
     */
    public function createCustomAudience($accountId, $name, $description)
    {
        if (!isset($accountId, $name, $description)) throw new InvalidArgumentException('accountId, name or description is missing.');

        $params = array(
            'name' => $name,
            'subtype' => 'CUSTOM',
            'description' => $description
        );

        $response = $this->apiRequest("act_{$accountId}/customaudiences", 'POST', $params);

        return isset($response->id) ? $response->id : false;
    }

    /**
     * @see https://developers.facebook.com/docs/marketing-api/audiences-api
     *
     * @param $custom_audience_id
     * @param $email
     * @param string $firstname
     * @param string $lastname
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function addUserToCustomAudience($custom_audience_id, $email, $firstname = '', $lastname = '')
    {
        if (!isset($custom_audience_id, $email)) throw new InvalidArgumentException('custom_audience_id and email is required');

        $schema = ["EMAIL"];
        $data = [strtolower(trim($email))];

        if (!empty($firstname)) {
            $schema[] = 'FN';
            $data[] = strtolower($firstname);
        }

        if (!empty($lastname)) {
            $schema[] = 'LN';
            $data[] = strtolower($lastname);
        }

        $payload = [
            'payload' => [
                'schema' => $schema,
                'data' => [$data]
            ]
        ];


        $response = $this->apiRequest(
            "{$custom_audience_id}/users",
            'POST',
            $payload,
            ['Content-Type' => 'multipart/form-data']
        );

        return $response;
    }

    /**
     * @see https://developers.facebook.com/docs/graph-api/reference/user/permissions
     * @param $user_id
     * @param null $permission
     * @param null $status
     * @return mixed
     * @throws InvalidArgumentException
     * @throws UnexpectedApiResponseException
     */
    public function fetchPermissions($user_id, $permission = null, $status = null)
    {
        if (!isset($user_id)) throw new InvalidArgumentException('user_id is required');

        $args = array_filter(['permission' => $permission, 'status' => $status], 'is_string');

        $response = $this->apiRequest("{$user_id}/permissions", 'GET', $args);


        // if permission and/or status is supplied, exception is triggered when permission is not found.
        if (!isset($response->data)) throw new UnexpectedApiResponseException('data property in response missing.');

        return $response->data;
    }

    /**
     * @param $user_id
     * @return mixed
     * @throws InvalidArgumentException
     * @throws UnexpectedApiResponseException
     */
    public function getAdAccountIds($user_id)
    {
        if (!isset($user_id)) throw new InvalidArgumentException('user_id is required');

        $response = $this->apiRequest("{$user_id}/adaccounts?fields=id,account_id,business_name");

        if (!isset($response->data)) throw new UnexpectedApiResponseException('data property in response missing.');

        return $response->data;
    }

    /**
     * @param $account_id
     * @return mixed
     * @throws UnexpectedApiResponseException
     */
    public function getPixelId($account_id)
    {
        $response = $this->apiRequest("act_{$account_id}/adspixels?fields=name");

        if (!isset($response->data)) throw new UnexpectedApiResponseException('data property in response missing.');

        /**
         * object(stdClass)[11]
         * public 'name' => string 'W3Dev LLC' (length=9)
         * public 'id' => string '**71798697****' (length=15)
         */
        return $response->data[0];
    }
}