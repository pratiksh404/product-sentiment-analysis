<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ReviewImport implements ToCollection, WithHeadingRow, WithProgressBar
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Review::create([
                'product_uuid' => $row['product_uuid'],
                'review_author_name' => $row['review_author_name'] ?? null,
                'review_date' => Carbon::parse($row['review_date']),
                'recommended' => $row['recommended'] ?? null,
                'rating' => $row['rating'] ?? null,
                'review_title' => $row['review_title'],
                'review_text' => $row['review_text'],
            ]);
        }
    }
}
