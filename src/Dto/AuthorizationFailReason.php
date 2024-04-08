<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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
 * File containing the definition of AuthorizationFailReason class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "reason" in requests to Authlete's
 * /api/auth/authorization/fail API.
 */
enum AuthorizationFailReason: string implements Valuable
{
    use EnumTrait;


    /**
     * Unknown reason.
     *
     * Using this reason will result in `error=server_error`.
     */
    case UNKNOWN = 'unknown';


    /**
     * The authorization request from the client application contained
     * "prompt=none", but any end-user has not logged in.
     *
     * Using this reason will result in `error=login_required`.
     */
    case NOT_LOGGED_IN = 'not_logged_in';


    /**
     * The authorization request from the client application contained the
     * "max_age" request parameter with a non-zero value or the client's
     * configuration has a non-zero value for the "default_max_age"
     * configuration parameter, but the authorization server implementation
     * cannot behave properly based on the max age value mainly because the
     * authorization server implementation does not manage authentication
     * time of end-users.
     *
     * Using this reason will result in `error=login_required`.
     */
    case MAX_AGE_NOT_SUPPORTED = 'max_age_not_supported';


    /**
     * The authorization request from the client application contained
     * "prompt=none", but the time specified by the "max_age" request
     * parameter or by the "default_max_age" configuration parameter
     * has passed since the time at which the end-user logged in.
     *
     * Using this reason will result in `error=login_required`.
     */
    case EXCEEDS_MAX_AGE = 'exceeds_max_age';


    /**
     * The authorization request from the client application requested a
     * specific value for the "sub" claim, but the current end-user (in
     * the case of prompt=none) or the end-user after the authentication
     * is different from the specified value.
     *
     * Using this reason will result in `error=login_required`.
     */
    case DIFFERENT_SUBJECT = 'different_subject';


    /**
     * The authorization request from the client application contained the
     * "acr" claim in the "claims" request parameter and the claim was
     * marked as essential, but the ACR performed for the end-user does not
     * match any one of the requested ACRs.
     *
     * Using this reason will result in `error=login_required`.
     */
    case ACR_NOT_SATISFIED = 'acr_not_satisfied';


    /**
     * The end-user denied the authorization request from the client
     * application.
     *
     * Using this reason will result in `error=access_denied`.
     */
    case DENIED = 'denied';


    /**
     * Server error.
     *
     * Using this reason will result in `error=server_error`.
     */
    case SERVER_ERROR = 'server_error';


    /**
     * The end-user was not authenticated.
     *
     * Using this reason will result in `error=login_required`.
     */
    case NOT_AUTHENTICATED = 'not_authenticated';


    /**
     * The authorization server cannot obtain an account selection choice
     * made by the end-user.
     *
     * Using this reason will result in `error=account_selection_required`.
     */
    case ACCOUNT_SELECTION_REQUIRED = 'account_selection_required';


    /**
     * The authorization server cannot obtain consent from the end-user.
     *
     * Using this reason will result in `error=consent_required`.
     */
    case CONSENT_REQUIRED = 'consent_required';


    /**
     * The authorization server needs interaction with the end-user.
     *
     * Using this reason will result in `error=interaction_required`.
     */
    case INTERACTION_REQUIRED = 'interaction_required';


    /**
     * The requested resource is invalid, missing, unknown, or malformed.
     *
     * Using this reason will result in `error=invalid_target`.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    case INVALID_TARGET = 'invalid_target';
}

