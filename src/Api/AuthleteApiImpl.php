<?php
//
// Copyright (C) 2018-2022 Authlete, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
// either express or implied. See the License for the specific
// language governing permissions and limitations under the
// License.
//


/**
 * File containing the definition of AuthleteApiImpl class.
 */


namespace Authlete\Api;


use Authlete\Conf\AuthleteConfiguration;
use Authlete\Dto\ApiResponse;
use Authlete\Dto\AuthorizationFailRequest;
use Authlete\Dto\AuthorizationFailResponse;
use Authlete\Dto\AuthorizationIssueRequest;
use Authlete\Dto\AuthorizationIssueResponse;
use Authlete\Dto\AuthorizationRequest;
use Authlete\Dto\AuthorizationResponse;
use Authlete\Dto\AuthorizedClientListResponse;
use Authlete\Dto\BackchannelAuthenticationCompleteRequest;
use Authlete\Dto\BackchannelAuthenticationCompleteResponse;
use Authlete\Dto\BackchannelAuthenticationFailRequest;
use Authlete\Dto\BackchannelAuthenticationFailResponse;
use Authlete\Dto\BackchannelAuthenticationIssueRequest;
use Authlete\Dto\BackchannelAuthenticationIssueResponse;
use Authlete\Dto\BackchannelAuthenticationRequest;
use Authlete\Dto\BackchannelAuthenticationResponse;
use Authlete\Dto\Client;
use Authlete\Dto\ClientAuthorizationDeleteRequest;
use Authlete\Dto\ClientAuthorizationGetListRequest;
use Authlete\Dto\ClientAuthorizationUpdateRequest;
use Authlete\Dto\ClientListResponse;
use Authlete\Dto\ClientSecretRefreshResponse;
use Authlete\Dto\ClientSecretUpdateRequest;
use Authlete\Dto\ClientSecretUpdateResponse;
use Authlete\Dto\DeviceAuthorizationRequest;
use Authlete\Dto\DeviceAuthorizationResponse;
use Authlete\Dto\DeviceCompleteRequest;
use Authlete\Dto\DeviceCompleteResponse;
use Authlete\Dto\DeviceVerificationRequest;
use Authlete\Dto\DeviceVerificationResponse;
use Authlete\Dto\GrantedScopesDeleteRequest;
use Authlete\Dto\GrantedScopesGetRequest;
use Authlete\Dto\GrantedScopesGetResponse;
use Authlete\Dto\IntrospectionRequest;
use Authlete\Dto\IntrospectionResponse;
use Authlete\Dto\PushedAuthReqRequest;
use Authlete\Dto\PushedAuthReqResponse;
use Authlete\Dto\RevocationRequest;
use Authlete\Dto\RevocationResponse;
use Authlete\Dto\Service;
use Authlete\Dto\ServiceListResponse;
use Authlete\Dto\StandardIntrospectionRequest;
use Authlete\Dto\StandardIntrospectionResponse;
use Authlete\Dto\TokenCreateRequest;
use Authlete\Dto\TokenCreateResponse;
use Authlete\Dto\TokenFailRequest;
use Authlete\Dto\TokenFailResponse;
use Authlete\Dto\TokenIssueRequest;
use Authlete\Dto\TokenIssueResponse;
use Authlete\Dto\TokenRequest;
use Authlete\Dto\TokenResponse;
use Authlete\Dto\TokenUpdateRequest;
use Authlete\Dto\TokenUpdateResponse;
use Authlete\Dto\UserInfoIssueRequest;
use Authlete\Dto\UserInfoIssueResponse;
use Authlete\Dto\UserInfoRequest;
use Authlete\Dto\UserInfoResponse;
use Authlete\Types\Jsonable;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;
use Authlete\Web\BasicCredentials;
use Authlete\Web\HttpHeaders;
use Authlete\Web\HttpMethod;


/**
 * An implementation of the \Authlete\Api\AuthleteApi interface.
 */
