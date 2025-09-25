<?php

namespace App\Utils;

class MappingUtils
{
    /**
     * Fungsi untuk mapping data dari format satu ke format lain
     *
     * @param array $data - Array data yang akan dimapping
     * @param array $mapping - Aturan mapping dalam format ['target_key' => 'source_key']
     * @return array - Array hasil mapping
     */
    public static function mapData($data, $mapping) {
        $result = [];

        // Jika data adalah array multidimensional
        if (isset($data[0]) && is_array($data[0])) {
            foreach ($data as $item) {
                $mappedItem = [];
                foreach ($mapping as $targetKey => $sourceKey) {
                    $mappedItem[$targetKey] = $item[$sourceKey] ?? null;
                }
                $result[] = $mappedItem;
            }
        } else {
            // Jika data adalah array tunggal
            foreach ($mapping as $targetKey => $sourceKey) {
                $result[$targetKey] = $data[$sourceKey] ?? null;
            }
        }

        return $result;
    }

    public static function mapToValueLabel($data, $valueKey = 'id', $labelKey = 'name',  $injectData = null, $position = 'before') {
        // Panggil fungsi mapData untuk mendapatkan hasil awal
        $mappedData = self::mapData($data, [
            'value' => $valueKey,
            'label' => $labelKey
        ]);

         // Periksa apakah ada data yang akan diinjeksi
        if ($injectData !== null && is_array($injectData)) {
            // Lakukan injeksi berdasarkan posisi
            if ($position === 'after') {
                // Tambahkan di akhir array
                $mappedData[] = $injectData;
            } else {
                // Tambahkan di awal array (default)
                array_unshift($mappedData, $injectData);
            }
        }

        return $mappedData;
    }

    public static function childRolesToValueLabel($childRoles) {
        if (!is_array($childRoles)) {
            return [];
        }

        $data = [];

        foreach ($childRoles as $item) {
            array_push($data, [
                'id' => $item,
                'name' => ucwords(str_replace('_', ' ', $item))
            ]);
        }

        return self::mapToValueLabel($data, 'id', 'name', [ 'value' => 'all', 'label' => 'Semua Role' ]);
    }
}
