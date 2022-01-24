<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Country;
use App\Models\Store;
use App\Models\BuyerMessage;
use App\Models\SupplierBuyingRequest;
use App\Models\SupplierFile;
use App\Models\RfqInvoice;
use App\Models\SupplierVerification;
use App\Exports\SuppliersExport;
use App\Imports\SuppliersImport;
use App\Exports\SupplierItemsExport;
use App\Imports\SupplierItemsImport;
use App\Exports\SupplierStoresExport;
use App\Imports\SupplierStoresImport;
use App\Exports\SupplierBuyersMessagesExport;
use App\Imports\SupplierBuyersMessagesImport;
use App\Exports\SupplierBuyingRequestsExport;
use App\Imports\SupplierBuyingRequestsImport;
use App\Imports\SupplierFilesImport;
use App\Exports\SupplierFilesExport;
use App\Imports\SupplierInvoicesImport;
use App\Exports\SupplierInvoicesExport;
use App\Imports\SupplierVerificationsImport;
use App\Exports\SupplierVerificationsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MailerTrait;
use App\Http\Traits\RandomStringTrait; 
use Illuminate\Pagination\Paginator; 


class SuppliersController extends Controller
{

    use MailerTrait, RandomStringTrait; 
 
    public function index(){
        $countries = Country::all();
        return view('admin.suppliers.index', compact(['countries']));
    } 

    public function getSuppliersAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $suppliers_obj = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->orderBy('id','desc'); 
            
        $suppliers_count = $suppliers_obj->count();
        $suppliers = $suppliers_obj->with('supplier_country')->paginate($rows_numbers);
        
