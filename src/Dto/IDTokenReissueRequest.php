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
 * File containing the definition of IDTokenReissueRequest class.
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
 * A request to Authlete's `/idtoken/reissue` API.
 *
 * The API is expected to be called only when the value of the `action`
 * parameter in a response from the `/auth/token` API is `ID_TOKEN_REISSUABLE`.
 * The purpose of the `/idtoken/reissue` API is to generate a token response
 * that includes a new ID token together with a new access token and a refresh
 * token.
 *
 * @since 1.13.0
 */
class IDTokenReissueRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $accessToken     = null;  // string
    private $refreshToken    = null;  // string
    private $sub             = null;  // string
    private $claims          = null;  // string
    private $idtHeaderParams = null;  // string
    private $idTokenAudType  = null;  // string


    /**
     * Get the access token.
     *
     * The value of this parameter should be (a) the value of the `jwtAccessToken`
     * parameter in a response from the `/auth/token` API when the value is
     * available, or (b) the value of the `accessToken` parameter in the response
     * from the `/auth/token` API when the value of the `jwtAccessToken` parameter
     * is not available.
     *
     * @return string
     *     The access token that has been newly issued as the result of the
     *     `/auth/token` API call.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the access token.
     *
     * The value of this parameter should be (a) the value of the `jwtAccessToken`
     * parameter in a response from the `/auth/token` API when the value is
     * available, or (b) the value of the `accessToken` parameter in the response
     * from the `/auth/token` API when the value of the `jwtAccessToken` parameter
     * is not available.
     *
     * @param string $accessToken
     *     The access token that has been newly issued as the result of the
     *     `/auth/token` API call.
     *
     * @return IDTokenReissueRequest
     *     `$this` object.
     */
    public function setAccessToken($accessToken)
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the refresh token.
     *
     * The value of this parameter should be the value of the `refreshToken`
     * parameter in a response from the `/auth/token` API.
     *
     * @return string
     *     The refresh token that has been prepared as the result of the
     *     `/auth/token` API call. It may be a new refresh token or the same
     *     refresh token included in the token request, depending on the
     *     service configuration.
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }


    /**
     * Set the refresh token.
     *
     * The value of this parameter should be the value of the `refreshToken`
     * parameter in a response from the `/auth/token` API.
     *
     * @param string $refreshToken
     *     The refresh token that has been prepared as the result of the
     *     `/auth/token` API call. It may be a new refresh token or the same
     *     refresh token included in the token request, depending on the
     *     service configuration.
     *
     * @return IDTokenReissueRequest
     *     `$this` object.
     */
    public function setRefreshToken($refreshToken)
    {
        ValidationUtility::ensureNullOrString('$refreshToken', $refreshToken);

        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Get the value that should be used as the value of the `sub` claim of
     * the ID token.
     *
     * This parameter is optional. When omitted, the value of the subject
     * associated with the access token is used.
     *
     * @return string
     *     The value that should be used as the value of the `sub` claim of
     *     the ID token.
     */
    public function getSub()
    {
        return $this->sub;
    }


    /**
     * Set the value that should be used as the value of the `sub` claim of
     * the ID token.
     *
     * This parameter is optional. When omitted, the value of the subject
     * associated with the access token is used.
     *
     * @param string $sub
     *     The value that should be used as the value of the `sub` claim of
     *     the ID token.
     *
     * @return IDTokenReissueRequest
     *     `$this` object.
     */
    public function setSub($sub)
    {
        ValidationUtility::ensureNullOrString('$sub', $sub);

        $this->sub = $sub;

        return $this;
    }


    /**
     * Get additional claims that should be embedded in the payload part of
     * the ID token. The format is a JSON object.
     *
     * This parameter is optional.
     *
     * @return string
     *     Additional claims that should be embedded in the payload part of
     *     the ID token.
     */
    public function getClaims()
    {
        return $this->claims;
    }


    /**
     * Set additional claims that should be embedded in the payload part of
     * the ID token. The format is a JSON object.
     *
     * This parameter is optional.
     *
     * @param string $claims
     *     Additional claims that should be embedded in the payload part of
     *     the ID token.
     *
     * @return IDTokenReissueRequest
     *     `$this` object.
     */
    public function setClaims($claims)
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get additional parameters that should be embedded in the JWS header of
     * the ID token. The format is a JSON object.
     *
     * This parameter is optional.
     *
     * @return string
     *     Additional parameters that should be embedded in the JWS header of
     *     the ID token.
     */
    public function getIdtHeaderParams()
    {
        return $this->idtHeaderParams;
    }


    /**
     * Set additional parameters that should be embedded in the JWS header of
     * the ID token. The format is a JSON object.
     *
     * This parameter is optional.
     *
     * @param string $params
     *     Additional parameters that should be embedded in the JWS header of
     *     the ID token.
     *
     * @return IDTokenReissueRequest
     *     `$this` object.
     */
    public function setIdtHeaderParams($params)
    {
        ValidationUtility::ensureNullOrString('$params', $params);

        $this->idtHeaderParams = $params;

        return $this;
    }


    /**
     * Get the type of the `aud` claim of the ID token being issued.
     *
     * Valid values of this parameter are as follows.
     *
     * `'array'`: The type of the `aud` claim becomes an array of strings.
     *
     * `'string`: The type of the `aud` claim becomes a single string.
     *
     * This parameter is optional, and the default value on omission is `'array'`.
     *
     * This parameter takes precedence over the `idTokenAudType` property of
     * `Service`.
     *
     * @return string
     *     The type of the `aud` claim of the ID token.
     */
    public function getIdTokenAudType()
    {
        return $this->idTokenAudType;
    }


    /**
     * Set the type of the `aud` claim of the ID token being issued.
     *
     * Valid values of this parameter are as follows.
     *
     * `'array'`: The type of the `aud` claim becomes an array of strings.
     *
     * `'string`: The type of the `aud` claim becomes a single string.
     *
     * This parameter is optional, and the default value on omission is `'array'`.
     *
     * This parameter takes precedence over the `idTokenAudType` property of
     * `Service`.
     *
     * @param string $type
     *     The type of the `aud` claim of the ID token.
     *
     * @return IDTokenReissueRequest
     *     `$this` object.
     */
    public function setIdTokenAudType($type)
    {
        ValidationUtility::ensureNullOrString('$type', $type);

        $this->idTokenAudType = $type;

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
        $array['accessToken']     = $this->accessToken;
        $array['refreshToken']    = $this->refreshToken;
        $array['sub']             = $this->sub;
        $array['claims']          = $this->claims;
        $array['idtHeaderParams'] = $this->idtHeaderParams;
        $array['idTokenAudType']  = $this->idTokenAudType;
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
        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // refreshToken
        $this->setRefreshToken(
            LanguageUtility::getFromArray('refreshToken', $array));

        // sub
        $this->setSub(
            LanguageUtility::getFromArray('sub', $array));

        // claims
        $this->setClaims(
            LanguageUtility::getFromArray('claims', $array));

        // idtHeaderParams
        $this->setIdtHeaderParams(
            LanguageUtility::getFromArray('idtHeaderParams', $array));

        // idTokenAudType
        $this->setIdTokenAudType(
            LanguageUtility::getFromArray('idTokenAudType', $array));
    }
}
?>
