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
 * File containing the definition of UserInfoRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/userinfo API.
 */
class UserInfoRequest implements ArrayCopyable, Jsonable
{
    use JsonTrait;


    private $token = null;  // string


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
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyToArray(array &$array)
    {
        $array['token'] = $this->token;
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
    }
}
?>