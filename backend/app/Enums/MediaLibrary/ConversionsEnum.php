<?php

namespace App\Enums\MediaLibrary;

use App\Contracts\EnumOutputContract;
use App\Traits\Enum\EnumToArray;

enum ConversionsEnum: string implements EnumOutputContract
{
    use EnumToArray;

    case THUMB = 'thumb'; // 縮圖
    case SMALL = 'small'; // 小圖
    case MEDIUM = 'medium'; // Android 手機版
    case LARGE = 'large'; // IOS 手機版
    case HD = 'hd'; // HD
    case FHD = 'fhd'; // FHD
    case UHD = 'uhd'; // UHD

    // get resolution
    public function getResolution(): int
    {
        return match ($this) {
            self::THUMB => 100,
            self::SMALL => 300,
            self::MEDIUM => 640,
            self::LARGE => 896,
            self::HD => 1280,
            self::FHD => 1920,
            self::UHD => 3840,
        };
    }
}
