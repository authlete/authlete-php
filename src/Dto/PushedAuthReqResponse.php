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
 * File containing the definition of PushedAuthReqResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/pushed_auth_req API.
 *
 * Authlete's `/api/pushed_auth_req` API returns JSON which can be mapped
 * to this class. The authorization server implementation should retrieve
 * the value of the `action` parameter (which can be obtained by
 * `getAction()` method of this class) from the response and the take the
 * following steps according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `PushedAuthReqAction::$CREATED`, it means that the authorization request
 * has been registered successfully.
 *
 * The authorization server implementation should generate a response to the
 * client application with `201 Created` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which can be used
 * as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 201 Created
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
 * `PushedAuthReqAction::$BAD_REQUEST`, it means that the request was wrong.
 *
 * The authorization server implementation should generate a response to the
 * client application with `400 Bad Request` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
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
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `PushedAuthReqAction::$UNAUTHORIZED`, it means that client authentication
 * of the request failed.
 *
 * The authorization server implementation should generate a response to the
 * client application with `401 Unauthorized` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 401 Unauthorized
 * WWW-Authenticate: (challenge)
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
 * `PushedAuthReqAction::$FORBIDDEN`, it means that the client application
 * is not allowed to use the pushed authorization request endpoint.
 *
 * The authorization server implementation should generate a response to the
 * client application with `403 Forbidden` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 403 Forbidden
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
 * `PushedAuthReqAction::$PAYLOAD_TOO_LARGE`, it means that the size of the
 * pushed authorization request is too large.
 *
 * The authorization server implementation should generate a response to the
 * client application with `413 Payload Too Large` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 413 Payload Too Large
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
 * `PushedAuthReqAction::$INTERNAL_SERVER_ERROR`, it means that the API call
 * from the authorization server implementation was wrong or that an error
 * occurred in Authlete.
 *
 * In either case, from a viewpoint of the client application, it is an error
 * on the server side. Therefore, the authorization server implementation
 * should generate a response to the client application with
 * `500 Internal Server Error` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
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
 * However, it is up to the authorization server's policy whether to return
 * `500` actually.
 *
 * @since 1.8
 */
class PushedAuthReqResponse extends ApiResponse
{
    private ?string $action               = null;  // PushedAuthReqAction
    private ?string $responseContent      = null;
    private ?string $requestUri           = null;


    /**
     * Get the next action that the authorization server should take.
     *
     * @return PushedAuthReqAction|null
     *     The next action that the authorization server should take.
     */
    public function getAction(): ?PushedAuthReqAction
    {
        return PushedAuthReqAction::valueOf($this->action);
    }


    /**
     * Set the next action that the authorization server should take.
     *
     * @param PushedAuthReqAction|null $action
     *     The next action that the authorization server should take.
     *
     * @return PushedAuthReqResponse
     *     `$this` object.
     */
    public function setAction(PushedAuthReqAction $action = null): PushedAuthReqResponse
    {
        $this->action = $action->value;

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
     * @return PushedAuthReqResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): PushedAuthReqResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the request URI created to represent the pushed authorization
     * request. This can be sent by the client as the `request_uri` request
     * parameter in an authorization request.
     *
     * @return string|null
     *     The request URI.
     */
    public function getRequestUri(): ?string
    {
        return $this->requestUri;
    }


    /**
     * Set the request URI created to represent the pushed authorization
     * request. This can be sent by the client as the `request_uri` request
     * parameter in an authorization request.
     *
     * @param string $uri
     *     The response content.
     *
     * @return PushedAuthReqResponse
     *     `$this` object.
     */
    public function setRequestUri(string $uri): PushedAuthReqResponse
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->requestUri = $uri;

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
        $array['requestUri']      = $this->requestUri;
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
            PushedAuthReqAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // requestUri
        $this->setRequestUri(
            LanguageUtility::getFromArray('requestUri', $array));
    }
}

