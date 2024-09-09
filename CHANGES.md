CHANGES
=======

1.13.0 (2024-09-10)
-------------------

- `AuthleteApi` interface
    * Added `idTokenReissue()` method.

- `AuthorizationIssueRequest` class
    * Added `getAuthorizationDetails()` method.
    * Added `setAuthorizationDetails()` method.
    * Added `getConsentedClaims()` method.
    * Added `setConsentedClaims()` method.
    * Added `getJwtAtCliams()` method.
    * Added `setJwtAtClaims()` method.
    * Added `getAccessToken()` method.
    * Added `setAccessToken()` method.
    * Added `getIdTokenAudType()` method.
    * Added `setIdTokenAudType()` method.
    * Added `getAccessTokenDuration()` method.
    * Added `setAccessTokenDuration()` method.

- `AuthorizationIssueResponse` class
    * Added `getTicketInfo()` method.
    * Added `setTicketInfo()` method.

- `AuthorizationRequest` class
    * Added `getContext()` method.
    * Added `setContext()` method.

- `AuthorizationResponse` class
    * Added `isClientEntityIdUsed()` method.
    * Added `setClientEntityIdUsed()` method.
    * Added `getDynamicScopes()` method.
    * Added `setDynamicScopes()` method.
    * Added `getClaimsAtUserInfo()` method.
    * Added `setClaimsAtUserInfo()` method.
    * Added `getAuthorizationDetails()` method.
    * Added `setAuthorizationDetails()` method.
    * Added `getGmAction()` method.
    * Added `setGmAction()` method.
    * Added `getGrantId()` method.
    * Added `setGrantId()` method.
    * Added `getGrantSubject()` method.
    * Added `setGrantSubject()` method.
    * Added `getGrant()` method.
    * Added `setGrant()` method.
    * Added `getCredentialOfferInfo()` method.
    * Added `setCredentialOfferInfo()` method.
    * Added `getIssuableCredentials()` method.
    * Added `setIssuableCredentials()` method.

- `JWSAlg` class
    * Added `$ES256K`.
    * Added `$EdDSA`.

- `TokenAction` class
    * Added `$TOKEN_EXCHANGE`.
    * Added `$JWT_BEARER`.
    * Added `$ID_TOKEN_REISSUABLE`.

- New parts
    * `AuthorizationTicketInfo` class
    * `AuthzDetails` class
    * `AuthzDetailsElement` class
    * `CredentialOfferInfo` class
    * `DynamicScope` class
    * `GMAction` class
    * `Grant` class
    * `GrantScope` class
    * `IDTokenReissueAction` class
    * `IDTokenReissueRequest` class
    * `IDTokenReissueResponse` class


1.12.0 (2022-08-17)
-------------------

- `AuthleteApiImpl` class
    * Added the `User-Agent` HTTP header.


1.11.0 (2022-08-17)
-------------------

- `IntrospectionResponse` class
    * Added `getScopeDetails()` method.
    * Added `setScopeDetails()` method.
    * Added `getGrantId()` method.
    * Added `setGrantId()` method.
    * Added `getConsentedClaims()` method.
    * Added `setConsentedClaims()` method.
    * Added `getServiceAttributes()` method.
    * Added `setServiceAttributes()` method.
    * Added `getClientAttributes()` method.
    * Added `setClientAttributes()` method.
    * Added `isForExternalAttachment()` method.
    * Added `setForExternalAttachment()` method.


1.10.0 (2021-02-10)
-------------------

- `Service` class
    * Added `isIssSuppressed()` method.
    * Added `setIssSuppressed()` method.
    * Added `isNbfOptional()` method.
    * Added `setNbfOptional()` method.

- `StandardIntrospectionRequest` class
    * Added `isWithHiddenProperties()` method.
    * Added `setWithHiddenProperties()` method.


1.9.0 (2020-11-09)
------------------

- `AuthleteApi` interface
    * Added `tokenDelete()` method.

- `BackchannelAuthenticationCompleteRequest` class
    * Added `getIdtHeaderParams()` method.
    * Added `setIdtHeaderParams()` method.

- `Client` class
    * Added `isRequestObjectRequired()` method.
    * Added `setRequestObjectRequired()` method.

