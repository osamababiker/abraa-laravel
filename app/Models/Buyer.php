<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model 
{
    use HasFactory;  
    use SoftDeletes;
    protected $table = "users";
    protected $guarded = []; 

    public function buyer_country() { 
        return $this->belongsTo(Country::class,'country','co_code');
    } 

    public function buyer_city() {
        return $this->belongsTo(State::class,'city');
    }
 
    public function getUserSource($source){
        $result = 'Unknown';
        switch ($source) {
            case 0:
                $result = 'Unknown';
                break;
            case 1:
                $result = 'Old';
                break;
            case 2:
                $result = 'Save Representative';
                break;
            case 3:
                $result = 'Store From Mobile';
                break;
            case 4:
                $result = 'Submit Request';
                break;
            case 5:
                $result = 'Payment insert Address';
                break;
            case 6:
                $result = 'Social Media';
                break;
            case 7:
                $result = 'Register On Lead';
                break;
            case 8:
                $result = 'Sign Up Guest';
                break;
            case 9:
                $result = 'Sign Up View Store';
                break;
            case 10:
                $result = 'Ajax Register Buyer';
                break;
            case 11:
                $result = 'Checkout Plan';
                break;
            case 12:
                $result = 'Plans Thank You';
                break;
            case 13:
                $result = 'Sign Up Express';
                break;
            case 14:
                $result = 'Sign Up Verify';
                break;
            case 15:
                $result = 'Item Buy Request';
                break;
            case 16:
                $result = 'Admin Tools Update Buying Request';
                break;
            case 17:
                $result = 'Admin Tools Store Process Excel';
                break;
            case 18:
                $result = 'Sign Up';
                break;
            case 19:
                $result = 'Admin: Send Supplier Verification';
                break;
            case 20:
                $result = 'Admin: Approve Global Request Suppliers';
                break;
            case 21:
                $result = 'Admin: Send Global Request';
                break;
            case 22:
                $result = 'Admin: Add Supplier';
                break;
            case 23:
                $result = 'Admin: Add Buyer';
                break;
            case 24:
                $result = 'Admin: Add Suppliers';
                break;
            case 25:
                $result = 'Admin: Add Store';
                break;
            case 26:
                $result = 'Admin: Lead Send Global Request';
                break;
            case 27:
                $result = 'Admin: Lead Add Buyer';
                break;
            case 28:
                $result = 'Admin: Lead Add Suppliers';
                break;
            case 29:
                $result = 'Admin: Bulk Uploaded Suppliers';
                break;
            case 30:
                $result = 'Admin: Add Shipper';
                break;
            case 35:
                $result = "Bulk Verified By Email";
                break;
        }
        return $result;
    }
}
