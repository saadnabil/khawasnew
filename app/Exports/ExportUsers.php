<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUsers implements FromCollection, WithHeadings,  WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::latest()->get();
    }


    public function map($user): array
    {

        $lang = app()->getLocale();
        return [
            $user->usercode,
            $user->name,
            $user->phone,
            $user->email,
            $user->status == 0 ? 'Inactive' : 'Active',
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            __('translation.Customer ID'),
             __('translation.NAME'),
             __('translation.PHONE NUMBER'),
             __('translation.Email'),
             __('translation.Status'),

        ];
    }

}
