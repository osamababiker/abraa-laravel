<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Buyer;
use App\Models\Item;
use App\Models\Rfq;

class HomeController extends Controller
{
    public function index() {
 
        // get stores count
        $approved_stores_count = DB::table('users_store')
            ->leftJoin('users', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0)
            ->count();
        $pending_stores_count = DB::table('users_store')
            ->leftJoin('users', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',1)
            ->where('users_store.rejected',0)
            ->where('users.external',0)
            ->count();

        // get products count 
        $pending_items_count = DB::table('items')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0)
            ->where('items.status', 0)
            ->where('items.rejected', 0)
            ->where('items.approved', 0)
            ->count(); 
        $approved_items_count = DB::table('items')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0)
            ->where('items.status', 1)
            ->where('items.rejected', 0)
            ->where('items.approved', 1)
            ->count();
        
        // get buying requests count
        $pending_buying_requests_count = Rfq::where('item_id' , '<>', 0)
            ->where('status',1)->count();
        $total_buying_requests_count = Rfq::where('item_id' , '<>', 0)->count();

        // get global buying requests count
        $pending_global_buying_requests_count = Rfq::where('item_id',0)
            ->where('status',1)->count();
        $total_global_buying_requests_count = Rfq::where('item_id',0)->count();

            

        return view('admin.index', compact([
            'approved_stores_count',
            'pending_stores_count',
            'pending_items_count',
            'approved_items_count',
            'total_buying_requests_count',
            'pending_buying_requests_count',
            'pending_global_buying_requests_count',
            'total_global_buying_requests_count'
        ])); 
    }
}
