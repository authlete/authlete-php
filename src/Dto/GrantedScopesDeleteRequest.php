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
 * File containing the definition of GrantedScopesDeleteRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/client/granted_scopes/delete/{clientId} API.
 *
 * The API deletes database records about the set of scopes that an end-user
 * has granted to a client application.
 */
class GrantedScopesDeleteRequest implements ArrayCopyable, Jsonable
{
    use JsonTrait;


    private $subject = null;  // string


    /**
     * Get the subject (= unique identifier) of the end-user.
     *
     * @return string
     *     The subject (= unique identifier) of the end-user.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user.
     *
     * @param string $subject
     *     The subject (= unique identifier) of the end-user.
     *
     * @return GrantedScopesDeleteRequest
     *     `$this` object.
     */
    public function setSubject($subject)
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
    public function copyToArray(array &$array)
    {
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
    public function copyFromArray(array &$array)
    {
        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));
    }
}
?>
