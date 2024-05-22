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
 * File containing the definition of TokenFailResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/token/fail API.
 *
 * Authlete's `/api/auth/token/fail` API returns JSON which can be mapped
 * to this class. The authorization server implementation should retrieve
 * the value of the `action` parameter (which can be obtained by
 * `getAction()` method of this class) from the response and the take the
 * following steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `TokenFailAction::$INTERNAL_SERVER_ERROR`, it means that the request
 * from the authorization server (`AuthorizationFailRequest`) was wrong or
 * that an error occurred in Authlete. In either case, from a viewpoint of
 * the client application, it is an error on the server side. Therefore,
 * the authorization server implementation should generate a response to
 * the client application with the HTTP status of
 * `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
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
 * When the value returned from `getAction()` method is
 * `TokenFailAction::$BAD_REQUEST`, it means that Authlete's
 * `/api/auth/token/fail` API successfully generated an error response for
 * the client application. The HTTP status of the response returned to the
 * client application must be `400 Bad Request` and the content type must
 * be `application/json`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 */
class TokenFailResponse extends ApiResponse
{
    private ?TokenFailAction $action          = null;
    private ?string          $responseContent = null;


    /**
     * Get the next action that the token endpoint implementation should take.
     *
     * @return TokenFailAction|null
     *     The next action that the token endpoint implementation should take.
     */
    public function getAction(): ?TokenFailAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the token endpoint implementation should take.
     *
     * @param TokenFailAction|null $action
     *     The next action that the token endpoint implementation should take.
     *
     * @return TokenFailResponse
     *     `$this` object.
     */
    public function setAction(TokenFailAction $action = null): TokenFailResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used as the entity body of the
     * response returned to the client application.
     *
     * @return string|null
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as the entity body of the
     * response returned to the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return TokenFailResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): TokenFailResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

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
            TokenFailAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));
    }
}

