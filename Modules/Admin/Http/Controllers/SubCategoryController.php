<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Category;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class SubCategoryController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Subcategory::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->addColumn('category', function(Subcategory $data) {
                            return $data->category->name;
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
                            return
                                    '<a href="' . Route("admin-subcat-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteSubCategory(this);" data-href="' . Route("admin-subcat-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::subcategories.list');
    }

    //*** GET Request
    public function create() {
        $cats = Category::all();
        return view('admin::subcategories.add', compact('cats'));
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'name' => 'required',
                    'status' => 'required',
                    'photo' => 'mimes:jpeg,jpg,png,svg',
                    'slug' => 'required|unique:subcategories|regex:/^[a-zA-Z0-9\s-]+$/'
                        ], [
                    'photo.mimes' => 'Icon Type is Invalid.',
                    'slug.unique' => 'This slug has already been taken.',
                    'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = new Subcategory();
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/subcategories');
                $file->move($destinationPath, $name);
                $input['photo'] = $name;
            }
            
            $data->fill($input)->save();
            //--- Logic Section Ends
            //--- Redirect Section
            return redirect()->route('admin-subcat-index')->with('success_msg', 'Subcategory created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id) {
        $cats = Category::all();
        $data = Subcategory::findOrFail($id);
        return view('admin::subcategories.edit', compact('data', 'cats'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'name' => 'required',
                    'status' => 'required',
                    'photo' => 'mimes:jpeg,jpg,png,svg',
                    'slug' => 'unique:subcategories,slug,' . $id . '|regex:/^[a-zA-Z0-9\s-]+$/'
                        ], [
                    'photo.mimes' => 'Icon Type is Invalid.',
                    'slug.unique' => 'This slug has already been taken.',
                    'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = Subcategory::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/subcategories');
                $file->move($destinationPath, $name);
                $input['photo'] = $name;
            }
            
            $data->update($input);
            //--- Logic Section Ends
            //--- Redirect Section
            return redirect()->route('admin-subcat-index')->with('success_msg', 'Subcategory updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request Status
    public function status($id1, $id2) {
        $data = Subcategory::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request
    public function load($id) {
        $cat = Category::findOrFail($id);
        return view('admin::subcategories.load', compact('cat'));
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Subcategory::findOrFail($id);
        //If Photo Exist )
        if(isset($model->photo))
        if (file_exists(public_path('uploads/subcategories' . $model->photo))) {
            unlink(public_path('uploads/subcategories' . $model->photo));
        }


        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}
