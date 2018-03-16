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
 * File containing the definition of JWEEnc class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * "enc" (Encryption Algorithm) Header Parameter Values for JWE
 * defined in RFC 7518.
 *
 * @see https://tools.ietf.org/html/rfc7518#section-5.1 RFC 7518, 5.1. "enc" (Encryption Algorithm) Header Parameter Values for JWE
 */
class JWEEnc
{
    use EnumTrait;


    /**
     * Algorithm defined in "5.2.3. AES_128_CBC_HMAC_SHA_256" of RFC 7518.
     *
     * @static
     * @var JWEEnc
     *
     * @see https://tools.ietf.org/html/rfc7518#section-5.2.3 RFC 7518, 5.2.3. AES_128_CBC_HMAC_SHA_256
     */
    public static $A128CBC_HS256;


    /**
     * Algorithm defined in "5.2.4. AES_192_CBC_HMAC_SHA_384" of RFC 7518.
     *
     * @static
     * @var JWEEnc
     *
     * @see https://tools.ietf.org/html/rfc7518#section-5.2.4 RFC 7518, 5.2.4. AES_192_CBC_HMAC_SHA_384
     */
    public static $A192CBC_HS384;


    /**
     * Algorithm defined in "5.2.5. AES_256_CBC_HMAC_SHA_512" of RFC 7518.
     *
     * @static
     * @var JWEEnc
     *
     * @see https://tools.ietf.org/html/rfc7518#section-5.2.5 RFC 7518, 5.2.5. AES_256_CBC_HMAC_SHA_512
     */
    public static $A256CBC_HS512;


    /**
     * AES GCM using 128 bit key.
     *
     * @static
     * @var JWEEnc
     */
    public static $A128GCM;


    /**
     * AES GCM using 192 bit key.
     *
     * @static
     * @var JWEEnc
     */
    public static $A192GCM;


    /**
     * AES GCM using 256 bit key.
     *
     * @static
     * @var JWEEnc
     */
    public static $A256GCM;
}


// Call JWEEnc::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\JWEEnc');
?>
