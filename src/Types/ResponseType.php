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
 * File containing the definition of ResponseType class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Response types. See "OAuth 2.0 Multiple Response Type Encoding Practices"
 * for details.
 *
 * @see https://openid.net/specs/oauth-v2-multiple-response-types-1_0.html OAuth 2.0 Multiple Response Type Encoding Practices
 */
enum ResponseType: string implements Valuable
{
    use EnumTrait;


    /**
     * "none"; a "response_type" to request no access credentials.
     */
    case NONE = 'none';


    /**
     * "code"; a "response_type" to request an authorization code.
     */
    case CODE = 'code';


    /**
     * "token"; a "response_type" to request an access token.
     */
    case TOKEN = 'token';


    /**
     * "id_token"; a "response_type" to request an ID token.
     */
    case ID_TOKEN = 'id_token';


    /**
     * "code token"; a "response_type" to request an authorization
     * code and an access token.
     */
    case CODE_TOKEN = 'code_token';


    /**
     * "code id_token"; a "response_type" to request an authorization
     * code and an ID token.
     */
    case CODE_ID_TOKEN = 'code_id_token';


    /**
     * "id_token token"; a "response_type" to request an ID token
     * and an access token.
     */
    case ID_TOKEN_TOKEN = 'id_token_token';


    /**
     * "code id_token token"; a "response_type" to request an
     * authorization code, an ID token and an access token.
     */
    case CODE_ID_TOKEN_TOKEN = 'code_id_token_token';
}

