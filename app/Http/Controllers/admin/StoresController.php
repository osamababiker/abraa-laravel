<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoresController extends Controller
{
    
    public function index()
    {
        $stores = Store::paginate(10);
        $stores_count = Store::count();
        return view('admin.stores.index', compact(['stores','stores_count']));
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
