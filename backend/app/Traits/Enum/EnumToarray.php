<?php

namespace App\Traits\Enum;

trait EnumToArray
{

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function toNovaOptions(): array
    {
        // get enum name
        $enumName = get_class(self::cases()[0]);
        // get enum class name  from $enumName by regex pattern
        $modelName = preg_replace('/(.*\\\)?(.*Enum)$/', '$2', $enumName);

        return collect(self::cases())->mapWithKeys(
            fn ($item) => [$item->value => __($modelName . '.' . $item->value)]
        )->toArray();
    }

    // output total enum to be filter array
    public static function toFilterOptions(): array
    {
        // reverse key and value
        return collect(self::toNovaOptions())
            ->mapWithKeys(fn ($v, $k) => [$v => $k])
            ->toArray();
    }
}
