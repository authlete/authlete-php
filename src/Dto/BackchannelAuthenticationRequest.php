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
 * File containing the definition of BackchannelAuthenticationRequest class.
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
 * Request to Authlete's /api/backchannel/authentication API.
 *
 * When the implementation of the backchannel authentication endpoint of the
 * authorization server receives a backchannel authentication request from a
 * client application, the first step is to call Authlete's
 * `/api/backchannel/authentication` API. The API will parse the backchannel
 * authentication request on behalf of the implementation of the backchannel
 * authentication endpoint.
 *
 * @since 1.8
 */
class BackchannelAuthenticationRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $parameters            = null;
    private ?string $clientId              = null;
    private ?string $clientSecret          = null;
    private ?string $clientCertificate     = null;
    private ?array $clientCertificatePath  = null;  // array of string


    /**
     * Get the value of `parameters` which is the request parameters that the
     * backchannel authentication endpoint of the authorization server
     * implementation received from a client application.
     *
     * @return string|null
     *     The request parameters of a backchannel authentication request in
     *     `application/x-www-form-urlencoded` format.
     */
    public function getParameters(): ?string
    {
        return $this->parameters;
    }


    /**
     * Set the value of `parameters` which is the request parameters that the
     * backchannel authentication endpoint of the authorization server
     * implementation received from a client application.
     *
     * @param string $parameters
     *     The request parameters of a backchannel authentication request in
     *     `application/x-www-form-urlencoded` format.
     *
     * @return BackchannelAuthenticationRequest
     *     `$this` object.
     */
    public function setParameters(string $parameters): BackchannelAuthenticationRequest
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the client ID extracted from the `Authorization` header of the
     * backchannel authentication request from a client application.
     *
     * @return string|null
     *     The client ID extracted from the `Authorization` header.
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }


    /**
     * Set the client ID extracted from the `Authorization` header of the
     * backchannel authentication request from a client application.
     *
     * @param string $clientId
     *     The client ID extracted from the `Authorization` header.
     *
     * @return BackchannelAuthenticationRequest
     *     `$this` object.
     */
    public function setClientId(string $clientId): BackchannelAuthenticationRequest
    {
        ValidationUtility::ensureNullOrString('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client secret extracted from the `Authorization` header of the
     * backchannel authentication request from a client application.
     *
     * @return string|null
     *     The client secret extracted from the `Authorization` header.
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }


    /**
     * Set the client secret extracted from the `Authorization` header of the
     * backchannel authentication request from a client application.
     *
     * @param string $clientSecret
     *     The client secret extracted from the `Authorization` header.
     *
     * @return BackchannelAuthenticationRequest
     *     `$this` object.
     */
    public function setClientSecret(string $clientSecret): BackchannelAuthenticationRequest
    {
        ValidationUtility::ensureNullOrString('$clientSecret', $clientSecret);

        $this->clientSecret = $clientSecret;

        return $this;
    }


    /**
     * Get the client certificate used in the TLS connection between the client
     * application and the backchannel authentication endpoint of the
     * authorization server.
     *
     * @return string|null
     *     The client certificate.
     */
    public function getClientCertificate(): ?string
    {
        return $this->clientCertificate;
    }


    /**
     * Set the client certificate used in the TLS connection between the client
     * application and the backchannel authentication endpoint of the
     * authorization server.
     *
     * @param string $certificate
     *     The client certificate.
     *
     * @return BackchannelAuthenticationRequest
     *     `$this` object.
     */
    public function setClientCertificate(string $certificate): BackchannelAuthenticationRequest
    {
        ValidationUtility::ensureNullOrString('$certificate', $certificate);

        $this->clientCertificate = $certificate;

        return $this;
    }


    /**
     * Get the certificate path presented by the client during client
     * authentication.
     *
     * @return array|null
     *     The client certificate path. Each element is a string in PEM format.
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
     *     The client certificate path. Each element is a string in PEM format.
     *
     * @return BackchannelAuthenticationRequest
     *     `$this` object.
     */
    public function setClientCertificatePath(array $path = null): BackchannelAuthenticationRequest
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
    public function copyToArray(array &$array): void
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
    }
}

