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
 * File containing the definition of DeviceAuthorizationRequest class.
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
 * Request to Authlete's /api/device/authorization API.
 *
 * When the implementation of the device authorization endpoint of the
 * authorization server receives a device authorization request from a
 * client application, the first step is to call Authlete's
 * `/api/device/authorization` API. The API will parse the device
 * authorization request on behalf of the implementation of the device
 * authorization endpoint.
 *
 * @since 1.8
 */
class DeviceAuthorizationRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $parameters            = null;  // string
    private $clientId              = null;  // string
    private $clientSecret          = null;  // string
    private $clientCertificate     = null;  // string
    private $clientCertificatePath = null;  // array of string


    /**
     * Get the value of `parameters` which is the request parameters that the
     * device authorization endpoint of the authorization server implementation
     * received from a client application.
     *
     * @return string
     *     The request parameters of a device authorization request in
     *     `application/x-www-form-urlencoded` format.
     */
    public function getParameters()
    {
        return $this->parameters;
    }


    /**
     * Set the value of `parameters` which is the request parameters that the
     * device authorization endpoint of the authorization server implementation
     * received from a client application.
     *
     * @param string $parameters
     *     The request parameters of a device authorization request in
     *     `application/x-www-form-urlencoded` format.
     *
     * @return DeviceAuthorizationRequest
     *     `$this` object.
     */
    public function setParameters($parameters)
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the client ID extracted from the `Authorization` header of the
     * device authorization request from a client application.
     *
     * @return string
     *     The client ID extracted from the `Authorization` header.
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set the client ID extracted from the `Authorization` header of the
     * device authorization request from a client application.
     *
     * @param string $clientId
     *     The client ID extracted from the `Authorization` header.
     *
     * @return DeviceAuthorizationRequest
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrString('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client secret extracted from the `Authorization` header of the
     * device authorization request from a client application.
     *
     * @return string
     *     The client secret extracted from the `Authorization` header.
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }


    /**
     * Set the client secret extracted from the `Authorization` header of the
     * device authorization request from a client application.
     *
     * @param string $clientSecret
     *     The client secret extracted from the `Authorization` header.
     *
     * @return DeviceAuthorizationRequest
     *     `$this` object.
     */
    public function setClientSecret($clientSecret)
    {
        ValidationUtility::ensureNullOrString('$clientSecret', $clientSecret);

        $this->clientSecret = $clientSecret;

        return $this;
    }


    /**
     * Get the client certificate used in the TLS connection between the client
     * application and the device authorization endpoint of the authorization
     * server.
     *
     * @return string
     *     The client certificate.
     */
    public function getClientCertificate()
    {
        return $this->clientCertificate;
    }


    /**
     * Set the client certificate used in the TLS connection between the client
     * application and the device authorization endpoint of the authorization
     * server.
     *
     * @param string $certificate
     *     The client certificate.
     *
     * @return DeviceAuthorizationRequest
     *     `$this` object.
     */
    public function setClientCertificate($certificate)
    {
        ValidationUtility::ensureNullOrString('$certificate', $certificate);

        $this->clientCertificate = $certificate;

        return $this;
    }


    /**
     * Get the certificate path presented by the client during client
     * authentication.
     *
     * @return string[]
     *     The client certificate path. Each element is a string in PEM format.
     */
    public function getClientCertificatePath()
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
     * @return DeviceAuthorizationRequest
     *     `$this` object.
     */
    public function setClientCertificatePath(array $path = null)
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
?>
