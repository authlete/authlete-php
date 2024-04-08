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
 * File containing the definition of BackchannelAuthenticationFailResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/backchannel/authentication/fail API.
 *
 * @since 1.8
 */
class BackchannelAuthenticationFailResponse extends ApiResponse
{
    private ?BackchannelAuthenticationFailAction $action = null;  // \Authlete\Dto\BackchannelAuthenticationFailAction
    private ?string $responseContent = null;  // string


    /**
     * Get the next action that the backchannel authentication endpoint should
     * take.
     *
     * @return BackchannelAuthenticationFailAction|null
     *     The next action that the backchannel authentication endpoint should
     *     take.
     */
    public function getAction(): ?BackchannelAuthenticationFailAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the backchannel authentication endpoint should
     * take.
     *
     * @param BackchannelAuthenticationFailAction|null $action
     *     The next action that the backchannel authentication endpoint should
     *     take.
     *
     * @return BackchannelAuthenticationFailResponse
     *     `$this` object.
     */
    public function setAction(BackchannelAuthenticationFailAction $action = null): BackchannelAuthenticationFailResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the content of the response body of the response to the client.
     * Its format is always JSON.
     *
     * @return string|null
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the content of the response body of the response to the client.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return BackchannelAuthenticationFailResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): BackchannelAuthenticationFailResponse
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
            BackchannelAuthenticationFailAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));
    }
}
