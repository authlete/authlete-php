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
 * File containing the definition of BackchannelAuthenticationIssueAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/backchannel/authentication/issue API.
 *
 * @since 1.8
 */
class BackchannelAuthenticationIssueAction
{
    use EnumTrait;


    /**
     * The implementation of the backchannel authentication endpoint should
     * return a `200 OK` response to the client application.
     *
     * @static
     * @var BackchannelAuthenticationIssueAction
     */
    public static $OK;


    /**
     * The implementation of the backchannel authentication endpoint should
     * return a `500 Internal Server Error` response to the client application.
     * However, in most cases, commercial implementations prefer to use other
     * HTTP status code than 5xx.
     *
     * @static
     * @var BackchannelAuthenticationIssueAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The ticket included in the API call is invalid. It does not exist or
     * has expired.
     *
     * @static
     * @var BackchannelAuthenticationIssueAction
     */
    public static $INVALID_TICKET;
}


// Call BackchannelAuthenticationIssueAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\BackchannelAuthenticationIssueAction');
?>
