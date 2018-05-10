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
    public static function initializeClass($class)
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
     * @return string
     *     If the given `$value` is `null` or a `string` object,
     *     the `$value` itself is returned. Otherwise, if it is
     *     a boolean object, `"true"` or `"false"` is returned.
     *     In other cases, `strval($value)` is returned.
     */
    public static function toString($value)
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
     * @throws \InvalidArgumentException
     *     The given object is not `null` and the type of the
     *     given object is neither `boolean` nor `string`.
     */
    public static function parseBoolean($value)
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
            throw new \InvalidArgumentException('Failed to parse as bool.');
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
     * @throws \InvalidArgumentException
     *     The given object is not `null` and the type of the
     *     given object is neither `integer` nor `string`.
     */
    public static function parseInteger($value)
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
            throw new \InvalidArgumentException('Failed to parse as an integer.');
        }

        return intval($value);
    }


    /**
     * Get the value of the environment variable identified by the key.
     *
     * @param string $key
     *     The name of an environment variable.
     *
     * @return string
     *     The value of the environment variable. If the environment
     *     variable is not defined, `null` is returned.
     */
    public static function getFromEnv($key)
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
    public static function getFromArray($key, array &$array)
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
     * @throws \InvalidArgumentException
     *     The element identified by the key could not be parsed as
     *     boolean.
     */
    public static function getFromArrayAsBoolean($key, array &$array)
    {
        return self::parseBoolean(self::getFromArray($key, $array));
    }


    /**
     * Convert elements of an array with a given converter and generate
     * a new array.
     *
     * @param array $array
     *     A reference to an array.
     *
     * @param callable $converter
     *     A function that converts an element to another object. When `$arg`
     *     is `null`, `$converter` should be a function that takes one argument
     *     (an element). When `$arg` is not `null`, `$converter` should be a
     *     function that takes two arguments, an element and `$arg`.
     *
     * @param mixed $arg
     *     An optional argument given to the converter.
     *
     * @return array
     *     A reference of a new array that holds converted elements.
     */
    public static function &convertArray(array &$array = null, $converter, $arg = null)
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
     * @param ArrayCopyable $object
     *     An object that implements the `ArrayCopyable` interface.
     *     `copyToArray()` method of the object will be called.
     *
     * @return array
     *     An array generated from the given object.
     */
    public static function convertArrayCopyableToArray(ArrayCopyable $object = null)
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
     * @param ArrayCopyable $object
     *     An object that implements the `ArrayCopyable` interface.
     *     `copyToArray()` method of the object will be called.
     *
     * @param integer $options
     *     Options passed `json_encode()`.
     *
     * @return string
     *     A JSON string generated from the given object.
     */
    public static function convertArrayCopyableToJson(ArrayCopyable $object = null, $options = 0)
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
    public static function convertArrayToArrayCopyable(array &$array = null, $className)
    {
        if (is_null($array))
        {
            return null;
        }

        if (is_null($className) || !is_string($className))
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
    public static function convertJsonToArrayCopyable($json, $className)
    {
        if (is_null($json) || !is_string($json))
        {
            return null;
        }

        $array = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

        return self::convertArrayToArrayCopyable($array, $className);
    }


    /**
     * Convert an array to a string array.
     *
     * Elements in the given array will be converted to string by
     * `LanguageUtility::toString()` method.
     *
     * @param array $array
     *     A reference to an array.
     *
     * @return string[]
     *     A string array.
     */
    public static function convertArrayToStringArray(array &$array = null)
    {
        return self::convertArray(
            $array,
            '\Authlete\Util\LanguageUtility::toString');
    }


    /**
     * Convert an array whose elements implement the ArrayCopyable interface
     * to an array.
     *
     * Each element in the given array will be converted to an array by
     * `LanguageUtility::convertArrayCopyableToArray()`.
     *
     * @param array $array
     *     A reference to an array whose elements implement the `ArrayCopyable`
     *     interface.
     *
     * @return array
     *     An array of arrays.
     */
    public static function convertArrayOfArrayCopyableToArray(array &$array = null)
    {
        return self::convertArray(
            $array,
            '\Authlete\Util\LanguageUtility::convertArrayCopyableToArray');
    }


    /**
     * Convert an array to an array whose elements implement the ArrayCopyable
     * interface.
     *
     * Each element inthe given array will be converted to an object that
     * implements the `ArrayCopyable` interface by
     * `LanguageUtility::convertArrayToArrayCopyable()`.
     *
     * @param array $array
     *     A reference to an array of arrays.
     *
     * @param string $className
     *     A name of a class that implements the `ArrayCopyable` interface.
     *
     * @return array
     *     An array of objects that implement the `ArrayCopyable` interface.
     */
    public static function convertArrayToArrayOfArrayCopyable(array &$array = null, $className)
    {
        return self::convertArray(
            $array,
            '\Authlete\Util\LanguageUtility::convertArrayToArrayCopyable',
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
?>
