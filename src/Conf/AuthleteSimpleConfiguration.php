<?php
//
// Copyright (C) 2018 Authlete, Inc.
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
 * File containing the definition of AuthleteSimpleConfiguration class.
 */


namespace Authlete\Conf;


use Authlete\Util\ValidationUtility;


/**
 * A simple implementation of the \Authlete\Conf\AuthleteConfiguration
 * interface.
 */
class AuthleteSimpleConfiguration implements AuthleteConfiguration
{
    use AuthleteConfigurationTrait;


    /**
     * Set the base URL of an Authlete server.
     *
     * @param string $baseUrl
     *     The base URL of an Authlete server.
     *
     * @return AuthleteSimpleConfiguration
     *     `$this` object.
     */
    public function setBaseUrl(string $baseUrl): static
    {
        ValidationUtility::ensureNullOrString('$baseUrl', $baseUrl);

        $this->baseUrl = $baseUrl;

        return $this;
    }


    /**
     * Set the API key of a service owner.
     *
     * @param string $apiKey
     *     The API key of a service owner.
     *
     * @return AuthleteSimpleConfiguration
     *     `$this` object.
     */
    public function setServiceOwnerApiKey(string $apiKey): static
    {
        ValidationUtility::ensureNullOrString('$apiKey', $apiKey);

        $this->serviceOwnerApiKey = $apiKey;

        return $this;
    }


    /**
     * Set the API secret of a service owner.
     *
     * @param string $apiSecret
     *     The API secret of a service owner.
     *
     * @return AuthleteSimpleConfiguration
     *     `$this` object.
     */
    public function setServiceOwnerApiSecret(string $apiSecret): static
    {
        ValidationUtility::ensureNullOrString('$apiSecret', $apiSecret);

        $this->serviceOwnerApiSecret = $apiSecret;

        return $this;
    }


    /**
     * Set the API key of a service.
     *
     * @param string $apiKey
     *     The API key of a service.
     *
     * @return AuthleteSimpleConfiguration
     *     `$this` object.
     */
    public function setServiceApiKey(string $apiKey): static
    {
        ValidationUtility::ensureNullOrString('$apiKey', $apiKey);

        $this->serviceApiKey = $apiKey;

        return $this;
    }


    /**
     * Set the API secret of a service.
     *
     * @param string $apiSecret
     *     The API secret of a service.
     *
     * @return AuthleteSimpleConfiguration
     *     `$this` object.
     */
    public function setServiceApiSecret(string $apiSecret): static
    {
        ValidationUtility::ensureNullOrString('$apiSecret', $apiSecret);

        $this->serviceApiSecret = $apiSecret;

        return $this;
    }


    /**
     * Set the Service access token,
     *
     * @param string $accessToken
     *     The Service Access Token
     *
     * @return AuthleteSimpleConfiguration
     *     `$this` object.
     */
    public function setServiceAccessToken(string $accessToken): static
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);
        $this->serviceAccessToken = $accessToken;
        return $this;
    }
}

