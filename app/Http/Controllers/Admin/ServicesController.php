<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Exports\ServiceExport;
use App\Imports\ServiceImport;
use Maatwebsite\Excel\Facades\Excel;

class ServicesController extends Controller
{
   
    public function index()
    {
        return view('admin.services.index');
    } 

    public function getServicesAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $service_obj = new Service();

        $services_count = $service_obj->count();
        $services = $service_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'services' => $services,
            'services_count' => $services_count
        ]); 
    }


    public function filterServices(Request $request){

        $rows_numbers = $request->rows_numbers; 

        $service_obj = Service::where('active', 1);

        $services_count = $service_obj->count();
        $services = $service_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
   
        return response()->json([
            'services' => $services,
            'services_count' => $services_count
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
        Service::where('id',$id)->delete();
        $message = 'service hass been Deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new ServiceExport, 'services.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new ServiceImport,request()->file('file'));
           
        return redirect()->back();
    }
}
