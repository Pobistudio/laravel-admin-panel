<?php

namespace App\Utils;

use Illuminate\Support\Facades\Cache;

class CacheUtils
{
    /**
     * Menyimpan data ke cache dengan enkripsi
     *
     * @param string $key
     * @param string|array $tags
     * @param mixed $value
     * @return bool
     */
    public static function put($key, $tags, $value)
    {
        $ttl = 86400; // 24 jam

        // Buat cache key dengan prefix dari tags
        $cacheKey = self::buildKey($key, $tags);

        // Enkripsi value
        $encryptedValue = CryptUtils::enc($value);

        // Simpan ke cache
        return Cache::put($cacheKey, $encryptedValue, $ttl);
    }

    /**
     * Mengambil data dari cache
     *
     * @param string $key
     * @param string|array $tags
     * @return mixed
     */
    public static function get($key, $tags)
    {
        // Buat cache key dengan prefix dari tags
        $cacheKey = self::buildKey($key, $tags);

        // Ambil dari cache
        $result = Cache::get($cacheKey);

        if (!empty($result)) {
            return CryptUtils::dec($result);
        } else {
            // Fallback ke session jika tidak ada di cache
            $sessionUtils = new SessionUtils();
            $resultSession = $sessionUtils->get($key);

            if ($resultSession !== null) {
                self::put($key, $tags, $resultSession);
            }

            return $resultSession;
        }
    }

    /**
     * Menghapus cache berdasarkan key dan id
     *
     * @param string $key
     * @param string $id
     * @return bool
     */
    public static function delete($key, $id)
    {
        $cacheKey = self::buildKey($key, $id);
        return Cache::forget($cacheKey);
    }

    /**
     * Menghapus semua cache dengan prefix tertentu
     *
     * @param string $prefix
     * @return int Jumlah key yang dihapus
     */
    public static function deleteWithTags($prefix)
    {
        $deleted = 0;

        // Untuk file driver, kita perlu melacak keys secara manual
        // Ambil daftar keys yang tersimpan untuk prefix ini
        $keysListKey = "cache_keys:{$prefix}";
        $keys = Cache::get($keysListKey, []);

        if (!empty($keys) && is_array($keys)) {
            foreach ($keys as $key) {
                if (Cache::forget($key)) {
                    $deleted++;
                }
            }
            // Hapus list keys juga
            Cache::forget($keysListKey);
        }

        return $deleted;
    }

    /**
     * Membangun cache key dengan format prefix:key
     *
     * @param string $key
     * @param string|array $tags
     * @return string
     */
    protected static function buildKey($key, $tags)
    {
        if (is_array($tags)) {
            $prefix = implode(':', $tags);
        } else {
            $prefix = $tags;
        }

        $cacheKey = "{$prefix}:{$key}";

        // Simpan key ini untuk tracking (untuk deleteWithTags)
        self::trackKey($cacheKey, $prefix);

        return $cacheKey;
    }

    /**
     * Melacak cache key untuk memudahkan penghapusan massal
     *
     * @param string $cacheKey
     * @param string $prefix
     * @return void
     */
    protected static function trackKey($cacheKey, $prefix)
    {
        $keysListKey = "cache_keys:{$prefix}";
        $keys = Cache::get($keysListKey, []);

        if (!in_array($cacheKey, $keys)) {
            $keys[] = $cacheKey;
            // Simpan list dengan TTL yang lebih panjang
            Cache::put($keysListKey, $keys, 86400 * 7); // 7 hari
        }
    }

    /**
     * Membersihkan tracking keys yang sudah kadaluarsa
     * Sebaiknya dipanggil secara periodik via scheduled task
     *
     * @param string $prefix
     * @return void
     */
    public static function cleanupExpiredKeys($prefix)
    {
        $keysListKey = "cache_keys:{$prefix}";
        $keys = Cache::get($keysListKey, []);

        if (!empty($keys) && is_array($keys)) {
            $activeKeys = [];
            foreach ($keys as $key) {
                if (Cache::has($key)) {
                    $activeKeys[] = $key;
                }
            }

            if (count($activeKeys) > 0) {
                Cache::put($keysListKey, $activeKeys, 86400 * 7);
            } else {
                Cache::forget($keysListKey);
            }
        }
    }
}
