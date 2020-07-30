CHANGES (日本語)
================

- `GrantType` クラス
    * `$CIBA` を追加。
    * `$DEVICE_CODE` を追加。

- 新しい部品
    * `DeliveryMode` クラス
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
