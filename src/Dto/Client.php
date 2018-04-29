<?php
//
// Copyright (C) 2018 Authlete, Inc.
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
use Authlete\Types\ArrayCopyable;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\ClientType;
use Authlete\Types\GrantType;
use Authlete\Types\Jsonable;
use Authlete\Types\JWEAlg;
use Authlete\Types\JWEEnc;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\SubjectType;
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
class Client implements ArrayCopyable, Jsonable
{
    use JsonTrait;


    private $developer              = null;  // string
    private $clientId               = null;  // string or (64-bit) integer
    private $clientIdAlias          = null;  // string
    private $clientIdAliasEnabled   = false; // boolean
    private $clientSecret           = null;  // string
    private $clientType             = null;  // \Authlete\Types\ClientType
    private $redirectUris           = null;  // array of string
    private $responseTypes          = null;  // array of \Authlete\Types\ResponseType
    private $grantTypes             = null;  // array of \Authlete\Types\GrantType
    private $applicationType        = null;  // \Authlete\Types\ApplicationType
    private $contacts               = null;  // array of string
    private $clientName             = null;  // string
    private $clientNames            = null;  // array of \Authlete\Dto\TaggedValue
    private $logoUri                = null;  // string
    private $logoUris               = null;  // array of \Authlete\Dto\TaggedValue
    private $clientUri              = null;  // string
    private $clientUris             = null;  // array of \Authlete\Dto\TaggedValue
    private $policyUri              = null;  // string
    private $policyUris             = null;  // array of \Authlete\Dto\TaggedValue
    private $tosUri                 = null;  // string
    private $tosUris                = null;  // array of \Authlete\Dto\TaggedValue
    private $jwksUri                = null;  // string
    private $jwks                   = null;  // string
    private $sectorIdentifier       = null;  // string
    private $subjectType            = null;  // \Authlete\Types\SubjectType
    private $idTokenSignAlg         = null;  // \Authlete\Types\JWSAlg
    private $idTokenEncryptionAlg   = null;  // \Authlete\Types\JWEAlg
    private $idTokenEncryptionEnc   = null;  // \Authlete\Types\JWEEnc
    private $userInfoSignAlg        = null;  // \Authlete\Types\JWSAlg
    private $userInfoEncryptionAlg  = null;  // \Authlete\Types\JWEAlg
    private $userInfoEncryptionEnc  = null;  // \Authlete\Types\JWEEnc
    private $requestSignAlg         = null;  // \Authlete\Types\JWSAlg
    private $requestEncryptionAlg   = null;  // \Authlete\Types\JWEAlg
    private $requestEncryptionEnc   = null;  // \Authlete\Types\JWEEnc
    private $tokenAuthMethod        = null;  // \Authlete\Types\ClientAuthMethod
    private $tokenAuthSignAlg       = null;  // \Authlete\Types\JWSAlg
    private $defaultMaxAge          = null;  // string or integer
    private $authTimeRequired       = false; // boolean
    private $defaultAcrs            = null;  // array of string
    private $loginUri               = null;  // string
    private $requestUris            = null;  // array of string
    private $description            = null;  // string
    private $descriptions           = null;  // array of \Authlete\Dto\TaggedValue
    private $createdAt              = null;  // string or (64-bit) integer
    private $modifiedAt             = null;  // string or (64-bit) integer
    private $extension              = null;  // \Authlete\Dto\ClientExtension
    private $tlsClientAuthSubjectDn = null;  // string
    private $mutualTlsSenderConstrainedAccessTokens = false; // boolean


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
        return $this->sectorIdentifier;
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
     * @param string $sectorIdentifierUri
     *     The sector identifier URI.
     *
     * @return Client
     *     `$this` object.
     */
    public function setSectorIdentifierUri($sectorIdentifierUri)
    {
        ValidationUtility::ensureNullOrString('$sectorIdentifierUri', $sectorIdentifierUri);

        $this->sectorIdentifier = $sectorIdentifierUri;

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
     * Get the flag which indicates whether this client uses
     * "Mutual TLS sender constrained access tokens".
     *
     * If this method returns `true` (and if the service supports
     * "Mutual Tls sender constrained access tokens"), this client must
     * present its client certificate (1) when it makes token requests to
     * the authorization server and (2) when it makes API calls to the
     * resource server.
     *
     * @return boolean
     *     `true` if this client uses "Mutual TLS sender constrained
     *     access tokens".
     */
    public function isMutualTlsSenderConstrainedAccessTokens()
    {
        return $this->clientIdAliasEnabled;
    }


    /**
     * Set the flag which indicates whether this client uses
     * "Mutual TLS sender constrained access tokens".
     *
     * If `true` is set to this property (and if the service supports
     * "Mutual Tls sender constrained access tokens"), this client must
     * present its client certificate (1) when it makes token requests to
     * the authorization server and (2) when it makes API calls to the
     * resource server.
     *
     * @param boolean $use
     *     `true` to declare that this client uses "Mutual TLS sender
     *     constrained access tokens".
     *
     * @return Client
     *     `$this` object.
     */
    public function setMutualTlsSenderConstrainedAccessTokens($use)
    {
        ValidationUtility::ensureBoolean('$use', $use);

        $this->mutualTlsSenderConstrainedAccessTokens = $use;

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
        $array['developer']              = $this->developer;
        $array['clientId']               = $this->clientId;
        $array['clientIdAlias']          = $this->clientIdAlias;
        $array['clientIdAliasEnabled']   = $this->clientIdAliasEnabled;
        $array['clientSecret']           = $this->clientSecret;
        $array['clientType']             = LanguageUtility::toString($this->clientType);
        $array['redirectUris']           = $this->redirectUris;
        $array['responseTypes']          = LanguageUtility::convertArrayToStringArray($this->responseTypes);
        $array['grantTypes']             = LanguageUtility::convertArrayToStringArray($this->grantTypes);
        $array['applicationType']        = LanguageUtility::toString($this->applicationType);
        $array['contacts']               = $this->contacts;
        $array['clientName']             = $this->clientName;
        $array['clientNames']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->clientNames);
        $array['logoUri']                = $this->logoUri;
        $array['logoUris']               = LanguageUtility::convertArrayOfArrayCopyableToArray($this->logoUris);
        $array['clientUri']              = $this->clientUri;
        $array['clientUris']             = LanguageUtility::convertArrayOfArrayCopyableToArray($this->clientUris);
        $array['policyUri']              = $this->policyUri;
        $array['policyUris']             = LanguageUtility::convertArrayOfArrayCopyableToArray($this->policyUris);
        $array['tosUri']                 = $this->tosUri;
        $array['tosUris']                = LanguageUtility::convertArrayOfArrayCopyableToArray($this->tosUris);
        $array['jwksUri']                = $this->jwksUri;
        $array['jwks']                   = $this->jwks;
        $array['sectorIdentifier']       = $this->sectorIdentifier;
        $array['subjectType']            = LanguageUtility::toString($this->subjectType);
        $array['idTokenSignAlg']         = LanguageUtility::toString($this->idTokenSignAlg);
        $array['idTokenEncriptionAlg']   = LanguageUtility::toString($this->idTokenEncryptionAlg);
        $array['idTokenEncriptionEnc']   = LanguageUtility::toString($this->idTokenEncryptionEnc);
        $array['userInfoSignAlg']        = LanguageUtility::toString($this->userInfoSignAlg);
        $array['userInfoEncriptionAlg']  = LanguageUtility::toString($this->userInfoEncryptionAlg);
        $array['userInfoEncriptionEnc']  = LanguageUtility::toString($this->userInfoEncryptionEnc);
        $array['requestSignAlg']         = LanguageUtility::toString($this->requestSignAlg);
        $array['requestEncriptionAlg']   = LanguageUtility::toString($this->requestEncryptionAlg);
        $array['requestEncriptionEnc']   = LanguageUtility::toString($this->requestEncryptionEnc);
        $array['tokenAuthSignAlg']       = LanguageUtility::toString($this->tokenAuthSignAlg);
        $array['defaultMaxAge']          = LanguageUtility::orZero($this->defaultMaxAge);
        $array['authTimeRequired']       = $this->authTimeRequired;
        $array['defaultAcrs']            = $this->defaultAcrs;
        $array['loginUri']               = $this->loginUri;
        $array['requestUris']            = $this->requestUris;
        $array['description']            = $this->description;
        $array['descriptions']           = LanguageUtility::convertArrayOfArrayCopyableToArray($this->descriptions);
        $array['createdAt']              = LanguageUtility::orZero($this->createdAt);
        $array['modifiedAt']             = LanguageUtility::orZero($this->modifiedAt);
        $array['extension']              = LanguageUtility::convertArrayCopyableToArray($this->extension);
        $array['tlsClientAuthSubjectDn'] = $this->tlsClientAuthSubjectDn;
        $array['mutualTlsSenderConstrainedAccessTokens'] = $this->mutualTlsSenderConstrainedAccessTokens;
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
        $this->setRedirectUris(
            LanguageUtility::getFromArray('redirectUris', $array));

        // responseTypes
        $responseTypes = LanguageUtility::getFromArray('responseTypes', $array);
        $this->setResponseTypes(
            LanguageUtility::convertArray(
                $responseTypes, '\Authlete\Types\ResponseType::valueOf'));

        // grantTypes
        $grantTypes = LanguageUtility::getFromArray('grantTypes', $array);
        $this->setGrantTypes(
            LanguageUtility::convertArray(
                $grantTypes, '\Authlete\Types\GrantType::valueOf'));

        // applicationType
        $this->setApplicationType(
            ApplicationType::valueOf(
                LanguageUtility::getFromArray('applicationType', $array)));

        // contacts
        $this->setContacts(
            LanguageUtility::getFromArray('contacts', $array));

        // clientName
        $this->setClientName(
            LanguageUtility::getFromArray('clientName', $array));

        // clientNames
        $clientNames = LanguageUtility::getFromArray('clientNames', $array);
        $this->setClientNames(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $clientNames, __NAMESPACE__ . '\TaggedValue'));

