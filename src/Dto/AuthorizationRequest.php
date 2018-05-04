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
 * File containing the definition of AuthorizationRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/authorization API.
 *
 * An authorization endpoint implementation is supposed to pass all the
 * request parameters it received from a client application to the API.
 */
class AuthorizationRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $parameters = null;  // string


    /**
     * Get the request parameters that the implementation of your
     * authorization endpoint received from a client application.
     *
     * @return string
     *     Request parameters in `application/x-www-form-urlencoded` format.
     */
    public function getParameters()
    {
        return $this->parameters;
    }


    /**
     * Get the request parameters that the implementation of your
     * authorization endpoint received from a client application.
     *
     * The value passed to this method should be either (1) the entire
     * query string when the HTTP method of the authorization request
     * from the client application was `GET` or (2) the entire entity
     * body (which is formatted in `application/x-www-form-urlencoded`)
     * when the HTTP method of the authorization request from the client
     * application was `POST`.
     *
     * @param string $parameters
     *     Request parameters in `application/x-www-form-urlencoded` format.
     *
     * @return AuthorizationRequest
     *     `$this` object
     */
    public function setParameters($parameters)
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyToArray(array &$array)
    {
        $array['parameters'] = $this->parameters;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array)
    {
        // parameters
        $this->setParameters(
            LanguageUtility::getFromArray('parameters', $array));
    }
}
?>
