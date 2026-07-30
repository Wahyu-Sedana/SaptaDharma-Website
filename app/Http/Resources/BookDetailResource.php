<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class BookDetailResource extends BookResource
{
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'publisher' => $this->publisher ?: '-',
            'isbn' => $this->isbn ?: '-',
            'year' => $this->year,
            'description' => $this->description ?: '',
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($this->description ?: '')) / 200)),
            'pdf_url' => $this->pdf ? asset('storage/' . $this->pdf) : null,
            'download_url' => $this->pdf ? url('/api/books/' . $this->slug . '/download') : null,
        ]);
    }
}
