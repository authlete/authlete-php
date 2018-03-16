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
 * File containing the definition of GrantType class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Grant types.
 */
class GrantType
{
    use EnumTrait;


    /**
     * Authorization Code flow.
     *
     * A grant type to request an access token and/or and ID token,
     * and optionally a refresh token, using an authorization code.
     *
     * @static
     * @var GrantType
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.1 RFC 6749, 4.1. Authorization Code Grant
     */
    public static $AUTHORIZATION_CODE;


    /**
     * Implicit flow.
     * 
     * This is not a valid value for the `grant_type` request parameter
     * of token requests but is listed here because OpenID Connect
     * Dynamic Client Registration 1.0 uses `implicit` as a value
     * of `grant_types` of client metadata.
     *
     * @static
     * @var GrantType
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.2 RFC 6749, 4.2. Implicit Grant
     * @see https://openid.net/specs/openid-connect-registration-1_0.html OpenID Connect Dynamic Client Registration 1.0
     */
    public static $IMPLICIT;


    /**
     * Resource Owner Password Credentials flow.
     *
     * A grant type to request an access token using a resource owner's
     * "username" and "password".
     *
     * @static
     * @var GrantType
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.3 RFC 6749, 4.3. Resource Owner Password Credentials Grant
     */
    public static $PASSWORD;


    /**
     * Client Credentials flow.
     *
     * A grant type to request an access token using a client's credentials.
     *
     * @static
     * @var GrantType
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.4 RFC 6749, 4.4. Client Credentials Grant
     */
    public static $CLIENT_CREDENTIALS;


    /**
     * Refresh Token flow.
     *
     * A grant type to request an access token, and optionally an ID token
     * and/or a refresh token, using a refresh token.
     *
     * @static
     * @var GrantType
     *
     * @see https://tools.ietf.org/html/rfc6749#section-6 RFC 6749, 6. Refreshing an Access Token
     */
    public static $REFRESH_TOKEN;
}


// Call GrantType::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\GrantType');
?>
