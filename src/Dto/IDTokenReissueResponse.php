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
 * File containing the definition of IDTokenReissueResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * A response from Authlete's `/idtoken/reissue` API.
 *
 * A response from the `/idtoken/reissue` API can be mapped to this class.
 * The API caller should extract the value of the `action` parameter from
 * the API response and take the next action based on the value of the
 * parameter.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `IDTokenReissueAction::$OK`, it means that an ID token has been reissued
 * successfully. In this case, the implementation of the token endpoint
 * should return a successful response to the client application. The HTTP
 * status code and the content type of the response should be 200 and
 * `application/json`, respectively. The value of the `responseContent`
 * parameter can be used as the message body of the response.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: application/json
 * Cache-Control: no-store
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `IDTokenReissueAction::$INTERNAL_SERVER_ERROR`, it means that something
 * wrong happened on Authlete side. In this case, the implementation of the
 * token endpoint should return an error response to the client application.
 * The HTTP status code and the content type of the error response should be
 * 500 and `application/json`, respectively. The value of the
 * `responseContent` parameter can be used as the message body of the error
 * response.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * Content-Type: application/json
 * Cache-Control: no-store
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * Note that, however, in real production deployments, it may be better to
 * return a vaguer error response instead of a bare one like above.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `IDTokenReissueAction::$CALLER_ERROR`, it means that the API call is wrong.
 * For example, the `accessToken` request parameter is missing.
 *
 * Caller errors should be solved before the service is deployed in a
 * production environment.
 *
 * @since 1.13.0
 */
class IDTokenReissueResponse extends ApiResponse
{
    private $action          = null;  // \Authlete\Dto\IDTokenReissueAction
    private $responseContent = null;  // string
    private $idToken         = null;  // string


    /**
     * Get the next action that the implementation of the token endpoint
     * should take.
     *
     * @return IDTokenReissueAction
     *     The next action that the implementation of the token endpoint
     *     should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the implementation of the token endpoint
     * should take.
     *
     * @param IDTokenReissueAction $action
     *     The next action that the implementation of the token endpoint
     *     should take.
     *
     * @return IDTokenReissueResponse
     *     `$this` object.
     */
    public function setAction(IDTokenReissueAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content that can be used as the message body of the
     * token response that should be returned from the token endpoint.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the response content that can be used as the message body of the
     * token response that should be returned from the token endpoint.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return IDTokenReissueResponse
     *     `$this` object.
     */
    public function setResponseContent($responseContent)
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the reissued ID token.
     *
     * @return string
     *     The reissued ID token in the JWS compact serialization format.
     */
    public function getIdToken()
    {
        return $this->idToken;
    }


    /**
     * Set the reissued ID token.
     *
     * @param string $idToken
     *     The reissued ID token in the JWS compact serialization format.
     *
     * @return IDTokenReissueResponse
     *     `$this` object.
     */
    public function setIdToken($idToken)
    {
        ValidationUtility::ensureNullOrString('$idToken', $idToken);

        $this->idToken = $idToken;

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
        $array['idToken']         = $this->idToken;
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
            IDTokenReissueAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // idToken
        $this->setIdToken(
            LanguageUtility::getFromArray('idToken', $array));
    }
}
?>
