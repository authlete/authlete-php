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
 * File containing the definition of BackchannelAuthenticationIssueResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/backchannel/authentication/issue API.
 *
 * Authlete's `/api/backchannel/authentication/issue` API returns JSON which
 * can be mapped to this class. The authorization server implementation should
 * retrieve the value of the `action` response parameter (which can be obtained
 * by `getAction()` method of this class) from the response and take the
 * following steps according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationIssueAction::$OK`, it means that Authlete has
 * succeeded in preparing JSON that contains an `auth_req_id`. The JSON should
 * be used as the response body of the response which is returned to the client
 * from the backchannel authentication endpoint. The `getResponseContent()`
 * method returns the JSON.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationIssueAction::$INTERNAL_SERVER_ERROR`, it means
 * that an error occurred in Authlete.
 *
 * From a viewpoint of the client application, this is an error on the server
 * side. Therefore, the authorization server implementation should generate a
 * response to the client application with `500 Internal Server Error` and
 * `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes
 * the error, so it can be used as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationIssueAction::$INVALID_TICKET`, it means that
 * the ticket included in the API call was invalid. For example, it does not
 * exist or has expired.
 *
 * From a viewpoint of the client application, this is an error on the server
 * side. Therefore, the authorization server implementation should generate a
 * response to the client application with `500 Internal Server Error` and
 * `application/json`.
 *
 * You can build an error response in the same way as shown in the description
 * for the case of `INTERNAL_SERVER_ERROR`.
 *
 * @since 1.8
 */
class BackchannelAuthenticationIssueResponse extends ApiResponse
{
    private ?BackchannelAuthenticationIssueAction $action = null;  // \Authlete\Dto\BackchannelAuthenticationIssueAction
    private ?string $responseContent                      = null;
    private ?string $authReqId                            = null;
    private string|int|null $expiresIn                    = null;
    private int $interval                                 = 0;


    /**
     * Get the next action that the authorization server should take.
     *
     * @return BackchannelAuthenticationIssueAction|null
     *     The next action that the authorization server should take.
     */
    public function getAction(): ?BackchannelAuthenticationIssueAction
    {
        return $this->action;
    }


    /**
     * ßet the next action that the authorization server should take.
     *
     * @param BackchannelAuthenticationIssueAction|null $action
     *     The next action that the authorization server should take.
     *
     * @return BackchannelAuthenticationIssueResponse
     *     `$this` object.
     */
    public function setAction(BackchannelAuthenticationIssueAction $action = null): BackchannelAuthenticationIssueResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the content that can be used to generate a response to the client
     * application. Its format is JSON.
     *
     * @return string|null
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the content that can be used to generate a response to the client
     * application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return BackchannelAuthenticationIssueResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): BackchannelAuthenticationIssueResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the issued authentication request ID. This corresponds to the
     * `auth_req_id` property in the response to the client.
     *
     * @return string|null
     *         The issued authentication request ID (`auth_req_id`).
     */
    public function getAuthReqId(): ?string
    {
        return $this->authReqId;
    }


    /**
     * Set the issued authentication request ID. This corresponds to the
     * `auth_req_id` property in the response to the client.
     *
     * @param string $authReqId
     *         The issued authentication request ID (`auth_req_id`).
     *
     * @return BackchannelAuthenticationIssueResponse
     *     `$this` object.
     */
    public function setAuthReqId(string $authReqId): BackchannelAuthenticationIssueResponse
    {
        ValidationUtility::ensureNullOrString('$authReqId', $authReqId);

        $this->authReqId = $authReqId;

        return $this;
    }


    /**
     * Get the duration of the issued authentication request ID in seconds.
     * This corresponds to the `expires_in` property in the response to the
     * client.
     *
     * @return int|string|null
     *     The duration of the issued authentication request ID in seconds
     *     (`expires_in`).
     */
    public function getExpiresIn(): int|string|null
    {
        return $this->expiresIn;
    }


    /**
     * Set the duration of the issued authentication request ID in seconds.
     * This corresponds to the `expires_in` property in the response to the
     * client.
     *
     * @param integer|string $expiresIn
     *     The duration of the issued authentication request ID in seconds
     *     (`expires_in`).
     *
     * @return BackchannelAuthenticationIssueResponse
     *     `$this` object.
     */
    public function setExpiresIn(int|string $expiresIn): BackchannelAuthenticationIssueResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresIn', $expiresIn);

        $this->expiresIn = $expiresIn;

        return $this;
    }


    /**
     * Get the minimum amount of time in seconds that the client must wait for
     * between polling requests to the token endpoint. This corresponds to the
     * `interval` property in the response to the client.
     *
     * The value returned from this method has no meaning when the backchannel
     * token delivery mode is "push".
     *
     * @return integer
     *     The minimum amount of time in seconds between polling requests.
     */
    public function getInterval(): int
    {
        return $this->interval;
    }


    /**
     * Set the minimum amount of time in seconds that the client must wait for
     * between polling requests to the token endpoint. This corresponds to the
     * `interval` property in the response to the client.
     *
     * @param integer $interval
     *     The minimum amount of time in seconds between polling requests.
     *
     * @return BackchannelAuthenticationIssueResponse
     *     `$this` object.
     */
    public function setInterval(int $interval): BackchannelAuthenticationIssueResponse
    {
        ValidationUtility::ensureInteger('$interval', $interval);

        $this->interval = $interval;

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

        $array['action']          = LanguageUtility::toString($this->action);
        $array['responseContent'] = $this->responseContent;
        $array['authReqId']       = $this->authReqId;
        $array['expiresIn']       = LanguageUtility::orZero($this->expiresIn);
        $array['interval']        = LanguageUtility::orZero($this->interval);
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

        // action
        $this->setAction(
            BackchannelAuthenticationIssueAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // authReqId
        $this->setAuthReqId(
            LanguageUtility::getFromArray('authReqId', $array));

        // expiresIn
        $this->setExpiresIn(
            LanguageUtility::getFromArray('expiresIn', $array));

        // interval
        $this->setInterval(
            LanguageUtility::getFromArray('interval', $array));
    }
}

