<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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
 * File containing the definition of AuthleteApi interface.
 */


namespace Authlete\Api;


use Authlete\Dto\AuthorizationFailRequest;
use Authlete\Dto\AuthorizationIssueRequest;
use Authlete\Dto\AuthorizationRequest;
use Authlete\Dto\BackchannelAuthenticationCompleteRequest;
use Authlete\Dto\BackchannelAuthenticationFailRequest;
use Authlete\Dto\BackchannelAuthenticationIssueRequest;
use Authlete\Dto\BackchannelAuthenticationRequest;
use Authlete\Dto\Client;
use Authlete\Dto\ClientAuthorizationDeleteRequest;
use Authlete\Dto\ClientAuthorizationGetListRequest;
use Authlete\Dto\ClientAuthorizationUpdateRequest;
use Authlete\Dto\DeviceAuthorizationRequest;
use Authlete\Dto\DeviceCompleteRequest;
use Authlete\Dto\DeviceVerificationRequest;
use Authlete\Dto\IntrospectionRequest;
use Authlete\Dto\PushedAuthReqRequest;
use Authlete\Dto\RevocationRequest;
use Authlete\Dto\Service;
use Authlete\Dto\StandardIntrospectionRequest;
use Authlete\Dto\TokenCreateRequest;
use Authlete\Dto\TokenFailRequest;
use Authlete\Dto\TokenIssueRequest;
use Authlete\Dto\TokenRequest;
use Authlete\Dto\TokenUpdateRequest;
use Authlete\Dto\UserInfoIssueRequest;
use Authlete\Dto\UserInfoRequest;


/**
 * Authlete API.
 *
 * @link https://docs.authlete.com/
 */
interface AuthleteApi
{
    /**
     * Call Authlete's /api/auth/authorization API.
     *
     * @param AuthorizationRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\AuthorizationResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function authorization(AuthorizationRequest $request): \Authlete\Dto\AuthorizationResponse;


    /**
     * Call Authlete's /api/auth/authorization/fail API.
     *
     * @param AuthorizationFailRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\AuthorizationFailResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function authorizationFail(AuthorizationFailRequest $request): \Authlete\Dto\AuthorizationFailResponse;


    /**
     * Call Authlete's /api/auth/authorization/issue API.
     *
     * @param AuthorizationIssueRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\AuthorizationIssueResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function authorizationIssue(AuthorizationIssueRequest $request): \Authlete\Dto\AuthorizationIssueResponse;


    /**
     * Call Authlete's /api/auth/token API.
     *
     * @param TokenRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\TokenResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function token(TokenRequest $request): \Authlete\Dto\TokenResponse;


    /**
     * Call Authlete's /api/auth/token/create API.
     *
     * @param TokenCreateRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\TokenCreateResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function tokenCreate(TokenCreateRequest $request): \Authlete\Dto\TokenCreateResponse;


    /**
     * Delete an access token
     * (= call Authlete's /api/auth/token/delete/{token} API).
     *
     * @param string $token
     *     An access token or its hash value.
     *
     * @throws AuthleteApiException
     *
     * @since 1.9
     */
    public function tokenDelete($token);