class AuthleteApiImpl implements AuthleteApi
{
    // The string used as the value of 'User-Agent'. This string should
    // be updated on every release of a new version of this library.
    private static $USER_AGENT = 'authlete-php/1.12.0';

    private static $AUTH_AUTHORIZATION_API_PATH            = '/api/auth/authorization';
    private static $AUTH_AUTHORIZATION_FAIL_API_PATH       = '/api/auth/authorization/fail';
    private static $AUTH_AUTHORIZATION_ISSUE_API_PATH      = '/api/auth/authorization/issue';
    private static $AUTH_TOKEN_API_PATH                    = '/api/auth/token';
    private static $AUTH_TOKEN_CREATE_API_PATH             = '/api/auth/token/create';
    private static $AUTH_TOKEN_DELETE_API_PATH             = '/api/auth/token/delete/';            // + {token}
    private static $AUTH_TOKEN_FAIL_API_PATH               = '/api/auth/token/fail';
    private static $AUTH_TOKEN_ISSUE_API_PATH              = '/api/auth/token/issue';
    private static $AUTH_TOKEN_UPDATE_API_PATH             = '/api/auth/token/update';
    private static $AUTH_REVOCATION_API_PATH               = '/api/auth/revocation';
    private static $AUTH_USERINFO_API_PATH                 = '/api/auth/userinfo';
    private static $AUTH_USERINFO_ISSUE_API_PATH           = '/api/auth/userinfo/issue';
    private static $AUTH_INTROSPECTION_API_PATH            = '/api/auth/introspection';
    private static $AUTH_INTROSPECTION_STANDARD_API_PATH   = '/api/auth/introspection/standard';
    private static $SERVICE_CONFIGURATION_API_PATH         = '/api/service/configuration';
    private static $SERVICE_CREATE_API_PATH                = '/api/service/create';
    private static $SERVICE_DELETE_API_PATH                = '/api/service/delete/';               // + {apiKey}
    private static $SERVICE_GET_API_PATH                   = '/api/service/get/';                  // + {apiKey}
    private static $SERVICE_GET_LIST_API_PATH              = '/api/service/get/list';
    private static $SERVICE_JWKS_GET_API_PATH              = '/api/service/jwks/get';
    private static $SERVICE_UPDATE_API_PATH                = '/api/service/update/';               // + {apiKey}
    private static $CLIENT_CREATE_API_PATH                 = '/api/client/create';
    private static $CLIENT_DELETE_API_PATH                 = '/api/client/delete/';                // + {clientId}
    private static $CLIENT_GET_API_PATH                    = '/api/client/get/';                   // + {clientId}
    private static $CLIENT_GET_LIST_API_PATH               = '/api/client/get/list';
    private static $CLIENT_SECRET_REFRESH_API_PATH         = '/api/client/secret/refresh/';        // + {clientId}
    private static $CLIENT_SECRET_UPDATE_API_PATH          = '/api/client/secret/update/';         // + {clientId}
    private static $CLIENT_UPDATE_API_PATH                 = '/api/client/update/';                // + {clientId}
    private static $GRANTED_SCOPES_GET_API_PATH            = '/api/client/granted_scopes/get/';    // + {clientId}
    private static $GRANTED_SCOPES_DELETE_API_PATH         = '/api/client/granted_scopes/delete/'; // + {clientId}
    private static $CLIENT_AUTHORIZATION_DELETE_API_PATH   = '/api/client/authorization/delete/';  // + {clientId}
    private static $CLIENT_AUTHORIZATION_GET_LIST_API_PATH = '/api/client/authorization/get/list';
    private static $CLIENT_AUTHORIZATION_UPDATE_API_PATH   = '/api/client/authorization/update/';  // + {clientId}
    private static $BC_AUTHENTICATION_API_PATH             = '/api/backchannel/authentication';
    private static $BC_AUTHENTICATION_COMPLETE_API_PATH    = '/api/backchannel/authentication/complete';
    private static $BC_AUTHENTICATION_FAIL_API_PATH        = '/api/backchannel/authentication/fail';
    private static $BC_AUTHENTICATION_ISSUE_API_PATH       = '/api/backchannel/authentication/issue';
    private static $DEVICE_AUTHORIZATION_API_PATH          = '/api/device/authorization';
    private static $DEVICE_COMPLETE_API_PATH               = '/api/device/complete';
    private static $DEVICE_VERIFICATION_API_PATH           = '/api/device/verification';
    private static $PUSHED_AUTH_REQ_API_PATH               = '/api/pushed_auth_req';


