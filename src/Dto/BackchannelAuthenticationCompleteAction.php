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
 * File containing the definition of BackchannelAuthenticationCompleteAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/backchannel/authentication/complete API.
 *
 * @since 1.8
 */
class BackchannelAuthenticationCompleteAction
{
    use EnumTrait;


    /**
     * The OpenID provider implementation must send a notification to the
     * client's notification endpoint. This action code may be returned
     * when the backchannel token delivery mode is `ping` or `push`.
     *
     * @static
     * @var BackchannelAuthenticationCompleteAction
     */
    public static $NOTIFICATION;


    /**
     * The OpenID provider implementation does not have to take any
     * immediate action for this API response. The remaining task is just
     * to handle polling requests from the client to the token endpoint.
     * This action code may be returned when the backchannel token delivery
     * mode is `poll`.
     *
     * @static
     * @var BackchannelAuthenticationCompleteAction
     */
    public static $NO_ACTION;


    /**
     * An error occurred either because the ticket included in the API call
     * was invalid or because an error occurred on Authlete side.
     *
     * If an error occurred after Authlete succeeded in retrieving data
     * associated with the ticket from the database and if the backchannel
     * token delivery mode is `ping` or `push`, `NOTIFICATION` is used as
     * the value of `action` insteadof `SERVER_ERROR`. In the case,
     * `responseContent` contains `"error":"server_error"`.
     *
     * @static
     * @var BackchannelAuthenticationCompleteAction
     */
    public static $SERVER_ERROR;
}


// Call BackchannelAuthenticationCompleteAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\BackchannelAuthenticationCompleteAction');
?>
