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
 * File containing the definition of AuthorizationFailResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;
use PhpParser\Node\Scalar\String_;


/**
 * Response from Authlete's /api/auth/authorization/fail API.
 *
 * Authlete's `/api/auth/authorization/fail` API returns JSON which can be
 * mapped to this class. The authorization server implementation should
 * retrieve the value of the `action` response parameter (which can be
 * obtained by `getAction()` method) from the response and take the following
 * steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationFailAction::$INTERNAL_SERVER_ERROR`, it means that the
 * request from the authorization server implementation was wrong or that an
 * error ocurred in Authlete. In either case, from a viewpoint of the client
 * application, it is an error on the server side. Therefore, the
 * authorization server implementation should generate a response to the
 * client application with the HTTP status of `500 Internal Server Error`.
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
 * `AuthorizationFailAction::$BAD_REQUEST`, it means that the ticket is no
 * longer valid (deleted or expired) and that the reason of the invalidity
 * was probably due to the end-user's too-delayed response to the
 * authorization UI.
 *
 * The HTTP status of the response returned to the client application should
 * be `400 Bad Request` and the content type should be `application/json`
 * although OAuth 2.0 specification does not mention the format of the error
 * response for this case.
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
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationFailAction::$LOCATION`, it means that the response to the
 * client application should be `302 Found` with a `Location` header.
 *
 * In this case, `getResponseContent()` method returns a redirect URI to
 * which the error should be reported, so it can be used as the value of
 * `Location` header. The following illustrates the response which the
 * authorization server implementation should generate and return to the
 * client application.
 *
 * ```
 * HTTP/1.1 302 Found
 * Location: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationFailAction::$FORM`, it means that the response to the
 * client application should be `200 OK` with an HTML which triggers
 * redirection by JavaScript. This happens when the authorization request
 * from the client application contains `response_mode=form_post`.
 *
 * In this case, `getResponseContent()` method returns an HTML which
 * satisfies the requirements of `response_mode=form_post`, so it can be
 * used as the entity body of the response. The following illustrates the
 * response which the authorization server implementation should generate
 * and return to the client application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: text/html;charset=UTF-8
 * Cache-Control: no-store
 * Pragma: no-store
 *
 * (The value returned from getResponseContent())
 * ```
 */
class AuthorizationFailResponse extends ApiResponse
{
    private ?string $action          = null;
    private ?string $responseContent = null;


    /**
     * Get the next action that the authorization server implementation
     * should take.
     *
     * @return AuthorizationFailAction|null
     *     The next action that the authorization server implementation
     *     should take.
     */
    public function getAction(): ?AuthorizationFailAction
    {
        return AuthorizationFailAction::valueOf($this->action);
    }


    /**
     * Set the next action that the authorization server implementation
     * should take.
     *
     * @param AuthorizationFailAction|null $action
     *     The next action that the authorization server implementation
     *     should take.
     *
     * @return AuthorizationFailResponse
     *     `$this` object.
     */
    public function setAction(AuthorizationFailAction $action = null): AuthorizationFailResponse
    {
        $this->action = $action->value;

        return $this;
    }


    /**
     * Get the response content which can be used to generate a response to
     * the client application.
     *
     * The format of the value varies depending on the value returned from
     * `getAction()` method.
     *
     * @return string|null
     *     The response content which can be used to generate a response to
     *     the client application.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used to generate a response to
     * the client application.
     *
     * @param string|null $responseContent
     *     The response content which can be used to generate a response to
     *     the client application.
     *
     * @return AuthorizationFailResponse
     *     `$this` object.
     */
    public function setResponseContent(mixed $responseContent): AuthorizationFailResponse
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
            AuthorizationFailAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));
    }
}

