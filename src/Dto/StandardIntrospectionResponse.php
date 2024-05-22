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
 * File containing the definition of StandardIntrospectionResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/introspection/standard API.
 *
 * Note that `/api/auth/introspection/standard` API and
 * `/api/auth/introspection` API are different.
 *
 * The `/api/auth/introspection/standard` API exists to help your
 * authorization server provide its own introspection API which complies with
 * [RFC 7662](https://tools.ietf.org/html/rfc7662) (OAuth 2.0 Token
 * Introspection).
 *
 * Authlete's `/api/auth/introspection/standard` API returns JSON which can
 * be mapped to this class. The implementation of the introspection endpoint
 * of your authorization server should retrieve the value of the `action`
 * parameter (which can be obtained by `getAction()` method of this class)
 * from the response and take the following steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `StandardIntrospectionAction::$INTERNAL_SERVER_ERROR`, it means that the
 * request from your system to Authlete (`StandardIntrospectionRequest`) was
 * wrong or that an error occurred in Authlete. In either case, from a
 * viewpoint of the client application, it is an error on the server side.
 * Therefore, the introspection endpoint of your authorization server should
 * generate a response to the client application with the HTTP status of
 * `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response
 * if you want. Note that, however,
 * [RFC 7662](https://tools.ietf.org/html/rfc7662) does not mention anything
 * about the format of the response body of error responses.
 *
 * The following illustrates an example response which the introspection
 * endpoint of your authorization server generates and returns to the client
 * application.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * Content-Type: application/json
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * When the value returned from `getAction()` method is
 * `StandardIntrospectionAction::$BAD_REQUEST`, it means that the request
 * from the client application is invalid. This happens when the request
 * from the client did not include the `token` request parameter. The HTTP
 * status of the response returned to the client application should be
 * `400 Bad Request`. See
 * [2.1. Introspection Request](https://tools.ietf.org/html/rfc7662#section-2.1)
 * of [RFC 7662](https://tools.ietf.org/html/rfc7662) for details about
 * requirements for introspection requests.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response
 * if you want. Note that, however,
 * [RFC 7662](https://tools.ietf.org/html/rfc7662) does not mention anything
 * about the format of the response body of error responses.
 *
 * The following illustrates an example response which the introspection
 * endpoint of your authorization server generates and returns to the client
 * application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * Content-Type: application/json
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * When the value returned from `getAction()` method is
 * `StandardIntrospectionAction::$BAD_REQUEST`, it means that the request
 * from the client application is valid. The HTTP status of the response
 * returned to the client application must be `200 OK` and its content type
 * must be `application/json`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * complies with the introspection response defined in
 * [2.2. Introspection Response](https://tools.ietf.org/html/rfc7662#section-2.2)
 * of [RFC 7662](https://tools.ietf.org/html/rfc7662).
 *
 * The following illustrates an example response which the introspection
 * endpoint of your authorization server generates and returns to the client
 * application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: application/json
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * Note that RFC 7662 says *"To prevent token scanning attacks, the endpoint
 * MUST also require some form of authorization to access this endpoint"*.
 * This means that you have to protect your introspection endpoint in some
 * way or other. Authlete does not care about how your introspection endpoint
 * is protected. In most cases, as mentioned in RFC 7662, `401 Unauthorized`
 * is a proper response when an introspection request does not satisfy
 * authorization requirements imposed by your introspection endpoint.
 */
class StandardIntrospectionResponse extends ApiResponse
{
    private ?StandardIntrospectionAction $action          = null;
    private ?string                      $responseContent = null;


    /**
     * Get the next action that the introspection endpoint of your
     * authorization server should take.
     *
     * @return StandardIntrospectionAction|null
     *     The next action that the introspection endpoint of  your
     *     authorization server should take.
     */
    public function getAction(): ?StandardIntrospectionAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the introspection endpoint of your
     * authorization server should take.
     *
     * @param StandardIntrospectionAction|null $action
     *     The next action that the introspection endpoint of  your
     *     authorization server should take.
     *
     * @return StandardIntrospectionResponse
     *     `$this` object.
     */
    public function setAction(StandardIntrospectionAction $action = null): StandardIntrospectionResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used as the entity body of the
     * response returned to the client application.
     *
     * @return string
     *     The response content which can be used as the entity body of the
     *     response returned to the client application.
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
     *     The response content which can be used as the entity body of the
     *     response returned to the client application.
     *
     * @return StandardIntrospectionResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): StandardIntrospectionResponse
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
            StandardIntrospectionAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));
    }
}
