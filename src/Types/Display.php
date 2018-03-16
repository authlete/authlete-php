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
 * File containing the definition of Display class.
 */


namespace Authlete\Types;


use Authlete\Util\LanguageUtility;


/**
 * Values for the "display" request parameter defined in
 * OpenID Connect Core 1.0 and for the "display_values_supported"
 * metadata defined in OpenID Connect Discovery 1.0.
 *
 * @see https://openid.net/specs/openid-connect-core-1_0.html OpenID Connect Core 1.0
 * @see https://openid.net/specs/openid-connect-discovery-1_0.html OpenID Connect Discovery 1.0
 */
class Display
{
    use EnumTrait;


    /**
     * The Authorization Server SHOULD display the authentication and
     * consent UI consistent with a full User Agent page view. If the
     * `display` parameter is not specified, this is the display mode.
     *
     * @static
     * @var Display
     */
    public static $PAGE;


    /**
     * The Authorization Server SHOULD display the authentication and
     * consent UI consistent with a popup User Agent window. The popup
     * User Agent window should be of an appropriate size for a
     * login-focused dialog and should not obscure the entire window
     * that it is popping up over.
     *
     * @static
     * @var Display
     */
    public static $POPUP;


    /**
     * The Authorization Server SHOULD display the authentication and
     * consent UI consistent with a device that leverages a touch
     * interface.
     *
     * @static
     * @var Display
     */
    public static $TOUCH;


    /**
     * The Authorization Server SHOULD display the authentication and
     * consent UI consistent with a "feature phone" type display.
     *
     * @static
     * @var Display
     */
    public static $WAP;
}


// Call Display::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\Display');
?>
