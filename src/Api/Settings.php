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
 * File containing the definition of Settings interface.
 */


namespace Authlete\Api;


/**
 * Settings of an implementation of the \Authlete\Api\AuthleteApi interface.
 *
 * @link \Authlete\Api\AuthleteApi
 */
interface Settings
{
    /**
     * Get the connection timeout in seconds.
     *
     * @return int
     *     Connection timeout in seconds. 0 means infinite.
     */
    public function getConnectionTimeout();


    /**
     * Set a connection timeout in seconds.
     *
     * @param int $timeout
     *     Connection timeout in seconds. 0 means infinite.
     *
     * @return Settings
     *     `$this` object.
     *
     * @throws \InvalidArgumentException
     *     The type of the argument is not `integer` or its value is negative.
     */
    public function setConnectionTimeout($timeout);


    /**
     * Get the proxy host.
     *
     * @return string
     *     Proxy host.
     */
    public function getProxyHost();


    /**
     * Set a proxy host.
     *
     * @param string $host
     *     Proxy host.
     *
     * @return Settings
     *     `$this` object.
     *
     * @throws \InvalidArgumentException
     *     The type of the argument is not `string`.
     */
    public function setProxyHost($host);


    /**
     * Get the proxy port.
     *
     * @return integer
     *     Proxy port.
     */
    public function getProxyPort();


    /**
     * Set a proxy port.
     *
     * @param integer $port
     *     Proxy port.
     *
     * @return Settings
     *     `$this` object.
     *
     * @throws \InvalidArgumentException
     *     The type of the argument is not `integer`.
     */
    public function setProxyPort($port);


    /**
     * Get the flag which indicates whether HTTP proxy tunnel is used or not.
     *
     * @return boolean
     *     `true` if HTTP proxy tunnel is used.
     */
    public function isHttpProxyTunnelUsed();


    /**
     * Set the flag which indicates whether HTTP proxy tunnel is used or not.
     *
     * @param boolean $used
     *     `true` to use HTTP proxy tunnel.
     *
     * @return Settings
     *     `$this` object.
     *
     * @throws \InvalidArgumentException
     *     The type of the argument is not `boolean`.
     */
    public function setHttpProxyTunnelUsed($used);
}
?>
