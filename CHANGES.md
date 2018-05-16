CHANGES
=======

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
