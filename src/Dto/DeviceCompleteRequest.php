<?php
//
// Copyright (C) 2020-2021 Authlete, Inc.
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
 * File containing the definition of DeviceCompleteRequest class.
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
 * Request to Authlete's /api/device/complete API.
 *
 * In the device flow ([RFC 8628](https://tools.ietf.org/html/rfc8628)), an
 * end-user accesses the verification endpoint of the authorization server
 * where she interacts with the verification endpoint and inputs a user code.
 * The verification endpoint checks if the user code is valid and then asks
 * the end-user whether she approves or rejects the authorization request
 * which the user code represents.
 *
 * After the authorization server receives the decision of the end-user, it
 * should call Authlete's `/api/device/complete` API to tell Authlete the
 * decision.
 *
 * When the end-user was authenticated and authorization was granted to the
 * client by the end-user, the authorization server should call the API with
 * `"result":"AUTHORIZED"`. In this successful case, the `subject` request
 * parameter is mandatory. The API will update the database record so that
 * `/api/auth/token` API can generate an access token later.
 *
 * If the `scope` parameter of the device authorization request included the
 * `openid` scope, an ID token is generated. In this case, `sub`, `authTime`,
 * `acr` and `claims` request parameters in the API call to the
 * `/api/device/complete` API affect the ID token.
 *
 * When the authorization server receives the decision of the end-user and it
 * indicates that she has rejected to give authorization to the client, the
 * authorization server should call the API with `"result":"ACCESS_DENIED"`.
 * In this case, the API will update the database record so that the
 * `/api/auth/token` API can generate an error response later. If
 * `errorDescription` and `errorUri` request parameters are given to the
 * `/api/device/complete` API, they will be used as the values of
 * `error_description` and `error_uri` response parameters in the error
 * response from the token endpoint.
 *
 * When the authorization server could not get decision from the end-user for
 * some reasons, the authorization server should call the API with
 * `"result":"TRANSACTION_FAILED"`. In this error case, the API will behave
 * in the same way as in the case of `ACCESS_DENIED`. The only difference is
 * that `expired_token` is used as the value of the `error` response parameter
 * instead of `access_denied`.
 *
 * @since 1.8
 */
class DeviceCompleteRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?DeviceCompleteResult $result = null;
    private ?string $userCode             = null;
    private ?string $subject              = null;
    private ?string $sub                  = null;
    private string|int|null $authTime     = null;
    private ?string $acr                  = null;
    private ?string $claims               = null;
    private ?array $properties            = null;  // array of \Authlete\Dto\Property
    private ?array $scopes                = null;  // array of string
    private ?string $idtHeaderParams      = null;
    private ?string $errorDescription     = null;
    private ?string $errorUri             = null;


    /**
     * Get the user code input by the end-user.
     *
     * @return string|null
     *     The user code.
     */
    public function getUserCode(): ?string
    {
        return $this->userCode;
    }


    /**
     * Set the user code input by the end-user.
     * This request parameter is mandatory.
     *
     * @param string $code
     *     The user code.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setUserCode(string $code): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->userCode = $code;

        return $this;
    }


    /**
     * Get the result of end-user authentication and authorization.
     *
     * @return DeviceCompleteResult|null
     *     The result of end-user authentication and authorization.
     */
    public function getResult(): ?DeviceCompleteResult
    {
        return $this->result;
    }


    /**
     * Set the result of end-user authentication and authorization.
     * This request parameter is mandatory.
     *
     * @param DeviceCompleteResult|null $result
     *     The result of end-user authentication and authorization.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setResult(DeviceCompleteResult $result = null): DeviceCompleteRequest
    {
        $this->result = $result;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application. This request parameter is
     * mandatory when the `result` property holds
     * `DeviceCompleteResult::$AUTHORIZED`.
     *
     * This `subject` property is used as the value of the subject associated
     * with the access token and as the value of the `sub` claim in the ID
     * token.
     *
     * Note that, if the `sub` property holds a non-null value, it is used as
     * the value of the `sub` claim in the ID token. However, even in the case,
     * the value of the subject associated with the access token is still the
     * value of this `subject` property.
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
     * authorization to the client application. This request parameter is
     * mandatory when the `result` property holds
     * `DeviceCompleteResult::$AUTHORIZED`.
     *
     * This `subject` property is used as the value of the subject associated
     * with the access token and as the value of the `sub` claim in the ID
     * token.
     *
     * Note that, if the `sub` property holds a non-null value, it is used as
     * the value of the `sub` claim in the ID token. However, even in the case,
     * the value of the subject associated with the access token is still the
     * value of this `subject` property.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setSubject(string $subject): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the value of the `sub` claim that should be used in the ID token.
     * If this property holds null or its value is empty, the value held by
     * the `subject` property is used as the value of the `sub` claim. The
     * main purpose of this `sub` property is to hide the actual value of
     * the subject from client applications.
     *
     * Note that the value of the `subject` request parameter is used as the
     * value of the subject associated with the access token regardless of
     * whether this `sub` property is a non-empty value or not. In other words,
     * this `sub` property affects only the `sub` claim in the ID token.
     *
     * @return string|null
     *     The value of the `sub` claim.
     */
    public function getSub(): ?string
    {
        return $this->sub;
    }


    /**
     * Set the value of the `sub` claim that should be used in the ID token.
     * If this property holds null or its value is empty, the value held by
     * the `subject` property is used as the value of the `sub` claim. The
     * main purpose of this `sub` property is to hide the actual value of
     * the subject from client applications.
     *
     * Note that the value of the `subject` request parameter is used as the
     * value of the subject associated with the access token regardless of
     * whether this `sub` property is a non-empty value or not. In other words,
     * this `sub` property affects only the `sub` claim in the ID token.
     *
     * @param string $sub
     *     The value of the `sub` claim.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setSub(string $sub): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$sub', $sub);

        $this->sub = $sub;

        return $this;
    }


    /**
     * Get the time when the authentication of the end-user occurred.
     *
     * The value represents the elapsed time since the Unix epoch
     * (1970-Jan-1) in seconds.
     *
     * @return int|string|null
     *     The time when the authentication of the end-user occurred.
     */
    public function getAuthTime(): int|string|null
    {
        return $this->authTime;
    }


    /**
     * Set the time when the authentication of the end-user occurred.
     *
     * The value should represent the elapsed time since the Unix epoch
     * (1970-Jan-1) in seconds.
     *
     * @param integer|string $authTime
     *     The time when the authentication of the end-user occurred.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setAuthTime(int|string $authTime): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrStringOrInteger('$authTime', $authTime);

        $this->authTime = $authTime;

        return $this;
    }


    /**
     * Get the reference of the authentication context class which the end-user
     * authentication satisfied. When this property holds a non-null value,
     * the value will be used as the value of the `acr` claim in the ID token.
     *
     * @return string|null
     *     The authentication context class reference.
     */
    public function getAcr(): ?string
    {
        return $this->acr;
    }


    /**
     * Set the reference of the authentication context class which the end-user
     * authentication satisfied. When this property holds a non-null value,
     * the value will be used as the value of the `acr` claim in the ID token.
     *
     * @param string $acr
     *     The authentication context class reference.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setAcr(string $acr): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$acr', $acr);

        $this->acr = $acr;

        return $this;
    }


    /**
     * Get additional claims which will be embedded in the ID token.
     *
     * @return string|null
     *     Additional claims in JSON format which will be embedded in the ID
     *     token.
     */
    public function getClaims(): ?string
    {
        return $this->claims;
    }


    /**
     * Set additional claims which will be embedded in the ID token.
     *
     * The authorization server implementation is required to retrieve values
     * of requested claims of the end-user from its database and format them
     * in JSON format.
     *
     * For example, if `given_name` claim, `family_name` claim and `email`
     * claim are requested, the authorization server implementation should
     * generate a JSON object like the following:
     *
     * ```
     * {
     *   "given_name": "Takahiko",
     *   "family_name": "Kawasaki",
     *   "email": "takahiko.kawasaki@example.com"
     * }
     * ```
     *
     * and set its string representation by this method.
     *
     * See [5.1. Standard Claims](https://openid.net/specs/openid-connect-core-1_0.html#StandardClaims)
     * in [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for details about the format.
     *
     * @param string $claims
     *     Additional claims in JSON format which will be embedded in the ID
     *     token.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setClaims(string $claims): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the extra properties associated with the access token that will
     * be issued.
     *
     * @return array|null Extra properties.
     *     Extra properties.
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }


    /**
     * Set the extra properties associated with the access token that will
     * be issued.
     *
     * Keys of extra properties will be used as labels of top-level entries
     * in a JSON response returned from the authorization server. An example
     * is `example_parameter`, which you can find in
     * [5.1. Successful Response](https://tools.ietf.org/html/rfc6749#section-5.1)
     * in RFC 6749. The following code snippet is an example to set one extra
     * property having `example_parameter` as its key and `example_value` as
     * its value.
     *
     * ```
     * $properties = array(
     *     new Property('example_parameter', 'example_value')
     * );
     *
     * $request->setProperties($properties);
     * ```
     *
     * Note that there is an upper limit on the total size of extra properties.
     * On Authlete side, the properties will be (1) converted to a
     * multidimensional string array, (2) converted to JSON, (3) encrypted by
     * AES/CBC/PKCS5Padding, (4) encoded by base64url, and then stored into the
     * database. The length of the resultant string must not exceed 65,535 in
     * bytes. This is the upper limit, but we think it is big enough.
     *
     * @param array|null $properties
     *     Extra properties.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setProperties(array $properties = null): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get scopes associated with the access token. If this property holds a
     * non-null value, the set of scopes will be used instead of the scopes
     * specified in the original device authorization request.
     *
     * @return array|null
     *     Scopes to replace the scopes specified in the original device
     *     authorization request with. If this property holds null,
     *     replacement is not performed.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set scopes associated with the access token. If this property holds a
     * non-null value, the set of scopes will be used instead of the scopes
     * specified in the original device authorization request.
     *
     * Scopes that are not included in the original request can be included.
     *
     * @param array|null $scopes
     *     Scopes to replace the scopes specified in the original device
     *     authorization request with. If this property holds null,
     *     replacement is not performed.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get JSON that represents additional JWS header parameters
     * for the ID token that may be issued from the token endpoint.
     *
     * @return string|null
     *     JSON that represents additional JWS header parameters
     *     for the ID token.
     *
     * @since 1.9
     */
    public function getIdtHeaderParams(): ?string
    {
        return $this->idtHeaderParams;
    }


    /**
     * Set JSON that represents additional JWS header parameters
     * for the ID token that may be issued from the token endpoint.
     *
     * @param string $params
     *     JSON that represents additional JWS header parameters
     *     for the ID token.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     *
     * @since 1.9
     */
    public function setIdtHeaderParams(string $params): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$params', $params);

        $this->idtHeaderParams = $params;

        return $this;
    }


    /**
     * Get the description of the error. This corresponds to the
     * `error_description` property in the response to the client.
     *
     * @return string|null The description of the error.
     *     The description of the error.
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }


    /**
     * Set the description of the error. This corresponds to the
     * `error_description` property in the response to the client.
     *
     * If this optional request parameter is given, its value is used as the
     * value of the `error_description` property, but it is used only when
     * the result is not `AUTHORIZED`.
     *
     * To comply with the specification strictly, the description must not
     * include characters outside the set %x20-21 / %x23-5B / %x5D-7E.
     *
     * @param string $description
     *     The description of the error.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setErrorDescription(string $description): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->errorDescription = $description;

        return $this;
    }


    /**
     * Get the URI of a document which describes the error in detail. This
     * corresponds to the `error_uri` property in the response to the client.
     *
     * @return string|null
     *     The URI of a document which describes the error in detail.
     */
    public function getErrorUri(): ?string
    {
        return $this->errorUri;
    }


    /**
     * Set the URI of a document which describes the error in detail. This
     * corresponds to the `error_uri` property in the response to the client.
     *
     * If this optional request parameter is given, its value is used as the
     * value of the `error_uri` property, but it is used only when the result
     * is not `AUTHORIZED`.
     *
     * @param string $uri
     *     The URI of a document which describes the error in detail.
     *
     * @return DeviceCompleteRequest
     *     `$this` object.
     */
    public function setErrorUri(string $uri): DeviceCompleteRequest
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->errorUri = $uri;

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
        $array['userCode']         = $this->userCode;
        $array['result']           = LanguageUtility::toString($this->result);
        $array['subject']          = $this->subject;
        $array['sub']              = $this->sub;
        $array['authTime']         = LanguageUtility::orZero($this->authTime);
        $array['acr']              = $this->acr;
        $array['claims']           = $this->claims;
        $array['properties']       = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['scopes']           = $this->scopes;
        $array['idtHeaderParams']  = $this->idtHeaderParams;
        $array['errorDescription'] = $this->errorDescription;
        $array['errorUri']         = $this->errorUri;
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
        // userCode
        $this->setUserCode(
            LanguageUtility::getFromArray('userCode', $array));

        // result
        $this->setResult(
            DeviceCompleteResult::valueOf(
                LanguageUtility::getFromArray('result', $array)));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // sub
        $this->setSub(
            LanguageUtility::getFromArray('sub', $array));

        // authTime
        $this->setAuthTime(
            LanguageUtility::getFromArray('authTime', $array));

        // acr
        $this->setAcr(
            LanguageUtility::getFromArray('acr', $array));

        // claims
        $this->setClaims(
            LanguageUtility::getFromArray('claims', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // idtHeaderParams
        $this->setIdtHeaderParams(
            LanguageUtility::getFromArray('idtHeaderParams', $array));

        // errorDescription
        $this->setErrorDescription(
            LanguageUtility::getFromArray('errorDescription', $array));

        // errorUri
        $this->setErrorUri(
            LanguageUtility::getFromArray('errorUri', $array));
    }
}

