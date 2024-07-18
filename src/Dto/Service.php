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
use Authlete\Types\ClientRegistrationType;
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


    private ?string $serviceName = null;
    private string|int|null $apiKey = null;  // string or (64-bit) integer
    private ?string $apiSecret = null;
    private ?string $issuer = null;
    private ?string $authorizationEndpoint = null;
    private ?string $tokenEndpoint = null;
    private ?string $revocationEndpoint = null;
    private ?array $supportedRevocationAuthMethods = null;  // array of \Authlete\Types\ClientAuthMethod
    private ?string $userInfoEndpoint = null;
    private ?string $jwksUri = null;
    private ?string $jwks = null;
    private ?string $registrationEndpoint = null;
    private ?string $registrationManagementEndpoint = null;
    private ?array $supportedScopes = null;  // array of \Authlete\Dto\Scope
    private ?array $supportedResponseTypes = null;  // array of \Authlete\Types\ResponseType
    private ?array $supportedGrantTypes = null;  // array of \Authlete\Types\GrantType
    private ?array $supportedAcrs = null;  // array of string
    private ?array $supportedTokenAuthMethods = null;  // array of \Authlete\Types\ClientAuthMethod
    private ?array $supportedDisplays = null;  // array of \Authlete\Types\Display
    private ?array $supportedClaimTypes = null;  // array of \Authlete\Types\ClaimType
    private ?array $supportedClaims = null;  // array of string
    private ?string $serviceDocumentation = null;
    private ?array $supportedClaimLocales = null;  // array of string
    private ?array $supportedUiLocales = null;  // array of string
    private ?string $policyUri = null;
    private ?string $tosUri = null;
    private ?string $authenticationCallbackEndpoint = null;
    private ?string $authenticationCallbackApiKey = null;
    private ?string $authenticationCallbackApiSecret = null;
    private ?array $supportedSnses = null;  // array of \Authlete\Types\Sns
    private ?array $snsCredentials = null;  // array of \Authlete\Dto\SnsCredentials
    private $createdAt = null;  // string or (64-bit) integer
    private $modifiedAt = null;  // string or (64-bit) integer
    private ?string $developerAuthenticationCallbackEndpoint = null;
    private ?string $developerAuthenticationCallbackApiKey = null;
    private ?string $developerAuthenticationCallbackApiSecret = null;
    private ?array $supportedDeveloperSnses = null;  // array of \Authlete\Types\Sns
    private ?array $developerSnsCredentials = null;  // array of \Authlete\Dto\SnsCredentials
    private int $clientsPerDeveloper = 0;
    private bool $directAuthorizationEndpointEnabled = false;
    private bool $directTokenEndpointEnabled = false;
    private bool $directRevocationEndpointEnabled = false;
    private bool $directUserInfoEndpointEnabled = false;
    private bool $directJwksEndpointEnabled = false;
    private bool $directIntrospectionEndpointEnabled = false;
    private bool $singleAccessTokenPerSubject = false;
    private bool $pkceRequired = false;
    private bool $pkceS256Required = false;
    private bool $refreshTokenKept = false;
    private bool $refreshTokenDurationKept = false;
    private bool $errorDescriptionOmitted = false;
    private bool $errorUriOmitted = false;
    private bool $clientIdAliasEnabled = false;
    private ?array $supportedServiceProfiles = null;  // array of \Authlete\Types\ServiceProfile
    private bool $tlsClientCertificateBoundAccessTokens = false;
    private ?string $introspectionEndpoint = null;
    private ?array $supportedIntrospectionAuthMethods = null;  // array of \Authlete\Types\ClientAuthMethod
    private bool $mutualTlsValidatePkiCertChain = false;
    private ?array $trustedRootCertificates = null;
    private bool $dynamicRegistrationSupported = false;
    private ?string $endSessionEndpoint = null;
    private ?string $description = null;
    private ?string $accessTokenType = null;
    private ?string $accessTokenSignAlg = null;  // \Authlete\Types\JWSAlg
    private string|int|null $accessTokenDuration = null;
    private string|int|null $refreshTokenDuration = null;
    private string|int|null $idTokenDuration = null;
    private string|int|null $authorizationResponseDuration = null;
    private string|int|null $pushedAuthReqDuration = null;
    private ?string $accessTokenSignatureKeyId = null;
    private ?string $authorizationSignatureKeyId = null;
    private ?string $idTokenSignatureKeyId = null;
    private ?string $userInfoSignatureKeyId = null;
    private ?array $supportedBackchannelTokenDeliveryModes = null;  // array of \Authlete\Types\DeliveryMode
    private ?string $backchannelAuthenticationEndpoint = null;
    private bool $backchannelUserCodeParameterSupported = false;
    private $backchannelAuthReqIdDuration = null;  // string or (64-bit) integer
    private int $backchannelPollingInterval = 0;
    private bool $backchannelBindingMessageRequiredInFapi = false;
    private int $allowableClockSkew = 0;
    private ?string $deviceAuthorizationEndpoint = null;
    private ?string $deviceVerificationUri = null;
    private ?string $deviceVerificationUriComplete = null;
    private $deviceFlowCodeDuration = null;  // string or (64-bit) integer
    private int $deviceFlowPollingInterval = 0;
    private ?string $userCodeCharset = null;  // UserCodeCharset
    private int $userCodeLength = 0;
    private ?string $pushedAuthReqEndpoint = null;
    private ?array $mtlsEndpointAliases = null;  // array of \Authlete\Dto\NamedUri
    private ?array $supportedAuthorizationDataTypes = null;  // array of string
    private ?array $supportedTrustFrameworks = null;  // array of string
    private ?array $supportedEvidence = null;  // array of string
    private ?array $supportedIdentityDocuments = null;  // array of string
    private ?array $supportedVerificationMethods = null;  // array of string
    private ?array $supportedVerifiedClaims = null;  // array of string
    private bool $missingClientIdAllowed = false;
    private bool $parRequired = false;
    private bool $requestObjectRequired = false;
    private bool $traditionalRequestObjectProcessingApplied = false;
    private bool $claimShortcutRestrictive = false;
    private bool $scopeRequired = false;
    private bool $nbfOptional = false;
    private bool $issSuppressed = false;
    private ?array $supportedCustomClientMetadata = null; // array of string
    private bool $tokenExpirationLinked = false;
    private bool $frontChannelRequestObjectEncryptionRequired = false;
    private bool $requestObjectEncryptionAlgMatchRequired = false;
    private bool $hsmEnabled = false;
    private ?array $hsks = null; // array of HSK
    private ?string $grantManagementEndpoint = null;
    private bool $grantManagementActionRequired = false;
    private bool $unauthorizedOnClientConfigSupported = false;
    private bool $dcrScopeUsedAsRequestable = false;
    private ?string $predefinedTransformedClaims = null;
    private bool $loopbackRedirectionUriVariable = false;
    private bool $requestObjectAudienceChecked = false;
    private bool $accessTokenForExternalAttachmentEmbedded = false;
    private bool $refreshTokenIdempotent = false;
    private bool $federationEnabled = false;
    private ?string $organizationName = null;
    private array $authorityHints = []; //array of URI
    private array $trustAnchors = []; //array of Authlete\Types\TrustAnchor
    private ?string $federationJwks = null;
    private ?string $federationSignatureKeyId = null;
    private int $federationConfigurationDuration = 0;
    private ?string $signedJwksUri = null;
    private ?string $federationRegistrationEndpoint = null;
    private array $supportedClientRegistrationTypes = [];
    private bool $tokenExchangeByIdentifiableClientsOnly = false;
    private bool $tokenExchangeByConfidentialClientsOnly = false;
    private bool $tokenExchangeByPermittedClientsOnly = false;
    private bool $tokenExchangeEncryptedJwtRejected = false;
    private bool $tokenExchangeUnsignedJwtRejected = false;
    private bool $jwtGrantByIdentifiableClientsOnly = false;
    private bool $jwtGrantEncryptedJwtRejected = false;
    private bool $jwtGrantUnsignedJwtRejected = false;
    private bool $dcrDuplicateSoftwareIdBlocked = false;
    private ?string $resourceSignatureKeyId = null;
    private bool $rsResponseSigned = false;
    private bool $openidDroppedOnRefreshWithoutOfflineAccess = false;
    private bool $verifiableCredentialsEnabled = false;
    private ?string $credentialIssuerMetadata = null;
    private int $credentialOfferDuration = 0;
    private int $userPinLength = 0;
    private ?string $idTokenAudType = null;
    private array $supportedPromptValues = []; // array of Authlete\Types\Prompt
    private ?string $verifiedClaimsValidationSchemaSet = null;
    private bool $preAuthorizedGrantAnonymousAccessSupported = false;
    private int $cnonceDuration = 0;
    private int $credentialTransactionDuration = 0;
    private int $credentialDuration = 0;
    private ?string $credentialJwks = null;
    private ?string $credentialJwksUri = null;
    private bool $idTokenReissuable = false;
    private ?string $introspectionSignatureKeyId = null;
    private array $fapiModes = []; // array of Authlete\Types\FapiMode
    private bool $dpopNonceRequired = false;
    private int $dpopNonceDuration = 0;
    private ?string $tokenBatchNotificationEndpoint = null;

    /**
     * Get the service name.
     *
     * @return string|null The service name.
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
    public function setServiceName(mixed $serviceName): Service
    {
        ValidationUtility::ensureNullOrString('$serviceName', $serviceName);

        $this->serviceName = $serviceName;

        return $this;
    }


    /**
     * Get the API key of this service.
     *
     * @return int|string|null The API key.
     *     The API key.
     */
    public function getApiKey(): int|string|null
    {
        return $this->apiKey;
    }


    /**
     * Set the API key of this service.
     *
     * @param int|string|null $apiKey
     *     The API key.
     *
     * @return Service
     *     `$this` object.
     */
    public function setApiKey(mixed $apiKey): Service
    {
        ValidationUtility::ensureNullOrStringOrInteger('$apiKey', $apiKey);

        $this->apiKey = $apiKey;

        return $this;
    }


    /**
     * Get the API secret of this service.
     *
     * @return string|null
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
    public function setApiSecret(mixed $secret): Service
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
     * @return string|null
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
     * @param string|null $issuer
     *     The issuer identifier.
     *
     * @return Service
     *     `$this` object.
     */
    public function setIssuer(mixed $issuer): Service
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
     * @return string|null
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
     * @param string|null $endpoint
     *     The URI of the authorization endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.1 RFC 6749, 3.1. Authorization Endpoint
     */
    public function setAuthorizationEndpoint(mixed $endpoint): Service
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
     * @return string|null
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
     * @param string|null $endpoint
     *     The URI of the token endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2 RFC 6749, 3.2. Token Endpoint
     */
    public function setTokenEndpoint(mixed $endpoint): Service
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
     * @return string|null
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
     * @param string|null $endpoint
     *     The URI of the revocation endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7009 RFC 7009 (OAuth 2.0 Token Revocation)
     */
    public function setRevocationEndpoint(mixed $endpoint): Service
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
     * @return ClientAuthMethod[]|null
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
    public function setSupportedRevocationAuthMethods(?array $methods = null): Service
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
     * @return string|null
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
     * @param string|null $endpoint
     *     The URI of the UserInfo endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-core-1_0.html#UserInfo OpenID Connect Core 1.0, 5.3. UserInfo Endpoint
     */
    public function setUserInfoEndpoint(mixed $endpoint): Service
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
     * @return string|null
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
     * @param string|null $uri
     *     The URI of the JWK Set document.
     *
     * @return Service
     *     `$this` object
     */
    public function setJwksUri(mixed $uri): Service
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->jwksUri = $uri;

        return $this;
    }


    /**
     * Get the JWK Set document of this service.
     *
     * @return string|null
     *     The JWK Set document.
     */
    public function getJwks(): ?string
    {
        return $this->jwks;
    }


    /**
     * Set the JWK Set document of this service.
     *
     * @param string|null $jwks
     *     The JWK Set document.
     *
     * @return Service
     *     `$this` object.
     */
    public function setJwks(mixed $jwks): Service
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
     * @return string|null
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
     * @param string|null $endpoint
     *     The URI of the registration endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-registration-1_0.html#ClientRegistration OpenID Connect Dynamic Client Registration 1.0, 3. Client Registration Endpoint
     */
    public function setRegistrationEndpoint(mixed $endpoint): Service
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
     * @return string|null
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
     * @param string|null $endpoint
     *     The URI of the registration management endpoint.
     *
     * @return Service
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setRegistrationManagementEndpoint(?string $endpoint): Service
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
     * @return Scope[]|null
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
    public function setSupportedScopes(?array $scopes = null): Service
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
     * @return ResponseType[]|null
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
    public function setSupportedResponseTypes(?array $responseTypes = null): Service
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
     * @return GrantType[]|null
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
    public function setSupportedGrantTypes(?array $grantTypes = null): Service
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
     * @return string[]|null
     *     Supported ACR values.
     */
    public function getSupportedAcrs(): ?array
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
    public function setSupportedAcrs(?array $acrs = null): Service
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
     * @return string[]|null
     *     Supported ClientAuthMethod values at the token endpoint.
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
    public function setSupportedTokenAuthMethods(?array $methods = null): Service
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
     * @return Display[]|null
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
    public function setSupportedDisplays(?array $displays = null): Service
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
     * @return ClaimType[]|null
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
    public function setSupportedClaimTypes(?array $claimTypes = null): Service
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
     * @return string[]|null
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
    public function setSupportedClaims(?array $claims = null): Service
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
     * @return string|null
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
    public function setServiceDocumentation(mixed $serviceDocumentation): Service
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
     * @return string[]|null
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
     * @return string[]|null
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
    public function setSupportedUiLocales(?array $locales = null): Service
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
     * @return string|null
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
    public function setPolicyUri(mixed $uri): Service
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
     * @return string|null
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
    public function setTosUri(mixed $uri): Service
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->tosUri = $uri;

        return $this;
    }


    /**
     * Get the URI of the authentication callback endpoint.
     *
     * @return string|null
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
    public function setAuthenticationCallbackEndpoint(mixed $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->authenticationCallbackEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the API key to access the authentication callback endpoint.
     *
     * @return string|null
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
    public function setAuthenticationCallbackApiKey(mixed $apiKey): Service
    {
        ValidationUtility::ensureNullOrString('$apiKey', $apiKey);

        $this->authenticationCallbackApiKey = $apiKey;

        return $this;
    }


    /**
     * Get the API secret to access the authentication callback endpoint.
     *
     * @return string|null
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
    public function setAuthenticationCallbackApiSecret(mixed $apiSecret): Service
    {
        ValidationUtility::ensureNullOrString('$apiSecret', $apiSecret);

        $this->authenticationCallbackApiSecret = $apiSecret;

        return $this;
    }


    /**
     * Get the list of supported SNSes for social login at the direct
     * authorization endpoint.
     *
     * @return Sns[]|null
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
     * @return SnsCredentials[]|null
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
    public function getCreatedAt(): int|string|null
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
    public function setCreatedAt(mixed $createdAt): Service
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
    public function getModifiedAt(): int|string|null
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
    public function setModifiedAt(mixed $modifiedAt): Service
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
    public function setDeveloperAuthenticationCallbackEndpoint(mixed $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->developerAuthenticationCallbackEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the API key to access the developer authentication callback
     * endpoint.
     *
     * @return string|null
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
     * @return string|null
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
    public function setDeveloperAuthenticationCallbackApiSecret(mixed $apiSecret): Service
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
     * @return array|null
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
     * @return SnsCredentials[]|null
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
    public function setClientsPerDeveloper(mixed $count): Service
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
    public function setDirectAuthorizationEndpointEnabled(mixed $enabled): Service
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
    public function setDirectTokenEndpointEnabled(mixed $enabled): Service
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
    public function setDirectIntrospectionEndpointEnabled(mixed $enabled): Service
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
    public function setSingleAccessTokenPerSubject(mixed $enabled): Service
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
    public function setPkceS256Required(mixed $required): Service
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
    public function setRefreshTokenDurationKept(mixed $kept): Service
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
    public function setErrorDescriptionOmitted(mixed $omitted): Service
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
    public function setErrorUriOmitted(mixed $omitted): Service
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
    public function setClientIdAliasEnabled(mixed $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->clientIdAliasEnabled = $enabled;

        return $this;
    }


    /**
     * Get the service profiles supported by this service.
     *
     * @return array|null
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
    public function setTlsClientCertificateBoundAccessTokens(mixed $enabled): Service
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->tlsClientCertificateBoundAccessTokens = $enabled;

        return $this;
    }


    /**
     * Get the URI of the introspection endpoint.
     *
     * @return string|null
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
    public function setIntrospectionEndpoint(mixed $endpoint): Service
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
     * @return ClientAuthMethod[]|null
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
    public function setSupportedIntrospectionAuthMethods(?array $methods = null): Service
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
    public function setMutualTlsValidatePkiCertChain(mixed $enabled): Service
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
     * @return string[]|null
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
    public function setTrustedRootCertificates(?array $certificates = null): Service
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
    public function setDynamicRegistrationSupported(mixed $supported): Service
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
     * @return string|null
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
    public function setEndSessionEndpoint(mixed $endpoint): Service
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->endSessionEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the description about this service.
     *
     * @return string|null
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
    public function setDescription(mixed $description): Service
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
     * @return string|null
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
    public function setAccessTokenType(mixed $type): Service
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
     * @return JWSAlg|null
     *     The signature algorithm of JWT-based access tokens.
     *
     * @since 1.8
     */
    public function getAccessTokenSignAlg(): ?JWSAlg
    {
        return JWSAlg::valueOf($this->accessTokenSignAlg);
    }


    /**
     * Set the signature algorithm of access tokens.
     *
     * When null is set, access tokens issued by this service are just random
     * strings. On the other hand, when a non-null value is set, access tokens
     * issued by this service are JWTs and the value set by this method is used
     * as the signature algorithm of the JWTs.
     *
     * @param JWSAlg|null $alg
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
        $this->accessTokenSignAlg = $alg->value;

        return $this;
    }


    /**
     * Get the duration of access tokens in seconds.
     *
     * It is the value of the `expires_in` parameter in access token responses.
     *
     * @return integer|string|null
     *     The duration of access tokens.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-5.1 RFC 6749, 5.1. Successful Response
     */
    public function getAccessTokenDuration(): int|string|null
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
    public function setAccessTokenDuration(mixed $duration): Service
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
    public function getRefreshTokenDuration(): int|string|null
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
    public function setRefreshTokenDuration(mixed $duration): Service
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
    public function getIdTokenDuration(): int|string|null
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
    public function setIdTokenDuration(mixed $duration): Service
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
    public function getAuthorizationResponseDuration(): int|string|null
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
    public function setAuthorizationResponseDuration(mixed $duration): Service
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
    public function getPushedAuthReqDuration(): int|string|null
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
    public function setPushedAuthReqDuration(mixed $duration): Service
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
    public function setAccessTokenSignatureKeyId(mixed $keyId): Service
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
    public function setAuthorizationSignatureKeyId(mixed $keyId): Service
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
     * @return string|null
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
    public function setIdTokenSignatureKeyId(mixed $keyId): Service
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
     * @return string|null
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
    public function setUserInfoSignatureKeyId(mixed $keyId): Service
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
     * @return DeliveryMode[]|null
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
    public function setSupportedBackchannelTokenDeliveryModes(?array $modes = null): Service
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$modes', '\Authlete\Types\DeliveryMode', $modes);

        $this->supportedBackchannelTokenDeliveryModes = $modes;

        return $this;
    }


    /**
     * Get the URI of the backchannel authentication endpoint.
     *
     * @return string|null
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
    public function setBackchannelAuthenticationEndpoint(mixed $endpoint): Service
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
    public function setBackchannelUserCodeParameterSupported(mixed $supported): Service
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
     * @return int|string|null
     *     The duration of backchannel authentication request IDs in seconds.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html Client Initiated Backchannel Authentication
     *
     * @since 1.8
     */
    public function getBackchannelAuthReqIdDuration(): int|string|null
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
    public function setBackchannelAuthReqIdDuration(mixed $duration): Service
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
    public function setBackchannelPollingInterval(mixed $interval): Service
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
    public function setBackchannelBindingMessageRequiredInFapi(mixed $required): Service
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
     * @return string|null
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
    public function setDeviceAuthorizationEndpoint(mixed $endpoint): Service
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
     * @return string|null
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
    public function setDeviceVerificationUri(mixed $uri): Service
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
     * @return string|null
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
    public function setDeviceVerificationUriComplete(mixed $uri): Service
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
     * @return integer|string|null
     *     The duration of device verification codes and end-user verification
     *     codes in seconds.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getDeviceFlowCodeDuration(): int|string|null
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
    public function setDeviceFlowCodeDuration(mixed $duration): Service
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
    public function setDeviceFlowPollingInterval(mixed $interval): Service
    {
        ValidationUtility::ensureInteger('$interval', $interval);

        $this->deviceFlowPollingInterval = $interval;

        return $this;
    }


    /**
     * Get the character set for end-user verification codes (`user_code`)
     * for the device flow.
     *
     * @return UserCodeCharset|null
     *     The character set for end-user verification codes.
     *
     * @see https://tools.ietf.org/html/rfc8628 RFC 8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    public function getUserCodeCharset(): ?UserCodeCharset
    {
        return UserCodeCharset::valueOf($this->userCodeCharset);
    }


    /**
     * Set the character set for end-user verification codes (`user_code`)
     * for the device flow.
     *
     * @param UserCodeCharset|null $charset
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
        $this->userCodeCharset = $charset->value;

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
    public function setUserCodeLength(mixed $length): Service
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
     * @return string|null
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
    public function setPushedAuthReqEndpoint(mixed $endpoint): Service
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
     * @return NamedUri[]|null
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
    public function setMtlsEndpointAliases(?array $aliases = null): Service
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
     * @return string[]|null
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
    public function setSupportedAuthorizationDataTypes(?array $types = null): Service
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
     * @return string[]|null
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
    public function setSupportedTrustFrameworks(?array $frameworks = null): Service
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
     * @return string[]|null
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
    public function setSupportedEvidence(?array $evidence = null): Service
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
     * @return string[]|null
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
    public function setSupportedIdentityDocuments(?array $documents = null): Service
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
     * @return string[]|null
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
    public function setSupportedVerificationMethods(?array $methods = null): Service
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
     * @return string[]|null
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
    public function setSupportedVerifiedClaims(?array $claims = null): Service
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
    public function setMissingClientIdAllowed(mixed $allowed): Service
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
    public function setParRequired(mixed $required): Service
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
    public function setRequestObjectRequired(mixed $required): Service
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
    public function setTraditionalRequestObjectProcessingApplied(mixed $applied): Service
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
    public function setClaimShortcutRestrictive(mixed $restrictive): Service
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
    public function setScopeRequired(mixed $required): Service
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
    public function setNbfOptional(mixed $optional): Service
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
    public function setIssSuppressed(mixed $suppressed): Service
    {
        ValidationUtility::ensureBoolean('$suppressed', $suppressed);

        $this->issSuppressed = $suppressed;

        return $this;
    }


    /**
     *  Get custom client metadata supported by this service.
     *
     *  <p>
     *  Standard specifications define client metadata as necessary.
     *  The following are such examples.
     *  </p>
     *
     *  <ol>
     *  <li><a href="https://openid.net/specs/openid-connect-registration-1_0.html"
     *      >OpenID Connect Dynamic Client Registration 1.0</a>
     *  <li><a href="https://www.rfc-editor.org/rfc/rfc7591.html"
     *      >RFC 7591 OAuth 2.0 Dynamic Client Registration Protocol</a>
     *  <li><a href="https://www.rfc-editor.org/rfc/rfc8705.html"
     *      >RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens</a>
     *  <li><a href="https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html"
     *      >OpenID Connect Client-Initiated Backchannel Authentication Flow - Core 1.0</a>
     *  <li><a href="https://www.rfc-editor.org/rfc/rfc9101.html"
     *      >RFC 9101 The OAuth 2.0 Authorization Framework: JWT Secured Authorization Request (JAR)</a>
     *  <li><a href="https://openid.net/specs/openid-financial-api-jarm.html"
     *      >Financial-grade API: JWT Secured Authorization Response Mode for OAuth 2.0 (JARM)</a>
     *  <li><a href="https://www.rfc-editor.org/rfc/rfc9126.html"
     *      >RFC 9126 OAuth 2.0 Pushed Authorization Requests</a>
     *  <li><a href="https://www.rfc-editor.org/rfc/rfc9396.html"
     *       >RFC 9396 OAuth 2.0 Rich Authorization Requests</a>
     *  </ol>
     *
     *  <p>
     *  Standard client metadata included in Client Registration Request and
     *  Client Update Request (cf. <a href=
     *  "https://openid.net/specs/openid-connect-registration-1_0.html">OIDC
     *  DynReg</a>, <a href="https://www.rfc-editor.org/rfc/rfc7591.html">RFC
     *  7591</a> and <a href=""https://www.rfc-editor.org/rfc/rfc7592.html"
     *  >RFC 7592</a>) are, if supported by Authlete, stored into Authlete
     *  database. On the other hand, unrecognized client metadata are discarded.
     *  </p>
     *
     *  <p>
     *  By listing up custom client metadata in advance by using this property
     *  ({`Service.supportedCustomClientMetadata`}), Authlete can recognize
     *  them and stores their values into the database. The stored custom client
     *  metadata values can be referenced by {@see Client#getCustomMetadata()}.
     *  </p>
     *
     *  <p>
     *  This property affects the behavior of {`/api/client/registration`}
     *  API of Authlete 2.2 onwards.
     *  </p>
     * @return array|null
     */
    public function getSupportedCustomClientMetadata(): ?array
    {
        return $this->supportedCustomClientMetadata;
    }


    /**
     * Set custom client metadata supported by this service.
     * @param array|null $supportedCustomClientMetadata
     * @return void
     */
    public function setSupportedCustomClientMetadata(?array $supportedCustomClientMetadata): void
    {
        $this->supportedCustomClientMetadata = $supportedCustomClientMetadata;
    }


    /**
     * Get the flag indicating whether the expiration date of an access token
     *  never exceeds that of the corresponding refresh token.
     *
     *  <p>
     *  When a new access token is issued by a refresh token request (= a token
     *  request with {`grant_type=refresh_token`}), the expiration date of
     *  the access token may exceed the expiration date of the corresponding
     *  refresh token. This behavior itself is not wrong and may happen when
     *  {@see isRefreshTokenKept()} returns {`true`} and/or when
     *  {@see isRefreshTokenDurationKept()} returns {`true`}.
     *  </p>
     *
     *  <p>
     *  When this flag is {`true`}, the expiration date of an access token
     *  never exceeds that of the corresponding refresh token regardless of
     *  the calculated duration based on other settings such as
     *  {@see Service::getAccessTokenDuration()},
     *  {@see ClientExtension::getAccessTokenDuration()} and the
     *  {`access_token.duration`} attribute of scopes.
     *  </p>
     *
     *  <p>
     *  It is technically possible to set a value which is bigger than the
     *  duration of refresh tokens as the duration of access tokens, although
     *  it is strange. In the case, the duration of an access token becomes
     *  longer than the duration of the refresh token which is issued together
     *  with the access token. Even if the duration values are configured so,
     *  if this flag is {`true`}, the expiration date of the access token
     *  does not exceed that of the refresh token. That is, the duration of
     *  the access token will be shortened, and as a result, the access token
     *  and the refresh token will have the same expiration date.
     *  </p>
     * @return bool
     *  {`true`} if the service assures that the expiration date
     *          of an access token never exceeds that of the corresponding
     *          refresh token.
     */
    public function isTokenExpirationLinked(): bool
    {
        return $this->tokenExpirationLinked;
    }


    /**
     * Set the flag indicating whether the expiration date of an access token
     *  never exceeds that of the corresponding refresh token.
     * @param bool $tokenExpirationLinked
     * @return void
     */
    public function setTokenExpirationLinked(bool $tokenExpirationLinked): void
    {
        $this->tokenExpirationLinked = $tokenExpirationLinked;
    }

    /**
     * Get the flag indicating whether encryption of request object is required
     *  when the request object is passed through the front channel.
     *
     *  <p>
     *  This flag does not affect the processing of request objects at the
     *  Pushed Authorization Request Endpoint, which is defined in <a href=
     *  "https://www.rfc-editor.org/rfc/rfc9126.html"> RFC 9126 OAuth 2.0
     *  Pushed Authorization Requests</a>. Unecrypted request objects are
     *  accepted at the endpoint even if this flag is {`true`}.
     *  </p>
     *
     *  <p>
     *  This flag does not indicate whether a request object is always required.
     *  There is a different flag, {`requestObjectRequired`}, for the purpose.
     *  See the description of {@see #isRequestObjectRequired()} for details.
     *  </p>
     *
     *  <p>
     *  Even if this flag is {`false`}, encryption of request object is
     *  required if the {`Client.frontChannelRequestObjectEncryptionRequired`}
     *  flag is {`true`}.
     *  </p>
     *
     * @return bool
     *           {`true`} if encryption of request object is required when
     *           the request object is passed through the front channel.
     * @see Client::isFrontChannelRequestObjectEncryptionRequired()
     * @see #isRequestObjectRequired()
     */
    public function isFrontChannelRequestObjectEncryptionRequired(): bool
    {
        return $this->frontChannelRequestObjectEncryptionRequired;
    }


    /**
     * Set the flag indicating whether encryption of request object is required
     *  when the request object is passed through the front channel.
     *
     * @param bool $frontChannelRequestObjectEncryptionRequired
     * @return void
     */
    public function setFrontChannelRequestObjectEncryptionRequired(bool $frontChannelRequestObjectEncryptionRequired): void
    {
        $this->frontChannelRequestObjectEncryptionRequired = $frontChannelRequestObjectEncryptionRequired;
    }


    /**
     * Get the flag indicating whether the JWE {`alg`} of encrypted request
     *  object must match the {`request_object_encryption_alg`} client metadata
     *  of the client that has sent the request object.
     *
     *  <p>
     *  The {`request_object_encryption_alg`} client metadata itself is defined
     *  in <a href="https://openid.net/specs/openid-connect-registration-1_0.html"
     *  >OpenID Connect Dynamic Client Registration 1.0</a> as follows.
     *  </p>
     *
     *  <blockquote>
     *  <dl>
     *  <dt>{`request_object_encryption_alg`}</dt>
     *  <dd>
     *  <p>
     *  OPTIONAL. JWE [JWE] {`alg`} algorithm [JWA] the RP is declaring that
     *  it may use for encrypting Request Objects sent to the OP. This parameter
     *  SHOULD be included when symmetric encryption will be used, since this
     *  signals to the OP that a {`client_secret`} value needs to be returned
     *  from which the symmetric key will be derived, that might not otherwise be
     *  returned. The RP MAY still use other supported encryption algorithms or
     *  send unencrypted Request Objects, even when this parameter is present.
     *  If both signing and encryption are requested, the Request Object will be
     *  signed then encrypted, with the result being a Nested JWT, as defined in
     *  [JWT]. The default, if omitted, is that the RP is not declaring whether
     *  it might encrypt any Request Objects.
     *  </p>
     *  </dd>
     *  </dl>
     *  </blockquote>
     *
     *  <p>
     *  The point here is <i>"The RP MAY still use other supported encryption
     *  algorithms or send unencrypted Request Objects, even when this parameter
     *  is present."</i>
     *  </p>
     *
     *  <p>
     *  The {@see Client}'s property that represents the client metadata is
     *  {`Client.requestEncryptionAlg`}. See the description of
     *  {@see Client::getRequestEncryptionAlg()} for details.
     *  </p>
     *
     *  <p>
     *  Even if this flag is {`false`}, the match is required if the
     *  {`Client.requestObjectEncryptionAlgMatchRequired`} flag is {`true`}.
     *  </p>
     *
     * @return bool
     *   {`true`} if the JWE {`alg`} of encrypted request object
     *        must match the {`request_object_encryption_alg`} client metadata.
     * @see Client::isRequestObjectEncryptionAlgMatchRequired()
     * @see Client::getRequestEncryptionAlg()
     */
    public function isRequestObjectEncryptionAlgMatchRequired(): bool
    {
        return $this->requestObjectEncryptionAlgMatchRequired;
    }


    /**
     * Set the flag indicating whether the JWE {@code alg} of encrypted request
     * object must match the {@code request_object_encryption_alg} client metadata
     * of the client that has sent the request object.
     * @param bool $requestObjectEncryptionAlgMatchRequired
     *
     * @return void
     */
    public function setRequestObjectEncryptionAlgMatchRequired(bool $requestObjectEncryptionAlgMatchRequired): void
    {
        $this->requestObjectEncryptionAlgMatchRequired = $requestObjectEncryptionAlgMatchRequired;
    }

    /**
     * Check if HSM is enabled.
     *
     * @return bool True if HSM is enabled, false otherwise.
     */
    public function isHsmEnabled(): bool
    {
        return $this->hsmEnabled;
    }

    /**
     * Set HSM enabled status.
     *
     * @param bool $hsmEnabled The HSM enabled status.
     * @return self
     */
    public function setHsmEnabled(bool $hsmEnabled): self
    {
        $this->hsmEnabled = $hsmEnabled;
        return $this;
    }

    /**
     * Get the HSKs.
     *
     * @return Hsk[]|null
     *      The HSKs.
     */
    public function getHsks(): ?array
    {
        return $this->hsks;
    }

    /**
     * Set the HSKs.
     *
     * @param Hsk[] $hsks
     *      The HSKs.
     * @return self
     */
    public function setHsks(?array $hsks): self
    {
        $this->hsks = $hsks;
        return $this;
    }

    /**
     * Get the grant management endpoint.
     *
     * @return ?string
     *      The grant management endpoint.
     *
     * @see https://openid.net/specs/fapi-grant-management.html
     *       Grant Management for OAuth 2.0
     */
    public function getGrantManagementEndpoint(): ?string
    {
        return $this->grantManagementEndpoint;
    }

    /**
     * Set the grant management endpoint.
     *
     * @param ?string $grantManagementEndpoint
     *      The grant management endpoint.
     *
     * @return self
     *
     * @see https://openid.net/specs/fapi-grant-management.html
     *        Grant Management for OAuth 2.0
     */
    public function setGrantManagementEndpoint(?string $grantManagementEndpoint): self
    {
        $this->grantManagementEndpoint = $grantManagementEndpoint;
        return $this;
    }

    /**
     * Get the flag indicating whether every authorization request (and any
     * request serving as an authorization request such as CIBA backchannel
     * authentication request and device authorization request) must include
     * the {@code grant_management_action} request parameter.
     *
     * <p>
     * This property corresponds to the {@code grant_management_action_required}
     * server metadata defined in https://openid.net/specs/fapi-grant-management.html
     * Grant Management for OAuth 2.0
     * </p>
     *
     * <p>
     * Note that setting {true} to this property will result in blocking
     * all public clients because the specification requires that grant
     * management be usable only by confidential clients for security reasons.
     * </p>
     *
     * @return bool
     *      True if grant management action is required, false otherwise.
     */
    public function isGrantManagementActionRequired(): bool
    {
        return $this->grantManagementActionRequired;
    }

    /**
     * Set the flag indicating whether every authorization request (and any
     * request serving as an authorization request such as CIBA backchannel
     * authentication request and device authorization request) must include
     * the {@code grant_management_action} request parameter.
     *
     * <p>
     *  This property corresponds to the {@code grant_management_action_required}
     * server metadata defined in https://openid.net/specs/fapi-grant-management.html
     * Grant Management for OAuth 2.0
     * </p>
     *
     * <p>
     * Note that setting {true} to this property will result in blocking
     * all public clients because the specification requires that grant
     * management be usable only by confidential clients for security reasons.
     * </p>
     *
     * @param bool $grantManagementActionRequired
     *      The grant management action required status.
     *
     * @return self
     */
    public function setGrantManagementActionRequired(bool $grantManagementActionRequired): self
    {
        $this->grantManagementActionRequired = $grantManagementActionRequired;
        return $this;
    }

    /**
     * Get the flag indicating whether Authlete's {@code /api/client/registration}
     * API uses {@link ClientRegistrationResponse.Action#UNAUTHORIZED UNAUTHORIZED}
     * as a value of the {@code action} response parameter when appropriate.
     *
     * <p>
     * See the description of {@see self::setUnauthorizedOnClientConfigSupported()}
     * for details.
     * </p>
     *
     * @return bool
     *      True if unauthorized on client config is supported, false otherwise.
     */
    public function isUnauthorizedOnClientConfigSupported(): bool
    {
        return $this->unauthorizedOnClientConfigSupported;
    }

    /**
     * Get the flag indicating whether Authlete's {@code /api/client/registration}
     * API uses {@link ClientRegistrationResponse.Action#UNAUTHORIZED UNAUTHORIZED}
     * as a value of the {@code action} response parameter when appropriate.
     *
     * <p>
     * See the description of {@see self::setUnauthorizedOnClientConfigSupported()}
     * for details.
     * </p>
     *
     * @param bool $unauthorizedOnClientConfigSupported
     *      The unauthorized on client config supported status.
     *
     * @return self
     */
    public function setUnauthorizedOnClientConfigSupported(bool $unauthorizedOnClientConfigSupported): self
    {
        $this->unauthorizedOnClientConfigSupported = $unauthorizedOnClientConfigSupported;
        return $this;
    }

    /**
     * Get the flag indicating whether the {```scope```} request parameter
     * in dynamic client registration and update requests (
     * RFC 7591: https://www.rfc-editor.org/rfc/rfc7591.html and
     * RFC 7592: https://www.rfc-editor.org/rfc/rfc7592.html)
     * is used as scopes that the client can request.
     * <p>
     * Limiting the range of scopes that a client can request is achieved by
     * listing scopes in the {```client.extension.requestableScopes```}
     * property (cf. {@link ClientExtension::getRequestableScopes()}) and
     * setting {```true```} to the
     * {```client.extension.requestableScopesEnabled```} property (cf.
     * {@link ClientExtension::isRequestableScopesEnabled()}). This feature
     * is called "requestable scopes".
     * </p>
     *
     * <p>
     * This property affects behaviors of {``` /api/client/registration ``` }
     * and other family APIs.
     * </p>
     *
     *
     * @return bool
     *      True if DCR scope is used as requestable, false otherwise.
     */
    public function isDcrScopeUsedAsRequestable(): bool
    {
        return $this->dcrScopeUsedAsRequestable;
    }

    /**
     * Set the flag indicating whether the {```scope```} request parameter
     * in dynamic client registration and update requests (
     * RFC 7591: https://www.rfc-editor.org/rfc/rfc7591.html and
     * RFC 7592: https://www.rfc-editor.org/rfc/rfc7592.html)
     * is used as scopes that the client can request.
     * <p>
     * Limiting the range of scopes that a client can request is achieved by
     * listing scopes in the {```client.extension.requestableScopes```}
     * property (cf. {@see ClientExtension::getRequestableScopes()}) and
     * setting {```true```} to the
     * {```client.extension.requestableScopesEnabled```} property (cf.
     * {@link ClientExtension::isRequestableScopesEnabled()}). This feature
     * is called "requestable scopes".
     * </p>
     *
     * <p>
     * This property affects behaviors of {``` /api/client/registration ``` }
     * and other family APIs.
     * </p>
     *
     * @param bool $dcrScopeUsedAsRequestable
     *      The DCR scope used as requestable status.
     *
     * @return self
     */
    public function setDcrScopeUsedAsRequestable(bool $dcrScopeUsedAsRequestable): self
    {
        $this->dcrScopeUsedAsRequestable = $dcrScopeUsedAsRequestable;
        return $this;
    }

    /**
     * Get the transformed claims predefined by this service in JSON format.
     * This property corresponds to the {```transformed_claims_predefined```}
     * server metadata.
     *
     * <p>
     * See the description of {@link self::setPredefinedTransformedClaims()}
     * for details.
     * </p>
     *
     * <p>
     * This {```predefinedTransformedClaims```} property is available from
     * Authlete 2.3 onwards.
     * </p>
     *
     * @return ?string
     *      The predefined transformed claims.
     *
     * @see https://bitbucket.org/openid/ekyc-ida/src/master/openid-advanced-syntax-for-claims.md
     *       OpenID Connect Advanced Syntax for Claims (ASC) 1.0
     */
    public function getPredefinedTransformedClaims(): ?string
    {
        return $this->predefinedTransformedClaims;
    }

    /**
     * set the transformed claims predefined by this service in JSON format.
     * This property corresponds to the {```transformed_claims_predefined```}
     * server metadata.
     *
     * <p>
     * See the description of {@link self::setPredefinedTransformedClaims()}
     * for details.
     * </p>
     *
     * <p>
     * This {```predefinedTransformedClaims```} property is available from
     * Authlete 2.3 onwards.
     * </p>
     *
     * @param ?string $predefinedTransformedClaims
     *      The predefined transformed claims.
     *
     * @return self
     *
     * @see https://bitbucket.org/openid/ekyc-ida/src/master/openid-advanced-syntax-for-claims.md
     *        OpenID Connect Advanced Syntax for Claims (ASC) 1.0
     */
    public function setPredefinedTransformedClaims(?string $predefinedTransformedClaims): self
    {
        $this->predefinedTransformedClaims = $predefinedTransformedClaims;
        return $this;
    }

    /**
     * Get the flag indicating whether the port number component of redirection
     * URIs can be variable when the host component indicates loopback.
     *
     * <p>
     * When this flag is true, if the host component of a redirection URI
     * specified in an authorization request indicates loopback (to be precise,
     * when the host component is {```localhost```}, {```127.0.0.1```} or
     * {``` ::1```}), the port number component is ignored when the specified
     * redirection URI is compared to pre-registered ones. This behavior is
     * described in
     * Loopback Interface Redirection: https://www.rfc-editor.org/rfc/rfc8252.html#section-7.3 7.3.
     * of
     * RFC 8252: https://www.rfc-editor.org/rfc/rfc8252.html OAuth 2.0 for
     * Native Apps.
     * </p>
     *
     * <p>
     * 3.1.2.3. Dynamic Configuration: https://www.rfc-editor.org/rfc/rfc6749.html#section-3.1.2.3
     * of
     * RFC 6749: https://www.rfc-editor.org/rfc/rfc6749.html states
     * <i>"If the client registration included the full redirection URI, the
     * authorization server MUST compare the two URIs using <b>simple string
     * comparison</b> as defined in [RFC3986] Section 6.2.1."</i> Also, the
     * description of {```redirect_uri```} in
     * 3.1.2.1. Authentication Request: https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest
     * of
     * OpenID Connect Core 1.0:https://openid.net/specs/openid-connect-core-1_0.html
     * states <i>"This URI MUST exactly match one of the
     * Redirection URI values for the Client pre-registered at the OpenID
     * Provider, with the matching performed as described in Section 6.2.1 of
     * [RFC3986] (<b>Simple String Comparison</b>)."</i> These "Simple String
     * Comparison" requirements are preceded by this flag. That is, even when
     * the conditions described in RFC 6749 and OpenID Connect Core 1.0 are
     * satisfied, the port number component of loopback redirection URIs can
     * be variable when this flag is true.
     * </p>
     *
     *  <p>
     * 8.3.Loopback Redirect Considerations: https://www.rfc-editor.org/rfc/rfc8252.html#section-8.3
     * of RFC 8252: https://www.rfc-editor.org/rfc/rfc8252.html states as follows.
     * </p>
     *
     * <blockquote><p><i>
     * While redirect URIs using ```localhost``` (i.e.,
     * ```http://localhost:{port}/{path}```) function similarly to
     * loopback IP redirects described in Section 7.3, the use of
     * ```localhost``` is NOT RECOMMENDED. Specifying a redirect URI
     * with the loopback IP literal rather than ```localhost``` avoids
     * inadvertently listening on network interfaces other than the loopback
     * interface. It is also less susceptible to client-side firewalls and
     * misconfigured host name resolution on the user's device.
     * </i></p></blockquote>
     *
     * <p>
     * However, Authlete allows the port number component to be variable in
     * the case of {```localhost```}, too. It is left to client applications
     * whether they use {```localhost```} or a literal loopback IP address
     * ({```127.0.0.1```} for IPv4 or {``` ::1```} for IPv6).
     * </p>
     *
     * <p>
     * Section 7.3 and Section 8.3 of
     * RFC 8252 https://www.rfc-editor.org/rfc/rfc8252.html state that
     * loopback redirection URIs use the {``` "http"```} scheme, but Authlete
     * allows the port number component to be variable in other cases (e.g.
     * in the case of the {``` "https"```} scheme), too.
     * </p>
     *
     * @return bool
     *      True if loopback redirection URI variable is enabled, false otherwise.
     */
    public function isLoopbackRedirectionUriVariable(): bool
    {
        return $this->loopbackRedirectionUriVariable;
    }

    /**
     * Set the flag indicating whether the port number component of redirection
     * URIs can be variable when the host component indicates loopback.
     *
     * <p>
     * When this flag is true, if the host component of a redirection URI
     * specified in an authorization request indicates loopback (to be precise,
     * when the host component is {```localhost```}, {```127.0.0.1```} or
     * {``` ::1```}), the port number component is ignored when the specified
     * redirection URI is compared to pre-registered ones. This behavior is
     * described in
     * Loopback Interface Redirection: https://www.rfc-editor.org/rfc/rfc8252.html#section-7.3 7.3.
     * of
     * RFC 8252: https://www.rfc-editor.org/rfc/rfc8252.html OAuth 2.0 for
     * Native Apps.
     * </p>
     *
     * <p>
     * 3.1.2.3. Dynamic Configuration: https://www.rfc-editor.org/rfc/rfc6749.html#section-3.1.2.3
     * of
     * RFC 6749: https://www.rfc-editor.org/rfc/rfc6749.html states
     * <i>"If the client registration included the full redirection URI, the
     * authorization server MUST compare the two URIs using <b>simple string
     * comparison</b> as defined in [RFC3986] Section 6.2.1."</i> Also, the
     * description of {```redirect_uri```} in
     * 3.1.2.1. Authentication Request: https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest
     * of
     * OpenID Connect Core 1.0:https://openid.net/specs/openid-connect-core-1_0.html
     * states <i>"This URI MUST exactly match one of the
     * Redirection URI values for the Client pre-registered at the OpenID
     * Provider, with the matching performed as described in Section 6.2.1 of
     * [RFC3986] (<b>Simple String Comparison</b>)."</i> These "Simple String
     * Comparison" requirements are preceded by this flag. That is, even when
     * the conditions described in RFC 6749 and OpenID Connect Core 1.0 are
     * satisfied, the port number component of loopback redirection URIs can
     * be variable when this flag is true.
     * </p>
     *
     * <p>
     * 8.3.Loopback Redirect Considerations: https://www.rfc-editor.org/rfc/rfc8252.html#section-8.3
     * of RFC 8252: https://www.rfc-editor.org/rfc/rfc8252.html states as follows.
     * </p>
     *
     * <blockquote><p><i>
     * While redirect URIs using ```localhost``` (i.e.,
     * ```http://localhost:{port}/{path}```) function similarly to
     * loopback IP redirects described in Section 7.3, the use of
     * ```localhost``` is NOT RECOMMENDED. Specifying a redirect URI
     * with the loopback IP literal rather than ```localhost``` avoids
     * inadvertently listening on network interfaces other than the loopback
     * interface. It is also less susceptible to client-side firewalls and
     * misconfigured host name resolution on the user's device.
     * </i></p></blockquote>
     *
     * <p>
     * However, Authlete allows the port number component to be variable in
     * the case of {```localhost```}, too. It is left to client applications
     * whether they use {```localhost```} or a literal loopback IP address
     * ({```127.0.0.1```} for IPv4 or {``` ::1```} for IPv6).
     * </p>
     *
     * <p>
     * Section 7.3 and Section 8.3 of
     * RFC 8252 https://www.rfc-editor.org/rfc/rfc8252.html state that
     * loopback redirection URIs use the {``` "http"```} scheme, but Authlete
     * allows the port number component to be variable in other cases (e.g.
     * in the case of the {``` "https"```} scheme), too.
     * </p>
     *
     * @param bool $loopbackRedirectionUriVariable
     *      The loopback redirection URI variable enabled status.
     *
     * @return self
     */
    public function setLoopbackRedirectionUriVariable(bool $loopbackRedirectionUriVariable): self
    {
        $this->loopbackRedirectionUriVariable = $loopbackRedirectionUriVariable;
        return $this;
    }

    /**
     * Get the flag indicating whether Authlete checks whether the {```aud```}
     * claim of request objects matches the issuer identifier of this service.
     *
     * <p>
     * Section 6.1. Passing a Request Object by Value:
     * https://openid.net/specs/openid-connect-core-1_0.html#JWTRequests
     * of
     * OpenID Connect Core 1.0: https://openid.net/specs/openid-connect-core-1_0.html
     * has the following statement.
     * </p>
     *
     * <blockquote>
     * <p>
     * The {```aud```} value SHOULD be or include the OP's Issuer Identifier URL.
     * </p>
     * </blockquote>
     *
     * <p>
     * Likewise, Section 4. Request Object: https://www.rfc-editor.org/rfc/rfc9101.html#section-4
     *  of
     * RFC 9101: https://www.rfc-editor.org/rfc/rfc9101.html (The OAuth 2.0
     * Authorization Framework: JWT-Secured Authorization Request (JAR)) has the
     * following statement.
     * </p>
     *
     * <blockquote>
     * <p>
     * The value of {```aud```} should be the value of the authorization server
     * (AS) {```issuer```}, as defined in
     * RFC 8414: https://www.rfc-editor.org/rfc/rfc8414.html.
     * </p>
     * </blockquote>
     *
     * <p>
     * As excerpted above, validation on the {```aud```} claim of request objects
     * is optional. However, if this flag is turned on, Authlete checks whether
     * the {```aud```} claim of request objects matches the issuer identifier of
     * this service and raises an error if they are different.
     * </p>
     *
     * @return bool
     *      True if request object audience is checked, false otherwise.
     */
    public function isRequestObjectAudienceChecked(): bool
    {
        return $this->requestObjectAudienceChecked;
    }

    /**
     * Set the flag indicating whether Authlete checks whether the {```aud```}
     * claim of request objects matches the issuer identifier of this service.
     *
     * <p>
     * Section 6.1. Passing a Request Object by Value:
     * https://openid.net/specs/openid-connect-core-1_0.html#JWTRequests
     * of
     * OpenID Connect Core 1.0: https://openid.net/specs/openid-connect-core-1_0.html
     * has the following statement.
     * </p>
     *
     * <blockquote>
     * <p>
     * The {```aud```} value SHOULD be or include the OP's Issuer Identifier URL.
     * </p>
     * </blockquote>
     *
     * <p>
     * Likewise, Section 4. Request Object: https://www.rfc-editor.org/rfc/rfc9101.html#section-4
     * of
     * RFC 9101: https://www.rfc-editor.org/rfc/rfc9101.html (The OAuth 2.0
     * Authorization Framework: JWT-Secured Authorization Request (JAR)) has the
     * following statement.
     * </p>
     *
     * <blockquote>
     * <p>
     * The value of {```aud```} should be the value of the authorization server
     * (AS) {```issuer```}, as defined in
     * RFC 8414: https://www.rfc-editor.org/rfc/rfc8414.html.
     * </p>
     * </blockquote>
     *
     * <p>
     * As excerpted above, validation on the {```aud```} claim of request objects
     * is optional. However, if this flag is turned on, Authlete checks whether
     * the {```aud```} claim of request objects matches the issuer identifier of
     * this service and raises an error if they are different.
     * </p>
     *
     * @param bool $requestObjectAudienceChecked
     *      The request object audience checked status.
     *
     * @return self
     */
    public function setRequestObjectAudienceChecked(bool $requestObjectAudienceChecked): self
    {
        $this->requestObjectAudienceChecked = $requestObjectAudienceChecked;
        return $this;
    }

    /**
     * Get the flag indicating whether Authlete generates access tokens for
     * external attachments and embeds them in ID tokens and userinfo
     * responses.
     *
     * <p>
     * The third draft of
     * OpenID Connect for Identity Assurance 1.0:
     * https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html
     * introduced a new feature
     * called "Attachments". The feature enables OpenID Providers to attach
     * additional contents as parts of "evidence".
     * </p>
     *
     * <p>
     * There are two types of attachments. One is "embedded attachment" where
     * contents of attachments are base64-encoded and embedded in ID tokens
     * and userinfo responses directly. The other is "external attachment"
     * where contents of attachments are hosted on resource servers and URLs
     * of them are embedded in ID tokens and userinfo responses.
     * </p>
     *
     * <p>
     * When an OpenID Provider embeds URLs of external attachments in ID tokens
     * and userinfo responses, it may optionally embed access tokens with which
     * the client application accesses the external attachments.
     * </p>
     *
     * <p>
     * The following is an example of {``` "verified_claims"```} that shows how
     * an access token is embedded. (A simplified version of an example in the
     * specification.)
     * </p>
     *
     * <pre>
     * "verified_claims": {
     *   "verification": {
     *     "trust_framework":"eidas",
     *     "evidence": [
     *       {
     *         "type": "document",
     *         "attachments": [
     *           {
     *             "desc": "Front of id document",
     *             "digest": {
     *               "alg": "sha-256",
     *               "value": "qC1zE5AfxylOFLrCnOIURXJUvnZwSFe5uUj8t6hdQVM="
     *             },
     *             "url": "https://example.com/attachments/pGL9yz4hZQ",
     *             "access_token": "ksj3n283dke",
     *             "exp": 1676552089
     *           }
     *         ]
     *       }
     *     ]
     *   },
     *   "claims": {
     *     "given_name": "Max",
     *     "family_name": "Mustermann",
     *     "birthdate": "1956-01-28"
     *   }
     * }
     * </pre>
     *
     * <p>
     * Because it is developers (not Authlete) who prepare the content of
     * {``` "verified_claims"```} (cf. the {``` "claims"```} request parameter of
     * Authlete's {``` /api/auth/authorization/issue```} API), developers can
     * embed arbitrary access tokens for external attachments. However, it is
     * a burdensome task to prepare access tokens appropriately. The task can
     * be delegated to Authlete by setting true to this
     * {``` accessTokenForExternalAttachmentEmbedded```} property.
     * </p>
     *
     * <p>
     * When this property is set to true, Authlete behaves as described below
     * for each element in the {``` "attachments"```} array.
     * </p>
     *
     * <ol>
     * <li>Ignores the element if it does not contain the {``` "url"```} property
     *     because it means that the element is not an external attachment.
     * <li>Does nothing for the element if it already contains the
     *     {``` "access_token"```} property.
     * <li>Computes the duration of the access token which is about to be
     *     generated. If the element already contains the {``` "exp"```} property,
     *     its value is used to compute the duration. Otherwise, (1) the duration
     *     of the ID token is used as the duration of the access token for the
     *     external attachment in the case where the URL of the external attachment
     *     is going to be embedded in an ID token, or (2) the remaining duration
     *     of the access token which was presented at the userinfo endpoint is
     *     used as the duration of the access token for the external attachment
     *     in the case where the URL of the external attachment is going to be
     *     embedded in a userinfo response.
     * <li>Generates an access token which has the duration computed in the
     *     previous step. Also, the access token has the URL as an associated
     *     resource as if the {```resource```} request parameter defined in
     *     RFC 8707: https://www.rfc-editor.org/rfc/rfc8707.html">
     *     (Resource Indicators for OAuth 2.0) were used.
     * <li>Puts the {``` "access_token"```} and {``` "exp"```} properties
     *     in the element whose values are the generated access token and the
     *     computed duration.
     * </ol>
     *
     *  <p>
     *  Note that the {``` expires_in```} property was replaced with {```exp```}
     *  after the 4th draft of the OpenID Connect for Identity Assurance 1.0
     *  was published.
     *  </p>
     *
     * @return bool
     *      True if access token for external attachment is embedded, false otherwise.
     */
    public function isAccessTokenForExternalAttachmentEmbedded(): bool
    {
        return $this->accessTokenForExternalAttachmentEmbedded;
    }

    /**
     * /**
     * Set the flag indicating whether Authlete generates access tokens for
     * external attachments and embeds them in ID tokens and userinfo
     * responses.
     *
     * <p>
     * The third draft of
     * OpenID Connect for Identity Assurance 1.0:
     * https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html
     * introduced a new feature
     * called "Attachments". The feature enables OpenID Providers to attach
     * additional contents as parts of "evidence".
     * </p>
     *
     * <p>
     * There are two types of attachments. One is "embedded attachment" where
     * contents of attachments are base64-encoded and embedded in ID tokens
     * and userinfo responses directly. The other is "external attachment"
     * where contents of attachments are hosted on resource servers and URLs
     * of them are embedded in ID tokens and userinfo responses.
     * </p>
     *
     * <p>
     * When an OpenID Provider embeds URLs of external attachments in ID tokens
     * and userinfo responses, it may optionally embed access tokens with which
     * the client application accesses the external attachments.
     * </p>
     *
     * <p>
     * The following is an example of {``` "verified_claims"```} that shows how
     * an access token is embedded. (A simplified version of an example in the
     * specification.)
     * </p>
     *
     * <pre>
     * "verified_claims": {
     *   "verification": {
     *     "trust_framework":"eidas",
     *     "evidence": [
     *       {
     *         "type": "document",
     *         "attachments": [
     *           {
     *             "desc": "Front of id document",
     *             "digest": {
     *               "alg": "sha-256",
     *               "value": "qC1zE5AfxylOFLrCnOIURXJUvnZwSFe5uUj8t6hdQVM="
     *             },
     *             "url": "https://example.com/attachments/pGL9yz4hZQ",
     *             "access_token": "ksj3n283dke",
     *             "exp": 1676552089
     *           }
     *         ]
     *       }
     *     ]
     *   },
     *   "claims": {
     *     "given_name": "Max",
     *     "family_name": "Mustermann",
     *     "birthdate": "1956-01-28"
     *   }
     * }
     * </pre>
     *
     * <p>
     * Because it is developers (not Authlete) who prepare the content of
     * {``` "verified_claims"```} (cf. the {``` "claims"```} request parameter of
     * Authlete's {``` /api/auth/authorization/issue```} API), developers can
     * embed arbitrary access tokens for external attachments. However, it is
     * a burdensome task to prepare access tokens appropriately. The task can
     * be delegated to Authlete by setting true to this
     * {``` accessTokenForExternalAttachmentEmbedded```} property.
     * </p>
     *
     * <p>
     * When this property is set to true, Authlete behaves as described below
     * for each element in the {``` "attachments"```} array.
     * </p>
     *
     * <ol>
     * <li>Ignores the element if it does not contain the {``` "url"```} property
     *     because it means that the element is not an external attachment.
     * <li>Does nothing for the element if it already contains the
     *     {``` "access_token"```} property.
     * <li>Computes the duration of the access token which is about to be
     *     generated. If the element already contains the {``` "exp"```} property,
     *     its value is used to compute the duration. Otherwise, (1) the duration
     *     of the ID token is used as the duration of the access token for the
     *     external attachment in the case where the URL of the external attachment
     *     is going to be embedded in an ID token, or (2) the remaining duration
     *     of the access token which was presented at the userinfo endpoint is
     *     used as the duration of the access token for the external attachment
     *     in the case where the URL of the external attachment is going to be
     *     embedded in a userinfo response.
     * <li>Generates an access token which has the duration computed in the
     *     previous step. Also, the access token has the URL as an associated
     *     resource as if the {```resource```} request parameter defined in
     *     RFC 8707: https://www.rfc-editor.org/rfc/rfc8707.html">
     *     (Resource Indicators for OAuth 2.0) were used.
     * <li>Puts the {``` "access_token"```} and {``` "exp"```} properties
     *     in the element whose values are the generated access token and the
     *     computed duration.
     * </ol>
     *
     * <p>
     * Note that the {``` expires_in```} property was replaced with {```exp```}
     * after the 4th draft of the OpenID Connect for Identity Assurance 1.0
     * was published.
     * </p>
     *
     * @param bool $accessTokenForExternalAttachmentEmbedded
     *      The access token for external attachment embedded status.
     *
     * @return self
     */
    public function setAccessTokenForExternalAttachmentEmbedded(bool $accessTokenForExternalAttachmentEmbedded): self
    {
        $this->accessTokenForExternalAttachmentEmbedded = $accessTokenForExternalAttachmentEmbedded;
        return $this;
    }

    /**
     * Get the flag indicating whether refresh token requests with the same
     * refresh token can be made multiple times in quick succession and they
     * can obtain the same renewed refresh token within the short period.
     *
     * <p>
     * This feature is available in Authlete 2.3 onwards.
     * </p>
     *
     * @return bool
     *      True if refresh token is idempotent, false otherwise.
     */
    public function isRefreshTokenIdempotent(): bool
    {
        return $this->refreshTokenIdempotent;
    }

    /**
     * Set the flag indicating whether refresh token requests with the same
     * refresh token can be made multiple times in quick succession and they
     * can obtain the same renewed refresh token within the short period.
     *
     * <p>
     * This feature is available in Authlete 2.3 onwards.
     * </p>
     *
     * @param bool $refreshTokenIdempotent
     *      The refresh token idempotent status.
     *
     * @return self
     */
    public function setRefreshTokenIdempotent(bool $refreshTokenIdempotent): self
    {
        $this->refreshTokenIdempotent = $refreshTokenIdempotent;
        return $this;
    }

    /**
     * Get the flag indicating whether this service supports
     * OpenID Federation 1&#x002E;0 https://openid.net/specs/openid-federation-1_0.html.
     *
     * <p>
     * If the feature of OpenID Federation 1.0 is not enabled in the
     * Authlete server on which this service is hosted, functions related to
     * OpenID Federation 1.0 are not usable regardless of the setting
     * of this property.
     * </p>
     *
     * <p>
     * OpenID Federation 1.0 is supported by Authlete 2.3 onwards.
     * </p>
     *
     * @return bool
     *      True if federation is enabled, false otherwise.
     */
    public function isFederationEnabled(): bool
    {
        return $this->federationEnabled;
    }

    /**
     * Set the flag indicating whether this service supports
     * OpenID Federation 1&#x002E;0 https://openid.net/specs/openid-federation-1_0.html.
     *
     * <p>
     * If the feature of OpenID Federation 1.0 is not enabled in the
     * Authlete server on which this service is hosted, functions related to
     * OpenID Federation 1.0 are not usable regardless of the setting
     * of this property.
     * </p>
     *
     * <p>
     * OpenID Federation 1.0 is supported by Authlete 2.3 onwards.
     * </p>
     *
     * @param bool $federationEnabled
     *      The federation enabled status.
     *
     * @return self
     */
    public function setFederationEnabled(bool $federationEnabled): self
    {
        $this->federationEnabled = $federationEnabled;
        return $this;
    }

    /**
     * Get the human-readable name representing the organization that operates
     * this service. This property corresponds to the {```organization_name```}
     * server metadata that is defined in
     * OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * If this property is not empty, the {```organization_name```} property
     * appears in self-signed entity statements of this service.
     * </p>
     *
     * @return ?string
     *      The organization name.
     */
    public function getOrganizationName(): ?string
    {
        return $this->organizationName;
    }

    /**
     * Set the human-readable name representing the organization that operates
     * this service. This property corresponds to the {```organization_name```}
     * server metadata that is defined in
     * OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * If this property is not empty, the {```organization_name```} property
     * appears in self-signed entity statements of this service.
     * </p>
     *
     * @param ?string $organizationName
     *      The organization name.
     *
     * @return self
     */
    public function setOrganizationName(?string $organizationName): self
    {
        $this->organizationName = $organizationName;
        return $this;
    }

    /**
     * Get the identifiers of entities that can issue entity statements for
     * this service. This property corresponds to the {```authority_hints```}
     * property that appears in a self-signed entity statement that is defined
     * in OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * OpenID providers participating in one or more federations are supposed
     * to have authority hints. It is only trust anchors having no superiors
     * that do not have authority hints.
     * </p>
     *
     * <p>
     * Because the {```authority_hints```} property in self-signed entity
     * statements of OpenID providers is mandatory, if this property is empty,
     * the configuration endpoint ({``` /.well-known/openid-federation```})
     * cannot generate a valid entity statement. It means that OpenID
     * Federation 1.0 does not work.
     * </p>
     *
     * @return array
     *      The authority hints.
     */
    public function getAuthorityHints(): array
    {
        return $this->authorityHints;
    }

    /**
     * Set the identifiers of entities that can issue entity statements for
     * this service. This property corresponds to the {```authority_hints```}
     * property that appears in a self-signed entity statement that is defined
     * in OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * OpenID providers participating in one or more federations are supposed
     * to have authority hints. It is only trust anchors having no superiors
     * that do not have authority hints.
     * </p>
     *
     * <p>
     * Because the {```authority_hints```} property in self-signed entity
     * statements of OpenID providers is mandatory, if this property is empty,
     * the configuration endpoint ({``` /.well-known/openid-federation```})
     * cannot generate a valid entity statement. It means that OpenID
     * Federation 1.0 does not work.
     * </p>
     *
     * @param array $authorityHints
     *      The authority hints.
     * @return self
     */
    public function setAuthorityHints(array $authorityHints): self
    {
        $this->authorityHints = $authorityHints;
        return $this;
    }

    /**
     * Get the trust anchors that are referenced when this service resolves
     * trust chains of relying parties.
     *
     * <p>
     * If this property is empty, client registration fails regardless of
     * whether its type is {```automatic```} or {```explicit```}. It means
     * that OpenID Federation 1.0 does not work.
     * </p>
     *
     * @return array The trust anchors.
     */
    public function getTrustAnchors(): array
    {
        return $this->trustAnchors;
    }

    /**
     * Set the trust anchors that are referenced when this service resolves
     * trust chains of relying parties.
     *
     * <p>
     * If this property is empty, client registration fails regardless of
     * whether its type is {```automatic```} or {```explicit```}. It means
     * that OpenID Federation 1.0 does not work.
     * </p>
     *
     * @param array $trustAnchors The trust anchors.
     * @return self
     */
    public function setTrustAnchors(array $trustAnchors): self
    {
        $this->trustAnchors = $trustAnchors;
        return $this;
    }

    /**
     * Get the JWK Set document containing keys that are used to sign (1)
     * self-signed entity statement of this service and (2) the response from
     * {```signed_jwks_uri```}.
     *
     * <p>
     * If this property is empty, this service cannot generate a valid
     * self-signed entity statement. It means that OpenID Federation
     * 1.0 does not work.
     * </p>
     *
     * @return ?string The federation JWKS.
     */
    public function getFederationJwks(): ?string
    {
        return $this->federationJwks;
    }

    /**
     * Set the JWK Set document containing keys that are used to sign (1)
     * self-signed entity statement of this service and (2) the response from
     * {```signed_jwks_uri```}.
     *
     * <p>
     * If this property is empty, this service cannot generate a valid
     * self-signed entity statement. It means that OpenID Federation
     * 1.0 does not work.
     * </p>
     *
     * @param ?string $federationJwks The federation JWKS.
     * @return self
     */
    public function setFederationJwks(?string $federationJwks): self
    {
        $this->federationJwks = $federationJwks;
        return $this;
    }

    /**
     * Get the key ID to identify a JWK that should be used to sign the entity
     * configuration and the signed JWK Set.
     *
     * <p>
     * The entity configuration is a kind of JWT and published at
     * {``` /.well-known/openid-federation```} or at a variant location such as
     * {``` /.well-known/openid-federation```}<i>{path_part_of_issuer}</i>.
     * </p>
     *
     * <p>
     * The signed JWK Set is also a kind of JWT and published at the URL
     * designated by the {```signed_jwks_uri```} server metadata.
     * </p>
     *
     * <p>
     * When this property is specified, Authlete will use the JWK having the
     * specified key ID when signing the entity configuration and the signed
     * JWK Set. Otherwise, when this property is omitted, there is no guarantee
     * as to which JWK Authlete will choose.
     * </p>
     *
     * @return ?string The federation signature key ID.
     */
    public function getFederationSignatureKeyId(): ?string
    {
        return $this->federationSignatureKeyId;
    }

    /**
     * Set the key ID to identify a JWK that should be used to sign the entity
     * configuration and the signed JWK Set.
     *
     * <p>
     * The entity configuration is a kind of JWT and published at
     * {``` /.well-known/openid-federation```} or at a variant location such as
     * {``` /.well-known/openid-federation```}<i>{path_part_of_issuer}</i>.
     * </p>
     *
     * <p>
     * The signed JWK Set is also a kind of JWT and published at the URL
     * designated by the {```signed_jwks_uri```} server metadata.
     * </p>
     *
     * <p>
     * When this property is specified, Authlete will use the JWK having the
     * specified key ID when signing the entity configuration and the signed
     * JWK Set. Otherwise, when this property is omitted, there is no guarantee
     * as to which JWK Authlete will choose.
     * </p>
     *
     * @param ?string $federationSignatureKeyId The federation signature key ID.
     * @return self
     */
    public function setFederationSignatureKeyId(?string $federationSignatureKeyId): self
    {
        $this->federationSignatureKeyId = $federationSignatureKeyId;
        return $this;
    }

    /**
     * Get the duration of the entity configuration in seconds.
     *
     * <p>
     * An OpenID provider that participates in an OpenID Connect federation
     * must publish its entity configuration at
     * {``` /.well-known/openid-federation```} or at a variant location such as
     * ``` /.well-known/openid-federation``` <i>{```path_part_of_issuer```}</i>.
     * An entity configuration is a kind of JWT. This property specifies the
     * duration of the JWT in seconds.
     * </p>
     *
     * <p>
     * When the value of this property is 0, the default value determined by
     * your Authlete server is used as the duration of the entity configuration.
     * </p>
     *
     * @return int The federation configuration duration.
     */
    public function getFederationConfigurationDuration(): int
    {
        return $this->federationConfigurationDuration;
    }

    /**
     * Set the duration of the entity configuration in seconds.
     *
     * <p>
     * An OpenID provider that participates in an OpenID Connect federation
     * must publish its entity configuration at
     * {``` /.well-known/openid-federation```} or at a variant location such as
     * ``` /.well-known/openid-federation``` <i>{```path_part_of_issuer```}</i>.
     * An entity configuration is a kind of JWT. This property specifies the
     * duration of the JWT in seconds.
     * </p>
     *
     * <p>
     * When the value of this property is 0, the default value determined by
     * your Authlete server is used as the duration of the entity configuration.
     * </p>
     *
     * @param int $federationConfigurationDuration The federation configuration duration.
     * @return self
     */
    public function setFederationConfigurationDuration(int $federationConfigurationDuration): self
    {
        $this->federationConfigurationDuration = $federationConfigurationDuration;
        return $this;
    }

    /**
     * Get the URI of the endpoint that returns this service's JWK Set document in
     * the JWT format. This property corresponds to the {```signed_jwks_uri```}
     * server metadata defined in OpenID Federation 1.0:
     * https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * The JWT returned from the endpoint is signed with a key in the JWK Set
     * document specified by the {```federationJwks```} property. Therefore, if
     * the {```federationJwks```} property is not set up properly, the endpoint
     * won't return a valid response.
     * </p>
     *
     * <p>
     * If this property is not empty, the {```signed_jwks_uri```} property
     * appears in the {```openid_provider```} property of this service's entity
     * configuration. And in that case, {```jwks_uri```} does not appear in
     * exchange.
     * </p>
     *
     * @return ?string The signed JWKS URI.
     */
    public function getSignedJwksUri(): ?string
    {
        return $this->signedJwksUri;
    }

    /**
     * Set the URI of the endpoint that returns this service's JWK Set document in
     * the JWT format. This property corresponds to the {```signed_jwks_uri```}
     * server metadata defined in OpenID Federation 1.0:
     * https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * The JWT returned from the endpoint is signed with a key in the JWK Set
     * document specified by the {```federationJwks```} property. Therefore, if
     * the {```federationJwks```} property is not set up properly, the endpoint
     * won't return a valid response.
     * </p>
     *
     * <p>
     * If this property is not empty, the {```signed_jwks_uri```} property
     * appears in the {```openid_provider```} property of this service's entity
     * configuration. And in that case, {```jwks_uri```} does not appear in
     * exchange.
     * </p>
     *
     * @param ?string $signedJwksUri The signed JWKS URI.
     * @return self
     */
    public function setSignedJwksUri(?string $signedJwksUri): self
    {
        $this->signedJwksUri = $signedJwksUri;
        return $this;
    }

    /**
     * Get the URI of the federation registration endpoint. This property
     * corresponds to the {```federation_registration_endpoint```} server
     * metadata that is defined in
     * OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * If this service declares it supports the "```explicit```}" client
     * registration, this property must not be empty.
     * </p>
     *
     * @return ?string The federation registration endpoint.
     */
    public function getFederationRegistrationEndpoint(): ?string
    {
        return $this->federationRegistrationEndpoint;
    }

    /**
     * Set the URI of the federation registration endpoint. This property
     * corresponds to the {```federation_registration_endpoint```} server
     * metadata that is defined in
     * OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html
     *
     * <p>
     * If this service declares it supports the "```explicit```}" client
     * registration, this property must not be empty.
     * </p>
     *
     * @param ?string $federationRegistrationEndpoint The federation registration endpoint.
     * @return self
     */
    public function setFederationRegistrationEndpoint(?string $federationRegistrationEndpoint): self
    {
        $this->federationRegistrationEndpoint = $federationRegistrationEndpoint;
        return $this;
    }

    /**
     * Get the client registration types supported by this service. This
     * property corresponds to the {```client_registration_types_supported```}
     * server metadata that is defined in
     * OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html.
     *
     * <p>
     * If this property includes {@link ClientRegistrationType::EXPLICIT
     * }, the {```federationRegistrationEndpoint```} property must be
     * set up properly.
     * </p>
     *
     * @return array The supported client registration types.
     */
    public function getSupportedClientRegistrationTypes(): array
    {
        return $this->supportedClientRegistrationTypes;
    }

    /**
     * Set the client registration types supported by this service. This
     * property corresponds to the {```client_registration_types_supported```}
     * server metadata that is defined in
     * OpenID Federation 1.0: https://openid.net/specs/openid-federation-1_0.html.
     *
     * <p>
     * If this property includes {@link ClientRegistrationType::EXPLICIT}
     * , the {```federationRegistrationEndpoint```} property must be
     * set up properly.
     * </p>
     *
     * @param array $supportedClientRegistrationTypes The supported client registration types.
     * @return self
     */
    public function setSupportedClientRegistrationTypes(array $supportedClientRegistrationTypes): self
    {
        $this->supportedClientRegistrationTypes = $supportedClientRegistrationTypes;
        return $this;
    }

    /**
     * Get the flag indicating whether to prohibit unidentifiable clients from
     * making token exchange requests (cf&#x002E;
     * RFC 8693: https://www.rfc-editor.org/rfc/rfc8693.html).
     *
     * <p>
     * Section 2.1 of RFC 8692 OAuth 2.0 Token Exchange: https://www.rfc-editor.org/rfc/rfc8693.html
     * states as follows:
     * </p>
     *
     * <blockquote>
     * <p>
     * <i>The supported methods of client authentication and whether or not
     * to allow unauthenticated or <b>unidentified</b> clients are deployment
     * decisions that are at the discretion of the authorization server.</i>
     * </p>
     * </blockquote>
     *
     * <p>
     * Technically speaking, "<b>unidentified</b>" in the excerpted sentence
     * means that a token exchange request contains no identifier of the client
     * that made the request.
     * </p>
     *
     * <p>
     * When this flag is set to {```true```}, this service rejects token
     * exchange requests that contain no client identifier.
     * </p>
     *
     * @return bool True if token exchange by identifiable clients only is enabled, false otherwise.
     */
    public function isTokenExchangeByIdentifiableClientsOnly(): bool
    {
        return $this->tokenExchangeByIdentifiableClientsOnly;
    }

    /**
     * Set the flag indicating whether to prohibit unidentifiable clients from
     * making token exchange requests (cf&#x002E;
     * RFC 8693: https://www.rfc-editor.org/rfc/rfc8693.html).
     *
     * <p>
     * Section 2.1 of RFC 8692 OAuth 2.0 Token Exchange: https://www.rfc-editor.org/rfc/rfc8693.html
     * states as follows:
     * </p>
     *
     * <blockquote>
     * <p>
     * <i>The supported methods of client authentication and whether or not
     * to allow unauthenticated or <b>unidentified</b> clients are deployment
     * decisions that are at the discretion of the authorization server.</i>
     * </p>
     * </blockquote>
     *
     * <p>
     * Technically speaking, "<b>unidentified</b>" in the excerpted sentence
     * means that a token exchange request contains no identifier of the client
     * that made the request.
     * </p>
     *
     * <p>
     * When this flag is set to {```true```}, this service rejects token
     * exchange requests that contain no client identifier.
     * </p>
     *
     * @param bool $tokenExchangeByIdentifiableClientsOnly The token exchange by identifiable clients only enabled status.
     * @return self
     */
    public function setTokenExchangeByIdentifiableClientsOnly(bool $tokenExchangeByIdentifiableClientsOnly): self
    {
        $this->tokenExchangeByIdentifiableClientsOnly = $tokenExchangeByIdentifiableClientsOnly;
        return $this;
    }

    /**
     * Get the flag indicating whether to prohibit public clients from making
     * token exchange requests (cf&#x002E;
     * RFC 8693: https://www.rfc-editor.org/rfc/rfc8693.html.
     *
     * <p>
     * Section 2.1 of RFC 8692 OAuth 2.0 Token Exchange: https://www.rfc-editor.org/rfc/rfc8693.html"
     * states as follows:
     * </p>
     *
     * <blockquote>
     * <p>
     * <i>The supported methods of client authentication and whether or not
     * to allow <b>unauthenticated</b> or unidentified clients are deployment
     * decisions that are at the discretion of the authorization server.</i>
     * </p>
     * </blockquote>
     *
     * <p>
     * Technically speaking, "<b>unauthenticated</b>" in the excerpted sentence
     * means that the client making a token exchange request is a public client
     * and so
     * client authentication: https://darutk.medium.com/oauth-2-0-client-authentication-4b5f929305d4"
     * for the client is not required at the token
     * endpoint.
     * </p>
     *
     * <p>
     * When this flag is set to {```true```}, this service rejects token
     * exchange requests from public clients.
     * </p>
     *
     * @return bool True if token exchange by confidential clients only is enabled, false otherwise.
     */
    public function isTokenExchangeByConfidentialClientsOnly(): bool
    {
        return $this->tokenExchangeByConfidentialClientsOnly;
    }

    /**
     * Set the flag indicating whether to prohibit public clients from making
     * token exchange requests (cf&#x002E;
     * RFC 8693: https://www.rfc-editor.org/rfc/rfc8693.html.
     *
     * <p>
     * Section 2.1 of RFC 8692 OAuth 2.0 Token Exchange: https://www.rfc-editor.org/rfc/rfc8693.html"
     * states as follows:
     * </p>
     *
     * <blockquote>
     * <p>
     * <i>The supported methods of client authentication and whether or not
     * to allow <b>unauthenticated</b> or unidentified clients are deployment
     * decisions that are at the discretion of the authorization server.</i>
     * </p>
     * </blockquote>
     *
     * <p>
     * Technically speaking, "<b>unauthenticated</b>" in the excerpted sentence
     * means that the client making a token exchange request is a public client
     * and so
     * client authentication: https://darutk.medium.com/oauth-2-0-client-authentication-4b5f929305d4"
     * for the client is not required at the token
     * endpoint.
     * </p>
     *
     * <p>
     * When this flag is set to {```true```}, this service rejects token
     * exchange requests from public clients.
     * </p>
     *
     * @param bool $tokenExchangeByConfidentialClientsOnly The token exchange by confidential clients only enabled status.
     * @return self
     */
    public function setTokenExchangeByConfidentialClientsOnly(bool $tokenExchangeByConfidentialClientsOnly): self
    {
        $this->tokenExchangeByConfidentialClientsOnly = $tokenExchangeByConfidentialClientsOnly;
        return $this;
    }

    /**
     * Get the flag indicating whether to prohibit clients which have no
     * explicit permission from making token exchange requests (cf&#x002E;
     * RFC 8693: https://www.rfc-editor.org/rfc/rfc8693.html).
     *
     * <p>
     * An administrator can give a client an explicit permission to make
     * token exchange requests by setting {```true```} to the
     * {```tokenExchangePermitted```} flag of the client (cf.
     * {@link ClientExtension::setTokenExchangePermitted()}).
     * </p>
     *
     * <p>
     * When this flag ({```tokenExchangeByPermittedClientsOnly```}) is set
     * to {```true```}, this service rejects token exchange requests from
     * clients whose {```tokenExchangePermitted```} flag is {```false```}.
     * </p>
     *
     * @return bool
     *      True if token exchange by permitted clients only is enabled, false otherwise.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8693.html RFC 8693 OAuth 2.0 Token Exchange
     *
     * @since Authlete 2.3
     */
    public function isTokenExchangeByPermittedClientsOnly(): bool
    {
        return $this->tokenExchangeByPermittedClientsOnly;
    }

    /**
     * Set the flag indicating whether to prohibit clients which have no
     * explicit permission from making token exchange requests (cf&#x002E;
     * RFC 8693: https://www.rfc-editor.org/rfc/rfc8693.html).
     *
     * <p>
     * An administrator can give a client an explicit permission to make
     * token exchange requests by setting {```true```} to the
     * {```tokenExchangePermitted```} flag of the client (cf.
     * {@link ClientExtension::setTokenExchangePermitted()}).
     * </p>
     *
     * <p>
     * When this flag ({```tokenExchangeByPermittedClientsOnly```}) is set
     * to {```true```}, this service rejects token exchange requests from
     * clients whose {```tokenExchangePermitted```} flag is {```false```}.
     * </p>
     *
     * @param bool $tokenExchangeByPermittedClientsOnly
     *      The token exchange by permitted clients only enabled status.
     *
     * @return self
     *
     * @see https://www.rfc-editor.org/rfc/rfc8693.html RFC 8693 OAuth 2.0 Token Exchange
     *
     * @since Authlete 2.3
     */
    public function setTokenExchangeByPermittedClientsOnly(bool $tokenExchangeByPermittedClientsOnly): self
    {
        $this->tokenExchangeByPermittedClientsOnly = $tokenExchangeByPermittedClientsOnly;
        return $this;
    }

    /**
     * Get the flag indicating whether to reject token exchange requests which
     * use encrypted JWTs as input tokens.
     *
     * <p>
     * When this {```tokenExchangeEncryptedJwtRejected```} flag is {```true```},
     * token exchange requests which use encrypted JWTs as input tokens (subject
     * token and/or actor token) with the token type
     * {``` "urn:ietf:params:oauth:token-type:jwt"```} or the token type
     * {``` "urn:ietf:params:oauth:token-type:id_token"```} are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input token when Authlete detects that it is an encrypted
     * JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for token exchange requests.
     * </p>
     *
     * @return bool
     *      True if encrypted JWT for token exchange is rejected, false otherwise.
     *
     * @since Authlete 2.3
     */
    public function isTokenExchangeEncryptedJwtRejected(): bool
    {
        return $this->tokenExchangeEncryptedJwtRejected;
    }

    /**
     * Set the flag indicating whether to reject token exchange requests which
     * use encrypted JWTs as input tokens.
     *
     * <p>
     * When this {```tokenExchangeEncryptedJwtRejected```} flag is {```true```},
     * token exchange requests which use encrypted JWTs as input tokens (subject
     * token and/or actor token) with the token type
     * {``` "urn:ietf:params:oauth:token-type:jwt"```} or the token type
     * {``` "urn:ietf:params:oauth:token-type:id_token"```} are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input token when Authlete detects that it is an encrypted
     * JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for token exchange requests.
     * </p>
     *
     * @param bool $tokenExchangeEncryptedJwtRejected
     *      The encrypted JWT for token exchange rejected status.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setTokenExchangeEncryptedJwtRejected(bool $tokenExchangeEncryptedJwtRejected): self
    {
        $this->tokenExchangeEncryptedJwtRejected = $tokenExchangeEncryptedJwtRejected;
        return $this;
    }

    /**
     * Get the flag indicating whether to reject token exchange requests which
     * use unsigned JWTs as input tokens.
     *
     * <p>
     * When this {```tokenExchangeUnsignedJwtRejected```} flag is {```true```},
     * token exchange requests which use unsigned JWTs as input tokens (subject
     * token and/or actor token) with the token type
     * {``` "urn:ietf:params:oauth:token-type:jwt"```} or the token type
     * {``` "urn:ietf:params:oauth:token-type:id_token"```} are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input token when Authlete detects that it is an unsigned
     * JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for token exchange requests.
     * </p>
     *
     * @return bool True if unsigned JWT for token exchange is rejected, false otherwise.
     *
     * @since Authlete 2.3
     */
    public function isTokenExchangeUnsignedJwtRejected(): bool
    {
        return $this->tokenExchangeUnsignedJwtRejected;
    }

    /**
     * Set the flag indicating whether to reject token exchange requests which
     * use unsigned JWTs as input tokens.
     *
     * <p>
     * When this {```tokenExchangeUnsignedJwtRejected```} flag is {```true```},
     * token exchange requests which use unsigned JWTs as input tokens (subject
     * token and/or actor token) with the token type
     * {``` "urn:ietf:params:oauth:token-type:jwt"```} or the token type
     * {``` "urn:ietf:params:oauth:token-type:id_token"```} are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input token when Authlete detects that it is an unsigned
     * JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for token exchange requests.
     * </p>
     *
     * @param bool $tokenExchangeUnsignedJwtRejected
     *      The unsigned JWT for token exchange rejected status.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setTokenExchangeUnsignedJwtRejected(bool $tokenExchangeUnsignedJwtRejected): self
    {
        $this->tokenExchangeUnsignedJwtRejected = $tokenExchangeUnsignedJwtRejected;
        return $this;
    }

    /**
     * Get the flag indicating whether to prohibit unidentifiable clients from
     * using the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * (<a href="https://www.rfc-editor.org/rfc/rfc7523.html">RFC 7523</a>).
     *
     * <p>
     * RFC 7523 JSON Web
     * Token (JWT) Profile for OAuth 2.0 Client Authentication and Authorization
     * Grants: https://www.rfc-editor.org/rfc/rfc7523.html states as follows:
     * </p>
     *
     * <blockquote>
     * <p>
     * <i>JWT authorization grants may be used with or without client
     * authentication or <b>identification</b>.</i>
     * </p>
     * </blockquote>
     *
     * <p>
     * Technically speaking, "<b>identification</b>" in the excerpted sentence
     * means that a token request contains an identifier of the client that
     * made the request.
     * </p>
     *
     * <p>
     * When this flag is set to {```true```}, this service rejects token requests
     * that use the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * but contain no client identifier.
     * </p>
     *
     * @return bool
     *      True if JWT grant by identifiable clients only is enabled, false otherwise.
     *
     * @since Authlete 2.3
     */
    public function isJwtGrantByIdentifiableClientsOnly(): bool
    {
        return $this->jwtGrantByIdentifiableClientsOnly;
    }

    /**
     * Set the flag indicating whether to prohibit unidentifiable clients from
     * using the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * (<a href="https://www.rfc-editor.org/rfc/rfc7523.html">RFC 7523</a>).
     *
     * <p>
     * RFC 7523 JSON Web
     * Token (JWT) Profile for OAuth 2.0 Client Authentication and Authorization
     * Grants: https://www.rfc-editor.org/rfc/rfc7523.html states as follows:
     * </p>
     *
     * <blockquote>
     * <p>
     * <i>JWT authorization grants may be used with or without client
     * authentication or <b>identification</b>.</i>
     * </p>
     * </blockquote>
     *
     * <p>
     * Technically speaking, "<b>identification</b>" in the excerpted sentence
     * means that a token request contains an identifier of the client that
     * made the request.
     * </p>
     *
     * <p>
     * When this flag is set to {```true```}, this service rejects token requests
     * that use the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * but contain no client identifier.
     * </p>
     *
     * @param bool $jwtGrantByIdentifiableClientsOnly
     *      The JWT grant by identifiable clients only enabled status.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setJwtGrantByIdentifiableClientsOnly(bool $jwtGrantByIdentifiableClientsOnly): self
    {
        $this->jwtGrantByIdentifiableClientsOnly = $jwtGrantByIdentifiableClientsOnly;
        return $this;
    }

    /**
     * Get the flag indicating whether to reject token requests that use
     * an encrypted JWT as an authorization grant with the grant type
     * {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * (RFC 7523: https://www.rfc-editor.org/rfc/rfc7523.html).
     *
     * <p>
     * When this {```jwtGrantEncryptedJwtRejected```} flag is {```true```},
     * token requests that use an encrypted JWT as an authorization grant with
     * the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input assertion when Authlete detects that it is an
     * encrypted JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for the grant type.
     * </p>
     *
     * @return bool
     *      True if encrypted JWT for JWT grant is rejected, false otherwise.
     *
     * @since Authlete 2.3
     */
    public function isJwtGrantEncryptedJwtRejected(): bool
    {
        return $this->jwtGrantEncryptedJwtRejected;
    }

    /**
     * Set the flag indicating whether to reject token requests that use
     * an encrypted JWT as an authorization grant with the grant type
     * {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * (RFC 7523: https://www.rfc-editor.org/rfc/rfc7523.html).
     *
     * <p>
     * When this {```jwtGrantEncryptedJwtRejected```} flag is {```true```},
     * token requests that use an encrypted JWT as an authorization grant with
     * the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input assertion when Authlete detects that it is an
     * encrypted JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for the grant type.
     * </p>
     *
     * @param bool $jwtGrantEncryptedJwtRejected
     *      The encrypted JWT for JWT grant rejected status.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setJwtGrantEncryptedJwtRejected(bool $jwtGrantEncryptedJwtRejected): self
    {
        $this->jwtGrantEncryptedJwtRejected = $jwtGrantEncryptedJwtRejected;
        return $this;
    }

    /**
     * Get the flag indicating whether to reject token requests that use
     * an unsigned JWT as an authorization grant with the grant type
     * {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * (RFC 7523: https://www.rfc-editor.org/rfc/rfc7523.html).
     *
     * <p>
     * When this {```jwtGrantUnsignedJwtRejected```} flag is {```true```},
     * token requests that use an unsigned JWT as an authorization grant with
     * the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input assertion when Authlete detects that it is an
     * unsigned JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for the grant type.
     * </p>
     *
     * @return bool
     *      True if unsigned JWT for JWT grant is rejected, false otherwise.
     *
     * @since Authlete 2.3
     */
    public function isJwtGrantUnsignedJwtRejected(): bool
    {
        return $this->jwtGrantUnsignedJwtRejected;
    }

    /**
     * Set the flag indicating whether to reject token requests that use
     * an unsigned JWT as an authorization grant with the grant type
     * {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * (RFC 7523: https://www.rfc-editor.org/rfc/rfc7523.html).
     *
     * <p>
     * When this {```jwtGrantUnsignedJwtRejected```} flag is {```true```},
     * token requests that use an unsigned JWT as an authorization grant with
     * the grant type {``` "urn:ietf:params:oauth:grant-type:jwt-bearer"```}
     * are rejected.
     * </p>
     *
     * <p>
     * When this flag is {```false```}, Authlete skips remaining validation
     * steps on an input assertion when Authlete detects that it is an
     * unsigned JWT.
     * </p>
     *
     * <p>
     * See the description of {@link TokenResponse} for details about validation
     * Authlete performs for the grant type.
     * </p>
     *
     * @param bool $jwtGrantUnsignedJwtRejected
     *      The unsigned JWT for JWT grant rejected status.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setJwtGrantUnsignedJwtRejected(bool $jwtGrantUnsignedJwtRejected): self
    {
        $this->jwtGrantUnsignedJwtRejected = $jwtGrantUnsignedJwtRejected;
        return $this;
    }

    /**
     * Get the flag indicating whether to block DCR (Dynamic Client Registration)
     * requests whose {```software_id```} has already been used previously.
     *
     * <p>
     * A DCR request may contain the {```software_id```} client metadata (which
     * is defined in RFC 7591: https://www.rfc-editor.org/rfc/rfc7591.html).
     * The client metadata is saved in Authlete's database together
     * with other client metadata.
     * </p>
     *
     * <p>
     * If this {```dcrDuplicateSoftwareIdBlocked```} flag is {```true```},
     * Authlete checks whether the value of the {```software_id```} client
     * metadata included in a DCR request already exists in the database,
     * and rejects the DCR request if one exists.
     * </p>
     *
     * @return bool
     *      True if DCR duplicate software ID is blocked, false otherwise.
     *
     * @since Authlete 2.2.30
     */
    public function isDcrDuplicateSoftwareIdBlocked(): bool
    {
        return $this->dcrDuplicateSoftwareIdBlocked;
    }

    /**
     * Set the flag indicating whether to block DCR (Dynamic Client Registration)
     * requests whose {```software_id```} has already been used previously.
     *
     * <p>
     * A DCR request may contain the {```software_id```} client metadata (which
     * is defined in RFC 7591: https://www.rfc-editor.org/rfc/rfc7591.html).
     * The client metadata is saved in Authlete's database together
     * with other client metadata.
     * </p>
     *
     * <p>
     * If this {```dcrDuplicateSoftwareIdBlocked```} flag is {```true```},
     * Authlete checks whether the value of the {```software_id```} client
     * metadata included in a DCR request already exists in the database,
     * and rejects the DCR request if one exists.
     * </p>
     *
     * @param bool $dcrDuplicateSoftwareIdBlocked
     *      The DCR duplicate software ID blocked status.
     *
     * @return self
     *
     * @since Authlete 2.2.30
     */
    public function setDcrDuplicateSoftwareIdBlocked(bool $dcrDuplicateSoftwareIdBlocked): self
    {
        $this->dcrDuplicateSoftwareIdBlocked = $dcrDuplicateSoftwareIdBlocked;
        return $this;
    }

    /**
     * Get the key ID of a JWK containing the private key used by this service to
     * sign responses from the resource server, such as the userinfo endpoint and
     * responses sent to the RS signing endpoint.
     *
     * @return ?string
     *      The resource signature key ID.
     *
     * @since Authlete 2.3
     */
    public function getResourceSignatureKeyId(): ?string
    {
        return $this->resourceSignatureKeyId;
    }

    /**
     * Set the key ID of a JWK containing the private key used by this service to
     * sign responses from the resource server, such as the userinfo endpoint and
     * responses sent to the RS signing endpoint.
     *
     * @param ?string $resourceSignatureKeyId
     *      The resource signature key ID.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setResourceSignatureKeyId(?string $resourceSignatureKeyId): self
    {
        $this->resourceSignatureKeyId = $resourceSignatureKeyId;
        return $this;
    }

    /**
     * Get whether the service signs responses from the resource server.
     * If {```true```}, userinfo issue responses and responses sent to the RS
     * signing endpoint that are in relation to a client's signed request will
     * be signed using the key identified by {@link getResourceSignatureKeyId()}.
     *
     * @return bool
     *      True if RS response is signed, false otherwise.
     *
     * @since Authlete 2.3
     */
    public function isRsResponseSigned(): bool
    {
        return $this->rsResponseSigned;
    }

    /**
     * Set whether the service signs responses from the resource server.
     * If {```true```}, userinfo issue responses and responses sent to the RS
     * signing endpoint that are in relation to a client's signed request will
     * be signed using the key identified by {@link getResourceSignatureKeyId()}.
     *
     * @param bool $rsResponseSigned
     *      The RS response signed status.
     *
     * @return self
     *
     * @since Authlete 2.3
     */
    public function setRsResponseSigned(bool $rsResponseSigned): self
    {
        $this->rsResponseSigned = $rsResponseSigned;
        return $this;
    }

    /**
     * Get the flag indicating whether to remove the {```openid```} scope from
     * a new access token issued by the refresh token flow if the presented
     * refresh token does not contain the {```offline_access```} scope.
     *
     * @return bool
     *      True if OpenID is dropped on refresh without offline access, false otherwise.
     */
    public function isOpenidDroppedOnRefreshWithoutOfflineAccess(): bool
    {
        return $this->openidDroppedOnRefreshWithoutOfflineAccess;
    }

    /**
     * Set the flag indicating whether to remove the {```openid```} scope from
     * a new access token issued by the refresh token flow if the presented
     * refresh token does not contain the {```offline_access```} scope.
     *
     * @param bool $openidDroppedOnRefreshWithoutOfflineAccess The OpenID dropped on refresh without offline access status.
     * @return self
     */
    public function setOpenidDroppedOnRefreshWithoutOfflineAccess(bool $openidDroppedOnRefreshWithoutOfflineAccess): self
    {
        $this->openidDroppedOnRefreshWithoutOfflineAccess = $openidDroppedOnRefreshWithoutOfflineAccess;
        return $this;
    }

    /**
     * Get the flag indicating whether the feature of Verifiable Credentials
     * for this service is enabled or not.
     *
     * @return bool
     *      True if verifiable credentials are enabled, false otherwise.
     *
     * @since Authlete 3.0
     */
    public function isVerifiableCredentialsEnabled(): bool
    {
        return $this->verifiableCredentialsEnabled;
    }

    /**
     * Set the flag indicating whether the feature of Verifiable Credentials
     * for this service is enabled or not.
     *
     * @param bool $verifiableCredentialsEnabled
     *      The verifiable credentials enabled status.
     *
     * @return self
     *
     * @since Authlete 3.0
     */
    public function setVerifiableCredentialsEnabled(bool $verifiableCredentialsEnabled): self
    {
        $this->verifiableCredentialsEnabled = $verifiableCredentialsEnabled;
        return $this;
    }

    /**
     * Get the credential issuer metadata.
     *
     * @return ?string
     *      The credential issuer metadata.
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credential Issuance
     */
    public function getCredentialIssuerMetadata(): ?string
    {
        return $this->credentialIssuerMetadata;
    }

    /**
     * Set the credential issuer metadata.
     *
     * @param ?string $credentialIssuerMetadata
     *      The credential issuer metadata.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credential Issuance
     */
    public function setCredentialIssuerMetadata(?string $credentialIssuerMetadata): self
    {
        $this->credentialIssuerMetadata = $credentialIssuerMetadata;
        return $this;
    }

    /**
     * Get the default duration of credential offers in seconds.
     *
     * <p>
     * When an API call to the {``` /vci/offer/create```} API does not contain
     * the {```duration```} request parameter or the value of the parameter is
     * 0 or negative, the value of this property is used as the default value.
     * </p>
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used as the default value.
     * </p>
     *
     * @return int
     *      The credential offer duration.
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credential Issuance
     *
     * @see CredentialOfferCreateRequest::getDuration()
     */
    public function getCredentialOfferDuration(): int
    {
        return $this->credentialOfferDuration;
    }

    /**
     * Set the default duration of credential offers in seconds.
     *
     * <p>
     * When an API call to the {``` /vci/offer/create```} API does not contain
     * the {```duration```} request parameter or the value of the parameter is
     * 0 or negative, the value of this property is used as the default value.
     * </p>
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used as the default value.
     * </p>
     *
     * @param int $credentialOfferDuration
     *      The credential offer duration.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credential Issuance
     *
     * @see CredentialOfferCreateRequest::getDuration()
     */
    public function setCredentialOfferDuration(int $credentialOfferDuration): self
    {
        $this->credentialOfferDuration = $credentialOfferDuration;
        return $this;
    }

    /**
     * Get the default length of user PINs.
     *
     * <p>
     * When an API call to the {``` /vci/offer/create```} API does not contain
     * the {```userPinLength```} request parameter or the value of the parameter
     * is 0 or negative, the value of this property is used as the default value.
     * </p>
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used as the default value.
     * </p>
     *
     * <p>
     * NOTE: This property has been deprecated due to a breaking change of the
     * OID4VCI specification. The {``` /vci/offer/create```} API no longer
     * recognizes the {```userPinLength```} request parameter.
     * </p>
     *
     * @return int
     *      The user PIN length.
     *
     * @since Authlete 3.0
     *
     * @see CredentialOfferCreateRequest::getUserPinLength()
     *
     * @deprecated
     */
    public function getUserPinLength(): int
    {
        return $this->userPinLength;
    }

    /**
     * Set the default length of user PINs.
     *
     * <p>
     * When an API call to the {``` /vci/offer/create```} API does not contain
     * the {```userPinLength```} request parameter or the value of the parameter
     * is 0 or negative, the value of this property is used as the default value.
     * </p>
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used as the default value.
     * </p>
     *
     * <p>
     * NOTE: This property has been deprecated due to a breaking change of the
     * OID4VCI specification. The {``` /vci/offer/create```} API no longer
     * recognizes the {```userPinLength```} request parameter.
     * </p>
     *
     * @param int $userPinLength
     *      The user PIN length.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see CredentialOfferCreateRequest::getUserPinLength()
     *
     * @deprecated
     */
    public function setUserPinLength(int $userPinLength): self
    {
        $this->userPinLength = $userPinLength;
        return $this;
    }

    /**
     * Get the type of the {```aud```} claim in ID tokens.
     * Valid values are as follows.
     *
     * <blockquote>
     * <table border="1" cellpadding="5" style="border-collapse: collapse;">
     *   <tr bgcolor="orange">
     *     <th>Value</th>
     *     <th>Description</th>
     *   </tr>
     *   <tr>
     *     <td>{``` "array"```}</td>
     *     <td>The type of the {```aud```} claim is always an array of strings.</td>
     *   </tr>
     *   <tr>
     *     <td>{``` "string"```}</td>
     *     <td>The type of the {```aud```} claim is always a single string.</td>
     *   </tr>
     *   <tr>
     *     <td>null</td>
     *     <td>The type of the {```aud```} claim remains the same as before.</td>
     *   </tr>
     * </table>
     * </blockquote>
     *
     * <p>
     * Authlete APIs that may trigger ID token issuance may accept the
     * {```idTokenAudType```} request parameter (e.g.
     * {@link AuthorizationIssueRequest::getIdTokenAudType()}). Such request
     * parameters take precedence over this service property.
     * </p>
     *
     * @return ?string
     *      The ID token audience type.
     *
     * @since Authlete 2.3.3
     */
    public function getIdTokenAudType(): ?string
    {
        return $this->idTokenAudType;
    }

    /**
     * Set the type of the {```aud```} claim in ID tokens.
     * Valid values are as follows.
     *
     * <blockquote>
     * <table border="1" cellpadding="5" style="border-collapse: collapse;">
     *   <tr bgcolor="orange">
     *     <th>Value</th>
     *     <th>Description</th>
     *   </tr>
     *   <tr>
     *     <td>{``` "array"```}</td>
     *     <td>The type of the {```aud```} claim is always an array of strings.</td>
     *   </tr>
     *   <tr>
     *     <td>{``` "string"```}</td>
     *     <td>The type of the {```aud```} claim is always a single string.</td>
     *   </tr>
     *   <tr>
     *     <td>null</td>
     *     <td>The type of the {```aud```} claim remains the same as before.</td>
     *   </tr>
     * </table>
     * </blockquote>
     *
     * <p>
     * Authlete APIs that may trigger ID token issuance may accept the
     * {```idTokenAudType```} request parameter (e.g.
     * {@link AuthorizationIssueRequest::getIdTokenAudType()}). Such request
     * parameters take precedence over this service property.
     * </p>
     *
     * @param ?string $idTokenAudType
     *      The ID token audience type.
     *
     * @return self
     *
     * @since Authlete 2.3.3
     */
    public function setIdTokenAudType(?string $idTokenAudType): self
    {
        $this->idTokenAudType = $idTokenAudType;
        return $this;
    }

    /**
     * Get the supported {```prompt```} values.
     *
     * @return array The supported prompt values.
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-connect-prompt-create-1_0.html Initiating User Registration via OpenID Connect 1.0
     *
     */
    public function getSupportedPromptValues(): array
    {
        return $this->supportedPromptValues;
    }

    /**
     * Set the supported {```prompt```} values.
     *
     * @param array $supportedPromptValues
     *      The supported prompt values.

     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-connect-prompt-create-1_0.html Initiating User Registration via OpenID Connect 1.0
     */
    public function setSupportedPromptValues(array $supportedPromptValues): self
    {
        $this->supportedPromptValues = $supportedPromptValues;
        return $this;
    }

    /**
     * Get the name of the validation schema set that is used to validate the
     * content of {@code "verified_claims"}.
     *
     * <p>
     * Since version 2.3, Authlete validates the content of
     * {@code "verified_claims"} based on the JSON schema files that accompany
     * the specification (<a href=
     * "https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html"
     * >OpenID Connect for Identity Assurance 1.0</a>). They are found in the
     * <code><a href="https://bitbucket.org/openid/ekyc-ida/src/master/schema/"
     * >/schema/</a></code> folder of the Git repository of the specification.
     * </p>
     *
     * <p>
     * Usually, Authlete uses the legitimate JSON schema files that conform to
     * the specification. But, it is possible to make Authlete use a different
     * set of JSON schema files by specifying a name of validation schema set
     * through this property ({@code Service.verifiedClaimsValidationSchemaSet}).
     * </p>
     *
     * <p>
     * Authlete recognizes the following names of validation schema set at least.
     * </p>
     *
     *  <blockquote>
     *  <table border="1" cellpadding="5" style="border-collapse: collapse;">
     *    <tr bgcolor="orange">
     *       <th>name</th>
     *       <th>description</th>
     *    </tr>
     *    <tr>
     *       <td>null</td>
     *       <td>Same as <code>standard</code>.</td>
     *     </tr>
     *     <tr>
     *       <td><code>standard</code></td>
     *       <td>The set of the legitimate JSON schema files.</td>
     *     </tr>
     *     <tr>
     *       <td><code>standard+id_document</code></td>
     *       <td>
     *         A set of customized JSON schema files that mostly conform to the
     *         standard but additionally accept <code>id_document</code> as a valid
     *         name of <code>evidence</code>. This is for backward compatibility. Note
     *         that <code>id_document</code> was deprecated by Implementer's Draft 4
     *         (cf. <a href="https://bitbucket.org/openid/ekyc-ida/pull-requests/152">eKYC-IDA PR 152</a>).
     *       </td>
     *     </tr>
     *   </table>
     *  </blockquote>
     *
     * @return ?string The verified claims validation schema set.
     *
     * @since Authlete 2.3.4
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @see https://bitbucket.org/openid/ekyc-ida/pull-requests/152 eKYC-IDA PR 152: removal of deprecated items - issue 1334
     */
    public function getVerifiedClaimsValidationSchemaSet(): ?string
    {
        return $this->verifiedClaimsValidationSchemaSet;
    }

    /**
     * Set the name of the validation schema set that is used to validate the
     * content of {@code "verified_claims"}.
     *
     * <p>
     * Since version 2.3, Authlete validates the content of
     * {@code "verified_claims"} based on the JSON schema files that accompany
     * the specification (<a href=
     * "https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html"
     * >OpenID Connect for Identity Assurance 1.0</a>). They are found in the
     * <code><a href="https://bitbucket.org/openid/ekyc-ida/src/master/schema/"
     * >/schema/</a></code> folder of the Git repository of the specification.
     * </p>
     *
     * <p>
     * Usually, Authlete uses the legitimate JSON schema files that conform to
     * the specification. But, it is possible to make Authlete use a different
     * set of JSON schema files by specifying a name of validation schema set
     * through this property ({@code Service.verifiedClaimsValidationSchemaSet}).
     * </p>
     *
     * <p>
     * Authlete recognizes the following names of validation schema set at least.
     * </p>
     *
     *  <blockquote>
     *  <table border="1" cellpadding="5" style="border-collapse: collapse;">
     *    <tr bgcolor="orange">
     *       <th>name</th>
     *       <th>description</th>
     *    </tr>
     *    <tr>
     *       <td>null</td>
     *       <td>Same as <code>standard</code>.</td>
     *     </tr>
     *     <tr>
     *       <td><code>standard</code></td>
     *       <td>The set of the legitimate JSON schema files.</td>
     *     </tr>
     *     <tr>
     *       <td><code>standard+id_document</code></td>
     *       <td>
     *         A set of customized JSON schema files that mostly conform to the
     *         standard but additionally accept <code>id_document</code> as a valid
     *         name of <code>evidence</code>. This is for backward compatibility. Note
     *         that <code>id_document</code> was deprecated by Implementer's Draft 4
     *         (cf. <a href="https://bitbucket.org/openid/ekyc-ida/pull-requests/152">eKYC-IDA PR 152</a>).
     *       </td>
     *     </tr>
     *   </table>
     *  </blockquote>
     *
     * @param ?string $verifiedClaimsValidationSchemaSet
     *      The verified claims validation schema set.
     *
     * @return self
     *
     * @since Authlete 2.3.4
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @see https://bitbucket.org/openid/ekyc-ida/pull-requests/152 eKYC-IDA PR 152: removal of deprecated items - issue 1334
     */
    public function setVerifiedClaimsValidationSchemaSet(?string $verifiedClaimsValidationSchemaSet): self
    {
        $this->verifiedClaimsValidationSchemaSet = $verifiedClaimsValidationSchemaSet;
        return $this;
    }

    /**
     * Get the flag indicating whether token requests using the pre-authorized
     * code grant flow by unidentifiable clients are allowed.
     *
     * <p>
     * This property corresponds to the
     * {```pre-authorized_grant_anonymous_access_supported```} server metadata
     * defined in
     * OpenID for Verifiable Credentials Issuance: https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html.
     * </p>
     *
     * @return bool
     *      True if pre-authorized grant anonymous access is supported, false otherwise.
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credentials Issuance
     */
    public function isPreAuthorizedGrantAnonymousAccessSupported(): bool
    {
        return $this->preAuthorizedGrantAnonymousAccessSupported;
    }

    /**
     * Set the flag indicating whether token requests using the pre-authorized
     * code grant flow by unidentifiable clients are allowed.
     *
     * <p>
     * This property corresponds to the
     * {```pre-authorized_grant_anonymous_access_supported```} server metadata
     * defined in
     * OpenID for Verifiable Credentials Issuance: https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html.
     * </p>
     *
     * @param bool $preAuthorizedGrantAnonymousAccessSupported
     *      The pre-authorized grant anonymous access supported status.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credentials Issuance
     */
    public function setPreAuthorizedGrantAnonymousAccessSupported(bool $preAuthorizedGrantAnonymousAccessSupported): self
    {
        $this->preAuthorizedGrantAnonymousAccessSupported = $preAuthorizedGrantAnonymousAccessSupported;
        return $this;
    }

    /**
     * Get the duration of {```c_nonce```} in seconds.
     *
     * <p>
     * {```c_nonce```} is issued from the token endpoint of an authorization
     * server in the pre-authorized code flow, and from the credential endpoint
     * and the batch credential endpoint of a credential issuer. This property
     * is used as the lifetime of the {```c_nonce```}.
     * </p>
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used as the default value.
     * </p>
     *
     * <p>
     * OpenID for Verifiable Credentials Issuance</a> for details about:
     * https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html
     * {```c_nonce``}.
     * </p>
     *
     *
     * @return int The CNonce duration.
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credentials Issuance
     */
    public function getCnonceDuration(): int
    {
        return $this->cnonceDuration;
    }

    /**
     * Set the duration of {```c_nonce```} in seconds.
     *
     * <p>
     * {```c_nonce```} is issued from the token endpoint of an authorization
     * server in the pre-authorized code flow, and from the credential endpoint
     * and the batch credential endpoint of a credential issuer. This property
     * is used as the lifetime of the {```c_nonce```}.
     * </p>
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used as the default value.
     * </p>
     *
     * <p>
     * OpenID for Verifiable Credentials Issuance</a> for details about:
     * https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html
     * {```c_nonce``}.
     * </p>
     *
     * @param int $cnonceDuration
     *      The CNonce duration.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-4-verifiable-credential-issuance-1_0.html OpenID for Verifiable Credentials Issuance
     */
    public function setCnonceDuration(int $cnonceDuration): self
    {
        $this->cnonceDuration = $cnonceDuration;
        return $this;
    }

    /**
     * Get the duration of transaction ID in seconds that may be issued as a
     * result of a credential request or a batch credential request.
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used.
     * </p>
     *
     * @return int
     *      The credential transaction duration.
     *
     * @since Authlete 3.0
     */
    public function getCredentialTransactionDuration(): int
    {
        return $this->credentialTransactionDuration;
    }

    /**
     * Set the duration of transaction ID in seconds that may be issued as a
     * result of a credential request or a batch credential request.
     *
     * <p>
     * If the value of this property is 0 or negative, the default value per
     * Authlete server is used.
     * </p>
     *
     * @param int $credentialTransactionDuration
     *      The credential transaction duration.
     *
     * @return self
     */
    public function setCredentialTransactionDuration(int $credentialTransactionDuration): self
    {
        $this->credentialTransactionDuration = $credentialTransactionDuration;
        return $this;
    }

    /**
     * Get the default duration of verifiable credentials in seconds.
     *
     * <p>
     * Some Authlete APIs such as the {``` /vci/single/issue```} API and the
     * {``` /vci/batch/issue```} API may issue one or more verifiable
     * credentials. The value of this property specifies the default duration
     * of such verifiable credentials.
     * </p>
     *
     * <p>
     * The value 0 indicates that verifiable credentials will not expire.
     * In the case, verifiable credentials will not have a property that
     * indicates the expiration time. For example, JWT-based verifiable
     * credentials will not contain the "{```exp```}" claim (
     * RFC 7519: https://www.rfc-editor.org/rfc/rfc7519.html,
     * Section 4.1.4 :https://www.rfc-editor.org/rfc/rfc7519.html#section-4.1.4).
     * </p>
     *
     * <p>
     * Authlete APIs that may issue verifiable credentials recognize a request
     * parameter that can override the duration. For example, a request to the
     * {``` /vci/single/issue```} API ({@link CredentialSingleIssueRequest})
     * contains an "{```order```}" object ({@link CredentialIssuanceOrder})
     * that has a "{```credentialDuration```}" parameter
     * ({@link CredentialIssuanceOrder::getCredentialDuration() credentialDuration})
     * that can override the default duration.
     * </p>
     *
     * @return int
     *      The credential duration.
     *
     * @since Authlete 3.0
     */
    public function getCredentialDuration(): int
    {
        return $this->credentialDuration;
    }

    /**
     * Set the default duration of verifiable credentials in seconds.
     *
     * <p>
     * Some Authlete APIs such as the {``` /vci/single/issue```} API and the
     * {``` /vci/batch/issue```} API may issue one or more verifiable
     * credentials. The value of this property specifies the default duration
     * of such verifiable credentials.
     * </p>
     *
     * <p>
     * The value 0 indicates that verifiable credentials will not expire.
     * In the case, verifiable credentials will not have a property that
     * indicates the expiration time. For example, JWT-based verifiable
     * credentials will not contain the "{```exp```}" claim (
     * RFC 7519: https://www.rfc-editor.org/rfc/rfc7519.html,
     * Section 4.1.4 :https://www.rfc-editor.org/rfc/rfc7519.html#section-4.1.4).
     * </p>
     *
     * <p>
     * Authlete APIs that may issue verifiable credentials recognize a request
     * parameter that can override the duration. For example, a request to the
     * {``` /vci/single/issue```} API ({@link CredentialSingleIssueRequest})
     * contains an "{```order```}" object ({@link CredentialIssuanceOrder})
     * that has a "{```credentialDuration```}" parameter
     * ({@link CredentialIssuanceOrder::getCredentialDuration() credentialDuration})
     * that can override the default duration.
     * </p>
     *
     * @param int $credentialDuration
     *      The credential duration.
     *
     * @return self
     *
     * @since Authlete 3.0
     */
    public function setCredentialDuration(int $credentialDuration): self
    {
        $this->credentialDuration = $credentialDuration;
        return $this;
    }

    /**
     * Get the JWK Set document containing private keys that are used to sign
     * verifiable credentials.
     *
     * <p>
     * Some Authlete APIs such as the {``` /vci/single/issue```} API and the
     * {``` /vci/batch/issue```} API may issue one or more verifiable
     * credentials. The content of this property is referred to by such APIs.
     * </p>
     *
     * <p>
     * Authlete APIs that may issue verifiable credentials recognize a request
     * parameter that can specify the key ID of a private key that should be
     * used for signing. For example, a request to the {``` /vci/single/issue```}
     * API ({@link CredentialSingleIssueRequest}) contains an "{```order```}"
     * object ({@link CredentialIssuanceOrder}) that has a "{```signingKeyId```}"
     * parameter ({@link CredentialIssuanceOrder#getSigningKeyId() signingKeyId})
     * that can specify the key ID of a private key to be used for signing.
     * When a key ID is not specified, Authlete will select a private key
     * automatically.
     * </p>
     *
     * <p>
     * If JWKs in the JWK Set do not contain the "{```kid```}" property (
     * RFC 7517: https://www.rfc-editor.org/rfc/rfc7517.html,
     * Section 4.5: https://www.rfc-editor.org/rfc/rfc7517.html#section-4.5)
     * when this {```credentialJwks```} property is updated, Authlete will
     * automatically insert the "{```kid```}" property into such JWKs. The JWK
     * thumbprint (RFC 7638: https://www.rfc-editor.org/rfc/rfc7638.html)
     * computed with the SHA-256 hash algorithm is used as the value
     * of the "{```kid```}" property.
     * </p>
     *
     * @return ?string
     *      The credential JWKS.
     *
     * @since Authlete 3.0
     */
    public function getCredentialJwks(): ?string
    {
        return $this->credentialJwks;
    }

    /**
     * Set the JWK Set document containing private keys that are used to sign
     * verifiable credentials.
     *
     * <p>
     * Some Authlete APIs such as the {``` /vci/single/issue```} API and the
     * {``` /vci/batch/issue```} API may issue one or more verifiable
     * credentials. The content of this property is referred to by such APIs.
     * </p>
     *
     * <p>
     * Authlete APIs that may issue verifiable credentials recognize a request
     * parameter that can specify the key ID of a private key that should be
     * used for signing. For example, a request to the {``` /vci/single/issue```}
     * API ({@link CredentialSingleIssueRequest}) contains an "{```order```}"
     * object ({@link CredentialIssuanceOrder}) that has a "{```signingKeyId```}"
     * parameter ({@link CredentialIssuanceOrder#getSigningKeyId() signingKeyId})
     * that can specify the key ID of a private key to be used for signing.
     * When a key ID is not specified, Authlete will select a private key
     * automatically.
     * </p>
     *
     * <p>
     * If JWKs in the JWK Set do not contain the "{```kid```}" property (
     * RFC 7517: https://www.rfc-editor.org/rfc/rfc7517.html,
     * Section 4.5: https://www.rfc-editor.org/rfc/rfc7517.html#section-4.5)
     * when this {```credentialJwks```} property is updated, Authlete will
     * automatically insert the "{```kid```}" property into such JWKs. The JWK
     * thumbprint (RFC 7638: https://www.rfc-editor.org/rfc/rfc7638.html)
     * computed with the SHA-256 hash algorithm is used as the value
     * of the "{```kid```}" property.
     * </p>
     *
     * @param ?string $credentialJwks
     *      The credential JWKS.
     *
     * @return self
     *
     * @since Authlete 3.0
     */
    public function setCredentialJwks(?string $credentialJwks): self
    {
        $this->credentialJwks = $credentialJwks;
        return $this;
    }

    /**
     * Get the URL at which the JWK Set document of the credential issuer is
     * exposed.
     * <p>
     * The value of this property is referenced when Authlete's
     * {``` /vci/jwtissuer```} API generates the JSON representing the JWT
     * issuer metadata. The JSON will be generated like below.
     * </p>
     *
     * <blockquote>
     *  <pre>
     * {
     * *     "issuer": "Service::getCredentialIssuerMetadata().CredentialIssuerMetadata::getCredentialIssuer()",
     * *     "jwks_uri": "Service::getCredentialJwksUri()"
     * * }
     *  </pre>
     *  </blockquote>
     *
     * @return ?string The credential JWKS URI.
     *
     * @since Authlete 3.0
     *
     * @see Service::getCredentialIssuerMetadata()
     * @see CredentialIssuerMetadata::getCredentialIssuer()
     * @see Service::getCredentialJwksUri()
     */
    public function getCredentialJwksUri(): ?string
    {
        return $this->credentialJwksUri;
    }

    /**
     * Set the URL at which the JWK Set document of the credential issuer is
     * exposed.
     * <p>
     * The value of this property is referenced when Authlete's
     * {``` /vci/jwtissuer```} API generates the JSON representing the JWT
     * issuer metadata. The JSON will be generated like below.
     * </p>
     *
     * <blockquote>
     *  <pre>
     * {
     *     "issuer": "Service::getCredentialIssuerMetadata().CredentialIssuerMetadata::getCredentialIssuer()",
     *     "jwks_uri": "Service::getCredentialJwksUri()"
     * }
     *  </pre>
     * </blockquote>
     *
     * @param ?string $credentialJwksUri
     *      The credential JWKS URI.
     *
     * @return self
     *
     * @since Authlete 3.0
     */
    public function setCredentialJwksUri(?string $credentialJwksUri): self
    {
        $this->credentialJwksUri = $credentialJwksUri;
        return $this;
    }

    /**
     * Get the flag indicating whether to enable the feature of ID token
     * reissuance in the refresh token flow.
     *
     * <p>
     * If this property is {```true```}, the {```action```} response parameter
     * in a response from the {``` /auth/token```} API becomes
     * {@link TokenResponse.Action#ID_TOKEN_REISSUABLE ID_TOKEN_REISSUABLE}
     * when the following conditions are met.
     * </p>
     *
     * <ol>
     * <li>The flow of the token request is the refresh token flow.
     * <li>The scope set after processing the token request still contains the
     *     "{```openid```}" scope.
     * <li>The access token is associated with the subject of a user.
     * <li>The access token is associated with a client application.
     * </ol>
     *
     * <p>
     * See the description of the {@link TokenResponse} class for details.
     * </p>
     *
     * @return bool
     *      True if ID token is reissuable, false otherwise.
     *
     * @since Authlete 3.0
     *
     * @see TokenResponse
     */
    public function isIdTokenReissuable(): bool
    {
        return $this->idTokenReissuable;
    }

    /**
     * Get the flag indicating whether to enable the feature of ID token
     * reissuance in the refresh token flow.
     *
     * <p>
     * If this property is {```true```}, the {```action```} response parameter
     * in a response from the {``` /auth/token```} API becomes
     * {@link TokenResponse.Action#ID_TOKEN_REISSUABLE ID_TOKEN_REISSUABLE}
     * when the following conditions are met.
     * </p>
     *
     * <ol>
     * <li>The flow of the token request is the refresh token flow.
     * <li>The scope set after processing the token request still contains the
     *     "{```openid```}" scope.
     * <li>The access token is associated with the subject of a user.
     * <li>The access token is associated with a client application.
     * </ol>
     *
     * <p>
     * See the description of the {@link TokenResponse} class for details.
     * </p>
     *
     * @param bool $idTokenReissuable
     *      The ID token reissuable status.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see TokenResponse
     */
    public function setIdTokenReissuable(bool $idTokenReissuable): self
    {
        $this->idTokenReissuable = $idTokenReissuable;
        return $this;
    }

    /**
     * Get the key ID of the key for signing introspection responses.
     *
     * @return ?string
     *      The introspection signature key ID.
     *
     * @since Authlete 3.0
     *
     * @see https://datatracker.ietf.org/doc/html/draft-ietf-oauth-jwt-introspection-response JWT Response for OAuth Token Introspection
     */
    public function getIntrospectionSignatureKeyId(): ?string
    {
        return $this->introspectionSignatureKeyId;
    }

    /**
     * Get the key ID of the key for signing introspection responses.
     *
     * @param ?string $introspectionSignatureKeyId
     *      The introspection signature key ID.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://datatracker.ietf.org/doc/html/draft-ietf-oauth-jwt-introspection-response JWT Response for OAuth Token Introspection
     */
    public function setIntrospectionSignatureKeyId(?string $introspectionSignatureKeyId): self
    {
        $this->introspectionSignatureKeyId = $introspectionSignatureKeyId;
        return $this;
    }

    /**
     * Get the FAPI modes for this service.
     *
     * <p>
     * When the value of this property is not {@code null}, Authlete always processes
     * requests to this service based on the specified FAPI modes if the FAPI
     * feature is enabled in Authlete and the {@link ServiceProfile#FAPI FAPI}
     * profile is supported by this service.
     * </p>
     * <p>
     * For instance, when this property is set to an array containing {@link
     * FapiMode#FAPI1_ADVANCED FAPI1_ADVANCED} only, Authlete always processes
     * requests to this service based on "<a href="https://openid.net/specs/openid-financial-api-part-2-1_0.html">
     * Financial-grade API Security Profile 1.0 - Part 2: Advanced</a>" if the
     * FAPI feature is enabled in Authlete and the {@link ServiceProfile#FAPI FAPI}
     * profile is supported by this service.
     * </p>
     *
     * @return array
     *      The FAPI modes.
     *
     * @since Authlete 3.0
     *
     * @see https://openid.net/specs/openid-financial-api-part-2-1_0.html Financial-grade API Security Profile 1.0 - Part 2: Advanced
     */
    public function getFapiModes(): array
    {
        return $this->fapiModes;
    }

    /**
     * Set the FAPI modes for this service.
     *
     * <p>
     * When the value of this property is not {@code null}, Authlete always processes
     * requests to this service based on the specified FAPI modes if the FAPI
     * feature is enabled in Authlete and the {@link ServiceProfile#FAPI FAPI}
     * profile is supported by this service.
     * </p>
     * <p>
     * For instance, when this property is set to an array containing {@link
     * FapiMode#FAPI1_ADVANCED FAPI1_ADVANCED} only, Authlete always processes
     * requests to this service based on "<a href="https://openid.net/specs/openid-financial-api-part-2-1_0.html">
     * Financial-grade API Security Profile 1.0 - Part 2: Advanced</a>" if the
     * FAPI feature is enabled in Authlete and the {@link ServiceProfile#FAPI FAPI}
     * profile is supported by this service.
     * </p>
     *
     * @param array $fapiModes
     *      The FAPI modes.
     *
     * @return self
     *
     * @see https://openid.net/specs/openid-financial-api-part-2-1_0.html Financial-grade API Security Profile 1.0 - Part 2: Advanced
     */
    public function setFapiModes(array $fapiModes): self
    {
        $this->fapiModes = $fapiModes;
        return $this;
    }

    /**
     * Get the flag indicating whether to require DPoP proof JWTs to include
     * the {```nonce```} claim whenever they are presented.
     *
     * <p>
     * DPoP-aware Authlete APIs such as the {``` /auth/introspection```} API and
     * the {``` /auth/token```} API recognize the {```dpopNonceRequired```}
     * request parameter, which enables API callers to require DPoP proof JWTs
     * to include the {```nonce```} claim at runtime, even if this service
     * property is false.
     * </p>
     *
     * @return bool
     *      True if DPoP nonce is required, false otherwise.
     *
     * @since Authlete 3.0
     *
     * @see https://www.rfc-editor.org/rfc/rfc9449.html" RFC 9449 OAuth 2.0 Demonstrating Proof of Possession (DPoP)
     */
    public function isDpopNonceRequired(): bool
    {
        return $this->dpopNonceRequired;
    }

    /**
     * Set the flag indicating whether to require DPoP proof JWTs to include
     * the {```nonce```} claim whenever they are presented.
     *
     * <p>
     * DPoP-aware Authlete APIs such as the {``` /auth/introspection```} API and
     * the {``` /auth/token```} API recognize the {```dpopNonceRequired```}
     * request parameter, which enables API callers to require DPoP proof JWTs
     * to include the {```nonce```} claim at runtime, even if this service
     * property is false.
     * </p>
     *
     * @param bool $dpopNonceRequired
     *      The DPoP nonce required status.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://www.rfc-editor.org/rfc/rfc9449.html" RFC 9449 OAuth 2.0 Demonstrating Proof of Possession (DPoP)
     */
    public function setDpopNonceRequired(bool $dpopNonceRequired): self
    {
        $this->dpopNonceRequired = $dpopNonceRequired;
        return $this;
    }

    /**
     * Get the duration of nonce values for DPoP proof JWTs in seconds.
     *
     * @return int
     *      The DPoP nonce duration.
     *
     * @since Authlete 3.0
     *
     * @see https://www.rfc-editor.org/rfc/rfc9449.html RFC 9449 OAuth 2.0 Demonstrating Proof of Possession (DPoP)
     */
    public function getDpopNonceDuration(): int
    {
        return $this->dpopNonceDuration;
    }

    /**
     * Set the duration of nonce values for DPoP proof JWTs in seconds.
     *
     * @param int $dpopNonceDuration
     *      The DPoP nonce duration.
     *
     * @return self
     *
     * @since Authlete 3.0
     *
     * @see https://www.rfc-editor.org/rfc/rfc9449.html RFC 9449 OAuth 2.0 Demonstrating Proof of Possession (DPoP)
     */
    public function setDpopNonceDuration(int $dpopNonceDuration): self
    {
        $this->dpopNonceDuration = $dpopNonceDuration;
        return $this;
    }

    /**
     * Get the URI of the endpoint that receives token batch results.
     *
     * @return ?string
     *      The token batch notification endpoint.
     *
     * @since Authlete 3.0
     */
    public function getTokenBatchNotificationEndpoint(): ?string
    {
        return $this->tokenBatchNotificationEndpoint;
    }

    /**
     * Set the URI of the endpoint that receives token batch results.
     *
     * @param ?string $tokenBatchNotificationEndpoint
     *      The token batch notification endpoint.
     *
     * @return self
     *
     * @since Authlete 3.0
     */
    public function setTokenBatchNotificationEndpoint(?string $tokenBatchNotificationEndpoint): self
    {
        $this->tokenBatchNotificationEndpoint = $tokenBatchNotificationEndpoint;
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
        $array['serviceName'] = $this->serviceName;
        $array['apiKey'] = $this->apiKey;
        $array['apiSecret'] = $this->apiSecret;
        $array['issuer'] = $this->issuer;
        $array['authorizationEndpoint'] = $this->authorizationEndpoint;
        $array['tokenEndpoint'] = $this->tokenEndpoint;
        $array['revocationEndpoint'] = $this->revocationEndpoint;
        $array['supportedRevocationAuthMethods'] = LanguageUtility::convertArrayToStringArray($this->supportedRevocationAuthMethods);
        $array['userInfoEndpoint'] = $this->userInfoEndpoint;
        $array['jwksUri'] = $this->jwksUri;
        $array['jwks'] = $this->jwks;
        $array['registrationEndpoint'] = $this->registrationEndpoint;
        $array['registrationManagementEndpoint'] = $this->registrationManagementEndpoint;
        $array['supportedScopes'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->supportedScopes);
        $array['supportedResponseTypes'] = LanguageUtility::convertArrayToStringArray($this->supportedResponseTypes);
        $array['supportedGrantTypes'] = LanguageUtility::convertArrayToStringArray($this->supportedGrantTypes);
        $array['supportedAcrs'] = $this->supportedAcrs;
        $array['supportedTokenAuthMethods'] = LanguageUtility::convertArrayToStringArray($this->supportedTokenAuthMethods);
        $array['supportedDisplays'] = LanguageUtility::convertArrayToStringArray($this->supportedDisplays);
        $array['supportedClaimTypes'] = LanguageUtility::convertArrayToStringArray($this->supportedClaimTypes);
        $array['supportedClaims'] = $this->supportedClaims;
        $array['serviceDocumentation'] = $this->serviceDocumentation;
        $array['supportedClaimLocales'] = $this->supportedClaimLocales;
        $array['supportedUiLocales'] = $this->supportedUiLocales;
        $array['policyUri'] = $this->policyUri;
        $array['tosUri'] = $this->tosUri;
        $array['authenticationCallbackEndpoint'] = $this->authenticationCallbackEndpoint;
        $array['authenticationCallbackApiKey'] = $this->authenticationCallbackApiKey;
        $array['authenticationCallbackApiSecret'] = $this->authenticationCallbackApiSecret;
        $array['supportedSnses'] = LanguageUtility::convertArrayToStringArray($this->supportedSnses);
        $array['snsCredentials'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->snsCredentials);
        $array['createdAt'] = LanguageUtility::orZero($this->createdAt);
        $array['modifiedAt'] = LanguageUtility::orZero($this->modifiedAt);
        $array['developerAuthenticationCallbackEndpoint'] = $this->developerAuthenticationCallbackEndpoint;
        $array['developerAuthenticationCallbackApiKey'] = $this->developerAuthenticationCallbackApiKey;
        $array['developerAuthenticationCallbackApiSecret'] = $this->developerAuthenticationCallbackApiSecret;
        $array['supportedDeveloperSnses'] = LanguageUtility::convertArrayToStringArray($this->supportedDeveloperSnses);
        $array['developerSnsCredentials'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->developerSnsCredentials);
        $array['clientsPerDeveloper'] = $this->clientsPerDeveloper;
        $array['directAuthorizationEndpointEnabled'] = $this->directAuthorizationEndpointEnabled;
        $array['directTokenEndpointEnabled'] = $this->directTokenEndpointEnabled;
        $array['directRevocationEndpointEnabled'] = $this->directRevocationEndpointEnabled;
        $array['directUserInfoEndpointEnabled'] = $this->directUserInfoEndpointEnabled;
        $array['directJwksEndpointEnabled'] = $this->directJwksEndpointEnabled;
        $array['directIntrospectionEndpointEnabled'] = $this->directIntrospectionEndpointEnabled;
        $array['singleAccessTokenPerSubject'] = $this->singleAccessTokenPerSubject;
        $array['pkceRequired'] = $this->pkceRequired;
        $array['pkceS256Required'] = $this->pkceS256Required;
        $array['refreshTokenKept'] = $this->refreshTokenKept;
        $array['refreshTokenDurationKept'] = $this->refreshTokenDurationKept;
        $array['errorDescriptionOmitted'] = $this->errorDescriptionOmitted;
        $array['errorUriOmitted'] = $this->errorUriOmitted;
        $array['clientIdAliasEnabled'] = $this->clientIdAliasEnabled;
        $array['supportedServiceProfiles'] = LanguageUtility::convertArrayToStringArray($this->supportedServiceProfiles);
        $array['tlsClientCertificateBoundAccessTokens'] = $this->tlsClientCertificateBoundAccessTokens;
        $array['introspectionEndpoint'] = $this->introspectionEndpoint;
        $array['supportedIntrospectionAuthMethods'] = LanguageUtility::convertArrayToStringArray($this->supportedIntrospectionAuthMethods);
        $array['mutualTlsValidatePkiCertChain'] = $this->mutualTlsValidatePkiCertChain;
        $array['trustedRootCertificates'] = $this->trustedRootCertificates;
        $array['dynamicRegistrationSupported'] = $this->dynamicRegistrationSupported;
        $array['endSessionEndpoint'] = $this->endSessionEndpoint;
        $array['description'] = $this->description;
        $array['accessTokenType'] = $this->accessTokenType;
        $array['accessTokenSignAlg'] = LanguageUtility::toString($this->accessTokenSignAlg);
        $array['accessTokenDuration'] = $this->accessTokenDuration;
        $array['refreshTokenDuration'] = $this->refreshTokenDuration;
        $array['idTokenDuration'] = $this->idTokenDuration;
        $array['authorizationResponseDuration'] = $this->authorizationResponseDuration;
        $array['pushedAuthReqDuration'] = $this->pushedAuthReqDuration;
        $array['accessTokenSignatureKeyId'] = $this->accessTokenSignatureKeyId;
        $array['authorizationSignatureKeyId'] = $this->authorizationSignatureKeyId;
        $array['idTokenSignatureKeyId'] = $this->idTokenSignatureKeyId;
        $array['userInfoSignatureKeyId'] = $this->userInfoSignatureKeyId;
        $array['supportedBackchannelTokenDeliveryModes'] = LanguageUtility::convertArrayToStringArray($this->supportedBackchannelTokenDeliveryModes);
        $array['backchannelAuthenticationEndpoint'] = $this->backchannelAuthenticationEndpoint;
        $array['backchannelUserCodeParameterSupported'] = $this->backchannelUserCodeParameterSupported;
        $array['backchannelAuthReqIdDuration'] = $this->backchannelAuthReqIdDuration;
        $array['backchannelPollingInterval'] = $this->backchannelPollingInterval;
        $array['backchannelBindingMessageRequiredInFapi'] = $this->backchannelBindingMessageRequiredInFapi;
        $array['allowableClockSkew'] = $this->allowableClockSkew;
        $array['deviceAuthorizationEndpoint'] = $this->deviceAuthorizationEndpoint;
        $array['deviceVerificationUri'] = $this->deviceVerificationUri;
        $array['deviceVerificationUriComplete'] = $this->deviceVerificationUriComplete;
        $array['deviceFlowCodeDuration'] = $this->deviceFlowCodeDuration;
        $array['deviceFlowPollingInterval'] = $this->deviceFlowPollingInterval;
        $array['userCodeCharset'] = LanguageUtility::toString($this->userCodeCharset);
        $array['userCodeLength'] = $this->userCodeLength;
        $array['pushedAuthReqEndpoint'] = $this->pushedAuthReqEndpoint;
        $array['mtlsEndpointAliases'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->mtlsEndpointAliases);
        $array['supportedAuthorizationDataTypes'] = $this->supportedAuthorizationDataTypes;
        $array['supportedTrustFrameworks'] = $this->supportedTrustFrameworks;
        $array['supportedEvidence'] = $this->supportedEvidence;
        $array['supportedIdentityDocuments'] = $this->supportedIdentityDocuments;
        $array['supportedVerificationMethods'] = $this->supportedVerificationMethods;
        $array['supportedVerifiedClaims'] = $this->supportedVerifiedClaims;
        $array['missingClientIdAllowed'] = $this->missingClientIdAllowed;
        $array['parRequired'] = $this->parRequired;
        $array['requestObjectRequired'] = $this->requestObjectRequired;
        $array['traditionalRequestObjectProcessingApplied'] = $this->traditionalRequestObjectProcessingApplied;
        $array['claimShortcutRestrictive'] = $this->claimShortcutRestrictive;
        $array['scopeRequired'] = $this->scopeRequired;
        $array['nbfOptional'] = $this->nbfOptional;
        $array['issSuppressed'] = $this->issSuppressed;
        $array['supportedCustomClientMetadata'] = $this->supportedCustomClientMetadata;
        $array['tokenExpirationLinked'] = $this->tokenExpirationLinked;
        $array['frontChannelRequestObjectEncryptionRequired'] = $this->frontChannelRequestObjectEncryptionRequired;
        $array['requestObjectEncryptionAlgMatchRequired'] = $this->requestObjectEncryptionAlgMatchRequired;
        $array['hsmEnabled'] = $this->hsmEnabled;
        $array['hsks'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->hsks);
        $array['grantManagementEndpoint'] = $this->grantManagementEndpoint;
        $array['grantManagementActionRequired'] = $this->grantManagementActionRequired;
        $array['unauthorizedOnClientConfigSupported'] = $this->unauthorizedOnClientConfigSupported;
        $array['dcrScopeUsedAsRequestable'] = $this->dcrScopeUsedAsRequestable;
        $array['predefinedTransformedClaims'] = $this->predefinedTransformedClaims;
        $array['loopbackRedirectionUriVariable'] = $this->loopbackRedirectionUriVariable;
        $array['requestObjectAudienceChecked'] = $this->requestObjectAudienceChecked;
        $array['accessTokenForExternalAttachmentEmbedded'] = $this->accessTokenForExternalAttachmentEmbedded;
        $array['refreshTokenIdempotent'] = $this->refreshTokenIdempotent;
        $array['federationEnabled'] = $this->federationEnabled;
        $array['organizationName'] = $this->organizationName;
        $array['authorityHints'] = $this->authorityHints;
        $array['trustAnchors'] = LanguageUtility::convertArrayToStringArray($this->trustAnchors);
        $array['federationJwks'] = $this->federationJwks;
        $array['federationSignatureKeyId'] = $this->federationSignatureKeyId;
        $array['federationConfigurationDuration'] = $this->federationConfigurationDuration;
        $array['signedJwksUri'] = $this->signedJwksUri;
        $array['federationRegistrationEndpoint'] = $this->federationRegistrationEndpoint;
        $array['supportedClientRegistrationTypes'] = $this->supportedClientRegistrationTypes;
        $array['tokenExchangeByIdentifiableClientsOnly'] = $this->tokenExchangeByIdentifiableClientsOnly;
        $array['tokenExchangeByConfidentialClientsOnly'] = $this->tokenExchangeByConfidentialClientsOnly;
        $array['tokenExchangeByPermittedClientsOnly'] = $this->tokenExchangeByPermittedClientsOnly;
        $array['tokenExchangeEncryptedJwtRejected'] = $this->tokenExchangeEncryptedJwtRejected;
        $array['tokenExchangeUnsignedJwtRejected'] = $this->tokenExchangeUnsignedJwtRejected;
        $array['jwtGrantByIdentifiableClientsOnly'] = $this->jwtGrantByIdentifiableClientsOnly;
        $array['jwtGrantEncryptedJwtRejected'] = $this->jwtGrantEncryptedJwtRejected;
        $array['jwtGrantUnsignedJwtRejected'] = $this->jwtGrantUnsignedJwtRejected;
        $array['dcrDuplicateSoftwareIdBlocked'] = $this->dcrDuplicateSoftwareIdBlocked;
        $array['resourceSignatureKeyId'] = $this->resourceSignatureKeyId;
        $array['rsResponseSigned'] = $this->rsResponseSigned;
        $array['openidDroppedOnRefreshWithoutOfflineAccess'] = $this->openidDroppedOnRefreshWithoutOfflineAccess;
        $array['verifiableCredentialsEnabled'] = $this->verifiableCredentialsEnabled;
        $array['credentialIssuerMetadata'] = $this->credentialIssuerMetadata;
        $array['credentialOfferDuration'] = $this->credentialOfferDuration;
        $array['userPinLength'] = $this->userPinLength;
        $array['idTokenAudType'] = $this->idTokenAudType;
        $array['supportedPromptValues'] = LanguageUtility::convertArrayToStringArray($this->supportedPromptValues);
        $array['verifiedClaimsValidationSchemaSet'] = $this->verifiedClaimsValidationSchemaSet;
        $array['preAuthorizedGrantAnonymousAccessSupported'] = $this->preAuthorizedGrantAnonymousAccessSupported;
        $array['cnonceDuration'] = $this->cnonceDuration;
        $array['credentialTransactionDuration'] = $this->credentialTransactionDuration;
        $array['credentialDuration'] = $this->credentialDuration;
        $array['credentialJwks'] = $this->credentialJwks;
        $array['credentialJwksUri'] = $this->credentialJwksUri;
        $array['idTokenReissuable'] = $this->idTokenReissuable;
        $array['introspectionSignatureKeyId'] = $this->introspectionSignatureKeyId;
        $array['fapiModes'] = LanguageUtility::convertArrayToStringArray($this->fapiModes);
        $array['dpopNonceRequired'] = $this->dpopNonceRequired;
        $array['dpopNonceDuration'] = $this->dpopNonceDuration;
        $array['tokenBatchNotificationEndpoint'] = $this->tokenBatchNotificationEndpoint;
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
        $_supported_grant_types = LanguageUtility::convertArray('\Authlete\Types\GrantType::valueOf', $_supported_grant_types,);
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
        $_supported_delivery_modes = LanguageUtility::convertArray('\Authlete\Types\DeliveryMode::valueOf', $_supported_delivery_modes,);
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
