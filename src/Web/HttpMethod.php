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
 * File containing the definition of HttpMethod class.
 */


namespace Authlete\Web;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * HTTP methods listd in "4.3. Method Definitions"
 * in RFC 7231 (HTTP/1.1).
 *
 * @see https://tools.ietf.org/html/rfc7231#section-4.3 RFC 7231 (HTTP/1.1), 4.3. Method Definitions
 */
class HttpMethod
{
    use EnumTrait;


    /**
     * GET.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.1 RFC 7231, 4.3.1. GET
     */
    public static $GET;


    /**
     * HEAD.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.2 RFC 7231, 4.3.2. HEAD
     */
    public static $HEAD;


    /**
     * POST.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.3 RFC 7231, 4.3.3. POST
     */
    public static $POST;


    /**
     * PUT.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.4 RFC 7231, 4.3.4. PUT
     */
    public static $PUT;


    /**
     * DELETE.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.5 RFC 7231, 4.3.5. DELETE
     */
    public static $DELETE;


    /**
     * CONNECT.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.6 RFC 7231, 4.3.6. CONNECT
     */
    public static $CONNECT;


    /**
     * OPTIONS.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.7 RFC 7231, 4.3.7. OPTIONS
     */
    public static $OPTIONS;


    /**
     * TRACE.
     *
     * @var HttpMethod
     * @see https://tools.ietf.org/html/rfc7231#section-4.3.8 RFC 7231, 4.3.8. TRACE
     */
    public static $TRACE;
}


// Call HttpMethod::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\HttpMethod');
?>
