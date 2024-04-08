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
 * File containing the definition of Arrayable interface.
 */


namespace Authlete\Types;


/**
 * Interface to declare that instances can be converted
 * into an array.
 *
 * It is recommended that classes that use the
 * {@link \Authlete\Util\ArrayTrait ArrayTrait} trait
 * declare they implement this interface.
 *
 * @since 1.3
 */
interface Arrayable
{
    /**
     * Convert this object into an array.
     *
     * @return array
     *     An array.
     */
    public function toArray(): array;
}

