CHANGES (日本語)
================

- `AuthorizationFailReason` クラス
    * `$INVALID_TARGET` を追加。

- `AuthorizationIssueRequest` クラス
    * `getIdtHeaderParams()` メソッドを追加。
    * `setIdtHeaderParams()` メソッドを追加。

- `AuthorizationIssueResponse` クラス
    * `getAccessToken()` メソッドを追加。
    * `setAccessToken()` メソッドを追加。
    * `getAccessTokenExpiresAt()` メソッドを追加。
    * `setAccessTokenExpiresAt()` メソッドを追加。
    * `getAccessTokenDuration()` メソッドを追加。
    * `setAccessTokenDuration()` メソッドを追加。
    * `getIdToken()` メソッドを追加。
    * `setIdToken()` メソッドを追加。
    * `getAuthorizationCode()` メソッドを追加。
    * `setAuthorizationCode()` メソッドを追加。
    * `getJwtAccessToken()` メソッドを追加。
    * `setJwtAccessToken()` メソッドを追加。

- `AuthorizationResponse` クラス
    * `getResources()` メソッドを追加。
    * `setResources()` メソッドを追加。
    * `getPurpose()` メソッドを追加。
    * `setPurpose()` メソッドを追加。

- `Client` クラス
    * `getDerivedSectorIdentifier()` メソッドを追加。
    * `setDerivedSectorIdentifier()` メソッドを追加。
    * `getTlsClientAuthSanDns()` メソッドを追加。
    * `setTlsClientAuthSanDns()` メソッドを追加。
    * `getTlsClientAuthSanUri()` メソッドを追加。
    * `setTlsClientAuthSanUri()` メソッドを追加。
    * `getTlsClientAuthSanIp()` メソッドを追加。
    * `setTlsClientAuthSanIp()` メソッドを追加。
    * `getTlsClientAuthSanEmail()` メソッドを追加。
    * `setTlsClientAuthSanEmail()` メソッドを追加。
    * `getBcDeliveryMode()` メソッドを追加。
    * `setBcDeliveryMode()` メソッドを追加。
    * `getBcNotificationEndpoint()` メソッドを追加。
    * `setBcNotificationEndpoint()` メソッドを追加。
    * `getBcRequestSignAlg()` メソッドを追加。
    * `setBcRequestSignAlg()` メソッドを追加。
    * `isBcUserCodeRequired()` メソッドを追加。
    * `setBcUserCodeRequired()` メソッドを追加。
    * `isDynamicallyRegistered()` メソッドを追加。
    * `setDynamicallyRegistered()` メソッドを追加。
    * `getRegistrationAccessTokenHash()` メソッドを追加。
    * `setRegistrationAccessTokenHash()` メソッドを追加。
    * `getAuthorizationDataTypes()` メソッドを追加。
    * `setAuthorizationDataTypes()` メソッドを追加。
    * `isParRequired()` メソッドを追加。
    * `setParRequired()` メソッドを追加。

- `ClientExtension` クラス
    * `getAccessTokenDuration()` メソッドを追加。
    * `setAccessTokenDuration()` メソッドを追加。
    * `getRefreshTokenDuration()` メソッドを追加。
    * `setRefreshTokenDuration()` メソッドを追加。

- `GrantType` クラス
    * `$CIBA` を追加。
    * `$DEVICE_CODE` を追加。

- `IntrospectionRequest` クラス
    * `getDpop()` メソッドを追加。
    * `setDpop()` メソッドを追加。
    * `getHtm()` メソッドを追加。
    * `setHtm()` メソッドを追加。
    * `getHtu()` メソッドを追加。
    * `setHtu()` メソッドを追加。

- `IntrospectionResponse` クラス
    * `getResources()` メソッドを追加。
    * `setResources()` メソッドを追加。
    * `getAccessTokenResources()` メソッドを追加。
    * `setAccessTokenResources()` メソッドを追加。

