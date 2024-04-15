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
 * File containing the definition of SnsCredentials class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Types\Sns;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * SNS credentials.
 */
class SnsCredentials implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $sns       = null;  // Sns
    private ?string $apiKey    = null;
    private ?string $apiSecret = null;


    /**
     * Get the identifier of the SNS.
     *
     * @return Sns|null
     *     The identifier of the SNS.
     */
    public function getSns(): ?Sns
    {
        return Sns::valueOf($this->sns);
    }


    /**
     * Set the identifier of the SNS.
     *
     * @param Sns|null $sns
     *     The identifier of the SNS.
     *
     * @return SnsCredentials
     *     `$this` object.
     */
    public function setSns(Sns $sns = null): SnsCredentials
    {
        $this->sns = $sns->value;

        return $this;
    }


    /**
     * Get the API key assigned by the SNS.
     *
     * @return string|null
     *     The API key assigned by the SNS.
     */
    public function getApikey(): ?string
    {
        return $this->apiKey;
    }


    /**
     * Set the API key assigned by the SNS.
     *
     * @param string $apiKey
     *     The API key assigned by the SNS.
     *
     * @return SnsCredentials
     *     `$this` object.
     */
    public function setApiKey(string $apiKey): SnsCredentials
    {
        ValidationUtility::ensureNullOrString('$apiKey', $apiKey);

        $this->apiKey = $apiKey;

        return $this;
    }


    /**
     * Get the API secret assigned by the SNS.
     *
     * @return string|null
     *     The API secret assigned by the SNS.
     */
    public function getApiSecret(): ?string
    {
        return $this->apiSecret;
    }


    /**
     * Set the API secret assigned by the SNS.
     *
     * @param string $apiSecret
     *     The API secret assigned by the SNS.
     *
     * @return SnsCredentials
     *     `$this` object.
     */
    public function setApiSecret(string $apiSecret): SnsCredentials
    {
        ValidationUtility::ensureNullOrString('$apiSecret', $apiSecret);

        $this->apiSecret = $apiSecret;

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
        $array['sns']       = LanguageUtility::toString($this->sns);
        $array['apiKey']    = $this->apiKey;
        $array['apiSecret'] = $this->apiSecret;
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
        // sns
        $this->setSns(
            Sns::valueOf(
                LanguageUtility::getFromArray('sns', $array)));

        // apiKey
        $this->setApiKey(
            LanguageUtility::getFromArray('apiKey', $array));

        // apiSecret
        $this->setApiSecret(
            LanguageUtility::getFromArray('apiSecret', $array));
    }
}

