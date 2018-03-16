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
 * File containing the definition of TokenUpdateAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /api/auth/token/update
 * API.
 */
class TokenUpdateAction
{
    use EnumTrait;


    /**
     * An error occurred on Authlete side.
     *
     * @static
     * @var TokenUpdateAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The request from the caller was wrong.
     *
     * For example, this happens when the `accessToken` request parameter was
     * missing.
     *
     * @static
     * @var TokenUpdateAction
     */
    public static $BAD_REQUEST;


    /**
     * The request from the caller was not allowed.
     *
     * For example, this happens when the access token identified by the
     * `accessToken` request parameter does not belong to the service
     * identified by the API key used for the API call.
     *
     * @static
     * @var TokenUpdateAction
     */
    public static $FORBIDDEN;


    /**
     * The specified access token does not exist.
     *
     * @static
     * @var TokenUpdateAction
     */
    public static $NOT_FOUND;


    /**
     * The access token was updated successfully.
     *
     * @static
     * @var TokenUpdateAction
     */
    public static $OK;
}


// Call TokenUpdateAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\TokenUpdateAction');
?>
