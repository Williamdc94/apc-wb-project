<?php

namespace App\Helpers;

class APCCompressor
{
    public static function compress($filePath)
    {
        if (!file_exists($filePath)) {
            return [
                'compressed_path' => null,
                'compression_time' => 0,
                'original_size' => 0,
                'compressed_size' => 0,
                'compression_ratio' => 0,
            ];
        }

        $start = microtime(true);
        $originalData = file_get_contents($filePath);

        if (empty(trim($originalData))) {
            return [
                'compressed_path' => null,
                'compression_time' => 0,
                'original_size' => 0,
                'compressed_size' => 0,
                'compression_ratio' => 0,
            ];
        }

        // Perform adaptive predictive compression
        $compressedData = self::adaptivePredictiveCompress($originalData);

        // Save compressed file
        $compressedDir = storage_path('app/public/compressed');
        if (!file_exists($compressedDir)) {
            mkdir($compressedDir, 0775, true);
        }

        $compressedPath = $compressedDir . '/' . basename($filePath) . '.apc';
        file_put_contents($compressedPath, $compressedData);

        $end = microtime(true);
        $compressionTime = round($end - $start, 4);

        // File sizes in KB
        $originalSizeKB = max(0.01, round(filesize($filePath) / 1024, 2));
        $compressedSizeKB = max(0.01, round(strlen($compressedData) / 1024, 2));

        // Compression ratio (%)
        $compressionRatio = $originalSizeKB > 0
            ? round(($compressedSizeKB / $originalSizeKB) * 100, 2)
            : 0;

        return [
            'compressed_path' => $compressedPath,
            'compression_time' => $compressionTime,
            'original_size' => $originalSizeKB,
            'compressed_size' => $compressedSizeKB,
            'compression_ratio' => $compressionRatio,
        ];
    }

    private static function adaptivePredictiveCompress($data)
    {
        $dictionary = [];
        $output = '';
        $patternLength = 4;

        for ($i = 0; $i < strlen($data); $i++) {
            $chunk = substr($data, $i, $patternLength);
            if (!isset($dictionary[$chunk])) {
                $dictionary[$chunk] = count($dictionary);
                $output .= $chunk;
            } else {
                $output .= '[' . $dictionary[$chunk] . ']';
                $i += $patternLength - 1;
            }
        }

        // Simulate APC compression
        return gzencode(json_encode(['dict' => $dictionary, 'data' => $output]));
    }
}
