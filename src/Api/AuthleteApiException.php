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


/**
 * Exception that methods of the \Authlete\Api\AuthleteApi
 * interface may throw.
 *
 * @link \Authlete\Api\AuthleteApi
 */
class AuthleteApiException extends \Exception
{
    private $statusCode   = 0;     // integer
    private $responseBody = null;  // string


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
     * @param string $responseBody
     *     An HTTP response body. This argument is optional and its default
     *     value is `null`. This value is available through `getResponseBody()`
     *     method.
     *
     * @throws \InvalidArgumentException
     *     Types of arguments are invalid.
     */
    public function __construct($message, $statusCode = 0, $responseBody = null)
    {
        ValidationUtility::ensureNullOrString('$message', $message);
        ValidationUtility::ensureInteger('$statusCode', $statusCode);
        ValidationUtility::ensureNullOrString('$responseBody', $responseBody);

        parent::__construct($message);

        $this->statusCode   = $statusCode;
        $this->responseBody = $responseBody;
    }


    /**
     * Get the HTTP status code of a response from an Authlete API.
     *
     * @return integer
     *     HTTP status code. If this exception was thrown before an
     *     HTTP status code was read, this method returns 0.
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * Get the HTTP response body of a response from an Authlete API.
     *
     * @return string
     *     HTTP response body. This may be `null`.
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }
}
?>
