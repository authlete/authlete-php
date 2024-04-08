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
 * File containing the definition of RevocationRequest class.
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
 * Request to Authlete's /api/auth/revocation API.
 *
 * The entity body of a revocation request may contain a pair of client ID
 * and client secret (`client_id` and `client_secret`) along with other
 * request parameters as described in
 * [2.3.1. Client Password](https://tools.ietf.org/html/rfc6749#section-2.3.1)
 * of [RFC 6749](https://tools.ietf.org/html/rfc6749). If the client
 * credentials are contained in both the `Authorization` header and the
 * entity body, they must be identical. Otherwise, Authlete's
 * `/api/auth/revocation` API generates an error (it's not a service error
 * but a client error).
 *
 * When the presented token is an access token, Authlete revokes the access
 * token and its associated refresh token, too. Likewise, if the presented
 * token is a refresh token, Authlete revokes the refresh token and its
 * associated access token. Note that, however, other access tokens and
 * refresh tokens are not revoked even though their associated client
 * application, subject and grant type are equal to those of the token to
 * be revoked.
 */
class RevocationRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $parameters   = null;  // string
    private ?string $clientId     = null;  // string
    private ?string $clientSecret = null;  // string


    /**
     * Get the request parameters that the revocation endpoint (RFC 7009)
     * of the authorization server received from a client application.
     *
     * @return string
     *     The request parameters of a revocation request.
     */
    public function getParameters(): ?string
    {
        return $this->parameters;
    }


    /**
     * Set the request parameters that the revocation endpoint (RFC 7009)
     * of the authorization server received from a client application.
     *
     * The value of the `parameters` request parameter is the entire entity
     * body (which is formatted in `application/x-www-form-urlencoded`) of
     * the request from the client application.
     *
     * @param string $parameters
     *     The request parameters of a revocation request.
     *
     * @return RevocationRequest
     *     `$this` object.
     */
    public function setParameters(string $parameters): RevocationRequest
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the client ID extracted from the Authorization header of the
     * revocation request from the client application.
     *
     * @return string
     *     The client ID.
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }


    /**
     * Set the client ID extracted from the Authorization header of the
     * revocation request from the client application.
     *
     * If the revocation endpoint of the authorization server supports
     * Basic Authentication as a means of
     * [client authentication](https://tools.ietf.org/html/rfc6749#section-2.3),
     * and if the request from the client application contained its client
     * ID in the `Authorization` header, the value should be extracted from
     * there and passed to this method.
     *
     * @param string $clientId
     *     The client ID.
     *
     * @return RevocationRequest
     *     `$this` object.
     */
    public function setClientId(string $clientId): RevocationRequest
    {
        ValidationUtility::ensureNullOrString('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client secret extracted from the Authorization header of the
     * revocation request from the client application.
     *
     * @return string
     *     The client secret.
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }


    /**
     * Set the client secret extracted from the Authorization header of the
     * revocation request from the client application.
     *
     * If the revocation endpoint of the authorization server supports
     * Basic Authentication as a means of
     * [client authentication](https://tools.ietf.org/html/rfc6749#section-2.3),
     * and if the request from the client application contained its client
     * secret in the `Authorization` header, the value should be extracted
     * from there and passed to this method.
     *
     * @param string $secret
     *     The client secret.
     *
     * @return RevocationRequest
     *     `$this` object.
     */
    public function setClientSecret(string $secret): RevocationRequest
    {
        ValidationUtility::ensureNullOrString('$secret', $secret);

        $this->clientSecret = $secret;

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
        $array['parameters']   = $this->parameters;
        $array['clientId']     = $this->clientId;
        $array['clientSecret'] = $this->clientSecret;
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

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // clientSecret
        $this->setClientSecret(
            LanguageUtility::getFromArray('clientSecret', $array));
    }
}

