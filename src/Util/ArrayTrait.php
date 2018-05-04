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
 * File containing the definition of ArrayTrait trait.
 */


namespace Authlete\Util;


/**
 * Trait to add functions for array conversion.
 *
 * Classes which use this trait must implement the
 * {@link \Authlete\Types\ArrayCopyable ArrayCopyable} interface.
 *
 * It is recommended that classes which use this trait declare
 * they implement the {@link \Authlete\Types\Arrayable Arrayable}
 * interface.
 *
 * @since 1.3
 */
trait ArrayTrait
{
    /**
     * Convert this object into an array.
     *
     * @return array
     *     An array.
     */
    public function toArray()
    {
        return LanguageUtility::convertArrayCopyableToArray($this);
    }


    /**
     * Convert an array into an instance of this class.
     *
     * This static function returns a new instance of this class.
     * If `$array` is `null`, `null` is returned.
     *
     * @param array $array
     *     An array
     *
     * @return static
     *     An instance of this class.
     */
    public static function fromArray(array $array = null)
    {
        return LanguageUtility::convertArrayToArrayCopyable($array, get_called_class());
    }
}
?>
