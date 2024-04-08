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
 * File containing the definition of Prompt class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Values for the "prompt" request parameter defined in
 * OpenID Connect Core 1.0.
 *
 * @see https://openid.net/specs/openid-connect-core-1_0.html OpenID Connect Core 1.0
 */
enum Prompt: string implements Valuable
{
    use EnumTrait;


    /**
     * The Authorization Server MUST NOT display any authentication or
     * consent user interface pages. An error is returned if an End-User
     * is not already authenticated or the Client does not have
     * pre-configured consent for the requested Claims or does not
     * fulfill other conditions for processing the request. The error
     * code will typically be `login_required`, `interaction_required`,
     * or another code defined in Section 3.1.2.6 (OIDC Core 1.0).
     * This can be used as a method to check for existing authentication
     * and/or consent.
     */
    case NONE = 'none';


    /**
     * The Authorization Server SHOULD prompt the End-User for
     * reauthentication. If it cannot reauthenticate the End-User, it
     * MUST return an error, typically `login_required`.
     */
    case LOGIN = 'login';


    /**
     * The Authorization Server SHOULD prompt the End-User for consent
     * before returning information to the Client. If it cannot obtain
     * consent, it MUST return an error, typically `consent_required`.
     */
    case CONSENT = 'consent';


    /**
     * The Authorization Server SHOULD prompt the End-User to select
     * a user account. This enables an End-User who has multiple
     * accounts at the Authorization Server to select amongst the
     * multiple accounts that they might have current sessions for.
     * If it cannot obtain an account selection choice made by the
     * End-User, it MUST return an error, typically
     * `account_selection_required`.
     */
    case SELECT_ACCOUNT = 'select_account';
}