- `DeviceCompleteRequest` class
    * Added `getIdtHeaderParams()` method.
    * Added `setIdtHeaderParams()` method.

- `Service` class
    * Added `isRequestObjectRequired()` method.
    * Added `setRequestObjectRequired()` method.
    * Added `isTraditionalRequestObjectProcessingApplied()` method.
    * Added `setTraditionalRequestObjectProcessingApplied()` method.
    * Added `isClaimShortcutRestrictive()` method.
    * Added `setClaimShortcutRestrictive()` method.
    * Added `isScopeRequired()` method.
    * Added `setScopeRequired()` method.


1.8.0 (2020-08-09)
------------------

- `AuthleteApi` interface
    * Added `backchannelAuthentication()` method.
    * Added `backchannelAuthenticationIssue()` method.
    * Added `backchannelAuthenticationFail()` method.
    * Added `backchannelAuthenticationComplete()` method.
    * Added `deviceAuthorization()` method.
    * Added `deviceComplete()` method.
    * Added `deviceVerification()` method.
    * Added `pushAuthorizationRequest()` method.

- `AuthorizationFailReason` class
    * Added `$INVALID_TARGET`.

- `AuthorizationIssueRequest` class
    * Added `getIdtHeaderParams()` method.
    * Added `setIdtHeaderParams()` method.

- `AuthorizationIssueResponse` class
    * Added `getAccessToken()` method.
    * Added `setAccessToken()` method.
    * Added `getAccessTokenExpiresAt()` method.
    * Added `setAccessTokenExpiresAt()` method.
    * Added `getAccessTokenDuration()` method.
    * Added `setAccessTokenDuration()` method.
    * Added `getIdToken()` method.
    * Added `setIdToken()` method.
    * Added `getAuthorizationCode()` method.
    * Added `setAuthorizationCode()` method.
    * Added `getJwtAccessToken()` method.
    * Added `setJwtAccessToken()` method.

- `AuthorizationResponse` class
    * Added `getResources()` method.
    * Added `setResources()` method.
    * Added `getPurpose()` method.
    * Added `setPurpose()` method.

- `Client` class
    * Added `getDerivedSectorIdentifier()` method.
    * Added `setDerivedSectorIdentifier()` method.
    * Added `getTlsClientAuthSanDns()` method.
    * Added `setTlsClientAuthSanDns()` method.
    * Added `getTlsClientAuthSanUri()` method.
    * Added `setTlsClientAuthSanUri()` method.
    * Added `getTlsClientAuthSanIp()` method.
    * Added `setTlsClientAuthSanIp()` method.
    * Added `getTlsClientAuthSanEmail()` method.
    * Added `setTlsClientAuthSanEmail()` method.
    * Added `getBcDeliveryMode()` method.
    * Added `setBcDeliveryMode()` method.
    * Added `getBcNotificationEndpoint()` method.
    * Added `setBcNotificationEndpoint()` method.
    * Added `getBcRequestSignAlg()` method.
    * Added `setBcRequestSignAlg()` method.
    * Added `isBcUserCodeRequired()` method.
    * Added `setBcUserCodeRequired()` method.
    * Added `isDynamicallyRegistered()` method.
    * Added `setDynamicallyRegistered()` method.
    * Added `getRegistrationAccessTokenHash()` method.
    * Added `setRegistrationAccessTokenHash()` method.
    * Added `getAuthorizationDataTypes()` method.
    * Added `setAuthorizationDataTypes()` method.
    * Added `isParRequired()` method.
    * Added `setParRequired()` method.

- `ClientExtension` class
    * Added `getAccessTokenDuration()` method.
    * Added `setAccessTokenDuration()` method.
    * Added `getRefreshTokenDuration()` method.
    * Added `setRefreshTokenDuration()` method.

- `GrantType` class
    * Added `$CIBA`.
    * Added `$DEVICE_CODE`.

- `IntrospectionRequest` class
    * Added `getDpop()` method.
    * Added `setDpop()` method.
    * Added `getHtm()` method.
    * Added `setHtm()` method.
    * Added `getHtu()` method.
    * Added `setHtu()` method.

- `IntrospectionResponse` class
    * Added `getResources()` method.
    * Added `setResources()` method.
    * Added `getAccessTokenResources()` method.
    * Added `setAccessTokenResources()` method.

