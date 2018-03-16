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
 * File containing the definition of UserInfoIssueResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/userinfo/issue API.
 *
 * Authlete's `/api/auth/userinfo/issue` API returns JSON which can be mapped
 * to this class. The [userInfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
 * implementation should retrieve the value of the `action` response parameter
 * (which can be obtained by `getAction()` method of this class) from the
 * response and take the following steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `UserInfoIssueAction::$INTERNAL_SERVER_ERROR`, it means that the request
 * from your system was wrong or that an error occurred in Authlete. In either
 * case, from a viewpoint of the client application, it is an error on the
 * server side. Therefore, the userinfo endpoint implementation should generate
 * a response to the client application with the HTTP status of
 * `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation of
 * your system can use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response which
 * complies with RFC 6750. Note that OpenID Connect Core 1.0 requires that an
 * error response from the userinfo endpoint comply with RFC 6750. See
 * [5.3.3. UserInfo Error Response](https://openid.net/specs/openid-connect-core-1_0.html#UserInfoError)
 * for details.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragram: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoIssueAction::$BAD_REQUEST`, it means that the request from the
 * client application does not contain an access token (= the request from
 * your system to Authlete does not contain the `token` request parameter).
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response from the
 * userinfo endpoint to the client application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoIssueAction::$UNAUTHORIZED`, it means that the access token does
 * not exist, has expired, or is not associated with any subject (= any
 * end-user).
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response from the
 * userinfo endpoint to the client application.
 *
 * ```
 * HTTP/1.1 401 Unauthorized
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoIssueAction::$FORBIDDEN`, it means that the  access token does not
 * have the `openid` scope.
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response from the
 * userinfo endpoint to the client application.
 *
 * ```
 * HTTP/1.1 403 Forbidden
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoIssueAction::$JSON`, it means that the access token which the
 * client application presented is valid and a userinfo response was
 * successfully generated in the format of JSON.
 *
 * The userinfo endpoint of your system is expected to generate a response to
 * the client application. The content type of the response must be
 * `application/json`.
 *
 * In this case, `getResponseContent()` method returns a userinfo response in
 * JSON format, so a response to the client can be built like below.
 *
 * ```
 * HTTP/1.1 200 OK
 * Cache-Control: no-store
 * Pragma: no-cache
 * Content-Type: application/json;charset=UTF-8
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoIssueAction::$JWT`, it means that the access token which the client
 * application presented is valid and a userinfo response was successfully
 * generated in the format of JWT
 * ([RFC 7519](https://tools.ietf.org/html/rfc7519)).
 *
 * The userinfo endpoint of your system is expected to generate a response to
 * the client application. The content type of the response must be
 * `application/jwt`.
 *
 * In this case, the `getResponseContent()` method returns a userinfo response
 * in JWT format, so a response to the client can be built like below.
 *
 * ```
 * HTTP/1.1 200 OK
 * Cache-Control: no-store
 * Pragma: no-cache
 * Content-Type: application/jwt
 *
 * (The value returned from getResponseContent())
 * ```
 */
class UserInfoIssueResponse extends ApiResponse
{
    private $action          = null;  // \Authlete\Dto\UserInfoIssueAction
    private $responseContent = null;  // string


    /**
     * Get the next action that the userinfo endpoint should take.
     *
     * @return UserInfoAction
     *     The next action that the userinfo endpoint should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the userinfo endpoint should take.
     *
     * @param UserInfoAction $action
     *     The next action that the userinfo endpoint should take.
     *
     * @return UserInfoIssueResponse
     *     `$this` object.
     */
    public function setAction(UserInfoIssueAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used as the entity body of the
     * response returned from the userinfo endpoint implementation to the
     * client application.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as the entity body of the
     * response returned from the userinfo endpoint implementation to the
     * client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return UserInfoIssueResponse
     *     `$this` object.
     */
    public function setResponseContent($responseContent)
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
    public function copyToArray(array &$array)
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
            UserInfoIssueAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));
    }
}
?>
