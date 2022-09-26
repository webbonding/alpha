<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
/* * *************** Request ************ */
use Modules\Admin\Http\Requests\AddProductRequest;
use Modules\Admin\Http\Requests\EditProductRequest;
/* * *************** Model ************ */
use App\Model\Product;
use App\Model\Category;
use App\Model\UserMaster;
use App\Model\Settings;

class ProductController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('admin::product.list');
    }

    public function get_products_list_datatable() {
        $product_list = Product::select('*')->where('status', '<>', '3')->get();

        return Datatables::of($product_list)
                        ->addIndexColumn()
                        ->editColumn('photo', function($model) {
                            $photo = $model->photo ? URL::asset('public/uploads/product/' . $model->photo) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        ->editColumn('name', function ($model) {
                            return $model->name;
                        })
                        ->editColumn('price', function ($model) {
                            return '<i class="fa fa-inr" aria-hidden="true"></i>' . $model->price;
                        })
                        ->editColumn('created_at', function ($model) {
                            return date("Y-m-d H:i:s", strtotime($model->created_at));
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-updateproduct', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm "  title="Edit">'
                                    . '<i class="fa fa-edit"></i>'
                                    . '</a>'
                                    . '<a href="javascript:void(0);" onclick="deleteProduct(this);" data-href="' . Route("admin-deleteproduct", ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm " data-toggle="tooltip" title="Delete">'
                                    . '<i class="fa fa-trash"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->rawColumns(['photo','price', 'status', 'action'])
                        ->make(true);
    }

    public function view(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Product::findOrFail($id);
        if (count($model) > 0 && $model->status != '3') {
            return view('admin::product.view', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-products');
        }
    }

    public function add_product() {
        $cats = Category::all();
        return view('admin::product.add', compact('cats'));
    }

    public function post_add_product(AddProductRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $product_id = $this->store($request, NULL);

            $product = Product::where('id', $product_id)->first();

            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('admin-products');
            return response()->json($data_msg);
        }
    }

    public function get_update(Request $request, $id) {
        $data = [];
        $data['data'] = $model = Product::where('id', '=', $id)->first();
        $data['cats'] = Category::all();

        if (!empty($model) > 0 && $model->status != '3') {
            return view('admin::product.edit', $data);
        } else {
            return redirect()->route('admin-products')->with('error_msg', 'Invalid Link!');
        }
    }

    public function post_update(EditProductRequest $request, $id) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = Product::findorFail($id);
            $product_id = $this->store($request, $model->id);


            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('admin-products');
            return response()->json($data_msg);
        }
    }

    public function store($request, $checkProduct = NULL) {
        $input = $request->all();
        if ($photo = $request->file('photo')) {
            $name = time() . $photo->getClientOriginalName();
            $destinationPath = public_path('uploads/product');
            $photo->move($destinationPath, $name);
            $input['photo'] = $name;
        }
        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/product');
            $file->move($destinationPath, $name);
            $input['file'] = $name;
        }
        if ($checkProduct !== NULL) {
            $product = Product::where('id', $checkProduct)->where('status', '<>', '3')->first();
            $product->update($input);
        } else {

            $input['status'] = '1';
            $product = Product::create($input);
        }

        return $product->id;
    }

    public function delete(Request $request, $id) {
        $data = [];
        $model = Product::where('id', '=', $id)->findOrFail($id);
        if (!empty($model) > 0 && $model->status != '3') {
            $model->update(['status' => '3']);
            $request->session()->flash('success', 'Product deleted successfully.');
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        $data['status'] = 200;
        $data['msg'] = 'Product deleted successfully.';
        return response()->json($data);
    }

}