- `Service` class
    * Added `getRegistrationManagementEndpoint()` method.
    * Added `setRegistrationManagementEndpoint()` method.
    * Added `isPkceS256Required()` method.
    * Added `setPkceS256Required()` method.
    * Added `isRefreshTokenDurationKept()` method.
    * Added `setRefreshTokenDurationKept()` method.
    * Added `isDynamicRegistrationSupported()` method.
    * Added `setDynamicRegistrationSupported()` method.
    * Added `getEndSessionEndpoint()` method.
    * Added `setEndSessionEndpoint()` method.
    * Added `getAccessTokenSignAlg()` method.
    * Added `setAccessTokenSignAlg()` method.
    * Added `getPushedAuthReqDuration()` method.
    * Added `setPushedAuthReqDuration()` method.
    * Added `getAccessTokenSignatureKeyId()` method.
    * Added `setAccessTokenSignatureKeyId()` method.
    * Added `getSupportedBackchannelTokenDeliveryModes()` method.
    * Added `setSupportedBackchannelTokenDeliveryModes()` method.
    * Added `getBackchannelAuthenticationEndpoint()` method.
    * Added `setBackchannelAuthenticationEndpoint()` method.
    * Added `isBackchannelUserCodeParameterSupported()` method.
    * Added `setBackchannelUserCodeParameterSupported()` method.
    * Added `getBackchannelAuthReqIdDuration()` method.
    * Added `setBackchannelAuthReqIdDuration()` method.
    * Added `getBackchannelPollingInterval()` method.
    * Added `setBackchannelPollingInterval()` method.
    * Added `isBackchannelBindingMessageRequiredInFapi()` method.
    * Added `setBackchannelBindingMessageRequiredInFapi()` method.
    * Added `getAllowableClockSkew()` method.
    * Added `setAllowableClockSkew()` method.
    * Added `getDeviceAuthorizationEndpoint()` method.
    * Added `setDeviceAuthorizationEndpoint()` method.
    * Added `getDeviceVerificationUri()` method.
    * Added `setDeviceVerificationUri()` method.
    * Added `getDeviceVerificationUriComplete()` method.
    * Added `setDeviceVerificationUriComplete()` method.
    * Added `getDeviceFlowCodeDuration()` method.
    * Added `setDeviceFlowCodeDuration()` method.
    * Added `getDeviceFlowPollingInterval()` method.
    * Added `setDeviceFlowPollingInterval()` method.
    * Added `getUserCodeCharset()` method.
    * Added `setUserCodeCharset()` method.
    * Added `getUserCodeLength()` method.
    * Added `setUserCodeLength()` method.
    * Added `getPushedAuthReqEndpoint()` method.
    * Added `setPushedAuthReqEndpoint()` method.
    * Added `getMtlsEndpointAliases()` method.
    * Added `setMtlsEndpointAliases()` method.
    * Added `getSupportedAuthorizationDataTypes()` method.
    * Added `setSupportedAuthorizationDataTypes()` method.
    * Added `getSupportedTrustFrameworks()` method.
    * Added `setSupportedTrustFrameworks()` method.
    * Added `getSupportedEvidence()` method.
    * Added `setSupportedEvidence()` method.
    * Added `getSupportedIdentityDocuments()` method.
    * Added `setSupportedIdentityDocuments()` method.
    * Added `getSupportedVerificationMethods()` method.
    * Added `setSupportedVerificationMethods()` method.
    * Added `getSupportedVerifiedClaims()` method.
    * Added `setSupportedVerifiedClaims()` method.
    * Added `isMissingClientIdAllowed()` method.
    * Added `setMissingClientIdAllowed()` method.
    * Added `isParRequired()` method.
    * Added `setParRequired()` method.

- `TokenCreateRequest` class
    * Added `isAccessTokenPersistent()` method.
    * Added `setAccessTokenPersistent()` method.
    * Added `getCertificateThumbprint()` method.
    * Added `setCertificateThumbprint()` method.
    * Added `getDpopKeyThumbprint()` method.
    * Added `setDpopKeyThumbprint()` method.

- `TokenFailReason` class
    * Added `$INVALID_TARGET`.

