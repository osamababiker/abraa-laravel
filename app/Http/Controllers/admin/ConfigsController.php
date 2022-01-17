<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Http\Requests\ConfigsRequest;
use App\Exports\ConfigExport;
use App\Imports\ConfigImport;
use Maatwebsite\Excel\Facades\Excel;


class ConfigsController extends Controller
{
 
    public function index(){
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
        $config_name = $request->config_name;

        if($config_name){
            $config_obj = Config::where('config_name', 'like', '%'. $config_name . '%');
        }else $config_obj = new Config();

        $configs_count = $config_obj->count();
        $configs = $config_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
   
        return response()->json([
            'configs' => $configs,
            'configs_count' => $configs_count
        ]);
    }


    public function create(){
        return view('admin.configs.create');
    }
   
    public function store(ConfigsRequest $request){
        $config = new Config();
        $config->config_name = $request->config_name;
        $config->config_value = $request->config_value;
        $config->save();

        $message = 'Config hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show($id){
        $config = Config::find($id);
        return view('admin.configs.show', compact(['config']));
    }
  
    public function edit($id){
        $config = Config::find($id);
        return view('admin.configs.edit', compact(['config']));
    }

    public function update(Request $request){
        $config = Config::find($request->config_id);
        $config->config_name = $request->config_name;
        $config->config_value = $request->config_value;
        $config->save();

        $message = 'Config hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

   
    public function destroy($id){
        Config::where('id',$id)->delete();
        $message = 'Config hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel configs table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->config_id as $id){
                Config::where('id',$id)->delete();
            }
            $message = 'Config hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }   
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
