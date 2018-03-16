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
 * File containing the definition of UserInfoAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /api/auth/userinfo API.
 */
class UserInfoAction
{
    use EnumTrait;


    /**
     * The request from your system was wrong or an error occurred in Authlete.
     *
     * The [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
     * implementation should return `500 Internal Server Error` to the client
     * application.
     *
     * @static
     * @var UserInfoAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The request does not contain an access token.
     *
     * The [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
     * implementation should return `400 Bad Request` to the client
     * application.
     *
     * @static
     * @var UserInfoAction
     */
    public static $BAD_REQUEST;


    /**
     * The access token does not exist or has expired.
     *
     * The [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
     * implementation should return `401 Unauthorized` to the client
     * application.
     *
     * @static
     * @var UserInfoAction
     */
    public static $UNAUTHORIZED;


    /**
     * The access token does not cover the required scopes. To be concrete,
     * the access token does not have the "openid" scope.
     *
     * The [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
     * implementation should return `403 Forbidden` to the client application.
     *
     * @static
     * @var UserInfoAction
     */
    public static $FORBIDDEN;


    /**
     * The access token is valid.
     *
     * The [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
     * implementation should collect information about requested claims and
     * pass the information to Authlete's `/api/auth/userinfo/issue` API in
     * order to make Authlete generate a userinfo response.
     *
     * @static
     * @var UserInfoAction
     */
    public static $OK;
}


// Call UserInfoAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\UserInfoAction');
?>
