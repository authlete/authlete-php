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
 * File containing the definition of JsonTrait trait.
 */


namespace Authlete\Util;


/**
 * Trait to add functions for JSON conversion.
 *
 * Classes which use this trait must implement the
 * {@link \Authlete\Types\ArrayCopyable ArrayCopyable} interface.
 *
 * It is recommended that classes which use this trait declare
 * they implement the {@link \Authlete\Types\Jsonable Jsonable}
 * interface.
 */
trait JsonTrait
{
    /**
     * Convert this object into a JSON string.
     *
     * @param integer $options
     *     Options passed to `json_encode()`. This parameter
     *     is optional and its default value is 0.
     *
     * @return string
     *     A JSON string.
     */
    public function toJson(int $options = 0): string
    {
        return LanguageUtility::convertArrayCopyableToJson($this, $options);
    }


    /**
     * Convert a JSON string into an instance of this class.
     *
     * This static function returns a new instance of this class.
     * If `$json` is `null` or the type of `$json` is not `string`,
     * `null` is returned.
     *
     * @param string|null $json
     *     A JSON string.
     *
     * @return static
     *     An instance of this class.
     */
    public static function fromJson(?string $json): static
    {
        return LanguageUtility::convertJsonToArrayCopyable($json, get_called_class());
    }
}