- `Service` クラス
    * `getRegistrationManagementEndpoint()` メソッドを追加。
    * `setRegistrationManagementEndpoint()` メソッドを追加。
    * `isPkceS256Required()` メソッドを追加。
    * `setPkceS256Required()` メソッドを追加。
    * `isRefreshTokenDurationKept()` メソッドを追加。
    * `setRefreshTokenDurationKept()` メソッドを追加。
    * `isDynamicRegistrationSupported()` メソッドを追加。
    * `setDynamicRegistrationSupported()` メソッドを追加。
    * `getEndSessionEndpoint()` メソッドを追加。
    * `setEndSessionEndpoint()` メソッドを追加。
    * `getAccessTokenSignAlg()` メソッドを追加。
    * `setAccessTokenSignAlg()` メソッドを追加。
    * `getPushedAuthReqDuration()` メソッドを追加。
    * `setPushedAuthReqDuration()` メソッドを追加。
    * `getAccessTokenSignatureKeyId()` メソッドを追加。
    * `setAccessTokenSignatureKeyId()` メソッドを追加。
    * `getSupportedBackchannelTokenDeliveryModes()` メソッドを追加。
    * `setSupportedBackchannelTokenDeliveryModes()` メソッドを追加。
    * `getBackchannelAuthenticationEndpoint()` メソッドを追加。
    * `setBackchannelAuthenticationEndpoint()` メソッドを追加。
    * `isBackchannelUserCodeParameterSupported()` メソッドを追加。
    * `setBackchannelUserCodeParameterSupported()` メソッドを追加。
    * `getBackchannelAuthReqIdDuration()` メソッドを追加。
    * `setBackchannelAuthReqIdDuration()` メソッドを追加。
    * `getBackchannelPollingInterval()` メソッドを追加。
    * `setBackchannelPollingInterval()` メソッドを追加。
    * `isBackchannelBindingMessageRequiredInFapi()` メソッドを追加。
    * `setBackchannelBindingMessageRequiredInFapi()` メソッドを追加。
    * `getAllowableClockSkew()` メソッドを追加。
    * `setAllowableClockSkew()` メソッドを追加。
    * `getDeviceAuthorizationEndpoint()` メソッドを追加。
    * `setDeviceAuthorizationEndpoint()` メソッドを追加。
    * `getDeviceVerificationUri()` メソッドを追加。
    * `setDeviceVerificationUri()` メソッドを追加。
    * `getDeviceVerificationUriComplete()` メソッドを追加。
    * `setDeviceVerificationUriComplete()` メソッドを追加。
    * `getDeviceFlowCodeDuration()` メソッドを追加。
    * `setDeviceFlowCodeDuration()` メソッドを追加。
    * `getDeviceFlowPollingInterval()` メソッドを追加。
    * `setDeviceFlowPollingInterval()` メソッドを追加。
    * `getUserCodeCharset()` メソッドを追加。
    * `setUserCodeCharset()` メソッドを追加。
    * `getUserCodeLength()` メソッドを追加。
    * `setUserCodeLength()` メソッドを追加。
    * `getPushedAuthReqEndpoint()` メソッドを追加。
    * `setPushedAuthReqEndpoint()` メソッドを追加。
    * `getMtlsEndpointAliases()` メソッドを追加。
    * `setMtlsEndpointAliases()` メソッドを追加。
    * `getSupportedAuthorizationDataTypes()` メソッドを追加。
    * `setSupportedAuthorizationDataTypes()` メソッドを追加。
    * `getSupportedTrustFrameworks()` メソッドを追加。
    * `setSupportedTrustFrameworks()` メソッドを追加。
    * `getSupportedEvidence()` メソッドを追加。
    * `setSupportedEvidence()` メソッドを追加。
    * `getSupportedIdentityDocuments()` メソッドを追加。
    * `setSupportedIdentityDocuments()` メソッドを追加。
    * `getSupportedVerificationMethods()` メソッドを追加。
    * `setSupportedVerificationMethods()` メソッドを追加。
    * `getSupportedVerifiedClaims()` メソッドを追加。
    * `setSupportedVerifiedClaims()` メソッドを追加。
    * `isMissingClientIdAllowed()` メソッドを追加。
    * `setMissingClientIdAllowed()` メソッドを追加。
    * `isParRequired()` メソッドを追加。
    * `setParRequired()` メソッドを追加。

- `TokenCreateRequest` クラス
    * `isAccessTokenPersistent()` メソッドを追加。
    * `setAccessTokenPersistent()` メソッドを追加。
    * `getCertificateThumbprint()` メソッドを追加。
    * `setCertificateThumbprint()` メソッドを追加。
    * `getDpopKeyThumbprint()` メソッドを追加。
    * `setDpopKeyThumbprint()` メソッドを追加。

- `TokenFailReason` クラス
    * `$INVALID_TARGET` を追加。

- `TokenIssueResponse` クラス
    * `getJwtAccessToken()` メソッドを追加。
    * `setJwtAccessToken()` メソッドを追加。
    * `getAccessTokenResources()` メソッドを追加。
    * `setAccessTokenResources()` メソッドを追加。

