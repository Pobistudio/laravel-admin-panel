<?php

namespace App\Utils;

use App\Utils\CryptUtils;
use Illuminate\Support\Facades\Cookie;

class SessionUtils
{
    private static string $key = "s47qnsadub";
    private static string $intendedUrlKey = "intended_url";
    private static string $cookiePrefix = "persistent_";

    private static function getMain(): array
    {
        $encValue = session()->get(self::$key);
        if ($encValue === null) {
            return [];
        }

        return CryptUtils::dec($encValue) ?? [];
    }

    public static function save(string $key, string $value, bool $persistent = false): void
    {
        $mainValue       = self::getMain();
        $mainValue[$key] = $value;
        $encValue        = CryptUtils::enc($mainValue);
        session()->put(self::$key, $encValue);

        // Jika persistent, simpan juga di cookie
        if ($persistent) {
            self::saveToCookie($key, $value);
        }
    }

    public static function get(string $key, bool $checkCookie = false): string
    {
        $mainValue = self::getMain();

        // Cek di session terlebih dahulu
        if (array_key_exists($key, $mainValue)) {
            return $mainValue[$key];
        }

        // Jika tidak ada di session dan checkCookie true, cek di cookie
        if ($checkCookie) {
            return self::getFromCookie($key);
        }

        return "";
    }

    public static function delete(string $key, bool $deleteCookie = false): void
    {
        $mainValue = self::getMain();
        unset($mainValue[$key]);
        $encValue = CryptUtils::enc($mainValue);
        session()->put(self::$key, $encValue);

        // Hapus juga dari cookie jika diminta
        if ($deleteCookie) {
            self::deleteFromCookie($key);
        }
    }

    public static function deleteMain(): void
    {
        session()->remove(self::$key);
    }

    public static function isExist(): bool
    {
        return count(self::getMain()) > 0;
    }

    // ===== INTENDED URL METHODS =====

    /**
     * Simpan intended URL (persistent)
     */
    public static function saveIntendedUrl(string $url): void
    {
        // Filter URL yang tidak perlu disimpan
        $excludedPaths = ['login', 'logout', 'register', 'password'];

        foreach ($excludedPaths as $path) {
            if (str_contains($url, $path)) {
                return;
            }
        }

        self::save(self::$intendedUrlKey, $url, true); // persistent = true
    }

    /**
     * Ambil intended URL (cek session dulu, lalu cookie)
     */
    public static function getIntendedUrl(): string
    {
        return self::get(self::$intendedUrlKey, true); // checkCookie = true
    }

    /**
     * Hapus intended URL
     */
    public static function deleteIntendedUrl(): void
    {
        self::delete(self::$intendedUrlKey, true); // deleteCookie = true
    }

    /**
     * Redirect ke intended URL atau fallback
     */
    public static function redirectToIntended(string $fallback = '/')
    {
        $intendedUrl = self::getIntendedUrl();
        self::deleteIntendedUrl(); // Hapus setelah digunakan

        if (!empty($intendedUrl)) {
            return redirect($intendedUrl);
        }

        return redirect($fallback);
    }

    // ===== COOKIE HELPER METHODS =====

    private static function saveToCookie(string $key, string $value): void
    {
        $cookieName = self::$cookiePrefix . $key;
        $encryptedValue = CryptUtils::enc(['value' => $value]);

        Cookie::queue(
            $cookieName,
            $encryptedValue,
            30 // 30 menit
        );
    }

    private static function getFromCookie(string $key): string
    {
        $cookieName = self::$cookiePrefix . $key;
        $encryptedValue = Cookie::get($cookieName);

        if (!$encryptedValue) {
            return "";
        }

        try {
            $decrypted = CryptUtils::dec($encryptedValue);
            return $decrypted['value'] ?? "";
        } catch (\Exception $e) {
            return "";
        }
    }

    private static function deleteFromCookie(string $key): void
    {
        $cookieName = self::$cookiePrefix . $key;
        Cookie::queue(Cookie::forget($cookieName));
    }
}
