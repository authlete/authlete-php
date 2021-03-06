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
 * File containing the definition of IntrospectionAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * Get the value of "action" in responses from Authlete's
 * /api/auth/introspection API.
 */
class IntrospectionAction
{
    use EnumTrait;


    /**
     * The request from the resource server was wrong or an error occurred
     * in Authlete.
     *
     * The resource server should return `500 Internal Server Error` to the
     * client application.
     *
     * @static
     * @var IntrospectionAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The request does not contain an access token.
     *
     * The resource server should return `400 Bad Request` to the client
     * application.
     *
     * @static
     * @var IntrospectionAction
     */
    public static $BAD_REQUEST;


    /**
     * The access token does not exist or has expired.
     *
     * The resource server should return `401 Unauthorized` to the client
     * application.
     *
     * @static
     * @var IntrospectionAction
     */
    public static $UNAUTHORIZED;


    /**
     * The access token does not cover the required scopes.
     *
     * The resource server should return `403 Forbidden` to the client
     * application.
     *
     * @static
     * @var IntrospectionAction
     */
    public static $FORBIDDEN;


    /**
     * The access token is valid.
     *
     * The resource server should return the protected resource to the
     * client application.
     *
     * @static
     * @var IntrospectionAction
     */
    public static $OK;
}


// Call IntrospectionAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\IntrospectionAction');
?>
