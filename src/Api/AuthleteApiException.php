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
 * File containing the definition of AuthleteApiException class.
 */


namespace Authlete\Api;


use Authlete\Util\ValidationUtility;
use Authlete\Web\HttpHeaders;


/**
 * Exception that methods of the \Authlete\Api\AuthleteApi
 * interface may throw.
 *
 * @link \Authlete\Api\AuthleteApi
 */
class AuthleteApiException extends \Exception
{
    private int              $statusCode;
    private HttpHeaders|null $responseHeaders;
    private string|null      $responseBody;


    /**
     * Constructor.
     *
     * @param string $message
     *     An error message. This argument is passed to the constructor
     *     of the parent class. This value is available through
     *     `getMessage()` method.
     *
     * @param integer $statusCode
     *     An HTTP status code. This argument is optional and its default
     *     value is 0. This value is available through `getStatusCode()`
     *     method.
     *
     * @param HttpHeaders|null $responseHeaders
     *     HTTP response headers. This argument is optional and its default
     *     value is `null`. This value is available through `getResponseHeaders()`
     *     method. If `null` is given, however, `getResponseHeader()` will
     *     return an empty `HttpHeaders` instance.
     *
     * @param string|null $responseBody
     *     An HTTP response body. This argument is optional and its default
     *     value is `null`. This value is available through `getResponseBody()`
     *     method.
     *
     */
    public function __construct(
        string $message, int $statusCode = 0, HttpHeaders $responseHeaders = null, string $responseBody = null)
    {
        ValidationUtility::ensureNullOrString('$message', $message);
        ValidationUtility::ensureInteger('$statusCode', $statusCode);
        ValidationUtility::ensureNullOrType('$responseHeaders', $responseHeaders, '\Authlete\Web\HttpHeaders');
        ValidationUtility::ensureNullOrString('$responseBody', $responseBody);

        parent::__construct($message);

        if (is_null($responseHeaders))
        {
            $responseHeaders = new HttpHeaders();
        }

        $this->statusCode      = $statusCode;
        $this->responseHeaders = $responseHeaders;
        $this->responseBody    = $responseBody;
    }


    /**
     * Get the HTTP status code of a response from an Authlete API.
     *
     * @return integer
     *     HTTP status code. If this exception was thrown before an
     *     HTTP status code was read, this method returns 0.
     */
    public function getStatusCode() :int
    {
        return $this->statusCode;
    }


    /**
     * Get the HTTP headers of a response from an Authlete API.
     *
     * @return HttpHeaders|null HTTP response headers.
     *     HTTP response headers.
     *
     * @since 1.2
     */
    public function getResponseHeaders(): HttpHeaders|null
    {
        return $this->responseHeaders;
    }


    /**
     * Get the HTTP response body of a response from an Authlete API.
     *
     * @return string
     *     HTTP response body. This may be `null`.
     */
    public function getResponseBody() :string
    {
        return $this->responseBody;
    }
}
