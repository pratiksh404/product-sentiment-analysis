<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ProductImport implements ToCollection, WithHeadingRow, WithProgressBar
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::create([
                'uuid' => $row['uuid'],
                'name' => $row['name'],
                'categories' => isset($row['categories']) ? explode(',', $row['categories']) : null,
                'dimension' => isset($row['dimension']) ? $row['dimension'] : null,
            ]);
        }
    }
}
