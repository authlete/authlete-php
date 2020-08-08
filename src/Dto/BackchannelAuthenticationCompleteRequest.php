<?php
//
// Copyright (C) 2020 Authlete, Inc.
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
 * File containing the definition of BackchannelAuthenticationCompleteRequest class.
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
 * Request to Authlete's /api/backchannel/authentication/complete API.
 *
 * After the implementation of the backchannel authentication endpoint returns
 * JSON containing an `auth_req_id` to the client, the authorization server
 * starts a background process that communicates with the authentication device
 * of the end-user. On the authentication device, end-user authentication is
 * performed and the end-user is asked whether they give authorization to the
 * client or not. The authorization server will receive the result of end-user
 * authentication and authorization from the authentication device.
 *
 * After the authorization server receives the result from the authentication
 * device, or even in the case where the server gave up receiving a response
 * from the authentication device for some reasons, the server should call the
 * `/api/backchannel/authentication/complete` API to tell Authlete the result.
 *
 * When the end-user was authenticated and authorization was granted to the
 * client by the end-user, the authorization server should call the API with
 * `"result":"AUTHORIZED"`. In this successful case, the `subject` request
 * parameter is mandatory. If the token delivery mode is "push", the API will
 * generate an access token, an ID token and optionally a refresh token. On the
 * other hand, if the token delivery mode is "poll" or "ping", the API will
 * just update the database record so that `/api/auth/token` API can generate
 * tokens later.
 *
 * When the authorization server received the decision of the end-user from
 * the authentication device and it indicates that the end-user has rejected
 * to give authorization to the client, the authorization server should call
 * the API with `"result":"ACCESS_DENIED"`. In this case, if the token delivery
 * mode is "push", the API will generate an error response that contains the
 * `error` response parameter and optionally the `error_description` and
 * `error_uri` response parameters (if the `errorDescription` and `errorUri`
 * request parameters have been given). On the other hand, if the token
 * delivery mode is "poll" or "ping", the API will just update the database
 * record so that `/api/auth/token` API can generate an error response later.
 * In any token delivery mode, the value of the `error` parameter will become
 * `access_denied`.
 *
 * When the authorization server could not get the result of end-user
 * authentication and authorization from the authentication device for some
 * reasons, the authorization server should call the API with
 * `"result":"TRANSACTION_FAILED"`. In this error case, the API will behave in
 * the same way as in the case of `ACCESS_DENIED`. The only difference is that
 * `expired_token` is used as the value of the `error` parameter.
 *
 * @since 1.8
 */
class BackchannelAuthenticationCompleteRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $ticket           = null;  // string
    private $result           = null;  // \Authlete\Dto\BackchannelAuthenticationCompleteResult
    private $subject          = null;  // string
    private $sub              = null;  // string
    private $authTime         = null;  // string or (64-bit) integer
    private $acr              = null;  // string
    private $claims           = null;  // string
    private $properties       = null;  // array of \Authlete\Dto\Property
    private $scopes           = null;  // array of string
    private $errorDescription = null;  // string
    private $errorUri         = null;  // string


    /**
     * Get the ticket which is necessary to call Authlete's
     * `/api/backchannel/authentication/complete` API.
     * This request parameter is mandatory.
     *
     * @return string
     *     The ticket previously issued from Authlete's
     *     `/api/backchannel/authentication` API.
     */
    public function getTicket()
    {
        return $this->ticket;
    }


    /**
     * Set the ticket which is necessary to call Authlete's
     * `/api/backchannel/authentication/complete` API.
     * This request parameter is mandatory.
     *
     * @param string $ticket
     *     The ticket previously issued from Authlete's
     *     `/api/backchannel/authentication` API.
     *
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setTicket($ticket)
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the result of end-user authentication and authorization.
     * This request parameter is mandatory.
     *
     * @return BackchannelAuthenticationCompleteResult
     *     The result of end-user authentication and authorization.
     */
    public function getResult()
    {
        return $this->result;
    }


    /**
     * Set the result of end-user authentication and authorization.
     * This request parameter is mandatory.
     *
     * @param BackchannelAuthenticationCompleteResult $result
     *     The result of end-user authentication and authorization.
     *
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setResult(BackchannelAuthenticationCompleteResult $result = null)
    {
        $this->result = $result;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application. This request parameter is
     * mandatory when the `result` property holds
     * `BackchannelAuthenticationCompleteResult::$AUTHORIZED`.
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
     * @return string
     *     The subject of the end-user.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application. This request parameter is
     * mandatory when the `result` property holds
     * `BackchannelAuthenticationCompleteResult::$AUTHORIZED`.
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
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setSubject($subject)
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
     * @return string
     *     The value of the `sub` claim.
     */
    public function getSub()
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
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setSub($sub)
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
     * @return integer|string
     *     The time when the authentication of the end-user occurred.
     */
    public function getAuthTime()
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
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setAuthTime($authTime)
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
     * @return string
     *     The authentication context class reference.
     */
    public function getAcr()
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
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setAcr($acr)
    {
        ValidationUtility::ensureNullOrString('$acr', $acr);

        $this->acr = $acr;

        return $this;
    }


    /**
     * Get additional claims which will be embedded in the ID token.
     *
     * @return string
     *     Additional claims in JSON format which will be embedded in the ID
     *     token.
     */
    public function getClaims()
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
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setClaims($claims)
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the extra properties associated with the access token that will
     * be issued.
     *
     * @return Property[]
     *     Extra properties.
     */
    public function getProperties()
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
     * @param array $properties
     *     Extra properties.
     *
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setProperties(array $properties = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', $properties, __NAMESPACE__ . '\Property');

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get scopes associated with the access token. If this property holds a
     * non-null value, the set of scopes will be used instead of the scopes
     * specified in the original backchannel authentication request.
     *
     * @return string[]
     *     Scopes to replace the scopes specified in the original backchannel
     *     authentication request with. If this property holds null,
     *     replacement is not performed.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set scopes associated with the access token. If this property holds a
     * non-null value, the set of scopes will be used instead of the scopes
     * specified in the original backchannel authentication request.
     *
     * Scopes that are not included in the original request can be included.
     *
     * Note that because the CIBA specification requires `openid` as a
     * mandatory scope, `openid` should be always included.
     *
     * @param array $scopes
     *     Scopes to replace the scopes specified in the original backchannel
     *     authentication request with. If this property holds null,
     *     replacement is not performed.
     *
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the description of the error. This corresponds to the
     * `error_description` property in the response to the client.
     *
     * @return string
     *     The description of the error.
     */
    public function getErrorDescription()
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
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setErrorDescription($description)
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->errorDescription = $description;

        return $this;
    }


    /**
     * Get the URI of a document which describes the error in detail. This
     * corresponds to the `error_uri` property in the response to the client.
     *
     * @return string
     *     The URI of a document which describes the error in detail.
     */
    public function getErrorUri()
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
     * To comply with the specification strictly, the description must not
     * include characters outside the set %x20-21 / %x23-5B / %x5D-7E.
     *
     * @param string $uri
     *     The URI of a document which describes the error in detail.
     *
     * @return BackchannelAuthenticationCompleteRequest
     *     `$this` object.
     */
    public function setErrorUri($uri)
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
    public function copyToArray(array &$array)
    {
        $array['ticket']           = $this->ticket;
        $array['result']           = LanguageUtility::toString($this->result);
        $array['subject']          = $this->subject;
        $array['sub']              = $this->sub;
        $array['authTime']         = LanguageUtility::orZero($this->authTime);
        $array['acr']              = $this->acr;
        $array['claims']           = $this->claims;
        $array['properties']       = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['scopes']           = $this->scopes;
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
    public function copyFromArray(array &$array)
    {
        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));

        // result
        $this->setResult(
            BackchannelAuthenticationCompleteResult::valueOf(
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
        $properties = LanguageUtility::getFromArray('properties', $array);
        $this->setProperties(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $properties, __NAMESPACE__ . '\Property'));

        // scopes
        $this->setScopes(
            LanguageUtility::getFromArray('scopes', $array));

        // errorDescription
        $this->setErrorDescription(
            LanguageUtility::getFromArray('errorDescription', $array));

        // errorUri
        $this->setErrorUri(
            LanguageUtility::getFromArray('errorUri', $array));
    }
}
?>
