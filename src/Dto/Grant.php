<?php
//
// Copyright (C) 2024 Authlete, Inc.
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
 * File containing the definition of Grant class.
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
 * Grant.
 *
 * This class holds the same information as the response from the grant
 * management endpoint on the grant management action `query` does.
 *
 * @since 1.13.0
 */
class Grant implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $scopes               = null;  // array of \Authlete\Dto\GrantScope
    private $claims               = null;  // array of string
    private $authorizationDetails = null;  // \Authlete\Dto\AuthzDetails


    /**
     * Get the grant scopes.
     *
     * @return GrantScope[]
     *     The grant scopes.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the grant scopes.
     *
     * @param GrantScope[] $scopes
     *     The grant scopes.
     *
     * @return Grant
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopes', $scopes, __NAMESPACE__ . '\GrantScope');

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the claims.
     *
     * @return string[]
     *      The claims.
     */
    public function getClaims()
    {
        return $this->claims;
    }


    /**
     * Set the claims.
     *
     * @param string[] $claims
     *     The claims.
     *
     * @return Grant
     *     `$this` object.
     */
    public function setClaims(array $claims = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the authorization details.
     *
     * @return AuthzDetails
     *     The authorization details.
     */
    public function getAuthorizationDetails()
    {
        return $this->authorizationDetails;
    }


    /**
     * Set the authorization details.
     *
     * @param AuthzDetails $details
     *     The authorization details.
     *
     * @return Grant
     *     `$this` object.
     */
    public function setAuthorizationDetails(AuthzDetails $details = null)
    {
        $this->authorizationDetails = $details;

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
        $array['scopes']               = LanguageUtility::convertArrayOfArrayCopyableToArray($this->scopes);
        $array['claims']               = $this->claims;
        $array['authorizationDetails'] = LanguageUtility::convertArrayCopyableToArray($this->authorizationDetails);
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
        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $_scopes = LanguageUtility::convertArrayToArrayOfArrayCopyable($_scopes, __NAMESPACE__ . '\GrantScope');
        $this->setScopes($_scopes);

        // claims
        $_claims = LanguageUtility::getFromArray('claims', $array);
        $this->setClaims($_claims);

        // authorizationDetails
        $_details = LanguageUtility::getFromArray('authorizationDetails', $array);
        $this->setAuthorizationDetails(
            LanguageUtility::convertArrayToArrayCopyable(
                $_details, __NAMESPACE__ . '\AuthzDetails'));
    }
}
?>
