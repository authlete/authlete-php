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
 * File containing the definition of TokenFailReason class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "reason" in requests to Authlete's /api/auth/token/fail API.
 */
class TokenFailReason
{
    use EnumTrait;


    /**
     * Unknown reason.
     *
     * Using this reason will result in `error=server_error`.
     *
     * @static
     * @var TokenFailReason
     */
    public static $UNKNOWN;


    /**
     * The resource owner's credentials ("username" and "password" contained
     * in the token request whose flow is Resource Owner Password Credentials)
     * are invalid.
     *
     * Using this reason will result in `error=invalid_request`.
     *
     * @static
     * @var TokenFailReason
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.3 RFC 6749, 4.3. Resource Owner Password Credentials Grant
     */
    public static $INVALID_RESOURCE_OWNER_CREDENTIALS;
}


// Call TokenFailReason::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\TokenFailReason');
?>
