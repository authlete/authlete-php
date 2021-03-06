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
class ClientAuthMethod
{
    use EnumTrait;


    /**
     * No client authentication.
     *
     * Client authentication is not performed at endpoints of the
     * authorization server, either because the client uses only the
     * implicit flow or because the client type of the client is
     * "public".
     *
     * @static
     * @var ClientAuthMethod
     */
    public static $NONE;


    /**
     * Client authentication using Basic Authentication as defined
     * in "3.2.1. Client Authentication" of RFC 6749.
     *
     * @static
     * @var ClientAuthMethod
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2.1 RFC 6749, 3.2.1. Client Authentication
     */
    public static $CLIENT_SECRET_BASIC;


    /**
     * Client authentication using the "client_secret" request
     * parameter in the request body as defined in "3.2.1. Client
     * Authentication" of RFC 6749.
     *
     * @static
     * @var ClientAuthMethod
     *
     * @see https://tools.ietf.org/html/rfc6749#section-3.2.1 RFC 6749, 3.2.1. Client Authentication
     */
    public static $CLIENT_SECRET_POST;


    /**
     * Client authentication using JWT signed by the shared client
     * secret as defined in RFC 7523.
     *
     * @static
     * @var ClientAuthMethod
     *
     * @see https://tools.ietf.org/html/rfc7523 RFC 7523
     */
    public static $CLIENT_SECRET_JWT;


    /**
     * Client authentication using X.509 certificates as defined in
     * RFC 7523.
     *
     * @static
     * @var ClientAuthMethod
     *
     * @see https://tools.ietf.org/html/rfc7523 RFC 7523
     */
    public static $PRIVATE_KEY_JWT;


    /**
     * Client authentication using X.509 certificates as defined in
     * "Mutual TLS Profiles for OAuth Clients".
     *
     * @static
     * @var ClientAuthMethod
     */
    public static $TLS_CLIENT_AUTH;


    /**
     * Client authentication using self-signed certificates as defined
     * in "Mutual TLS Profiles for OAuth Clients".
     *
     * @static
     * @var ClientAuthMethod
     */
    public static $SELF_SIGNED_TLS_CLIENT_AUTH;
}


// Call ClientAuthMethod::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\ClientAuthMethod');
?>
