<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuppliersExport implements FromCollection, WithMapping, WithHeadings
{

    public function headings(): array
    { 
        return [
            '#',
            'Supplier name',
            'Supplier phone',
            'Supplier email',
            'Supplier Gender',
            'Is Active',
            'Is Verified',
            'Country',
            'City',
            'Company',
            'Last Login',
            'Last Ip',
            'Search Log',
            'tags',
            'created at'
        ];
    }
     
    /**
    * @var Supplier $supplier
    */
    public function map($supplier): array
    {
        return [
            $supplier->id,
            $supplier->full_name,
            $supplier->phone,
            $supplier->email,
            $supplier->gender,
            $supplier->active == 1 ? 'Active' : 'Not Active',
            $supplier->verified == 1 ? 'Verified' : 'Not Verified',
            $supplier->supplier_country ? $supplier->supplier_country->en_name : '',
            $supplier->supplier_city ? $supplier->supplier_city->en_name : '',
            $supplier->company,
            $supplier->last_login,
            $supplier->last_ip,
            $supplier->search_log,
            $supplier->interested_keywords,
            $supplier->date_added
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Supplier::all();
    }
} 
