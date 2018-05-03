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
 * File containing the definition of HttpHeaders class.
 */


namespace Authlete\Web;


use Authlete\Util\LanguageUtility;


/**
 * HTTP headers.
 *
 * @since 1.2
 */
class HttpHeaders
{
    private $keyMap;
    private $headerMap;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->keyMap    = array();
        $this->headerMap = array();
    }


    /**
     * Add a pair of HTTP header name and value.
     *
     * @param string $name
     *     HTTP header name. For example, `Location`.
     *
     * @param string $value
     *     HTTP header value.
     *
     * @return HttpHeaders
     *     `$this` object.
     */
    public function add($name, $value)
    {
        if (is_null($name) || empty($name))
        {
            return $this;
        }

        $loweredKey  = strtolower($name);
        $originalKey = null;

        if (array_key_exists($loweredKey, $this->keyMap) === false)
        {
            $originalKey                   = $name;
            $this->keyMap[$loweredKey]     = $originalKey;
            $this->headerMap[$originalKey] = array();
        }
        else
        {
            $originalKey = $this->keyMap[$loweredKey];
        }

        $this->headerMap[$originalKey][] = $value;

        return $this;
    }


    /**
     * Get the values of an HTTP header.
     *
     * @param string $name
     *     HTTP header name. For example, `Location`. Case-insensitive.
     *
     * @return array
     *     Values of the HTTP header.
     */
    public function get($name)
    {
        if (is_null($name) || empty($name))
        {
            return null;
        }

        $loweredKey = strtolower($name);

        if (array_key_exists($loweredKey, $this->keyMap) === false)
        {
            return null;
        }

        $originalKey = $this->keyMap[$loweredKey];

        return $this->headerMap[$originalKey];
    }


    /**
     * Get the first value of an HTTP header.
     *
     * @param string $name
     *     HTTP header name. For example, `Location`. Case-insensitive.
     *
     * @return string
     *     The first value of the HTTP header.
     */
    public function getFirst($name)
    {
        $array = $this->get($name);

        if (is_null($array))
        {
            return null;
        }

        return $array[0];
    }


    /**
     * Get a map that holds pairs of HTTP header name and values.
     *
     * @return array
     *     A map that holds pairs of HTTP header name and values.
     */
    public function getMap()
    {
        return $this->headerMap;
    }


    /**
     * Parse HTTP headers and generate an instance of HttpHeaders that
     * represents the HTTP headers.
     *
     * ```
     * $input = "Fruits: Apple\r\n"
     *        . "fruits: Banana\r\n"
     *        . "FRUITS: Cherry\r\n"
     *        . "Animals: Cat\r\n"
     *        ;
     * $headers = HttpHeaders::parse($input);
     * ```
     *
     * @param string $input
     *     HTTP headers delimited by newlines (CRLF or LF).
     *
     * @return HttpHeaders
     *     An HttpHeaders instance that represents the given HTTP headers.
     */
    public static function parse($input)
    {
        $headers = new HttpHeaders();

        if (is_null($input) || empty($input))
        {
            return $headers;
        }

        $lines = preg_split('/\R/', $input);

        foreach ($lines as $header)
        {
            $elements = explode(':', $header, 2);

            if (count($elements) === 2)
            {
                $name  = trim($elements[0]);
                $value = trim($elements[1]);
                $headers->add($name, $value);
            }
        }

        return $headers;
    }
}
?>