- `TokenRequest` クラス
    * `getDpop()` メソッドを追加。
    * `setDpop()` メソッドを追加。
    * `getHtm()` メソッドを追加。
    * `setHtm()` メソッドを追加。
    * `getHtu()` メソッドを追加。
    * `setHtu()` メソッドを追加。

- `TokenResponse` クラス
    * `getJwtAccessToken()` メソッドを追加。
    * `setJwtAccessToken()` メソッドを追加。
    * `getResources()` メソッドを追加。
    * `setResources()` メソッドを追加。
    * `getAccessTokenResources()` メソッドを追加。
    * `setAccessTokenResources()` メソッドを追加。

- `TokenUpdateRequest` クラス
    * `isAccessTokenExpiresAtUpdatedOnScopeUpdate()` メソッドを追加。
    * `setAccessTokenExpiresAtUpdatedOnScopeUpdate()` メソッドを追加。
    * `isAccessTokenPersistent()` メソッドを追加。
    * `setAccessTokenPersistent()` メソッドを追加。
    * `getAccessTokenHash()` メソッドを追加。
    * `setAccessTokenHash()` メソッドを追加。
    * `isAccessTokenValueUpdated()` メソッドを追加。
    * `setAccessTokenValueUpdated()` メソッドを追加。
    * `getCertificateThumbprint()` メソッドを追加。
    * `setCertificateThumbprint()` メソッドを追加。
    * `getDpopKeyThumbprint()` メソッドを追加。
    * `setDpopKeyThumbprint()` メソッドを追加。

- `UserInfoRequest` クラス
    * `getClientCertificate()` メソッドを追加。
    * `setClientCertificate()` メソッドを追加。
    * `getDpop()` メソッドを追加。
    * `setDpop()` メソッドを追加。
    * `getHtm()` メソッドを追加。
    * `setHtm()` メソッドを追加。
    * `getHtu()` メソッドを追加。
    * `setHtu()` メソッドを追加。

- `UserInfoResponse` クラス
    * `getUserInfoClaims()` メソッドを追加。
    * `setUserInfoClaims()` メソッドを追加。

- 新しい部品
    * `BackchannelAuthenticationAction` クラス
    * `BackchannelAuthenticationCompleteAction` クラス
    * `BackchannelAuthenticationCompleteResult` クラス
    * `BackchannelAuthenticationFailAction` クラス
    * `BackchannelAuthenticationFailReason` クラス
    * `BackchannelAuthenticationIssueAction` クラス
    * `DeliveryMode` クラス
    * `DeviceAuthorizationAction` クラス
    * `DeviceCompleteResult` クラス
    * `NamedUri` クラス
    * `UserCodeCharset` クラス
    * `UserIdentificationHintType` クラス


1.7.0 (2018 年 09 月 28 日)
---------------------------

- `AuthorizationResponse` クラス
    * `getRequestObjectPayload()` メソッドを追加。
    * `setRequestObjectPayload()` メソッドを追加。
    * `getIdTokenClaims()` メソッドを追加。
    * `setIdTokenClaims()` メソッドを追加。
    * `getUserInfoClaims()` メソッドを追加。
    * `setUserInfoClaims()` メソッドを追加。

- `Client` クラス
    * `getSoftwareId()` メソッドを追加。
    * `setSoftwareId()` メソッドを追加。
    * `getSoftwareVersion()` メソッドを追加。
    * `setSoftwareVersion()` メソッドを追加。
    * `getAuthorizationSignAlg()` メソッドを追加。
    * `setAuthorizationSignAlg()` メソッドを追加。
    * `getAuthorizationEncryptionAlg()` メソッドを追加。
    * `setAuthorizationEncryptionAlg()` メソッドを追加。
    * `getAuthorizationEncryptionEnc()` メソッドを追加。
    * `setAuthorizationEncryptionEnc()` メソッドを追加。

