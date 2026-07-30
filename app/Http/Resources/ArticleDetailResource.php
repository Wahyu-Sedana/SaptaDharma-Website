<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ArticleDetailResource extends ArticleResource
{
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'content' => $this->content ?: '',
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($this->content ?: '')) / 200)),
        ]);
    }
}
