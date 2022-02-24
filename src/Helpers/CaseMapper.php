<?php

namespace Abivia\Plaid\Helpers;

use Illuminate\Support\Str;
use stdClass;

class CaseMapper
{
    /**
     * Wrap an object in the case mapper.
     *
     * @param object $data
     * @return CaseMapper
     */
    public static function map(object $data): object
    {
        $mapped = new stdClass();
        foreach ($data as $key => $value) {
            $key = Str::camel($key);
            if (is_object($value)) {
                $mapped->$key = CaseMapper::map($value);
            } elseif (is_array($value)) {
                $mapped->$key = CaseMapper::mapArray($value);
            } else {
                $mapped->$key = $value;
            }
        }

        return $mapped;
    }

    public static function mapArray(array $list): array
    {
        $result = [];
        foreach ($list as $key => $value) {
            $key = Str::camel($key);
            if (is_object($value)) {
                $result[$key] = CaseMapper::map($value);
            } elseif (is_array($value)) {
                $result[$key] = CaseMapper::mapArray($value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

}
