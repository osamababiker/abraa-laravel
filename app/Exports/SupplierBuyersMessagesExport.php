<?php

namespace App\Exports;

use App\Models\BuyerMessage;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierBuyersMessagesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BuyerMessage::all();
    }
}
