CHANGES
=======

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

- New parts
    * `DeliveryMode` class
    * `NamedUri` class
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
