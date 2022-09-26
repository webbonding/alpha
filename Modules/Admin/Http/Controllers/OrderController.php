<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
use Response;
use Carbon\Carbon;
use App\Model\Order;
use App\Model\UserMaster;
use App\Model\Product;

class OrderController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Order::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('user_id', function ($model) {
                            $user=UserMaster::where('id',$model->user_id)->first();
                            return (!empty($user->full_name)) ? $user->full_name : 'Not available';
                        })
                        ->editColumn('product_id', function ($model) {
                            $product=Product::where('id',$model->product_id)->first();
                            return (!empty($product->name)) ? $product->name : 'Not available';
                        })
                        
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-F-Y') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-order-view', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm "  title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::order.list');
    }

   public function view($id) {
        $data = Order::findOrFail($id);
        return view('admin::order.view', compact('data'));
    }

    //*** GET Request
    public function edit($id) {
        $data = Order::findOrFail($id);
        return view('admin::order.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = Order::findOrFail($id);
            $input = $request->all();



            $data->update($input);
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('admin-order-index')->with('success_msg', 'Order Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Order::findOrFail($id);


        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }

}