    /**
     * Call Authlete's /api/auth/token/fail API.
     *
     * @param TokenFailRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\TokenFailResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function tokenFail(TokenFailRequest $request): \Authlete\Dto\TokenFailResponse;


    /**
     * Call Authlete's /api/auth/token/issue API.
     *
     * @param TokenIssueRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\TokenIssueResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function tokenIssue(TokenIssueRequest $request): \Authlete\Dto\TokenIssueResponse;


    /**
     * Call Authlete's /api/auth/token/update API.
     *
     * @param TokenUpdateRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\TokenUpdateResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function tokenUpdate(TokenUpdateRequest $request): \Authlete\Dto\TokenUpdateResponse;


    /**
     * Call Authlete's /api/auth/revocation API.
     *
     * @param RevocationRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\RevocationResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function revocation(RevocationRequest $request): \Authlete\Dto\RevocationResponse;


    /**
     * Call Authlete's /api/auth/userinfo API.
     *
     * @param UserInfoRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\UserInfoResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function userInfo(UserInfoRequest $request): \Authlete\Dto\UserInfoResponse;


    /**
     * Call Authlete's /api/auth/userinfo/issue API.
     *
     * @param UserInfoIssueRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\UserInfoIssueResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function userInfoIssue(UserInfoIssueRequest $request): \Authlete\Dto\UserInfoIssueResponse;


    /**
     * Call Authlete's /api/auth/introspection API.
     *
     * @param IntrospectionRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\IntrospectionResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function introspection(IntrospectionRequest $request): \Authlete\Dto\IntrospectionResponse;


    /**
     * Call Authlete's /api/auth/introspection/standard API.
     *
     * @param StandardIntrospectionRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\StandardIntrospectionResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     */
    public function standardIntrospection(StandardIntrospectionRequest $request): \Authlete\Dto\StandardIntrospectionResponse;


    /**
     * Create a service
     * (= call Authlete's /api/service/create API).
     *
     * @param Service $service
     *     Information about the service you want to create.
     *
     * @return Service
     *     Information about the service that was newly created.
     *
     * @throws AuthleteApiException
     */
    public function createService(Service $service): Service;


    /**
     * Delete a service
     * (= call Authlete's /api/service/delete/{apiKey} API).
     *
     * @param integer|string $apiKey
     *     The API key of the service.
     *
     * @throws AuthleteApiException
     */
    public function deleteService($apiKey);


    /**
     * Get information about a service
     * (= call Authlete's /api/service/get/{apiKey} API).
     *
     * @param integer|string $apiKey
     *     The API key of the service.
     *
     * @return Service
     *     Information about the service.
     *
     * @throws AuthleteApiException
     */
    public function getService($apiKey): Service;


    /**
     * Get a list of services that belong to the service owner
     * (= call Authlete's /api/service/get/list API).
     *
     * The pair of `$start` and `$end` parameters denotes the range
     * of the result set of the query. For example, if `$start` is
     * 5 and `$end` is 7, the pair makes a range from 5 (inclusive)
     * to 7 (exclusive) and the response will contain (at most) 2
     * pieces of service information, i.e., information about the
     * 6th and the 7th services (the index starts from 0).
     *
     * If `($end - $start)` is equal to or less than 0, `getServices()`
     * method of the response (\Authlete\Dto\ServiceListResponse)
     * returns `null`. But even in such a case, `getTotalCount()`
     * method returns the total count. In other words, if you want
     * to get just the total count, you can write the code as shown
     * below.
     *
     * ```
     * // Call /api/service/get/list API.
     * $response = $api->getServiceList(0, 0);
     *
     * // Get the number of services.
     * $totalCount = $response->getTotalCount();
     * ```
     *
     * @param integer $start
     *     The start index (inclusive) of the result set of the query.
     *     Must not be negative. This argument is optional and its
     *     default value is 0.
     *
     * @param integer $end
     *     The end index (exclusive) of the result set of the query.
     *     Must not be negative. This argument is optional and its
     *     default value is 5.
     *
     * @return \Authlete\Dto\ServiceListResponse
     *     A list of services.
     *
     * @throws AuthleteApiException
     */
    public function getServiceList($start = 0, $end = 5): \Authlete\Dto\ServiceListResponse;


    /**
     * Update a service
     * (= call Authlete's /api/service/update/{apiKey} API).
     *
     * @param Service $service
     *     Information about a service to update. The `getApiKey()`
     *     method of the argument must return the correct API key
     *     of the service.
     *
     * @return Service
     *     Information about the updated service.
     *
     * @throws AuthleteApiException
     */
    public function updateService(Service $service): Service;


