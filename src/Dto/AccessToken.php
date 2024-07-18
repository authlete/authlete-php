<?php

/*
 * Copyright (C) 2018-2023 Authlete, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Authlete\Dto;

use Authlete\Types\GrantType;

class AccessToken
{
    private string $accessTokenHash;
    private ?string $refreshTokenHash;
    private int $clientId;
    private ?string $subject;
    private GrantType $grantType;
    private array $scopes;
    private int $accessTokenExpiresAt;
    private int $refreshTokenExpiresAt;
    private int $createdAt;
    private int $lastRefreshedAt;
    private array $properties;
    private ?array $refreshTokenScopes;

    /**
     * Get the hash of the access token.
     *
     * @return string
     *         The hash of the access token.
     */
    public function getAccessTokenHash(): string
    {
        return $this->accessTokenHash;
    }

    /**
     * Set the hash of the access token.
     *
     * @param string $hash
     *         The hash of the access token.
     *
     * @return self
     */
    public function setAccessTokenHash(string $hash): self
    {
        $this->accessTokenHash = $hash;
        return $this;
    }

    /**
     * Get the hash of the refresh token. {@code null} may be returned.
     *
     * @return string|null
     *         The hash of the refresh token or {@code null}.
     */
    public function getRefreshTokenHash(): ?string
    {
        return $this->refreshTokenHash;
    }

    /**
     * Set the hash of the refresh token.
     *
     * @param string|null $hash
     *         The hash of the refresh token.
     *
     * @return self
     */
    public function setRefreshTokenHash(?string $hash): self
    {
        $this->refreshTokenHash = $hash;
        return $this;
    }

    /**
     * Get the ID of the client associated with the access token.
     *
     * @return int
     *         The ID of the client associated with the access token.
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * Set the ID of the client associated with the access token.
     *
     * @param int $clientId
     *         The ID of the client associated with the access token.
     *
     * @return self
     */
    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * Get the subject (= unique user ID) associated with the access token.
     * {@code null} is returned if the access token was created using the
     * <a href="https://tools.ietf.org/html/rfc6749#section-4.4">Client Credentials</a>
     * flow.
     *
     * @return string|null
     *         The subject (= unique user ID) associated with the access token or
     *         {@code null} if the access token was created using the
     *         <a href="https://tools.ietf.org/html/rfc6749#section-4.4">Client Credentials</a>
     *         flow.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set the subject (= unique user ID) associated with the access token.
     *
     * @param string|null $subject
     *         The subject (= unique user ID) associated with the access token.
     *
     * @return self
     */
    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get the grant type of the access token when the access token was created.
     * Note that the value of the grant type is not changed when the access token
     * is refreshed using the refresh token.
     *
     * @return GrantType
     *         The grant type of the access token when the access token was created.
     */
    public function getGrantType(): GrantType
    {
        return $this->grantType;
    }

    /**
     * Set the grant type of the access token when the access token was created.
     *
     * @param GrantType $grantType
     *         The grant type of the access token when the access token was created.
     *
     * @return self
     */
    public function setGrantType(GrantType $grantType): self
    {
        $this->grantType = $grantType;
        return $this;
    }

    /**
     * Get the scopes associated with the access token.
     *
     * @return array
     *         The scopes associated with the access token.
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * Set the scopes associated with the access token.
     *
     * @param array $scopes
     *         The scopes associated with the access token.
     *
     * @return self
     */
    public function setScopes(array $scopes): self
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * Get the timestamp at which the access token will expire.
     *
     * @return int
     *         The expiration timestamp in milliseconds since the Unix epoch (1970-01-01).
     */
    public function getAccessTokenExpiresAt(): int
    {
        return $this->accessTokenExpiresAt;
    }

    /**
     * Set the timestamp at which the access token will expire.
     *
     * @param int $expiresAt
     *         The expiration timestamp in milliseconds since the Unix epoch (1970-01-01).
     *
     * @return self
     */
    public function setAccessTokenExpiresAt(int $expiresAt): self
    {
        $this->accessTokenExpiresAt = $expiresAt;
        return $this;
    }

    /**
     * Get the timestamp at which the refresh token will expire. {@code 0} is
     * returned if {@link #getRefreshTokenHash()} returns {@code null}.
     *
     * @return int
     *         The expiration timestamp in milliseconds since the Unix epoch (1970-01-01).
     */
    public function getRefreshTokenExpiresAt(): int
    {
        return $this->refreshTokenExpiresAt;
    }

    /**
     * Set the timestamp at which the refresh token will expire.
     *
     * @param int $expiresAt
     *         The expiration timestamp in milliseconds since the Unix epoch (1970-01-01).
     *
     * @return self
     */
    public function setRefreshTokenExpiresAt(int $expiresAt): self
    {
        $this->refreshTokenExpiresAt = $expiresAt;
        return $this;
    }

    /**
     * Get the timestamp at which the access token was first created. Note
     * that the value of the timestamp is not changed when the access token is
     * refreshed with the refresh token.
     *
     * @return int
     *         The timestamp at which the access token was first created in
     *         milliseconds since the Unix epoch (1970-01-01).
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * Set the timestamp at which the access token was first created.
     *
     * @param int $createdAt
     *         The timestamp at which the access token was first created in
     *         milliseconds since the Unix epoch (1970-01-01).
     *
     * @return self
     */
    public function setCreatedAt(int $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get the timestamp at which the access token was last refreshed using the
     * refresh token. {@code 0} is returned if it has never been refreshed.
     *
     * @return int
     *         The timestamp at which the access token was last refreshed using
     *         the refreshed token in milliseconds since the Unix epoch (1970-01-01).
     *         {@code 0} is returned if it has never been refreshed.
     */
    public function getLastRefreshedAt(): int
    {
        return $this->lastRefreshedAt;
    }

    /**
     * Set the timestamp at which the access token was last refreshed using the
     * refresh token.
     *
     * @param int $lastRefreshedAt
     *         The timestamp at which the access token was last refreshed using
     *         the refreshed token in milliseconds since the Unix epoch (1970-01-01).
     *
     * @return self
     */
    public function setLastRefreshedAt(int $lastRefreshedAt): self
    {
        $this->lastRefreshedAt = $lastRefreshedAt;
        return $this;
    }

    /**
     * Get the properties associated with the access token.
     *
     * @return array
     *         The properties associated with the access token.
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Set the properties associated with the access token.
     *
     * @param array $properties
     *         The properties associated with the access token.
     *
     * @return self
     */
    public function setProperties(array $properties): self
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * Get the scopes associated with the refresh token.
     *
     * @return array|null
     *         The scopes associated with the refresh token. May be {@code null}.
     *
     * @since 3.89
     * @since Authlete API 3.0
     */
    public function getRefreshTokenScopes(): ?array
    {
        return $this->refreshTokenScopes;
    }

    /**
     * Set the scopes associated with the refresh token.
     *
     * @param array|null $refreshTokenScopes
     *         The scopes associated with the refresh token.
     *
     * @return self
     *
     * @since 3.89
     * @since Authlete API 3.0
     */
    public function setRefreshTokenScopes(?array $refreshTokenScopes): self
    {
        $this->refreshTokenScopes = $refreshTokenScopes;
        return $this;
    }
}