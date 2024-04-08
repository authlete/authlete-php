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
 * File containing the definition of MaxAgeValidator class.
 */


namespace Authlete\Util;


/**
 * Utility to validate that the maximum authentication age has not passed
 * since the last user authetication time.
 *
 * This utility uses GMP as necessary.
 */
class MaxAgeValidator
{
    private int|string $maxAge;
    private int|string $authTime;
    private int|string $currentTime;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->maxAge      = 0;
        $this->authTime    = 0;
        $this->currentTime = time();
    }


    /**
     * Set the maximum authentication age.
     *
     * @param integer|string $maxAge
     *     The maximum authentication age.
     *
     * @return MaxAgeValidator
     *     `$this` object.
     */
    public function setMaxAge(int|string $maxAge): MaxAgeValidator
    {
        $this->maxAge = $maxAge;

        return $this;
    }


    /**
     * Set the time which the user was authenticated at.
     *
     * @param integer|string $authTime
     *     The time which the user was authenticated at.
     *
     * @return MaxAgeValidator
     *     `$this` object.
     */
    public function setAuthenticationTime(int|string $authTime): MaxAgeValidator
    {
        $this->authTime = $authTime;

        return $this;
    }


    /**
     * Set the current time. The default value is "time()".
     *
     * @param integer|string $currentTime
     *
     * @return MaxAgeValidator
     *     `$this` object.
     */
    public function setCurrentTime(int|string $currentTime): MaxAgeValidator
    {
        $this->currentTime = $currentTime;

        return $this;
    }


    /**
     * Validate that the maximum authentication age has not passed
     * since the last user authentication time.
     *
     * @return boolean
     *     `true` when the maximum authentication age has not passed since the
     *     last user authentication time. If `false` is returned, it means
     *     re-authentication is necessary.
     */
    public function validate(): bool
    {
        $maxAge      = $this->maxAge;
        $authTime    = $this->authTime;
        $currentTime = $this->currentTime;

        // If no maximum authentication age is requested.
        if (empty($maxAge))
        {
            // No need to care about the maximum authentication age.
            return true;
        }

        if (PHP_INT_SIZE <= 4 ||
            is_int($maxAge) || !is_int($authTime))
        {
            // The variables may be strings.
            return $this->validateAsStrings($maxAge, $authTime, $currentTime);
        }
        else
        {
            return $this->validateAsIntegers($maxAge, $authTime, $currentTime);
        }
    }


    private function validateAsStrings($maxAge, $authTime, $currentTime): bool
    {
        // Note that behaviors of GMP functions in PHP 5.6+ are slightly
        // different from those in older PHP versions.

        // If the PHP runtime does not have GMP extension, the following
        // code will throw an exception.

        // Calculate the expiration time in seconds.
        $gmpAuthTime  = gmp_init($authTime);
        $gmpMaxAge    = gmp_init($maxAge);
        $gmpExpiresAt = gmp_add($gmpAuthTime, $gmpMaxAge);

        // The current time in seconds since the Unix epoch.
        $gmpCurrent = gmp_init($currentTime);

        if (gmp_cmp($gmpCurrent, $gmpExpiresAt) < 0)
        {
            // The max age has not been reached.
            return true;
        }

        // The max age has been reached.
        return false;
    }


    private function validateAsIntegers(int $maxAge,int $authTime, int $currentTime): bool
    {
        // Calculate the expiration time in seconds.
        $expiresAt = $authTime + $maxAge;

        return $currentTime < $expiresAt;
    }
}