- `TokenIssueResponse` class
    * Added `getJwtAccessToken()` method.
    * Added `setJwtAccessToken()` method.
    * Added `getAccessTokenResources()` method.
    * Added `setAccessTokenResources()` method.

- `TokenRequest` class
    * Added `getDpop()` method.
    * Added `setDpop()` method.
    * Added `getHtm()` method.
    * Added `setHtm()` method.
    * Added `getHtu()` method.
    * Added `setHtu()` method.

- `TokenResponse` class
    * Added `getJwtAccessToken()` method.
    * Added `setJwtAccessToken()` method.
    * Added `getResources()` method.
    * Added `setResources()` method.
    * Added `getAccessTokenResources()` method.
    * Added `setAccessTokenResources()` method.

- `TokenUpdateRequest` class
    * Added `isAccessTokenExpiresAtUpdatedOnScopeUpdate()` method.
    * Added `setAccessTokenExpiresAtUpdatedOnScopeUpdate()` method.
    * Added `isAccessTokenPersistent()` method.
    * Added `setAccessTokenPersistent()` method.
    * Added `getAccessTokenHash()` method.
    * Added `setAccessTokenHash()` method.
    * Added `isAccessTokenValueUpdated()` method.
    * Added `setAccessTokenValueUpdated()` method.
    * Added `getCertificateThumbprint()` method.
    * Added `setCertificateThumbprint()` method.
    * Added `getDpopKeyThumbprint()` method.
    * Added `setDpopKeyThumbprint()` method.

- `UserInfoRequest` class
    * Added `getClientCertificate()` method.
    * Added `setClientCertificate()` method.
    * Added `getDpop()` method.
    * Added `setDpop()` method.
    * Added `getHtm()` method.
    * Added `setHtm()` method.
    * Added `getHtu()` method.
    * Added `setHtu()` method.

- `UserInfoResponse` class
    * Added `getUserInfoClaims()` method.
    * Added `setUserInfoClaims()` method.

- New parts
    * `BackchannelAuthenticationAction` class
    * `BackchannelAuthenticationCompleteAction` class
    * `BackchannelAuthenticationCompleteRequest` class
    * `BackchannelAuthenticationCompleteResponse` class
    * `BackchannelAuthenticationCompleteResult` class
    * `BackchannelAuthenticationFailAction` class
    * `BackchannelAuthenticationFailReason` class
    * `BackchannelAuthenticationFailRequest` class
    * `BackchannelAuthenticationFailResponse` class
    * `BackchannelAuthenticationIssueAction` class
    * `BackchannelAuthenticationIssueRequest` class
    * `BackchannelAuthenticationIssueResponse` class
    * `BackchannelAuthenticationRequest` class
    * `BackchannelAuthenticationResponse` class
    * `DeliveryMode` class
    * `DeviceAuthorizationAction` class
    * `DeviceAuthorizationRequest` class
    * `DeviceAuthorizationResponse` class
    * `DeviceCompleteAction` class
    * `DeviceCompleteRequest` class
    * `DeviceCompleteResponse` class
    * `DeviceCompleteResult` class
    * `DeviceVerificationAction` class
    * `DeviceVerificationRequest` class
    * `DeviceVerificationResponse` class
    * `NamedUri` class
    * `PushedAuthReqAction` class
    * `PushedAuthReqRequest` class
    * `PushedAuthReqResponse` class
    * `UserCodeCharset` class
    * `UserIdentificationHintType` class


1.7.0 (2018-09-28)
------------------

- `AuthorizationResponse` class
    * Added `getRequestObjectPayload()` method.
    * Added `setRequestObjectPayload()` method.
    * Added `getIdTokenClaims()` method.
    * Added `setIdTokenClaims()` method.
    * Added `getUserInfoClaims()` method.
    * Added `setUserInfoClaims()` method.

- `Client` class
    * Added `getSoftwareId()` method.
    * Added `setSoftwareId()` method.
    * Added `getSoftwareVersion()` method.
    * Added `setSoftwareVersion()` method.
    * Added `getAuthorizationSignAlg()` method.
    * Added `setAuthorizationSignAlg()` method.
    * Added `getAuthorizationEncryptionAlg()` method.
    * Added `setAuthorizationEncryptionAlg()` method.
    * Added `getAuthorizationEncryptionEnc()` method.
    * Added `setAuthorizationEncryptionEnc()` method.

