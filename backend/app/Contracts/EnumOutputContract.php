<?php

namespace App\Contracts;

interface EnumOutputContract
{
    public static function names(): array;

    public static function values(): array;

    // output total enum to an array
    public static function array(): array;

    // output total enum to an array for nova
    public static function toNovaOptions(): array;


    // output total enum to be filter array
    public static function toFilterOptions(): array;
}
