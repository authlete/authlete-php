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
class ResponseType
{
    use EnumTrait;


    /**
     * "none"; a "response_type" to request no access credentials.
     *
     * @static
     * @var ResponseType
     */
    public static $NONE;


    /**
     * "code"; a "response_type" to request an authorization code.
     *
     * @static
     * @var ResponseType
     */
    public static $CODE;


    /**
     * "token"; a "response_type" to request an access token.
     *
     * @static
     * @var ResponseType
     */
    public static $TOKEN;


    /**
     * "id_token"; a "response_type" to request an ID token.
     *
     * @static
     * @var ResponseType
     */
    public static $ID_TOKEN;


    /**
     * "code token"; a "response_type" to request an authorization
     * code and an access token.
     *
     * @static
     * @var ResponseType
     */
    public static $CODE_TOKEN;


    /**
     * "code id_token"; a "response_type" to request an authorization
     * code and an ID token.
     *
     * @static
     * @var ResponseType
     */
    public static $CODE_ID_TOKEN;


    /**
     * "id_token token"; a "response_type" to request an ID token
     * and an access token.
     *
     * @static
     * @var ResponseType
     */
    public static $ID_TOKEN_TOKEN;


    /**
     * "code id_token token"; a "response_type" to request an
     * authorization code, an ID token and an access token.
     *
     * @static
     * @var ResponseType
     */
    public static $CODE_ID_TOKEN_TOKEN;
}


// Call ResponseType::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\ResponseType');
?>
