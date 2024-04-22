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
 * Types of hints for end-user identification.
 *
 * @since 1.8
 */
enum UserIdentificationHintType: string implements Valuable
{
    use EnumTrait;

    /**
     * An ID token previously issued to the client.
     */
    case ID_TOKEN_HINT = 'ID_TOKEN_HINT';


    /**
     * An arbitrary string whose interpretation varies depending on contexts.
     */
    case LOGIN_HINT = 'LOGIN_HINT';


    /**
     * A token whose format is deployment or profile specific.
     */
    case LOGIN_HINT_TOKEN = 'LOGIN_HINT_TOKEN';
}

