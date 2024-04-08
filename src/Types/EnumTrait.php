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
    public static function valueOf(string $value): ?static {
        foreach (static::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }
        return null;
    }
}

