<?php

namespace App\Imports;

use App\Helpers\FileHelper;
use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ItemsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // Skip the first row (index 0) which contains column titles
        $rows = $rows->slice(1);
        foreach ($rows as $row) {
            if (!$row->filter(function($value) {
                return !is_null($value) && $value !== '';
            })->isEmpty()) {
                // Validation for numeric columns (indexes 9, 10, and 11)
                $numericColumns = [
                    'units_number' => $row[9],
                    'unit_price' => $row[10],
                    'total_price' => $row[11]
                ];

                // Check if all required columns are numeric
                $allNumeric = true;
                foreach ($numericColumns as $column => $value) {
                    if (!is_numeric($value)) {
                        $allNumeric = false;
                        break;
                    }
                }

                if ($allNumeric) {
                    // Valid numeric columns, proceed with creating the Item
                    $title = [
                        'en' => $row[0],
                        'ar' => $row[1],
                        'de' => $row[2]
                    ];
                    $description = [
                        'en' => $row[3],
                        'ar' => $row[4],
                        'de' => $row[5]
                    ];
                    $unit = [
                        'en' => $row[6],
                        'ar' => $row[7],
                        'de' => $row[8]
                    ];
                    Item::create([
                        'title' => $title,
                        'description' => $description,
                        'unit' => $unit,
                        'units_number' => $row[9],
                        'unit_price' => $row[10],
                        'total_price' => $row[11],
                    ]);
                }
            }
        }

    }
}
