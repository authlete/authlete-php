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
 * File containing the definition of DeliveryMode class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Modes of CIBA flow.
 *
 * @see https://openid.net/specs/openid-client-initiated-backchannel-authentication-core-1_0.html OpenID Connect Client Initiated Backchannel Authentication Flow - Core 1.0
 *
 * @since 1.8
 */
enum DeliveryMode: string implements Valuable
{
    use EnumTrait;


    /**
     * Poll mode, a backchannel token delivery mode where a client polls
     * the token endpoint until it gets tokens.
     */
    case POLL = 'POLL';


    /**
     * Ping mode, a backchannel token delivery mode where a client is
     * notified via its client notification endpoint and then gets tokens
     * from the token endpoint.
     */
    case PING = 'PING';


    /**
     * Push mode, a backchannel token delivery mode where a client receives
     * tokens at its client notification endpoint.
     */
    case PUSH = 'PUSH';
}

