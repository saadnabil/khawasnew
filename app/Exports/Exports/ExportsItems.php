<?php

namespace App\Exports\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportsItems implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch items with their type, ordered by latest
        return Item::with('type')->latest()->get();
    }

    /**
     * Map the item data to the desired format for export
     *
     * @param  Item  $item
     * @return array
     */
    public function map($item): array
    {
        // Retrieve the current locale
        $lang = app()->getLocale();
        
        // Ensure the locale exists in the item's properties to avoid potential undefined index errors
        return [
            $item->title[$lang] ?? $item->title['en'], // Fallback to 'en' if locale is not set
            $item->type->title[$lang] ?? $item->type->title['en'], // Fallback to 'en' for type title
            $item->unit[$lang] ?? $item->unit['en'], // Fallback to 'en' if locale is not set
            $item->quantity,
            $item->min,
            $item->max,
            $item->barcode,
            $item->unit_price,
            $item->units_number,
            $item->tax,
            $item->total_price,
            $item->description[$lang]??$item->description['en'],
        ];
    }

    /**
     * Define the headings for the export
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            __('translation.Item'),
            __('translation.Type'),
            __('translation.Unit'),
            __('translation.Quantity'),
            __('translation.Minimum'),
            __('translation.Maximum'),
            __('translation.Barcode'),
            __('translation.Unit Price'),
            __('translation.Pieces'),
            __('translation.Tax'),
            __('translation.Total Price'),
            __('translation.Description'),
        ];
    }
}
