CHANGES (日本語)
================

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
