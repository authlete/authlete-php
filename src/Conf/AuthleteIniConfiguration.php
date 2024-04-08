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
 * File containing the definition of AuthleteIniConfiguration class.
 */


namespace Authlete\Conf;


use Authlete\Util\LanguageUtility;


/**
 * An implementation of the \Authlete\Conf\AuthleteConfiguration interface
 * that refers to an ini file which parse_ini_file() can interpret.
 *
 * This is a utility class to load a configuration file that includes
 * configuration items related to Authlete. Below is the list of
 * configuration items this utility class can interpret.
 *
 * * `base_url` - The base URL of an Authlete server. The default value is `https://api.authlete.com`.
 * * `service_owner.api_key` - The API key of a service owner.
 * * `service_owner.api_secret` - The API secret of a service owner.
 * * `service.api_key` - The API key of a service.
 * * `service.api_secret` - The API secret of a service.
 */
class AuthleteIniConfiguration implements AuthleteConfiguration
{
    use AuthleteConfigurationTrait;


    private static string $DEFAULT_FILE                 = 'authlete.ini';
    private static string $ENV_CONFIG_FILE              = 'AUTHLETE_CONFIGURATION_FILE';
    private static string $KEY_BASE_URL                 = 'base_url';
    private static string $KEY_SERVICE_OWNER_API_KEY    = 'service_owner.api_key';
    private static string $KEY_SERVICE_OWNER_API_SECRET = 'service_owner.api_secret';
    private static string $KEY_SERVICE_API_KEY          = 'service.api_key';
    private static string $KEY_SERVICE_API_SECRET       = 'service.api_secret';
    private static string $DEFAULT_BASE_URL             = 'https://api.authlete.com';


    /**
     * Constructor.
     *
     * This constructor tries to read a configuration file specified by
     * the `$file` argument. If the argument is omitted or its value is
     * `null`, this constructor refers to the environment variable,
     * `AUTHLETE_CONFIGURATION_FILE`. If the environment variable is
     * defined and holds a non-empty value, the value of the environment
     * variable is regarded as the name of a configuration file.
     * Otherwise, `authlete.ini` is used as the name of a configuration
     * file.
     *
     * @param string|null $file
     *     The name of a configuration file. This parameter is optional
     *     and its default value is `null`.
     *
     * @throws \RuntimeException
     *     `parse_ini_file()` failed to parse the configuration file.
     */
    public function __construct(string $file = null)
    {
        if (is_null($file))
        {
            $file = self::getConfigFileName();
        }

        $conf = parse_ini_file($file);

        if (!is_array($conf))
        {
            throw new \RuntimeException("Failed to parse '$file'.");
        }

        self::setup($conf);
    }


    private static function getConfigFileName(): bool|array|string
    {
        $file = getenv(self::$ENV_CONFIG_FILE);

        if (empty($file))
        {
            $file = self::$DEFAULT_FILE;
        }

        return $file;
    }


    private function setup($conf): void
    {
        // baseUrl
        $this->baseUrl =
            LanguageUtility::getFromArray(
                self::$KEY_BASE_URL, $conf);

        if (is_null($this->baseUrl))
        {
            $this->baseUrl = self::$DEFAULT_BASE_URL;
        }

        // service_owner.api_key
        $this->serviceOwnerApiKey =
            LanguageUtility::getFromArray(
                self::$KEY_SERVICE_OWNER_API_KEY, $conf);

        // service_owner.api_secret
        $this->serviceOwnerApiSecret =
            LanguageUtility::getFromArray(
                self::$KEY_SERVICE_OWNER_API_SECRET, $conf);

        // service.api_key
        $this->serviceApiKey =
            LanguageUtility::getFromArray(
                self::$KEY_SERVICE_API_KEY, $conf);

        // service_.api_secret
        $this->serviceApiSecret =
            LanguageUtility::getFromArray(
                self::$KEY_SERVICE_API_SECRET, $conf);
    }
}

