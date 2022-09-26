<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Blog;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use URL;
use Validator;

class BlogController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Blog::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('photo', function(Blog $data) {
                            $photo = $data->photo ? URL::asset('public/uploads/blog/' . $data->photo) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-blog-edit", $model->id) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteBlog(this);" data-href="' . Route("admin-blog-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['photo', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::blog.list');
    }

    //*** GET Request
    public function create() {
        $cats = Category::all();
        return view('admin::blog.add', compact('cats'));
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'title' => 'required',
                    'details' => 'required',
                    'status' => 'required',
                    'photo' => 'required|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {

            //--- Validation Section Ends
            //--- Logic Section
            $data = new Blog();
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/blog');
                $file->move($destinationPath, $name);
                $input['photo'] = $name;
            }
            $input['slug'] = Str::slug($input['title'], "-");
            $slug = Blog::where('slug', $input['slug'])->count();
            if ($slug > 0) {
                $input['slug'] = $input['slug'] . '-' . time();
            }
            $data->fill($input)->save();
            //--- Logic Section Ends
            //--- Redirect Section        
            return redirect()->route('admin-blog-index')->with('success_msg', 'Blog Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id) {
        $cats = Category::all();
        $data = Blog::findOrFail($id);
        return view('admin::blog.edit', compact('data', 'cats'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'title' => 'required',
                    'slug' => 'required',
                    'details' => 'required',
                    'status' => 'required',
                    'photo' => 'nullable|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = Blog::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/blog');
                $file->move($destinationPath, $name);
                if ($data->photo != null) {
                    if (file_exists(public_path('uploads/blog' . $data->photo))) {
                        unlink(public_path('uploads/blog' . $data->photo));
                    }
                }
                $input['photo'] = $name;
            }
            $slug = Blog::where('slug', $input['slug'])->where('id','<>',$id)->count();
            if ($slug > 0) {
                $input['slug'] = $input['slug'] . '-' . time();
            }

            $data->update($input);
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('admin-blog-index')->with('success_msg', 'Blog Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Blog::findOrFail($id);
        //If Photo Doesn't Exist
        if ($model->photo == null) {
            $model->delete();
            //--- Redirect Section     
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (isset($model->photo))
            if (file_exists(public_path('uploads/blog' . $model->photo))) {
                unlink(public_path('uploads/blog' . $model->photo));
            }
        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }

}
