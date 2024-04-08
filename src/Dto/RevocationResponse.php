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
 * File containing the definition of RevocationResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/revocation API.
 *
 * Authlete's `/api/auth/revocation` API returns JSON which can be mapped
 * to this class. The authorization server implementation should retrieve
 * the value of the `action` from the response and take the following steps
 * according to the value.
 *
 * When the value returned from `getAction()` method is
 * `RevocationAction::$INVALID_CLIENT`, it means that authentication of the
 * client failed. In this case, the HTTP status of the response to the client
 * application should be either `400 Bad Request` or `401 Unauthorized`.
 * The description about `invalid_client` shown below is an excerpt from RFC
 * 6749.
 *
 * > `invalid_client`: Client authentication failed (e.g., unknown client,
 * > no client authentication included, or unsupported authentication method).
 * > The authorization server MAY return an HTTP 401 (Unauthorized) status
 * > code to indicate which HTTP authentication schemes are supported. If the
 * > client attempted to authenticate via the "Authorization" request header
 * > field, the authorization server MUST respond with an HTTP 401
 * > (Unauthorized) status code and include the "WWW-Authenticate" response
 * > header field matching the authentication schemeused by the client.
 *
 * In either case, the JSON string returned from `getResponseContent()` method
 * can be used as the entity body of the response to the client application.
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
 * When the value returned from `getAction()` method is
 * `RevocationAction::$INTERNAL_SERVER_ERROR`, it means that the request from
 * the authorization server implementation (`getRevocationRequest()`) was
 * wrong or that an error occurred in Authlete.
 *
 * In either case, from a viewpoint of the client application, it is an error
 * on the server side. Therefore, the authorization server implementation
 * should generate a response to the client application with the HTTP status
 * of `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the authorization server
 * should generate and return to the client application.
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
 * `RevocationAction::$BAD_REQUEST`, it means that the request from the client
 * application is invalid.
 *
 * The HTTP status of the response returned to the client application must be
 * `400 Bad Request` and the content type must be `application/json`.
 * [2.2.1. Error Response](https://tools.ietf.org/html/rfc7009#section-2.2.1)
 * of [RFC 7009](https://tools.ietf.org/html/rfc7009) states *"The error
 * presentation conforms to the definition in
 * [Section 5.2](https://tools.ietf.org/html/rfc6749#section-5.2) of
 * [RFC 6749](https://tools.ietf.org/html/rfc6749)."*
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustartes the response which the authorization server
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
 * `RevocationAction::$OK`, it means that the request from the client
 * application is valid and the presented token has been revoked successfully
 * or that the client submitted an invalid token. Note that invalid tokens do
 * not cause an error. See
 * [2.2. Revocation Response](https://tools.ietf.org/html/rfc7009#section-2.2)
 * for details.
 *
 * The HTTP status of the response returned to the client application must be
 * `200 OK`.
 *
 * If the original request from the client application contains the `callback`
 * request parameter and its value is not empty, the content type should be
 * `application/javascript` and the content should be a JavaScript snippet
 * for JSONP.
 *
 * In this case, `getResponseContent()` returns a JavaScript snippet if the
 * original request from the client application contains the `callback`
 * request parameter and its value is not empty. Otherwise,
 * `getResponseContent()` returns `null`. The following illustrates the
 * response which the authorization server implementation should generate and
 * return to the client application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: application/javascript
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 */
class RevocationResponse extends ApiResponse
{
    private ?RevocationAction $action         = null;
    protected ?string $responseContent        = null;


    /**
     * Get the next action that the revocation endpoint should take.
     *
     * @return RevocationAction|null
     *     The next action that the revocation endpoint should take.
     */
    public function getAction(): ?RevocationAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the revocation endpoint should take.
     *
     * @param RevocationAction|null $action
     *     The next action that the revocation endpoint should take.
     *
     * @return RevocationResponse
     *     `$this` object.
     */
    public function setAction(RevocationAction $action = null): RevocationResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used as the entity body of the
     * response returned from the revocation endpoint to the client application.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as the entity body of the
     * response returned from the revocation endpoint to the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return RevocationResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): RevocationResponse
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
    public function copyFromArray(array &$array)
    {
        parent::copyFromArray($array);

        // action
        $this->setAction(
            RevocationAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));
    }
}

