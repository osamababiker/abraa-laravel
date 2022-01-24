<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Country;
use App\Exports\OrdersExport;
use App\Imports\OrdersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;


class OrdersController extends Controller
{

    public function index(){
        $order_statuses = OrderStatus::all();
        $countries = Country::all();
        return view('admin.orders.index', compact(['order_statuses','countries']));
    }

    // to get orders as json
    public function getOrdersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $order_obj = new Order(); 

        $orders_count = $order_obj->count();
        $orders = $order_obj->orderBy('id','DESC')->with('user')
            ->with('status')->with('currency')->paginate($rows_numbers);
        
        return response()->json([
            'orders' => $orders,
            'pagination' => (string) $orders->links('pagination::bootstrap-4'),
            'orders_count' => $orders_count 
        ]);
    }

    // to filter orders
    public function filterOrders(Request $request){
        $user_name = $request->user_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 
        $order_status = $request->order_status;
        $order_type = $request->order_type;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $order_obj = Order::with('user')
        ->with('currency')->with('status')
        ->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'orders.user_id');
        })
        ->select('orders.*');

        if($order_status){
            $order_obj->where('orders.order_status', $order_status);
        }

        if($order_type){
            $order_obj->where('orders.type', $order_type);
        }

        if($user_name){
            $order_obj->where('users.full_name','like', '%' . $user_name . '%'); 
        } 

        if($countries){
            $order_obj->whereIn('users.country', $countries);
        }
         
        $orders_count = $order_obj->count();
        $orders = $order_obj->orderBy('orders.id','desc')
            ->paginate($rows_numbers);

        return response()->json([
            'orders' => $orders,
            'pagination' => (string) $orders->links('pagination::bootstrap-4'),
            'orders_count' => $orders_count
        ]);
    }
   
    public function create(){
        //
    }
   
    public function store(Request $request){
        //
    }

    public function show($id){
        $order = Order::findOrFail($id); 
        return view('admin.orders.show', compact(['order']));
    }

    public function edit($id){
        //
    }

    public function update(Request $request){
        //
    }

    public function destroy($id){
        Order::where('id',$id)->delete();
        $message = 'order hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // to handel some sort of actions  
    public function actions(Request $request){
        // to move selected orders to archived
        if($request->has('delete_selected_btn')){
            foreach($request->order_id as $id){
                $order = Order::find($id);
                $order->delete();
            }
            $message = 'orders hass been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }else 
        // to approve selected orders 
        if($request->has('approve_selected_btn')){
            foreach($request->order_id as $id){
                $order = Order::find($id);
                $order->order_status = 2;
                $order->save();
            }
            $message = 'orders hass been approved successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }else
        // to reject selectd orders
        if($request->has('reject_selected_btn')){
            foreach($request->order_id as $id){
                $order = Order::find($id);
                $order->order_status = 3;
                $order->save();
            }
            $message = 'orders hass been rejected successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
        else
        // to approve single order
        if($request->has('approve_single_order_btn')){
           $order = Order::find($request->order_id);
           $order->order_status = 2;
           $order->save();
           
           $message = 'order hass been approved successfully';
           session()->flash('success', 'true');
           session()->flash('feedback_title', 'Success');
           session()->flash('feedback', $message);
           return redirect()->back();
        }
        else
        // to reject single order
        if($request->has('reject_single_order_btn')){
           $order = Order::find($request->order_id);
           $order->order_status = 3;
           $order->save();
           
           $message = 'order hass been rejected successfully';
           session()->flash('success', 'true');
           session()->flash('feedback_title', 'Success');
           session()->flash('feedback', $message);
           return redirect()->back();
        }
        
    }

    
    // import & export to excel 
    public function exportExcel() {
        return Excel::download(new OrdersExport, 'orders.xlsx'); 
    }
    
    public function importExcel() {
        Excel::import(new OrdersImport,request()->file('file'));
        return redirect()->back();
    }
}
