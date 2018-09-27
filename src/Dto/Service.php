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
 * File containing the definition of Service class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\ClaimType;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\Display;
use Authlete\Types\GrantType;
use Authlete\Types\Jsonable;
use Authlete\Types\ResponseType;
use Authlete\Types\ServiceProfile;
use Authlete\Types\Sns;
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


    private $serviceName                                 = null;  // string
    private $apiKey                                      = null;  // string or (64-bit) integer
    private $apiSecret                                   = null;  // string
    private $issuer                                      = null;  // string
    private $authorizationEndpoint                       = null;  // string
    private $tokenEndpoint                               = null;  // string
    private $revocationEndpoint                          = null;  // string
    private $supportedRevocationAuthMethods              = null;  // array of \Authlete\Types\ClientAuthMethod
    private $userInfoEndpoint                            = null;  // string
    private $jwksUri                                     = null;  // string
    private $jwks                                        = null;  // string
    private $registrationEndpoint                        = null;  // string
    private $supportedScopes                             = null;  // array of \Authlete\Dto\Scope
    private $supportedResponseTypes                      = null;  // array of \Authlete\Types\ResponseType
    private $supportedGrantTypes                         = null;  // array of \Authlete\Types\GrantType
    private $supportedAcrs                               = null;  // array of string
    private $supportedTokenAuthMethods                   = null;  // array of \Authlete\Types\ClientAuthMethod
    private $supportedDisplays                           = null;  // array of \Authlete\Types\Display
    private $supportedClaimTypes                         = null;  // array of \Authlete\Types\ClaimType
    private $supportedClaims                             = null;  // array of string
    private $serviceDocumentation                        = null;  // string
    private $supportedClaimLocales                       = null;  // array of string
    private $supportedUiLocales                          = null;  // array of string
    private $policyUri                                   = null;  // string
    private $tosUri                                      = null;  // string
    private $description                                 = null;  // string
    private $accessTokenType                             = null;  // string
    private $accessTokenDuration                         = null;  // string or (64-bit) integer
    private $refreshTokenDuration                        = null;  // string or (64-bit) integer
    private $idTokenDuration                             = null;  // string or (64-bit) integer
    private $authorizationResponseDuration               = null;  // string or (64-bit) integer
    private $authenticationCallbackEndpoint              = null;  // string
    private $authenticationCallbackApiKey                = null;  // string
    private $authenticationCallbackApiSecret             = null;  // string
    private $supportedSnses                              = null;  // array of \Authlete\Types\Sns
    private $snsCredentials                              = null;  // array of \Authlete\Dto\SnsCredentials
    private $createdAt                                   = null;  // string or (64-bit) integer
    private $modifiedAt                                  = null;  // string or (64-bit) integer
    private $developerAuthenticationCallbackEndpoint     = null;  // string
    private $developerAuthenticationCallbackApiKey       = null;  // string
    private $developerAuthenticationCallbackApiSecret    = null;  // string
    private $supportedDeveloperSnses                     = null;  // array of \Authlete\Types\Sns
    private $developerSnsCredentials                     = null;  // array of \Authlete\Dto\SnsCredentials
    private $clientsPerDeveloper                         = 0;     // integer
    private $directAuthorizationEndpointEnabled          = false; // boolean
    private $directTokenEndpointEnabled                  = false; // boolean
    private $directRevocationEndpointEnabled             = false; // boolean
    private $directUserInfoEndpointEnabled               = false; // boolean
    private $directJwksEndpointEnabled                   = false; // boolean
    private $directIntrospectionEndpointEnabled          = false; // boolean
    private $singleAccessTokenPerSubject                 = false; // boolean
    private $pkceRequired                                = false; // boolean
    private $refreshTokenKept                            = false; // boolean
    private $errorDescriptionOmitted                     = false; // boolean
    private $errorUriOmitted                             = false; // boolean
    private $clientIdAliasEnabled                        = false; // boolean
    private $supportedServiceProfiles                    = null;  // array of \Authlete\Types\ServiceProfile
    private $tlsClientCertificateBoundAccessTokens       = false; // boolean
    private $introspectionEndpoint                       = null;  // string
    private $supportedIntrospectionAuthMethods           = null;  // array of \Authlete\Types\ClientAuthMethod
    private $mutualTlsValidatePkiCertChain               = false; // boolean
    private $trustedRootCertificates                     = null;  // array of string
    private $authorizationSignatureKeyId                 = null;  // string
    private $idTokenSignatureKeyId                       = null;  // string
    private $userInfoSignatureKeyId                      = null;  // string


    /**
     * Get the service name.
     *
     * @return string
     *     The service name.
     */
    public function getServiceName()
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
    public function setServiceName($serviceName)
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
    public function setApiKey($apiKey)
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
    public function getApiSecret()
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
    public function setApiSecret($secret)
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
    public function getIssuer()
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
    public function setIssuer($issuer)
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
    public function getAuthorizationEndpoint()
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
    public function setAuthorizationEndpoint($endpoint)
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
    public function getTokenEndpoint()
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
    public function setTokenEndpoint($endpoint)
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
    public function getRevocationEndpoint()
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
    public function setRevocationEndpoint($endpoint)
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
    public function getSupportedRevocationAuthMethods()
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
    public function setSupportedRevocationAuthMethods(array $methods = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$methods', $methods, '\Authlete\Types\ClientAuthMethod');

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
    public function getUserInfoEndpoint()
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
    public function setUserInfoEndpoint($endpoint)
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
    public function getJwksUri()
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
    public function setJwksUri($uri)
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
    public function getJwks()
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
    public function setJwks($jwks)
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
    public function getRegistrationEndpoint()
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
    public function setRegistrationEndpoint($endpoint)
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->registrationEndpoint = $endpoint;

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
    public function getSupportedScopes()
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
    public function setSupportedScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopes', $scopes, __NAMESPACE__ . '\Scope');

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
    public function getSupportedResponseTypes()
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
    public function setSupportedResponseTypes(array $responseTypes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$responseTypes', $responseTypes, '\Authlete\Types\ResponseType');

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
    public function getSupportedGrantTypes()
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
    public function setSupportedGrantTypes(array $grantTypes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$grantTypes', $grantTypes, '\Authlete\Types\GrantType');

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
    public function setSupportedAcrs(array $acrs = null)
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
    public function getSupportedTokenAuthMethods()
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
    public function setSupportedTokenAuthMethods(array $methods = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$methods', $methods, '\Authlete\Types\ClientAuthMethod');

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
    public function getSupportedDisplays()
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
    public function setSupportedDisplays(array $displays = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$displays', $displays, '\Authlete\Types\Display');

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
    public function getSupportedClaimTypes()
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
    public function setSupportedClaimTypes(array $claimTypes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$claimTypes', $claimTypes, '\Authlete\Types\ClaimType');

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
    public function getSupportedClaims()
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
    public function setSupportedClaims(array $claims = null)
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
    public function getServiceDocumentation()
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
    public function setServiceDocumentation($serviceDocumentation)
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
    public function getSupportedClaimLocales()
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
    public function setSupportedClaimLocales(array $locales = null)
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
    public function getSupportedUiLocales()
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
    public function setSupportedUiLocales(array $locales = null)
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
    public function getPolicyUri()
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
    public function setPolicyUri($uri)
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
    public function getTosUri()
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
     * Get the description about this service.
     *
     * @return string
     *     The description about this service.
     */
    public function getDescription()
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
    public function setDescription($description)
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
    public function getAccessTokenType()
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
    public function setAccessTokenType($type)
    {
        ValidationUtility::ensureNullOrString('$type', $type);

        $this->accessTokenType = $type;

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
    public function setAccessTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of refresh tokens in seconds.
     *
     * @return integer|string
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
    public function setRefreshTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of ID tokens in seconds.
     *
     * @return integer|string
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
    public function setIdTokenDuration($duration)
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
     * @return integer|string
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
    public function setAuthorizationResponseDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->authorizationResponseDuration = $duration;

        return $this;
    }


    /**
     * Get the URI of the authentication callback endpoint.
     *
     * @return string
     *     The URI of the authentication callback endpoint.
     */
    public function getAuthenticationCallbackEndpoint()
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
    public function setAuthenticationCallbackEndpoint($endpoint)
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
    public function getAuthenticationCallbackApiKey()
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
    public function setAuthenticationCallbackApiKey($apiKey)
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
    public function getAuthenticationCallbackApiSecret()
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
    public function setAuthenticationCallbackApiSecret($apiSecret)
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
    public function getSupportedSnses()
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
    public function setSupportedSnses(array $snses = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$snses', $snses, '\Authlete\Types\Sns');

        $this->supportedSnses = $snses;

        return $this;
    }


    /**
     * Get the list of SNS credentials used for social login.
     *
     * @return SnsCredentials[]
     *     The list of SNS credentials.
     */
    public function getSnsCredentials()
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
    public function setSnsCredentials(array $credentials = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$credentials', $credentials, __NAMESPACE__ . '\SnsCredentials');

        $this->snsCredentials = $credentials;

        return $this;
    }


    /**
     * Get the time at which this service was created.
     *
     * @return integer|string
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
    public function setCreatedAt($createdAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$createdAt', $createdAt);

        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * Get the time at which this service was last modified.
     *
     * @return integer|string
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
    public function setModifiedAt($modifiedAt)
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
    public function getDeveloperAuthenticationCallbackEndpoint()
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
    public function setDeveloperAuthenticationCallbackEndpoint($endpoint)
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
    public function getDeveloperAuthenticationCallbackApiKey()
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
    public function setDeveloperAuthenticationCallbackApiKey($apiKey)
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
    public function getDeveloperAuthenticationCallbackApiSecret()
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
    public function setDeveloperAuthenticationCallbackApiSecret($apiSecret)
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
    public function getSupportedDeveloperSnses()
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
    public function setSupportedDeveloperSnses(array $snses = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$snses', $snses, '\Authlete\Types\Sns');

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
    public function getDeveloperSnsCredentials()
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
    public function setDeveloperSnsCredentials(array $credentials = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$credentials', $credentials, __NAMESPACE__ . '\SnsCredentials');

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
    public function getClientsPerDeveloper()
    {
        return $this->clientsPerDeveloper;
    }


    /**
     * set the number of client applications that one developer can have.
     *
     * @param integer $count
     *     The number of client applications that one developer can have.
     *     0 means that developers can have as many client applications
     *     as they want.
     *
     * @return Service
     *     `$this` object.
     */
    public function setClientsPerDeveloper($count)
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
    public function isDirectAuthorizationEndpointEnabled()
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
    public function setDirectAuthorizationEndpointEnabled($enabled)
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
    public function isDirectTokenEndpointEnabled()
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
    public function setDirectTokenEndpointEnabled($enabled)
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
    public function isDirectRevocationEndpointEnabled()
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
    public function setDirectRevocationEndpointEnabled($enabled)
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
    public function isDirectUserInfoEndpointEnabled()
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
    public function setDirectUserInfoEndpointEnabled($enabled)
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
    public function isDirectJwksEndpointEnabled()
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
    public function setDirectJwksEndpointEnabled($enabled)
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
    public function isDirectIntrospectionEndpointEnabled()
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
    public function setDirectIntrospectionEndpointEnabled($enabled)
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
    public function isSingleAccessTokenPerSubject()
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
    public function setSingleAccessTokenPerSubject($enabled)
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
     * @see https://tools.ietf.org/html/rfc7636 RFC 7636 (Proof Key for Code Exchange by OAuth Public Clients)
     */
    public function isPkceRequired()
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
     * @see https://tools.ietf.org/html/rfc7636 RFC 7636 (Proof Key for Code Exchange by OAuth Public Clients)
     */
    public function setPkceRequired($required)
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->pkceRequired = $required;

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
    public function isRefreshTokenKept()
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
    public function setRefreshTokenKept($kept)
    {
        ValidationUtility::ensureBoolean('$kept', $kept);

        $this->refreshTokenKept = $kept;

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
    public function isErrorDescriptionOmitted()
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
    public function setErrorDescriptionOmitted($omitted)
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
    public function isErrorUriOmitted()
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
    public function setErrorUriOmitted($omitted)
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
    public function isClientIdAliasEnabled()
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
    public function setClientIdAliasEnabled($enabled)
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
    public function getSupportedServiceProfiles()
    {
        return $this->supportedResponseTypes;
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
    public function setSupportedServiceProfiles(array $serviceProfiles = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$serviceProfiles', $serviceProfiles, '\Authlete\Types\ServiceProfile');

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
    public function isTlsClientCertificateBoundAccessTokens()
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
    public function setTlsClientCertificateBoundAccessTokens($enabled)
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->tlsClientCertificateBoundAccessTokens = $enabled;

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
    public function isMutualTlsValidatePkiCertChain()
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
    public function setMutualTlsValidatePkiCertChain($enabled)
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->mutualTlsValidatePkiCertChain = $enabled;

        return $this;
    }


    /**
     * Get the URI of the introspection endpoint.
     *
     * @return string
     *     The URI of the introspection endpoint.
     *
     * @see https://tools.ietf.org/html/rfc7662 RFC 7662 (OAuth 2.0 Token Introspection)
     */
    public function getIntrospectionEndpoint()
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
     * @see https://tools.ietf.org/html/rfc7662 RFC 7662 (OAuth 2.0 Token Introspection)
     */
    public function setIntrospectionEndpoint($endpoint)
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
    public function getSupportedIntrospectionAuthMethods()
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
    public function setSupportedIntrospectionAuthMethods(array $methods = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$methods', $methods, '\Authlete\Types\ClientAuthMethod');

        $this->supportedIntrospectionAuthMethods = $methods;

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
    public function getTrustedRootCertificates()
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
    public function setTrustedRootCertificates(array $certificates = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$certificates', $certificates);

        $this->trustedRootCertificates = $certificates;

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
    public function getAuthorizationSignatureKeyId()
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
    public function setAuthorizationSignatureKeyId($keyId)
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
    public function getIdTokenSignatureKeyId()
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
    public function setIdTokenSignatureKeyId($keyId)
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
    public function getUserInfoSignatureKeyId()
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
    public function setUserInfoSignatureKeyId($keyId)
    {
        ValidationUtility::ensureNullOrString('$keyId', $keyId);

        $this->userInfoSignatureKeyId = $keyId;

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
        $array['description']                                 = $this->description;
        $array['accessTokenType']                             = $this->accessTokenType;
        $array['accessTokenDuration']                         = $this->accessTokenDuration;
        $array['refreshTokenDuration']                        = $this->refreshTokenDuration;
        $array['idTokenDuration']                             = $this->idTokenDuration;
        $array['authorizationResponseDuration']               = $this->authorizationResponseDuration;
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
        $array['refreshTokenKept']                            = $this->refreshTokenKept;
        $array['errorDescriptionOmitted']                     = $this->errorDescriptionOmitted;
        $array['errorUriOmitted']                             = $this->errorUriOmitted;
        $array['clientIdAliasEnabled']                        = $this->clientIdAliasEnabled;
        $array['supportedServiceProfiles']                    = LanguageUtility::convertArrayToStringArray($this->supportedServiceProfiles);
        $array['tlsClientCertificateBoundAccessTokens']       = $this->tlsClientCertificateBoundAccessTokens;
        $array['mutualTlsValidatePkiCertChain']               = $this->mutualTlsValidatePkiCertChain;
        $array['introspectionEndpoint']                       = $this->introspectionEndpoint;
        $array['supportedIntrospectionAuthMethods']           = LanguageUtility::convertArrayToStringArray($this->supportedIntrospectionAuthMethods);
        $array['trustedRootCertificates']                     = $this->trustedRootCertificates;
        $array['authorizationSignatureKeyId']                 = $this->authorizationSignatureKeyId;
        $array['idTokenSignatureKeyId']                       = $this->idTokenSignatureKeyId;
        $array['userInfoSignatureKeyId']                      = $this->userInfoSignatureKeyId;
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
        $supportedRevocationAuthMethods = LanguageUtility::getFromArray('supportedRevocationAuthMethods', $array);
        $this->setSupportedRevocationAuthMethods(
            LanguageUtility::convertArray(
                $supportedRevocationAuthMethods, '\Authlete\Types\ClientAuthMethod::valueOf'));

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

        // supportedScopes
        $supportedScopes = LanguageUtility::getFromArray('supportedScopes', $array);
        $this->setSupportedScopes(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $supportedScopes, __NAMESPACE__ . '\Scope'));

        // supportedResponseTypes
        $supportedResponseTypes = LanguageUtility::getFromArray('supportedResponseTypes', $array);
        $this->setSupportedResponseTypes(
            LanguageUtility::convertArray(
                $supportedResponseTypes, '\Authlete\Types\ResponseType::valueOf'));

        // supportedGrantTypes
        $supportedGrantTypes = LanguageUtility::getFromArray('supportedGrantTypes', $array);
        $this->setSupportedGrantTypes(
            LanguageUtility::convertArray(
                $supportedGrantTypes, '\Authlete\Types\GrantType::valueOf'));

        // supportedAcrs
        $this->setSupportedAcrs(
            LanguageUtility::getFromArray('supportedAcrs', $array));

        // supportedTokenAuthMethods
        $supportedTokenAuthMethods = LanguageUtility::getFromArray('supportedTokenAuthMethods', $array);
        $this->setSupportedTokenAuthMethods(
            LanguageUtility::convertArray(
                $supportedTokenAuthMethods, '\Authlete\Types\ClientAuthMethod::valueOf'));

        // supportedDisplays
        $supportedDisplays = LanguageUtility::getFromArray('supportedDisplays', $array);
        $this->setSupportedDisplays(
            LanguageUtility::convertArray(
                $supportedDisplays, '\Authlete\Types\Display::valueOf'));

        // supportedClaimTypes
        $supportedClaimTypes = LanguageUtility::getFromArray('supportedClaimTypes', $array);
        $this->setSupportedClaimTypes(
            LanguageUtility::convertArray(
                $supportedClaimTypes, '\Authlete\Types\ClaimType::valueOf'));

        // supportedClaims
        $this->setSupportedClaims(
            LanguageUtility::getFromArray('supportedClaims', $array));

        // serviceDocumentation
        $this->setServiceDocumentation(
            LanguageUtility::getFromArray('serviceDocumentation', $array));

        // supportedClaimLocales
        $this->setSupportedClaimLocales(
            LanguageUtility::getFromArray('supportedClaimLocales', $array));

        // supportedUiLocales
        $this->setSupportedUiLocales(
            LanguageUtility::getFromArray('supportedUiLocales', $array));

        // policyUri
        $this->setPolicyUri(
            LanguageUtility::getFromArray('policyUri', $array));

        // tosUri
        $this->setTosUri(
            LanguageUtility::getFromArray('tosUri', $array));

        // description
        $this->setDescription(
            LanguageUtility::getFromArray('description', $array));

        // accessTokenType
        $this->setAccessTokenType(
            LanguageUtility::getFromArray('accessTokenType', $array));

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
        $supportedSnses = LanguageUtility::getFromArray('supportedSnses', $array);
        $this->setSupportedSnses(
            LanguageUtility::convertArray(
                $supportedSnses, '\Authlete\Types\Sns::valueOf'));
    
        // snsCredentials
        $snsCredentials = LanguageUtility::getFromArray('snsCredentials', $array);
        $this->setSnsCredentials(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $snsCredentials, __NAMESPACE__ . '\SnsCredentials'));

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
        $supportedDeveloperSnses = LanguageUtility::getFromArray('supportedDeveloperSnses', $array);
        $this->setSupportedDeveloperSnses(
            LanguageUtility::convertArray(
                $supportedDeveloperSnses, '\Authlete\Types\Sns::valueOf'));
    
        // developerSnsCredentials
        $developerSnsCredentials = LanguageUtility::getFromArray('developerSnsCredentials', $array);
        $this->setDeveloperSnsCredentials(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $developerSnsCredentials, __NAMESPACE__ . '\SnsCredentials'));

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

        // refreshTokenKept
        $this->setRefreshTokenKept(
            LanguageUtility::getFromArrayAsBoolean('refreshTokenKept', $array));

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
        $supportedServiceProfiles = LanguageUtility::getFromArray('supportedServiceProfiles', $array);
        $this->setSupportedServiceProfiles(
            LanguageUtility::convertArray(
                $supportedServiceProfiles, '\Authlete\Types\ServiceProfile::valueOf'));

        // tlsClientCertificateBoundAccessTokens
        $this->setTlsClientCertificateBoundAccessTokens(
            LanguageUtility::getFromArrayAsBoolean('tlsClientCertificateBoundAccessTokens', $array));

        // mutualTlsValidatePkiCertChain
        $this->setMutualTlsValidatePkiCertChain(
            LanguageUtility::getFromArrayAsBoolean('mutualTlsValidatePkiCertChain', $array));

        // introspectionEndpoint
        $this->setIntrospectionEndpoint(
            LanguageUtility::getFromArray('introspectionEndpoint', $array));

        // supportedIntrospectionAuthMethods
        $supportedIntrospectionAuthMethods = LanguageUtility::getFromArray('supportedIntrospectionAuthMethods', $array);
        $this->setSupportedIntrospectionAuthMethods(
            LanguageUtility::convertArray(
                $supportedIntrospectionAuthMethods, '\Authlete\Types\ClientAuthMethod::valueOf'));

        // trustedRootCertificates
        $this->setTrustedRootCertificates(
            LanguageUtility::getFromArray('trustedRootCertificates', $array));

        // authorizationSignatureKeyId
        $this->setAuthorizationSignatureKeyId(
            LanguageUtility::getFromArray('authorizationSignatureKeyId', $array));

        // idTokenSignatureKeyId
        $this->setIdTokenSignatureKeyId(
            LanguageUtility::getFromArray('idTokenSignatureKeyId', $array));

        // userInfoSignatureKeyId
        $this->setUserInfoSignatureKeyId(
            LanguageUtility::getFromArray('userInfoSignatureKeyId', $array));
    }
}
