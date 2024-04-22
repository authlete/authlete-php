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
 * File containing the definition of ArrayCopyable interface.
 */


namespace Authlete\Types;


/**
 * Interface to declare instances can be converted into/from arrays.
 *
 * Classes which implement this interface can use the
 * {@link \Authlete\Util\JsonTrait JsonTrait} trait.
 */
interface ArrayCopyable
{
    /**
     * Copy the content of this object into the given array.
     *
     * As necessary, types of properties in this object are converted
     * into other types which are friendly to `json_encode()`.
     *
     * @param array $array
     *     A reference of an array into which properties of this object
     *     are copied.
     */
    public function copyToArray(array &$array);


    /**
     * Copy the content of the given array into this object.
     *
     * As necessary, types of elements in the given array are converted
     * into other types which are suitable for properties of this object.
     *
     * @param array $array
     *     A reference of an array whose elements are used to set up
     *     properties of this object.
     */
    public function copyFromArray(array &$array);
}