    private $serviceOwnerCredentials = null;  // \Authlete\Web\BasicCredentials
    private $serviceCredentials      = null;  // \Authlete\Web\BasicCredentials
    private $baseUrl                 = null;  // string
    private $settings                = null;  // \Authlete\Api\SettingsImpl


    /**
     * Constructor.
     *
     * @param AuthleteConfiguration $configuration
     *     An object that implements the `AuthleteConfiguration` interface.
     */
    public function __construct(AuthleteConfiguration $configuration)
    {
        $this->serviceOwnerCredentials = self::createServiceOwnerCredentials($configuration);
        $this->serviceCredentials      = self::createServiceCredentials($configuration);
        $this->baseUrl                 = self::createBaseUrl($configuration);
        $this->settings                = new SettingsImpl();
    }


    private static function createServiceOwnerCredentials(AuthleteConfiguration $configuration)
    {
        // API key and API secret of a service owner.
        $apiKey    = $configuration->getServiceOwnerApiKey();
        $apiSecret = $configuration->getServiceOwnerApiSecret();

        return new BasicCredentials($apiKey, $apiSecret);
    }


    private static function createServiceCredentials(AuthleteConfiguration $configuration)
    {
        // API key and API secret of a service.
        $apiKey    = $configuration->getServiceApiKey();
        $apiSecret = $configuration->getServiceApiSecret();

        return new BasicCredentials($apiKey, $apiSecret);
    }


    private static function createBaseUrl(AuthleteConfiguration $configuration)
    {
        $url = $configuration->getBaseUrl();

        if (is_null($url))
        {
            throw new \InvalidArgumentException(
                'The configuration does not have information about the base URL.');
        }

        return $url;
    }


    private function callApi(
        $responseConverter, HttpMethod $method, BasicCredentials $credentials,
        $path, array $queryParams = null, $requestBody)
    {
        // Build an HTTP request to call the Authlete API.
        $curl = $this->buildRequest($method, $credentials, $path, $queryParams, $requestBody);

        // Send the request.
        $body = $this->sendRequest($curl, $path);

        // If a response converter is not given.
        if (is_null($responseConverter))
        {
            // Return the response body without conversion.
            return $body;
        }

        // Convert the response body.
        return $responseConverter($body);
    }


    private function buildRequest(
        HttpMethod $method, BasicCredentials $credentials, $path,
        array $queryParams = null, $requestBody)
    {
        $curl = curl_init();

        // Set the HTTP method.
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, LanguageUtility::toString($method));

        // Set the URL of the Authlete API with query parameters.
        curl_setopt($curl, CURLOPT_URL, $this->buildRequestUrl($path, $queryParams));

        // Set 'Authorization' header to access the Authete API.
        curl_setopt_array($curl, [
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD  => $credentials->getCredentials()
        ]);

        // Set 'Content-Type' header.
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json;charset=UTF-8'));

        // Set 'User-Agent' header.
        curl_setopt($curl, CURLOPT_USERAGENT, self::$USER_AGENT);

        if (!is_null($requestBody))
        {
            // Set the request body.
            curl_setopt($curl, CURLOPT_POSTFIELDS, self::formatRequestBody($requestBody));
        }

        // Make curl_exec() return a string.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Make curl_exec() return response headers in addition to a response body.
        curl_setopt($curl, CURLOPT_HEADER, true);

        // Settings.
        $settings = $this->settings;

