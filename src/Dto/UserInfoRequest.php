<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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
 * File containing the definition of UserInfoRequest class.
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
 * Request to Authlete's /api/auth/userinfo API.
 */
class UserInfoRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $token             = null;  // string
    private $clientCertificate = null;  // string
    private $dpop              = null;  // string
    private $htm               = null;  // string
    private $htu               = null;  // string


    /**
     * Get the access token that the userinfo endpoint implementation received
     * from the client application.
     *
     * @return string
     *     The access token.
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * Set the access token that the userinfo endpoint implementation received
     * from the client application.
     *
     * @param string $token
     *     The access token.
     *
     * @return UserInfoRequest
     *     `$this` object.
     */
    public function setToken($token)
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->token = $token;

        return $this;
    }


    /**
     * Get the client certificate from the MTLS of the userinfo request from
     * the client application.
     *
     * @return string
     *     The client certificate.
     *
     * @since 1.8
     */
    public function getClientCertificate()
    {
        return $this->clientCertificate;
    }


    /**
     * Set the client certificate from the MTLS of the userinfo request from
     * the client application.
     *
     * @param string $certificate
     *     The client certificate.
     *
     * @return UserInfoRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setClientCertificate($certificate)
    {
        ValidationUtility::ensureNullOrString('$certificate', $certificate);

        $this->clientCertificate = $certificate;

        return $this;
    }


    /**
     * Get the `DPoP` header presented by the client during the request to the
     * userinfo endpoint. This header contains a signed JWT which includes the
     * public key that is paired with the private key used to sign it.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string
     *     The value of the `DPoP` header.
     *
     * @since 1.8
     */
    public function getDpop()
    {
        return $this->dpop;
    }


    /**
     * Set the `DPoP` header presented by the client during the request to the
     * userinfo endpoint. This header contains a signed JWT which includes the
     * public key that is paired with the private key used to sign it.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $dpop
     *     The value of the `DPoP` header.
     *
     * @return UserInfoRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDpop($dpop)
    {
        ValidationUtility::ensureNullOrString('$dpop', $dpop);

        $this->dpop = $dpop;

        return $this;
    }


    /**
     * Get the HTTP method of the userinfo request. This property is used to
     * validate the `DPoP` header.
     *
     * In normal cases, the value is either `GET` or `POST`.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string
     *     The HTTP method. For example, `GET`.
     *
     * @since 1.8
     */
    public function getHtm()
    {
        return $this->htm;
    }


    /**
     * Set the HTTP method of the userinfo request. This property is used to
     * validate the `DPoP` header.
     *
     * In normal cases, the value is either `GET` or `POST`.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $htm
     *     The HTTP method. For example, `GET`.
     *
     * @return UeerInfoRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setHtm($htm)
    {
        ValidationUtility::ensureNullOrString('$htm', $htm);

        $this->htm = $htm;

        return $this;
    }


    /**
     * Get the URL of the userinfo endpoint. This property is used to validate
     * the `DPoP` header.
     *
     * If this request parameter is omitted, the `userInfoEndpoint` property of
     * the `Service` is used as the default value.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string
     *     The URL of the token endpoint.
     *
     * @since 1.8
     */
    public function getHtu()
    {
        return $this->htu;
    }


    /**
     * Set the URL of the userinfo endpoint. This property is used to validate
     * the `DPoP` header.
     *
     * If this request parameter is omitted, the `userInfoEndpoint` property of
     * the `Service` is used as the default value.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $htu
     *     The URL of the token endpoint.
     *
     * @return UserInfoRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setHtu($htu)
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
    public function copyToArray(array &$array)
    {
        $array['token']             = $this->token;
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
    public function copyFromArray(array &$array)
    {
        // token
        $this->setToken(
            LanguageUtility::getFromArray('token', $array));

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
?>
