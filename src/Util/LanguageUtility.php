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
 * File containing the definition of LanguageUtility class.
 */


namespace Authlete\Util;


use Authlete\Types\ArrayCopyable;
use Exception;
use InvalidArgumentException;


/**
 * Language utility.
 */
class LanguageUtility
{
    /**
     * Call initialize() method of the specified class.
     *
     * This method assumes that the specified class has a static method
     * named `initialize()`. Even if the `initialize()` method is
     * `private`, this method calls it via reflection.
     *
     * @param string $class
     *     Class name.
     */
    public static function initializeClass(string $class): void
    {
        try
        {
            // Get a static method named 'initialize'. If not found,
            // ReflectionMethod() will throw a ReflectionException.
            $ref = new \ReflectionMethod($class, 'initialize');

            // The 'initialize' method is probably 'private'.
            // Make it accessible before calling 'invoke'.
            // Note that 'setAccessible' is not available
            // before PHP version 5.3.2.
            $ref->setAccessible(true);

            // Execute the 'initialize' method.
            $ref->invoke(null);
        }
        catch (Exception $e)
        {
        }
    }


    /**
     * Get the string value of the given object.
     *
     * @param mixed $value
     *     An object.
     *
     * @return string|null
     *     If the given `$value` is `null` or a `string` object,
     *     the `$value` itself is returned. Otherwise, if it is
     *     a boolean object, `"true"` or `"false"` is returned.
     *     In other cases, `strval($value)` is returned.
     */
    public static function toString(mixed $value): ?string
    {
        if (is_null($value) || is_string($value))
        {
            return $value;
        }

        if (is_bool($value))
        {
            return ($value ? "true" : "false");
        }

        return strval($value);
    }


    /**
     * Parse the given object as boolean.
     *
     * @param mixed $value
     *     An object.
     *
     * @return boolean
     *     If the given object is `null`, `false` is returned.
     *     Otherwise, if the type of the given object is `boolean`,
     *     the given object itself is returned. Otherwise, if the
     *     type of the given object is not `string`, an
     *     `InvalidArgumentException` is thrown. Otherwise, this
     *     method compares the given string to "true" in a
     *     case-insensitive manner. If they match, this method
     *     returns `true`. Otherwise, `false` is returned.
     *
     * @throws InvalidArgumentException
     *     The given object is not `null` and the type of the
     *     given object is neither `boolean` nor `string`.
     */
    public static function parseBoolean(mixed $value): bool
    {
        if (is_null($value))
        {
            return false;
        }

        if (is_bool($value))
        {
            return $value;
        }

        if (!is_string($value))
        {
            throw new InvalidArgumentException('Failed to parse as bool.');
        }

        if (strcasecmp('true', $value) != 0)
        {
            return false;
        }

        return true;
    }


    /**
     * Parse the given object as integer.
     *
     * @param mixed $value
     *     An object.
     *
     * @return integer
     *     If the given object is `null`, 0 is returned. Otherwise, if
     *     the type of the given object is `integer`, the given object
     *     itself is returned. Otherwise, if the type of the given
     *     object is not `string`, an `InvalidArgumentException` is
     *     thrown. Otherwise, this method returns `intval($value)`.
     *
     * @throws InvalidArgumentException
     *     The given object is not `null` and the type of the
     *     given object is neither `integer` nor `string`.
     */
    public static function parseInteger(mixed $value): int
    {
        if (is_null($value))
        {
            return 0;
        }

        if (is_integer($value))
        {
            return $value;
        }

        if (!is_string($value))
        {
            throw new InvalidArgumentException('Failed to parse as an integer.');
        }

        return intval($value);
    }


    /**
     * Get the value of the environment variable identified by the key.
     *
     * @param string $key
     *     The name of an environment variable.
     *
     * @return string|null
     *     The value of the environment variable. If the environment
     *     variable is not defined, `null` is returned.
     */
    public static function getFromEnv(string $key): ?string
    {
        $value = getenv($key);

        // If the key was not found in the environment.
        if ($value === false)
        {
            return null;
        }

        return $value;
    }


    /**
     * Get an element identified by a key from an array.
     *
     * @param string $key
     *     Key of an element.
     *
     * @param array $array
     *     Reference to an array.
     *
     * @return mixed
     *     An element identifed by the key. If the key does not exist
     *     in the array, `null` is returned.
     */
    public static function getFromArray(string $key, array $array): mixed
    {
        if (array_key_exists($key, $array))
        {
            return $array[$key];
        }

        return null;
    }


    /**
     * Get an element identified by a key from an array as boolean
     *
     * @param string $key
     *     Key of an element.
     *
     * @param array $array
     *     Reference to an array.
     *
     * @return boolean
     *     A boolean value generated by parsing the element identified
     *     by the key. If the key does not exist in the array, `null`
     *     is returned.
     *
     * @throws InvalidArgumentException
     *     The element identified by the key could not be parsed as
     *     boolean.
     */
    public static function getFromArrayAsBoolean(string $key, array &$array): bool
    {
        return self::parseBoolean(self::getFromArray($key, $array));
    }