    /**
     * Get the JWK Set of a service
     * (= call Authlete's /api/service/jwks/get API).
     *
     * @param boolean $pretty
     *     `true` to get the JSON in pretty format. This argument
     *     is optional and its default value is `false`.
     *
     * @param boolean $includePrivateKeys
     *     `true` to include private keys in the JSON. `false` to
     *     exclude private keys from the JSON. This argument is
     *     optional and its default value is `false`.
     *
     * @return string
     *     JSON representation of the JWK Set of the service.
     *
     * @throws AuthleteApiException
     */
    public function getServiceJwks(bool $pretty = false, bool $includePrivateKeys = false): string;


    /**
     * Get the configuration of the service in JSON format that
     * complies with OpenID Connect Discovery 1.0
     * (= call Authlete's /api/service/configuration API).
     *
     * The value returned from this method can be used as the response
     * body of responses returned from `/.well-known/openid-configuration`.
     * See _"4. Obtaining OpenID Provider Configuration Information"_
     * of OpenID Connect Discovery 1.0 for details.
     *
     * @param boolean $pretty
     *     `true` to get the JSON in pretty format. This argument
     *     is optional and its default value is `true`.
     *
     * @return string
     *     The configuration of the service in JSON format.
     *
     * @throws AuthleteApiException
     *
     * @see https://openid.net/specs/openid-connect-discovery-1_0.html OpenID Connect Discovery 1.0
     */
    public function getServiceConfiguration(bool $pretty = true): string;


    /**
     * Create a client
     * (= call Authlete's /api/client/create API).
     *
     * @param Client $client
     *     Information about the client you want to create.
     *
     * @return Client
     *     Information about the client that was newly created.
     *
     * @throws AuthleteApiException
     */
    public function createClient(Client $client): Client;


    /**
     * Delete a client
     * (= call Authlete's /api/client/delete/{clientId} API).
     *
     * @param integer|string $clientId
     *     The client ID of the client application you want to delete.
     *
     * @throws AuthleteApiException
     */
    public function deleteClient(int|string $clientId);


    /**
     * Get information about a client
     * (= call Authlete's /api/client/get/{clientId} API).
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return Client
     *     Information about the client.
     *
     * @throws AuthleteApiException
     */
    public function getClient(int|string $clientId): Client;


    /**
     * Get a list of clients
     * (= call Authlete's /api/client/get/list API).
     *
     * When `$developer` is `null`, a list of clients that belong to the
     * service is returned. Otherwise, when `$developer` is not `null`,
     * a list of clients that belong to the developer is returned.
     *
     * The pair of `$start` and `$end` parameters denotes the range of
     * the result set of the query. For example, if `$start` is 5 and
     * `$end` is 7, the pair makes a range from 5 (inclusive) to 7
     * (exclusive) and the response will contain (at most) 2 pieces of
     * client information, i.e., information about the 6th and 7th
     * clients (the index starts from 0).
     *
     * If `($end - $start)` is equal to or less than 0, `getClients()`
     * method of the response (\Authlete\Dto\ClientListResponse) returns
     * `null`. But even in such a case, `getTotalCount()` method returns
     * the total count. In other words, if you want to get just the
     * total count, you can write the code as shown below.
     *
     * ```
     * // Call /api/client/get/list API.
     * $response = $api->getClientList($developer, 0, 0);
     *
     * // Get the number of client applications.
     * $totalCount = $response->getTotalCount();
     * ```
     *
     * @param string|null $developer
     *     The developer of the targeted clients, or `null` to get a
     *     list of clients of the entire service. This argument is
     *     optional and its default value is `null`.
     *
     * @param integer $start
     *     The start index (inclusive) of the result set of the query.
     *     Must not be negative. This argument is optional and its
     *     default value is 0.
     *
     * @param integer $end
     *     The end index (exclusive) of the result set of the query.
     *     Must not be negative. This argument is optional and its
     *     default value is 5.
     *
     * @throws AuthleteApiException
     */
    public function getClientList(string $developer = null, int $start = 0, int $end = 5);


