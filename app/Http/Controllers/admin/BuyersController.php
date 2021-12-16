<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyersController extends Controller
{
    
    public function index()
    { 
        $buyers = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0)->orderBy('id','desc')->paginate(10);
        $buyers_count = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0)->orderBy('id','desc')->count();
        return view('admin.buyers.index',compact(['buyers','buyers_count']));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    // to handel some sort of actions , like delete multiple ,
    //  or send email , sms to multiple 
    public function actions(Request $request)
    {

        $buyer_id = $request->buyer_id;
        if($request->all_colums){
            dd($request->all_colums);
        }
        elseif($buyer_id){
            foreach($buyer_id as $id){
                Buyer::where('id',$id)->delete();
            }
        }
        
    }


    public function show(Buyer $buyer)
    {
        //
    }

    public function edit(Buyer $buyer)
    {
        //
    }

    public function update(Request $request, Buyer $buyer)
    {
        //
    }

  
    public function destroy(Buyer $buyer)
    {
        //
    }
}
