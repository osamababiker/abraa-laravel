<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToModel
{
    private $data; 

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function model(array $row){ 
        
        $lastid = Item::orderBy('id','DESC')->first()->id;
        $slug = str_replace(' ', '-', substr($row[0] ,0,10)) . '-' . ($lastid + 1);
        if($row[0]){
            $title = $row[0];
        }else $title = ' ';

        if($row[1]){
            $details = $row[1];
        }else $details = ' ';

        if($row[5]){
            $price = $row[5];
        }else $price = 0;

        if($row[6]){
            $default_image = $row[6];
        }else $default_image = 0;

        return new Item([
            'sub_of' => $this->data['category_id'],
            'user_id' => $this->data['supplier_id'],
            'phone' => $this->data['supplier_phone'],
            'state' => '0',
            'title' => $title,
            'details' => $details,
            'slug' => $slug, 
            'price' => $price,
            'default_image' => $default_image,
            'youtube_video' => ' ',
            'deliver_per' => 0,
            'part_number' => ' ',
            'visits' => 0,
            'added' => date('Y-m-d H:i:s'),
            'expire' => '2035-05-05 12:02:15',
            'expired' => 0,
            'active' => 1,
            'status' => 1,
            'featured' => 0,
            'accept_min_offer' => 0,
            'sort_order' => 0,
            'meta_keyword' => ' ',
            'meta_description' => ' ',
            'lat' => ' ',
            'lon' => ' ',
            'capacity' => '0',
            'capcity_frequency' => '0',
            'is_bulk' => 1

        ]); 
    }
}
