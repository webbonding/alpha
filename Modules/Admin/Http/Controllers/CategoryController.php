<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class CategoryController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Category::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
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
                                    '<a href="' . Route("admin-cat-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteCategory(this);" data-href="' . Route("admin-cat-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::categories.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::categories.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                    'photo' => 'mimes:jpeg,jpg,png,svg',
                    'slug' => 'required|unique:categories|regex:/^[a-zA-Z0-9\s-]+$/'
                        ], [
                    'photo.mimes' => 'Icon Type is Invalid.',
                    'slug.unique' => 'This slug has already been taken.',
                    'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Category();
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/categories');
                $file->move($destinationPath, $name);
                $input['photo'] = $name;
            }
            
            $data->fill($input)->save();

            return redirect()->route('admin-cat-index')->with('success_msg', 'Category created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    //*** GET Request
    public function edit($id) {
        $data = Category::findOrFail($id);
        return view('admin::categories.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                    'photo' => 'mimes:jpeg,jpg,png,svg',
                    'slug' => 'unique:categories,slug,' . $id . '|regex:/^[a-zA-Z0-9\s-]+$/'
                        ], [
                    'photo.mimes' => 'Icon Type is Invalid.',
                    'slug.unique' => 'This slug has already been taken.',
                    'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = Category::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/categories');
                $file->move($destinationPath, $name);
                if ($data->photo != null) {
                    if (file_exists(public_path('uploads/categories'. $data->photo))) {
                        unlink(public_path('uploads/categories' . $data->photo));
                    }
                }
                $input['photo'] = $name;
            }

            

            $data->update($input);
            
            return redirect()->route('admin-cat-index')->with('success_msg', 'Category updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request Status
    public function status($id1, $id2) {
        $data = Category::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Category::findOrFail($id);
        if ($model->subs->count() > 0) {
            //--- Redirect Section
            $data['msg'] = 'Remove the subcategories first !';
            return response()->json($data);
            //--- Redirect Section Ends
        }
        //If Photo Doesn't Exist
        if ($model->photo == null) {
            $model->delete();
            //--- Redirect Section
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends
        }
        //If Photo Exist )
        /*if (file_exists(public_path('uploads/categories/' . $model->photo))) {
            unlink(public_path('uploads/categories/' . $model->photo));
        }
        if (file_exists(public_path('uploads/categories/' . $model->image))) {
            unlink(public_path('uploads/categories/' . $model->image));
        }*/
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}
