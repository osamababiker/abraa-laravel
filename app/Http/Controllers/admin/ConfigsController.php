<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Exports\ConfigExport;
use App\Imports\ConfigImport;
use Maatwebsite\Excel\Facades\Excel;


class ConfigsController extends Controller
{
 
    public function index()
    {
        return view('admin.configs.index');
    } 

    public function getConfigsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $config_obj = new Config();

        $configs_count = $config_obj->count();
        $configs = $config_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'configs' => $configs,
            'configs_count' => $configs_count
        ]); 
    }


    public function filterconfigs(Request $request){

        $rows_numbers = $request->rows_numbers; 
        $config_obj = Config::where('deleted_at',null);
            
        $configs_count = $config_obj->count();
        $configs = $config_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
   
        return response()->json([
            'configs' => $configs,
            'configs_count' => $configs_count
        ]);
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

   
    public function destroy($id){
        Config::where('id',$id)->delete();
        $message = 'Config hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new ConfigExport, 'site_configs.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new ConfigImport,request()->file('file'));
           
        return redirect()->back();
    }
}
