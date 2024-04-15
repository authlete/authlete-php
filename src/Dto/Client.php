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


    private ?string $developer                             = null;
    private string|int|null $clientId                      = null;
    private ?string $clientIdAlias                         = null;
    private bool $clientIdAliasEnabled                     = false;
    private ?string $clientSecret                          = null;
    private ?string $clientType                            = null;  //ClientType
    private ?array $redirectUris                           = null;  // array of string
    private ?array $responseTypes                          = null;  // array of \Authlete\Types\ResponseType
    private ?array $grantTypes                             = null;  // array of \Authlete\Types\GrantType
    private ?string $applicationType                       = null;  // ApplicationType
    private ?array $contacts                               = null;  // array of string
    private ?string $clientName                            = null;
    private ?array $clientNames                            = null;  // array of \Authlete\Dto\TaggedValue
    private ?string $logoUri                               = null;
    private ?array $logoUris                               = null;  // array of \Authlete\Dto\TaggedValue
    private ?string $clientUri                             = null;
    private ?array $clientUris                             = null;  // array of \Authlete\Dto\TaggedValue
    private ?string $policyUri                             = null;
    private ?array $policyUris                             = null;  // array of \Authlete\Dto\TaggedValue
    private ?string $tosUri                                = null;
    private ?array $tosUris                                = null;  // array of \Authlete\Dto\TaggedValue
    private ?string $jwksUri                               = null;
    private ?string $jwks                                  = null;
    private ?string $derivedSectorIdentifier               = null;
    private ?string $sectorIdentifierUri                   = null;
    private ?string $subjectType                           = null;  // SubjectType
    private ?string $idTokenSignAlg                        = null;  // JWSAlg
    private ?string $idTokenEncryptionAlg                  = null;  // JWEAlg
    private ?string $userInfoSignAlg                       = null;  // JWEEnc
    private ?string $userInfoEncryptionAlg                 = null;  // JWEAlg
    private ?string $userInfoEncryptionEnc                 = null;  // JWEEnc
    private ?string $requestSignAlg                        = null;  // JWSAlg
    private ?string $requestEncryptionAlg                  = null;  // JWEAlg
    private ?string $requestEncryptionEnc                  = null;  // JWEEnc
    private ?string $tokenAuthMethod                       = null;  // ClientAuthMethod
    private ?string $tokenAuthSignAlg                      = null;  // JWSAlg
    private string|int|null $defaultMaxAge                 = null;
    private bool $authTimeRequired                         = false;
    private ?array $defaultAcrs                            = null;  // array of string
    private ?string $loginUri                              = null;
    private ?array $requestUris                            = null;  // array of string
    private ?string $description                           = null;
    private ?array $descriptions                           = null;  // array of \Authlete\Dto\TaggedValue
    private string|int|null $createdAt                     = null;
    private string|int|null $modifiedAt                    = null;
    private ?ClientExtension $extension                    = null;
    private ?string $tlsClientAuthSubjectDn                = null;
    private ?string $tlsClientAuthSanDns                   = null;
    private ?string $tlsClientAuthSanUri                   = null;
    private ?string $tlsClientAuthSanIp                    = null;
    private ?string $tlsClientAuthSanEmail                 = null;
    private bool $tlsClientCertificateBoundAccessTokens    = false;
    private ?string $selfSignedCertificateKeyId            = null;
    private ?string $softwareId                            = null;
    private ?string $softwareVersion                       = null;
    private ?string $authorizationSignAlg                  = null;  // JWSAlg
    private ?string $authorizationEncryptionAlg            = null;  // JWEAlg
    private ?string $authorizationEncryptionEnc            = null;  // JWEEnc
    private ?string $bcDeliveryMode                  = null;  // DeliveryMode
    private ?string $bcNotificationEndpoint                = null;
    private ?string $bcRequestSignAlg                      = null;  // JWSAlg
    private bool $bcUserCodeRequired                       = false;
    private bool $dynamicallyRegistered                    = false;
    private ?string $registrationAccessTokenHash           = null;
    private ?array $authorizationDataTypes                 = null;  // array of string
    private bool $parRequired                              = false;
    private bool $requestObjectRequired                    = false;
    private ?string $idTokenEncryptionEnc                  = null;  // JWEEnc


    /**
     * Get the unique ID of the developer of this client application.
     *
     * @return string|null
     *     The unique ID of the developer.
     */
    public function getDeveloper(): ?string
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
    public function setDeveloper(mixed $developer): Client
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
     * @return int|string|null
     *     The client ID. (64-bit integer if your PHP system can handle
     *     64-bit integers.)
     */
    public function getClientId(): int|string|null
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
    public function setClientId(mixed $clientId): Client
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
     * @return string|null
     *     The client ID alias.
     */
    public function getClientIdAlias(): ?string
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
    public function setClientIdAlias(mixed $alias): Client
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias is enabled
     * or not.
     *
     * Note that {@link Service Service} class also has
     * `isClientIdAliasEnabled()` method. If the service's
     * `isClientIdAliasEnabled()` method returns `false`, the client ID
     * alias of this client is not recognized even if this client's
     * `isClientIdAliasEnabled()` method returns `true`.
     *
     * @return boolean
     *     `true` if this client's ID alias is enabled.
     */
    public function isClientIdAliasEnabled(): bool
    {
        return $this->clientIdAliasEnabled;
    }


    /**
     * Set the flag which indicates whether the client ID alias is enabled
     * or not.
     *
     * Note that {@link Service Service} class also has
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
    public function setClientIdAliasEnabled(mixed $enabled): Client
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->clientIdAliasEnabled = $enabled;

        return $this;
    }


    /**
     * Get the client secret which is expected to be used as the value of
     * the "client_secret" request parameter of token requests.
     *
     * @return string|null
     *     The client secret.
     */
    public function getClientSecret(): ?string
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
    public function setClientSecret(mixed $secret): Client
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
     * @return ClientType|null The client type.
     *     The client type.
     */
    public function getClientType(): ?ClientType
    {
        return ClientType::valueOf($this->clientType);
    }


    /**
     * Set the client type.
     *
     * The definition of _Client Type_ is described in
     * [2.1. Client Types](https://tools.ietf.org/html/rfc6749#section-2.1)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749).
     *
     * @param ClientType|null $clientType
     *     The client type.
     * @return Client
     */
    public function setClientType(ClientType $clientType = null): Client
    {
        $this->clientType = $clientType->value;

        return $this;
    }


    /**
     * Get the redirect URIs.
     *
     * See [3.1.2. Redirection Endpoint](https://tools.ietf.org/html/rfc6749#section-3.1.2)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749) for details.
     *
     * @return array|null
     *     A string array containing redirect URIs.
     */
    public function getRedirectUris(): ?array
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
    public function setRedirectUris(array $redirectUris = null): Client
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
     * @return string[]|null
     *     An array of \Authlete\Types\ResponseType.
     */
    public function getResponseTypes(): ?array
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
    public function setResponseTypes(array $responseTypes = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$responseTypes','\Authlete\Types\ResponseType', $responseTypes);

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
     * @return string[]|null
     *     An array of \Authlete\Types\GrantType values.
     */
    public function getGrantTypes(): ?array
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
     * @param string[] $grantTypes
     *     An array of \Authlete\Types\GrantType.
     *
     * @return Client
     *     `$this` object.
     */
    public function setGrantTypes(array $grantTypes = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$grantTypes', '\Authlete\Types\GrantType', $grantTypes);

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
     * @return ApplicationType|null
     *     The application type.
     */
    public function getApplicationType(): ?ApplicationType
    {
        return ApplicationType::valueOf($this->applicationType);
    }


    /**
     * Set the application type of this client application.
     *
     * This corresponds to the `application_type` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param ApplicationType|null $applicationType
     *     The application type.
     *
     * @return Client
     *     `$this` object.
     */
    public function setApplicationType(ApplicationType $applicationType = null): Client
    {
        $this->applicationType = $applicationType->value;

        return $this;
    }


    /**
     * Get the email addresses of contacts for this client application.
     *
     * This corresponds to the `contacts` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return array|null
     *     The email addresses of contacts.
     */
    public function getContacts(): ?array
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
    public function setContacts(array $contacts = null): Client
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
     * @return string|null
     *     The client name.
     */
    public function getClientName(): ?string
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
     * @return Client
     *     `$this` object.
     */
    public function setClientName(mixed $clientName): Client
    {
        ValidationUtility::ensureNullOrString('$clientName', $clientName);

        $this->clientName = $clientName;

        return $this;
    }


    /**
     * Get the localized names of this client application.
     *
     * @return array|null
     *     The localized client names.
     */
    public function getClientNames(): ?array
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
    public function setClientNames(array $clientNames = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$clientNames', __NAMESPACE__ . '\TaggedValue', $clientNames);

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
     * @return string|null
     *     The URI of the logo image of this client application.
     */
    public function getLogoUri(): ?string
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
    public function setLogoUri(mixed $logoUri): Client
    {
        ValidationUtility::ensureNullOrString('$logoUri', $logoUri);

        $this->logoUri = $logoUri;

        return $this;
    }


    /**
     * Get the URIs of localized logo images of this client application.
     *
     * @return array|null
     *     The URIs of localized logo images of this client application.
     */
    public function getLogoUris(): ?array
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
    public function setLogoUris(array $logoUris = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$logoUris', __NAMESPACE__ . '\TaggedValue', $logoUris);

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
     * @return string|null
     *     The URI of the home page of this client application.
     */
    public function getClientUri(): ?string
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
    public function setClientUri(mixed $clientUri): Client
    {
        ValidationUtility::ensureNullOrString('$clientUri', $clientUri);

        $this->clientUri = $clientUri;

        return $this;
    }


    /**
     * Get the URIs of localized home pages of this client application.
     *
     * @return array|null
     *     The URIs of localized home pages of this client application.
     */
    public function getClientUris(): ?array
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
    public function setClientUris(array $clientUris = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$clientUris', __NAMESPACE__ . '\TaggedValue', $clientUris);

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
     * @return string|null
     *     The URI of the policy page.
     */
    public function getPolicyUri(): ?string
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
    public function setPolicyUri(mixed $policyUri): Client
    {
        ValidationUtility::ensureNullOrString('$policyUri', $policyUri);

        $this->policyUri = $policyUri;

        return $this;
    }


    /**
     * Get the URIs of localized policy pages of this client application.
     *
     * @return array|null
     *     The URIs of localized policy pages of this client application.
     */
    public function getPolicyUris(): ?array
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
    public function setPolicyUris(array $policyUris = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$policyUris', __NAMESPACE__ . '\TaggedValue',$policyUris);

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
     * @return string|null
     *     The URI of the "Terms Of Service" page of this client application.
     */
    public function getTosUri(): ?string
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
    public function setTosUri(mixed $tosUri): Client
    {
        ValidationUtility::ensureNullOrString('$tosUri', $tosUri);

        $this->tosUri = $tosUri;

        return $this;
    }


    /**
     * Get the URIs of localized "Terms Of Service" pages of this client
     * application.
     *
     * @return array|null
     *     The URIs of localized "Terms Of Service" pages of this client
     *     application.
     */
    public function getTosUris(): ?array
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
    public function setTosUris(array $tosUris = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$tosUris', __NAMESPACE__ . '\TaggedValue', $tosUris);

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
     * @return string|null
     *     The URI of the JSON Web Key Set of this client application.
     */
    public function getJwksUri(): ?string
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
    public function setJwksUri(mixed $jwksUri): Client
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
     * @return string|null
     *     The JSON Web Key Set of this client application.
     */
    public function getJwks(): ?string
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
    public function setJwks(mixed $jwks): Client
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
     * @return string|null
     *     The derived sector identifier, if available, or null otherwise.
     *
     * @since 1.8
     */
    public function getDerivedSectorIdentifier(): ?string
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
    public function setDerivedSectorIdentifier(mixed $identifier): Client
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
     * @return string|null
     *     The sector identifier URI.
     */
    public function getSectorIdentifierUri(): ?string
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
    public function setSectorIdentifierUri(mixed $uri): Client
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
     * @return SubjectType|null
     *     The subject type.
     */
    public function getSubjectType(): ?SubjectType
    {
        return SubjectType::valueOf($this->subjectType);
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
     * @param SubjectType|null $subjectType
     *     The subject type.
     *
     * @return Client
     *     `$this` object.
     */
    public function setSubjectType(SubjectType $subjectType = null): Client
    {
        $this->subjectType = $subjectType->value;

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
     * @return JWSAlg|null
     *     The JWS "alg" algorithm for signing ID tokens.
     */
    public function getIdTokenSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->idTokenSignAlg);
    }


    /**
     * Set the JWS "alg" algorithm for signing ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg|null $idTokenSignAlg
     *     The JWS "alg" algorithm for signing ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setIdTokenSignAlg(JWSAlg $idTokenSignAlg = null): Client
    {
        $this->idTokenSignAlg = $idTokenSignAlg->value;

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
     * @return JWEAlg|null
     *     The JWE "alg" algorithm for encrypting ID tokens.
     */
    public function getIdTokenEncryptionAlg(): ?JWEAlg
    {
        return JWEAlg::valueOf($this->idTokenEncryptionAlg);
    }


    /**
     * Set the JWE "alg" algorithm for encrypting ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEAlg|null $idTokenEncryptionAlg
     *     The JWE "alg" algorithm for encrypting ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setIdTokenEncryptionAlg(JWEAlg $idTokenEncryptionAlg = null): Client
    {
        $this->idTokenEncryptionAlg = $idTokenEncryptionAlg->value;

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
     * @return JWEEnc|null
     *     The JWE "enc" algorithm for encrypting ID tokens.
     */
    public function getIdTokenEncryptionEnc(): ?JWEEnc
    {
        return JWEEnc::valueOf($this->idTokenEncryptionEnc);
    }


    /**
     * Set the JWE "enc" algorithm for encrypting ID tokens issued to this
     * client application.
     *
     * This corresponds to the `id_token_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEEnc|null $idTokenEncryptionEnc
     *     The JWE "enc" algorithm for encrypting ID tokens.
     *
     * @return Client
     *     `$this` object.
     */
    public function setIdTokenEncryptionEnc(JWEEnc $idTokenEncryptionEnc = null): Client
    {
        $this->idTokenEncryptionEnc = $idTokenEncryptionEnc->value;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing UserInfo responses.
     *
     * This corresponds to the `userinfo_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWSAlg|null
     *     The JWS "alg" algorithm for signing UserInfo responses.
     */
    public function getUserInfoSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->userInfoSignAlg);
    }


    /**
     * Set the JWS "alg" algorithm for signing UserInfo responses.
     *
     * This corresponds to the `userinfo_signed_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg|null $userInfoSignAlg
     *     The JWS "alg" algorithm for signing UserInfo responses.
     *
     * @return Client
     *     `$this` object.
     */
    public function setUserInfoSignAlg(JWSAlg $userInfoSignAlg = null): Client
    {
        $this->userInfoSignAlg = $userInfoSignAlg->value;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEAlg|null
     *     The JWE "alg" algorithm for encrypting UserInfo responses.
     */
    public function getUserInfoEncryptionAlg(): ?JWEAlg
    {
        return JWEAlg::valueOf($this->userInfoEncryptionAlg);
    }


    /**
     * Set the JWE "alg" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEAlg|null $userInfoEncryptionAlg
     *     The JWE "alg" algorithm for encrypting UserInfo responses.
     *
     * @return Client
     *     `$this` object.
     */
    public function setUserInfoEncryptionAlg(JWEAlg $userInfoEncryptionAlg = null): Client
    {
        $this->userInfoEncryptionAlg = $userInfoEncryptionAlg->value;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEEnc|null
     *     The JWE "enc" algorithm for encrypting UserInfo responses.
     */
    public function getUserInfoEncryptionEnc(): ?JWEEnc
    {
        return JWEEnc::valueOf($this->userInfoEncryptionEnc);
    }


    /**
     * Set the JWE "enc" algorithm for encrypting UserInfo responses.
     *
     * This corresponds to the `userinfo_encrypted_response_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEEnc|null $userInfoEncryptionEnc
     *     The JWE "enc" algorithm for encrypting UserInfo responses.
     *
     * @return Client
     *     `$this` object.
     */
    public function setUserInfoEncryptionEnc(JWEEnc $userInfoEncryptionEnc = null): Client
    {
        $this->userInfoEncryptionEnc = $userInfoEncryptionEnc->value;

        return $this;
    }


    /**
     * Get the JWS "alg" algorithm for signing request objects.
     *
     * This corresponds to the `request_object_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWSAlg|null
     *     The JWS "alg" algorithm for signing request objects.
     */
    public function getRequestSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->requestSignAlg);
    }


    /**
     * Set the JWS "alg" algorithm for signing request objects.
     *
     * This corresponds to the `request_object_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg|null $requestSignAlg
     *     The JWS "alg" algorithm for signing request objects.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestSignAlg(JWSAlg $requestSignAlg = null): Client
    {
        $this->requestSignAlg = $requestSignAlg->value;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEAlg|null
     *     The JWE "alg" algorithm for encrypting request objects.
     */
    public function getRequestEncryptionAlg(): ?JWEAlg
    {
        return JWEAlg::valueOf($this->requestEncryptionAlg);
    }


    /**
     * Set the JWE "alg" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEAlg|null $requestEncryptionAlg
     *     The JWE "alg" algorithm for encrypting request objects.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestEncryptionAlg(JWEAlg $requestEncryptionAlg = null): Client
    {
        $this->requestEncryptionAlg = $requestEncryptionAlg->value;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return JWEEnc|null
     *     The JWE "enc" algorithm for encrypting request objects.
     */
    public function getRequestEncryptionEnc(): ?JWEEnc
    {
        return JWEEnc::valueOf($this->requestEncryptionEnc);
    }


    /**
     * Set the JWE "enc" algorithm for encrypting request objects.
     *
     * This corresponds to the `request_object_encryption_enc` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWEEnc|null $requestEncryptionEnc
     *     The JWE "enc" algorithm for encrypting request objects.
     *
     * @return Client
     *     `$this` object.
     */
    public function setRequestEncryptionEnc(JWEEnc $requestEncryptionEnc = null): Client
    {
        $this->requestEncryptionEnc = $requestEncryptionEnc->value;

        return $this;
    }


    /**
     * Get the client authentication method for the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_method` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return ClientAuthMethod|null
     *     The client authentication method for the token endpoint.
     */
    public function getTokenAuthMethod(): ?ClientAuthMethod
    {
        return ClientAuthMethod::valueOf($this->tokenAuthMethod);
    }


    /**
     * Set the client authentication method for the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_method` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param ClientAuthMethod|null $tokenAuthMethod
     *     The client authentication method for the token endpoint.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTokenAuthMethod(ClientAuthMethod $tokenAuthMethod = null): Client
    {
        $this->tokenAuthMethod = $tokenAuthMethod->value;

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
     * @return JWSAlg|null
     *     The JWS "alg" algorithm for signing the JWT used to authenticate
     *     the client at the token endpoint.
     */
    public function getTokenAuthSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->tokenAuthSignAlg);
    }


    /**
     * Set the JWS "alg" algorithm for signing the JWT used to authenticate
     * the client at the token endpoint.
     *
     * This corresponds to the `token_endpoint_auth_signing_alg` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @param JWSAlg|null $tokenAuthSignAlg
     *     The JWS "alg" algorithm for signing the JWT used to authenticate
     *     the client at the token endpoint.
     *
     * @return Client
     *     `$this` object.
     */
    public function setTokenAuthSignAlg(JWSAlg $tokenAuthSignAlg = null): Client
    {
        $this->tokenAuthSignAlg = $tokenAuthSignAlg->value;

        return $this;
    }


    /**
     * Get the default value of the maximum authentication age in seconds.
     *
     * This corresponds to the `default_max_age` metadata defined in
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return int|string|null
     *     The default max age in seconds.
     */
    public function getDefaultMaxAge(): int|string|null
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
    public function setDefaultMaxAge(mixed $defaultMaxAge): Client
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
    public function isAuthTimeRequired(): bool
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
    public function setAuthTimeRequired(mixed $required): Client
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
     * @return array|null
     *     The default list of Authentication Context Class References.
     */
    public function getDefaultAcrs(): ?array
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
    public function setDefaultAcrs(array $defaultAcrs = null): Client
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
     * @return string|null
     *     The URL that can initiate a login for this client application.
     */
    public function getLoginUri(): ?string
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
    public function setLoginUri(mixed $loginUri): Client
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
     * @return array|null
     *     The request URIs.
     */
    public function getRequestUris(): ?array
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
    public function setRequestUris(array $requestUris = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfString('$requestUris', $requestUris);

        $this->requestUris = $requestUris;

        return $this;
    }


    /**
     * Get the description about this client application.
     *
     * @return string|null
     *     The description about this client application.
     */
    public function getDescription(): ?string
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
    public function setDescription(mixed $description): Client
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->description = $description;

        return $this;
    }


    /**
     * Get the localized descriptions about this client application.
     *
     * @return array|null
     *     The localized descriptions about this client application.
     */
    public function getDescriptions(): ?array
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
    public function setDescriptions(array $descriptions = null): Client
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$descriptions', __NAMESPACE__ . '\TaggedValue', $descriptions);

        $this->descriptions = $descriptions;

        return $this;
    }


    /**
     * Get the time at which this client was created. The value is represented
     * as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return int|string|null
     *     The time at which this client was created.
     */
    public function getCreatedAt(): int|string|null
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
    public function setCreatedAt(mixed $createdAt): Client
    {
        ValidationUtility::ensureNullOrStringOrInteger('$createdAt', $createdAt);

        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * Get the time at which this client was last modified. The value is
     * represented as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return int|string|null
     *     The time at which this client was last modified.
     */
    public function getModifiedAt(): int|string|null
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
    public function setModifiedAt(mixed $modifiedAt): Client
    {
        ValidationUtility::ensureNullOrStringOrInteger('$modifiedAt', $modifiedAt);

        $this->modifiedAt = $modifiedAt;

        return $this;
    }


    /**
     * Get the extended information about this client application.
     *
     * @return ClientExtension|null
     *     The extended information about this client application.
     */
    public function getExtension(): ?ClientExtension
    {
        return $this->extension;
    }


    /**
     * Set the extended information about this client application.
     *
     * @param ClientExtension|null $extension
     *     The extended information about this client application.
     *
     * @return Client
     *     `$this` object.
     */
    public function setExtension(ClientExtension $extension = null): Client
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
     * @return string|null
     *     The expected subject distinguished name.
     */
    public function getTlsClientAuthSubjectDn(): ?string
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
    public function setTlsClientAuthSubjectDn(mixed $dn): Client
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
     * @return string|null
     *     The expected DNS subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanDns(): ?string
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
    public function setTlsClientAuthSanDns(mixed $dns): Client
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
     * @return string|null
     *     The expected URI subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanUri(): ?string
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
    public function setTlsClientAuthSanUri(mixed $uri): Client
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
     * @return string|null
     *     The expected IP address subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanIp(): ?string
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
    public function setTlsClientAuthSanIp(mixed $ip): Client
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
     * @return string|null
     *     The expected email address subject alternative name.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getTlsClientAuthSanEmail(): ?string
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
    public function setTlsClientAuthSanEmail(mixed $email): Client
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
    public function isTlsClientCertificateBoundAccessTokens(): bool
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
    public function setTlsClientCertificateBoundAccessTokens(mixed $use): Client
    {
        ValidationUtility::ensureBoolean('$use', $use);

        $this->tlsClientCertificateBoundAccessTokens = $use;

        return $this;
    }


    /**
     * Get the key ID of the JWK which contains a self-signed certificate.
     *
     * @return string|null
     *     The key ID of the JWK which contains a self-signed certificate.
     *
     * @since 1.5
     */
    public function getSelfSignedCertificateKeyId(): ?string
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
    public function setSelfSignedCertificateKeyId(mixed $keyId): Client
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
     * @return string|null
     *     The unique identifier of the client software.
     *
     * @since 1.7
     */
    public function getSoftwareId(): ?string
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
    public function setSoftwareId(mixed $softwareId): Client
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
     * @return string|null
     *     The version of the client software.
     *
     * @since 1.7
     */
    public function getSoftwareVersion(): ?string
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
    public function setSoftwareVersion(mixed $version): Client
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
     * @return JWSAlg|null
     *     The JWS "alg" algorithm for signing authorization responses.
     *
     * @since 1.7
     */
    public function getAuthorizationSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->authorizationSignAlg);
    }


    /**
     * Set the JWS "alg" algorithm for signing authorization responses.
     *
     * This corresponds to the `authorization_signed_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @param JWSAlg|null $alg
     *     The JWS "alg" algorithm for signing authorization responses.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationSignAlg(JWSAlg $alg = null): Client
    {
        $this->authorizationSignAlg = $alg->value;

        return $this;
    }


    /**
     * Get the JWE "alg" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @return JWEAlg|null
     *     The JWE "alg" algorithm for encrypting authorization responses.
     *
     * @since 1.7
     */
    public function getAuthorizationEncryptionAlg(): ?JWEAlg
    {
        return JWEAlg::valueOf($this->authorizationEncryptionAlg);
    }


    /**
     * Set the JWE "alg" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_alg` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @param JWEAlg|null $alg
     *     The JWE "alg" algorithm for encrypting authorization responses.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationEncryptionAlg(JWEAlg $alg = null): Client
    {
        $this->authorizationEncryptionAlg = $alg->value;

        return $this;
    }


    /**
     * Get the JWE "enc" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_enc` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @return JWEEnc|null
     *     The JWE "enc" algorithm for encrypting authorization responses.
     *
     * @since 1.7
     */
    public function getAuthorizationEncryptionEnc(): ?JWEEnc
    {
        return JWEEnc::valueOf($this->authorizationEncryptionEnc);
    }


    /**
     * Set the JWE "enc" algorithm for encrypting authorization responses.
     *
     * This corresponds to the `authorization_encrypted_response_enc` in
     * [5. Client Metadata](https://openid.net/specs/openid-financial-api-jarm.html#client-metadata)
     * of [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html).
     *
     * @param JWEEnc|null $enc
     *     The JWE "enc" algorithm for encrypting authorization responses.
     *
     * @return Client
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationEncryptionEnc(JWEEnc $enc = null): Client
    {
        $this->authorizationEncryptionEnc = $enc->value;

        return $this;
    }


    /**
     * Get the backchannel token delivery mode. This property corresponds
     * to the `backchannel_token_delivery_mode` metadata.
     *
     * @return DeliveryMode|null
     *     The backchannel token delivery mode.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBcDeliveryMode(): ?DeliveryMode
    {
        return DeliveryMode::valueOf($this->bcDeliveryMode);
    }


    /**
     * Set the backchannel token delivery mode. This property corresponds
     * to the `backchannel_token_delivery_mode` metadata.
     *
     * @param DeliveryMode|null $mode
     *     The backchannel token delivery mode.
     *
     * @return Client
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBcDeliveryMode(DeliveryMode $mode = null): Client
    {
        $this->bcDeliveryMode = $mode->value;

        return $this;
    }


    /**
     * Get the backchannel client notification endpoint. This property
     * corresponds to the `backchannel_client_notification_endpoint` metadata.
     *
     * @return string|null
     *     The backchannel client notification endpoint.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBcNotificationEndpoint(): ?string
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
    public function setBcNotificationEndpoint(mixed $endpoint): Client
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
     * @return JWSAlg|null
     *     The signature algorithm of requests to the backchannel
     *     authentication endpoint.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBcRequestSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->bcRequestSignAlg);
    }


    /**
     * Set the signature algorithm of requests to the backchannel
     * authentication endpoint. This property corresponds to the
     * `backchannel_authentication_request_signing_alg` metadata.
     *
     * The specification of CIBA (Client Initiated Backchannel Authentication)
     * allows asymmetric algorithms only.
     *
     * @param JWSAlg|null $alg
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
    public function setBcRequestSignAlg(JWSAlg $alg = null): Client
    {
        $this->bcRequestSignAlg = $alg->value;

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
    public function isBcUserCodeRequired(): bool
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
    public function setBcUserCodeRequired(mixed $required): Client
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
    public function isDynamicallyRegistered(): bool
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
    public function setDynamicallyRegistered(mixed $registered): Client
    {
        ValidationUtility::ensureBoolean('$registered', $registered);

        $this->dynamicallyRegistered = $registered;

        return $this;
    }


    /**
     * Get the hash of the registration access token for this client.
     *
     * @return string|null
     *     The hash of the registration access token for this client.
     *
     * @see https://tools.ietf.org/html/rfc7591 OAuth 2.0 Dynamic Client Registration Protocol
     *
     * @since 1.8
     */
    public function getRegistrationAccessTokenHash(): ?string
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
    public function setRegistrationAccessTokenHash(mixed $hash): Client
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
     * @return array|null
     *     Data types used in `authorization_details`.
     *
     * @since 1.8
     */
    public function getAuthorizationDataTypes(): ?array
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
    public function setAuthorizationDataTypes(?array $types = null): Client
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
    public function isParRequired(): bool
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
    public function setParRequired(mixed $required): Client
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
    public function isRequestObjectRequired(): bool
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
    public function setRequestObjectRequired(mixed $required): Client
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
    public function copyToArray(array &$array): void
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
    public function copyFromArray(array &$array): void
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
        $_response_types = LanguageUtility::convertArray('\Authlete\Types\ResponseType::valueOf', $_response_types);
        $this->setResponseTypes($_response_types);

        // grantTypes
        $_grant_types = LanguageUtility::getFromArray('grantTypes', $array);
        $_grant_types = LanguageUtility::convertArray('\Authlete\Types\GrantType::valueOf',$_grant_types);
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
        $_client_names = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_client_names);
        $this->setClientNames($_client_names);

        // logoUri
        $this->setLogoUri(
            LanguageUtility::getFromArray('logoUri', $array));

        // logoUris
        $_logo_uris = LanguageUtility::getFromArray('logoUris', $array);
        $_logo_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_logo_uris);
        $this->setLogoUris($_logo_uris);

        // clientUri
        $this->setClientUri(
            LanguageUtility::getFromArray('clientUri', $array));

        // clientUris
        $_client_uris = LanguageUtility::getFromArray('clientUris', $array);
        $_client_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_client_uris);
        $this->setClientUris($_client_uris);

        // policyUri
        $this->setPolicyUri(
            LanguageUtility::getFromArray('policyUri', $array));

        // policyUris
        $_policy_uris = LanguageUtility::getFromArray('policyUris', $array);
        $_policy_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_policy_uris);
        $this->setPolicyUris($_policy_uris);

        // tosUri
        $this->setTosUri(
            LanguageUtility::getFromArray('tosUri', $array));

        // tosUris
        $_tos_uris = LanguageUtility::getFromArray('tosUris', $array);
        $_tos_uris = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_tos_uris);
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
        $_descriptions = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_descriptions);
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
                __NAMESPACE__ . '\ClientExtension', $_extension));

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
