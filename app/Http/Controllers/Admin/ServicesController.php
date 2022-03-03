<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\ServicesRequest;
use App\Exports\ServiceExport;
use App\Imports\ServiceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use App\Http\Traits\FilesUploadTrait;

class ServicesController extends Controller
{
    use FilesUploadTrait;
   
    public function index(){
        return view('admin.services.index');
    } 

    public function getServicesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $service_obj = new Service();

        $services_count = $service_obj->count();
        $services = $service_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'services' => $services,
            'pagination' => (string) $services->links('pagination::bootstrap-4'),
            'services_count' => $services_count
        ]); 
    }


    public function filterServices(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $service_obj = Service::where('active', 1);
        $services_count = $service_obj->count();
        $services = $service_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'services' => $services,
            'pagination' => (string) $services->links('pagination::bootstrap-4'),
            'services_count' => $services_count
        ]);
    }
   
    public function create(){
        return view('admin.services.create');
    }

    public function store(ServicesRequest $request){
        
        $slug = Str::slug($request->name);
        
        $service_image = '';
        if($request->has('service_image')){
            $image = $request->file('service_image');
            $image_name = time().'.'.$image->extension();
            $temp_dir = $image->getPathName();
            $service_image = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        Service::create([
            'name' => $request->name,
            'slug' => $slug,
            'meta-title' => $request->meta_title,
            'meta-description' => $request->meta_description,
            'meta-keywords' => $request->meta_keywords,
            'stype' => $request->stype,
            'active' => $request->active,
            'description' => $request->description,
            'pagecontent' => $request->pagecontent,
            'page_image' => $service_image
        ]);

        $message = 'Service has been Added Successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully Added');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    public function show($id){
        $service = Service::findOrFail($id);
        $service = $service->toArray();
        return view('admin.services.show', compact(['service']));
    }

   
    public function edit($id){
        $service = Service::findOrFail($id);
        $service = $service->toArray();
        return view('admin.services.edit', compact(['service']));
    }

    
    public function update(Request $request){
        $service = Service::findOrFail($request->service_id);
        $slug = '';
        $service_name = explode(" ", $request->name);
        foreach($service_name as $name){
            $slug .= $name . '-';
        }
        $slug = rtrim($slug, "- ");
        
        $service_image = '';
        if($request->has('service_image')){
            $image = $request->file('service_image');
            $image_name = time().'.'.$image->extension();
            $temp_dir = $image->getPathName();
            $service_image = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $service_image = $service->page_image;

        Service::where('id', $service->id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'meta-title' => $request->meta_title,
            'meta-description' => $request->meta_description,
            'meta-keywords' => $request->meta_keywords,
            'stype' => $request->stype,
            'active' => $request->active,
            'description' => $request->description,
            'pagecontent' => $request->pagecontent,
            'page_image' => $service_image
        ]);

        $message = 'Service has been Updated Successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully Updated');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

   
    public function destroy($id){
        Service::where('id',$id)->delete();
        $message = 'service hass been Deleted successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new ServiceExport, 'services.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new ServiceImport,request()->file('file')); 
        return redirect()->back();
    }
}