        return response()->json([
            'suppliers' => $suppliers,
            'pagination' => (string) $suppliers->links('pagination::bootstrap-4'),
            'suppliers_count' => $suppliers_count
        ]);
    }

    public function filterSuppliers(Request $request){
        $countries = $request->countries;
        $keywords = $request->keywords;
        $rows_numbers = $request->rows_numbers; 
        $supplier_type = $request->supplier_type;
        $product_title = $request->product_title;
        $supplier_name = $request->supplier_name;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $suppliers_obj = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0); 

        if($supplier_name){
            $suppliers_obj->where('full_name', 'like', '%'. $supplier_name .'%');
        }

        if($countries){
            $suppliers_obj->whereIn('country', $countries);
        }
        
        if($keywords){
            $suppliers_obj->where('interested_keywords', 'like', '%'. $keywords[0] .'%');
            for($i = 1; $i < count($keywords); $i++) {
               $suppliers_obj->orWhere('interested_keywords', 'like', '%'. $keywords[$i] .'%');      
            }
        }

        if($product_title){
            foreach($product_title as $title){
                $suppliers_obj->leftJoin('items', function($join) {
                    $join->on('users.id', '=', 'items.user_id');
                    })
                    ->where('title','like', '%' . $title . '%');
            }
        }
        
        if($supplier_type == 'organic'){
            $suppliers_obj->where('is_organic',1);
        }else if($supplier_type == 'no_keywords'){
            $suppliers_obj->where('interested_keywords','');
        }

        $suppliers_count = $suppliers_obj->count();
        $suppliers = $suppliers_obj->with('supplier_country')->paginate($rows_numbers);
        
        return response()->json([
            'suppliers' => $suppliers,
            'pagination' => (string) $suppliers->links('pagination::bootstrap-4'),
            'suppliers_count' => $suppliers_count
        ]);
    }

    /**********************************************/
    // to get supplier items
    public function supplierItems($supplier_id){
        $supplier = Supplier::find($supplier_id);
        $countries = Country::get();
        return view('admin.suppliers.items.index', compact(['supplier','countries']));
    }

    public function getSuppliersItemsAsJson(Request $request,$supplier_id){
        $rows_numbers = $request->rows_numbers; 
        $items_obj = Item::where('user_id', $supplier_id)
            ->select('items.*')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0);

        $items = $items_obj->paginate($rows_numbers);
        $items_counter = $items_obj->count();
        return response()->json([
            'items' => $items,
            'pagination' => (string) $items->links('pagination::bootstrap-4'),
            'items_counter' => $items_counter
        ]);
    }
 
    public function filterSuppliersItems(Request $request, $supplier_id){
        $product_name = $request->product_name;
        $manufacture_country = $request->manufacture_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword; 
        $items_status = $request->items_status;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $item_obj = Item::where('user_id', $supplier_id)
            ->select('items.*')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0);

        if($items_status == 'active'){
            $item_obj = $item_obj->where('items.status', 1)
                ->where('items.rejected', 0)
                ->where('items.approved', 1);
        } 
        elseif($items_status == 'pending'){
            $item_obj = $item_obj->where('items.status', 0)
                ->where('items.rejected', 0)
                ->where('items.approved', 0);
        }
        elseif($items_status == 'rejected'){
            $item_obj = $item_obj->where('items.rejected',1);
        }
        elseif($items_status == 'home'){
            $item_obj = $item_obj->where('items.rejected',1);
        }
        else {
            $item_obj = $item_obj->where('items.active',1)
                ->where('items.status',1)
                ->where('items.rejected',0)
                ->where('items.approved',1); 
        }
        
        if($product_name){
            $item_obj->where('items.title','like', '%' . $product_name . '%'); 
        }

        if($manufacture_country){
            $item_obj->whereIn('items.manufacture_country', $manufacture_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $item_obj->where('items.meta_keyword','like', '%' . $word . '%');
            }
        }
            
        $items_count = $item_obj->count();
        $items = $item_obj->with('category')
            ->orderBy('items.id','desc')->paginate($rows_numbers);

        return response()->json([
            'items' => $items,
            'pagination' => (string) $items->links('pagination::bootstrap-4'),
            'items_count' => $items_count
        ]);
    }


    /**********************************************/
    // to get supplier stores
    public function supplierStores($supplier_id){
        $supplier = Supplier::find($supplier_id);
        $countries = Country::all();
        return view('admin.suppliers.stores.index', compact(['supplier','countries']));
    }

    public function getSuppliersStoresAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $stores_status = $request->stores_status;

        $store_obj = Store::where('sub_of', $supplier_id)->where('rejected',0);

        $stores_count = $store_obj->count();
        $stores = $store_obj->with('user')->orderBy('id','desc')
            ->paginate($rows_numbers);
        
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }

    public function filterSuppliersStores(Request $request, $supplier_id){
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;
        $stores_status = $request->stores_status;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::where('sub_of', $supplier_id)->where('rejected',0);
        
        if($store_name){
            $store_obj->where('name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->with('user')
            ->orderBy('id','desc')->paginate($rows_numbers);

   
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }


    /**********************************************/
    // to get supplier stores
    public function supplierBuyersMessages($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.buyersMessages.index', compact(['supplier']));
    }

    public function getSuppliersBuyersMessagesAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $buyers_messages_obj = BuyerMessage::where('supplier_id', $supplier_id)
        ->with('supplier')->with('buyer');

        $buyers_messages_count = $buyers_messages_obj->count();
        $buyers_messages = $buyers_messages_obj
            ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'buyers_messages' => $buyers_messages,
            'pagination' => (string) $buyers_messages->links('pagination::bootstrap-4'),
            'buyers_messages_count' => $buyers_messages_count
        ]);
    } 

    public function filterSuppliersBuyersMessages(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers; 
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buyers_messages_obj = BuyerMessage::where('supplier_id', $supplier_id)
        ->with('supplier')->with('buyer');
            
        $buyers_messages_count = $buyers_messages_obj->count();
        $buyers_messages = $buyers_messages_obj
            ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'buyers_messages' => $buyers_messages,
            'pagination' => (string) $buyers_messages->links('pagination::bootstrap-4'),
            'buyers_messages_count' => $buyers_messages_count
        ]);
    }


    /**********************************************/
    // to get supplier buying Requests
    public function supplierbuyingRequests($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.buyingRequests.index', compact(['supplier']));
    }

    public function getSuppliersbuyingRequestsAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $buying_requests_obj = SupplierBuyingRequest::where('supplier_id', $supplier_id)
        ->with('supplier')->with('buying_request');

        $buying_requests_count = $buying_requests_obj->count();
        $buying_requests = $buying_requests_obj
            ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]);
    } 

    public function filterSuppliersbuyingRequests(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers; 
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_requests_obj = SupplierBuyingRequest::where('supplier_id', $supplier_id)
        ->with('supplier')->with('buying_request');
            
        $buying_requests_count = $buying_requests_obj->count();
        $buying_requests = $buying_requests_obj
            ->orderBy('id','desc')->paginate($rows_numbers);
   
        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]);
    }


    /**********************************************/
    // to get supplier files
    public function supplierFiles($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.files.index', compact(['supplier']));
    }

    public function getSuppliersFilesAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $files_obj = SupplierFile::where('sub_of', $supplier_id)
        ->with('supplier');

        $files_count = $files_obj->count();
        $files = $files_obj
            ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'files' => $files,
            'pagination' => (string) $files->links('pagination::bootstrap-4'),
            'files_count' => $files_count
        ]);
    } 

    public function filterSuppliersFiles(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers; 
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $files_obj = SupplierFile::where('sub_of', $supplier_id)
        ->with('supplier');
            
        $files_count = $files_obj->count();
        $files = $files_obj
            ->orderBy('id','desc')->paginate($rows_numbers);
   
        return response()->json([
            'files' => $files,
            'pagination' => (string) $files->links('pagination::bootstrap-4'),
            'files_count' => $files_count
        ]);
    }
    

    /**********************************************/
    // to get supplier invoices
    public function supplierInvoices($supplier_id){
        $supplier = Supplier::find($supplier_id);
        $countries = Country::all();
        return view('admin.suppliers.invoices.index', compact(['supplier','countries']));
    }

    public function getSuppliersInvoicesAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $buying_request_status = $request->buying_request_status;
        $buying_request_obj = RfqInvoice::where('supplier_id', $supplier_id);
     
        if($buying_request_status == 'approvel'){    
            $buying_request_obj = $buying_request_obj->where('status',2);
        }
        elseif($buying_request_status == 'completed'){
            $buying_request_obj = $buying_request_obj->where('status',3);
        }
        elseif($buying_request_status == 'canceled'){
            $buying_request_obj = $buying_request_obj->where('status',5);
        }
        elseif($buying_request_status == 'pending'){
            $buying_request_obj = $buying_request_obj->where('status',1);
        }
      
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
            ->with('buying_request')->with('supplier')->with('unit')
            ->with('currency')->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]); 
    }

    public function filterSuppliersInvoices(Request $request, $supplier_id){
        $product_name = $request->product_name;
        $shipping_country = $request->shipping_country;
        $rows_numbers = $request->rows_numbers; 
        $request_type = $request->request_type;
        $buying_request_status = $request->buying_request_status;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_request_obj =  RfqInvoice::where('supplier_id', $supplier_id)
            ->select('buying_request_invoices.*')
            ->leftJoin('buying_requests', 'buying_requests.id', 'buying_request_invoices.buying_request_id');

        if($buying_request_status == 'approvel'){    
            $buying_request_obj = $buying_request_obj->where('buying_requests.status',2);
        }
        elseif($buying_request_status == 'completed'){
            $buying_request_obj = $buying_request_obj->where('buying_requests.status',3);
        }
        elseif($buying_request_status == 'canceled'){
            $buying_request_obj = $buying_request_obj->where('buying_requests.status',5);
        }
        elseif($buying_request_status == 'pending'){
            $buying_request_obj = $buying_request_obj
                ->where('buying_request_invoices.approved', '<>', 1);
        }
        
        if($product_name){
            $buying_request_obj->where('buying_requests.product_name','like', '%' . $product_name . '%');
        }

        if($request_type == 'global'){
            $buying_request_obj->where('buying_requests.item_id', 0);
        }

        if($shipping_country){
            $buying_request_obj->whereIn('buying_requests.country_code', $shipping_country);
        }
            
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
            ->with('buying_request')->with('supplier')->with('currency')
            ->with('unit')->orderBy('buying_request_invoices.id','desc')->paginate($rows_numbers);

   
        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]);
    }


    /**********************************************/
    // to get supplier verifications
    public function suppliersVerifications($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.verifications.index', compact(['supplier']));
    }

    public function getSuppliersVerificationsAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $verifications_obj = SupplierVerification::where('user_id', $supplier_id)
        ->with('supplier');

        $verifications_count = $verifications_obj->count();
        $verifications = $verifications_obj
            ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'verifications' => $verifications,
            'pagination' => (string) $verifications->links('pagination::bootstrap-4'),
            'verifications_count' => $verifications_count
        ]);
    } 

    public function filterSuppliersVerifications(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers; 
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        
        $verifications_obj = SupplierVerification::where('user_id', $supplier_id)
        ->with('supplier');
            
        $verifications_count = $verifications_obj->count();
        $verifications = $verifications_obj
            ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'verifications' => $verifications,
            'pagination' => (string) $verifications->links('pagination::bootstrap-4'),
            'verifications_count' => $verifications_count
        ]);
    }

    public function create(){
        $countries = Country::all();
        return view('admin.suppliers.create', compact(['countries']));
    }

    // **********************************************/
    // supplier create items 
    public function createSupplierItems($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.items.create', compact(['supplier']));
    }

    // **********************************************/
    // supplier create stores 
    public function createSupplierStores($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.stores.create', compact(['supplier']));
    }

    // **********************************************/
    // supplier create buying Requests 
    public function createSupplierbuyingRequests($supplier_id){
        $supplier = Supplier::find($supplier_id);
        return view('admin.suppliers.buyingRequests.create', compact(['supplier']));
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'business_name' => 'required',
            'country' => 'required',
            'interested_keywords' => 'required',
            'primary_name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'primary_position' => 'required',
            'primary_whatsapp' => 'required',
            'primary_line_number' => 'required'
        ]);

        $salt = $this->getRandomString(3); 
        $register_on = date('Y-m-d H:i:s');
        $verified = 1;
        $verification_token = md5(time() . rand(10000, 99999));
        $trash = 0;
        $user_source = 22;
        $added_by = Auth::user()->id;
        $user_type = 0;
        $member_type = 1;
        $is_organic = 0;
        $register_level = 3;
        $is_login = 0;

        $interested_keywords = '';
        foreach($request->interested_keywords as $keywords){
            $interested_keywords .= $keywords . ',' ;
        }

        if($request->secondary_position){
            $secondary_position = $request->secondary_position;
        }else $secondary_position = 0;

        $supplier = new Supplier();

        $supplier->salt = $salt;
        $supplier->register_on = $register_on;
        $supplier->verified = $verified;
        $supplier->verification_token = $verification_token;
        $supplier->trash = $trash;
        $supplier->user_source = $user_source;
        $supplier->added_by = $added_by;
        $supplier->user_type = $user_type;
        $supplier->member_type = $member_type;
        $supplier->is_organic = $is_organic;
        $supplier->register_level = $register_level;
        $supplier->is_login = $is_login;

        $supplier->business_name = $request->business_name;
        $supplier->country = $request->country;
        $supplier->interested_keywords = $interested_keywords;
        $supplier->full_name = $request->primary_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->primary_position = $request->primary_position;
        $supplier->primary_whatsapp = $request->primary_whatsapp;
        $supplier->primary_line_number = $request->primary_line_number;

        $supplier->secondary_contact_person = $request->secondary_name;
        $supplier->secondary_email = $request->secondary_email;
        $supplier->secondary_phone = $request->secondary_m_phone;
        $supplier->secondary_position = $secondary_position;
        $supplier->secondary_whatsapp = $request->secondary_whatsapp;
        $supplier->secondary_line_number = $request->secondary_line_number;
        $supplier->save();

        // to create new store for this supplier
        $store = new Store();
        $store->sub_of = $supplier->id;
        $store->save();

        // to send email to supplier
        $subject = 'Abraa registration verification';
        $message='
        <p>Dear '.$supplier->full_name.'</p>
        <p>We have received your request to join Abraa.com,</p>
        <p>Kindly click the below link in order to verify your email and create your password.</p>
        <a target="_blank" href="' . config('global.public_url') . 'register/verify-link/' . $verification_token . '" style="float:right;padding: 7px 14px;border-radius:6px;background: #46d4e6;color:#FFFFFF;font-size:11px;text-decoration:none;font-family:\'Roboto\', Helvetica, Arial, sans-serif;">www.abraa.com/verification_link</a>
        ';
        $email_templete = $this->getEmailTemplete($message);
        $this->sendEmail($email_templete, $request->email, $subject, 'membership@abraa.com');
        
        $message = 'Supplier hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
        
    }   

    // to handel some sort of actions , like delete multiple ,
    //  or send email , sms to multiple 
    public function actions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $supplier_id = $request->supplier_id;
            if($request->all_colums){
                Supplier::delete();
            }
            elseif($supplier_id){
                foreach($supplier_id as $id){
                    Supplier::where('id',$id)->delete();
                }
            }
            $message = 'suppliers has been archived successfully';
            session()->flash('feedback', $message);
            return redirect()->back();
        }

        if($request->has('send_message_btn')){
            $suppliers_ids = $request->suppliers_ids;
            $subject = $request->subject;
            $message = $request->message;
            foreach($suppliers_ids as $supplier_id){
                $supplier = Supplier::find($supplier_id);
                $email_content = $this->send_custom_email_to_suppliers($supplier, $message);
                $email_templete = $this->getEmailTemplete($email_content);
                $this->sendEmail($email_templete, $supplier->email, $subject);
            }

            return response()->json([
                'message' => 'Email has been send successfuly'
            ],200);
        }
        
    }

    // **********************************************/
    // supplier items action
    public function supplierItemsActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $item_id = $request->item_id;
            if($request->all_colums){
                Item::delete();
            }
            elseif($item_id){
                foreach($item_id as $id){
                    Item::where('id',$id)->delete();
                }
            }
            $message = 'items has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Item Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // **********************************************/
    // supplier stores action
    public function supplierStoresActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $store_id = $request->store_id;
            if($request->all_colums){
                Store::delete();
            }
            elseif($store_id){
                foreach($store_id as $id){
                    Store::where('id',$id)->delete();
                }
            }
            $message = 'stores has been archived successfully';
            session()->flash('feedback', $message);
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Store Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    } 

    // **********************************************/
    // supplier buers messages action
    public function supplierbuyersMessagesActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $message_id = $request->message_id;
            if($request->all_colums){
                BuyerMessage::delete();
            }
            elseif($message_id){
                foreach($message_id as $id){
                    BuyerMessage::where('id',$id)->delete();
                }
            }
            $message = 'messages  has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Message Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // **********************************************/
    // supplier buying requests action
    public function supplierbuyingRequestsActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $request_id = $request->request_id;
            if($request->all_colums){
                SupplierBuyingRequest::delete();
            }
            elseif($request_id){
                foreach($request_id as $id){
                    SupplierBuyingRequest::where('id',$id)->delete();
                }
            }
            $message = 'request has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Request Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // **********************************************/
    // supplier files action
    public function supplierFilesActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $file_id = $request->file_id;
            if($request->all_colums){
                SupplierFiles::delete();
            }
            elseif($file_id){
                foreach($file_id as $id){
                    SupplierFiles::where('id',$id)->delete();
                }
            }
            $message = 'file has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'File Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // **********************************************/
    // supplier invoices action
    public function supplierInvoicesActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $invoice_id = $request->invoice_id;
            if($request->all_colums){
                RfqInvoice::delete();
            }
            elseif($invoice_id){
                foreach($invoice_id as $id){
                    RfqInvoice::where('id',$id)->delete();
                }
            }
            $message = 'invoices has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Invoice Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // **********************************************/
    // supplier verifications action
    public function supplierVerificationsActions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $verification_id = $request->verification_id;
            if($request->all_colums){
                SupplierVerification::delete();
            }
            elseif($verification_id){
                foreach($verification_id as $id){
                    SupplierVerification::where('id',$id)->delete();
                }
            }
            $message = 'verifications has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Successfully archived');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
 
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.suppliers.show', compact(['supplier']));
    }

 
    public function edit($id){
        $supplier = Supplier::find($id);
        $countries = Country::all();
        return view('admin.suppliers.edit', compact(['supplier','countries']));
    }

   
    public function update(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);

        // to update primary contact info
        $interested_keywords = '';
        foreach($request->interested_keywords as $keywords){
            $interested_keywords .= ',' .$keywords;
        }
        $supplier->business_name = $request->business_name;
        $supplier->country = $request->country;
        $supplier->interested_keywords = $interested_keywords;
        $supplier->full_name = $request->primary_name;
        $supplier->email = $request->primary_email;
        $supplier->phone = $request->primary_m_phone;
        $supplier->primary_position = $request->primary_position;
        $supplier->primary_whatsapp = $request->primary_whatsapp;
        $supplier->primary_line_number = $request->primary_line_number;

        // to update secoundry contact info
        $supplier->secondary_contact_person = $request->secondary_name;
        $supplier->secondary_email = $request->secondary_email;
        $supplier->secondary_phone = $request->secondary_m_phone;
        $supplier->secondary_position = $request->secondary_position;
        $supplier->secondary_whatsapp = $request->secondary_whatsapp;
        $supplier->secondary_line_number = $request->secondary_line_number;

        $supplier->save();
        $message = "supplier has been updated successfully";
        session()->flash('feedback', $message);
        session()->flash('feedback_title', 'updated successfully');
        session()->flash('success', 'true');
        return redirect()->back();
    }

 
    public function destroy($id){
        Supplier::where('id',$id)->delete();
        $message = 'Supplier hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Supplier Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // **********************************************/
    // destroy supplier item
    public function destroySupplierItems($id){
        Item::where('id',$id)->delete();
        $message = 'Item hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // **********************************************/
    // destroy supplier store
    public function destroySupplierStores($id){
        Store::where('id',$id)->delete();
        $message = 'store hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // **********************************************/
    // destroy supplier buyers messages
    public function destroySupplierBuyersMessages($id){
        BuyerMessage::where('id',$id)->delete();
        $message = 'message hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // **********************************************/
    // destroy supplier buying requests
    public function destroySupplierBuyingRequests($id){
        SupplierBuyingRequest::where('id',$id)->delete();
        $message = 'request hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // **********************************************/
    // destroy supplier files
    public function destroySupplierFiles($id){
        SupplierFile::where('id',$id)->delete();
        $message = 'file hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // **********************************************/
    // destroy supplier invoices
    public function destroySupplierInvoices($id){
        RfqInvoice::where('id',$id)->delete();
        $message = 'invoice hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // **********************************************/
    // destroy supplier verifications
    public function destroySupplierVerifications($id){
        SupplierVerification::where('id',$id)->delete();
        $message = 'verification hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully archived');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new SuppliersExport, 'suppliers.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new SuppliersImport,request()->file('file'));
        return redirect()->back();
    }

    // **********************************************/
    // import & export to excel for supplier items
    public function supplierItemsExportExcel() {
        return Excel::download(new SupplierItemsExport, 'supplier_items.xlsx'); 
    }
   
    public function supplierItemsImportExcel() {
        Excel::import(new SupplierItemsImport,request()->file('file'));
        return redirect()->back();
    }

    // **********************************************/
    // import & export to excel for supplier stores
    public function supplierStoresExportExcel() {
        return Excel::download(new SupplierStoresExport, 'supplier_stores.xlsx'); 
    }
   
    public function supplierStoresImportExcel() {
        Excel::import(new SupplierStoresImport,request()->file('file'));
        return redirect()->back();
    }

    // **********************************************/
    // import & export to excel for supplier buyers messages
    public function supplierBuyersMessagesExportExcel() {
        return Excel::download(new SupplierBuyersMessagesExport, 'supplier_buyers_messages.xlsx'); 
    }
   
    public function supplierBuyersMessagesImportExcel() {
        Excel::import(new SupplierBuyersMessagesImport,request()->file('file'));
        return redirect()->back();
    }

    // **********************************************/
    // import & export to excel for supplier buying requests
    public function supplierBuyingRequestsExportExcel() {
        return Excel::download(new SupplierBuyingRequestsExport, 'supplier_buying_requests.xlsx'); 
    }
   
    public function supplierBuyingRequestsImportExcel() {
        Excel::import(new SupplierBuyingRequestsImport,request()->file('file'));
        return redirect()->back();
    }

    // **********************************************/
    // import & export to excel for supplier files
    public function supplierFilesExportExcel() {
        return Excel::download(new SupplierFilesExport, 'supplier_files.xlsx'); 
    }
   
    public function supplierFilesImportExcel() {
        Excel::import(new SupplierFilesImport,request()->file('file'));
        return redirect()->back();
    }

    // **********************************************/
    // import & export to excel for supplier files
    public function supplierInvoicesExportExcel() {
        return Excel::download(new SupplierInvoicesExport, 'supplier_invoices.xlsx'); 
    }
   
    public function supplierInvoicesImportExcel() {
        Excel::import(new SupplierInvoicesImport,request()->file('file'));
        return redirect()->back();
    }


    // **********************************************/
    // import & export to excel for supplier verifications
    public function supplierVerificationsExportExcel() {
        return Excel::download(new SupplierVerificationsExport, 'supplier_verifications.xlsx'); 
    }
   
    public function supplierVerificationsImportExcel() {
        Excel::import(new SupplierVerificationsImport,request()->file('file'));
        return redirect()->back();
    }

    
}
