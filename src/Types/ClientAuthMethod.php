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
 * File containing the definition of ClientAuthMethod class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Client authentication methods.
 */
enum ClientAuthMethod: string implements Valuable
{
    use EnumTrait;


    /**
     * No client authentication.
     *
     * Client authentication is not performed at endpoints of the
     * authorization server, either because the client uses only the
     * implicit flow or because the client type of the client is
     * "public".
     */
    case NONE = 'none';


    /**
     * Client authentication using Basic Authentication as defined
     * in "3.2.1. Client Authentication" of RFC 6749.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2.1 RFC 6749, 3.2.1. Client Authentication
     */
    case CLIENT_SECRET_BASIC = 'client_secret_basic';


    /**
     * Client authentication using the "client_secret" request
     * parameter in the request body as defined in "3.2.1. Client
     * Authentication" of RFC 6749.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2.1 RFC 6749, 3.2.1. Client Authentication
     */
    case CLIENT_SECRET_POST = 'client_secret_post';


    /**
     * Client authentication using JWT signed by the shared client
     * secret as defined in RFC 7523.
     *
     * @see https://tools.ietf.org/html/rfc7523 RFC 7523
     */
    case CLIENT_SECRET_JWT = 'client_secret_jwt';


    /**
     * Client authentication using X.509 certificates as defined in
     * RFC 7523.
     *
     * @see https://tools.ietf.org/html/rfc7523 RFC 7523
     */
    case PRIVATE_KEY_JWT = 'private_key_jwt';


    /**
     * Client authentication using X.509 certificates as defined in
     * "Mutual TLS Profiles for OAuth Clients".
     */
    case TLS_CLIENT_AUTH = 'tls_client_auth';


    /**
     * Client authentication using self-signed certificates as defined
     * in "Mutual TLS Profiles for OAuth Clients".
     */
    case SELF_SIGNED_TLS_CLIENT_AUTH = 'self_signed_tls_client_auth';
}

