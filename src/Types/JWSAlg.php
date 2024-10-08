<?php
//
// Copyright (C) 2018-2024 Authlete, Inc.
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
 * File containing the definition of JWSAlg class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * "alg" (Algorithm) Header Parameter Values for JWS defined in RFC 7518.
 *
 * @see https://tools.ietf.org/html/rfc7518#section-3.1 RFC 7518, 3.1. "alg" (Algorithm) Header Parameter Values for JWS
 */
class JWSAlg
{
    use EnumTrait;


    /**
     * No digital signature or MAC performed.
     *
     * @static
     * @var JWSAlg
     */
    public static $NONE;


    /**
     * HMAC using SHA-256.
     *
     * @static
     * @var JWSAlg
     */
    public static $HS256;


    /**
     * HMAC using SHA-384.
     *
     * @static
     * @var JWSAlg
     */
    public static $HS384;


    /**
     * HMAC using SHA-512.
     *
     * @static
     * @var JWSAlg
     */
    public static $HS512;


    /**
     * RSASSA-PKCS-v1_5 using SHA-256.
     *
     * @static
     * @var JWSAlg
     */
    public static $RS256;


    /**
     * RSASSA-PKCS-v1_5 using SHA-384.
     *
     * @static
     * @var JWSAlg
     */
    public static $RS384;


    /**
     * RSASSA-PKCS-v1_5 using SHA-512.
     *
     * @static
     * @var JWSAlg
     */
    public static $RS512;


    /**
     * ECDSA using P-256 and SHA-256.
     *
     * @static
     * @var JWSAlg
     */
    public static $ES256;


    /**
     * ECDSA using P-384 and SHA-384.
     *
     * @static
     * @var JWSAlg
     */
    public static $ES384;


    /**
     * ECDSA using P-521 and SHA-512.
     *
     * @static
     * @var JWSAlg
     */
    public static $ES512;


    /**
     * RSASSA-PSS using SHA-256 and MGF1 with SHA-256.
     *
     * @static
     * @var JWSAlg
     */
    public static $PS256;


    /**
     * RSASSA-PSS using SHA-384 and MGF1 with SHA-384.
     *
     * @static
     * @var JWSAlg
     */
    public static $PS384;


    /**
     * RSASSA-PSS using SHA-512 and MGF1 with SHA-512.
     *
     * @static
     * @var JWSAlg
     */
    public static $PS512;


    /**
     * ECDSA using secp256k1 curve and SHA-256.
     *
     * @static
     * @var JWSAlg
     *
     * @since 1.13.0
     */
    public static $ES256K;


    /**
     * EdDSA signature algorithms.
     *
     * @static
     * @var JWSAlg
     *
     * @since 1.13.0
     */
    public static $EdDSA;
}


// Call JWSAlg::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\JWSAlg');
?>