        // Set a connection timeout in seconds.
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $settings->getConnectionTimeout());

        // Proxy host.
        if (!is_null($settings->getProxyHost()))
        {
            curl_setopt($curl, CURLOPT_PROXY, $settings->getProxyHost());
        }

        // Proxy port.
        if ($settings->getProxyPort() !== 0)
        {
            curl_setopt($curl, CURLOPT_PROXYPORT, $settings->getProxyPort());
        }

        // HTTP proxy tunnel.
        if ($settings->isHttpProxyTunnelUsed())
        {
            curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, true);
        }

        return $curl;
    }


    private function buildRequestUrl($path, array $queryParams = null)
    {
        $url = $this->baseUrl . $path;

        if (is_null($queryParams))
        {
            return $url;
        }

        $params = array();

        // For each query parameter.
        foreach ($queryParams as $key => $value)
        {
            // The key of the query parameter.
            $key = self::toQueryParamKey($key);

            if (is_null($key))
            {
                // Ignore the invalid key.
                continue;
            }

            // The value of the query parameter.
            $value = self::toQueryParamValue($value);

            // Build "key=value" and add it to the list.
            $params[] = "${key}=${value}";
        }

        if (count($params) === 0)
        {
            return $url;
        }

        // Append '?key0=value0&key1=value1&...' to the url.
        return $url . '?' . implode('&', $params);
    }


    private static function toQueryParamKey($key)
    {
        if (is_null($key))
        {
            return null;
        }

        if (!is_string($key))
        {
            $key = strval($key);
        }

        if (strlen($key) === 0)
        {
            return null;
        }

        return urlencode($key);
    }


    private static function toQueryParamValue($value)
    {
        if (is_null($value))
        {
            return '';
        }

        if (is_bool($value))
        {
            return ($value ? "true" : "false");
        }

        if (!is_string($value))
        {
            $value = strval($value);
        }

        return urlencode($value);
    }


    private static function formatRequestBody($requestBody)
    {
        if ($requestBody instanceof Jsonable)
        {
            return $requestBody->toJson();
        }

        return json_encode($requestBody);
    }


    private static function sendRequest($curl, $path)
    {
        // Send the request to the Authlete API and receive a response.
        $response = curl_exec($curl);

        // Error info that might have been set by the curl_exec() call.
        $errno = curl_errno($curl);
        $error = curl_error($curl);

        // HTTP status code in the response from the Authlete API.
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // The size of the response headers.
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

        // Finish using the handler.
        curl_close($curl);

        // If curl_exec() failed.
        if ($errno !== CURLE_OK)
        {
            throw new AuthleteApiException(
                "curl_exec() failed: path={$path}, errno={$errno}, error={$error}");
        }

        // Split the response into the headers and the body.
        $headers = substr($response, 0, $headerSize);
        $body    = substr($response, $headerSize);

        // If the HTTP status code indicates that the API call has succeeded.
        if (200 <= $statusCode && $statusCode < 300)
        {
            // Return the content of the response.
            return $body;
        }

        // Extract 'resultMessage' from the response.
        $resultMessage = LanguageUtility::orEmpty(self::extractResultMessage($body));

        throw new AuthleteApiException(
            "Unexpected response: path=${path}, statusCode=${statusCode}, resultMessage=${resultMessage}",
            $statusCode, HttpHeaders::parse($headers), $body);
    }


    private static function extractResultMessage($body)
    {
        if (!is_string($body) || strlen($body) === 0)
        {
            return null;
        }

        // Try to parse the response body as JSON.
        $array = json_decode($body, true);

        // If the response failed to be parsed as JSON.
        if (json_last_error() !== JSON_ERROR_NONE)
        {
            return null;
        }

        return LanguageUtility::getFromArray('resultMessage', $array);
    }


    private function callGetApi(
        $converter, BasicCredentials $credentials, $path, array $queryParams = null)
    {
        return $this->callApi(
            $converter, HttpMethod::GET, $credentials, $path, $queryParams, null);
    }


    private function callServiceOwnerGetApi($converter, $path, array $queryParams = null)
    {
        return $this->callGetApi(
            $converter, $this->serviceOwnerCredentials, $path, $queryParams);
    }


    private function callServiceGetApi($converter, $path, array $queryParams = null)
    {
        return $this->callGetApi(
            $converter, $this->serviceCredentials, $path, $queryParams);
    }


    private function callPostApi(
        $converter, BasicCredentials $credentials, $path, array $queryParams = null, $requestBody)
    {
        return $this->callApi(
            $converter, HttpMethod::POST, $credentials, $path, $queryParams, $requestBody);
    }


    private function callServiceOwnerPostApi(
        $converter, $path, array $queryParams = null, $requestBody)
    {
        return $this->callPostApi(
            $converter, $this->serviceOwnerCredentials, $path, $queryParams, $requestBody);
    }


    private function callServicePostApi(
        $converter, $path, array $queryParams = null, $requestBody)
    {
        return $this->callPostApi(
            $converter, $this->serviceCredentials, $path, $queryParams, $requestBody);
    }


    private function callDeleteApi(BasicCredentials $credentials, $path, array $queryParams = null)
    {
        $this->callApi(null, HttpMethod::DELETE, $credentials, $path, $queryParams, null);
    }


    private function callServiceOwnerDeleteApi($path, array $queryParams = null)
    {
        $this->callDeleteApi($this->serviceOwnerCredentials, $path, $queryParams);
    }


    private function callServiceDeleteApi($path, array $queryParams = null)
    {
        $this->callDeleteApi($this->serviceCredentials, $path, $queryParams);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param AuthorizationRequest $request
     *     {@inheritdoc}
     */
    public function authorization(AuthorizationRequest $request): AuthorizationResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\AuthorizationResponse::fromJson',
            self::$AUTH_AUTHORIZATION_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param AuthorizationFailRequest $request
     *     {@inheritdoc}
     */
    public function authorizationFail(AuthorizationFailRequest $request): AuthorizationFailResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\AuthorizationFailResponse::fromJson',
            self::$AUTH_AUTHORIZATION_FAIL_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param AuthorizationIssueRequest $request
     *     {@inheritdoc}
     */
    public function authorizationIssue(AuthorizationIssueRequest $request): AuthorizationIssueResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\AuthorizationIssueResponse::fromJson',
            self::$AUTH_AUTHORIZATION_ISSUE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param TokenRequest $request
     *     {@inheritdoc}
     */
    public function token(TokenRequest $request): TokenResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\TokenResponse::fromJson',
            self::$AUTH_TOKEN_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param TokenCreateRequest $request
     *     {@inheritdoc}
     */
    public function tokenCreate(TokenCreateRequest $request): TokenCreateResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\TokenCreateResponse::fromJson',
            self::$AUTH_TOKEN_CREATE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param string $token
     *     {@inheritdoc}
     */
    public function tokenDelete($token): void
    {
        ValidationUtility::ensureString('$token', $token);

        $this->callServiceDeleteApi(
            self::$AUTH_TOKEN_DELETE_API_PATH . $token);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param TokenFailRequest $request
     *     {@inheritdoc}
     */
    public function tokenFail(TokenFailRequest $request): TokenFailResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\TokenFailResponse::fromJson',
            self::$AUTH_TOKEN_FAIL_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param TokenIssueRequest $request
     *     {@inheritdoc}
     */
    public function tokenIssue(TokenIssueRequest $request): \Authlete\Dto\TokenIssueResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\TokenIssueResponse::fromJson',
            self::$AUTH_TOKEN_ISSUE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param TokenUpdateRequest $request
     *     {@inheritdoc}
     */
    public function tokenUpdate(TokenUpdateRequest $request): TokenUpdateResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\TokenUpdateResponse::fromJson',
            self::$AUTH_TOKEN_UPDATE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param RevocationRequest $request
     *     {@inheritdoc}
     */
    public function revocation(RevocationRequest $request): RevocationResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\RevocationResponse::fromJson',
            self::$AUTH_REVOCATION_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param UserInfoRequest $request
     *     {@inheritdoc}
     */
    public function userInfo(UserInfoRequest $request): UserInfoResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\UserInfoResponse::fromJson',
            self::$AUTH_USERINFO_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param UserInfoIssueRequest $request
     *     {@inheritdoc}
     */
    public function userInfoIssue(UserInfoIssueRequest $request): UserInfoIssueResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\UserInfoIssueResponse::fromJson',
            self::$AUTH_USERINFO_ISSUE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param IntrospectionRequest $request
     *     {@inheritdoc}
     */
    public function introspection(IntrospectionRequest $request): IntrospectionResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\IntrospectionResponse::fromJson',
            self::$AUTH_INTROSPECTION_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param StandardIntrospectionRequest $request
     *     {@inheritdoc}
     */
    public function standardIntrospection(StandardIntrospectionRequest $request): StandardIntrospectionResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\StandardIntrospectionResponse::fromJson',
            self::$AUTH_INTROSPECTION_STANDARD_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param Service $service
     *     {@inheritdoc}
     */
    public function createService(Service $service): Service
    {
        return $this->callServiceOwnerPostApi(
            '\Authlete\Dto\Service::fromJson',
            self::$SERVICE_CREATE_API_PATH,
            null, $service);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $apiKey
     *     {@inheritdoc}
     */
    public function deleteService($apiKey)
    {
        ValidationUtility::ensureStringOrInteger('$apiKey', $apiKey);

        $this->callServiceOwnerDeleteApi(
            self::$SERVICE_DELETE_API_PATH . $apiKey);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $apiKey
     *     {@inheritdoc}
     */
    public function getService($apiKey): Service
    {
        ValidationUtility::ensureStringOrInteger('$apiKey', $apiKey);

        return $this->callServiceOwnerGetApi(
            '\Authlete\Dto\Service::fromJson',
            self::$SERVICE_GET_API_PATH . $apiKey);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer $start
     *     {@inheritdoc}
     *
     * @param integer $end
     *     {@inheritdoc}
     */
    public function getServiceList($start = 0, $end = 5): ServiceListResponse
    {
        ValidationUtility::ensureInteger('$start', $start);
        ValidationUtility::ensureNotNegative('$start', $start);

        ValidationUtility::ensureInteger('$end', $end);
        ValidationUtility::ensureNotNegative('$end', $end);

        $queryParams = array(
            'start' => $start,
            'end'   => $end
        );

        return $this->callServiceOwnerGetApi(
            '\Authlete\Dto\ServiceListResponse::fromJson',
            self::$SERVICE_GET_LIST_API_PATH,
            $queryParams);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param Service $service
     *     {@inheritdoc}
     */
    public function updateService(Service $service): Service
    {
        ValidationUtility::ensureNotNull('$service->getApiKey()', $service->getApiKey());

        return $this->callServiceOwnerPostApi(
            '\Authlete\Dto\Service::fromJson',
            self::$SERVICE_UPDATE_API_PATH . $service->getApiKey(),
            null, $service);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param boolean $pretty
     *     {@inheritdoc}
     *
     * @param boolean $includePrivateKeys
     *     {@inheritdoc}
     */
    public function getServiceJwks(bool $pretty = false, bool $includePrivateKeys = false): string
    {
        ValidationUtility::ensureBoolean('$pretty', $pretty);
        ValidationUtility::ensureBoolean('$includePrivateKeys', $includePrivateKeys);

        $queryParams = array(
            'pretty'             => $pretty,
            'includePrivateKeys' => $includePrivateKeys
        );

        return $this->callServiceGetApi(
            null, self::$SERVICE_JWKS_GET_API_PATH, $queryParams);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param boolean $pretty
     *     {@inheritdoc}
     */
    public function getServiceConfiguration(bool $pretty = true): string
    {
        ValidationUtility::ensureBoolean('$pretty', $pretty);

        $queryParams = array('pretty' => $pretty);

        return $this->callServiceGetApi(
            null, self::$SERVICE_CONFIGURATION_API_PATH, $queryParams);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param Client $client
     *     {@inheritdoc}
     */
    public function createClient(Client $client): Client
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\Client::fromJson',
            self::$CLIENT_CREATE_API_PATH,
            null, $client);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     */
    public function deleteClient(int|string $clientId)
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);

        $this->callServiceDeleteApi(
            self::$CLIENT_DELETE_API_PATH . $clientId);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     */
    public function getClient(int|string $clientId): Client
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);

        return $this->callServiceGetApi(
            '\Authlete\Dto\Client::fromJson',
            self::$CLIENT_GET_API_PATH . $clientId);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param string|null $developer
     *     {@inheritdoc}
     *
     * @param integer $start
     *     {@inheritdoc}
     *
     * @param integer $end
     *     {@inheritdoc}
     */
    public function getClientList(string $developer = null, int $start = 0, int $end = 5)
    {
        ValidationUtility::ensureNullOrString('$developer', $developer);

        ValidationUtility::ensureInteger('$start', $start);
        ValidationUtility::ensureNotNegative('$start', $start);

        ValidationUtility::ensureInteger('$end', $end);
        ValidationUtility::ensureNotNegative('$end', $end);

        $queryParams = array(
            'developer' => $developer,
            'start'     => $start,
            'end'       => $end
        );

        return $this->callServiceGetApi(
            '\Authlete\Dto\ClientListResponse::fromJson',
            self::$CLIENT_GET_LIST_API_PATH,
            $queryParams);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param Client $client
     *     {@inheritdoc}
     */
    public function updateClient(Client $client): Client
    {
        ValidationUtility::ensureNotNull('$client->getClientId()', $client->getClientId());

        return $this->callServicePostApi(
            '\Authlete\Dto\Client::fromJson',
            self::$CLIENT_UPDATE_API_PATH . $client->getClientId(),
            null, $client);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     *
     * @param string $subject
     *     {@inheritdoc}
     */
    public function getGrantedScopes(int|string $clientId, string $subject): GrantedScopesGetResponse
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);
        ValidationUtility::ensureString('$subject', $subject);

        $request = new GrantedScopesGetRequest();
        $request->setSubject($subject);

        return $this->callServicePostApi(
            '\Authlete\Dto\GrantedScopesGetResponse::fromJson',
            self::$GRANTED_SCOPES_GET_API_PATH . $clientId,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     *
     * @param string $subject
     *     {@inheritdoc}
     */
    public function deleteGrantedScopes(int|string $clientId, string $subject)
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);
        ValidationUtility::ensureString('$subject', $subject);

        $request = new GrantedScopesDeleteRequest();
        $request->setSubject($subject);

        return $this->callServicePostApi(
            '\Authlete\Dto\ApiResponse::fromJson',
            self::$GRANTED_SCOPES_DELETE_API_PATH . $clientId,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     *
     * @param string $subject
     *     {@inheritdoc}
     */
    public function deleteClientAuthorization(int|string $clientId, string $subject)
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);
        ValidationUtility::ensureString('$subject', $subject);

        $request = new ClientAuthorizationDeleteRequest();
        $request->setSubject($subject);

        return $this->callServicePostApi(
            '\Authlete\Dto\ApiResponse::fromJson',
            self::$CLIENT_AUTHORIZATION_DELETE_API_PATH . $clientId,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param ClientAuthorizationGetListRequest $request
     *     {@inheritdoc}
     */
    public function getClientAuthorizationList(ClientAuthorizationGetListRequest $request): AuthorizedClientListResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\AuthorizedClientListResponse::fromJson',
            self::$CLIENT_AUTHORIZATION_GET_LIST_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     *
     * @param ClientAuthorizationUpdateRequest $request
     */
    public function updateClientAuthorization(int|string $clientId, ClientAuthorizationUpdateRequest $request): ApiResponse
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);

        return $this->callServicePostApi(
            '\Authlete\Dto\ApiResponse::fromJson',
            self::$CLIENT_AUTHORIZATION_UPDATE_API_PATH . $clientId,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     */
    public function refreshClientSecret(int|string $clientId): ClientSecretRefreshResponse
    {
        return $this->callServiceGetApi(
            '\Authlete\Dto\ClientSecretRefreshResponse::fromJson',
            self::$CLIENT_SECRET_REFRESH_API_PATH . $clientId);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer|string $clientId
     *     {@inheritdoc}
     *
     * @param string $clientSecret
     *     {@inheritdoc}
     */
    public function updateClientSecret(int|string $clientId, string $clientSecret): ClientSecretUpdateResponse
    {
        ValidationUtility::ensureStringOrInteger('$clientId', $clientId);
        ValidationUtility::ensureString('$clientSecret', $clientSecret);

        $request = new ClientSecretUpdateRequest();
        $request->setClientSecret($clientSecret);

        return $this->callServicePostApi(
            '\Authlete\Dto\ClientSecretUpdateResponse::fromJson',
            self::$CLIENT_SECRET_UPDATE_API_PATH . $clientId,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param BackchannelAuthenticationRequest $request
     *     {@inheritdoc}
     */
    public function backchannelAuthentication(BackchannelAuthenticationRequest $request): BackchannelAuthenticationResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\BackchannelAuthenticationResponse::fromJson',
            self::$BC_AUTHENTICATION_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param BackchannelAuthenticationIssueRequest $request
     *     {@inheritdoc}
     */
    public function backchannelAuthenticationIssue(BackchannelAuthenticationIssueRequest $request): BackchannelAuthenticationIssueResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\BackchannelAuthenticationIssueResponse::fromJson',
            self::$BC_AUTHENTICATION_ISSUE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param BackchannelAuthenticationFailRequest $request
     *     {@inheritdoc}
     */
    public function backchannelAuthenticationFail(BackchannelAuthenticationFailRequest $request): BackchannelAuthenticationFailResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\BackchannelAuthenticationFailResponse::fromJson',
            self::$BC_AUTHENTICATION_FAIL_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param BackchannelAuthenticationCompleteRequest $request
     *     {@inheritdoc}
     */
    public function backchannelAuthenticationComplete(BackchannelAuthenticationCompleteRequest $request): BackchannelAuthenticationCompleteResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\BackchannelAuthenticationCompleteResponse::fromJson',
            self::$BC_AUTHENTICATION_COMPLETE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param DeviceAuthorizationRequest $request
     *     {@inheritdoc}
     */
    public function deviceAuthorization(DeviceAuthorizationRequest $request): DeviceAuthorizationResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\DeviceAuthorizationResponse::fromJson',
            self::$DEVICE_AUTHORIZATION_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param DeviceCompleteRequest $request
     *     {@inheritdoc}
     */
    public function deviceComplete(DeviceCompleteRequest $request): DeviceCompleteResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\DeviceCompleteResponse::fromJson',
            self::$DEVICE_COMPLETE_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param DeviceVerificationRequest $request
     *     {@inheritdoc}
     */
    public function deviceVerification(DeviceVerificationRequest $request): DeviceVerificationResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\DeviceVerificationResponse::fromJson',
            self::$DEVICE_VERIFICATION_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param PushedAuthReqRequest $request
     *     {@inheritdoc}
     */
    public function pushAuthorizationRequest(PushedAuthReqRequest $request): PushedAuthReqResponse
    {
        return $this->callServicePostApi(
            '\Authlete\Dto\PushedAuthReqResponse::fromJson',
            self::$PUSHED_AUTH_REQ_API_PATH,
            null, $request);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     */
    public function getSettings(): Settings
    {
        return $this->settings;
    }
}
