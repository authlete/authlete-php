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
 * File containing the definition of AuthleteConfiguration interface.
 */


namespace Authlete\Conf;


/**
 * Configuration to access Authlete APIs.
 */
interface AuthleteConfiguration
{
    /**
     * Get the base URL of an Authlete server.
     *
     * @return string|null
     *     The base URL of an Authlete server.
     *     For example, `https://api.authlete.com`.
     */
    public function getBaseUrl(): ?string;


    /**
     * Get the API key of a service owner.
     *
     * @return string|null
     *     The API key of a service owner.
     */
    public function getServiceOwnerApiKey(): ?string;


    /**
     * Get the API secret of a service owner.
     *
     * @return string|null
     *     The API key of a service owner.
     */
    public function getServiceOwnerApiSecret(): ?string;


    /**
     * Get the API key of a service.
     *
     * @return string|null
     *     The API key of a service.
     */
    public function getServiceApiKey(): ?string;


    /**
     * Get the API secret of a service.
     *
     * @return string|null
     *     The API key of a service.
     */
    public function getServiceApiSecret(): ?string;
}
