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
 * File containing the definition of AuthorizedClientListResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/client/authorization/get/list API.
 */
class AuthorizedClientListResponse extends ClientListResponse
{
    private ?string $subject = null;


    /**
     * Get the identifier of the end-user who has granted authorization to
     * the client applications.
     *
     * @return string|null
     *     The identifier of the end-user.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the identifier of the end-user who has granted authorization to
     * the client applications.
     *
     * @param string $subject
     *     The identifier of the end-user.
     *
     * @return AuthorizedClientListResponse
     *     `$this` object.
     */
    public function setSubject(string $subject): AuthorizedClientListResponse
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

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

        $array['subject'] = $this->subject;
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

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));
    }
}

