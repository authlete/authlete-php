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
 * File containing the definition of IntrospectionRequest class.
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
 * Request to Authlete's /api/auth/introspection API.
 *
 * The API returns information about an access token.
 */
class IntrospectionRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $token             = null;
    private ?array $scopes             = null;  // array of string
    private ?string $subject           = null;
    private ?string $clientCertificate = null;
    private ?string $dpop              = null;
    private ?string $htm               = null;
    private ?string $htu               = null;


    /**
     * Get the access token.
     *
     * @return string|null
     *     The access token.
     */
    public function getToken(): ?string
    {
        return $this->token;
    }


    /**
     * Set the access token.
     *
     * @param string $token
     *     The access token.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     */
    public function setToken(string $token): IntrospectionRequest
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->token = $token;

        return $this;
    }


    /**
     * Get scopes which are required to access the protected resource endpoint
     * of the resource server.
     *
     * @return array|null
     *     The scopes which are required to access the protected resource
     *     endpoint.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set scopes which are required to access the protected resource endpoint
     * of the resource server.
     *
     * If the given array contains one or more scopes which are not covered by
     * the access token, Authlete's /api/auth/introspection API returns
     * `IntrospectionAction::FORBIDDEN` as the `action` and sets
     * `insufficient_scope` as the error code. If `null` is given,
     * /api/auth/introspection API does not check scopes of the access token.
     *
     * @param string[] $scopes
     *     The scopes which the access token is required to have in order to
     *     access the protected resource endpoint.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): IntrospectionRequest
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of an end-user which is required
     * to access the protected resource endpoint of the resource server.
     *
     * @return string|null
     *     The subject which the access token is required to be associated
     *     with in order to access the protected resource endpoint.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of an end-user which is required
     * to access the protected resource endpoint of the resource server.
     *
     * If the specified subject is different from the one associated with
     * the access token, Authlete's /api/auth/introspection API returns
     * `IntrospectionAction::FORBIDDEN` as the `action` and sets
     * `invalid_request` as the error code. If `null` is given,
     * /api/auth/introspection API does not check the subject of the access
     * token.
     *
     * @param string $subject
     *     The subject which the access token is required to be associated
     *     with in order to access the protected resource endpoint.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     */
    public function setSubject($subject): IntrospectionRequest
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the client certificate, used to validate binding against access
     * tokens using the MTLS sender confirmation method.
     *
     * @return string|null
     *     The client certificate in PEM format.
     *
     * @since 1.3
     */
    public function getClientCertificate(): ?string
    {
        return $this->clientCertificate;
    }


    /**
     * Set the client certificate, used to validate binding against access
     * tokens using the MTLS sender confirmation method.
     *
     * @param string $certificate
     *     The client certificate in PEM format.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setClientCertificate(string $certificate): IntrospectionRequest
    {
        ValidationUtility::ensureNullOrString('$certificate', $certificate);

        $this->clientCertificate = $certificate;

        return $this;
    }


    /**
     * Get the `DPoP` header presented by the client during the request to the
     * resource server. This header contains a signed JWT which includes the
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
     * resource server. This header contains a signed JWT which includes the
     * public key that is paired with the private key used to sign it.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $dpop
     *     The value of the `DPoP` header.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDpop(string $dpop): IntrospectionRequest
    {
        ValidationUtility::ensureNullOrString('$dpop', $dpop);

        $this->dpop = $dpop;

        return $this;
    }


    /**
     * Get the HTTP method of the request from the client to the protected
     * resource endpoint. This property is used to validate the `DPoP` header.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string|null
     *     The HTTP method. For example, `GET`.
     *
     * @since 1.8
     */
    public function getHtm(): ?string
    {
        return $this->htm;
    }


    /**
     * Set the HTTP method of the request from the client to the protected
     * resource endpoint. This property is used to validate the `DPoP` header.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $htm
     *     The HTTP method. For example, `GET`.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setHtm(string $htm): IntrospectionRequest
    {
        ValidationUtility::ensureNullOrString('$htm', $htm);

        $this->htm = $htm;

        return $this;
    }


    /**
     * Get the URL of the request from the client to the protected resource
     * endpoint. This property is used to validate the `DPoP` header.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string|null The URL of the protected resource endpoint.
     *     The URL of the protected resource endpoint.
     *
     * @since 1.8
     */
    public function getHtu(): ?string
    {
        return $this->htu;
    }


    /**
     * Set the URL of the request from the client to the protected resource
     * endpoint. This property is used to validate the `DPoP` header.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $htu
     *     The URL of the protected resource endpoint.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setHtu(string $htu): IntrospectionRequest
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
        $array['token']             = $this->token;
        $array['scopes']            = $this->scopes;
        $array['subject']           = $this->subject;
        $array['clientCertificate'] = $this->clientCertificate;
        $array['dpop']              = $this->dpop;
        $array['htm']               = $this->htm;
        $array['htu']               = $this->htu;
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
        // token
        $this->setToken(
            LanguageUtility::getFromArray('token', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // clientCertificate
        $this->setClientCertificate(
            LanguageUtility::getFromArray('clientCertificate', $array));

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