- `Service` class
    * Added `getAuthorizationResponseDuration()` method.
    * Added `setAuthorizationResponseDuration()` method.
    * Added `getAuthorizationSignatureKeyId()` method.
    * Added `setAuthorizationSignatureKeyId()` method.
    * Added `isClientIdAliasEnabled()` method.
    * Added `setClientIdAliasEnabled()` method.
    * Added `isErrorDescriptionOmitted()` method.
    * Added `setErrorDescriptionOmitted()` method.
    * Added `isErrorUriOmitted()` method.
    * Added `setErrorUriOmitted()` method.
    * Added `getIdTokenSignatureKeyId()` method.
    * Added `setIdTokenSignatureKeyId()` method.
    * Added `isRefreshTokenKept()` method.
    * Added `setRefreshTokenKept()` method.
    * Added `getUserInfoSignatureKeyId()` method.
    * Added `setUserInfoSignatureKeyId()` method.
    * Removed `getSupportedIntrospectionAuthSigningAlgorithms()` method.
    * Removed `setSupportedIntrospectionAuthSigningAlgorithms()` method.
    * Removed `getSupportedRevocationAuthSigningAlgorithms()` method.
    * Removed `setSupportedRevocationAuthSigningAlgorithms()` method.

- `ServiceProfile` class
    * Added `$OPEN_BANKING`.


1.6.0 (2018-05-18)
------------------

- `MaxAgeValidator` class
    * Newly added.


1.5.0 (2018-05-17)
------------------

- `AuthorizationResponse` class
    * Added `isClientIdAliasUsed()` method.
    * Added `setClientIdAliasUsed()` method.
    * Removed `isClientAliasUsed()` method.
    * Removed `setClientAliasUsed()` method.

- `Client` class
    * Added `getSelfSignedCertificateKeyId()` method.
    * Added `setSelfSignedCertificateKeyId()` method.


1.4.0 (2018-05-13)
------------------

- `Client` class
    * Added `isTlsClientCertificateBoundAccessTokens()` method.
    * Added `setTlsClientCertificateBoundAccessTokens()` method.
    * Removed `isMutualTlsSenderConstratinedAccessTokens()` method.
    * Removed `setMutualTlsSenderConstrainedAccessTokens()` method.

- `Service` class
    * Added `isTlsClientCertificateBoundAccessTokens()` method.
    * Added `setTlsClientCertificateBoundAccessTokens()` method.
    * Removed `isMutualTlsSenderConstratinedAccessTokens()` method.
    * Removed `setMutualTlsSenderConstrainedAccessTokens()` method.


1.3.0 (2018-05-05)
------------------

- `IntrospectionRequest` class
    * Added `getClientCertificate()` method.
    * Added `setClientCertificate()` method.

- `IntrospectionResponse` class
    * Added `getProperties()` method.
    * Added `setProperties()` method.
    * Added `getClientIdAlias()` method.
    * Added `setClientIdAlias()` method.
    * Added `isClientIdAliasUsed()` method.
    * Added `setClientIdAliasUsed()` method.
    * Added `getCertificateThumbprint()` method.
    * Added `setCertificateThumbprint()` method.

- `Service` class
    * Added `isMutualTlsValidatePkiCertChain()` method.
    * Added `setMutualTlsValidatePkiCertChain()` method.
    * Added `getTrustedRootCertificates()` method.
    * Added `setTrustedRootCertificates()` method.

- `TokenRequest` class
    * Added `getClientCertificatePath()` method.
    * Added `setClientCertificatePath()` method.

- `ValidationUtility` class
    * Added `ensureString()` method.

- New parts
    * `Arrayable` interface.
    * `ArrayTrait` trait.

- Added `Arrayable` interface to some classes in `Authlete.Dto` namespace.


1.2.0 (2018-05-03)
------------------

- `AuthleteApiException` class
    * Added `getResponseHeaders()` method.
    * Added `$responseHeaders` parameter to the constructor.

- `ValidationUtility` class
    * Added `ensureNullOrType()` method.

- New classes
    * `HttpHeaders` class.


1.1.0 (2018-04-30)
------------------

- Fixed many bugs.


1.0.0 (2018-03-16)
------------------

- First release.
