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
 * File containing the definition of JWSAlg class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * "alg" (Algorithm) Header Parameter Values for JWS defined in RFC 7518.
 *
 * @see https://tools.ietf.org/html/rfc7518#section-3.1 RFC 7518, 3.1. "alg" (Algorithm) Header Parameter Values for JWS
 */
enum JWSAlg: string implements Valuable
{
    use EnumTrait;


    /**
     * No digital signature or MAC performed.
     */
    case NONE = 'NONE';


    /**
     * HMAC using SHA-256.
     */
    case HS256 = 'HS256';


    /**
     * HMAC using SHA-384.
     */
    case HS384 = 'HS384';


    /**
     * HMAC using SHA-512.
     */
    case HS512 = 'HS512';


    /**
     * RSASSA-PKCS-v1_5 using SHA-256.
     */
    case RS256 = 'RS256';


    /**
     * RSASSA-PKCS-v1_5 using SHA-384.
     */
    case RS384 = 'RS384';


    /**
     * RSASSA-PKCS-v1_5 using SHA-512.
     */
    case RS512 = 'RS512';


    /**
     * ECDSA using P-256 and SHA-256.
     */
    case ES256 = 'ES256';


    /**
     * ECDSA using P-384 and SHA-384.
     */
    case ES384 = 'ES384';


    /**
     * ECDSA using P-521 and SHA-512.
     */
    case ES512 = 'ES512';


    /**
     * RSASSA-PSS using SHA-256 and MGF1 with SHA-256.
     */
    case PS256 = 'PS256';


    /**
     * RSASSA-PSS using SHA-384 and MGF1 with SHA-384.
     */
    case PS384 = 'PS384';


    /**
     * RSASSA-PSS using SHA-512 and MGF1 with SHA-512.
     */
    case PS512 = 'PS512';
}
