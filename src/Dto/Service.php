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
 * File containing the definition of Service class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\ClaimType;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\DeliveryMode;
use Authlete\Types\Display;
use Authlete\Types\GrantType;
use Authlete\Types\Jsonable;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\ServiceProfile;
use Authlete\Types\Sns;
use Authlete\Types\UserCodeCharset;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Information about a service which represents an authorization server /
 * OpenID provider.
 *
 * Some properties correspond to the ones listed in
 * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
 * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
 */
class Service implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $serviceName                                = null;
    private $apiKey                                             = null;  // string or (64-bit) integer
    private ?string $apiSecret                                  = null;
    private ?string $issuer                                     = null;
    private ?string $authorizationEndpoint                      = null;
    private ?string $tokenEndpoint                              = null;
    private ?string $revocationEndpoint                         = null;
    private ?array $supportedRevocationAuthMethods              = null;  // array of \Authlete\Types\ClientAuthMethod
    private ?string $userInfoEndpoint                           = null;
    private ?string $jwksUri                                    = null;
    private ?string $jwks                                       = null;
    private ?string $registrationEndpoint                       = null;
    private ?string $registrationManagementEndpoint             = null;
    private ?array $supportedScopes                             = null;  // array of \Authlete\Dto\Scope
    private ?array $supportedResponseTypes                      = null;  // array of \Authlete\Types\ResponseType
    private ?array $supportedGrantTypes                         = null;  // array of \Authlete\Types\GrantType
    private ?array $supportedAcrs                               = null;  // array of string
    private ?array $supportedTokenAuthMethods                   = null;  // array of \Authlete\Types\ClientAuthMethod
    private ?array $supportedDisplays                           = null;  // array of \Authlete\Types\Display
    private ?array $supportedClaimTypes                         = null;  // array of \Authlete\Types\ClaimType
    private ?array $supportedClaims                             = null;  // array of string
    private ?string $serviceDocumentation                       = null;
    private ?array $supportedClaimLocales                       = null;  // array of string
    private ?array $supportedUiLocales                          = null;  // array of string
    private ?string $policyUri                                  = null;
    private ?string $tosUri                                     = null;
    private ?string $authenticationCallbackEndpoint             = null;
    private ?string $authenticationCallbackApiKey               = null;
    private ?string $authenticationCallbackApiSecret            = null;
    private ?array $supportedSnses                              = null;  // array of \Authlete\Types\Sns
    private ?array $snsCredentials                              = null;  // array of \Authlete\Dto\SnsCredentials
    private $createdAt                                          = null;  // string or (64-bit) integer
    private $modifiedAt                                         = null;  // string or (64-bit) integer
    private ?string $developerAuthenticationCallbackEndpoint    = null;
    private ?string $developerAuthenticationCallbackApiKey      = null;
    private ?string $developerAuthenticationCallbackApiSecret   = null;
    private ?array $supportedDeveloperSnses                     = null;  // array of \Authlete\Types\Sns
    private ?array $developerSnsCredentials                     = null;  // array of \Authlete\Dto\SnsCredentials
    private int $clientsPerDeveloper                            = 0;
    private bool $directAuthorizationEndpointEnabled            = false;
    private bool $directTokenEndpointEnabled                    = false;
    private bool $directRevocationEndpointEnabled               = false;
    private bool $directUserInfoEndpointEnabled                 = false;
    private bool $directJwksEndpointEnabled                     = false;
    private bool $directIntrospectionEndpointEnabled            = false;
    private bool $singleAccessTokenPerSubject                   = false;
    private bool $pkceRequired                                  = false;
    private bool $pkceS256Required                              = false;
    private bool $refreshTokenKept                              = false;
    private bool $refreshTokenDurationKept                      = false;
    private bool $errorDescriptionOmitted                       = false;
    private bool $errorUriOmitted                               = false;
    private bool $clientIdAliasEnabled                          = false;
    private ?array $supportedServiceProfiles                    = null;  // array of \Authlete\Types\ServiceProfile
    private bool $tlsClientCertificateBoundAccessTokens         = false;
    private ?string $introspectionEndpoint                      = null;
    private ?array $supportedIntrospectionAuthMethods           = null;  // array of \Authlete\Types\ClientAuthMethod
    private bool $mutualTlsValidatePkiCertChain                 = false;
    private ?array $trustedRootCertificates                     = null;
    private bool $dynamicRegistrationSupported                  = false;
    private ?string $endSessionEndpoint                         = null;
    private ?string $description                                = null;
    private ?string $accessTokenType                            = null;
    private ?JWSAlg $accessTokenSignAlg                         = null;  // \Authlete\Types\JWSAlg
    private $accessTokenDuration                                = null;  // string or (64-bit) integer
    private $refreshTokenDuration                               = null;  // string or (64-bit) integer
    private $idTokenDuration                                    = null;  // string or (64-bit) integer
    private $authorizationResponseDuration                      = null;  // string or (64-bit) integer
    private $pushedAuthReqDuration                              = null;  // string or (64-bit) integer
    private ?string $accessTokenSignatureKeyId                  = null;
    private ?string $authorizationSignatureKeyId                = null;
    private ?string $idTokenSignatureKeyId                      = null;
    private ?string $userInfoSignatureKeyId                     = null;
    private ?array $supportedBackchannelTokenDeliveryModes      = null;  // array of \Authlete\Types\DeliveryMode
    private ?string $backchannelAuthenticationEndpoint          = null;
    private bool $backchannelUserCodeParameterSupported         = false;
    private $backchannelAuthReqIdDuration                       = null;  // string or (64-bit) integer
    private int $backchannelPollingInterval                     = 0;
    private bool $backchannelBindingMessageRequiredInFapi       = false;
    private int $allowableClockSkew                             = 0;
    private ?string $deviceAuthorizationEndpoint                = null;
    private ?string $deviceVerificationUri                      = null;
    private ?string $deviceVerificationUriComplete              = null;
    private $deviceFlowCodeDuration                             = null;  // string or (64-bit) integer
    private int $deviceFlowPollingInterval                      = 0;
    private ?UserCodeCharset $userCodeCharset                   = null;
    private int $userCodeLength                                 = 0;
    private ?string $pushedAuthReqEndpoint                      = null;
    private ?array $mtlsEndpointAliases                         = null;  // array of \Authlete\Dto\NamedUri
    private ?array $supportedAuthorizationDataTypes             = null;  // array of string
    private ?array $supportedTrustFrameworks                    = null;  // array of string
    private ?array $supportedEvidence                           = null;  // array of string
    private ?array $supportedIdentityDocuments                  = null;  // array of string
    private ?array $supportedVerificationMethods                = null;  // array of string
    private ?array $supportedVerifiedClaims                     = null;  // array of string
    private bool $missingClientIdAllowed                        = false;
    private bool $parRequired                                   = false;
    private bool $requestObjectRequired                         = false;
    private bool $traditionalRequestObjectProcessingApplied     = false;
    private bool $claimShortcutRestrictive                      = false;
    private bool $scopeRequired                                 = false;
    private bool $nbfOptional                                   = false;
    private bool $issSuppressed                                 = false;


    /**
     * Get the service name.
     *
     * @return string
     *     The service name.
     */
    public function getServiceName(): ?string
    {
        return $this->serviceName;
    }


    /**
     * Set the service name.
     *
     * @param string $serviceName
     *     The service name.
     *
     * @return Service
     *     `$this` object.
     */
    public function setServiceName(string $serviceName): Service
    {
        ValidationUtility::ensureNullOrString('$serviceName', $serviceName);

        $this->serviceName = $serviceName;

        return $this;
    }


    /**
     * Get the API key of this service.
     *
     * @return integer|string
     *     The API key.
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     * Set the API key of this service.
     *
     * @param integer|string $apiKey
     *     The API key.
     *
     * @return Service
     *     `$this` object.
     */
    public function setApiKey($apiKey): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$apiKey', $apiKey);

        $this->apiKey = $apiKey;

        return $this;
    }


    /**
     * Get the API secret of this service.
     *
     * @return string
     *     The API secret.
     */
    public function getApiSecret(): ?string
    {
        return $this->apiSecret;
    }


    /**
     * Set the API secret of this service.
     *
     * @param string $secret
     *     The API secret.
     *
     * @return Service
     *     `$this` object.
     */
    public function setApiSecret(string $secret): Service
    {
        ValidationUtility::ensureNullOrString('$secret', $secret);

        $this->apiSecret = $secret;

        return $this;
    }


    /**
     * Get the issuer identifier of this OpenID provider.
     *
     * This corresponds to the `issuer` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The issuer identifier.
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }


    /**
     * Set the issuer identifier of this OpenID provider.
     *
     * This corresponds to the `issuer` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $issuer
     *     The issuer identifier.
     *
     * @return Service
     *     `$this` object.
     */
    public function setIssuer(string $issuer): Service
    {
        ValidationUtility::ensureNullOrString('$issuer', $issuer);

        $this->issuer = $issuer;

        return $this;
    }


    /**
     * Get the URI of the authorization endpoint.
     *
     * This corresponds to the `authorization_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the authorization endpoint.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.1 RFC 6749, 3.1. Authorization Endpoint
     */
    public function getAuthorizationEndpoint(): ?string
    {
        return $this->authorizationEndpoint;
    }


    /**
     * Set the URI of the authorization endpoint.
     *
     * This corresponds to the `authorization_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $endpoint
     *     The URI of the authorization endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.1 RFC 6749, 3.1. Authorization Endpoint
     */
    public function setAuthorizationEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->authorizationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the URI of the authorization endpoint.
     *
     * This corresponds to the `token_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the token endpoint.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2 RFC 6749, 3.2. Token Endpoint
     */
    public function getTokenEndpoint(): ?string
    {
        return $this->tokenEndpoint;
    }


    /**
     * Set the URI of the authorization endpoint.
     *
     * This corresponds to the `token_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $endpoint
     *     The URI of the token endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2 RFC 6749, 3.2. Token Endpoint
     */
    public function setTokenEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->tokenEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the URI of the revocation endpoint.
     *
     * This corresponds to the `revocation_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the revocation endpoint.
     *
     * @see https://tools.ietf.org/html/rfc7009 RFC 7009 (OAuth 2.0 Token Revocation)
     */
    public function getRevocationEndpoint(): ?string
    {
        return $this->revocationEndpoint;
    }


    /**
     * Set the URI of the revocation endpoint.
     *
     * This corresponds to the `revocation_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $endpoint
     *     The URI of the revocation endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7009 RFC 7009 (OAuth 2.0 Token Revocation)
     */
    public function setRevocationEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->revocationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get client authentication methods at the revocation endpoint
     * supported by this service.
     *
     * This corresponds to the `revocation_endpoint_auth_methods_supported`
     * metadata defined in "OAuth 2.0 Authorization Server Metadata".
     *
     * @return ClientAuthMethod[]
     *     Supported client authentication methods at the revocation endpoint.
     */
    public function getSupportedRevocationAuthMethods(): ?array
    {
        return $this->supportedRevocationAuthMethods;
    }


    /**
     * Set client authentication methods at the revocation endpoint
     * supported by this service.
     *
     * This corresponds to the `revocation_endpoint_auth_methods_supported`
     * metadata defined in "OAuth 2.0 Authorization Server Metadata".
     *
     * @param ClientAuthMethod[] $methods
     *     Supported client authentication methods at the revocation endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedRevocationAuthMethods(array $methods = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$methods', '\Authlete\Types\ClientAuthMethod', $methods);

        $this->supportedRevocationAuthMethods = $methods;

        return $this;
    }


    /**
     * Get the URI of the UserInfo endpoint.
     *
     * This corresponds to the `userinfo_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the UserInfo endpoint.
     *
     * @see https://openid.net/specs/openid-connect-core-1_0.html#UserInfo OpenID Connect Core 1.0, 5.3. UserInfo Endpoint
     */
    public function getUserInfoEndpoint(): ?string
    {
        return $this->userInfoEndpoint;
    }


    /**
     * Set the URI of the UserInfo endpoint.
     *
     * This corresponds to the `userinfo_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $endpoint
     *     The URI of the UserInfo endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-core-1_0.html#UserInfo OpenID Connect Core 1.0, 5.3. UserInfo Endpoint
     */
    public function setUserInfoEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->userInfoEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the URI of the JWK Set document of this service.
     *
     * This corresponds to the `jwks_uri` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the JWK Set document.
     */
    public function getJwksUri(): ?string
    {
        return $this->jwksUri;
    }


    /**
     * Set the URI of the JWK Set document of this service.
     *
     * This corresponds to the `jwks_uri` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $uri
     *     The URI of the JWK Set document.
     *
     * @return Service
     *     `$this` object
     */
    public function setJwksUri(string $uri): Service
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->jwksUri = $uri;

        return $this;
    }


    /**
     * Get the JWK Set document of this service.
     *
     * @return string
     *     The JWK Set document.
     */
    public function getJwks(): ?string
    {
        return $this->jwks;
    }


    /**
     * Set the JWK Set document of this service.
     *
     * @param string $jwks
     *     The JWK Set document.
     *
     * @return Service
     *     `$this` object.
     */
    public function setJwks(string $jwks): Service
    {
        ValidationUtility::ensureNullOrString('$jwks', $jwks);

        $this->jwks = $jwks;

        return $this;
    }


    /**
     * Get the URI of the registration endpoint.
     *
     * This corresponds to the `registration_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the registration endpoint.
     *
     * @see https://openid.net/specs/openid-connect-registration-1_0.html#ClientRegistration OpenID Connect Dynamic Client Registration 1.0, 3. Client Registration Endpoint
     */
    public function getRegistrationEndpoint(): ?string
    {
        return $this->registrationEndpoint;
    }


    /**
     * Set the URI of the registration endpoint.
     *
     * This corresponds to the `registration_endpoint` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $endpoint
     *     The URI of the registration endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-registration-1_0.html#ClientRegistration OpenID Connect Dynamic Client Registration 1.0, 3. Client Registration Endpoint
     */
    public function setRegistrationEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->registrationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the URI of the registration management endpoint.
     *
     * If dynamic client registration is supported and this property is set,
     * this URI will be used as the base of the client's management endpoint
     * by appending `/clientID/` to it as a path element. If this property
     * is not set, the value of `registrationEndpoint` will be used as the
     * URI base instead.
     *
     * @return string
     *     The URI of the registration management endpoint.
     *
     * @since 1.8
     */
    public function getRegistrationManagementEndpoint(): ?string
    {
        return $this->registrationManagementEndpoint;
    }


    /**
     * Set the URI of the registration management endpoint.
     *
     * If dynamic client registration is supported and this property is set,
     * this URI will be used as the base of the client's management endpoint
     * by appending `/clientID/` to it as a path element. If this property
     * is not set, the value of `registrationEndpoint` will be used as the
     * URI base instead.
     *
     * @param string $endpoint
     *     The URI of the registration management endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setRegistrationManagementEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->registrationManagementEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the scopes supported by this service.
     *
     * This corresponds to the `scopes_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return Scope[]
     *     Supported scopes.
     */
    public function getSupportedScopes(): ?array
    {
        return $this->supportedScopes;
    }


    /**
     * Set the scopes supported by this service.
     *
     * This corresponds to the `scopes_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param Scope[] $scopes
     *     Supported scopes.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedScopes(array $scopes = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopes', __NAMESPACE__ . '\Scope', $scopes);

        $this->supportedScopes = $scopes;

        return $this;
    }


    /**
     * Get the response types supported by this service.
     *
     * This corresponds to the `response_types_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return ResponseType[]
     *     Supported response types.
     *
     * @see https://openid.net/specs/oauth-v2-multiple-response-types-1_0.html OAuth 2.0 Multiple Response Type Encoding Practices
     */
    public function getSupportedResponseTypes(): ?array
    {
        return $this->supportedResponseTypes;
    }


    /**
     * Set the response types supported by this service.
     *
     * This corresponds to the `response_types_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param ResponseType[] $responseTypes
     *     Supported response types.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/oauth-v2-multiple-response-types-1_0.html OAuth 2.0 Multiple Response Type Encoding Practices
     */
    public function setSupportedResponseTypes(array $responseTypes = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$responseTypes', '\Authlete\Types\ResponseType', $responseTypes);

        $this->supportedResponseTypes = $responseTypes;

        return $this;
    }


    /**
     * Get the grant types supported by this service.
     *
     * This corresponds to the `grant_types_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return GrantType[]
     *     Supported grant types.
     */
    public function getSupportedGrantTypes(): ?array
    {
        return $this->supportedGrantTypes;
    }


    /**
     * Set the grant types supported by this service.
     *
     * This corresponds to the `grant_types_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param GrantType[] $grantTypes
     *     Supported grant types.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedGrantTypes(array $grantTypes = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$grantTypes', '\Authlete\Types\GrantType', $grantTypes);

        $this->supportedGrantTypes = $grantTypes;

        return $this;
    }


    /**
     * Get ACR (Authentication Context Class Reference) values supported
     * by this service.
     *
     * This corresponds to the `acr_values_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string[]
     *     Supported ACR values.
     */
    public function getSupportedAcrs()
    {
        return $this->supportedAcrs;
    }


    /**
     * Set ACR (Authentication Context Class Reference) values supported
     * by this service.
     *
     * This corresponds to the `acr_values_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string[] $acrs
     *     Supported ACR values.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedAcrs(array $acrs = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$acrs', $acrs);

        $this->supportedAcrs = $acrs;

        return $this;
    }


    /**
     * Get client authentication methods at the token endpoint supported
     * by this service.
     *
     * This corresponds to the `token_endpoint_auth_methods_supported`
     * metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return ClientAuthMethod[]
     *     Supported client authentication methods at the token endpoint.
     */
    public function getSupportedTokenAuthMethods(): ?array
    {
        return $this->supportedTokenAuthMethods;
    }


    /**
     * Set client authentication methods at the token endpoint supported
     * by this service.
     *
     * This corresponds to the `token_endpoint_auth_methods_supported`
     * metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param ClientAuthMethod[] $methods
     *     Supported client authentication methods at the token endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedTokenAuthMethods(array $methods = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$methods', '\Authlete\Types\ClientAuthMethod', $methods);

        $this->supportedTokenAuthMethods = $methods;

        return $this;
    }


    /**
     * Get the values of the "display" request parameter supported by
     * this service.
     *
     * This corresponds to the `display_values_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return Display[]
     *     Supported client authentication methods at the token endpoint.
     */
    public function getSupportedDisplays(): ?array
    {
        return $this->supportedDisplays;
    }


    /**
     * Set the values of the "display" request parameter supported by
     * this service.
     *
     * This corresponds to the `display_values_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param Display[] $displays
     *     Supported client authentication methods at the token endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedDisplays(array $displays = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$displays', '\Authlete\Types\Display', $displays);

        $this->supportedDisplays = $displays;

        return $this;
    }


    /**
     * Get claim types supported by this service.
     *
     * This corresponds to the `claim_types_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return ClaimType[]
     *     Supported claim types.
     */
    public function getSupportedClaimTypes(): ?array
    {
        return $this->supportedClaimTypes;
    }


    /**
     * Set claim types supported by this service.
     *
     * This corresponds to the `claim_types_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param ClaimType[] $claimTypes
     *     Supported claim types.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedClaimTypes(array $claimTypes = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$claimTypes', '\Authlete\Types\ClaimType', $claimTypes);

        $this->supportedClaimTypes = $claimTypes;

        return $this;
    }


    /**
     * Get claims supported by this service.
     *
     * This corresponds to the `claims_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string[]
     *     Supported claims.
     */
    public function getSupportedClaims(): ?array
    {
        return $this->supportedClaims;
    }


    /**
     * Set claims supported by this service.
     *
     * This corresponds to the `claims_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string[] $claims
     *     Supported claims.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedClaims(array $claims = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->supportedClaims = $claims;

        return $this;
    }


    /**
     * Get the URI of a page containing human-readable information that
     * developers might want or need to know when using this OpenID provider.
     *
     * This corresponds to the `service_documentation` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the documentation for developers.
     */
    public function getServiceDocumentation(): ?string
    {
        return $this->serviceDocumentation;
    }


    /**
     * Set the URI of a page containing human-readable information that
     * developers might want or need to know when using this OpenID provider.
     *
     * This corresponds to the `service_documentation` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $serviceDocumentation
     *     The URI of the documentation for developers.
     *
     * @return Service
     *     `$this` object.
     */
    public function setServiceDocumentation($serviceDocumentation): Service
    {
        ValidationUtility::ensureNullOrString('$serviceDocumentation', $serviceDocumentation);

        $this->serviceDocumentation = $serviceDocumentation;

        return $this;
    }


    /**
     * Get language and scripts for claim values supported by this service.
     *
     * This corresponds to the `claims_locales_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string[]
     *     Supported language and scripts for claim values.
     */
    public function getSupportedClaimLocales(): ?array
    {
        return $this->supportedClaimLocales;
    }


    /**
     * Set language and scripts for claim values supported by this service.
     *
     * This corresponds to the `claims_locales_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string[] $locales
     *     Supported language and scripts for claim values.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedClaimLocales(array $locales = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$locales', $locales);

        $this->supportedClaimLocales = $locales;

        return $this;
    }


    /**
     * Get language and scripts for the user interface supported by this
     * service.
     *
     * This corresponds to the `ui_locales_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string[]
     *     Supported language and scripts for the user interface.
     */
    public function getSupportedUiLocales(): ?array
    {
        return $this->supportedUiLocales;
    }


    /**
     * Set language and scripts for the user interface supported by this
     * service.
     *
     * This corresponds to the `ui_locales_supported` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string[] $locales
     *     Supported language and scripts for the user interface.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedUiLocales(array $locales = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$locales', $locales);

        $this->supportedUiLocales = $locales;

        return $this;
    }


    /**
     * Get the URI that this OpenID provider provides to the person
     * registering the client to read about the OP's requirements on how the
     * Relying Party can use the data provided by the OP.
     *
     * This corresponds to the `op_policy_uri` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the policy page.
     */
    public function getPolicyUri(): ?string
    {
        return $this->policyUri;
    }


    /**
     * Set the URI that this OpenID provider provides to the person
     * registering the client to read about the OP's requirements on how the
     * Relying Party can use the data provided by the OP.
     *
     * This corresponds to the `op_policy_uri` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $uri
     *     The URI of the policy page.
     *
     * @return Service
     *     `$this` object.
     */
    public function setPolicyUri(string $uri): Service
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->policyUri = $uri;

        return $this;
    }


    /**
     * Get the URI that this OpenID provider provides to the person
     * registering the client to read about the OP's terms of service.
     *
     * This corresponds to the `op_tos_uri` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @return string
     *     The URI of the Terms Of Service page.
     */
    public function getTosUri(): ?string
    {
        return $this->tosUri;
    }


    /**
     * Set the URI that this OpenID provider provides to the person
     * registering the client to read about the OP's terms of service.
     *
     * This corresponds to the `op_tos_uri` metadata defined in
     * [3. OpenID Provider Metadata](https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata)
     * of [OpenID Connect Discovery 1.0](https://openid.net/specs/openid-connect-discovery-1_0.html).
     *
     * @param string $uri
     *     The URI of the Terms Of Service page.
     *
     * @return Service
     *     `$this` object.
     */
    public function setTosUri($uri)
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->tosUri = $uri;

        return $this;
    }


    /**
     * Get the URI of the authentication callback endpoint.
     *
     * @return string
     *     The URI of the authentication callback endpoint.
     */
    public function getAuthenticationCallbackEndpoint(): ?string
    {
        return $this->authenticationCallbackEndpoint;
    }


    /**
     * Set the URI of the authentication callback endpoint.
     *
     * @param string $endpoint
     *     The URI of the authentication callback endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setAuthenticationCallbackEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->authenticationCallbackEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the API key to access the authentication callback endpoint.
     *
     * @return string
     *     The API key to access the authentication callback endpoint.
     */
    public function getAuthenticationCallbackApiKey(): ?string
    {
        return $this->authenticationCallbackApiKey;
    }


    /**
     * Set the API key to access the authentication callback endpoint.
     *
     * @param string $apiKey
     *     The API key to access the authentication callback endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setAuthenticationCallbackApiKey(string $apiKey): Service
    {
        ValidationUtility::ensureNullOrString('$apiKey', $apiKey);

        $this->authenticationCallbackApiKey = $apiKey;

        return $this;
    }


    /**
     * Get the API secret to access the authentication callback endpoint.
     *
     * @return string
     *     The API secret to access the authentication callback endpoint.
     */
    public function getAuthenticationCallbackApiSecret(): ?string
    {
        return $this->authenticationCallbackApiSecret;
    }


    /**
     * Set the API secret to access the authentication callback endpoint.
     *
     * @param string $apiSecret
     *     The API secret to access the authentication callback endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setAuthenticationCallbackApiSecret(string $apiSecret): Service
    {
        ValidationUtility::ensureNullOrString('$apiSecret', $apiSecret);

        $this->authenticationCallbackApiSecret = $apiSecret;

        return $this;
    }


    /**
     * Get the list of supported SNSes for social login at the direct
     * authorization endpoint.
     *
     * @return Sns[]
     *     Supported SNSes for social login at the direct authorization
     *     endpoint.
     */
    public function getSupportedSnses(): ?array
    {
        return $this->supportedSnses;
    }


    /**
     * Set the list of supported SNSes for social login at the direct
     * authorization endpoint.
     *
     * @param Sns[] $snses
     *     Supported SNSes for social login at the direct authorization
     *     endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedSnses(array $snses = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$snses', '\Authlete\Types\Sns', $snses);

        $this->supportedSnses = $snses;

        return $this;
    }


    /**
     * Get the list of SNS credentials used for social login.
     *
     * @return SnsCredentials[]
     *     The list of SNS credentials.
     */
    public function getSnsCredentials(): ?array
    {
        return $this->snsCredentials;
    }


    /**
     * Set the list of SNS credentials used for social login.
     *
     * @param SnsCredentials[] $credentials
     *     The list of SNS credentials.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSnsCredentials(array $credentials = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$credentials', __NAMESPACE__ . '\SnsCredentials', $credentials);

        $this->snsCredentials = $credentials;

        return $this;
    }


    /**
     * Get the time at which this service was created.
     *
     * @return integer|string|null
     *     The time at which this service was created. The value is
     *     represented as milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set the time at which this service was created.
     *
     * @param integer|string $createdAt
     *     The time at which this service was created. The value should be
     *     represented as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return Service
     *     `$this` object.
     */
    public function setCreatedAt($createdAt): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$createdAt', $createdAt);

        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * Get the time at which this service was last modified.
     *
     * @return integer|string|null
     *     The time at which this service was last modified. The value is
     *     represented as milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }


    /**
     * Set the time at which this service was last modified.
     *
     * @param integer|string $modifiedAt
     *     The time at which this service was last modified. The value should
     *     be represented as milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return Service
     *     `$this` object.
     */
    public function setModifiedAt($modifiedAt): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$modifiedAt', $modifiedAt);

        $this->modifiedAt = $modifiedAt;

        return $this;
    }


    /**
     * Get the URI of the developer authentication callback endpoint.
     *
     * @return string
     *     The URI of the developer authentication callback endpoint.
     */
    public function getDeveloperAuthenticationCallbackEndpoint(): ?string
    {
        return $this->developerAuthenticationCallbackEndpoint;
    }


    /**
     * Set the URI of the developer authentication callback endpoint.
     *
     * @param string $endpoint
     *     The URI of the developer authentication callback endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDeveloperAuthenticationCallbackEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->developerAuthenticationCallbackEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the API key to access the developer authentication callback
     * endpoint.
     *
     * @return string
     *     The API key to access the developer authentication callback
     *     endpoint.
     */
    public function getDeveloperAuthenticationCallbackApiKey(): ?string
    {
        return $this->developerAuthenticationCallbackApiKey;
    }


    /**
     * Set the API key to access the developer authentication callback
     * endpoint.
     *
     * @param string $apiKey
     *     The API key to access the developer authentication callback
     *     endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDeveloperAuthenticationCallbackApiKey($apiKey): Service
    {
        ValidationUtility::ensureNullOrString('$apiKey', $apiKey);

        $this->developerAuthenticationCallbackApiKey = $apiKey;

        return $this;
    }


    /**
     * Get the API secret to access the developer authentication callback
     * endpoint.
     *
     * @return string
     *     The API secret to access the developer authentication callback
     *     endpoint.
     */
    public function getDeveloperAuthenticationCallbackApiSecret(): ?string
    {
        return $this->developerAuthenticationCallbackApiSecret;
    }


    /**
     * Set the API secret to access the developer authentication callback
     * endpoint.
     *
     * @param string $apiSecret
     *     The API secret to access the developer authentication callback
     *     endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDeveloperAuthenticationCallbackApiSecret($apiSecret): Service
    {
        ValidationUtility::ensureNullOrString('$apiSecret', $apiSecret);

        $this->developerAuthenticationCallbackApiSecret = $apiSecret;

        return $this;
    }


    /**
     * Get the list of supported SNSes used for social login at the developer
     * console.
     *
     * NOTE: This feature is not implemented yet.
     *
     * @return Sns[]
     *     Supported SNSes for social login at the developer console.
     */
    public function getSupportedDeveloperSnses(): ?array
    {
        return $this->supportedDeveloperSnses;
    }


    /**
     * Set the list of supported SNSes used for social login at the developer
     * console.
     *
     * NOTE: This feature is not implemented yet.
     *
     * @param Sns[] $snses
     *     Supported SNSes for social login at the developer console.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedDeveloperSnses(array $snses = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$snses', '\Authlete\Types\Sns', $snses);

        $this->supportedDeveloperSnses = $snses;

        return $this;
    }


    /**
     * Get the list of SNS credentials used for social login at the developer
     * console.
     *
     * NOTE: This feature is not implemented yet.
     *
     * @return SnsCredentials[]
     *     The list of SNS credentials used for social login at the developer
     *     console.
     */
    public function getDeveloperSnsCredentials(): ?array
    {
        return $this->developerSnsCredentials;
    }


    /**
     * Get the list of SNS credentials used for social login at the developer
     * console.
     *
     * NOTE: This feature is not implemented yet.
     *
     * @param SnsCredentials[] $credentials
     *     The list of SNS credentials used for social login at the developer
     *     console.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDeveloperSnsCredentials(array $credentials = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$credentials', __NAMESPACE__ . '\SnsCredentials', $credentials);

        $this->developerSnsCredentials = $credentials;

        return $this;
    }


    /**
     * Get the number of client applications that one developer can have.
     *
     * @return integer
     *     The number of client applications that one developer can have.
     *     0 means that developers can have as many client applications
     *     as they want.
     */
    public function getClientsPerDeveloper(): int
    {
        return $this->clientsPerDeveloper;
    }


    /**
     * Set the number of client applications that one developer can have.
     *
     * @param integer $count
     *     The number of client applications that one developer can have.
     *     0 means that developers can have as many client applications
     *     as they want.
     *
     * @return Service
     *     `$this` object.
     */
    public function setClientsPerDeveloper($count): Service
    {
        ValidationUtility::ensureInteger('$count', $count);

        $this->clientsPerDeveloper = $count;

        return $this;
    }


    /**
     * Get the flag which indicates whether the direct authorization endpoint
     * is enabled or not.
     *
     * The path of the endpoint is
     * `/api/auth/authorization/direct/{serviceApiKey}`. The default value
     * of this flag is `true`, but it is recommended to disable the endpoint
     * for production use.
     *
     * Authlete provides APIs for developers to implement an authorization
     * endpoint such as `/api/auth/authorization`,
     * `/api/auth/authorization/issue` and `/api/auth/authorization/fail`.
     * On the other hand, the direct authorization endpoint is an
     * implementation that directly works as an authorization endpoint.
     * However, the endpoint exists mainly for development / experiment
     * purposes, so it is recommended to disable it in a production
     * environment.
     *
     * @return boolean
     *     `true` if the direct authorization endpoint is enabled.
     */
    public function isDirectAuthorizationEndpointEnabled(): bool
    {
        return $this->directAuthorizationEndpointEnabled;
    }


    /**
     * Set the flag which indicates whether the direct authorization endpoint
     * is enabled or not.
     *
     * The path of the endpoint is
     * `/api/auth/authorization/direct/{serviceApiKey}`. The default value
     * of this flag is `true`, but it is recommended to disable the endpoint
     * for production use.
     *
     * Authlete provides APIs for developers to implement an authorization
     * endpoint such as `/api/auth/authorization`,
     * `/api/auth/authorization/issue` and `/api/auth/authorization/fail`.
     * On the other hand, the direct authorization endpoint is an
     * implementation that directly works as an authorization endpoint.
     * However, the endpoint exists mainly for development / experiment
     * purposes, so it is recommended to disable it in a production
     * environment.
     *
     * @param boolean $enabled
     *     `true` if the direct authorization endpoint is enabled.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDirectAuthorizationEndpointEnabled($enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->directAuthorizationEndpointEnabled = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the direct token endpoint is
     * enabled or not.
     *
     * The path of the endpoint is `/api/auth/token/direct/{serviceApiKey}`.
     * The default value of this flag is `true`, but it is recommended to
     * disable the endpoint for production use.
     *
     * Authlete provides APIs for developers to implement a token endpoint
     * such as `/api/auth/token`, `/api/auth/token/issue` and
     * `/api/auth/token/fail`. On the other hand, the direct token endpoint
     * is an implementation that directly works as a token endpoint. However,
     * the endpoint exists mainly for development / experiment purposes, so
     * it is recommended to disable it in a production environment.
     *
     * @return boolean
     *     `true` if the direct token endpoint is enabled.
     */
    public function isDirectTokenEndpointEnabled(): bool
    {
        return $this->directTokenEndpointEnabled;
    }


    /**
     * Set the flag which indicates whether the direct token endpoint is
     * enabled or not.
     *
     * The path of the endpoint is `/api/auth/token/direct/{serviceApiKey}`.
     * The default value of this flag is `true`, but it is recommended to
     * disable the endpoint for production use.
     *
     * Authlete provides APIs for developers to implement a token endpoint
     * such as `/api/auth/token`, `/api/auth/token/issue` and
     * `/api/auth/token/fail`. On the other hand, the direct token endpoint
     * is an implementation that directly works as a token endpoint. However,
     * the endpoint exists mainly for development / experiment purposes, so
     * it is recommended to disable it in a production environment.
     *
     * @param boolean $enabled
     *     `true` to enable the direct token endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDirectTokenEndpointEnabled($enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->directTokenEndpointEnabled = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the direct revocation endpoint is
     * enabled or not.
     *
     * The path of the endpoint is
     * `/api/auth/revocation/direct/{serviceApiKey}`.
     *
     * Authlete provides an API (`/api/auth/revocation`) for developers to
     * implement a revocation endpoint
     * ([RFC 7009](https://tools.ietf.org/html/rfc7009). On the other hand,
     * the direct revocation endpoint is an implementation that directly works
     * as a revocation endpoint.
     *
     * @return boolean
     *     `true` if the direct revocation endpoint is enabled.
     */
    public function isDirectRevocationEndpointEnabled(): bool
    {
        return $this->directRevocationEndpointEnabled;
    }


    /**
     * Set the flag which indicates whether the direct revocation endpoint is
     * enabled or not.
     *
     * The path of the endpoint is
     * `/api/auth/revocation/direct/{serviceApiKey}`.
     *
     * Authlete provides an API (`/api/auth/revocation`) for developers to
     * implement a revocation endpoint
     * ([RFC 7009](https://tools.ietf.org/html/rfc7009). On the other hand,
     * the direct revocation endpoint is an implementation that directly works
     * as a revocation endpoint.
     *
     * @param boolean $enabled
     *     `true` to enable the direct revocation endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDirectRevocationEndpointEnabled(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->directRevocationEndpointEnabled = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the direct userinfo endpoint is
     * enabled or not.
     *
     * NOTE: This feature has not been implemented yet.
     *
     * Authlete provides APIs for developers to implement a userinfo endpoint
     * ([5.3. UserInfo Endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo))
     * such as `/api/auth/userinfo` and `/api/auth/userinfo/issue`.
     *
     * @return boolean
     *     `true` if the direct userinfo endpoint is enabled.
     */
    public function isDirectUserInfoEndpointEnabled(): bool
    {
        return $this->directUserInfoEndpointEnabled;
    }


    /**
     * Set the flag which indicates whether the direct userinfo endpoint is
     * enabled or not.
     *
     * NOTE: This feature has not been implemented yet.
     *
     * Authlete provides APIs for developers to implement a userinfo endpoint
     * ([5.3. UserInfo Endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo))
     * such as `/api/auth/userinfo` and `/api/auth/userinfo/issue`.
     *
     * @param boolean $enabled
     *     `true` to enable the direct userinfo endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDirectUserInfoEndpointEnabled(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->directUserInfoEndpointEnabled = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the direct JWK Set document
     * endpoint is enabled or not.
     *
     * The path of the endpoint is
     * `/api/service/jwks/get/direct/{serviceApiKey}`.
     *
     * Authlete provides an API (`/api/service/jwks/get`) for developers to
     * implement a JWK Set document endpoint which exposes the JWK Set
     * document ([RFC 7517](https://tools.ietf.org/html/rfc7517)) of the
     * service. On the other hand, the direct JWK Set document endpoint is
     * an implementation that directly works as a JWK Set document endpoint.
     *
     * @return boolean
     *     `true` if the direct JWK Set document endpoint is enabled.
     */
    public function isDirectJwksEndpointEnabled(): bool
    {
        return $this->directJwksEndpointEnabled;
    }


    /**
     * Set the flag which indicates whether the direct JWK Set document
     * endpoint is enabled or not.
     *
     * The path of the endpoint is
     * `/api/service/jwks/get/direct/{serviceApiKey}`.
     *
     * Authlete provides an API (`/api/service/jwks/get`) for developers to
     * implement a JWK Set document endpoint which exposes the JWK Set
     * document ([RFC 7517](https://tools.ietf.org/html/rfc7517)) of the
     * service. On the other hand, the direct JWK Set document endpoint is
     * an implementation that directly works as a JWK Set document endpoint.
     *
     * @param boolean $enabled
     *     `true` to enable the direct JWK Set document endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDirectJwksEndpointEnabled(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->directJwksEndpointEnabled = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the direct introspection endpoint
     * is enabled or not.
     *
     * The path of the endpoint is `/api/auth/introspection/standard/direct`.
     * The API is protected by pairs of API key and API secret of services.
     *
     * Authlete provides an API (`/api/auth/introspection/standard`) for
     * developers to implement an introspection endpoint
     * ([RFC 7662](https://tools.ietf.org/html/rfc7662)). On the other hand,
     * the direct introspection endpoint is an implementation that directly
     * works as an introspection endpoint.
     *
     * Note that Authlete provides another different introspection API
     * (`/api/auth/introspection`). It does not comply with RFC 7662 but is
     * much more useful for developers who implement protected resource
     * endpoints.
     *
     * @return boolean
     *     `true` if the direct introspection endpoint is enabled.
     */
    public function isDirectIntrospectionEndpointEnabled(): bool
    {
        return $this->directIntrospectionEndpointEnabled;
    }


    /**
     * Set the flag which indicates whether the direct introspection endpoint
     * is enabled or not.
     *
     * The path of the endpoint is `/api/auth/introspection/standard/direct`.
     * The API is protected by pairs of API key and API secret of services.
     *
     * Authlete provides an API (`/api/auth/introspection/standard`) for
     * developers to implement an introspection endpoint
     * ([RFC 7662](https://tools.ietf.org/html/rfc7662)). On the other hand,
     * the direct introspection endpoint is an implementation that directly
     * works as an introspection endpoint.
     *
     * Note that Authlete provides another different introspection API
     * (`/api/auth/introspection`). It does not comply with RFC 7662 but is
     * much more useful for developers who implement protected resource
     * endpoints.
     *
     * @param boolean $enabled
     *     `true` if the direct introspection endpoint is enabled.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDirectIntrospectionEndpointEnabled(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->directIntrospectionEndpointEnabled = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the number of access tokens per
     * subject (and per client) is at most one or can be more.
     *
     * If this flag is `true`, an attempt to issue a new access token
     * invalidates existing access tokens which are associated with the same
     * subject and the same client application.
     *
     * Note that, however, attempts by Client Credentials Flow do not
     * invalidate existing access tokens because access tokens issued by
     * Client Credentials Flow are not associated with any end-user's subject.
     * Also note that an attempt by Refresh Token Flow invalidates the coupled
     * access token only and this invalidation is always performed regardless
     * of whether this flag is `true` or `false`.
     *
     * @return boolean
     *     `true` if the number of access tokens per subject per client is
     *     at most one.
     */
    public function isSingleAccessTokenPerSubject(): bool
    {
        return $this->singleAccessTokenPerSubject;
    }


    /**
     * Set the flag which indicates whether the number of access tokens per
     * subject (and per client) is at most one or can be more.
     *
     * If this flag is `true`, an attempt to issue a new access token
     * invalidates existing access tokens which are associated with the same
     * subject and the same client application.
     *
     * Note that, however, attempts by Client Credentials Flow do not
     * invalidate existing access tokens because access tokens issued by
     * Client Credentials Flow are not associated with any end-user's subject.
     * Also note that an attempt by Refresh Token Flow invalidates the coupled
     * access token only and this invalidation is always performed regardless
     * of whether this flag is `true` or `false`.
     *
     * @param boolean $enabled
     *     `true` to ensure that the number of access tokens per subject per
     *     client is at most one. `false` to allow multiple access tokens to
     *     be issued to a combination of the same subject and the same client.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSingleAccessTokenPerSubject(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->singleAccessTokenPerSubject = $enabled;

        return $this;
    }


    /**
     * Get the flag which indicates whether the use of Proof Key for Code
     * Exchange (PKCE) is always required for authorization requests using
     * Authorization Code Flow.
     *
     * @return boolean
     *     `true` if PKCE is always required for the authorization code flow.
     *
     * @see https://tools.ietf.org/html/rfc7636 RFC 7636 Proof Key for Code Exchange by OAuth Public Clients
     */
    public function isPkceRequired(): bool
    {
        return $this->pkceRequired;
    }


    /**
     * Set the flag which indicates whether the use of Proof Key for Code
     * Exchange (PKCE) is always required for authorization requests using
     * Authorization Code Flow.
     *
     * @param boolean $required
     *     `true` to always require PKCE for the authorization code flow.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7636 RFC 7636 Proof Key for Code Exchange by OAuth Public Clients
     */
    public function setPkceRequired(bool $required): Service
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->pkceRequired = $required;

        return $this;
    }


    /**
     * Get the flag which indicates whether `S256` is always required as the
     * code challenge method whenever PKCE is used.
     *
     * If this flag is `true`, `code_challenge_method=S256` must be included
     * in the authorization request whenever it includes the `code_challenge`
     * request parameter. Neither omission of `code_challenge_method` request
     * parameter nor use of `plain` (`code_challenge_method=plain`) is allowed.
     *
     * @return boolean
     *     `true` if `S256` is always required as the code challenge method
     *     whenever PKCE is used.
     *
     * @see https://tools.ietf.org/html/rfc7636 RFC 7636 Proof Key for Code Exchange by OAuth Public Clients
     *
     * @since 1.8
     */
    public function isPkceS256Required(): bool
    {
        return $this->pkceS256Required;
    }


    /**
     * Set the flag which indicates whether `S256` is always required as the
     * code challenge method whenever PKCE is used.
     *
     * If this flag is `true`, `code_challenge_method=S256` must be included
     * in the authorization request whenever it includes the `code_challenge`
     * request parameter. Neither omission of `code_challenge_method` request
     * parameter nor use of `plain` (`code_challenge_method=plain`) is allowed.
     *
     * @param boolean $required
     *     `true` to require `S256` as the code challenge method whenever PKCE
     *     is used.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7636 RFC 7636 Proof Key for Code Exchange by OAuth Public Clients
     *
     * @since 1.8
     */
    public function setPkceS256Required(bool $required): Service
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->pkceS256Required = $required;

        return $this;
    }


    /**
     * Get the flag which indicates whether a refresh token remains valid
     * or gets renewed after its use.
     *
     * @return boolean
     *     `true` if a refresh token remains valid after its use.
     *     `false` if a new refresh token is issued after its use.
     *
     * @since 1.7
     */
    public function isRefreshTokenKept(): bool
    {
        return $this->refreshTokenKept;
    }


    /**
     * Set the flag which indicates whether a refresh token remains valid
     * or gets renewed after its use.
     *
     * @param boolean $kept
     *     `true` to keep a refresh token valid after its use.
     *     `false` to renew a refresh token after its use.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setRefreshTokenKept(bool $kept): Service
    {
        ValidationUtility::ensureBoolean('$kept', $kept);

        $this->refreshTokenKept = $kept;

        return $this;
    }


    /**
     * Get the flag which indicates whether the remaining duration of the used
     * refresh token is taken over to the newly issued one.
     *
     * @return boolean
     *     `true` if the remaining duration of the used refresh token is taken
     *     over to the newly issued one.
     *
     * @since 1.8
     */
    public function isRefreshTokenDurationKept(): bool
    {
        return $this->refreshTokenDurationKept;
    }


    /**
     * Set the flag which indicates whether the remaining duration of the used
     * refresh token is taken over to the newly issued one.
     *
     * @param boolean $kept
     *     `true` to indicate that the remaining duration of the used refresh
     *     token is taken over to the newly issued one.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setRefreshTokenDurationKept(bool $kept): Service
    {
        ValidationUtility::ensureBoolean('$kept', $kept);

        $this->refreshTokenDurationKept = $kept;

        return $this;
    }


    /**
     * Get the flag which indicates whether the error_description response
     * parameter is omitted.
     *
     * According to RFC 6749, authorization servers may include the
     * `error_description` response parameter in error responses. When this
     * property is `true`, Authlete does not embed the `error_description`
     * response parameter in error responses.
     *
     * @return boolean
     *     `true` if the `error_description` response parameter is omitted.
     *     `false` if the `error_description` response parameter is included
     *     in error responses from the authorization server.
     *
     * @since 1.7
     */
    public function isErrorDescriptionOmitted(): bool
    {
        return $this->errorDescriptionOmitted;
    }


    /**
     * Omit or embed the error_description response parameter in error
     * responses.
     *
     * @param boolean $omitted
     *     `true` to omit the error_description response parameter.
     *     `false` to embed the parameter.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setErrorDescriptionOmitted(bool $omitted): Service
    {
        ValidationUtility::ensureBoolean('$omitted', $omitted);

        $this->errorDescriptionOmitted = $omitted;

        return $this;
    }


    /**
     * Get the flag which indicates whether the error_uri response parameter
     * is omitted.
     *
     * According to RFC 6749, authorization servers may include the
     * `error_uri` response parameter in error responses. When this property is
     * `true`, Authlete does not embed the `error_uri` response parameter in
     * error responses.
     *
     * @return boolean
     *     `true` if the `error_uri` response parameter is omitted.
     *     `false` if the `error_uri` response parameter is included in error
     *     responses from the authorization server.
     *
     * @since 1.7
     */
    public function isErrorUriOmitted(): bool
    {
        return $this->errorUriOmitted;
    }


    /**
     * Omit or embed the error_uri response parameter in error responses.
     *
     * @param boolean $omitted
     *     `true` to omit the error_uri response parameter.
     *     `false` to embed the parameter.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setErrorUriOmitted(bool $omitted): Service
    {
        ValidationUtility::ensureBoolean('$omitted', $omitted);

        $this->errorUriOmitted = $omitted;

        return $this;
    }


    /**
     * Get the flag which indicates whether the "Client ID Alias" feature is
     * enabled or not.
     *
     * @return boolean
     *     `true` if the "Client ID Alias" feature is enabled.
     *     `false` if the feature is disabled.
     *
     * @since 1.7
     */
    public function isClientIdAliasEnabled(): bool
    {
        return $this->clientIdAliasEnabled;
    }


    /**
     * Enable/disable the "Client ID Alias" feature.
     *
     * When a new client is created, Authlete generates a numeric value and
     * assigns it as a client ID to the newly created client. In addition to
     * the client ID, each client can have a client ID alias. The client ID
     * alias is, however, recognized only when this property is `true`.
     *
     * @param boolean $enabled
     *     `true` to enable the "Client ID Alias" feature.
     *     `falses` to disable the feature.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setClientIdAliasEnabled(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->clientIdAliasEnabled = $enabled;

        return $this;
    }


    /**
     * Get the service profiles supported by this service.
     *
     * @return ServiceProfile[]
     *     Supported service profiles.
     */
    public function getSupportedServiceProfiles(): ?array
    {
        return $this->supportedServiceProfiles;
    }


    /**
     * Set the service profile supported by this service.
     *
     * @param ServiceProfile[] $serviceProfiles
     *     Supported service profiles.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedServiceProfiles(array $serviceProfiles = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$serviceProfiles', '\Authlete\Types\ServiceProfile', $serviceProfiles);

        $this->supportedServiceProfiles = $serviceProfiles;

        return $this;
    }


    /**
     * Get the flag which indicates whether this service supports
     * "TLS client certificate bound access tokens".
     *
     * If this method returns `true`, client applications whose
     * `isTlsClientCertificateBoundAccessTokens()` returns `true` are
     * required to present a client certificate on token requests to the
     * authorization server and on API calls to the resource server.
     *
     * @return boolean
     *     `true` if this service supports "TLS client certificate bound
     *     access tokens".
     *
     * @since 1.4
     */
    public function isTlsClientCertificateBoundAccessTokens(): bool
    {
        return $this->tlsClientCertificateBoundAccessTokens;
    }


    /**
     * Set the flag which indicates whether this service supports
     * "TLS client certificate bound access tokens".
     *
     * If `true` is set to this property, client applications whose
     * `isTlsClientCertificateBoundAccessTokens()` returns `true` are
     * required to present a client certificate on token requests to the
     * authorization server and on API calls to the resource server.
     *
     * @param boolean $enabled
     *     `true` to enable support of "TLS client certificate bound
     *     access tokens".
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.4
     */
    public function setTlsClientCertificateBoundAccessTokens(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->tlsClientCertificateBoundAccessTokens = $enabled;

        return $this;
    }


    /**
     * Get the URI of the introspection endpoint.
     *
     * @return string
     *     The URI of the introspection endpoint.
     *
     * @see https://tools.ietf.org/html/rfc7662 RFC 7662 OAuth 2.0 Token Introspection
     */
    public function getIntrospectionEndpoint(): ?string
    {
        return $this->introspectionEndpoint;
    }


    /**
     * Set the URI of the introspection endpoint.
     *
     * @param string $endpoint
     *     The URI of the introspection endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7662 RFC 7662 OAuth 2.0 Token Introspection
     */
    public function setIntrospectionEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->introspectionEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get client authentication methods at the introspection endpoint
     * supported by this service.
     *
     * This corresponds to the `introspection_endpoint_auth_methods_supported`
     * metadata defined in "OAuth 2.0 Authorization Server Metadata".
     *
     * @return ClientAuthMethod[]
     *     Supported client authentication methods at the introspection
     *     endpoint.
     */
    public function getSupportedIntrospectionAuthMethods(): ?array
    {
        return $this->supportedIntrospectionAuthMethods;
    }


    /**
     * Set client authentication methods at the introspection endpoint
     * supported by this service.
     *
     * This corresponds to the `introspection_endpoint_auth_methods_supported`
     * metadata defined in "OAuth 2.0 Authorization Server Metadata".
     *
     * @param ClientAuthMethod[] $methods
     *     Supported client authentication methods at the introspection
     *     endpoint.
     *
     * @return Service
     *     `$this` object.
     */
    public function setSupportedIntrospectionAuthMethods(array $methods = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$methods', '\Authlete\Types\ClientAuthMethod', $methods);

        $this->supportedIntrospectionAuthMethods = $methods;

        return $this;
    }


    /**
     * Get the flag which indicates whether to check if client certificates
     * can be reached from pre-registered trusted root certificates.
     *
     * @return boolean
     *     `true` if validation of client certificates is performed.
     *
     * @since 1.3
     */
    public function isMutualTlsValidatePkiCertChain(): bool
    {
        return $this->mutualTlsValidatePkiCertChain;
    }


    /**
     * Set the flag which indicates whether to check if client certificates
     * can be reached from pre-registered trusted root certificates.
     *
     * @param boolean $enabled
     *     `true` to perform validation of client certificates.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setMutualTlsValidatePkiCertChain(bool $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->mutualTlsValidatePkiCertChain = $enabled;

        return $this;
    }


    /**
     * Get trusted root certificates.
     *
     * If `isMutualTlsValidatePkiCertChain()` returns `true`, pre-registered
     * trusted root certificates are used to validate client certificates.
     *
     * @return string[]
     *     Trusted root certificates.
     *
     * @since 1.3
     */
    public function getTrustedRootCertificates(): ?array
    {
        return $this->trustedRootCertificates;
    }


    /**
     * Set trusted root certificates.
     *
     * If `isMutualTlsValidatePkiCertChain()` returns `true`, pre-registered
     * trusted root certificates are used to validate client certificates.
     *
     * @param string[] $certificates
     *     Trusted root certificates.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setTrustedRootCertificates(array $certificates = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$certificates', $certificates);

        $this->trustedRootCertificates = $certificates;

        return $this;
    }


    /**
     * Get the flag which indicates whether dynamic client registration is
     * supported.
     *
     * @return boolean
     *     `true` if dynamic client registration is supported.
     *
     * @since 1.8
     */
    public function isDynamicRegistrationSupported(): bool
    {
        return $this->dynamicRegistrationSupported;
    }


    /**
     * Set the flag which indicates whether dynamic client registration is
     * supported.
     *
     * @param boolean $supported
     *     `true` to indicate that dynamic client registration is supported.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDynamicRegistrationSupported($supported): Service
    {
        ValidationUtility::ensureBoolean('$supported', $supported);

        $this->dynamicRegistrationSupported = $supported;

        return $this;
    }


    /**
     * Get the end session endpoint for the service. This endpoint is used
     * by clients to signal to the IdP that the user's session should be
     * terminated.
     *
     * @return string
     *     The end session endpoint.
     *
     * @since 1.8
     */
    public function getEndSessionEndpoint(): ?string
    {
        return $this->endSessionEndpoint;
    }


    /**
     * Set the end session endpoint for the service. This endpoint is used
     * by clients to signal to the IdP that the user's session should be
     * terminated.
     *
     * @param string $endpoint
     *     The end session endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setEndSessionEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->endSessionEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the description about this service.
     *
     * @return string
     *     The description about this service.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }


    /**
     * Set the description about this service.
     *
     * @param string $description
     *     The description about this service.
     *
     * @return Service
     *     `$this` object.
     */
    public function setDescription(string $description): Service
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->description = $description;

        return $this;
    }


    /**
     * Get the token type of access tokens issued by this authorization server.
     *
     * It is the value of the `token_type` parameter in access token responses.
     *
     * @return string
     *     The token type of access tokens.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-5.1 RFC 6749, 5.1. Successful Response
     */
    public function getAccessTokenType(): ?string
    {
        return $this->accessTokenType;
    }


    /**
     * Set the token type of access tokens issued by this authorization server.
     *
     * It is the value of the `token_type` parameter in access token responses.
     * `Bearer` is recommended.
     *
     * @param string $type
     *     The token type of access tokens.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-5.1 RFC 6749, 5.1. Successful Response
     */
    public function setAccessTokenType(string $type): Service
    {
        ValidationUtility::ensureNullOrString('$type', $type);

        $this->accessTokenType = $type;

        return $this;
    }


    /**
     * Get the signature algorithm of access tokens.
     *
     * When this method returns null, access tokens issued by this service
     * are just random strings. On the other hand, when this method returns a
     * non-null value, access tokens issued by this service are JWTs and the
     * value returned from this method represents the signature algorithm of
     * the JWTs.
     *
     * @return JWSAlg
     *     The signature algorithm of JWT-based access tokens.
     *
     * @since 1.8
     */
    public function getAccessTokenSignAlg(): ?JWSAlg
    {
        return $this->accessTokenSignAlg;
    }


    /**
     * Set the signature algorithm of access tokens.
     *
     * When null is set, access tokens issued by this service are just random
     * strings. On the other hand, when a non-null value is set, access tokens
     * issued by this service are JWTs and the value set by this method is used
     * as the signature algorithm of the JWTs.
     *
     * @param JWSAlg $alg
     *     The signature algorithm of JWT-based access tokens. Note that
     *     symmetric algorithms (`HS256`, `HS384` and `HS512`) are not
     *     supported.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenSignAlg(JWSAlg $alg = null): Service
    {
        $this->accessTokenSignAlg = $alg;

        return $this;
    }


    /**
     * Get the duration of access tokens in seconds.
     *
     * It is the value of the `expires_in` parameter in access token responses.
     *
     * @return integer|string
     *     The duration of access tokens.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-5.1 RFC 6749, 5.1. Successful Response
     */
    public function getAccessTokenDuration()
    {
        return $this->accessTokenDuration;
    }


    /**
     * Set the duration of access tokens in seconds.
     *
     * It is the value of the `expires_in` parameter in access token responses.
     *
     * @param integer|string $duration
     *     The duration of access tokens.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-5.1 RFC 6749, 5.1. Successful Response
     */
    public function setAccessTokenDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of refresh tokens in seconds.
     *
     * @return integer|string|null
     *     The duration of refresh tokens.
     */
    public function getRefreshTokenDuration()
    {
        return $this->refreshTokenDuration;
    }


    /**
     * Set the duration of refresh tokens in seconds.
     *
     * @param integer|string $duration
     *     The duration of refresh tokens.
     *
     * @return Service
     *     `$this` object.
     */
    public function setRefreshTokenDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of ID tokens in seconds.
     *
     * @return integer|string|null
     *     The duration of ID tokens.
     */
    public function getIdTokenDuration()
    {
        return $this->idTokenDuration;
    }


    /**
     * Set the duration of ID tokens in seconds.
     *
     * @param integer|string $duration
     *     The duration of ID tokens.
     *
     * @return Service
     *     `$this` object.
     */
    public function setIdTokenDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->idTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of authorization response JWTs in seconds.
     *
     * [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html)
     * defines new values for the `response_mode` request parameter. They are
     * `query.jwt`, `fragment.jwt`, `form_post.jwt` and `jwt`. If one of them
     * is specified as the response mode, response parameters from the
     * authorization endpoint will be packed into a JWT. This property is used
     * to compute the value of the `exp` claim of the JWT.
     *
     * @return integer|string|null
     *     The duration of authorization response JWTs in seconds.
     *
     * @since 1.7
     */
    public function getAuthorizationResponseDuration()
    {
        return $this->authorizationResponseDuration;
    }


    /**
     * Set the duration of authorization response JWTs in seconds.
     *
     * [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html)
     * defines new values for the `response_mode` request parameter. They are
     * `query.jwt`, `fragment.jwt`, `form_post.jwt` and `jwt`. If one of them
     * is specified as the response mode, response parameters from the
     * authorization endpoint will be packed into a JWT. This property is used
     * to compute the value of the `exp` claim of the JWT.
     *
     * @param integer|string $duration
     *     The duration of authorization response JWTs in seconds.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationResponseDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->authorizationResponseDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of pushed authorization requests in seconds.
     *
     * "OAuth 2.0 Pushed Authorization Requests" (PAR) defines an endpoint
     * (called "pushed authorization request endpoint") which client
     * applications can register authorization requests into and get
     * corresponding URIs (called "request URIs") from. The issued URIs
     * represent the registered authorization requests. client applications
     * can use the URIs as the value of the `request_uri` request parameter
     * in an authorization request.
     *
     * The value returned from this method represents the duration of
     * registered authorization requests and is used as the value of the
     * `expires_in` parameter in responses from the pushed authorization
     * request endpoint.
     *
     * @return integer|string|null
     *     The duration of pushed authorization requests in seconds.
     *
     * @since 1.8
     */
    public function getPushedAuthReqDuration()
    {
        return $this->pushedAuthReqDuration;
    }


    /**
     * Set the duration of pushed authorization requests in seconds.
     *
     * "OAuth 2.0 Pushed Authorization Requests" (PAR) defines an endpoint
     * (called "pushed authorization request endpoint") which client
     * applications can register authorization requests into and get
     * corresponding URIs (called "request URIs") from. The issued URIs
     * represent the registered authorization requests. client applications
     * can use the URIs as the value of the `request_uri` request parameter
     * in an authorization request.
     *
     * The value given to this method represents the duration of registered
     * authorization requests and is used as the value of the `expires_in`
     * parameter in responses from the pushed authorization request endpoint.
     *
     * @param integer|string $duration
     *     The duration of pushed authorization requests in seconds.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setPushedAuthReqDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->pushedAuthReqDuration = $duration;

        return $this;
    }


    /**
     * Get the key ID to identify a JWK used for signing access tokens.
     *
     * A JWK Set can be registered as a property of a `Service`. A JWK Set
     * can contain 0 or more JWKs. Authlete Server has to pick one JWK for
     * signing from the JWK Set when it generates a JWT-based access token.
     * Authlete Server searches the registered JWK Set for a JWK which
     * satisfies conditions for access token signature. If the number of
     * JWK candidates which satisfy the conditions is 1, there is no problem.
     * On the other hand, if there exist multiple candidates, a Key ID is
     * needed to be specified so that Authlete Server can pick up one JWK
     * from among the JWK candidates.
     *
     * This `accessTokenSignatureKeyId` property exists for the purpose
     * described above.
     *
     * @return string
     *     A key ID of a JWK. This may be `null`.
     *
     * @since 1.8
     */
    public function getAccessTokenSignatureKeyId(): ?string
    {
        return $this->accessTokenSignatureKeyId;
    }


    /**
     * Set the key ID to identify a JWK used for signing access tokens.
     *
     * See the description of `getAccessTokenSignatureKeyId()` for details.
     *
     * @param string $keyId
     *     A key ID of a JWK. This may be `null`.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenSignatureKeyId(string $keyId): Service
    {
        ValidationUtility::ensureNullOrString('$keyId', $keyId);

        $this->accessTokenSignatureKeyId = $keyId;

        return $this;
    }


    /**
     * Get the key ID to identify a JWK used for signing authorization
     * responses using an asymmetric key.
     *
     * [Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)](https://openid.net/specs/openid-financial-api-jarm.html)
     * has added new values for the `response_mode` request parameter. They are
     * `query.jwt`, `fragment.jwt`, `form_post.jwt` and `jwt`. If one of them
     * is used, response parameters returned from the authorization endpoint
     * will be packed into a JWT. The JWT is always signed. For the signature
     * of the JWT, Authlete Server has to pick up one JWK from the service's
     * JWK Set.
     *
     * Authlete Server searches the JWK Set for a JWK which satisifies
     * conditions for authorization response signature. If the number of JWK
     * candidates which satisify the conditions is 1, there is no problem. On
     * the other hand, if there exist multiple condidates,
     * [Key ID](https://tools.ietf.org/html/rfc7517#section-4.5) is needed to
     * be specified so that Authlete Server can pick up one JWK from among the
     * JWK candidates. This property exists to specify the key ID.
     *
     * @return string
     *     A key ID of a JWK. This may be `null`.
     *
     * @since 1.7
     */
    public function getAuthorizationSignatureKeyId(): ?string
    {
        return $this->authorizationSignatureKeyId;
    }


    /**
     * Set the key ID to identify a JWK used for signing authorization
     * responses using an asymmetric key.
     *
     * See the description of `getAuthorizationSignatureKeyId()` for details.
     *
     * @param string $keyId
     *     A key ID of a JWK. This may be `null`.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setAuthorizationSignatureKeyId(string $keyId): Service
    {
        ValidationUtility::ensureNullOrString('$keyId', $keyId);

        $this->authorizationSignatureKeyId = $keyId;

        return $this;
    }


    /**
     * Get the key ID to identify a JWK used for ID token signature using an
     * asymmetric key.
     *
     * A JWK Set can be registered as a property of a Service. A JWK Set can
     * contain 0 or more JWKs (See [RFC 7517](https://tools.ietf.org/html/rfc7517)
     * for details). Authlete Server has to pick up one JWK for signature from
     * the JWK Set when it generates an ID token and signature using an
     * asymmetric key. Authlete Server searches the registered JWK Set for a
     * JWK which satisifies conditions for ID token signature. If the number
     * of JWK candidates which satisfy the conditions is 1, there is no
     * problem. On the other hand, if there exist multiple candidates, a
     * [Key ID](https://tools.ietf.org/html/rfc7517#section-4.5) is needed to
     * be specified so that Authlete Server can pick up one JWK from among
     * the JWK candidates.
     *
     * This `idTokenSignatureKeyId` property exists for the purpose described
     * above. For key rotation (OpenID Connect Core 1.0,
     * [10.1.1. Rotation of Asymmetric Signing Keys](https://openid.net/specs/openid-connect-core-1_0.html#RotateSigKeys)),
     * this mechanism is needed.
     *
     * @return string
     *     A key ID of a JWK. This may be `null`.
     *
     * @since 1.7
     */
    public function getIdTokenSignatureKeyId(): ?string
    {
        return $this->idTokenSignatureKeyId;
    }


    /**
     * Set the key ID to identify a JWK used for ID token signature using an
     * asymmetric key.
     *
     * See the description of `getIdTokenSignatureKeyId()` for details.
     *
     * @param string $keyId
     *     A key ID of a JWK. This may be `null`.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setIdTokenSignatureKeyId(string $keyId): Service
    {
        ValidationUtility::ensureNullOrString('$keyId', $keyId);

        $this->idTokenSignatureKeyId = $keyId;

        return $this;
    }


    /**
     * Get the key ID to identify a JWK used for ID user info signature using
     * an asymmetric key.
     *
     * A JWK Set can be registered as a property of a Service. A JWK Set can
     * contain 0 or more JWKs (See [RFC 7517](https://tools.ietf.org/html/rfc7517)
     * for details). Authlete Server has to pick up one JWK for signature from
     * the JWK Set when it is required to sign user info (which is returned
     * from [UserInfo Endpoint](http://openid.net/specs/openid-connect-core-1_0.html#UserInfo))
     * using an asymmetric key. Authlete Server searches the registered JWK
     * Set for a JWK which satisifies conditions for user info signature. If
     * the number of JWK candidates which satisfy the conditions is 1, there
     * is no problem. On the other hand, if there exist multiple candidates,
     * a [Key ID](https://tools.ietf.org/html/rfc7517#section-4.5) is needed
     * to be specified so that Authlete Server can pick up one JWK from among
     * the JWK candidates.
     *
     * This `userInfoSignatureKeyId` property exists for the purpose described
     * above. For key rotation (OpenID Connect Core 1.0,
     * [10.1.1. Rotation of Asymmetric Signing Keys](https://openid.net/specs/openid-connect-core-1_0.html#RotateSigKeys)),
     * this mechanism is needed.
     *
     * @return string
     *     A key ID of a JWK. This may be `null`.
     *
     * @since 1.7
     */
    public function getUserInfoSignatureKeyId(): ?string
    {
        return $this->userInfoSignatureKeyId;
    }


    /**
     * Set the key ID to identify a JWK used for user info signature using
     * an asymmetric key.
     *
     * See the description of `getUserInfoSignatureKeyId()` for details.
     *
     * @param string $keyId
     *     A key ID of a JWK. This may be `null`.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setUserInfoSignatureKeyId(string $keyId): Service
    {
        ValidationUtility::ensureNullOrString('$keyId', $keyId);

        $this->userInfoSignatureKeyId = $keyId;

        return $this;
    }


    /**
     * Get the supported backchannel token delivery modes. This property
     * corresponds to the `backchannel_token_delivery_modes_supported`
     * metadata defined in CIBA.
     *
     * @return DeliveryMode[]
     *     Supported backchannel token delivery modes.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getSupportedBackchannelTokenDeliveryModes(): ?array
    {
        return $this->supportedBackchannelTokenDeliveryModes;
    }


    /**
     * Set the supported backchannel token delivery modes. This property
     * corresponds to the `backchannel_token_delivery_modes_supported`
     * metadata defined in CIBA.
     *
     * @param DeliveryMode[] $modes
     *     Supported backchannel token delivery modes.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setSupportedBackchannelTokenDeliveryModes(array $modes = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$modes', '\Authlete\Types\DeliveryMode', $modes);

        $this->supportedBackchannelTokenDeliveryModes = $modes;

        return $this;
    }


    /**
     * Get the URI of the backchannel authentication endpoint.
     *
     * @return string
     *     The URI of the backchannel authentication endpoint.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBackchannelAuthenticationEndpoint(): ?string
    {
        return $this->backchannelAuthenticationEndpoint;
    }


    /**
     * Set the URI of the backchannel authentication endpoint.
     *
     * @param string $endpoint
     *     The URI of the backchannel authentication endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBackchannelAuthenticationEndpoint($endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->backchannelAuthenticationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the flag which indicates whether the `user_code` request parameter
     * is supported at the backchannel authentication endpoint. This property
     * corresponds to the `backchannel_user_code_parameter_supported` metadata.
     *
     * @return boolean
     *     `true` if the `user_code` request parameter is supported at the
     *     backchannel authentication endpoint.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function isBackchannelUserCodeParameterSupported(): bool
    {
        return $this->backchannelUserCodeParameterSupported;
    }


    /**
     * Set the flag which indicates whether the `user_code` request parameter
     * is supported at the backchannel authentication endpoint. This property
     * corresponds to the `backchannel_user_code_parameter_supported` metadata.
     *
     * @param boolean $supported
     *     `true` to indicate that the `user_code` request parameter is
     *     supported at the backchannel authentication endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBackchannelUserCodeParameterSupported(bool $supported): Service
    {
        ValidationUtility::ensureBoolean('$supported', $supported);

        $this->backchannelUserCodeParameterSupported = $supported;

        return $this;
    }


    /**
     * Get the duration of backchannel authentication request IDs issued from
     * the backchannel authentication endpoint in seconds. This is used as the
     * value of the `expires_in` property in responses from the backchannel
     * authentication endpoint.
     *
     * @return integer|string
     *     The duration of backchannel authentication request IDs in seconds.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBackchannelAuthReqIdDuration()
    {
        return $this->backchannelAuthReqIdDuration;
    }


    /**
     * Set the duration of backchannel authentication request IDs issued from
     * the backchannel authentication endpoint in seconds. This is used as the
     * value of the `expires_in` property in responses from the backchannel
     * authentication endpoint.
     *
     * @param integer|string $duration
     *     The duration of backchannel authentication request IDs in seconds.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBackchannelAuthReqIdDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->backchannelAuthReqIdDuration = $duration;

        return $this;
    }


    /**
     * Get the minimum interval between polling requests to the token endpoint
     * from client applications in seconds. This is used as the value of the
     * `interval` property in responses from the backchannel authentication
     * endpoint.
     *
     * @return integer
     *     The minimum interval between polling requests in seconds.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBackchannelPollingInterval(): int
    {
        return $this->backchannelPollingInterval;
    }


    /**
     * Set the minimum interval between polling requests to the token endpoint
     * from client applications in seconds. This is used as the value of the
     * `interval` property in responses from the backchannel authentication
     * endpoint.
     *
     * @param integer $interval
     *     The minimum interval between polling requests in seconds.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function setBackchannelPollingInterval($interval): Service
    {
        ValidationUtility::ensureInteger('$interval', $interval);

        $this->backchannelPollingInterval = $interval;

        return $this;
    }


    /**
     * Get the flag which indicates whether the `binding_message` request
     * parameter is always required whenever a backchannel authentication
     * request is judged as a request for Financial-grade API.
     *
     * @return boolean
     *     `true` if the `binding_message` request parameter is required
     *     whenever a backchannel authentication request is judged as a
     *     request for Financial-grade API.
     *
     * @since 1.8
     */
    public function isBackchannelBindingMessageRequiredInFapi(): bool
    {
        return $this->backchannelBindingMessageRequiredInFapi;
    }


    /**
     * Set the flag which indicates whether the `binding_message` request
     * parameter is always required whenever a backchannel authentication
     * request is judged as a request for Financial-grade API.
     *
     * The FAPI-CIBA profile requires that the authorization server <i>"shall
     * ensure unique authorization context exists in the authorization request
     * or require a `binding_message` in the authorization request"</i>
     * (FAPI-CIBA, 5.2.2., 2). The simplest way to fulfill this requirement
     * is to set `true` to this property.
     *
     * If `false` is set to this property, the `binding_message` request
     * parameter remains optional even in FAPI context, but in exchange,
     * your authorization server must implement a custom mechanism that
     * ensures each backchannel authentication request has unique context.
     *
     * @param boolean $required
     *     `true` to require the `binding_message` request parameter whenever
     *     a backchannel authentication request is judged as a request for
     *     Financial-grade API.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setBackchannelBindingMessageRequiredInFapi(bool $required): Service
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->backchannelBindingMessageRequiredInFapi = $required;

        return $this;
    }


    /**
     * Get the allowable clock skew between the server and clients in seconds.
     *
     * The clock skew is taken into consideration when time-related claims in
     * a JWT (e.g. `exp`, `iat` and `nbf`) are verified.
     *
     * @return integer
     *     Allowable clock skew in seconds.
     *
     * @since 1.8
     */
    public function getAllowableClockSkew(): int
    {
        return $this->allowableClockSkew;
    }


    /**
     * Get the allowable clock skew between the server and clients in seconds.
     *
     * The clock skew is taken into consideration when time-related claims in
     * a JWT (e.g. `exp`, `iat` and `nbf`) are verified.
     *
     * @param integer $seconds
     *     Allowable clock skew in seconds. Must be in between 0 and 65535.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAllowableClockSkew(int $seconds): Service
    {
        ValidationUtility::ensureInteger('$seconds', $seconds);

        $this->allowableClockSkew = $seconds;

        return $this;
    }


    /**
     * Get the URI of the device authorization endpoint.
     *
     * @return string
     *     The URI of the device authorization endpoint.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getDeviceAuthorizationEndpoint(): ?string
    {
        return $this->deviceAuthorizationEndpoint;
    }


    /**
     * Set the URI of the device authorization endpoint.
     *
     * @param string $endpoint
     *     The URI of the device authorization endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setDeviceAuthorizationEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->deviceAuthorizationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the verification URI for the device flow. This URI is used as the
     * value of the `verification_uri` parameter in responses from the device
     * authorization endpoint.
     *
     * @return string
     *     The verification URI.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getDeviceVerificationUri(): ?string
    {
        return $this->deviceVerificationUri;
    }


    /**
     * Set the verification URI for the device flow. This URI is used as the
     * value of the `verification_uri` parameter in responses from the device
     * authorization endpoint.
     *
     * @param string $uri
     *     The verification URI.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setDeviceVerificationUri(string $uri): Service
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->deviceVerificationUri = $uri;

        return $this;
    }


    /**
     * Get the verification URI for the device flow with a placeholder for a
     * user code. This URI is used to build the value of the
     * `verification_uri_complete` parameter in responses from the device
     * authorization endpoint.
     *
     * @return string
     *     The verification URI with a placeholder for a user code.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getDeviceVerificationUriComplete(): ?string
    {
        return $this->deviceVerificationUriComplete;
    }


    /**
     * Set the verification URI for the device flow with a placeholder for a
     * user code. This URI is used to build the value of the
     * `verification_uri_complete` parameter in responses from the device
     * authorization endpoint.
     *
     * It is expected that the URI contains a fixed string `USER_CODE`
     * somewhere as a placeholder for a user code. For example,
     * `https://example.com/device?user_code=USER_CODE`.
     *
     * The fixed string is replaced with an actual user code when Authlete
     * builds a verification URI with a user code for the
     * `verification_uri_complete` parameter.
     *
     * If this URI is not set, the `verification_uri_complete` parameter won't
     * appear in device authorization responses.
     *
     * @param string $uri
     *     The verification URI with a placeholder for a user code.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setDeviceVerificationUriComplete(string $uri): Service
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->deviceVerificationUriComplete = $uri;

        return $this;
    }


    /**
     * Get the duration of device verification codes and end-user verification
     * codes issued from the device authorization endpoint in seconds. This is
     * used as the value of the `expires_in` property in responses from the
     * device authorization endpoint.
     *
     * @return integer|string
     *     The duration of device verification codes and end-user verification
     *     codes in seconds.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getDeviceFlowCodeDuration()
    {
        return $this->deviceFlowCodeDuration;
    }


    /**
     * Set the duration of device verification codes and end-user verification
     * codes issued from the device authorization endpoint in seconds. This is
     * used as the value of the `expires_in` property in responses from the
     * device authorization endpoint.
     *
     * @param integer|string $duration
     *     The duration of device verification codes and end-user verification
     *     codes in seconds.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setDeviceFlowCodeDuration($duration): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->deviceFlowCodeDuration = $duration;

        return $this;
    }


    /**
     * Get the minimum interval between polling requests to the token endpoint
     * from client applications in seconds. This is used as the value of the
     * `interval` property in responses from the device authorization endpoint.
     *
     * @return integer
     *     The minimum interval between polling requests in seconds.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getDeviceFlowPollingInterval(): int
    {
        return $this->deviceFlowPollingInterval;
    }


    /**
     * Set the minimum interval between polling requests to the token endpoint
     * from client applications in seconds. This is used as the value of the
     * `interval` property in responses from the device authorization endpoint.
     *
     * @param integer $interval
     *     The minimum interval between polling requests in seconds.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setDeviceFlowPollingInterval(int $interval): Service
    {
        ValidationUtility::ensureInteger('$interval', $interval);

        $this->deviceFlowPollingInterval = $interval;

        return $this;
    }


    /**
     * Get the character set for end-user verification codes (`user_code`)
     * for the device flow.
     *
     * @return UserCodeCharset
     *     The character set for end-user verification codes.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getUserCodeCharset(): ?UserCodeCharset
    {
        return $this->userCodeCharset;
    }


    /**
     * Set the character set for end-user verification codes (`user_code`)
     * for the device flow.
     *
     * @param UserCodeCharset $charset
     *     The character set for end-user verification codes.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setUserCodeCharset(UserCodeCharset $charset = null): Service
    {
        $this->userCodeCharset = $charset;

        return $this;
    }


    /**
     * Get the length of end-user verification codes (`user_code`) for the
     * device flow.
     *
     * @return integer
     *     The length of end-user verification codes.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getUserCodeLength(): int
    {
        return $this->userCodeLength;
    }


    /**
     * Set the length of end-user verification codes (`user_code`) for the
     * device flow.
     *
     * @param integer $length
     *     The length of end-user verification codes. The value must not be
     *     negative and must not be greater than 255.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function setUserCodeLength(int $length): Service
    {
        ValidationUtility::ensureInteger('$length', $length);

        $this->userCodeLength = $length;

        return $this;
    }


    /**
     * Get the URI of the pushed authorization request endpoint. This property
     * corresponds to the `pushed_authorization_request_endpoint` metadata
     * defined in "OAuth 2.0 Pushed Authorization Requests".
     *
     * @return string
     *     The URI of the pushed authorization request endpoint.
     *
     * @since 1.8
     */
    public function getPushedAuthReqEndpoint(): ?string
    {
        return $this->pushedAuthReqEndpoint;
    }


    /**
     * Set the URI of the pushed authorization request endpoint. This property
     * corresponds to the `pushed_authorization_request_endpoint` metadata
     * defined in "OAuth 2.0 Pushed Authorization Requests".
     *
     * @param string $endpoint
     *     The URI of the pushed authorization request endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setPushedAuthReqEndpoint(string $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->pushedAuthReqEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the MTLS endpoint aliases.
     *
     * This property corresponds to the `mtls_endpoint_aliases` metadata
     * defined in [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @return NamedUri[]
     *     MTLS endpoint aliases.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getMtlsEndpointAliases(): ?array
    {
        return $this->mtlsEndpointAliases;
    }


    /**
     * Set the MTLS endpoint aliases.
     *
     * This property corresponds to the `mtls_endpoint_aliases` metadata
     * defined in [RFC 8705](https://www.rfc-editor.org/rfc/rfc8705.html).
     *
     * @param NamedUri[] $aliases
     *     MTLS endpoint aliases.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setMtlsEndpointAliases(array $aliases = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$aliases', __NAMESPACE__ . '\NamedUri', $aliases);

        $this->mtlsEndpointAliases = $aliases;

        return $this;
    }


    /**
     * Get the supported data types that can be used as values of the `type`
     * field in `authorization_details`.
     *
     * This property corresponds to the `authorization_data_types_supported`
     * metadata defined in "OAuth 2.0 Rich Authorization Requests".
     *
     * @return string[]
     *     Supported data types.
     *
     * @since 1.8
     */
    public function getSupportedAuthorizationDataTypes(): ?array
    {
        return $this->supportedAuthorizationDataTypes;
    }


    /**
     * Set the supported data types that can be used as values of the `type`
     * field in `authorization_details`.
     *
     * This property corresponds to the `authorization_data_types_supported`
     * metadata defined in "OAuth 2.0 Rich Authorization Requests".
     *
     * @param string[] $types
     *     Supported data types.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setSupportedAuthorizationDataTypes(array $types = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$types', $types);

        $this->supportedAuthorizationDataTypes = $types;

        return $this;
    }


    /**
     * Get trust frameworks supported by this service.
     *
     * This property corresponds to the `trust_frameworks_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @return string[]
     *     Supported trust frameworks.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function getSupportedTrustFrameworks(): ?array
    {
        return $this->supportedTrustFrameworks;
    }


    /**
     * Set trust frameworks supported by this service.
     *
     * This property corresponds to the `trust_frameworks_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @param string[] $frameworks
     *     Supported trust frameworks.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function setSupportedTrustFrameworks(array $frameworks = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$frameworks', $frameworks);

        $this->supportedTrustFrameworks = $frameworks;

        return $this;
    }


    /**
     * Get evidence supported by this service.
     *
     * This property corresponds to the `evidence_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @return string[]
     *     Supported evidence.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function getSupportedEvidence(): ?array
    {
        return $this->supportedEvidence;
    }


    /**
     * Set evidence supported by this service.
     *
     * This property corresponds to the `evidence_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @param string[] $evidence
     *     Supported evidence.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function setSupportedEvidence(array $evidence = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$evidence', $evidence);

        $this->supportedEvidence = $evidence;

        return $this;
    }


    /**
     * Get identity documents supported by this service.
     *
     * This property corresponds to the `id_documents_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @return string[]
     *     Supported identity documents.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function getSupportedIdentityDocuments(): ?array
    {
        return $this->supportedIdentityDocuments;
    }


    /**
     * Set identity documents supported by this service.
     *
     * This property corresponds to the `id_documents_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @param string[] $documents
     *     Supported identity documents.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function setSupportedIdentityDocuments(array $documents = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$documents', $documents);

        $this->supportedIdentityDocuments = $documents;

        return $this;
    }


    /**
     * Get verification methods supported by this service.
     *
     * This property corresponds to the `id_documents_verification_methods_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @return string[]
     *     Supported verification methods.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function getSupportedVerificationMethods(): ?array
    {
        return $this->supportedVerificationMethods;
    }


    /**
     * Set verification methods supported by this service.
     *
     * This property corresponds to the `id_documents_verification_methods_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @param string[] $methods
     *     Supported verification methods.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function setSupportedVerificationMethods(array $methods = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$methods', $methods);

        $this->supportedVerificationMethods = $methods;

        return $this;
    }


    /**
     * Get verified claims supported by this service.
     *
     * This property corresponds to the `claims_in_verified_claims_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @return string[]
     *     Supported verified claims.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function getSupportedVerifiedClaims(): ?array
    {
        return $this->supportedVerifiedClaims;
    }


    /**
     * Set verified claims supported by this service.
     *
     * This property corresponds to the `claims_in_verified_claims_supported`
     * metadata defined in "OpenID Connect for Identity Assurance 1.0".
     *
     * @param string[] $claims
     *     Supported verified claims.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function setSupportedVerifiedClaims(array $claims = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->supportedVerifiedClaims = $claims;

        return $this;
    }


    /**
     * Get the flag which indicates whether token requests from public clients
     * without the `client_id` request parameter are allowed when the client
     * can be guessed from `authorization_code` or `refresh_token`.
     *
     * This flag should not be set unless you have special reasons.
     *
     * @return boolean
     *     `true` if token requests from public clients without the `client_id`
     *     request parameter are allowed in the authorization code flow and the
     *     refresh token flow.
     *
     * @since 1.8
     */
    public function isMissingClientIdAllowed(): bool
    {
        return $this->missingClientIdAllowed;
    }


    /**
     * Set the flag which indicates whether token requests from public clients
     * without the `client_id` request parameter are allowed when the client
     * can be guessed from `authorization_code` or `refresh_token`.
     *
     * This flag should not be set unless you have special reasons.
     *
     * @param boolean $allowed
     *     `true` to allow token requests from public clients without the
     *     `client_id` request parameter are allowed in the authorization code
     *     flow and the refresh token flow.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setMissingClientIdAllowed(bool $allowed): Service
    {
        ValidationUtility::ensureBoolean('$allowed', $allowed);

        $this->missingClientIdAllowed = $allowed;

        return $this;
    }


    /**
     * Get the flag which indicates whether this service requires that clients
     * use PAR.
     *
     * This property corresponds to the `require_pushed_authorization_requests`
     * metadata defined in "OAuth 2.0 Pushed Authorization Requests" (PAR).
     *
     * @return boolean
     *     `true` if clients of this service are required to use PAR.
     *
     * @since 1.8
     */
    public function isParRequired(): bool
    {
        return $this->parRequired;
    }


    /**
     * Set the flag which indicates whether this service requires that clients
     * use PAR.
     *
     * This property corresponds to the `require_pushed_authorization_requests`
     * metadata defined in "OAuth 2.0 Pushed Authorization Requests" (PAR).
     *
     * @param boolean $required
     *     `true` to indicate that this service requires that clients use PAR.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setParRequired(bool $required): Service
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->parRequired = $required;

        return $this;
    }


    /**
     * Get the flag which indicates whether this service requires that
     * authorization requests always utilize a request object by using either
     * `request` or `request_uri` request parameter.
     *
     * If this method returns true and
     * `isTraditionalRequestObjectProcessingApplied()` returns false, the value
     * of `require_signed_request_object` server metadata of this service is
     * reported as true in the discovery document. The metadata is defined in
     * JAR (JWT Secured Authorization Request). That
     * `require_signed_request_object` is true means that authorization
     * requests which don't conform to the JAR specification are rejected.
     *
     * @return boolean
     *     `true` if this service requires that authorization requests always
     *     utilize a request object.
     *
     * @since 1.9
     */
    public function isRequestObjectRequired(): bool
    {
        return $this->requestObjectRequired;
    }


    /**
     * Set the flag which indicates whether this service requires that
     * authorization requests always utilize a request object by using either
     * `request` or `request_uri` request parameter.
     *
     * @param boolean $required
     *     `true` to require that authorization requests always utilize a
     *     request object.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.9
     */
    public function setRequestObjectRequired(bool $required): Service
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->requestObjectRequired = $required;

        return $this;
    }


    /**
     * Get the flag which indicates whether a request object is processed based
     * on rules defined in OpenID Connect Core 1.0 or JAR (JWT Secured
     * Authorization Request).
     *
     * Differences between rules in OpenID Connect Core 1.0 and ones in JAR are
     * as follows.
     *
     * 1. JAR requires that a request object be always signed.
     *
     * 2. JAR does not allow request parameters outside a request object to be
     * referred to.
     *
     * 3. OIDC Core 1.0 requires that `response_type` request parameter exist
     * outside a request object even if the request object includes the
     * request parameter.
     *
     * 4. OIDC Core 1.0 requires that `scope` request parameter exist outside
     * a request object if the authorization request is an OIDC request even
     * if the request object includes the request parameter.
     *
     * If this method returns false and `isRequestObjectRequired()` method
     * returns true, the value of `require_signed_request_object` server
     * metadata of this service is reported as true in the discovery document.
     * That `require_signed_request_object` is true means that authorization
     * requests which don't conform to the JAR specification are rejected.
     *
     * @return boolean
     *     `true` if rules defined in OpenID Connect Core 1.0 are applied on
     *     processing a request object. `false` if rules defined in JAR (JWT
     *     Secured Authorization Request) are applied.
     *
     * @since 1.9
     */
    public function isTraditionalRequestObjectProcessingApplied(): bool
    {
        return $this->traditionalRequestObjectProcessingApplied;
    }


    /**
     * Set the flag which indicates whether a request object is processed based
     * on rules defined in OpenID Connect Core 1.0 or JAR (JWT Secured
     * Authorization Request).
     *
     * See the description of `isTraditionalRequestObjectProcessingApplied()`
     * method for details.
     *
     * @param boolean $applied
     *     `true` to apply rules defined in OpenID Connect Core 1.0 on processing
     *     a request object. `false` to apply rules defined in JAR instead.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.9
     */
    public function setTraditionalRequestObjectProcessingApplied(bool $applied): Service
    {
        ValidationUtility::ensureBoolean('$applied', $applied);

        $this->traditionalRequestObjectProcessingApplied = $applied;

        return $this;
    }


    /**
     * Get the flag which indicates whether claims specified by shortcut scopes
     * (e.g. `profile`) are included in the issued ID token only when no access
     * token is issued.
     *
     * @return boolean
     *     `true` if claims specified by shortcut scopes are included in the
     *     issued ID token only when no access token is issued. `false` if the
     *     claims are included in the issued ID token regardless of whether an
     *     access token is issued or not.
     *
     * @since 1.9
     */
    public function isClaimShortcutRestrictive(): bool
    {
        return $this->claimShortcutRestrictive;
    }


    /**
     * Set the flag which indicates whether claims specified by shortcut scopes
     * (e.g. `profile`) are included in the issued ID token only when no access
     * token is issued.
     *
     * To strictly conform to the description below excerpted from OpenID
     * Connect Core 1.0 Section 5.4, true has to be set.
     *
     * "The Claims requested by the `profile`, `email`, `address`, and `phone`
     * scope values are returned from the UserInfo Endpoint, as described in
     * Section 5.3.2, when a `response_type` value is used that results in an
     * Access Token being issued. However, when no Access Token is issued
     * (which is the case for `response_type` value `id_token`), the resulting
     * Claims are returned in the ID Token."
     *
     * @param boolean $restrictive
     *     `true` to include claims specified by shortcut scopes in the issued
     *     ID token only when no access token is issued. `false` to include the
     *     claims in the issued ID token regardless of whether an access token
     *     is issued or not.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.9
     */
    public function setClaimShortcutRestrictive(bool $restrictive): Service
    {
        ValidationUtility::ensureBoolean('$restrictive', $restrictive);

        $this->claimShortcutRestrictive = $restrictive;

        return $this;
    }


    /**
     * Get the flag which indicates whether requests that request no scope are
     * rejected or not.
     *
     * When a request has no explicit `scope` parameter and the service's
     * pre-defined default scope set is empty, the authorization server regards
     * the request requests no scope. When this method returns true, requests
     * that request no scope are rejected.
     *
     * @return boolean
     *     `true` if the authorization server rejects requests that request no
     *     scope. `false` if the authorization server admits requests that
     *     request no scope.
     *
     * @since 1.9
     */
    public function isScopeRequired(): bool
    {
        return $this->scopeRequired;
    }


    /**
     * Set the flag which indicates whether requests that request no scope are
     * rejected or not.
     *
     * When a request has no explicit `scope` parameter and the service's
     * pre-defined default scope set is empty, the authorization server regards
     * the request requests no scope. When true is set by this method, requests
     * that request no scope are rejected.
     *
     * @param boolean $required
     *     `true` to reject requests that request no scope.
     *     `false` to admit requests that request no scope.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.9
     */
    public function setScopeRequired(bool $required): Service
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->scopeRequired = $required;

        return $this;
    }


    /**
     * Get the flag indicating whether the `nbf` claim in the request object
     * is optional even when the authorization request is regarded as a
     * FAPI-Part2 request.
     *
     * The final version of Financial-grade API was approved in January, 2021.
     * The Part 2 of the final version has new requirements on lifetime of
     * request objects. They require that request objects contain an `nbf`
     * claim and the lifetime computed by `exp - nbf` be no longer than 60
     * minutes.
     *
     * Therefore, when an authorization request is regarded as a FAPI-Part2
     * request, the request object used in the authorization request must
     * contain an `nbf` claim. Otherwise, the authorization server rejects
     * the authorization request.
     *
     * When this flag is `true`, the `nbf` claim is treated as an optional
     * claim even when the authorization request is regarded as a FAPI-Part2
     * request. That is, the authorization server does not perform the
     * validation on lifetime of the request object.
     *
     * Skipping the validation is a violation of the FAPI specification. The
     * reason why this flag has been prepared nevertheless is that the new
     * requirements (which do not exist in the Implementer's Draft 2 released
     * in October, 2018) have big impacts on deployed implementations of client
     * applications and Authlete thinks there should be a mechanism whereby to
     * make the migration from ID2 to Final smooth without breaking live
     * systems.
     *
     * @return boolean
     *     `true` if the `nbf` claim is treated as an optional claim even when
     *     the authorization request is regarded as a FAPI-Part2 request.
     *
     * @since 1.10
     */
    public function isNbfOptional(): bool
    {
        return $this->nbfOptional;
    }


    /**
     * Set the flag indicating whether the `nbf` claim in the request object
     * is optional even when the authorization request is regarded as a
     * FAPI-Part2 request.
     *
     * See the description of `isNbfOptional()` for details about this flag.
     *
     * @param boolean $optional
     *     `true` to treat the `nbf` claim as an optional claim.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.10
     */
    public function setNbfOptional($optional)
    {
        ValidationUtility::ensureBoolean('$optional', $optional);

        $this->nbfOptional = $optional;

        return $this;
    }


    /**
     * Get the flag indicating whether generation of the `iss` response
     * parameter is suppressed.
     *
     * "OAuth 2.0 Authorization Server Issuer Identifier in Authorization
     * Response" has defined a new authorization response parameter, `iss`,
     * as a countermeasure for a certain type of mix-up attacks.
     *
     * The specification requires that the `iss` response parameter always
     * be included in authorization responses unless JARM (JWT Secured
     * Authorization Response Mode) is used.
     *
     * When this flag is `true`, the authorization server does not include
     * the `iss` response parameter in authorization responses. By turning
     * this flag on and off, developers can experiment the mix-up attack
     * and the effect of the `iss` response parameter.
     *
     * Note that this flag should not be `true` in production environment
     * unless there are special reasons for it.
     *
     * @return boolean
     *     `true` if the authorization server does not include the `iss`
     *     response parameter in authorization responses.
     *
     * @since 1.10
     */
    public function isIssSuppressed(): bool
    {
        return $this->issSuppressed;
    }


    /**
     * Set the flag indicating whether generation of the `iss` response
     * parameter is suppressed.
     *
     * See the description of `isIssSuppressed()` for details about this flag.
     *
     * @param boolean $suppressed
     *     `true` to make the authorization server suppress the `iss` response
     *     parameter.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.10
     */
    public function setIssSuppressed(bool $suppressed): Service
    {
        ValidationUtility::ensureBoolean('$suppressed', $suppressed);

        $this->issSuppressed = $suppressed;

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
        $array['serviceName']                                 = $this->serviceName;
        $array['apiKey']                                      = $this->apiKey;
        $array['apiSecret']                                   = $this->apiSecret;
        $array['issuer']                                      = $this->issuer;
        $array['authorizationEndpoint']                       = $this->authorizationEndpoint;
        $array['tokenEndpoint']                               = $this->tokenEndpoint;
        $array['revocationEndpoint']                          = $this->revocationEndpoint;
        $array['supportedRevocationAuthMethods']              = LanguageUtility::convertArrayToStringArray($this->supportedRevocationAuthMethods);
        $array['userInfoEndpoint']                            = $this->userInfoEndpoint;
        $array['jwksUri']                                     = $this->jwksUri;
        $array['jwks']                                        = $this->jwks;
        $array['registrationEndpoint']                        = $this->registrationEndpoint;
        $array['registrationManagementEndpoint']              = $this->registrationManagementEndpoint;
        $array['supportedScopes']                             = LanguageUtility::convertArrayOfArrayCopyableToArray($this->supportedScopes);
        $array['supportedResponseTypes']                      = LanguageUtility::convertArrayToStringArray($this->supportedResponseTypes);
        $array['supportedGrantTypes']                         = LanguageUtility::convertArrayToStringArray($this->supportedGrantTypes);
        $array['supportedAcrs']                               = $this->supportedAcrs;
        $array['supportedTokenAuthMethods']                   = LanguageUtility::convertArrayToStringArray($this->supportedTokenAuthMethods);
        $array['supportedDisplays']                           = LanguageUtility::convertArrayToStringArray($this->supportedDisplays);
        $array['supportedClaimTypes']                         = LanguageUtility::convertArrayToStringArray($this->supportedClaimTypes);
        $array['supportedClaims']                             = $this->supportedClaims;
        $array['serviceDocumentation']                        = $this->serviceDocumentation;
        $array['supportedClaimLocales']                       = $this->supportedClaimLocales;
        $array['supportedUiLocales']                          = $this->supportedUiLocales;
        $array['policyUri']                                   = $this->policyUri;
        $array['tosUri']                                      = $this->tosUri;
        $array['authenticationCallbackEndpoint']              = $this->authenticationCallbackEndpoint;
        $array['authenticationCallbackApiKey']                = $this->authenticationCallbackApiKey;
        $array['authenticationCallbackApiSecret']             = $this->authenticationCallbackApiSecret;
        $array['supportedSnses']                              = LanguageUtility::convertArrayToStringArray($this->supportedSnses);
        $array['snsCredentials']                              = LanguageUtility::convertArrayOfArrayCopyableToArray($this->snsCredentials);
        $array['createdAt']                                   = LanguageUtility::orZero($this->createdAt);
        $array['modifiedAt']                                  = LanguageUtility::orZero($this->modifiedAt);
        $array['developerAuthenticationCallbackEndpoint']     = $this->developerAuthenticationCallbackEndpoint;
        $array['developerAuthenticationCallbackApiKey']       = $this->developerAuthenticationCallbackApiKey;
        $array['developerAuthenticationCallbackApiSecret']    = $this->developerAuthenticationCallbackApiSecret;
        $array['supportedDeveloperSnses']                     = LanguageUtility::convertArrayToStringArray($this->supportedDeveloperSnses);
        $array['developerSnsCredentials']                     = LanguageUtility::convertArrayOfArrayCopyableToArray($this->developerSnsCredentials);
        $array['clientsPerDeveloper']                         = $this->clientsPerDeveloper;
        $array['directAuthorizationEndpointEnabled']          = $this->directAuthorizationEndpointEnabled;
        $array['directTokenEndpointEnabled']                  = $this->directTokenEndpointEnabled;
        $array['directRevocationEndpointEnabled']             = $this->directRevocationEndpointEnabled;
        $array['directUserInfoEndpointEnabled']               = $this->directUserInfoEndpointEnabled;
        $array['directJwksEndpointEnabled']                   = $this->directJwksEndpointEnabled;
        $array['directIntrospectionEndpointEnabled']          = $this->directIntrospectionEndpointEnabled;
        $array['singleAccessTokenPerSubject']                 = $this->singleAccessTokenPerSubject;
        $array['pkceRequired']                                = $this->pkceRequired;
        $array['pkceS256Required']                            = $this->pkceS256Required;
        $array['refreshTokenKept']                            = $this->refreshTokenKept;
        $array['refreshTokenDurationKept']                    = $this->refreshTokenDurationKept;
        $array['errorDescriptionOmitted']                     = $this->errorDescriptionOmitted;
        $array['errorUriOmitted']                             = $this->errorUriOmitted;
        $array['clientIdAliasEnabled']                        = $this->clientIdAliasEnabled;
        $array['supportedServiceProfiles']                    = LanguageUtility::convertArrayToStringArray($this->supportedServiceProfiles);
        $array['tlsClientCertificateBoundAccessTokens']       = $this->tlsClientCertificateBoundAccessTokens;
        $array['introspectionEndpoint']                       = $this->introspectionEndpoint;
        $array['supportedIntrospectionAuthMethods']           = LanguageUtility::convertArrayToStringArray($this->supportedIntrospectionAuthMethods);
        $array['mutualTlsValidatePkiCertChain']               = $this->mutualTlsValidatePkiCertChain;
        $array['trustedRootCertificates']                     = $this->trustedRootCertificates;
        $array['dynamicRegistrationSupported']                = $this->dynamicRegistrationSupported;
        $array['endSessionEndpoint']                          = $this->endSessionEndpoint;
        $array['description']                                 = $this->description;
        $array['accessTokenType']                             = $this->accessTokenType;
        $array['accessTokenSignAlg']                          = LanguageUtility::toString($this->accessTokenSignAlg);
        $array['accessTokenDuration']                         = $this->accessTokenDuration;
        $array['refreshTokenDuration']                        = $this->refreshTokenDuration;
        $array['idTokenDuration']                             = $this->idTokenDuration;
        $array['authorizationResponseDuration']               = $this->authorizationResponseDuration;
        $array['pushedAuthReqDuration']                       = $this->pushedAuthReqDuration;
        $array['accessTokenSignatureKeyId']                   = $this->accessTokenSignatureKeyId;
        $array['authorizationSignatureKeyId']                 = $this->authorizationSignatureKeyId;
        $array['idTokenSignatureKeyId']                       = $this->idTokenSignatureKeyId;
        $array['userInfoSignatureKeyId']                      = $this->userInfoSignatureKeyId;
        $array['supportedBackchannelTokenDeliveryModes']      = LanguageUtility::convertArrayToStringArray($this->supportedBackchannelTokenDeliveryModes);
        $array['backchannelAuthenticationEndpoint']           = $this->backchannelAuthenticationEndpoint;
        $array['backchannelUserCodeParameterSupported']       = $this->backchannelUserCodeParameterSupported;
        $array['backchannelAuthReqIdDuration']                = $this->backchannelAuthReqIdDuration;
        $array['backchannelPollingInterval']                  = $this->backchannelPollingInterval;
        $array['backchannelBindingMessageRequiredInFapi']     = $this->backchannelBindingMessageRequiredInFapi;
        $array['allowableClockSkew']                          = $this->allowableClockSkew;
        $array['deviceAuthorizationEndpoint']                 = $this->deviceAuthorizationEndpoint;
        $array['deviceVerificationUri']                       = $this->deviceVerificationUri;
        $array['deviceVerificationUriComplete']               = $this->deviceVerificationUriComplete;
        $array['deviceFlowCodeDuration']                      = $this->deviceFlowCodeDuration;
        $array['deviceFlowPollingInterval']                   = $this->deviceFlowPollingInterval;
        $array['userCodeCharset']                             = LanguageUtility::toString($this->userCodeCharset);
        $array['userCodeLength']                              = $this->userCodeLength;
        $array['pushedAuthReqEndpoint']                       = $this->pushedAuthReqEndpoint;
        $array['mtlsEndpointAliases']                         = LanguageUtility::convertArrayOfArrayCopyableToArray($this->mtlsEndpointAliases);
        $array['supportedAuthorizationDataTypes']             = $this->supportedAuthorizationDataTypes;
        $array['supportedTrustFrameworks']                    = $this->supportedTrustFrameworks;
        $array['supportedEvidence']                           = $this->supportedEvidence;
        $array['supportedIdentityDocuments']                  = $this->supportedIdentityDocuments;
        $array['supportedVerificationMethods']                = $this->supportedVerificationMethods;
        $array['supportedVerifiedClaims']                     = $this->supportedVerifiedClaims;
        $array['missingClientIdAllowed']                      = $this->missingClientIdAllowed;
        $array['parRequired']                                 = $this->parRequired;
        $array['requestObjectRequired']                       = $this->requestObjectRequired;
        $array['traditionalRequestObjectProcessingApplied']   = $this->traditionalRequestObjectProcessingApplied;
        $array['claimShortcutRestrictive']                    = $this->claimShortcutRestrictive;
        $array['scopeRequired']                               = $this->scopeRequired;
        $array['nbfOptional']                                 = $this->nbfOptional;
        $array['issSuppressed']                               = $this->issSuppressed;
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
        // serviceName
        $this->setServiceName(
            LanguageUtility::getFromArray('serviceName', $array));

        // apiKey
        $this->setApiKey(
            LanguageUtility::getFromArray('apiKey', $array));

        // apiSecret
        $this->setApiSecret(
            LanguageUtility::getFromArray('apiSecret', $array));

        // issuer
        $this->setIssuer(
            LanguageUtility::getFromArray('issuer', $array));

        // authorizationEndpoint
        $this->setAuthorizationEndpoint(
            LanguageUtility::getFromArray('authorizationEndpoint', $array));

        // tokenEndpoint
        $this->setTokenEndpoint(
            LanguageUtility::getFromArray('tokenEndpoint', $array));

        // revocationEndpoint
        $this->setRevocationEndpoint(
            LanguageUtility::getFromArray('revocationEndpoint', $array));

        // supportedRevocationAuthMethods
        $_supported_revocation_auth_methods = LanguageUtility::getFromArray('supportedRevocationAuthMethods', $array);
        $_supported_revocation_auth_methods = LanguageUtility::convertArray('\Authlete\Types\ClientAuthMethod::valueOf', $_supported_revocation_auth_methods);
        $this->setSupportedRevocationAuthMethods($_supported_revocation_auth_methods);

        // userInfoEndpoint
        $this->setUserInfoEndpoint(
            LanguageUtility::getFromArray('userInfoEndpoint', $array));

        // jwksUri
        $this->setJwksUri(
            LanguageUtility::getFromArray('jwksUri', $array));

        // jwks
        $this->setJwks(
            LanguageUtility::getFromArray('jwks', $array));

        // registrationEndpoint
        $this->setRegistrationEndpoint(
            LanguageUtility::getFromArray('registrationEndpoint', $array));

        // registrationManagementEndpoint
        $this->setRegistrationManagementEndpoint(
            LanguageUtility::getFromArray('registrationManagementEndpoint', $array));

        // supportedScopes
        $_supported_scopes = LanguageUtility::getFromArray('supportedScopes', $array);
        $_supported_scopes = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Scope', $_supported_scopes);
        $this->setSupportedScopes($_supported_scopes);

        // supportedResponseTypes
        $_supported_response_types = LanguageUtility::getFromArray('supportedResponseTypes', $array);
        $_supported_response_types = LanguageUtility::convertArray('\Authlete\Types\ResponseType::valueOf', $_supported_response_types);
        $this->setSupportedResponseTypes($_supported_response_types);

        // supportedGrantTypes
        $_supported_grant_types = LanguageUtility::getFromArray('supportedGrantTypes', $array);
        $_supported_grant_types = LanguageUtility::convertArray('\Authlete\Types\GrantType::valueOf', $_supported_grant_types, );
        $this->setSupportedGrantTypes($_supported_grant_types);

        // supportedAcrs
        $_supported_acrs = LanguageUtility::getFromArray('supportedAcrs', $array);
        $this->setSupportedAcrs($_supported_acrs);

        // supportedTokenAuthMethods
        $_supported_token_auth_methods = LanguageUtility::getFromArray('supportedTokenAuthMethods', $array);
        $_supported_token_auth_methods = LanguageUtility::convertArray('\Authlete\Types\ClientAuthMethod::valueOf', $_supported_token_auth_methods);
        $this->setSupportedTokenAuthMethods($_supported_token_auth_methods);

        // supportedDisplays
        $_supported_displays = LanguageUtility::getFromArray('supportedDisplays', $array);
        $_supported_displays = LanguageUtility::convertArray('\Authlete\Types\Display::valueOf', $_supported_displays);
        $this->setSupportedDisplays($_supported_displays);

        // supportedClaimTypes
        $_supported_claim_types = LanguageUtility::getFromArray('supportedClaimTypes', $array);
        $_supported_claim_types = LanguageUtility::convertArray('\Authlete\Types\ClaimType::valueOf', $_supported_claim_types);
        $this->setSupportedClaimTypes($_supported_claim_types);

        // supportedClaims
        $_supported_claims = LanguageUtility::getFromArray('supportedClaims', $array);
        $this->setSupportedClaims($_supported_claims);

        // serviceDocumentation
        $this->setServiceDocumentation(
            LanguageUtility::getFromArray('serviceDocumentation', $array));

        // supportedClaimLocales
        $_supported_claim_locales = LanguageUtility::getFromArray('supportedClaimLocales', $array);
        $this->setSupportedClaimLocales($_supported_claim_locales);

        // supportedUiLocales
        $_supported_ui_locales = LanguageUtility::getFromArray('supportedUiLocales', $array);
        $this->setSupportedUiLocales($_supported_ui_locales);

        // policyUri
        $this->setPolicyUri(
            LanguageUtility::getFromArray('policyUri', $array));

        // tosUri
        $this->setTosUri(
            LanguageUtility::getFromArray('tosUri', $array));

        // authenticationCallbackEndpoint
        $this->setAuthenticationCallbackEndpoint(
            LanguageUtility::getFromArray('authenticationCallbackEndpoint', $array));

        // authenticationCallbackApiKey
        $this->setAuthenticationCallbackApiKey(
            LanguageUtility::getFromArray('authenticationCallbackApiKey', $array));

        // authenticationCallbackApiSecret
        $this->setAuthenticationCallbackApiSecret(
            LanguageUtility::getFromArray('authenticationCallbackApiSecret', $array));

        // supportedSnses
        $_supported_snses = LanguageUtility::getFromArray('supportedSnses', $array);
        $_supported_snses = LanguageUtility::convertArray('\Authlete\Types\Sns::valueOf', $_supported_snses);
        $this->setSupportedSnses($_supported_snses);

        // snsCredentials
        $_sns_credentials = LanguageUtility::getFromArray('snsCredentials', $array);
        $_sns_credentials = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\SnsCredentials', $_sns_credentials);
        $this->setSnsCredentials($_sns_credentials);

        // createdAt
        $this->setCreatedAt(
            LanguageUtility::getFromArray('createdAt', $array));

        // modifiedAt
        $this->setModifiedAt(
            LanguageUtility::getFromArray('modifiedAt', $array));

        // developerAuthenticationCallbackEndpoint
        $this->setDeveloperAuthenticationCallbackEndpoint(
            LanguageUtility::getFromArray('developerAuthenticationCallbackEndpoint', $array));

        // developerAuthenticationCallbackApiKey
        $this->setDeveloperAuthenticationCallbackApiKey(
            LanguageUtility::getFromArray('developerAuthenticationCallbackApiKey', $array));

        // developerAuthenticationCallbackApiSecret
        $this->setDeveloperAuthenticationCallbackApiSecret(
            LanguageUtility::getFromArray('developerAuthenticationCallbackApiSecret', $array));

        // supportedDeveloperSnses
        $_supported_developer_snses = LanguageUtility::getFromArray('supportedDeveloperSnses', $array);
        $_supported_developer_snses = LanguageUtility::convertArray('\Authlete\Types\Sns::valueOf', $_supported_developer_snses);
        $this->setSupportedDeveloperSnses($_supported_developer_snses);

        // developerSnsCredentials
        $_developer_sns_credentials = LanguageUtility::getFromArray('developerSnsCredentials', $array);
        $_developer_sns_credentials = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\SnsCredentials', $_developer_sns_credentials);
        $this->setDeveloperSnsCredentials($_developer_sns_credentials);

        // clientsPerDeveloper
        $this->setClientsPerDeveloper(
            LanguageUtility::orZero(
                LanguageUtility::getFromArray('clientsPerDeveloper', $array)));

        // directAuthorizationEndpointEnabled
        $this->setDirectAuthorizationEndpointEnabled(
            LanguageUtility::getFromArrayAsBoolean('directAuthorizationEndpointEnabled', $array));

        // directTokenEndpointEnabled
        $this->setDirectTokenEndpointEnabled(
            LanguageUtility::getFromArrayAsBoolean('directTokenEndpointEnabled', $array));

        // directRevocationEndpointEnabled
        $this->setDirectRevocationEndpointEnabled(
            LanguageUtility::getFromArrayAsBoolean('directRevocationEndpointEnabled', $array));

        // directUserInfoEndpointEnabled
        $this->setDirectUserInfoEndpointEnabled(
            LanguageUtility::getFromArrayAsBoolean('directUserInfoEndpointEnabled', $array));

        // directJwksEndpointEnabled
        $this->setDirectJwksEndpointEnabled(
            LanguageUtility::getFromArrayAsBoolean('directJwksEndpointEnabled', $array));

        // directIntrospectionEndpointEnabled
        $this->setDirectIntrospectionEndpointEnabled(
            LanguageUtility::getFromArrayAsBoolean('directIntrospectionEndpointEnabled', $array));

        // singleAccessTokenPerSubject
        $this->setSingleAccessTokenPerSubject(
            LanguageUtility::getFromArrayAsBoolean('singleAccessTokenPerSubject', $array));

        // pkceRequired
        $this->setPkceRequired(
            LanguageUtility::getFromArrayAsBoolean('pkceRequired', $array));

        // pkceS256Required
        $this->setPkceS256Required(
            LanguageUtility::getFromArrayAsBoolean('pkceS256Required', $array));

        // refreshTokenKept
        $this->setRefreshTokenKept(
            LanguageUtility::getFromArrayAsBoolean('refreshTokenKept', $array));

        // refreshTokenDurationKept
        $this->setRefreshTokenDurationKept(
            LanguageUtility::getFromArrayAsBoolean('refreshTokenDurationKept', $array));

        // errorDescriptionOmitted
        $this->setErrorDescriptionOmitted(
            LanguageUtility::getFromArrayAsBoolean('errorDescriptionOmitted', $array));

        // errorUriOmitted
        $this->setErrorUriOmitted(
            LanguageUtility::getFromArrayAsBoolean('errorUriOmitted', $array));

        // clientIdAliasEnabled
        $this->setClientIdAliasEnabled(
            LanguageUtility::getFromArrayAsBoolean('clientIdAliasEnabled', $array));

        // supportedServiceProfiles
        $_supported_service_profiles = LanguageUtility::getFromArray('supportedServiceProfiles', $array);
        $_supported_service_profiles = LanguageUtility::convertArray('\Authlete\Types\ServiceProfile::valueOf', $_supported_service_profiles);
        $this->setSupportedServiceProfiles($_supported_service_profiles);

        // tlsClientCertificateBoundAccessTokens
        $this->setTlsClientCertificateBoundAccessTokens(
            LanguageUtility::getFromArrayAsBoolean('tlsClientCertificateBoundAccessTokens', $array));

        // introspectionEndpoint
        $this->setIntrospectionEndpoint(
            LanguageUtility::getFromArray('introspectionEndpoint', $array));

        // supportedIntrospectionAuthMethods
        $_supported_introspection_auth_methods = LanguageUtility::getFromArray('supportedIntrospectionAuthMethods', $array);
        $_supported_introspection_auth_methods = LanguageUtility::convertArray('\Authlete\Types\ClientAuthMethod::valueOf', $_supported_introspection_auth_methods);
        $this->setSupportedIntrospectionAuthMethods($_supported_introspection_auth_methods);

        // mutualTlsValidatePkiCertChain
        $this->setMutualTlsValidatePkiCertChain(
            LanguageUtility::getFromArrayAsBoolean('mutualTlsValidatePkiCertChain', $array));

        // trustedRootCertificates
        $_trusted_root_certificates = LanguageUtility::getFromArray('trustedRootCertificates', $array);
        $this->setTrustedRootCertificates($_trusted_root_certificates);

        // dynamicRegistrationSupported
        $this->setDynamicRegistrationSupported(
            LanguageUtility::getFromArrayAsBoolean('dynamicRegistrationSupported', $array));

        // endSessionEndpoint
        $this->setEndSessionEndpoint(
            LanguageUtility::getFromArray('endSessionEndpoint', $array));

        // description
        $this->setDescription(
            LanguageUtility::getFromArray('description', $array));

        // accessTokenType
        $this->setAccessTokenType(
            LanguageUtility::getFromArray('accessTokenType', $array));

        // accessTokenSignAlg
        $this->setAccessTokenSignAlg(
            JWSAlg::valueOf(
                LanguageUtility::getFromArray('accessTokenSignAlg', $array)));

        // accessTokenDuration
        $this->setAccessTokenDuration(
            LanguageUtility::getFromArray('accessTokenDuration', $array));

        // refreshTokenDuration
        $this->setRefreshTokenDuration(
            LanguageUtility::getFromArray('refreshTokenDuration', $array));

        // idTokenDuration
        $this->setIdTokenDuration(
            LanguageUtility::getFromArray('idTokenDuration', $array));

        // authorizationResponseDuration
        $this->setAuthorizationResponseDuration(
            LanguageUtility::getFromArray('authorizationResponseDuration', $array));

        // pushedAuthReqDuration
        $this->setPushedAuthReqDuration(
            LanguageUtility::getFromArray('pushedAuthReqDuration', $array));

        // accessTokenSignatureKeyId
        $this->setAccessTokenSignatureKeyId(
            LanguageUtility::getFromArray('accessTokenSignatureKeyId', $array));

        // authorizationSignatureKeyId
        $this->setAuthorizationSignatureKeyId(
            LanguageUtility::getFromArray('authorizationSignatureKeyId', $array));

        // idTokenSignatureKeyId
        $this->setIdTokenSignatureKeyId(
            LanguageUtility::getFromArray('idTokenSignatureKeyId', $array));

        // userInfoSignatureKeyId
        $this->setUserInfoSignatureKeyId(
            LanguageUtility::getFromArray('userInfoSignatureKeyId', $array));

        // supportedBackchannelTokenDeliveryModes
        $_supported_delivery_modes = LanguageUtility::getFromArray('supportedBackchannelTokenDeliveryModes', $array);
        $_supported_delivery_modes = LanguageUtility::convertArray('\Authlete\Types\DeliveryMode::valueOf', $_supported_delivery_modes, );
        $this->setSupportedBackchannelTokenDeliveryModes($_supported_delivery_modes);

        // backchannelAuthenticationEndpoint
        $this->setBackchannelAuthenticationEndpoint(
            LanguageUtility::getFromArray('backchannelAuthenticationEndpoint', $array));

        // backchannelUserCodeParameterSupported
        $this->setBackchannelUserCodeParameterSupported(
            LanguageUtility::getFromArrayAsBoolean('backchannelUserCodeParameterSupported', $array));

        // backchannelAuthReqIdDuration
        $this->setBackchannelAuthReqIdDuration(
            LanguageUtility::getFromArray('backchannelAuthReqIdDuration', $array));

        // backchannelPollingInterval
        $this->setBackchannelPollingInterval(
            LanguageUtility::orZero(
                LanguageUtility::getFromArray('backchannelPollingInterval', $array)));

        // backchannelBindingMessageRequiredInFapi
        $this->setBackchannelBindingMessageRequiredInFapi(
            LanguageUtility::getFromArrayAsBoolean('backchannelBindingMessageRequiredInFapi', $array));

        // allowableClockSkew
        $this->setAllowableClockSkew(
            LanguageUtility::orZero(
                LanguageUtility::getFromArray('allowableClockSkew', $array)));

        // deviceAuthorizationEndpoint
        $this->setDeviceAuthorizationEndpoint(
            LanguageUtility::getFromArray('deviceAuthorizationEndpoint', $array));

        // deviceVerificationUri
        $this->setDeviceVerificationUri(
            LanguageUtility::getFromArray('deviceVerificationUri', $array));

        // deviceVerificationUriComplete
        $this->setDeviceVerificationUriComplete(
            LanguageUtility::getFromArray('deviceVerificationUriComplete', $array));

        // deviceFlowCodeDuration
        $this->setDeviceFlowCodeDuration(
            LanguageUtility::getFromArray('deviceFlowCodeDuration', $array));

        // deviceFlowPollingInterval
        $this->setDeviceFlowPollingInterval(
            LanguageUtility::orZero(
                LanguageUtility::getFromArray('deviceFlowPollingInterval', $array)));

        // userCodeCharset
        $this->setUserCodeCharset(
            UserCodeCharset::valueOf(
                LanguageUtility::getFromArray('userCodeCharset', $array)));

        // userCodeLength
        $this->setUserCodeLength(
            LanguageUtility::orZero(
                LanguageUtility::getFromArray('userCodeLength', $array)));

        // pushedAuthReqEndpoint
        $this->setPushedAuthReqEndpoint(
            LanguageUtility::getFromArray('pushedAuthReqEndpoint', $array));

        // mtlsEndpointAliases
        $_mtls_endpoint_aliases = LanguageUtility::getFromArray('mtlsEndpointAliases', $array);
        $_mtls_endpoint_aliases = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\NamedUri', $_mtls_endpoint_aliases);
        $this->setMtlsEndpointAliases($_mtls_endpoint_aliases);

        // supportedAuthorizationDataTypes
        $_supported_authorization_data_types = LanguageUtility::getFromArray('supportedAuthorizationDataTypes', $array);
        $this->setSupportedAuthorizationDataTypes($_supported_authorization_data_types);

        // supportedTrustFrameworks
        $_supported_trust_frameworks = LanguageUtility::getFromArray('supportedTrustFrameworks', $array);
        $this->setSupportedTrustFrameworks($_supported_trust_frameworks);

        // supportedEvidence
        $_supported_evidence = LanguageUtility::getFromArray('supportedEvidence', $array);
        $this->setSupportedEvidence($_supported_evidence);

        // supportedIdentityDocuments
        $_supported_identity_documents = LanguageUtility::getFromArray('supportedIdentityDocuments', $array);
        $this->setSupportedIdentityDocuments($_supported_identity_documents);

        // supportedVerificationMethods
        $_supported_verification_methods = LanguageUtility::getFromArray('supportedVerificationMethods', $array);
        $this->setSupportedVerificationMethods($_supported_verification_methods);

        // supportedVerifiedClaims
        $_supported_verified_claims = LanguageUtility::getFromArray('supportedVerifiedClaims', $array);
        $this->setSupportedVerifiedClaims($_supported_verified_claims);

        // missingClientIdAllowed
        $this->setMissingClientIdAllowed(
            LanguageUtility::getFromArrayAsBoolean('missingClientIdAllowed', $array));

        // parRequired
        $this->setParRequired(
            LanguageUtility::getFromArrayAsBoolean('parRequired', $array));

        // requestObjectRequired
        $this->setRequestObjectRequired(
            LanguageUtility::getFromArrayAsBoolean('requestObjectRequired', $array));

        // traditionalRequestObjectProcessingApplied
        $this->setTraditionalRequestObjectProcessingApplied(
            LanguageUtility::getFromArrayAsBoolean('traditionalRequestObjectProcessingApplied', $array));

        // claimShortcutRestrictive
        $this->setClaimShortcutRestrictive(
            LanguageUtility::getFromArrayAsBoolean('claimShortcutRestrictive', $array));

        // scopeRequired
        $this->setScopeRequired(
            LanguageUtility::getFromArrayAsBoolean('scopeRequired', $array));

        // nbfOptional
        $this->setNbfOptional(
            LanguageUtility::getFromArrayAsBoolean('nbfOptional', $array));

        // issSuppressed
        $this->setIssSuppressed(
            LanguageUtility::getFromArrayAsBoolean('issSuppressed', $array));
    }
}
