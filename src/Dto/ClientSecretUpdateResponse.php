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
 * File containing the definition of ClientSecretUpdateResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/client/secret/update API.
 */
class ClientSecretUpdateResponse extends ApiResponse
{
    private ?string $newClientSecret = null;
    private ?string $oldClientSecret = null;


    /**
     * Get the new client secret.
     *
     * @return string|null
     *     The new client secret.
     */
    public function getNewClientSecret(): ?string
    {
        return $this->newClientSecret;
    }


    /**
     * Set the new client secret.
     *
     * @param string $secret
     *     The new client secret.
     *
     * @return ClientSecretUpdateResponse
     *     `$this` object.
     */
    public function setNewClientSecret(string $secret): ClientSecretUpdateResponse
    {
        ValidationUtility::ensureNullOrString('$secret', $secret);

        $this->newClientSecret = $secret;

        return $this;
    }


    /**
     * Get the old client secret.
     *
     * @return string|null
     *     The old client secret.
     */
    public function getOldClientSecret(): ?string
    {
        return $this->oldClientSecret;
    }


    /**
     * Set the old client secret.
     *
     * @param string $secret
     *     The old client secret.
     *
     * @return ClientSecretUpdateResponse
     *     `$this` object.
     */
    public function setOldClientSecret(string $secret): ClientSecretUpdateResponse
    {
        ValidationUtility::ensureNullOrString('$secret', $secret);

        $this->oldClientSecret = $secret;

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
        parent::copyToArray($array);

        $array['newClientSecret'] = $this->newClientSecret;
        $array['oldClientSecret'] = $this->oldClientSecret;
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
        parent::copyFromArray($array);

        // newClientSecret
        $this->setNewClientSecret(
            LanguageUtility::getFromArray('newClientSecret', $array));

        // oldClientSecret
        $this->setOldClientSecret(
            LanguageUtility::getFromArray('oldClientSecret', $array));
    }
}

