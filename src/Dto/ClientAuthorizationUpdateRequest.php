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
 * File containing the definition of ClientAuthorizationUpdateRequest class.
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
 * Request to Authlete's /api/client/authorization/update/{clientId} API.
 *
 * The API updates attributes of all existing access tokens issued to a
 * client application by an end-user.
 */
class ClientAuthorizationUpdateRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $subject = null;
    private ?array $scopes   = null;


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @return string|null
     *     The subject of the end-user.
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
     *     The subject of the end-user.
     *
     * @return ClientAuthorizationUpdateRequest
     *     `$this` object.
     */
    public function setSubject(string $subject): ClientAuthorizationUpdateRequest
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get a new set of scopes assigned to existing access tokens.
     *
     * @return string[]|null
     *     A new set of scopes assiged to existing access tokens.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set a new set of scopes assigned to existing access tokens.
     *
     * @param string[] $scopes
     *     A new set of scopes assiged to existing access tokens. If `null`
     *     is given, the scope set associated with existing access tokens
     *     will not be changed.
     */
    public function setScopes(array $scopes = null): static
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

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
        $array['subject'] = $this->subject;
        $array['scopes']  = $this->scopes;
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
        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);
    }
}

