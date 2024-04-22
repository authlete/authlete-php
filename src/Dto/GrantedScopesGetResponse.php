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
 * File containing the definition of GrantedScopesGetResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/client/granted_scopes/get/{clientId} API.
 */
class GrantedScopesGetResponse extends ApiResponse
{
    private string|int|null $serviceApiKey = null;  // string or (64-bit) integer
    private string|int|null $clientId      = null;  // string or (64-bit) integer
    private ?string $subject               = null;  // string
    private ?array $latestGrantedScopes    = null;  // array of string
    private ?array $mergedGrantedScopes    = null;  // array of string
    private string|int|null $modifiedAt    = null;  // string or (64-bit) integer


    /**
     * Get the API key of the service.
     *
     * @return int|string|null
     *     The API key of the service. (64-bit integer if your PHP system can
     *     handle 64-bit integers.)
     */
    public function getServiceApiKey(): int|string|null
    {
        return $this->serviceApiKey;
    }


    /**
     * Set the API key of the service.
     *
     * @param integer|string $serviceApiKey
     *     The API key of the service.
     *
     * @return GrantedScopesGetResponse
     *     `$this` object.
     */
    public function setServiceApiKey(int|string $serviceApiKey): GrantedScopesGetResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$serviceApiKey', $serviceApiKey);

        $this->serviceApiKey = $serviceApiKey;

        return $this;
    }


    /**
     * Get the ID of the client application.
     *
     * @return int|string|null
     *     The ID of the client application. (64-bit integer if your PHP
     *     system can handle 64-bit integers.)
     */
    public function getClientId(): int|string|null
    {
        return $this->clientId;
    }


    /**
     * Set the ID of the client application.
     *
     * @param integer|string $clientId
     *     The ID of the client application. (64-bit integer if your PHP
     *     system can handle 64-bit integers.)
     *
     * @return GrantedScopesGetResponse
     *     `$this` object.
     */
    public function setClientId(int|string $clientId): GrantedScopesGetResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @return string|null
     *     The subject (= unique identifer) of the end-user.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @param string $subject
     *     The subject (= unique identifer) of the end-user.
     *
     * @return GrantedScopesGetResponse
     *     `$this` object.
     */
    public function setSubject(string $subject): GrantedScopesGetResponse
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the scopes granted to the client application by the last
     * authorization process by the end-user (who is identified by the
     * subject).
     *
     * `null` means that there is no record about granted scopes. An empty
     * array means that there exists a record about granted scopes but no
     * scope has been granted to the client application. If the returned
     * array holds some elements, they are the scopes granted to the client
     * application by the last authorization process.
     *
     * @return array|null
     *     The scopes granted to the client application by the last
     *     authorization process by the end-user.
     */
    public function getLatestGrantedScopes(): ?array
    {
        return $this->latestGrantedScopes;
    }


    /**
     * Set the scopes granted to the client application by the last
     * authorization process by the end-user (who is identified by the
     * subject).
     *
     * @param string[] $scopes
     *     The scopes granted to the client application by the last
     *     authorization process by the end-user.
     *
     * @return GrantedScopesGetResponse
     *     `$this` object.
     */
    public function setLatestGrantedScopes(array $scopes = null): GrantedScopesGetResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->latestGrantedScopes = $scopes;

        return $this;
    }


    /**
     * Get the scopes granted to the client application by all the past
     * authorization processes.
     *
     * `null` means that there is no record about granted scopes. An empty
     * array means that there exists a record about granted scopes but no
     * scope has been granted to the client application. If the returned
     * array holds some elements, they are the scopes granted to the client
     * application by all the last authorization processes.
     *
     * Note that revoked scopes are not included.
     *
     * @return array|null
     *     The scopes granted to the client application by all the past
     *     authorization processes.
     */
    public function getMergedGrantedScopes(): ?array
    {
        return $this->mergedGrantedScopes;
    }


    /**
     * Set the scopes granted to the client application by all the past
     * authorization processes.
     *
     * @param string[] $scopes
     *     The scopes granted to the client application by all the past
     *     authorization processes.
     *
     * @return GrantedScopesGetResponse
     *     `$this` object.
     */
    public function setMergedGrantedScopes(array $scopes = null): GrantedScopesGetResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->mergedGrantedScopes = $scopes;

        return $this;
    }


    /**
     * Get the timestamp in milliseconds since the Unix epoch (1970-Jan-1)
     * at which the record was modified.
     *
     * @return int|string|null
     *     The timestamp at which the record was modified. (64-bit integer
     *     if your PHP system can handle 64-bit integers.)
     */
    public function getModifiedAt(): int|string|null
    {
        return $this->modifiedAt;
    }


    /**
     * Set the timestamp in milliseconds since the Unix epoch (1970-Jan-1)
     * at which the record was modified.
     *
     * @param integer|string $modifiedAt
     *     The timestamp at which the record was modified. (64-bit integer
     *     if your PHP system can handle 64-bit integers.)
     *
     * @return GrantedScopesGetResponse
     *     `$this` object.
     */
    public function setModifiedAt(int|string $modifiedAt): GrantedScopesGetResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$modifiedAt', $modifiedAt);

        $this->modifiedAt = $modifiedAt;

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

        $array['serviceApiKey']       = $this->serviceApiKey;
        $array['clientId']            = $this->clientId;
        $array['subject']             = $this->subject;
        $array['latestGrantedScopes'] = $this->latestGrantedScopes;
        $array['mergedGrantedScopes'] = $this->mergedGrantedScopes;
        $array['modifiedAt']          = LanguageUtility::orZero($this->modifiedAt);
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

        // serviceApiKey
        $this->setServiceApiKey(
            LanguageUtility::getFromArray('serviceApiKey', $array));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // latestGrantedScopes
        $_latest_granted_scopes = LanguageUtility::getFromArray('latestGrantedScopes', $array);
        $this->setLatestGrantedScopes($_latest_granted_scopes);

        // mergedGrantedScopes
        $_merged_granted_scopes = LanguageUtility::getFromArray('mergedGrantedScopes', $array);
        $this->setMergedGrantedScopes($_merged_granted_scopes);

        // modifiedAt
        $this->setModifiedAt(
            LanguageUtility::getFromArray('modifiedAt', $array));
    }
}
