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
 * File containing the definition of IDTokenReissueAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /idtoken/reissue API.
 *
 * @since 1.13.0
 */
class IDTokenReissueAction
{
    use EnumTrait;


    /**
     * The request has been processed successfully.
     *
     * @static
     * @var IDTokenReissueAction
     */
    public static $OK;


    /**
     * Something wrong has happened on the Authlete side. The token endpoint
     * should return `500 Internal Server Error` to the client application.
     * However, it is up to the authorization server's policy whether to
     * return `500` actually.
     *
     * @static
     * @var IDTokenReissueAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The API call is wrong.
     *
     * @static
     * @var IDTokenReissueAction
     */
    public static $CALLER_ERROR;
}


// Call IDTokenReissueAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\IDTokenReissueAction');
?>