- `Service` クラス
    * `getAuthorizationResponseDuration()` メソッドを追加。
    * `setAuthorizationResponseDuration()` メソッドを追加。
    * `getAuthorizationSignatureKeyId()` メソッドを追加。
    * `setAuthorizationSignatureKeyId()` メソッドを追加。
    * `isClientIdAliasEnabled()` メソッドを追加。
    * `setClientIdAliasEnabled()` メソッドを追加。
    * `isErrorDescriptionOmitted()` メソッドを追加。
    * `setErrorDescriptionOmitted()` メソッドを追加。
    * `isErrorUriOmitted()` メソッドを追加。
    * `setErrorUriOmitted()` メソッドを追加。
    * `getIdTokenSignatureKeyId()` メソッドを追加。
    * `setIdTokenSignatureKeyId()` メソッドを追加。
    * `isRefreshTokenKept()` メソッドを追加。
    * `setRefreshTokenKept()` メソッドを追加。
    * `getUserInfoSignatureKeyId()` メソッドを追加。
    * `setUserInfoSignatureKeyId()` メソッドを追加。
    * `getSupportedIntrospectionAuthSigningAlgorithms()` メソッドを削除。
    * `setSupportedIntrospectionAuthSigningAlgorithms()` メソッドを削除。
    * `getSupportedRevocationAuthSigningAlgorithms()` メソッドを削除。
    * `setSupportedRevocationAuthSigningAlgorithms()` メソッドを削除。

- `ServiceProfile` クラス
    * `$OPEN_BANKING` を追加。


1.6.0 (2018 年 05 月 18 日)
---------------------------

- `MaxAgeValidator` クラス
    * 新規追加


1.5.0 (2018 年 05 月 17 日)
---------------------------

- `AuthorizationResponse` クラス
    * `isClientIdAliasUsed()` メソッドを追加。
    * `setClientIdAliasUsed()` メソッドを追加。
    * `isClientAliasUsed()` メソッドを削除。
    * `setClientAliasUsed()` メソッドを削除。

- `Client` クラス
    * `getSelfSignedCertificateKeyId()` メソッドを追加。
    * `setSelfSignedCertificateKeyId()` メソッドを追加。


1.4.0 (2018 年 05 月 13 日)
---------------------------

- `Client` クラス
    * `isTlsClientCertificateBoundAccessTokens()` メソッドを追加。
    * `setTlsClientCertificateBoundAccessTokens()` メソッドを追加。
    * `isMutualTlsSenderConstratinedAccessTokens()` メソッドを削除。
    * `setMutualTlsSenderConstrainedAccessTokens()` メソッドを削除。

- `Service` クラス
    * `isTlsClientCertificateBoundAccessTokens()` メソッドを追加。
    * `setTlsClientCertificateBoundAccessTokens()` メソッドを追加。
    * `isMutualTlsSenderConstratinedAccessTokens()` メソッドを削除。
    * `setMutualTlsSenderConstrainedAccessTokens()` メソッドを削除。


1.3.0 (2018 年 05 月 05 日)
---------------------------

- `IntrospectionRequest` クラス
    * `getClientCertificate()` メソッドを追加。
    * `setClientCertificate()` メソッドを追加。

- `IntrospectionResponse` クラス
    * `getProperties()` メソッドを追加。
    * `setProperties()` メソッドを追加。
    * `getClientIdAlias()` メソッドを追加。
    * `setClientIdAlias()` メソッドを追加。
    * `isClientIdAliasUsed()` メソッドを追加。
    * `setClientIdAliasUsed()` メソッドを追加。
    * `getCertificateThumbprint()` メソッドを追加。
    * `setCertificateThumbprint()` メソッドを追加。

- `Service` クラス
    * `isMutualTlsValidatePkiCertChain()` メソッドを追加。
    * `setMutualTlsValidatePkiCertChain()` メソッドを追加。
    * `getTrustedRootCertificates()` メソッドを追加。
    * `setTrustedRootCertificates()` メソッドを追加。

- `TokenRequest` クラス
    * `getClientCertificatePath()` メソッドを追加。
    * `setClientCertificatePath()` メソッドを追加。

- `ValidationUtility` クラス
    * `ensureString()` メソッドを追加。

- 新しい部品
    * `Arrayable` インターフェース
    * `ArrayTrait` トレイト

- `Authlete.Dto` 名前空間内の幾つかのクラスに `Arrayable` インターフェースを追加。


1.2.0 (2018 年 05 月 03 日)
---------------------------

- `AuthleteApiException` クラス
    * `getResponseHeaders()` メソッドを追加。
    * `$responseHeaders` パラメーターをコンストラクターに追加。

- `ValidationUtility` クラス
    * `ensureNullOrType()` メソッドを追加。

- 新しいクラス
    * `HttpHeaders` クラス


1.1.0 (2018 年 04 月 30 日)
---------------------------

- 多くの不具合を修正。


1.0.0 (2018 年 03 月 16 日)
---------------------------

- 最初のリリース
