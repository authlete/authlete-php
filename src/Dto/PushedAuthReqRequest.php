<?php
//
// Copyright (C) 2020-2021 Authlete, Inc.
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
 * File containing the definition of PushedAuthReqRequest class.
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
 * Request to Authlete's /api/pushed_auth_req API.
 *
 * The authorization server can implement a pushed authorization request
 * endpoint which is defined in "OAuth 2.0 Pushed Authorization Requests"
 * by using the Authlete API.
 *
 * @since 1.8
 */
class PushedAuthReqRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $parameters            = null;
    private ?string $clientId              = null;
    private ?string $clientSecret          = null;
    private ?string $clientCertificate     = null;
    private ?array $clientCertificatePath  = null;


    /**
     * Get request parameters that the pushed authorization request endpoint
     * received from a client application.
     *
     * @return string
     *     Request parameters in `application/x-www-form-urlencoded` format.
     */
    public function getParameters(): ?string
    {
        return $this->parameters;
    }


    /**
     * Set request parameters that the pushed authorization request endpoint
     * received from a client application.
     *
     * @param string $parameters
     *     Request parameters in `application/x-www-form-urlencoded` format.
     *
     * @return PushedAuthReqRequest
     *     `$this` object.
     */
    public function setParameters(string $parameters): PushedAuthReqRequest
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the client ID extracted from the Authorization header of the request
     * to the pushed authorization request endpoint.
     *
     * @return string
     *     The client ID extracted from the `Authorization` header.
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }


    /**
     * Set the client ID extracted from the Authorization header of the request
     * to the pushed authorization request endpoint.
     *
     * @param string $clientId
     *     The client ID extracted from the `Authorization` header.
     *
     * @return PushedAuthReqRequest
     *     `$this` object.
     */
    public function setClientId(string $clientId): PushedAuthReqRequest
    {
        ValidationUtility::ensureNullOrString('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client secret extracted from the Authorization header of the
     * request to the pushed authorization request endpoint.
     *
     * @return string
     *     The client secret extracted from the `Authorization` header.
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }


    /**
     * Set the client secret extracted from the Authorization header of the
     * request to the pushed authorization request endpoint.
     *
     * @param string $clientSecret
     *     The client secret extracted from the `Authorization` header.
     *
     * @return PushedAuthReqRequest
     *     `$this` object.
     */
    public function setClientSecret(string $clientSecret): PushedAuthReqRequest
    {
        ValidationUtility::ensureNullOrString('$clientSecret', $clientSecret);

        $this->clientSecret = $clientSecret;

        return $this;
    }


    /**
     * Get the client certificate used in the TLS connection between the client
     * application and the pushed authorization request endpoint.
     *
     * @return string
     *     The client certificate.
     */
    public function getClientCertificate(): ?string
    {
        return $this->clientCertificate;
    }


    /**
     * Set the client certificate used in the TLS connection between the client
     * application and the pushed authorization request endpoint.
     *
     * @param string $certificate
     *     The client certificate.
     *
     * @return PushedAuthReqRequest
     *     `$this` object.
     */
    public function setClientCertificate(string $certificate): PushedAuthReqRequest
    {
        ValidationUtility::ensureNullOrString('$certificate', $certificate);

        $this->clientCertificate = $certificate;

        return $this;
    }


    /**
     * Get the client certificate path presented by the client during client
     * authentication.
     *
     * @return string[]
     *     Certificates in PEM format.
     */
    public function getClientCertificatePath(): ?array
    {
        return $this->clientCertificatePath;
    }


    /**
     * Set the client certificate path presented by the client during client
     * authentication.
     *
     * @param string[] $path
     *     Certificates in PEM format.
     *
     * @return PushedAuthReqRequest
     *     `$this` object.
     */
    public function setClientCertificatePath(array $path = null): PushedAuthReqRequest
    {
        ValidationUtility::ensureNullOrArrayOfString('$path', $path);

        $this->clientCertificatePath = $path;

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
        $array['parameters']            = $this->parameters;
        $array['clientId']              = $this->clientId;
        $array['clientSecret']          = $this->clientSecret;
        $array['clientCertificate']     = $this->clientCertificate;
        $array['clientCertificatePath'] = $this->clientCertificatePath;
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
    }
}

