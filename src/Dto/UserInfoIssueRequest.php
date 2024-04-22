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
 * File containing the definition of UserInfoIssueRequest class.
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
 * Request to Authlete's /api/auth/userinfo/issue API.
 */
class UserInfoIssueRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $token  = null;
    private ?string $claims = null;
    private ?string $sub    = null;


    /**
     * Get the access token contained in the UserInfo request from the client
     * application to the UserInfo endpoint.
     *
     * @return string
     *     The access token contained in the UserInfo request.
     */
    public function getToken(): ?string
    {
        return $this->token;
    }


    /**
     * Set the access token contained in the UserInfo request from the client
     * application to the UserInfo endpoint.
     *
     * @param string $token
     *     The access token contained in the UserInfo request.
     *
     * @return UserInfoIssueRequest
     *     `$this` object.
     */
    public function setToken(string $token): UserInfoIssueRequest
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->token = $token;

        return $this;
    }


    /**
     * Get the claims of the subject.
     *
     * @return string
     *     The claims of the subject in JSON format.
     */
    public function getClaims(): ?string
    {
        return $this->claims;
    }


    /**
     * Set the claims of the subject.
     *
     * This request parameter is optional.
     *
     * The implementation of your service is required to retrieve claims of
     * the subject (= information about the end-user) from its database and
     * format them into JSON.
     *
     * For example, if `given_name` claim, `family_name` claim and `email`
     * claim are requested, the implementation should generate a JSON object
     * like the following, and then set its string representation by this
     * `setClaims()` method.
     *
     * ```
     * {
     *   "given_name": "Takahiko",
     *   "family_name": "Kawasaki",
     *   "email": "takahiko.kawasaki@example.com"
     * }
     * ```
     *
     * See [5.1. Standard Claims](https://openid.net/specs/openid-connect-core-1_0.html#StandardClaims)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for further details about the format.
     *
     * @param string $claims
     *     The claims of the subject in JSON format.
     *
     * @return UserInfoIssueRequest
     *     `$this` object.
     */
    public function setClaims(string $claims): UserInfoIssueRequest
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the value of the "sub" claim.
     *
     * @return string
     *     The value of the `sub` claim.
     */
    public function getSub(): ?string
    {
        return $this->sub;
    }


    /**
     * Set the value of the "sub" claim.
     *
     * This request parameter is optional.
     *
     * If a non-empty value is given, it is used as the value of the `sub`
     * claim. Otherwise, the value of the subject associated with the access
     * token is used.
     *
     * @param string $sub
     *     The value of the `sub` claim.
     *
     * @return UserInfoIssueRequest
     *     `$this` object.
     */
    public function setSub(string $sub): UserInfoIssueRequest
    {
        ValidationUtility::ensureNullOrString('$sub', $sub);

        $this->sub = $sub;

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
        $array['token']  = $this->token;
        $array['claims'] = $this->claims;
        $array['sub']    = $this->sub;
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

        // claims
        $this->setClaims(
            LanguageUtility::getFromArray('claims', $array));

        // sub
        $this->setSub(
            LanguageUtility::getFromArray('sub', $array));
    }
}

