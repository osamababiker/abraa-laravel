<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;

class RfqsController extends Controller
{

    public function index()
    {
        $buying_requests = Rfq::paginate(10);
        $buying_requests_count = Rfq::count();
        return view('admin.rfq.index', compact(['buying_requests','buying_requests_count'])); 
    }

    public function pending_rfq()
    {
        $buying_requests = Rfq::where('item_id' , '<>', 0)
            ->where('status',1)->paginate(10);
        $buying_requests_count = Rfq::where('item_id' , '<>', 0)
            ->where('status',1)->count();
        return view('admin.rfq.pending', compact(['buying_requests','buying_requests_count']));
    }


    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