    /**
     * Convert elements of an array with a given converter and generate
     * a new array.
     *
     * @param callable $converter
     *     A function that converts an element to another object. When `$arg`
     *     is `null`, `$converter` should be a function that takes one argument
     *     (an element). When `$arg` is not `null`, `$converter` should be a
     *     function that takes two arguments, an element and `$arg`.
     *
     * @param mixed|null $arg
     *     An optional argument given to the converter.
     *
     * @param array|null $array
     *     A reference to an array.
     *
     * @return array|null
     *     A reference of a new array that holds converted elements.
     */
    public static function &convertArray(callable $converter, array &$array = null, mixed $arg = null): ?array
    {
        if (is_null($array))
        {
            // 'return null' would generate the following warning.
            //
            //   "Only variable references should be returned by reference"
            //
            // Therefore, an intermidiate object is used here.
            $output = null;
            return $output;
        }

        $output = array();

        array_walk(
            $array,
            function ($value, $key) use ($converter, $arg, &$output)
            {
                if (is_null($arg))
                {
                    $output[] = $converter($value);
                }
                else
                {
                    $output[] = $converter($value, $arg);
                }
            }
        );

        return $output;
    }


    /**
     * Convert an ArrayCopyable instance to an array.
     *
     * @param ArrayCopyable|null $object
     *     An object that implements the `ArrayCopyable` interface.
     *     `copyToArray()` method of the object will be called.
     *
     * @return array|null
     *     An array generated from the given object.
     */
    public static function convertArrayCopyableToArray(ArrayCopyable $object = null): ?array
    {
        if (is_null($object))
        {
            return null;
        }

        $array = array();

        $object->copyToArray($array);

        return $array;
    }


    /**
     * Convert an ArrayCopyable instance to a JSON string.
     *
     * @param ArrayCopyable|null $object
     *     An object that implements the `ArrayCopyable` interface.
     *     `copyToArray()` method of the object will be called.
     *
     * @param integer $options
     *     Options passed `json_encode()`.
     *
     * @return string|null
     *     A JSON string generated from the given object.
     */
    public static function convertArrayCopyableToJson(ArrayCopyable $object = null, int $options = 0): ?string
    {
        $array = self::convertArrayCopyableToArray($object);

        if (is_null($array))
        {
            return null;
        }

        return json_encode($array, $options);
    }


    /**
     * Convert an array to an object.
     *
     * @param array $array
     *     A reference to an array.
     *
     * @param string $className
     *     A name of a class that implements the `ArrayCopyable` interface.
     *     An instance of the class will be created and its `copyFromArray()`
     *     method will be called.
     *
     * @return mixed
     *     An instance of the class which is specified by the class name.
     */
    public static function convertArrayToArrayCopyable(string $className, array &$array = null): mixed
    {
        if (is_null($array))
        {
            return null;
        }

        $object = new $className();
        $object->copyFromArray($array);

        return $object;
    }


    /**
     * Convert a JSON string to an object.
     *
     * @param string $json
     *     A JSON string.
     *
     * @param string $className
     *     A name of a class that implements the `ArrayCopyable` interface.
     *     An instance of the class will be created and its `copyFromArray()`
     *     method will be called.
     *
     * @return mixed
     *     An instance of the class which is specified by the class name.
     */
    public static function convertJsonToArrayCopyable(string $json, string $className): mixed
    {
        $array = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

        return self::convertArrayToArrayCopyable( $className, $array);
    }


    /**
     * Convert an array to a string array.
     *
     * Elements in the given array will be converted to string by
     * `LanguageUtility::toString()` method.
     *
     * @param array|null $array $array
     *     A reference to an array.
     *
     * @return array|null A string array.
     *     A string array.
     */
    public static function convertArrayToStringArray(array $array = null): ?array
    {
        return self::convertArray(
            '\Authlete\Util\LanguageUtility::toString',
            $array);
    }


    /**
     * Convert an array whose elements implement the ArrayCopyable interface
     * to an array.
     *
     * Each element in the given array will be converted to an array by
     * `LanguageUtility::convertArrayCopyableToArray()`.
     *
     * @param array|null $array $array
     *     A reference to an array whose elements implement the `ArrayCopyable`
     *     interface.
     *
     * @return array|null An array of arrays.
     *     An array of arrays.
     */
    public static function convertArrayOfArrayCopyableToArray(array $array = null): ?array
    {
        return self::convertArray(
            '\Authlete\Util\LanguageUtility::convertArrayCopyableToArray',
            $array);
    }


    /**
     * Convert an array to an array whose elements implement the ArrayCopyable
     * interface.
     *
     * Each element inthe given array will be converted to an object that
     * implements the `ArrayCopyable` interface by
     * `LanguageUtility::convertArrayToArrayCopyable()`.
     *
     * @param string $className
     *     A name of a class that implements the `ArrayCopyable` interface.
     *
     * @param array|null $array $array
     *     A reference to an array of arrays.
     *
     * @return array|null
     *     An array of objects that implement the `ArrayCopyable` interface.
     */
    public static function convertArrayToArrayOfArrayCopyable(string $className, array $array = null): ?array
    {
        return self::convertArray(
            '\Authlete\Util\LanguageUtility::convertArrayToArrayCopyable',
            $array,
            $className);
    }


    /**
     * Get the given object itself or 0 if the object is `null`.
     *
     * @param mixed $value
     *     An object.
     *
     * @return mixed
     *     The given object itself or 0.
     */
    public static function orZero($value)
    {
        if (is_null($value))
        {
            return 0;
        }

        return $value;
    }


    /**
     * Get the given object itself or an empty string if the object is `null`.
     *
     * @param mixed $value
     *     An object.
     *
     * @return mixed
     *     The given object itself or an empty string.
     */
    public static function orEmpty($value)
    {
        if (is_null($value))
        {
            return "";
        }

        return $value;
    }
}
