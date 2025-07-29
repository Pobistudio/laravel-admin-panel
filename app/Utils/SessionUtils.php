<?php

namespace App\Utils;

use App\Utils\CryptUtils;

class SessionUtils
{
    private static string $key = "s47qnsadub";

    private static function getMain(): array
    {
        $encValue = session()->get(self::$key);
        if ($encValue === null) {
            return [];
        }

        return CryptUtils::dec($encValue) ?? [];
    }

    public static function save(string $key, string $value): void
    {
        $mainValue       = self::getMain();
        $mainValue[$key] = $value;
        $encValue        = CryptUtils::enc($mainValue);
        session()->put(self::$key, $encValue);
    }

    public static function get(string $key): string
    {
        $mainValue = self::getMain();
        if (array_key_exists($key, $mainValue)) {
            return $mainValue[$key];
        }
        return "";
    }

    public static function delete(string $key): void
    {
        $mainValue = self::getMain();
        unset($mainValue[$key]);
        $encValue = CryptUtils::enc($mainValue);
        session()->put(self::$key, $encValue);
    }

    public static function deleteMain(): void
    {
        session()->remove(self::$key);
    }

    public static function isExist(): bool
    {
        return count(self::getMain()) > 0;
    }
}
