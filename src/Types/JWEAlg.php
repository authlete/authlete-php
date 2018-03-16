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
 * File containing the definition of JWEAlg class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * "alg" (Algorithm) Header Parameter Values for JWE defined in RFC 7518.
 *
 * @see https://tools.ietf.org/html/rfc7518#section-4.1 RFC 7518, 4.1. "alg" (Algorithm) Header Parameter Values for JWE
 */
class JWEAlg
{
    use EnumTrait;


    /**
     * RSAES-PKCS1-V1_5.
     *
     * @static
     * @var JWEAlg
     */
    public static $RSA1_5;


    /**
     * RSAES OAEP using default parameters.
     *
     * @static
     * @var JWEAlg
     */
    public static $RSA_OAEP;


    /**
     * RSAES OAEP using SHA-256 and MGF1 with SHA-256.
     *
     * @static
     * @var JWEAlg
     */
    public static $RSA_OAEP_256;


    /**
     * AES Key Wrap with default initial value using 128 bit key.
     *
     * @static
     * @var JWEAlg
     */
    public static $A128KW;


    /**
     * AES Key Wrap with default initial value using 192 bit key.
     *
     * @static
     * @var JWEAlg
     */
    public static $A192KW;


    /**
     * AES Key Wrap with default initial value using 256 bit key.
     *
     * @static
     * @var JWEAlg
     */
    public static $A256KW;


    /**
     * Direct use of a shared symmetric key as the CEK.
     *
     * @static
     * @var JWEAlg
     */
    public static $DIR;


    /**
     * Elliptic Curve Diffie-Hellman Ephemeral Static key agreement
     * using Concat KDF.
     *
     * @static
     * @var JWEAlg
     */
    public static $ECDH_ES;


    /**
     * ECDH-ES using Concat KDF and CEK wrapped with "A128KW".
     *
     * @static
     * @var JWEAlg
     */
    public static $ECDH_ES_A128KW;


    /**
     * ECDH-ES using Concat KDF and CEK wrapped with "A192KW".
     *
     * @static
     * @var JWEAlg
     */
    public static $ECDH_ES_A192KW;


    /**
     * ECDH-ES using Concat KDF and CEK wrapped with "A256KW".
     *
     * @static
     * @var JWEAlg
     */
    public static $ECDH_ES_A256KW;


    /**
     * Key wrapping with AES GCM using 128 bit key.
     *
     * @static
     * @var JWEAlg
     */
    public static $A128GCMKW;


    /**
     * Key wrapping with AES GCM using 192 bit key.
     *
     * @static
     * @var JWEAlg
     */
    public static $A192GCMKW;


    /**
     * Key wrapping with AES GCM using 256 bit key.
     *
     * @static
     * @var JWEAlg
     */
    public static $A256GCMKW;


    /**
     * PBES2 with HMAC SHA-256 and "A128KW".
     *
     * @static
     * @var JWEAlg
     */
    public static $PBES2_HS256_A128KW;


    /**
     * PBES2 with HMAC SHA-384 and "A192KW".
     *
     * @static
     * @var JWEAlg
     */
    public static $PBES2_HS384_A192KW;


    /**
     * PBES2 with HMAC SHA-512 and "A256KW".
     *
     * @static
     * @var JWEAlg
     */
    public static $PBES2_HS512_A256KW;
}


// Call JWEAlg::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\JWEAlg');
?>