    /**
     * Update a client
     * (= call Authlete's /api/client/update/{clientId} API).
     *
     * @param Client $client
     *     Information about a client you want to update. The
     *     `getClientId()` method of `$client` must return the
     *     correct client ID of the client.
     *
     * @return Client
     *     Information about the updated client.
     *
     * @throws AuthleteApiException
     */
    public function updateClient(Client $client): Client;


    /**
     * Get the set of scopes that an end-user has granted to a client
     * application (= call Authlete's
     * /api/client/granted_scopes/get/{clientId} API).
     *
     * A dedicated Authlete server provides a functionality to remember
     * the set of scopes that an en-user has granted to a client
     * application. A remembered set is NOT removed from the database
     * even after all existing access tokens associated with the
     * combination of the client application and the subject have
     * expired. Note that this functionality is not provided by the
     * shared Authlete server.
     *
     * @param integer|string $clientId
     *     Client ID.
     *
     * @param string $subject
     *     Subject (= unique identifier) of an end-user.
     *
     * @return \Authlete\Dto\GrantedScopesGetResponse
     *     Scopes granted to the client application by the end-user.
     *
     * @throws AuthleteApiException
     */
    public function getGrantedScopes(int|string $clientId, string $subject): \Authlete\Dto\GrantedScopesGetResponse;


    /**
     * Delete DB records about the set of scopes that an end-user has
     * granted to a client application (= call Authlete's
     * /api/client/granted_scopes/delete/{clientId} API).
     *
     * Even if you delete records about granted scopes by calling this
     * API, existing access tokens are not deleted and scopes of existing
     * access tokens are not changed.
     *
     * Please call this method if the end-user identified by the subject
     * is deleted from your system. Otherwise, garbage data continue to
     * exist in the database.
     *
     * @param integer|string $clientId
     *     Client ID.
     *
     * @param string $subject
     *     Subject (= unique identifier) of an end-user.
     *
     * @throws AuthleteApiException
     */
    public function deleteGrantedScopes(int|string $clientId, string $subject);


    /**
     * Delete all existing access tokens issued to the client
     * application by the end-user (= call Authlete's
     * /api/client/authorization/delete/{clientId} API).
     *
     * @param integer|string $clientId
     *     Client ID.
     *
     * @param string $subject
     *     Subject (= unique identifier) of an end-user.
     *
     * @throws AuthleteApiException
     */
    public function deleteClientAuthorization(int|string $clientId, string $subject);


    /**
     * Get the list of client applications authorized by the end-user
     * (= call Authlete's /api/client/authorization/get/list API).
     *
     * @param ClientAuthorizationGetListRequest $request
     *     Conditions of the query to Authlete's
     *     `/api/client/authorization/get/list` API.
     *
     * @return \Authlete\Dto\AuthorizedClientListResponse
     *     The list of client applications.
     *
     * @throws AuthleteApiException
     */
    public function getClientAuthorizationList(
        ClientAuthorizationGetListRequest $request): \Authlete\Dto\AuthorizedClientListResponse;


    /**
     * Update attributes of all existing access tokens issued to the
     * client application by the end-user (= call Authlete's
     * /api/client/authorization/update/{clientId} API).
     *
     * @param integer|string $clientId
     *     Client ID.
     *
     * @param ClientAuthorizationUpdateRequest $request
     *     Request parameters passed to the Authlete API.
     *
     * @return \Authlete\Dto\ApiResponse
     *     The result of the API call.
     *
     * @throws AuthleteApiException
     */
    public function updateClientAuthorization(
        int|string $clientId, ClientAuthorizationUpdateRequest $request): \Authlete\Dto\ApiResponse;


