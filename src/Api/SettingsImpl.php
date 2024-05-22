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
 * File containing the definition of SettingsImpl class.
 */


namespace Authlete\Api;


use Authlete\Util\ValidationUtility;


/**
 * An implementation of the \Authlete\Api\Settings interface.
 */
class SettingsImpl implements Settings
{
    private int     $connectionTimeout   = 0;
    private ?string $proxyHost           = null;
    private int     $proxyPort           = 0;
    private bool    $httpProxyTunnelUsed = false;


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     */
    public function getConnectionTimeout(): int
    {
        return $this->connectionTimeout;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer $timeout
     *     {@inheritdoc}
     */
    public function setConnectionTimeout(int $timeout): Settings
    {
        ValidationUtility::ensureInteger('$timeout', $timeout);

        if ($timeout < 0)
        {
            throw new \InvalidArgumentException('The given timeout value is negative.');
        }

        $this->connectionTimeout = $timeout;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     */
    public function getProxyHost(): ?string
    {
        return $this->proxyHost;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param string $host
     *     {@inheritdoc}
     */
    public function setProxyHost(string $host): Settings
    {
        ValidationUtility::ensureNullOrString('$host', $host);

        $this->proxyHost = $host;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     */
    public function getProxyPort(): int
    {
        return $this->proxyPort;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param integer $port
     *     {@inheritdoc}
     */
    public function setProxyPort(int $port): Settings
    {
        ValidationUtility::ensureInteger('$port', $port);

        $this->proxyPort = $port;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     */
    public function isHttpProxyTunnelUsed(): bool
    {
        return $this->httpProxyTunnelUsed;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param boolean $used
     *     {@inheritdoc}
     */
    public function setHttpProxyTunnelUsed(bool $used): Settings
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->httpProxyTunnelUsed = $used;

        return $this;
    }
}