        // logoUri
        $this->setLogoUri(
            LanguageUtility::getFromArray('logoUri', $array));

        // logoUris
        $logoUris = LanguageUtility::getFromArray('logoUris', $array);
        $this->setLogoUris(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $logoUris, __NAMESPACE__ . '\TaggedValue'));

        // clientUri
        $this->setClientUri(
            LanguageUtility::getFromArray('clientUri', $array));

        // clientUris
        $clientUris = LanguageUtility::getFromArray('clientUris', $array);
        $this->setClientUris(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $clientUris, __NAMESPACE__ . '\TaggedValue'));

        // policyUri
        $this->setPolicyUri(
            LanguageUtility::getFromArray('policyUri', $array));

        // policyUris
        $policyUris = LanguageUtility::getFromArray('policyUris', $array);
        $this->setPolicyUris(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $policyUris, __NAMESPACE__ . '\TaggedValue'));

        // tosUri
        $this->setTosUri(
            LanguageUtility::getFromArray('tosUri', $array));

        // tosUris
        $tosUris = LanguageUtility::getFromArray('tosUris', $array);
        $this->setTosUris(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $tosUris, __NAMESPACE__ . '\TaggedValue'));

        // jwksUri
        $this->setJwksUri(
            LanguageUtility::getFromArray('jwksUri', $array));

        // jwks
        $this->setJwks(
            LanguageUtility::getFromArray('jwks', $array));

        // sectorIdentifier
        $this->setSectorIdentifierUri(
            LanguageUtility::getFromArray('sectorIdentifier', $array));

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

        // tokenAuthSignAlog
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
        $this->setDefaultAcrs(
            LanguageUtility::getFromArray('defaultAcrs', $array));

        // loginUri
        $this->setLoginUri(
            LanguageUtility::getFromArray('loginUri', $array));

        // requestUris
        $this->setRequestUris(
            LanguageUtility::getFromArray('requestUris', $array));

        // description
        $this->setDescription(
            LanguageUtility::getFromArray('description', $array));

        // descriptions
        $descriptions = LanguageUtility::getFromArray('descriptions', $array);
        $this->setDescriptions(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $descriptions, __NAMESPACE__ . '\TaggedValue'));

        // createdAt
        $this->setCreatedAt(
            LanguageUtility::getFromArray('createdAt', $array));

        // modifiedAt
        $this->setModifiedAt(
            LanguageUtility::getFromArray('modifiedAt', $array));

        // extension
        $extension = LanguageUtility::getFromArray('extension', $array);
        $this->setExtension(
            LanguageUtility::convertArrayToArrayCopyable(
                $extension, __NAMESPACE__ . '\ClientExtension'));

        // tlsClientAuthSubjectDn
        $this->setTlsClientAuthSubjectDn(
            LanguageUtility::getFromArray('tlsClientAuthSubjectDn', $array));

        // mutualTlsSenderConstrainedAccessTokens
        $this->setMutualTlsSenderConstrainedAccessTokens(
            LanguageUtility::getFromArrayAsBoolean('mutualTlsSenderConstrainedAccessTokens', $array));
    }
}