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
 * File containing the definition of TokenRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/token API.
 *
 * An entity body of a token request may contain the client ID (`client_id`)
 * and the client secret (`client_secret`) along with other request parameters
 * as described in
 * [2.3.1. Client Password](https://tools.ietf.org/html/rfc6749#section-2.3.1)
 * of [RFC 6749](https://tools.ietf.org/html/rfc6749). If client credentials
 * are contained both in the `Authorization` header and in the entity body,
 * they must be identical. If they do not match, Authlete's `/api/auth/token`
 * API reports an error. It is not an error of your authorization server
 * implementation but an error of the client application.
 */
class TokenRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $parameters            = null;
    private ?string $clientId              = null;
    private ?string $clientSecret          = null;
    private ?string $clientCertificate     = null;
    private ?array $clientCertificatePath  = null;  // array of string
    private ?array $properties             = null;  // array of \Authlete\Dto\Property
    private ?string $dpop                  = null;
    private ?string $htm                   = null;
    private ?string $htu                   = null;


    /**
     * Get the token request parameters which the token endpoint implementation
     * of your authorization server received from the client application.
     *
     * @return string|null
     *     The request parameters of the token request.
     */
    public function getParameters(): ?string
    {
        return $this->parameters;
    }


    /**
     * Set the token request parameters which the token endpoint implementation
     * of your authorization server received from the client application.
     *
     * The value of this request parameter is the entire entity body (which is
     * formatted in `application/x-www-form-urlencoded`) of the request from
     * the client application. This request parameter is mandatory.
     *
     * @param string $parameters
     *     The request parameters of the token request.
     *
     * @return TokenRequest
     *     `$this` object.
     */
    public function setParameters(string $parameters): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the client ID extracted from the Authorization header of the token
     * request from the client application.
     *
     * @return string|null
     *     The client ID extracted from the `Authorization` header.
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }


    /**
     * Set the client ID extracted from the Authorization header of the token
     * request from the client application.
     *
     * If the token endpoint of the authorization server supports Basic
     * Authentication as a means of
     * [client authentication](https://tools.ietf.org/html/rfc6749#section-2.3),
     * and if the request from the client application contained its client ID
     * in the `Authorization` header, the value should be extracted from there
     * and set as the value of this request parameter.
     *
     * @param string $clientId
     *     The client ID extracted from the `Authorization` header.
     *
     * @return TokenRequest
     *     `$this` object.
     */
    public function setClientId(string $clientId): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client secret extracted from the Authorization header of the
     * token request from the client application.
     *
     * @return string|null
     *     The client secret extracted from the `Authorization` header.
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }


    /**
     * Set the client secret extracted from the Authorization header of the
     * token request from the client application.
     *
     * If the token endpoint of the authorization server supports Basic
     * Authentication as a means of
     * [client authentication](https://tools.ietf.org/html/rfc6749#section-2.3),
     * and if the request from the client application contained its client
     * secret in the `Authorization` header, the value should be extracted
     * from there and set as the value of this request parameter.
     *
     * @param string $clientSecret
     *     The client secret extracted from the `Authorization` header.
     *
     * @return TokenRequest
     *     `$this` object.
     */
    public function setClientSecret(string $clientSecret): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$clientSecret', $clientSecret);

        $this->clientSecret = $clientSecret;

        return $this;
    }


    /**
     * Get the client certificate from the MTLS of the token request from
     * the client application.
     *
     * @return string|null
     *     The client certificate.
     */
    public function getClientCertificate(): ?string
    {
        return $this->clientCertificate;
    }


    /**
     * Set the client certificate from the MTLS of the token request from
     * the client application.
     *
     * @param string $certificate
     *     The client certificate.
     *
     * @return TokenRequest
     *     `$this` object.
     */
    public function setClientCertificate(string $certificate): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$certificate', $certificate);

        $this->clientCertificate = $certificate;

        return $this;
    }


    /**
     * Get the certificate path presented by the client during client
     * authentication.
     *
     * @return String[]|null
     *     Certificates in PEM format.
     *
     * @since 1.3
     */
    public function getClientCertificatePath(): ?array
    {
        return $this->clientCertificatePath;
    }


    /**
     * Set the certificate path presented by the client during client
     * authentication.
     *
     * @param string[] $path
     *     Certificates in PEM format.
     *
     * @return TokenRequest
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setClientCertificatePath(array $path = null): TokenRequest
    {
        ValidationUtility::ensureNullOrArrayOfString('$path', $path);

        $this->clientCertificatePath = $path;

        return $this;
    }


    /**
     * Get the properties to be associated with an access token which may be
     * issued as a result of the token request.
     *
     * @return Property[]|null Properties associated with the access token.
     *     Properties associated with the access token.
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }


    /**
     * Set the properties to be associated with an access token which may be
     * issued as a result of the token request.
     *
     * If the value of the `grant_type` parameter contained in the token
     * request from the client application is `authorization_code`, properties
     * set by this request parameter will be added as the extra properties of
     * a newly created access token. The extra properties specified when the
     * authorization code was issued (using
     * `AuthorizationIssueRequest::setProperties()`) will also be used, but
     * their values will be overwritten if the extra properties set by this
     * request parameter have the same keys. In other words, extra properties
     * contained in this request will be merged into existing extra properties
     * which are associated with the authorization code.
     *
     * Otherwise, if the value of the `grant_type` parameter contained in the
     * token request from the client application is `refresh_token`, properties
     * set by this request parameter will be added to the existing extra
     * properties of the corresponding access token. Extra properties having
     * the same keys will be overwritten in the same manner as the case of
     * `grant_type=authorization_code`.
     *
     * Otherwise, if the value of the `grant_type` parameter contained in the
     * token request from the client application is `client_credentials`,
     * properties set by this request parameter will be used simply as extra
     * properties of a newly created access token. Because
     * [Client Credentials flow](https://tools.ietf.org/html/rfc6749#section-4.4)
     * does not have a preceding authorization request, merging extra
     * properties will not be performed. This is different from the cases of
     * `grant_type=authorization_code` and `grant_type=refresh_token`.
     *
     * In other cases (`grant_type=password`), properties set by this request
     * parameter will not be used. When you want to associate extra properties
     * with an access token which is issued by
     * [Resource Owner Password Credentials flow](https://tools.ietf.org/html/rfc6749#section-4.3),
     * use `TokenIssueRequest::setProperties()` instead.
     *
     * Keys of extra properties will be used as labels of top-level entries in
     * a JSON response containing an access token which is returned from an
     * authorization server. An example is `example_parameter`, which you can
     * find in [5.1. Successful Response](https://tools.ietf.org/html/rfc6749#section-5.1)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749). The following code
     * snippet is an example to set one extra property having
     * `example_parameter` as its key and `example_value` as its value.
     *
     * ```
     * $properties = array(
     *     new Property("example_parameter", "example_value")
     * );
     *
     * $request.setProperties($properties);
     * ```
     *
     * Keys listed below should not be used and they would be ignored on
     * Authlete side even if they were used. It's because they are reserved in
     * [RFC 6749](https://tools.ietf.org/html/rfc6749) and
     * [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * + `token_type`
     * + `expires_in`
     * + `refresh_token`
     * + `scope`
     * + `error`
     * + `error_description`
     * + `error_uri`
     * + `id_token`
     *
     * Note that there is an upper limit on the total size of extra properties.
     * On the server side, the properties will be (1) converted to a
     * multidimensional string array, (2) converted to JSON, (3) encrypted by
     * AES/CBC/PKCS5Padding, (4) encoded by base64url, and then stored into the
     * database. The length of the resultant string must not exceed 65,535 in
     * bytes. This is the upper limit, but we think it is big enough.
     *
     * @param Property[] $properties
     *     Properties to be associated with the access token.
     *
     * @return TokenRequest
     *     `$this` object.
     */
    public function setProperties(array $properties = null): TokenRequest
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get the `DPoP` header presented by the client during the request to the
     * token endpoint. This header contains a signed JWT which includes the
     * public key that is paired with the private key used to sign it.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string|null
     *     The value of the `DPoP` header.
     *
     * @since 1.8
     */
    public function getDpop(): ?string
    {
        return $this->dpop;
    }


    /**
     * Set the `DPoP` header presented by the client during the request to the
     * token endpoint. This header contains a signed JWT which includes the
     * public key that is paired with the private key used to sign it.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $dpop
     *     The value of the `DPoP` header.
     *
     * @return TokenRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDpop(string $dpop): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$dpop', $dpop);

        $this->dpop = $dpop;

        return $this;
    }


    /**
     * Get the HTTP method of the token request. This property is used to
     * validate the `DPoP` header.
     *
     * In normal cases, the value is `POST`. When this request parameter is
     * omitted, `POST` is used as the default value.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string|null
     *     The HTTP method. For example, `POST`.
     *
     * @since 1.8
     */
    public function getHtm(): ?string
    {
        return $this->htm;
    }


    /**
     * Set the HTTP method of the token request. This property is used to
     * validate the `DPoP` header.
     *
     * In normal cases, the value is `POST`. When this request parameter is
     * omitted, `POST` is used as the default value.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $htm
     *     The HTTP method. For example, `POST`.
     *
     * @return TokenRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setHtm(string $htm): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$htm', $htm);

        $this->htm = $htm;

        return $this;
    }


    /**
     * Get the URL of the token endpoint. This property is used to validate
     * the `DPoP` header.
     *
     * If this request parameter is omitted, the `tokenEndpoint` property of
     * the `Service` is used as the default value.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string|null
     *     The URL of the token endpoint.
     *
     * @since 1.8
     */
    public function getHtu(): ?string
    {
        return $this->htu;
    }


    /**
     * Set the URL of the token endpoint. This property is used to validate
     * the `DPoP` header.
     *
     * If this request parameter is omitted, the `tokenEndpoint` property of
     * the `Service` is used as the default value.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $htu
     *     The URL of the token endpoint.
     *
     * @return TokenRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setHtu(string $htu): TokenRequest
    {
        ValidationUtility::ensureNullOrString('$htu', $htu);

        $this->htu = $htu;

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
        $array['parameters']            = $this->parameters;
        $array['clientId']              = $this->clientId;
        $array['clientSecret']          = $this->clientSecret;
        $array['clientCertificate']     = $this->clientCertificate;
        $array['clientCertificatePath'] = $this->clientCertificatePath;
        $array['properties']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['dpop']                  = $this->dpop;
        $array['htm']                   = $this->htm;
        $array['htu']                   = $this->htu;
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
        // parameters
        $this->setParameters(
            LanguageUtility::getFromArray('parameters', $array));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // clientSecret
        $this->setClientSecret(
            LanguageUtility::getFromArray('clientSecret', $array));

        // clientCertificate
        $this->setClientCertificate(
            LanguageUtility::getFromArray('clientCertificate', $array));

        // clientCertificatePath
        $_client_certificate_path = LanguageUtility::getFromArray('clientCertificatePath', $array);
        $this->setClientCertificatePath($_client_certificate_path);

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable( __NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);

        // dpop
        $this->setDpop(
            LanguageUtility::getFromArray('dpop', $array));

        // htm
        $this->setHtm(
            LanguageUtility::getFromArray('htm', $array));

        // htu
        $this->setHtu(
            LanguageUtility::getFromArray('htu', $array));
    }
}
