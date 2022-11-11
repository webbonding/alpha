<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use URL;
use Validator;

class TestimonialController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Testimonial::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('photo', function(Testimonial $data) {
                            $photo = $data->photo ? URL::asset('public/uploads/testimonial/' . $data->photo) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        ->editColumn('content', function($row) {
                            return (strlen($row->content) > 200) ? substr($row->content, 0, 200) . '...' : $row->content;
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
                                    '<a href="' . Route("admin-testimonial-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteTestimonial(this);" data-href="' . Route("admin-testimonial-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['photo','status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::testimonial.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::testimonial.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                    'photo' => 'mimes:jpeg,jpg,png,svg',
                    'content' => 'required'
                        ], [
                    'photo.mimes' => 'Image Type is Invalid.',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Testimonial();
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/testimonial');
                $file->move($destinationPath, $name);
                $input['photo'] = $name;
            }
            
            $data->fill($input)->save();

            return redirect()->route('admin-testimonial-index')->with('success_msg', 'Testimonial created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    //*** GET Request
    public function edit($id) {
        $data = Testimonial::findOrFail($id);
        return view('admin::testimonial.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                    'photo' => 'mimes:jpeg,jpg,png,svg',
                    'content' => 'required'
                        ], [
                    'photo.mimes' => 'Image Type is Invalid.',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = Testimonial::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/testimonial');
                $file->move($destinationPath, $name);
                if ($data->photo != null) {
                    if (file_exists(public_path('uploads/testimonial'. $data->photo))) {
                        unlink(public_path('uploads/testimonial' . $data->photo));
                    }
                }
                $input['photo'] = $name;
            }

            

            $data->update($input);
            
            return redirect()->route('admin-testimonial-index')->with('success_msg', 'Testimonial updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request Status
    public function status($id1, $id2) {
        $data = Testimonial::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Testimonial::findOrFail($id);
        
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
        /*if (file_exists(public_path('uploads/testimonial/' . $model->photo))) {
            unlink(public_path('uploads/testimonial/' . $model->photo));
        }*/
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}
