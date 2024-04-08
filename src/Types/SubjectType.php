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
 * File containing the definition of SubjectType class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Subject types. See "8. Subject Identifier Types" of OpenID Connect
 * Core 1.0 for details.
 *
 * @see https://openid.net/specs/openid-connect-core-1_0.html#SubjectIDTypes OpenID Connect Core 1.0, 8. Subject Identifier Types
 */
enum SubjectType: string implements Valuable
{
    use EnumTrait;


    /**
     * This provides the same "sub (subject) value to all Clients.
     * It is the default if the provider has no "subject_types_supported"
     * element in its discovery document.
     */
    case PUBLIC = 'public';


    /**
     * This provides a different "sub" (subject) value to each Client,
     * so as not to enable Clients to correlate the End-User's activities
     * without permission.
     */
    case PAIRWISE = 'pairwise';
}