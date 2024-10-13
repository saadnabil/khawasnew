<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAdmins implements FromCollection, WithHeadings,  WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::latest()->get();
    }

     /**
     * @return array
     */
    public function headings(): array
    {
        return [
            __('translation.NAME'),
            __('translation.Email'),
            __('translation.PHONE NUMBER'),
            __('translation.Status'),
            __('translation.Role'),
           
        ];
    }

     /**
     * @var Admin $admin
     * @return array
     */
    public function map($admin): array
    {
        $roles = $admin->getRoleNames()->implode(', ');

        return [
            $admin->name,
            $admin->email,
            $admin->phone,
            $admin->status == 0 ? 'Inactive' : 'Active',
            $roles,
        ];
    }
}
