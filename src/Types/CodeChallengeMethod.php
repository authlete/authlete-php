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
 * File containing the definition of CodeChallengeMethod class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Values for the "code_challenge_method" metadata defined in
 * RFC 7636 (Proof Key for Code Exchange by OAuth Public Clients).
 *
 * @see https://tools.ietf.org/html/rfc7636 RFC 7636
 */
class CodeChallengeMethod
{
    use EnumTrait;


    /**
     * "plain".
     *
     * This means:
     *
     * ```
     * code_challenge = code_verifier
     * ```
     *
     * See "[4.2. Client Creates the Code Challenge](https://tools.ietf.org/html/rfc7636#section-4.2)"
     * of [RFC 7636](https://tools.ietf.org/html/rfc7636) for details.
     *
     * @static
     * @var CodeChallengeMethod
     */
    public static $PLAIN;


    /**
     * "S256".
     *
     * This means:
     *
     * ```
     * code_challenge = BASE64URL-ENCODE(SHA256(ASCII(code_verifier)))
     * ```
     *
     * See "[4.2. Client Creates the Code Challenge](https://tools.ietf.org/html/rfc7636#section-4.2)"
     * of [RFC 7636](https://tools.ietf.org/html/rfc7636) for details.
     *
     * @static
     * @var CodeChallengeMethod
     */
    public static $S256;
}


// Call CodeChallengeMethod::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\CodeChallengeMethod');
?>
