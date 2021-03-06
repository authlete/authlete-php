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
 * File containing the definition of EnumTrait trait.
 */


namespace Authlete\Types;


/**
 * Trait to implement classes like enum.
 *
 * Classes that use this trait must be initialized by
 * `LanguageUtility::initializeClass()` method.
 */
trait EnumTrait
{
    private static $values;
    private $name;


    private static function initialize()
    {
        // The class which uses this trait.
        $class = new \ReflectionClass(get_called_class());

        // The name of the class.
        $className = $class->getName();

        // Extract (static) public properties defined in the class.
        $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);

        // For each (static) public property.
        foreach ($properties as $property)
        {
            // What is done here is:
            //
            //   self::$PROPERTY_NAME = new CLASS('PROPERTY_NAME');
            //

            // The name of the property.
            $propertyName = $property->getName();

            // Create an instance of the class with a string argument.
            $instance = new $className($propertyName);

            // Use the new instance as the value of the property.
            self::$$propertyName = $instance;

            // Add the instance to the list of property values.
            self::$values[] = $instance;
        }
    }


    /**
     * Get the list of public class variables listed in this class.
     *
     * @return array
     *     Instances of this class which are defined as public class
     *     variables.
     */
    public static function values()
    {
        return self::$values;
    }


    /**
     * Get an instance of this class that the given argument represents.
     *
     * If the given argument is an instance of this class, the instance
     * itself is returned.
     *
     * Otherwise, if the given argument is `null`, `null` is returned.
     *
     * Otherwise, if the type of the given argument is not `string`,
     * an `InvalidArgumentException` is returned.
     *
     * Otherwise, a class variable whose name is equal to the given
     * argument is looked up. If found, the instance is returned.
     * If not found, an `InvalidArgumentException` is thrown.
     *
     * @param mixed $value
     *     A string that represents an instance of this class, or an
     *     instance of this class, or `null`.
     *
     * @return static
     *     An instance of this class.
     */
    public static function valueOf($value)
    {
        if ($value instanceof self)
        {
            return $value;
        }

        if (is_null($value))
        {
            return null;
        }

        $class = get_called_class();

        if (!is_string($value))
        {
            throw new \InvalidArgumentException("The given object is neither $class nor string.");
        }

        foreach (self::$values as $element)
        {
            if ($element->name() == $value)
            {
                return $element;
            }
        }

        throw new \InvalidArgumentException("The given string cannot be parsed as $class.");
    }


    private function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * Get the name of this instance.
     *
     * @return string
     *     The name of this instance.
     */
    public function __toString()
    {
        return $this->name;
    }


    /**
     * Get the name of this instance.
     *
     * @return string
     *     The name of this instance.
     */
    public function name()
    {
        return $this->name;
    }
}
?>
