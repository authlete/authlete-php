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
 * File containing the definition of ServiceProfile class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Service profile
 */
enum ServiceProfile: string implements Valuable
{
    use EnumTrait;


    /**
     * Financial-grade API.
     *
     * @see https://openid.net/wg/fapi/ Financial-grade API Working Group Website
     * @see https://bitbucket.org/openid/fapi/ Financial-grade API Working Group Repository
     */
    case FAPI = 'fapi';


    /**
     * Open Banking.
     *
     * @see https://www.openbanking.org.uk/ Open Banking
     *
     * @since 1.7
     */
    case OPEN_BANKING = 'open_banking';
}