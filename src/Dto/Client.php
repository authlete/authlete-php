<?php
//
// Copyright (C) 2018-2021 Authlete, Inc.
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
 * File containing the definition of Client class.
 */


namespace Authlete\Dto;


use Authlete\Types\ApplicationType;
use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\ClientType;
use Authlete\Types\DeliveryMode;
use Authlete\Types\GrantType;
use Authlete\Types\Jsonable;
use Authlete\Types\JWEAlg;
use Authlete\Types\JWEEnc;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\SubjectType;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Information about a client application.
 *
 * Some properties correspond to the metadata listed in
 * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
 * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html)
 */
class Client implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $developer                             = null;  // string
    private $clientId                              = null;  // string or (64-bit) integer
    private $clientIdAlias                         = null;  // string
    private $clientIdAliasEnabled                  = false; // boolean
    private $clientSecret                          = null;  // string
    private $clientType                            = null;  // \Authlete\Types\ClientType
    private $redirectUris                          = null;  // array of string
    private $responseTypes                         = null;  // array of \Authlete\Types\ResponseType
    private $grantTypes                            = null;  // array of \Authlete\Types\GrantType
    private $applicationType                       = null;  // \Authlete\Types\ApplicationType
    private $contacts                              = null;  // array of string
    private $clientName                            = null;  // string
    private $clientNames                           = null;  // array of \Authlete\Dto\TaggedValue
    private $logoUri                               = null;  // string
    private $logoUris                              = null;  // array of \Authlete\Dto\TaggedValue
    private $clientUri                             = null;  // string
    private $clientUris                            = null;  // array of \Authlete\Dto\TaggedValue
    private $policyUri                             = null;  // string
    private $policyUris                            = null;  // array of \Authlete\Dto\TaggedValue
    private $tosUri                                = null;  // string
    private $tosUris                               = null;  // array of \Authlete\Dto\TaggedValue
    private $jwksUri                               = null;  // string
    private $jwks                                  = null;  // string
    private $derivedSectorIdentifier               = null;  // string
    private $sectorIdentifierUri                   = null;  // string
    private $subjectType                           = null;  // \Authlete\Types\SubjectType
    private $idTokenSignAlg                        = null;  // \Authlete\Types\JWSAlg
    private $idTokenEncryptionAlg                  = null;  // \Authlete\Types\JWEAlg
    private $idTokenEncryptionEnc                  = null;  // \Authlete\Types\JWEEnc
    private $userInfoSignAlg                       = null;  // \Authlete\Types\JWSAlg
    private $userInfoEncryptionAlg                 = null;  // \Authlete\Types\JWEAlg
    private $userInfoEncryptionEnc                 = null;  // \Authlete\Types\JWEEnc
    private $requestSignAlg                        = null;  // \Authlete\Types\JWSAlg
    private $requestEncryptionAlg                  = null;  // \Authlete\Types\JWEAlg
    private $requestEncryptionEnc                  = null;  // \Authlete\Types\JWEEnc
    private $tokenAuthMethod                       = null;  // \Authlete\Types\ClientAuthMethod
    private $tokenAuthSignAlg                      = null;  // \Authlete\Types\JWSAlg
    private $defaultMaxAge                         = null;  // string or integer
    private $authTimeRequired                      = false; // boolean
    private $defaultAcrs                           = null;  // array of string
    private $loginUri                              = null;  // string
    private $requestUris                           = null;  // array of string
    private $description                           = null;  // string
    private $descriptions                          = null;  // array of \Authlete\Dto\TaggedValue
    private $createdAt                             = null;  // string or (64-bit) integer
    private $modifiedAt                            = null;  // string or (64-bit) integer
    private $extension                             = null;  // \Authlete\Dto\ClientExtension
    private $tlsClientAuthSubjectDn                = null;  // string
    private $tlsClientAuthSanDns                   = null;  // string
    private $tlsClientAuthSanUri                   = null;  // string
    private $tlsClientAuthSanIp                    = null;  // string
    private $tlsClientAuthSanEmail                 = null;  // string
    private $tlsClientCertificateBoundAccessTokens = false; // boolean
    private $selfSignedCertificateKeyId            = null;  // string
    private $softwareId                            = null;  // string
    private $softwareVersion                       = null;  // string
    private $authorizationSignAlg                  = null;  // \Authlete\Types\JWSAlg
    private $authorizationEncryptionAlg            = null;  // \Authlete\Types\JWEAlg
    private $authorizationEncryptionEnc            = null;  // \Authlete\Types\JWEEnc
    private $bcDeliveryMode                        = null;  // \Authlete\Types\DeliveryMode
    private $bcNotificationEndpoint                = null;  // string
    private $bcRequestSignAlg                      = null;  // \Authlete\Types\JWSAlg
    private $bcUserCodeRequired                    = false; // boolean
    private $dynamicallyRegistered                 = false; // boolean
    private $registrationAccessTokenHash           = null;  // string
    private $authorizationDataTypes                = null;  // array of string
    private $parRequired                           = false; // boolean
    private $requestObjectRequired                 = false; // boolean


    /**
     * Get the unique ID of the developer of this client application.
     *
     * @return string
     *     The unique ID of the developer.
     */
    public function getDeveloper()
    {
        return $this->developer;
    }


    /**
     * Set the unique ID of the developer of this client application.
     *
     * @param string $developer
     *     The unique ID of the developer.
     *
     * @return Client
     *     `$this` object.
     */
    public function setDeveloper($developer)
    {
        ValidationUtility::ensureNullOrString('$developer', $developer);

        $this->developer = $developer;

        return $this;
    }


    /**
     * Get the client ID which is expected to be used as the value of the
     * "client_id" request parameter of authorization requests and token
     * requests.
     *
     * @return integer|string
     *     The client ID. (64-bit integer if your PHP system can handle
     *     64-bit integers.)
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set the client ID which is expected to be used as the value of the
     * "client_id" request parameter of authorization requests and token
     * requests.
     *
     * @param integer|string $clientId
     *     The client ID. (64-bit integer if your PHP system can handle
     *     64-bit integers.)
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the alias of the client ID.
     *
     * Note that the client ID alias is recognized only when the
     * `clientIdAliasEnabled` properties of both this client and the service
     * (which this client belongs to) are `true`.
     *
     * @return string
     *     The client ID alias.
     */
    public function getClientIdAlias()
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the alias of the client ID.
     *
     * Note that the client ID alias is recognized only when the
     * `clientIdAliasEnabled` properties of both this client and the service
     * (which this client belongs to) are `true`.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientIdAlias($alias)
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias is enabled
     * or not.
     *
     * Note that {@link \Authlete\Dto\Service Service} class also has
     * `isClientIdAliasEnabled()` method. If the service's
     * `isClientIdAliasEnabled()` method returns `false`, the client ID
     * alias of this client is not recognized even if this client's
     * `isClientIdAliasEnabled()` method returns `true`.
     *
     * @return boolean
     *     `true` if this client's ID alias is enabled.
     */
    public function isClientIdAliasEnabled()
    {
        return $this->clientIdAliasEnabled;
    }


    /**
     * Set the flag which indicates whether the client ID alias is enabled
     * or not.
     *
     * Note that {@link \Authlete\Dto\Service Service} class also has
     * `isClientIdAliasEnabled()` method. If the service's
     * `isClientIdAliasEnabled()` method returns `false`, the client ID
     * alias of this client is not recognized even if this client's
     * `isClientIdAliasEnabled()` method returns `true`.
     *
     * @param boolean $enabled
     *     `true` to enable client's ID alias.
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientIdAliasEnabled($enabled)
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->clientIdAliasEnabled = $enabled;

        return $this;
    }


    /**
     * Get the client secret which is expected to be used as the value of
     * the "client_secret" request parameter of token requests.
     *
     * @return string
     *     The client secret.
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }


    /**
     * Set the client secret which is expected to be used as the value of
     * the "client_secret" request parameter of token requests.
     *
     * @param string $secret
     *     The client secret.
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientSecret($secret)
    {
        ValidationUtility::ensureNullOrString('$secret', $secret);

        $this->clientSecret = $secret;

        return $this;
    }


    /**
     * Get the client type.
     *
     * The definition of _Client Type_ is described in
     * [2.1. Client Types](https://tools.ietf.org/html/rfc6749#section-2.1)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749).
     *
     * @return ClientType
     *     The client type.
     */
    public function getClientType()
    {
        return $this->clientType;
    }


    /**
     * Set the client type.
     *
     * The definition of _Client Type_ is described in
     * [2.1. Client Types](https://tools.ietf.org/html/rfc6749#section-2.1)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749).
     *
     * @param ClientType $clientType
     *     The client type.
     */
    public function setClientType(ClientType $clientType = null)
    {
        $this->clientType = $clientType;

        return $this;
    }


    /**
     * Get the redirect URIs.
     *
     * See [3.1.2. Redirection Endpoint](https://tools.ietf.org/html/rfc6749#section-3.1.2)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749) for details.
     *
     * @return string[]
     *     A string array containing redirect URIs.
     */
    public function getRedirectUris()
    {
        return $this->redirectUris;
    }


    /**
     * Set the redirect URIs.
     *
     * See [3.1.2. Redirection Endpoint](https://tools.ietf.org/html/rfc6749#section-3.1.2)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749) for details.
     *
     * @param string[] $redirectUris
     *     A string array containing redirect URIs.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRedirectUris(array $redirectUris = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$redirectUris', $redirectUris);

        $this->redirectUris = $redirectUris;

        return $this;
    }


    /**
     * Get the "response_type" values that this client application is
     * declaring that it will restrict itself to using.
     *
     * This corresponds to the `response_types` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return ResponseType[]
     *     An array of \Authlete\Types\ResponseType.
     */
    public function getResponseTypes()
    {
        return $this->responseTypes;
    }


    /**
     * Set the "response_type" values that this client application is
     * declaring that it will restrict itself to using.
     *
     * This corresponds to the `response_types` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param ResponseType[] $responseTypes
     *     An array of \Authlete\Types\ResponseType.
     *
     * @return Client
     *     `$this` object.
     */
    public function setResponseTypes(array $responseTypes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$responseTypes', $responseTypes, '\Authlete\Types\ResponseType');

        $this->responseTypes = $responseTypes;

        return $this;
    }


    /**
     * Get the "grant_type" values that this client application is declaring
     * that it will restrict itself to using.
     *
     * This corresponds to the `grant_types` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return GrantType[]
     *     An array of \Authlete\Types\GrantType.
     */
    public function getGrantTypes()
    {
        return $this->grantTypes;
    }


    /**
     * Set the "grant_type" values that this client application is declaring
     * that it will restrict itself to using.
     *
     * This corresponds to the `grant_types` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param GrantType[] $grantTypes
     *     An array of \Authlete\Types\GrantType.
     *
     * @return Client
     *     `$this` object.
     */
    public function setGrantTypes(array $grantTypes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$grantTypes', $grantTypes, '\Authlete\Types\GrantType');

        $this->grantTypes = $grantTypes;

        return $this;
    }


    /**
     * Get the application type of this client application.
     *
     * This corresponds to the `application_type` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return ApplicationType
     *     The application type.
     */
    public function getApplicationType()
    {
        return $this->applicationType;
    }


    /**
     * Set the application type of this client application.
     *
     * This corresponds to the `application_type` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param ApplicationType $applicationType
     *     The application type.
     *
     * @return Client
     *     `$this` object.
     */
    public function setApplicationType(ApplicationType $applicationType = null)
    {
        $this->applicationType = $applicationType;

        return $this;
    }


    /**
     * Get the email addresses of contacts for this client application.
     *
     * This corresponds to the `contacts` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string[]
     *     The email addresses of contacts.
     */
    public function getContacts()
    {
        return $this->contacts;
    }


    /**
     * Set the email addresses of contacts for this client application.
     *
     * This corresponds to the `contacts` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string[] $contacts
     *     The email addresses of contacts.
     *
     * @return Client
     *     `$this` object.
     */
    public function setContacts(array $contacts = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$contacts', $contacts);

        $this->contacts = $contacts;

        return $this;
    }


    /**
     * Get the name of this client application.
     *
     * This corresponds to the `client_name` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The client name.
     */
    public function getClientName()
    {
        return $this->clientName;
    }


    /**
     * Set the name of this client application.
     *
     * This corresponds to the `client_name` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $clientName
     *     The client name.
     *
     * @return
     *     `$this` object.
     */
    public function setClientName($clientName)
    {
        ValidationUtility::ensureNullOrString('$clientName', $clientName);

        $this->clientName = $clientName;

        return $this;
    }


    /**
     * Get the localized names of this client application.
     *
     * @return TaggedValue[]
     *     The localized client names.
     */
    public function getClientNames()
    {
        return $this->clientNames;
    }


    /**
     * Set the localized names of this client application.
     *
     * @param TaggedValue[] $clientNames
     *     The localized client names.
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientNames(array $clientNames = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$clientNames', $clientNames, __NAMESPACE__ . '\TaggedValue');

        $this->clientNames = $clientNames;

        return $this;
    }


    /**
     * Get the URI of the logo image of this client application.
     *
     * This corresponds to the `logo_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The URI of the logo image of this client application.
     */
    public function getLogoUri()
    {
        return $this->logoUri;
    }


    /**
     * Set the URI of the logo image of this client application.
     *
     * This corresponds to the `logo_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $logoUri
     *     The URI of the logo image of this client application.
     */
    public function setLogoUri($logoUri)
    {
        ValidationUtility::ensureNullOrString('$logoUri', $logoUri);

        $this->logoUri = $logoUri;

        return $this;
    }


    /**
     * Get the URIs of localized logo images of this client application.
     *
     * @return TaggedValue[]
     *     The URIs of localized logo images of this client application.
     */
    public function getLogoUris()
    {
        return $this->logoUris;
    }


    /**
     * Set the URIs of localized logo images of this client application.
     *
     * @param TaggedValue[] $logoUris
     *     The URIs of localized logo images of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setLogoUris(array $logoUris = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$logoUris', $logoUris, __NAMESPACE__ . '\TaggedValue');

        $this->logoUris = $logoUris;

        return $this;
    }


    /**
     * Get the URI of the home page of this client application.
     *
     * This corresponds to the `client_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The URI of the home page of this client application.
     */
    public function getClientUri()
    {
        return $this->clientUri;
    }


    /**
     * Set the URI of the home page of this client application.
     *
     * This corresponds to the `client_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $clientUri
     *     The URI of the home page of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientUri($clientUri)
    {
        ValidationUtility::ensureNullOrString('$clientUri', $clientUri);

        $this->clientUri = $clientUri;

        return $this;
    }


    /**
     * Get the URIs of localized home pages of this client application.
     *
     * @return TaggedValue[]
     *     The URIs of localized home pages of this client application.
     */
    public function getClientUris()
    {
        return $this->clientUris;
    }


    /**
     * Set the URIs of localized home pages of this client application.
     *
     * @param TaggedValue[] $clientUris
     *     The URIs of localized home pages of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setClientUris(array $clientUris = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$clientUris', $clientUris, __NAMESPACE__ . '\TaggedValue');

        $this->clientUris = $clientUris;

        return $this;
    }


    /**
     * Get the URI of the policy page which describes how this client
     * application uses the profile data of the end-user.
     *
     * This corresponds to the `policy_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The URI of the policy page.
     */
    public function getPolicyUri()
    {
        return $this->policyUri;
    }


    /**
     * Set the URI of the policy page which describes how this client
     * application uses the profile data of the end-user.
     *
     * This corresponds to the `policy_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $policyUri
     *     The URI of the policy page.
     *
     * @return Client
     *     `$this` object.
     */
    public function setPolicyUri($policyUri)
    {
        ValidationUtility::ensureNullOrString('$policyUri', $policyUri);

        $this->policyUri = $policyUri;

        return $this;
    }


    /**
     * Get the URIs of localized policy pages of this client application.
     *
     * @return TaggedValue[]
     *     The URIs of localized policy pages of this client application.
     */
    public function getPolicyUris()
    {
        return $this->policyUris;
    }


    /**
     * Set the URIs of localized policy pages of this client application.
     *
     * @param TaggedValue[] $policyUris
     *     The URIs of localized policy pages of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setPolicyUris(array $policyUris = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$policyUris', $policyUris, __NAMESPACE__ . '\TaggedValue');

        $this->policyUris = $policyUris;

        return $this;
    }


    /**
     * Get the URI of the "Terms Of Service" page of this client application.
     *
     * This corresponds to the `tos_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The URI of the "Terms Of Service" page of this client application.
     */
    public function getTosUri()
    {
        return $this->tosUri;
    }


    /**
     * Set the URI of the "Terms Of Service" page of this client application.
     *
     * This corresponds to the `tos_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $tosUri
     *     The URI of the "Terms Of Service" page of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTosUri($tosUri)
    {
        ValidationUtility::ensureNullOrString('$tosUri', $tosUri);

        $this->tosUri = $tosUri;

        return $this;
    }


    /**
     * Get the URIs of localized "Terms Of Service" pages of this client
     * application.
     *
     * @return TaggedValue[]
     *     The URIs of localized "Terms Of Service" pages of this client
     *     application.
     */
    public function getTosUris()
    {
        return $this->tosUris;
    }


    /**
     * Set the URIs of localized "Terms Of Service" pages of this client
     * application.
     *
     * @param TaggedValue[] $tosUris
     *     The URIs of localized "Terms Of Service" pages of this client
     *     application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTosUris(array $tosUris = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$tosUris', $tosUris, __NAMESPACE__ . '\TaggedValue');

        $this->tosUris = $tosUris;

        return $this;
    }


    /**
     * Get the URI of the JSON Web Key Set of this client application.
     *
     * This corresponds to the `jwks_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The URI of the JSON Web Key Set of this client application.
     */
    public function getJwksUri()
    {
        return $this->jwksUri;
    }


    /**
     * Set the URI of the JSON Web Key Set of this client application.
     *
     * This corresponds to the `jwks_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $jwksUri
     *     The URI of the JSON Web Key Set of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setJwksUri($jwksUri)
    {
        ValidationUtility::ensureNullOrString('$jwksUri', $jwksUri);

        $this->jwksUri = $jwksUri;

        return $this;
    }


    /**
     * Get the JSON Web Key Set of this client application.
     *
     * This corresponds to the `jwks` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The JSON Web Key Set of this client application.
     */
    public function getJwks()
    {
        return $this->jwks;
    }


    /**
     * Set the JSON Web Key Set of this client application.
     *
     * This corresponds to the `jwks` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $jwks
     *     The JSON Web Key Set of this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setJwks($jwks)
    {
        ValidationUtility::ensureNullOrString('$jwks', $jwks);

        $this->jwks = $jwks;

        return $this;
    }


    /**
     * Get the sector identifier host component as derived from either the
     * `sector_identifier_uri` or the registered `redirect_uri`. If no
     * `sector_identifier_uri` is registered and multiple redirect URIs
     * are registered, this value is undefined and this property returnes
     * null.
     *
     * @return string
     *     The derived sector identifier, if available, or null otherwise.
     *
     * @since 1.8
     */
    public function getDerivedSectorIdentifier()
    {
        return $this->derivedSectorIdentifier;
    }


    /**
     * Set the sector identifier host component as derived from either the
     * `sector_identifier_uri` or the registered `redirect_uri`. If no
     * `sector_identifier_uri` is registered and multiple redirect URIs
     * are registered, this value is undefined and this property returnes
     * null.
     *
     * @param string $identifier
     *     The derived sector identifier, if available, or null otherwise.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDerivedSectorIdentifier($identifier)
    {
        ValidationUtility::ensureNullOrString('$identifier', $identifier);

        $this->derivedSectorIdentifier = $identifier;

        return $this;
    }


    /**
     * Get the sector identifier URI.
     *
     * This corresponds to the `sector_identifier_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     * See [5. "sector_identifier_uri" Validation](https://openid.net/specs/openid-connect-registration-1_0.html#SectorIdentifierValidation)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html)
     * for details.
     *
     * @return string
     *     The sector identifier URI.
     */
    public function getSectorIdentifierUri()
    {
        return $this->sectorIdentifierUri;
    }


    /**
     * Set the sector identifier URI.
     *
     * This corresponds to the `sector_identifier_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     * See [5. "sector_identifier_uri" Validation](https://openid.net/specs/openid-connect-registration-1_0.html#SectorIdentifierValidation)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html)
     * for details.
     *
     * @param string $uri
     *     The sector identifier URI.
     *
     * @return Client
     *     `$this` object.
     */
    public function setSectorIdentifierUri($uri)
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->sectorIdentifierUri = $uri;

        return $this;
    }


    /**
     * Get the subject type.
     *
     * This corresponds to the `subject_type` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     * See [8. Subject Identifier Types](https://openid.net/specs/openid-connect-core-1_0.html#SubjectIDTypes)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for details.
     *
     * @return SubjectType
     *     The subject type.
     */
    public function getSubjectType()
    {
        return $this->subjectType;
    }


    /**
     * Set the subject type.
     *
     * This corresponds to the `subject_type` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     * See [8. Subject Identifier Types](https://openid.net/specs/openid-connect-core-1_0.html#SubjectIDTypes)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for details.
     *
     * @param SubjectType $subjectType
     *     The subject type.
     *
     * @return Client
     *     `$this` object.
     */
    public function setSubjectType(SubjectType $subjectType = null)
    {
        $this->subjectType = $subjectType;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWSAlg
     *     The JWS "alg" algorithm for signing ID tokens.
     */
    public function getIdTokenSignAlg()
    {
        return $this->idTokenSignAlg;
    }


    /**
     * Set the JWS "alg" algorithm for signing ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg $idTokenSignAlg
     *     The JWS "alg" algorithm for signing ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setIdTokenSignAlg(JWSAlg $idTokenSignAlg = null)
    {
        $this->idTokenSignAlg = $idTokenSignAlg;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEAlg
     *     The JWE "alg" algorithm for encrypting ID tokens.
     */
    public function getIdTokenEncryptionAlg()
    {
        return $this->idTokenEncryptionAlg;
    }


    /**
     * Set the JWE "alg" algorithm for encrypting ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEAlg $idTokenEncryptionAlg
     *     The JWE "alg" algorithm for encrypting ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setIdTokenEncryptionAlg(JWEAlg $idTokenEncryptionAlg = null)
    {
        $this->idTokenEncryptionAlg = $idTokenEncryptionAlg;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEEnc
     *     The JWE "enc" algorithm for encrypting ID tokens.
     */
    public function getIdTokenEncryptionEnc()
    {
        return $this->idTokenEncryptionEnc;
    }


    /**
     * Set the JWE "enc" algorithm for encrypting ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEEnc $idTokenEncryptionEnc
     *     The JWE "enc" algorithm for encrypting ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setIdTokenEncryptionEnc(JWEEnc $idTokenEncryptionEnc = null)
    {
        $this->idTokenEncryptionEnc = $idTokenEncryptionEnc;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing UserInfo responses.
     *
     * This corresponds to the `userinfo_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWSAlg
     *     The JWS "alg" algorithm for signing UserInfo responses.
     */
    public function getUserInfoSignAlg()
    {
        return $this->userInfoSignAlg;
    }


    /**
     * Set the JWS "alg" algorithm for signing UserInfo responses.
     *
     * This corresponds to the `userinfo_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg $userInfoSignAlg
     *     The JWS "alg" algorithm for signing UserInfo responses.
     *
     * @return Client
     *     `$this` object.
     */
    public function setUserInfoSignAlg(JWSAlg $userInfoSignAlg = null)
    {
        $this->userInfoSignAlg = $userInfoSignAlg;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEAlg
     *     The JWE "alg" algorithm for encrypting UserInfo responses.
     */
    public function getUserInfoEncryptionAlg()
    {
        return $this->userInfoEncryptionAlg;
    }


    /**
     * Set the JWE "alg" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEAlg $userInfoEncryptionAlg
     *     The JWE "alg" algorithm for encrypting UserInfo responses.
     *
     * @return Client
     *     `$this` object.
     */
    public function setUserInfoEncryptionAlg(JWEAlg $userInfoEncryptionAlg = null)
    {
        $this->userInfoEncryptionAlg = $userInfoEncryptionAlg;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEEnc
     *     The JWE "enc" algorithm for encrypting UserInfo responses.
     */
    public function getUserInfoEncryptionEnc()
    {
        return $this->userInfoEncryptionEnc;
    }


    /**
     * Set the JWE "enc" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEEnc $userInfoEncryptionEnc
     *     The JWE "enc" algorithm for encrypting UserInfo responses.
     *
     * @return Client
     *     `$this` object.
     */
    public function setUserInfoEncryptionEnc(JWEEnc $userInfoEncryptionEnc = null)
    {
        $this->userInfoEncryptionEnc = $userInfoEncryptionEnc;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing request objects.
     *
     * This corresponds to the `request_object_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWSAlg
     *     The JWS "alg" algorithm for signing request objects.
     */
    public function getRequestSignAlg()
    {
        return $this->requestSignAlg;
    }


    /**
     * Set the JWS "alg" algorithm for signing request objects.
     *
     * This corresponds to the `request_object_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg $requestSignAlg
     *     The JWS "alg" algorithm for signing request objects.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestSignAlg(JWSAlg $requestSignAlg = null)
    {
        $this->requestSignAlg = $requestSignAlg;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEAlg
     *     The JWE "alg" algorithm for encrypting request objects.
     */
    public function getRequestEncryptionAlg()
    {
        return $this->requestEncryptionAlg;
    }


    /**
     * Set the JWE "alg" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEAlg $requestEncryptionAlg
     *     The JWE "alg" algorithm for encrypting request objects.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestEncryptionAlg(JWEAlg $requestEncryptionAlg = null)
    {
        $this->requestEncryptionAlg = $requestEncryptionAlg;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEEnc
     *     The JWE "enc" algorithm for encrypting request objects.
     */
    public function getRequestEncryptionEnc()
    {
        return $this->requestEncryptionEnc;
    }


    /**
     * Set the JWE "enc" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEEnc $requestEncryptionEnc
     *     The JWE "enc" algorithm for encrypting request objects.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestEncryptionEnc(JWEEnc $requestEncryptionEnc = null)
    {
        $this->requestEncryptionEnc = $requestEncryptionEnc;

        return $this;
    }


    /**
     * Get the client authentication method for the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_method` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return ClientAuthMethod
     *     The client authentication method for the token endpoint.
     */
    public function getTokenAuthMethod()
    {
        return $this->tokenAuthMethod;
    }


    /**
     * Set the client authentication method for the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_method` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param ClientAuthMethod $tokenAuthMethod
     *     The client authentication method for the token endpoint.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTokenAuthMethod(ClientAuthMethod $tokenAuthMethod = null)
    {
        $this->tokenAuthMethod = $tokenAuthMethod;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing the JWT used to authenticate
     * the client at the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWSAlg
     *     The JWS "alg" algorithm for signing the JWT used to authenticate
     *     the client at the token endpoint.
     */
    public function getTokenAuthSignAlg()
    {
        return $this->tokenAuthSignAlg;
    }


    /**
     * Set the JWS "alg" algorithm for signing the JWT used to authenticate
     * the client at the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg $tokenAuthSignAlg
     *     The JWS "alg" algorithm for signing the JWT used to authenticate
     *     the client at the token endpoint.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTokenAuthSignAlg(JWSAlg $tokenAuthSignAlg = null)
    {
        $this->tokenAuthSignAlg = $tokenAuthSignAlg;

        return $this;
    }


    /**
     * Get the default value of the maximum authentication age in seconds.
     *
     * This corresponds to the `default_max_age` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return integer|string
     *     The default max age in seconds.
     */
    public function getDefaultMaxAge()
    {
        return $this->defaultMaxAge;
    }


    /**
     * Set the default value of the maximum authentication age in seconds.
     *
     * This corresponds to the `default_max_age` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param integer|string $defaultMaxAge
     *     The default max age in seconds.
     *
     * @return Client
     *     `$this` object.
     */
    public function setDefaultMaxAge($defaultMaxAge)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$defaultMaxAge', $defaultMaxAge);

        $this->defaultMaxAge = $defaultMaxAge;

        return $this;
    }


    /**
     * Get the flag which indicates whether this client always requires
     * `auth_time` claim to be embedded in ID tokens.
     *
     * This corresponds to the `require_auth_time` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return boolean
     *     `true` if this client application always requires `auth_time`
     *     to be embedded in ID tokens.
     */
    public function isAuthTimeRequired()
    {
        return $this->authTimeRequired;
    }


    /**
     * Set the flag which indicates whether this client always requires
     * `auth_time` claim to be embedded in ID tokens.
     *
     * This corresponds to the `require_auth_time` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param boolean $required
     *     `true` if this client application always requires `auth_time`
     *     to be embedded in ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setAuthTimeRequired($required)
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->authTimeRequired = $required;

        return $this;
    }


    /**
     * Get the default list of Authentication Context Class References.
     *
     * This corresponds to the `default_acr_values` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string[]
     *     The default list of Authentication Context Class References.
     */
    public function getDefaultAcrs()
    {
        return $this->defaultAcrs;
    }


    /**
     * Set the default list of Authentication Context Class References.
     *
     * This corresponds to the `default_acr_values` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string[] $defaultAcrs
     *     The default list of Authentication Context Class References.
     *
     * @return Client
     *     `$this` object.
     */
    public function setDefaultAcrs(array $defaultAcrs = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$defaultAcrs', $defaultAcrs);

        $this->defaultAcrs = $defaultAcrs;

        return $this;
    }


    /**
     * Get the URL that can initiate a login for this client application.
     *
     * This corresponds to the `initiate_login_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string
     *     The URL that can initiate a login for this client application.
     */
    public function getLoginUri()
    {
        return $this->loginUri;
    }


    /**
     * Set the URL that can initiate a login for this client application.
     *
     * This corresponds to the `initiate_login_uri` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string $loginUri
     *     The URL that can initiate a login for this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setLoginUri($loginUri)
    {
        ValidationUtility::ensureNullOrString('$loginUri', $loginUri);

        $this->loginUri = $loginUri;

        return $this;
    }


    /**
     * Get the request URIs that this client declares it may use.
     *
     * This corresponds to the `request_uris` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return string[]
     *     The request URIs.
     */
    public function getRequestUris()
    {
        return $this->requestUris;
    }


    /**
     * Set the request URIs that this client declares it may use.
     *
     * This corresponds to the `request_uris` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param string[] $requestUris
     *     The request URIs.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestUris(array $requestUris = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$requestUris', $requestUris);

        $this->requestUris = $requestUris;

        return $this;
    }


    /**
     * Get the description about this client application.
     *
     * @return string
     *     The description about this client application.
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set the description about this client application.
     *
     * @param string $description
     *     The description about this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setDescription($description)
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->description = $description;

        return $this;
    }


    /**
     * Get the localized descriptions about this client application.
     *
     * @return TaggedValue[]
     *     The localized descriptions about this client application.
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }


    /**
     * Set the localized descriptions about this client application.
     *
     * @param TaggedValue[] $descriptions
     *     The localized descriptions about this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setDescriptions(array $descriptions = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$descriptions', $descriptions, __NAMESPACE__ . '\TaggedValue');

        $this->descriptions = $descriptions;

        return $this;
    }


    /**
     * Get the time at which this client was created. The value is represented
     * as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return integer|string
     *     The time at which this client was created.
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set the time at which this client was created. The value is represented
     * as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @param integer|string $createdAt
     *     The time at which this client was created.
     *
     * @return Client
     *     `$this` object.
     */
    public function setCreatedAt($createdAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$createdAt', $createdAt);

        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * Get the time at which this client was last modified. The value is
     * represented as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return integer|string
     *     The time at which this client was last modified.
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }


    /**
     * Set the time at which this client was last modified. The value is
     * represented as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @param integer|string $modifiedAt
     *     The time at which this client was last modified.
     *
     * @return Client
     *     `$this` object.
     */
    public function setModifiedAt($modifiedAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$modifiedAt', $modifiedAt);

        $this->modifiedAt = $modifiedAt;

        return $this;
    }


    /**
     * Get the extended information about this client application.
     *
     * @return ClientExtension
     *     The extended information about this client application.
     */
    public function getExtension()
    {
        return $this->extension;
    }


    /**
     * Set the extended information about this client application.
     *
     * @param ClientExtension $extension
     *     The extended information about this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setExtension(ClientExtension $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }


    /**
     * Get the string representation of the expected subject distinguished
     * name of the certificate this client will use in mutual TLS
     * authentication.
     *
     * See the description about `tls_client_auth_subject_dn` written in
     * _"Mutual TLS Profile for OAuth Clients"_ for details.
     *
     * @return string
     *     The expected subject distinguished name.
     */
    public function getTlsClientAuthSubjectDn()
    {
        return $this->tlsClientAuthSubjectDn;
    }


    /**
     * Set the string representation of the expected subject distinguished
     * name of the certificate this client will use in mutual TLS
     * authentication.
     *
     * See the description about `tls_client_auth_subject_dn` written in
     * _"Mutual TLS Profile for OAuth Clients"_ for details.
     *
     * @param string $dn
     *     The expected subject distinguished name.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTlsClientAuthSubjectDn($dn)
    {
        ValidationUtility::ensureNullOrString('$dn', $dn);

        $this->tlsClientAuthSubjectDn = $dn;

        return $this;
    }


    /**
     * Get the string representation of the expected DNS subject alternative
     * name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_dns` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @return string
     *     The expected DNS subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanDns()
    {
        return $this->tlsClientAuthSanDns;
    }


    /**
     * Set the string representation of the expected DNS subject alternative
     * name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_dns` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @param string $dns
     *     The expected DNS subject alternative name.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setTlsClientAuthSanDns($dns)
    {
        ValidationUtility::ensureNullOrString('$dns', $dns);

        $this->tlsClientAuthSanDns = $dns;

        return $this;
    }


    /**
     * Get the string representation of the expected URI subject alternative
     * name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_uri` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @return string
     *     The expected URI subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanUri()
    {
        return $this->tlsClientAuthSanUri;
    }


    /**
     * Set the string representation of the expected URI subject alternative
     * name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_uri` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @param string $uri
     *     The expected URI subject alternative name.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setTlsClientAuthSanUri($uri)
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->tlsClientAuthSanUri = $uri;

        return $this;
    }


    /**
     * Get the string representation of the expected IP address subject
     * alternative name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_ip` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @return string
     *     The expected IP address subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanIp()
    {
        return $this->tlsClientAuthSanIp;
    }


    /**
     * Set the string representation of the expected IP address subject
     * alternative name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_ip` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @param string $ip
     *     The expected IP address subject alternative name.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setTlsClientAuthSanIp($ip)
    {
        ValidationUtility::ensureNullOrString('$ip', $ip);

        $this->tlsClientAuthSanIp = $ip;

        return $this;
    }


    /**
     * Get the string representation of the expected email address subject
     * alternative name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_email` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @return string
     *     The expected email address subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanEmail()
    {
        return $this->tlsClientAuthSanEmail;
    }


    /**
     * Set the string representation of the expected email address subject
     * alternative name of the certificate this client will use in mutual
     * authentication.
     *
     * This property corresponds to `tls_client_auth_san_email` defined in
     * [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @param string $email
     *     The expected email address subject alternative name.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setTlsClientAuthSanEmail($email)
    {
        ValidationUtility::ensureNullOrString('$email', $email);

        $this->tlsClientAuthSanEmail = $email;

        return $this;
    }


    /**
     * Get the flag which indicates whether this client uses
     * "TLS client certificate bound access tokens".
     *
     * If this method returns `true` (and if the service supports
     * "TLS client certificate bound access tokens"), this client must
     * present its client certificate (1) when it makes token requests to
     * the authorization server and (2) when it makes API calls to the
     * resource server.
     *
     * @return boolean
     *     `true` if this client uses "TLS client certificate bound
     *     access tokens".
     *
     * @since 1.4
     */
    public function isTlsClientCertificateBoundAccessTokens()
    {
        return $this->tlsClientCertificateBoundAccessTokens;
    }


    /**
     * Set the flag which indicates whether this client uses
     * "TLS client certificate bound access tokens".
     *
     * If `true` is set to this property (and if the service supports
     * "TLS client certificate bound access tokens"), this client must
     * present its client certificate (1) when it makes token requests to
     * the authorization server and (2) when it makes API calls to the
     * resource server.
     *
     * @param boolean $use
     *     `true` to declare that this client uses "TLS client certificate
     *     bound access tokens".
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.4
     */
    public function setTlsClientCertificateBoundAccessTokens($use)
    {
        ValidationUtility::ensureBoolean('$use', $use);

        $this->tlsClientCertificateBoundAccessTokens = $use;

        return $this;
    }


    /**
     * Get the key ID of the JWK which contains a self-signed certificate.
     *
     * @return string
     *     The key ID of the JWK which contains a self-signed certificate.
     *
     * @since 1.5
     */
    public function getSelfSignedCertificateKeyId()
    {
        return $this->selfSignedCertificateKeyId;
    }


    /**
     * Set the key ID of the JWK which contains a self-signed certificate.
     *
     * @param string $keyId
     *     The key ID of the JWK which contains a self-signed certificate.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.5
     */
    public function setSelfSignedCertificateKeyId($keyId)
    {
        ValidationUtility::ensureNullOrString('$keyId', $keyId);

        $this->selfSignedCertificateKeyId = $keyId;

        return $this;
    }


    /**
     * Get the unique identifier string assigned by the client developer or
     * software publisher used by registration endpoints to identify the client
     * software to be dynamically registered.
     *
     * This property corresponds to the `software_id` metadata defined in
     * [2. Client Metadata](https://tools.ietf.org/html/rfc7591#section-2) of
     * [RFC 7591](https://tools.ietf.org/html/rfc7591) (OAuth 2.0 Dynamic
     * Client Registration Protocol).
     *
     * @return Client
     *     The unique identifier of the client software.
     *
     * @since 1.7
     */
    public function getSoftwareId()
    {
        return $this->softwareId;
    }


    /**
     * Set the unique identifier string assigned by the client developer or
     * software publisher used by registration endpoints to identify the client
     * software to be dynamically registered.
     *
     * This property corresponds to the `software_id` metadata defined in
     * [2. Client Metadata](https://tools.ietf.org/html/rfc7591#section-2) of
     * [RFC 7591](https://tools.ietf.org/html/rfc7591) (OAuth 2.0 Dynamic
     * Client Registration Protocol).
     *
     * @param string $softwareId
     *     The unique identifier of the client software.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setSoftwareId($softwareId)
    {
        ValidationUtility::ensureNullOrString('$softwareId', $softwareId);

        $this->softwareId = $softwareId;

        return $this;
    }


    /**
     * Get the version identifier string for the client software identified by
     * the software ID.
     *
     * This property corresponds to the `software_version` metadata defined in
     * [2. Client Metadata](https://tools.ietf.org/html/rfc7591#section-2) of
     * [RFC 7591](https://tools.ietf.org/html/rfc7591) (OAuth 2.0 Dynamic
     * Client Registration Protocol).
     *
     * @return string
     *     The version of the client software.
     *
     * @since 1.7
     */
    public function getSoftwareVersion()
    {
        return $this->softwareVersion;
    }


    /**
     * Set the version identifier string for the client software identified by
     * the software ID.
     *
     * This property corresponds to the `software_version` metadata defined in
     * [2. Client Metadata](https://tools.ietf.org/html/rfc7591#section-2) of
     * [RFC 7591](https://tools.ietf.org/html/rfc7591) (OAuth 2.0 Dynamic
     * Client Registration Protocol).
     *
     * @param string $version
     *     The version of the client software.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setSoftwareVersion($version)
    {
        ValidationUtility::ensureNullOrString('$version', $version);

        $this->softwareVersion = $version;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing authorization responses.
     *
     * This corresponds to the `authorization_signed_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @return JWSAlg
     *     The JWS "alg" algorithm for signing authorization responses.
     *
     * @since 1.7
     */
    public function getAuthorizationSignAlg()
    {
        return $this->authorizationSignAlg;
    }


    /**
     * Set the JWS "alg" algorithm for signing authorization responses.
     *
     * This corresponds to the `authorization_signed_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @param JWSAlg $alg
     *     The JWS "alg" algorithm for signing authorization responses.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationSignAlg(JWSAlg $alg = null)
    {
        $this->authorizationSignAlg = $alg;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @return JWEAlg
     *     The JWE "alg" algorithm for encrypting authorization responses.
     *
     * @since 1.7
     */
    public function getAuthorizationEncryptionAlg()
    {
        return $this->authorizationEncryptionAlg;
    }


    /**
     * Set the JWE "alg" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @param JWEAlg $alg
     *     The JWE "alg" algorithm for encrypting authorization responses.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationEncryptionAlg(JWEAlg $alg = null)
    {
        $this->authorizationEncryptionAlg = $alg;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_enc` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @return JWEEnc
     *     The JWE "enc" algorithm for encrypting authorization responses.
     *
     * @since 1.7
     */
    public function getAuthorizationEncryptionEnc()
    {
        return $this->authorizationEncryptionEnc;
    }


    /**
     * Set the JWE "enc" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_enc` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @param JWEEnc $enc
     *     The JWE "enc" algorithm for encrypting authorization responses.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationEncryptionEnc(JWEEnc $enc = null)
    {
        $this->authorizationEncryptionEnc = $enc;

        return $this;
    }


    /**
     * Get the backchannel token delivery mode. This property corresponds
     * to the `backchannel_token_delivery_mode` metadata.
     *
     * @return DeliveryMode
     *     The backchannel token delivery mode.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBcDeliveryMode()
    {
        return $this->bcDeliveryMode;
    }


    /**
     * Set the backchannel token delivery mode. This property corresponds
     * to the `backchannel_token_delivery_mode` metadata.
     *
     * @param DeliveryMode $mode
     *     The backchannel token delivery mode.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBcDeliveryMode(DeliveryMode $mode = null)
    {
        $this->bcDeliveryMode = $mode;

        return $this;
    }


    /**
     * Get the backchannel client notification endpoint. This property
     * corresponds to the `backchannel_client_notification_endpoint` metadata.
     *
     * @return string
     *     The backchannel client notification endpoint.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBcNotificationEndpoint()
    {
        return $this->bcNotificationEndpoint;
    }


    /**
     * Set the backchannel client notification endpoint. This property
     * corresponds to the `backchannel_client_notification_endpoint` metadata.
     *
     * @param string $endpoint
     *     The backchannel client notification endpoint.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBcNotificationEndpoint($endpoint)
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->bcNotificationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the signature algorithm of requests to the backchannel
     * authentication endpoint. This property corresponds to the
     * `backchannel_authentication_request_signing_alg` metadata.
     *
     * @return JWSAlg
     *     The signature algorithm of requests to the backchannel
     *     authentication endpoint.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBcRequestSignAlg()
    {
        return $this->bcRequestSignAlg;
    }


    /**
     * Set the signature algorithm of requests to the backchannel
     * authentication endpoint. This property corresponds to the
     * `backchannel_authentication_request_signing_alg` metadata.
     *
     * The specification of CIBA (Client Initiated Backchannel Authentication)
     * allows asymmetric algorithms only.
     *
     * @param JWSAlg $alg
     *     The signature algorithm of requests to the backchannel
     *     authentication endpoint.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBcRequestSignAlg(JWSAlg $alg = null)
    {
        $this->bcRequestSignAlg = $alg;

        return $this;
    }


    /**
     * Get the flag which indicates whether a user code is required when this
     * client makes a backchannel authentication request. This property
     * corresponds to the `backchannel_user_code_parameter` metadata.
     *
     * @return boolean
     *     `true` if a user code is required when this client makes a
     *     backchannel authentication request.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function isBcUserCodeRequired()
    {
        return $this->bcUserCodeRequired;
    }


    /**
     * Set the flag which indicates whether a user code is required when this
     * client makes a backchannel authentication request. This property
     * corresponds to the `backchannel_user_code_parameter` metadata.
     *
     * @param boolean $required
     *     `true` to indicate that a user code is required when this client
     *     makes a backchannel authentication request.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBcUserCodeRequired($required)
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->bcUserCodeRequired = $required;

        return $this;
    }


    /**
     * Get the flag which indicates whether this client has been registered
     * dynamically.
     *
     * @return boolean
     *     `true` if this client has been registered dynamically.
     *
     * @see https://tools.ietf.org/html/rfc7591 OAuth 2.0 Dynamic Client Registration Protocol
     *
     * @since 1.8
     */
    public function isDynamicallyRegistered()
    {
        return $this->dynamicallyRegistered;
    }


    /**
     * Set the flag which indicates whether this client has been registered
     * dynamically.
     *
     * @param boolean $registered
     *     `true` to indicate that this client has been registered dynamically.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7591 OAuth 2.0 Dynamic Client Registration Protocol
     *
     * @since 1.8
     */
    public function setDynamicallyRegistered($registered)
    {
        ValidationUtility::ensureBoolean('$registered', $registered);

        $this->dynamicallyRegistered = $registered;

        return $this;
    }


    /**
     * Get the hash of the registration access token for this client.
     *
     * @return string
     *     The hash of the registration access token for this client.
     *
     * @see https://tools.ietf.org/html/rfc7591 OAuth 2.0 Dynamic Client Registration Protocol
     *
     * @since 1.8
     */
    public function getRegistrationAccessTokenHash()
    {
        return $this->registrationAccessTokenHash;
    }


    /**
     * Set the hash of the registration access token for this client.
     *
     * @param string $hash
     *     The hash of the registration access token for this client.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7591 OAuth 2.0 Dynamic Client Registration Protocol
     *
     * @since 1.8
     */
    public function setRegistrationAccessTokenHash($hash)
    {
        ValidationUtility::ensureNullOrString('$hash', $hash);

        $this->registrationAccessTokenHash = $hash;

        return $this;
    }


    /**
     * Get the data types that this client may use as values of the `type`
     * field in `authorization_details`. This property corresponds to the
     * `authorization_data_types` metadata defined in RAR (OAuth 2.0 Rich
     * Authorization Requests).
     *
     * @return string[]
     *     Data types used in `authorization_details`.
     *
     * @since 1.8
     */
    public function getAuthorizationDataTypes()
    {
        return $this->authorizationDataTypes;
    }


    /**
     * Set the data types that this client may use as values of the `type`
     * field in `authorization_details`. This property corresponds to the
     * `authorization_data_types` metadata defined in RAR (OAuth 2.0 Rich
     * Authorization Requests).
     *
     * @param string[] $types
     *     Data types used in `authorization_details`.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAuthorizationDataTypes(array $types = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$types', $types);

        $this->authorizationDataTypes = $types;

        return $this;
    }


    /**
     * Get the flag which indicates whether this client is required to use PAR
     * (OAuth 2.0 Pushed Authorization Requests). This property corresponds to
     * the `require_pushed_authorization_requests` metadata.
     *
     * @return boolean
     *     `true` if this client is required to use PAR.
     *
     * @since 1.8
     */
    public function isParRequired()
    {
        return $this->parRequired;
    }


    /**
     * Set the flag which indicates whether this client is required to use PAR
     * (OAuth 2.0 Pushed Authorization Requests). This property corresponds to
     * the `require_pushed_authorization_requests` metadata.
     *
     * @param boolean $required
     *     `true` to indicate that this client is required to use PAR.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setParRequired($required)
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->parRequired = $required;

        return $this;
    }


    /**
     * Get the flag which indicates whether authorization requests from this
     * client are always required to utilize a request object by using either
     * `request` or `request_uri` request parameter.
     *
     * If this method returns true and the service's
     * `isTraditionalRequestObjectProcessingApplied()` method returns false,
     * authorization requests from this client are processed as if
     * `require_signed_request_object` client metadata of this client is true.
     * The metadata is defined in JAR (JWT Secured Authorization Request).
     *
     * @return boolean
     *     `true` if authorization requests from this client are always
     *     required to utilize a request object.
     *
     * @since 1.9
     */
    public function isRequestObjectRequired()
    {
        return $this->requestObjectRequired;
    }


    /**
     * Set the flag which indicates whether authorization requests from this
     * client are always required to utilize a request object by using either
     * `request` or `request_uri` request parameter.
     *
     * @param boolean $required
     *     `true` to require that authorization requests from this client
     *     always utilize a request object.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.9
     */
    public function setRequestObjectRequired($required)
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->requestObjectRequired = $required;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyToArray(array &$array)
    {
        $array['developer']                             = $this->developer;
        $array['clientId']                              = $this->clientId;
        $array['clientIdAlias']                         = $this->clientIdAlias;
        $array['clientIdAliasEnabled']                  = $this->clientIdAliasEnabled;
        $array['clientSecret']                          = $this->clientSecret;
        $array['clientType']                            = LanguageUtility::toString($this->clientType);
        $array['redirectUris']                          = $this->redirectUris;
        $array['responseTypes']                         = LanguageUtility::convertArrayToStringArray($this->responseTypes);
        $array['grantTypes']                            = LanguageUtility::convertArrayToStringArray($this->grantTypes);
        $array['applicationType']                       = LanguageUtility::toString($this->applicationType);
        $array['contacts']                              = $this->contacts;
        $array['clientName']                            = $this->clientName;
        $array['clientNames']                           = LanguageUtility::convertArrayOfArrayCopyableToArray($this->clientNames);
        $array['logoUri']                               = $this->logoUri;
        $array['logoUris']                              = LanguageUtility::convertArrayOfArrayCopyableToArray($this->logoUris);
        $array['clientUri']                             = $this->clientUri;
        $array['clientUris']                            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->clientUris);
        $array['policyUri']                             = $this->policyUri;
        $array['policyUris']                            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->policyUris);
        $array['tosUri']                                = $this->tosUri;
        $array['tosUris']                               = LanguageUtility::convertArrayOfArrayCopyableToArray($this->tosUris);
        $array['jwksUri']                               = $this->jwksUri;
        $array['jwks']                                  = $this->jwks;
        $array['derivedSectorIdentifier']               = $this->derivedSectorIdentifier;
        $array['sectorIdentifierUri']                   = $this->sectorIdentifierUri;
        $array['subjectType']                           = LanguageUtility::toString($this->subjectType);
        $array['idTokenSignAlg']                        = LanguageUtility::toString($this->idTokenSignAlg);
        $array['idTokenEncryptionAlg']                  = LanguageUtility::toString($this->idTokenEncryptionAlg);
        $array['idTokenEncryptionEnc']                  = LanguageUtility::toString($this->idTokenEncryptionEnc);
        $array['userInfoSignAlg']                       = LanguageUtility::toString($this->userInfoSignAlg);
        $array['userInfoEncryptionAlg']                 = LanguageUtility::toString($this->userInfoEncryptionAlg);
        $array['userInfoEncryptionEnc']                 = LanguageUtility::toString($this->userInfoEncryptionEnc);
        $array['requestSignAlg']                        = LanguageUtility::toString($this->requestSignAlg);
        $array['requestEncryptionAlg']                  = LanguageUtility::toString($this->requestEncryptionAlg);
        $array['requestEncryptionEnc']                  = LanguageUtility::toString($this->requestEncryptionEnc);
        $array['tokenAuthMethod']                       = LanguageUtility::toString($this->tokenAuthMethod);
        $array['tokenAuthSignAlg']                      = LanguageUtility::toString($this->tokenAuthSignAlg);
        $array['defaultMaxAge']                         = LanguageUtility::orZero($this->defaultMaxAge);
        $array['authTimeRequired']                      = $this->authTimeRequired;
        $array['defaultAcrs']                           = $this->defaultAcrs;
        $array['loginUri']                              = $this->loginUri;
        $array['requestUris']                           = $this->requestUris;
        $array['description']                           = $this->description;
        $array['descriptions']                          = LanguageUtility::convertArrayOfArrayCopyableToArray($this->descriptions);
        $array['createdAt']                             = LanguageUtility::orZero($this->createdAt);
        $array['modifiedAt']                            = LanguageUtility::orZero($this->modifiedAt);
        $array['extension']                             = LanguageUtility::convertArrayCopyableToArray($this->extension);
        $array['tlsClientAuthSubjectDn']                = $this->tlsClientAuthSubjectDn;
        $array['tlsClientAuthSanDns']                   = $this->tlsClientAuthSanDns;
        $array['tlsClientAuthSanUri']                   = $this->tlsClientAuthSanUri;
        $array['tlsClientAuthSanIp']                    = $this->tlsClientAuthSanIp;
        $array['tlsClientAuthSanEmail']                 = $this->tlsClientAuthSanEmail;
        $array['tlsClientCertificateBoundAccessTokens'] = $this->tlsClientCertificateBoundAccessTokens;
        $array['selfSignedCertificateKeyId']            = $this->selfSignedCertificateKeyId;
        $array['softwareId']                            = $this->softwareId;
        $array['softwareVersion']                       = $this->softwareVersion;
        $array['authorizationSignAlg']                  = LanguageUtility::toString($this->authorizationSignAlg);
        $array['authorizationEncryptionAlg']            = LanguageUtility::toString($this->authorizationEncryptionAlg);
        $array['authorizationEncryptionEnc']            = LanguageUtility::toString($this->authorizationEncryptionEnc);
        $array['bcDeliveryMode']                        = LanguageUtility::toString($this->bcDeliveryMode);
        $array['bcNotificationEndpoint']                = $this->bcNotificationEndpoint;
        $array['bcRequestSignAlg']                      = LanguageUtility::toString($this->bcRequestSignAlg);
        $array['bcUserCodeRequired']                    = $this->bcUserCodeRequired;
        $array['dynamicallyRegistered']                 = $this->dynamicallyRegistered;
        $array['registrationAccessTokenHash']           = $this->registrationAccessTokenHash;
        $array['authorizationDataTypes']                = $this->authorizationDataTypes;
        $array['parRequired']                           = $this->parRequired;
        $array['requestObjectRequired']                 = $this->requestObjectRequired;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array)
    {
        // developer
        $this->setDeveloper(
            LanguageUtility::getFromArray('developer', $array));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // clientIdAlias
        $this->setClientIdAlias(
            LanguageUtility::getFromArray('clientIdAlias', $array));

        // clientIdAliasEnabled
        $this->setClientIdAliasEnabled(
            LanguageUtility::getFromArrayAsBoolean('clientIdAliasEnabled', $array));

        // clientSecret
        $this->setClientSecret(
            LanguageUtility::getFromArray('clientSecret', $array));

        // clientType
        $this->setClientType(
            ClientType::valueOf(
                LanguageUtility::getFromArray('clientType', $array)));

        // redirectUris
        $_redirect_uris = LanguageUtility::getFromArray('redirectUris', $array);
        $this->setRedirectUris($_redirect_uris);

        // responseTypes
        $_response_types = LanguageUtility::getFromArray('responseTypes', $array);
        $_response_types = LanguageUtility::convertArray($_response_types, '\Authlete\Types\ResponseType::valueOf');
        $this->setResponseTypes($_response_types);

        // grantTypes
        $_grant_types = LanguageUtility::getFromArray('grantTypes', $array);
        $_grant_types = LanguageUtility::convertArray($_grant_types, '\Authlete\Types\GrantType::valueOf');
        $this->setGrantTypes($_grant_types);

        // applicationType
        $this->setApplicationType(
            ApplicationType::valueOf(
                LanguageUtility::getFromArray('applicationType', $array)));

        // contacts
        $_contacts = LanguageUtility::getFromArray('contacts', $array);
        $this->setContacts($_contacts);

        // clientName
        $this->setClientName(
            LanguageUtility::getFromArray('clientName', $array));

        // clientNames
        $_client_names = LanguageUtility::getFromArray('clientNames', $array);
        $_client_names = LanguageUtility::convertArrayToArrayOfArrayCopyable($_client_names, __NAMESPACE__ . '\TaggedValue');
        $this->setClientNames($_client_names);

        // logoUri
        $this->setLogoUri(
            LanguageUtility::getFromArray('logoUri', $array));

        // logoUris
        $_logo_uris = LanguageUtility::getFromArray('logoUris', $array);
        $_logo_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable($_logo_uris, __NAMESPACE__ . '\TaggedValue');
        $this->setLogoUris($_logo_uris);

        // clientUri
        $this->setClientUri(
            LanguageUtility::getFromArray('clientUri', $array));

        // clientUris
        $_client_uris = LanguageUtility::getFromArray('clientUris', $array);
        $_client_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable($_client_uris, __NAMESPACE__ . '\TaggedValue');
        $this->setClientUris($_client_uris);

        // policyUri
        $this->setPolicyUri(
            LanguageUtility::getFromArray('policyUri', $array));

        // policyUris
        $_policy_uris = LanguageUtility::getFromArray('policyUris', $array);
        $_policy_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable($_policy_uris, __NAMESPACE__ . '\TaggedValue');
        $this->setPolicyUris($_policy_uris);

        // tosUri
        $this->setTosUri(
            LanguageUtility::getFromArray('tosUri', $array));

        // tosUris
        $_tos_uris = LanguageUtility::getFromArray('tosUris', $array);
        $_tos_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable($_tos_uris, __NAMESPACE__ . '\TaggedValue');
        $this->setTosUris($_tos_uris);

        // jwksUri
        $this->setJwksUri(
            LanguageUtility::getFromArray('jwksUri', $array));

        // jwks
        $this->setJwks(
            LanguageUtility::getFromArray('jwks', $array));

        // derivedSectorIdentifier
        $this->setDerivedSectorIdentifier(
            LanguageUtility::getFromArray('derivedSectorIdentifier', $array));

        // sectorIdentifierUri
        $this->setSectorIdentifierUri(
            LanguageUtility::getFromArray('sectorIdentifierUri', $array));

        // subjectType
        $this->setSubjectType(
            SubjectType::valueOf(
                LanguageUtility::getFromArray('subjectType', $array)));

        // idTokenSignAlg
        $this->setIdTokenSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('idTokenSignAlg', $array)));

        // idTokenEncryptionAlg
        $this->setIdTokenEncryptionAlg(
            JWEAlg::valueOf(
                LanguageUtility::getFromArray('idTokenEncryptionAlg', $array)));

        // idTokenEncryptionEnc
        $this->setIdTokenEncryptionEnc(
            JWEEnc::valueOf(
                LanguageUtility::getFromArray('idTokenEncryptionEnc', $array)));

        // userInfoSignAlg
        $this->setUserInfoSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('userInfoSignAlg', $array)));

        // userInfoEncryptionAlg
        $this->setUserInfoEncryptionAlg(
            JWEAlg::valueOf(
                LanguageUtility::getFromArray('userInfoEncryptionAlg', $array)));

        // userInfoEncryptionEnc
        $this->setUserInfoEncryptionEnc(
            JWEEnc::valueOf(
                LanguageUtility::getFromArray('userInfoEncryptionEnc', $array)));

        // requestSignAlg
        $this->setRequestSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('requestSignAlg', $array)));

        // requestEncryptionAlg
        $this->setRequestEncryptionAlg(
            JWEAlg::valueOf(
                LanguageUtility::getFromArray('requestEncryptionAlg', $array)));

        // requestEncryptionEnc
        $this->setRequestEncryptionEnc(
            JWEEnc::valueOf(
                LanguageUtility::getFromArray('requestEncryptionEnc', $array)));

        // tokenAuthMethod
        $this->setTokenAuthMethod(
            ClientAuthMethod::valueOf(
                LanguageUtility::getFromArray('tokenAuthMethod', $array)));

        // tokenAuthSignAlg
        $this->setTokenAuthSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('tokenAuthSignAlg', $array)));

        // defaultMaxAge
        $this->setDefaultMaxAge(
            LanguageUtility::getFromArray('defaultMaxAge', $array));

        // authTimeRequired
        $this->setAuthTimeRequired(
            LanguageUtility::getFromArrayAsBoolean('authTimeRequired', $array));

        // defaultAcrs
        $_default_acrs = LanguageUtility::getFromArray('defaultAcrs', $array);
        $this->setDefaultAcrs($_default_acrs);

        // loginUri
        $this->setLoginUri(
            LanguageUtility::getFromArray('loginUri', $array));

        // requestUris
        $_request_uris = LanguageUtility::getFromArray('requestUris', $array);
        $this->setRequestUris($_request_uris);

        // description
        $this->setDescription(
            LanguageUtility::getFromArray('description', $array));

        // descriptions
        $_descriptions = LanguageUtility::getFromArray('descriptions', $array);
        $_descriptions = LanguageUtility::convertArrayToArrayOfArrayCopyable($_descriptions, __NAMESPACE__ . '\TaggedValue');
        $this->setDescriptions($_descriptions);

        // createdAt
        $this->setCreatedAt(
            LanguageUtility::getFromArray('createdAt', $array));

        // modifiedAt
        $this->setModifiedAt(
            LanguageUtility::getFromArray('modifiedAt', $array));

        // extension
        $_extension = LanguageUtility::getFromArray('extension', $array);
        $this->setExtension(
            LanguageUtility::convertArrayToArrayCopyable(
                $_extension, __NAMESPACE__ . '\ClientExtension'));

        // tlsClientAuthSubjectDn
        $this->setTlsClientAuthSubjectDn(
            LanguageUtility::getFromArray('tlsClientAuthSubjectDn', $array));

        // tlsClientAuthSanDns
        $this->setTlsClientAuthSanDns(
            LanguageUtility::getFromArray('tlsClientAuthSanDns', $array));

        // tlsClientAuthSanUri
        $this->setTlsClientAuthSanUri(
            LanguageUtility::getFromArray('tlsClientAuthSanUri', $array));

        // tlsClientAuthSanIp
        $this->setTlsClientAuthSanIp(
            LanguageUtility::getFromArray('tlsClientAuthSanIp', $array));

        // tlsClientAuthSanEmail
        $this->setTlsClientAuthSanEmail(
            LanguageUtility::getFromArray('tlsClientAuthSanEmail', $array));

        // tlsClientCertificateBoundAccessTokens
        $this->setTlsClientCertificateBoundAccessTokens(
            LanguageUtility::getFromArrayAsBoolean('tlsClientCertificateBoundAccessTokens', $array));

        // selfSignedCertificateKeyId
        $this->setSelfSignedCertificateKeyId(
            LanguageUtility::getFromArray('selfSignedCertificateKeyId', $array));

        // softwareId
        $this->setSoftwareId(
            LanguageUtility::getFromArray('softwareId', $array));

        // softwareVersion
        $this->setSoftwareVersion(
            LanguageUtility::getFromArray('softwareVersion', $array));

        // authorizationSignAlg
        $this->setAuthorizationSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('authorizationSignAlg', $array)));

        // authorizationEncryptionAlg
        $this->setAuthorizationEncryptionAlg(
            JWEAlg::valueOf(
                LanguageUtility::getFromArray('authorizationEncryptionAlg', $array)));

        // authorizationEncryptionEnc
        $this->setAuthorizationEncryptionEnc(
            JWEEnc::valueOf(
                LanguageUtility::getFromArray('authorizationEncryptionEnc', $array)));

        // bcDeliveryMode
        $this->setBcDeliveryMode(
            DeliveryMode::valueOf(
                LanguageUtility::getFromArray('bcDeliveryMode', $array)));

        // bcNotificationEndpoint
        $this->setBcNotificationEndpoint(
            LanguageUtility::getFromArray('bcNotificationEndpoint', $array));

        // bcRequestSignAlg
        $this->setBcRequestSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('bcRequestSignAlg', $array)));

        // bcUserCodeRequired
        $this->setBcUserCodeRequired(
            LanguageUtility::getFromArrayAsBoolean('bcUserCodeRequired', $array));

        // dynamicallyRegistered
        $this->setDynamicallyRegistered(
            LanguageUtility::getFromArrayAsBoolean('dynamicallyRegistered', $array));

        // registrationAccessTokenHash
        $this->setRegistrationAccessTokenHash(
            LanguageUtility::getFromArray('registrationAccessTokenHash', $array));

        // authorizationDataTypes
        $_authorization_data_types = LanguageUtility::getFromArray('authorizationDataTypes', $array);
        $this->setAuthorizationDataTypes($_authorization_data_types);

        // parRequired
        $this->setParRequired(
            LanguageUtility::getFromArrayAsBoolean('parRequired', $array));

        // requestObjectRequired
        $this->setRequestObjectRequired(
            LanguageUtility::getFromArrayAsBoolean('requestObjectRequired', $array));
    }
}
