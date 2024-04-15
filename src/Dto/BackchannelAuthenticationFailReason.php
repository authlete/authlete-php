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
 * File containing the definition of BackchannelAuthenticationFailReason class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;


/**
 * The value of "reason" in requests to Authlete's
 * /api/backchannel/authentication/fail API.
 *
 * @since 1.8
 */
enum BackchannelAuthenticationFailReason: string implements Valuable
{
    use EnumTrait;


    /**
     * The `login_hint_token` included in the backchannel authentication
     * request is not valid because it has expired.
     *
     * Note that the CIBA Core specification does not describe the format of
     * `login_hint_token` and how to detect expiration.
     *
     * Using this reason will result in `"error":"expired_login_hint_token"`.
     */
    case EXPIRED_LOGIN_HINT_TOKEN = 'EXPIRED_LOGIN_HINT_TOKEN';


    /**
     * The authorization server is not able to identify which end-user the
     * client wishes to be authenticated by means of the hint
     * (`login_hint_token`, `id_token_hint` or `login_hint`) included in
     * the backchannel authentication request.
     *
     * Using this reason will result in `"error":"unknown_user_id"`.
     */
    case UNKNOWN_USER_ID = 'UNKNOWN_USER_ID';


    /**
     * The client is not authorized to use the CIBA flow.
     *
     * Note that `/api/backchannel/authentication` API does not return
     * `"action":"USER_IDENTIFICATION"` in cases where the client does not
     * exist or client authentication has failed. Therefore, the authorization
     * server implementation will never have to call
     * `/api/backchannel/authentication/fail` API with
     * `"reason":"UNAUTHORIZED_CLIENT"` unless the server has intentionally
     * implemented custom rules to reject backchannel authentication requests
     * from particular clients.
     *
     * Using this reason will result in `"error":"unauthorized_client"`.
     */
    case UNAUTHORIZED_CLIENT = 'UNAUTHORIZED_CLIENT';


    /**
     * A user code is required but the backchannel authentication request does
     * not contain it.
     *
     * Note that `/api/backchannel/authentication` API does not return
     * `"action":"USER_IDENTIFICATION"` when both the
     * `backchannel_user_code_parameter_supported` metadata of the service and
     * the `backchannel_user_code_parameter` metadata of the client are `true`
     * and the backchannel authentication request does not include the
     * `user_code` request parameter. In this case,
     * `/api/backchannel/authentication` API returns `"action":"BAD_REQUEST"`
     * with JSON containing `"error":"missing_user_code"`.
     *
     * Therefore, the authorization server implementation will never have to
     * call `/api/backchannel/authentication/fail` API with
     * `"reason":"MISSING_USER_CODE"` unless the server has intentionally
     * implemented custom rules to require a user code even in the case where
     * the `backchannel_user_code_parameter` metadata of the client which has
     * made the backchannel authentication request is `false`.
     *
     * Using this reason will result in `"error":"missing_user_code"`.
     */
    case MISSING_USER_CODE = 'MISSING_USER_CODE';


    /**
     * The user code included in the backchannel authentication request is
     * invalid.
     *
     * Using this reason will result in `"error":"invalid_user_code"`.
     */
    case INVALID_USER_CODE = 'INVALID_USER_CODE';


    /**
     * The binding message is invalid or unacceptable for use in the context
     * of the given backchannel authentication request.
     *
     * Using this reason will result in `"error":"invalid_binding_message"`.
     */
    case INVALID_BINDING_MESSAGE = 'INVALID_BINDING_MESSAGE';


    /**
     * The requested resource is invalid, missing, unknown, or malformed.
     *
     * Using this reason will result in `"error":"invalid_target"`.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     */
    case INVALID_TARGET = 'INVALID_TARGET';


    /**
     * The resource owner or the authorization server denied the request.
     *
     * Calling `/api/backchannel/authentication/fail` API with this reason
     * implies that the backchannel authentication endpoint is going to
     * return an error of `access_denied` to the client application without
     * asking the end-user whether she authorizes or rejects the request.
     *
     * Using this reason will result in `"error":"access_denied"`.
     */
    case ACCESS_DENIED = 'ACCESS_DENIED';


    /**
     * The backchannel authentication request cannot be processed
     * successfully due to a server-side error.
     *
     * Using this reason will result in `"error":"server_error"`.
     */
    case SERVER_ERROR = 'SERVER_ERROR';
}
