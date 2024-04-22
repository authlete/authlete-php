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
 * File containing the definition of BasicCredentials class.
 */


namespace Authlete\Web;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * A class that represents a pair of user ID and password.
 */
class BasicCredentials
{
    private static string $CHALLENGE_PATTERN = '/^Basic *(?<parameter>[^ ]+) *$/i';


    private ?string $userId;
    private ?string $password;
    private ?string $credentials;


    /**
     * Constructor.
     *
     * @param string|null $userId
     *     User ID.
     *
     * @param string|null $password
     *     Password.
     */
    public function __construct(?string $userId, ?string $password)
    {
        ValidationUtility::ensureNullOrString('$userId', $userId);
        ValidationUtility::ensureNullOrString('$password', $password);

        $this->userId      = $userId;
        $this->password    = $password;
        $this->credentials = self::formatCredentials($userId, $password);
    }


    /**
     * Get the user ID.
     *
     * @return string|null
     *     User ID.
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }


    /**
     * Get the password.
     *
     * @return string|null
     *     Password.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }


    /**
     * Get the credentials in "userid:password" format which is
     * suitable as a parameter part of Basic Authentication.
     *
     * @return string|null
     *     Credentials in "userid:password" format.
     */
    public function getCredentials(): ?string
    {
        return $this->credentials;
    }


    private static function formatCredentials($userId, $password): string
    {
        // Build a plain text, "{userId}:{password}".
        return sprintf('%s:%s',
            LanguageUtility::orEmpty($userId),
            LanguageUtility::orEmpty($password));
    }


    /**
     * Create a BasicCredentials instance from the given string
     * whose format is expected to be "Basic {base64-encoded-string}".
     *
     * If the given string is `null` or it does not match the pattern,
     * a `BasicCredentials` instance whose user ID and password are
     * both `null` is returned.
     *
     * @param string $authorizationHeaderValue
     *     A value of `Authorization` header whose scheme is `Basic`.
     *
     * @return BasicCredentials
     *     A `BasicCredentials` instance generated based on the
     *     information of the given string.
     */
    public static function parse(mixed $authorizationHeaderValue): BasicCredentials
    {
        if (is_null($authorizationHeaderValue))
        {
            // $userId = null, $password = null
            return new BasicCredentials(null, null);
        }

        $ret = preg_match(
            self::$CHALLENGE_PATTERN, $authorizationHeaderValue, $matches);

        // If the input string does not match the pattern.
        if ($ret !== 1)
        {
            // $userId = null, $password = null
            return new BasicCredentials(null, null);
        }

        // Base64-encoded "{userId}:{password}".
        $base64String = $matches['parameter'];

        return self::buildFromParameter($base64String);
    }


    private static function buildFromParameter($base64String): BasicCredentials
    {
        if (is_null($base64String) || empty($base64String))
        {
            // $userId = null, $password = null
            return new BasicCredentials(null, null);
        }

        // Decode the Base64 string.
        $plainText = base64_decode($base64String);

        // Split "userId:password" into "userId" and "password".
        $elements = explode(':', $plainText, 2);

        $userId   = null;
        $password = null;
        $count    = count($elements);

        // User ID
        if (1 <= $count)
        {
            $userId = $elements[0];
        }

        // Password
        if (2 <= $count)
        {
            $password = $elements[1];
        }

        return new BasicCredentials($userId, $password);
    }
}

