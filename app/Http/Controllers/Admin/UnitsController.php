<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Exports\UnitExport;
use App\Imports\UnitImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class UnitsController extends Controller
{
    
    public function index(){
        return view('admin.units.index');
    } 

    public function getUnitsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $unit_obj = new Unit();

        $units_count = $unit_obj->count();
        $units = $unit_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'units' => $units,
            'pagination' => (string) $units->links('pagination::bootstrap-4'),
            'units_count' => $units_count
        ]); 
    }


    public function filterUnits(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $unit_name = $request->unit_name;
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $unit_obj = Unit::where('deleted_at',null);
        if($unit_name){
            $unit_obj->where('unit_en', 'like', '%'. $unit_name .'%')
            ->orWhere('unit_ar', 'like', '%'. $unit_name .'%');
        }

        $units_count = $unit_obj->count();
        $units = $unit_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'units' => $units,
            'pagination' => (string) $units->links('pagination::bootstrap-4'),
            'units_count' => $units_count
        ]);
    }

   
    public function create(){
        //
    }
   
    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }
   
    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        Unit::where('id',$id)->delete();
        $message = 'Unit hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new UnitExport, 'site_Units.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new UnitImport,request()->file('file'));
        return redirect()->back();
    }
}
