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
 * File containing the definition of ClientType class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Client types defined in "2.1. Client Types" of RFC 6749.
 *
 * @see https://tools.ietf.org/html/rfc6749#section-2.1 RFC 6749, 2.1. Client Types
 */
enum ClientType: string implements Valuable
{
    use EnumTrait;



    /**
     * Clients incapable of maintaining the confidentiality of their
     * credentials. Typical examples are native applications on smart
     * phones.
     */
    case PUBLIC = 'public';


    /**
     * Clients capable of maintaining the confidentiality of their
     * credentials.
     */
    case CONFIDENTIAL = 'confidential';
}