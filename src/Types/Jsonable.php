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
 * File containing the definition of Jsonable interface.
 */


namespace Authlete\Types;


/**
 * Interface to declare that instances can be converted
 * into JSON strings.
 *
 * It is recommended that classes that use the
 * {@link \Authlete\Util\JsonTrait JsonTrait} trait
 * declare they implement this interface.
 */
interface Jsonable
{
    /**
     * Convert this object into a JSON string.
     *
     * @param integer $options
     *     Options passed to `json_encode()`. This parameter
     *     is optional and its default value is `0`.
     *
     * @return string
     *     A JSON string.
     */
    public function toJson(int $options = 0): string;
}
