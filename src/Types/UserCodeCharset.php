<?php
//
// Copyright (C) 2020 Authlete, Inc.
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
 * File containing the definition of UserCodeCharset class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Character set for end-user verification codes in Device Flow.
 *
 * @see https://tools.ietf.org/html/rfc8628#section-6.1 RFC 8628 OAuth 2.0 Device Authorization Grant, 6.1. User Code Recommendations
 *
 * @since 1.8
 */
enum UserCodeCharset: string implements Valuable
{
    use EnumTrait;


    /**
     * "BCDFGHJKLMNPQRSTVWXZ", 20 upper-case non-vowel characters.
     */
    case BASE20 = 'BASE20';


    /**
     * "0123456789", 10 digit characters from '0' to '9'.
     */
    case NUMERIC = 'NUMERIC';
}

