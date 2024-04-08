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
enum JWEAlg: string implements Valuable
{
    use EnumTrait;


    /**
     * RSAES-PKCS1-V1_5.
     */
    case RSA1_5 = 'rsa1_5';


    /**
     * RSAES OAEP using default parameters.
     */
    case RSA_OAEP = 'rsa_oaep';


    /**
     * RSAES OAEP using SHA-256 and MGF1 with SHA-256.
     */
    case RSA_OAEP_256 = 'rsa_oaep_256';


    /**
     * AES Key Wrap with default initial value using 128 bit key.
     */
    case A128KW = 'a128kw';


    /**
     * AES Key Wrap with default initial value using 192 bit key.
     */
    case A192KW = 'a192kw';


    /**
     * AES Key Wrap with default initial value using 256 bit key.
     */
    case A256KW = 'a256kw';


    /**
     * Direct use of a shared symmetric key as the CEK.
     */
    case DIR = 'dir';


    /**
     * Elliptic Curve Diffie-Hellman Ephemeral Static key agreement
     * using Concat KDF.
     */
    case ECDH_ES = 'ecdh_es';


    /**
     * ECDH-ES using Concat KDF and CEK wrapped with "A128KW".
     */
    case ECDH_ES_A128KW = 'ecdh_es_a128kw';


    /**
     * ECDH-ES using Concat KDF and CEK wrapped with "A192KW".
     */
    case ECDH_ES_A192KW = 'ecdh_es_a192kw';


    /**
     * ECDH-ES using Concat KDF and CEK wrapped with "A256KW".
     */
    case ECDH_ES_A256KW = 'ecdh_es_a256kw';


    /**
     * Key wrapping with AES GCM using 128 bit key.
     */
    case A128GCMKW = 'A128gcmkw';


    /**
     * Key wrapping with AES GCM using 192 bit key.
     */
    case A192GCMKW = 'a192gcmkw';


    /**
     * Key wrapping with AES GCM using 256 bit key.
     */
    case A256GCMKW = 'a256gcmkw';


    /**
     * PBES2 with HMAC SHA-256 and "A128KW".
     */
    case PBES2_HS256_A128KW = 'pbes2_hs256_a128kw';


    /**
     * PBES2 with HMAC SHA-384 and "A192KW".
     */
    case PBES2_HS384_A192KW = 'pbes2_hs384_a192kw';


    /**
     * PBES2 with HMAC SHA-512 and "A256KW".
     */
    case PBES2_HS512_A256KW = 'pbes2_hs512_a256kw';
}

