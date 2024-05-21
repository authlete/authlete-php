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
 * File containing the definition of AuthleteEnvConfiguration class.
 */


namespace Authlete\Conf;


use Authlete\Util\LanguageUtility;


/**
 * An implementation of the \Authlete\Conf\AuthleteConfiguration
 * interface that utilizes environment variables.
 *
 * This class refers to the following environment variables.
 *
 * * `AUTHLETE_BASE_URL` - The base URL of an Authlete server.
 * * `AUTHLETE_SERVICEOWNER_APIKEY` - The API key of a service owner.
 * * `AUTHLETE_SERVICEOWNER_APISECRET` - The API secret of a service owner.
 * * `AUTHLETE_SERVICE_APIKEY` - The API key of a service.
 * * `AUTHLETE_SERVICE_APISECRET` - The API secret of a service.
 */
class AuthleteEnvConfiguration implements AuthleteConfiguration
{
    use AuthleteConfigurationTrait;


    private static string $ENV_BASE_URL                 = 'AUTHLETE_BASE_URL';
    private static string $ENV_SERVICE_OWNER_API_KEY    = 'AUTHLETE_SERVICEOWNER_APIKEY';
    private static string $ENV_SERVICE_OWNER_API_SECRET = 'AUTHLETE_SERVICEOWNER_APISECRET';
    private static string $ENV_SERVICE_API_KEY          = 'AUTHLETE_SERVICE_APIKEY';
    private static string $ENV_SERVICE_API_SECRET       = 'AUTHLETE_SERVICE_APISECRET';
    private static string $ENV_SERVICE_ACCESS_TOKEN     = 'AUTHLETE_SERVICE_ACCESS_TOKEN';
    private static string $ENV_AUTHLETE_API_VERSION     = 'AUTHLETE_API_VERSION';


    /**
     * Constructor which refers to the environment variables and sets up
     * the corresponding properties.
     */
    public function __construct()
    {
        $this->baseUrl               = LanguageUtility::getFromEnv(self::$ENV_BASE_URL);
        $this->serviceOwnerApiKey    = LanguageUtility::getFromEnv(self::$ENV_SERVICE_OWNER_API_KEY);
        $this->serviceOwnerApiSecret = LanguageUtility::getFromEnv(self::$ENV_SERVICE_OWNER_API_SECRET);
        $this->serviceApiKey         = LanguageUtility::getFromEnv(self::$ENV_SERVICE_API_KEY);
        $this->serviceApiSecret      = LanguageUtility::getFromEnv(self::$ENV_SERVICE_API_SECRET);
        $this->serviceAccessToken    = LanguageUtility::getFromEnv(self::$ENV_SERVICE_ACCESS_TOKEN);
        $this->apiVersion            = LanguageUtility::getFromEnv(self::$ENV_AUTHLETE_API_VERSION);
    }
}

