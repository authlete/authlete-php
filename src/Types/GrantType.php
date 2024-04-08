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
 * File containing the definition of GrantType class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Grant types.
 */
enum GrantType: string implements Valuable
{
    use EnumTrait;

    /**
     * Authorization Code flow.
     *
     * A grant type to request an access token and/or and ID token,
     * and optionally a refresh token, using an authorization code.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.1 RFC 6749, 4.1. Authorization Code Grant
     */
    case AUTHORIZATION_CODE = 'authorization_code';


    /**
     * Implicit flow.
     *
     * This is not a valid value for the `grant_type` request parameter
     * of token requests but is listed here because OpenID Connect
     * Dynamic Client Registration 1.0 uses `implicit` as a value
     * of `grant_types` of client metadata.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.2 RFC 6749, 4.2. Implicit Grant
     * @see https://openid.net/specs/openid-connect-registration-1_0.html OpenID Connect Dynamic Client Registration 1.0
     */
    case IMPLICIT = 'implicit';


    /**
     * Resource Owner Password Credentials flow.
     *
     * A grant type to request an access token using a resource owner's
     * "username" and "password".
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.3 RFC 6749, 4.3. Resource Owner Password Credentials Grant
     */
    case PASSWORD = 'password';


    /**
     * Client Credentials flow.
     *
     * A grant type to request an access token using a client's credentials.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-4.4 RFC 6749, 4.4. Client Credentials Grant
     */
    case CLIENT_CREDENTIALS = 'client_credentials';


    /**
     * Refresh Token flow.
     *
     * A grant type to request an access token, and optionally an ID token
     * and/or a refresh token, using a refresh token.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-6 RFC 6749, 6. Refreshing an Access Token
     */
    case REFRESH_TOKEN = 'refresh_token';


    /**
     * CIBA flow.
     *
     * A grant type to request an ID token, an access token, and optionally
     * a refresh token.
     *
     * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html OpenID Connect Client Initiated Backchannel Authentication Flow - Core 1.0
     *
     * @since 1.8
     */
    case CIBA = 'ciba';


    /**
     * Device flow.
     *
     * A grant type to request an access token and optionally a refresh token.
     *
     * @see https://tools.ietf.org/html/rfc8628 OAuth 2.0 Device Authorization Grant
     *
     * @since 1.8
     */
    case DEVICE_CODE = 'device_code';
}