    /**
     * Refresh the client secret of a client (= call Authlete's
     * /api/client/secret/refresh/{clientId} API).
     *
     * A new value of the client secret will be generated by the
     * Authlete server. If you want to specify a new value, use
     * `updateClientSecret()` method.
     *
     * @param integer|string $clientId
     *     Client ID.
     *
     * @return \Authlete\Dto\ClientSecretRefreshResponse
     *     The client secret.
     *
     * @throws AuthleteApiException
     */
    public function refreshClientSecret(int|string $clientId): \Authlete\Dto\ClientSecretRefreshResponse;


    /**
     * Update the client secret of a client (= call Authlete's
     * /api/client/secret/update/{clientId} API).
     *
     * If you want to have the Authlete server generate a new value
     * of the client secret, use `refreshClientSecret()` method.
     *
     * Valid characters for a client secret are `A-Z`, `a-z`, `0-9`,
     * `-`, and `_`. The maximum length of a client secret is 86.
     *
     * @param integer|string $clientId
     *     Client ID.
     *
     * @param string $clientSecret
     *     A new value of client secret.
     *
     * @return \Authlete\Dto\ClientSecretUpdateResponse
     *     The client secret.
     *
     * @throws AuthleteApiException
     */
    public function updateClientSecret(int|string $clientId, string $clientSecret): \Authlete\Dto\ClientSecretUpdateResponse;


    /**
     * Call Authlete's /api/backchannel/authentication API.
     *
     * @param BackchannelAuthenticationRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\BackchannelAuthenticationResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function backchannelAuthentication(BackchannelAuthenticationRequest $request): \Authlete\Dto\BackchannelAuthenticationResponse;


    /**
     * Call Authlete's /api/backchannel/authentication/issue API.
     *
     * @param BackchannelAuthenticationIssueRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\BackchannelAuthenticationIssueResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function backchannelAuthenticationIssue(BackchannelAuthenticationIssueRequest $request): \Authlete\Dto\BackchannelAuthenticationIssueResponse;


    /**
     * Call Authlete's /api/backchannel/authentication/fail API.
     *
     * @param BackchannelAuthenticationFailRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\BackchannelAuthenticationFailResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function backchannelAuthenticationFail(BackchannelAuthenticationFailRequest $request): \Authlete\Dto\BackchannelAuthenticationFailResponse;


    /**
     * Call Authlete's /api/backchannel/authentication/complete API.
     *
     * @param BackchannelAuthenticationCompleteRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\BackchannelAuthenticationCompleteResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function backchannelAuthenticationComplete(BackchannelAuthenticationCompleteRequest $request): \Authlete\Dto\BackchannelAuthenticationCompleteResponse;


    /**
     * Call Authlete's /api/device/authorization API.
     *
     * @param DeviceAuthorizationRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\DeviceAuthorizationResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function deviceAuthorization(DeviceAuthorizationRequest $request): \Authlete\Dto\DeviceAuthorizationResponse;


    /**
     * Call Authlete's /api/device/complete API.
     *
     * @param DeviceCompleteRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\DeviceCompleteResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function deviceComplete(DeviceCompleteRequest $request): \Authlete\Dto\DeviceCompleteResponse;


    /**
     * Call Authlete's /api/device/verification API.
     *
     * @param DeviceVerificationRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\DeviceVerificationResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function deviceVerification(DeviceVerificationRequest $request): \Authlete\Dto\DeviceVerificationResponse;


    /**
     * Call Authlete's /api/pushed_auth_req API.
     *
     * @param PushedAuthReqRequest $request
     *     Request parameters passed to the API.
     *
     * @return \Authlete\Dto\PushedAuthReqResponse
     *     Response from the API.
     *
     * @throws AuthleteApiException
     *
     * @since 1.8
     */
    public function pushAuthorizationRequest(PushedAuthReqRequest $request): \Authlete\Dto\PushedAuthReqResponse;


    /**
     * The settings of this AuthleteApi implementation.
     *
     * @return Settings
     *     The settings of this `AuthleteApi` implementation.
     */
    public function getSettings(): Settings;
}
?>
