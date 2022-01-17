<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CurrenciesRequest;
use App\Models\Currency;
use App\Exports\CurrencyExport;
use App\Imports\CurrencyImport;
use Maatwebsite\Excel\Facades\Excel;

class CurrenciesController extends Controller
{
    
    public function index(){
        return view('admin.currencies.index');
    } 

    public function getcurrenciesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;

        $currency_obj = new Currency();

        $currencies_count = $currency_obj->count();
        $currencies = $currency_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'currencies' => $currencies,
            'currencies_count' => $currencies_count
        ]); 
    }


    public function filtercurrencies(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $currency_name = $request->currency_name;
        $currency_obj = Currency::where('deleted_at',null);
        
        if($currency_name){
            $currency_obj->where('name_en', 'like', '%'. $currency_name .'%')
                ->orWhere('name_ar', 'like', '%'. $currency_name .'%');
        }
        $currencies_count = $currency_obj->count();
        $currencies = $currency_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
   
        return response()->json([
            'currencies' => $currencies,
            'currencies_count' => $currencies_count
        ]);
    }

   
    public function create(){
        return view('admin.currencies.create');
    }

    public function store(CurrenciesRequest $request){
        $currency = new Currency();
        $currency->code = $request->code;
        $currency->status = $request->status;
        $currency->conversion_rate = $request->conversion_rate;
        $currency->name_ar = $request->name_ar;
        $currency->name_en = $request->name_en;
        $currency->name_tr = $request->name_tr;
        $currency->name_ru = $request->name_ru;
        $currency->save();

        $message = 'currency hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

   
    public function show($id){
        $currency = Currency::find($id);
        return view('admin.currencies.show', compact(['currency']));
    }

    
    public function edit($id){
        $currency = Currency::find($id);
        return view('admin.currencies.edit', compact(['currency']));
    }

    
    public function update(Request $request){
        $currency = Currency::find($request->currency_id);
        $currency->code = $request->code;
        $currency->status = $request->status;
        $currency->conversion_rate = $request->conversion_rate;
        $currency->name_ar = $request->name_ar;
        $currency->name_en = $request->name_en;
        $currency->name_tr = $request->name_tr;
        $currency->name_ru = $request->name_ru;
        $currency->save();

        $message = 'currency hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        Currency::where('id',$id)->delete();
        $message = 'Currency hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new CurrencyExport, 'currencies.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new CurrencyImport,request()->file('file'));
           
        return redirect()->back();
    }
}
