<?php

namespace Authlete\Types;
interface Valuable {
    public static function valueOf(string $value): ?static;
}