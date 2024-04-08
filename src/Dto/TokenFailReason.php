<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "reason" in requests to Authlete's /api/auth/token/fail API.
 */
enum TokenFailReason: string implements Valuable
{
    use EnumTrait;


    /**
     * Unknown reason.
     *
     * Using this reason will result in `error=server_error`.
     */
    case UNKNOWN = 'UNKNOWN';


    /**
     * The resource owner's credentials ("username" and "password" contained
     * in the token request whose flow is Resource Owner Password Credentials)
     * are invalid.
     *
     * Using this reason will result in `error=invalid_request`.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.3 RFC 6749, 4.3. Resource Owner Password Credentials Grant
     */
    case INVALID_RESOURCE_OWNER_CREDENTIALS = 'invalid_resource_owner_credentials';


    /**
     * The requested resource is invalid, missing, unknown, or malformed.
     *
     * Using this reason will result in `error=invalid_target`.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    case INVALID_TARGET = 'invalid_target';
}
