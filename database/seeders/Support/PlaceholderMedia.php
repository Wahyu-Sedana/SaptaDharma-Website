<?php

namespace Database\Seeders\Support;

use Illuminate\Support\Facades\Storage;

class PlaceholderMedia
{
    /**
     * Generate a placeholder JPG on the public disk and return its relative path.
     * Guarantees the file always exists so "image" columns are never left null.
     */
    public static function image(string $directory, string $key, string $label, int $width = 1200, int $height = 800): string
    {
        $path = "{$directory}/{$key}.jpg";

        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        [$r, $g, $b] = static::colorFromKey($key);

        $canvas = imagecreatetruecolor($width, $height);
        $background = imagecolorallocate($canvas, $r, $g, $b);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $background);

        $text = strtoupper($label);
        $textColor = imagecolorallocate($canvas, 255, 255, 255);
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);

        imagestring(
            $canvas,
            $fontSize,
            (int) max(10, ($width - $textWidth) / 2),
            (int) (($height - $textHeight) / 2),
            $text,
            $textColor
        );

        Storage::disk('public')->makeDirectory($directory);
        imagejpeg($canvas, Storage::disk('public')->path($path), 85);
        imagedestroy($canvas);

        return $path;
    }

    /**
     * Generate a minimal-but-valid placeholder PDF on the public disk and return its relative path.
     */
    public static function pdf(string $directory, string $key, string $title): string
    {
        $path = "{$directory}/{$key}.pdf";

        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        Storage::disk('public')->makeDirectory($directory);
        Storage::disk('public')->put($path, static::minimalPdfBytes($title));

        return $path;
    }

    private static function colorFromKey(string $key): array
    {
        $hash = crc32($key);

        return [
            50 + ($hash & 0xFF) % 150,
            50 + (($hash >> 8) & 0xFF) % 150,
            50 + (($hash >> 16) & 0xFF) % 150,
        ];
    }

    private static function minimalPdfBytes(string $title): string
    {
        $title = addslashes($title);
        $content = "BT /F1 24 Tf 50 700 Td ({$title}) Tj ET";
        $contentLength = strlen($content);

        return <<<PDF
        %PDF-1.4
        1 0 obj
        << /Type /Catalog /Pages 2 0 R >>
        endobj
        2 0 obj
        << /Type /Pages /Kids [3 0 R] /Count 1 >>
        endobj
        3 0 obj
        << /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /MediaBox [0 0 612 792] /Contents 5 0 R >>
        endobj
        4 0 obj
        << /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>
        endobj
        5 0 obj
        << /Length {$contentLength} >>
        stream
        {$content}
        endstream
        endobj
        trailer
        << /Size 6 /Root 1 0 R >>
        %%EOF
        PDF;
    }
}
