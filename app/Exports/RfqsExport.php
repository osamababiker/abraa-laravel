<?php

namespace App\Exports;

use App\Models\Rfq;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RfqsExport implements FromCollection, WithMapping, WithHeadings
{

    public function headings(): array
    { 
        return [
            '#',
            'Buyer name',
            'Buyer phone',
            'Buyer email',
            'Product name',
            'Item name',
            'Product details',
            'Category',
            'Country',
            'Quantity',
            'Unit',
            'Buying Frequency',
            'tags',
            'created at'
        ];
    }
     
    /**
    * @var Rfq $rfq
    */
    public function map($rfq): array
    {
        if($rfq->buyer){
            return [
                $rfq->id,
                $rfq->buyer->full_name,
                $rfq->buyer->phone,
                $rfq->buyer->email,
                $rfq->product_name,
                $rfq->item ? $rfq->item->title : '',
                $rfq->product_detail,
                $rfq->category ? $rfq->category->en_title : '',
                $rfq->country ? $rfq->country->en_name : '',
                $rfq->quantity,
                $rfq->unit ? $rfq->unit->unit_en : '',
                $rfq->buying_frequency ? $rfq->buying_frequency->buying_frequency_en : '',
                $rfq->item_id > 0 ? 'product' : 'global',
                $rfq->date_added
            ];
        }  
        else return [];
    }
     

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return Rfq::all(); 
    } 
}
