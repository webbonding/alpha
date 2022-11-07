<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Carbon\Carbon;
use App\Model\QuestionAnswer;
use App\Model\CourseWeek;
use App\Model\CourseModuleVideo;
class CourseController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Course::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('image', function(Course $data) {
                            $photo = isset($data->image)? URL::asset('public/uploads/course/' . $data->image) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
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
                        ->editColumn('featured', function ($model) {
                            if ($model->featured == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>No</span>';
                            } else if ($model->featured == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Yes</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-course-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteCourse(this);" data-href="' . Route("admin-course-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>'.
                                    '<a href="' . Route("admin-course-week", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Week</a>';
                        })
                        ->rawColumns(['image','featured','status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::course.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::course.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'book_list' => 'required',
                    'additional_resources' => 'required',
                    'prior_knowledge' => 'required',
          			'analysis_basics' => 'required',
          			'functions' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png,svg',
                    'short_description' => 'required',
                    'long_description' => 'required',
                    'featured' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Course();
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }
            
            $data->fill($input)->save();

            return redirect()->route('admin-course-index')->with('success_msg', 'Course created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    //*** GET Request
    public function edit($id) {
        $data = Course::findOrFail($id);
        return view('admin::course.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'book_list' => 'required',
                    'additional_resources' => 'required',
                    'prior_knowledge' => 'required',
          			'analysis_basics' => 'required',
          			'functions' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,svg',
                    'short_description' => 'required',
                    'long_description' => 'required',
                    'featured' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = Course::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }

            $data->update($input);
            
            return redirect()->route('admin-course-index')->with('success_msg', 'Course updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request Status
    public function status($id1, $id2) {
        $data = Course::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Course::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    } 
    
    public function week_datatables($id) {
        $datas = CourseWeek::where('course_id',$id)->orderBy('id', 'asc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('name', function($data) {
                            return $data->name;
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
                        ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-course-week-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="' . Route("admin-course-week-lessons", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Lessons</a>' .
                                    '<a href="javascript:;" onclick="deleteCourseModule(this);" data-href="' . Route("admin-course-week-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function week($id) {
        $course= Course::where('id', $id)->first();
      	$courseweek=CourseWeek::where('course_id',$id)->count();
        return view('admin::course.course_week_list', compact('id','course','courseweek'));
    }
    public function week_add($id) {
        $course= Course::where('id', $id)->first();
      	$courseweek=CourseWeek::where('course_id',$id)->count();
        return view('admin::course.week_add', compact('id','course','courseweek'));
    }
    public function post_week_add(Request $request,$id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new CourseWeek();
            $input = $request->all();
            $input['course_id']=$id;
            
            $data->fill($input)->save();
            $model = Course::where('id', $id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();

            return redirect()->route('admin-course-week', [$id])->with('success_msg', 'Course Week created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    //*** GET Request
    public function week_edit($id) {
        $data = CourseWeek::findOrFail($id);
        return view('admin::course.week_edit', compact('data'));
    }

    //*** POST Request
    public function post_week_edit(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = CourseWeek::findOrFail($id);
            $input = $request->all();
            

            $data->update($input);
            $model = Course::where('id', $data->course_id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();
            
            return redirect()->route('admin-course-week', [$data->course_id])->with('success_msg', 'Course module updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }
    public function week_delete($id) {
        $data = [];
        $model = CourseWeek::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    //Module videos
    
    public function module_video_datatables($id) {
        $datas = CourseModuleVideo::where('module_id',$id)->orderBy('id', 'asc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('name', function($data) {
                            return $data->name;
                        })
                        ->editColumn('time', function($data) {
                            return $data->time;
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
                        ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-course-module-video-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteCourseModuleVideo(this);" data-href="' . Route("admin-course-module-video-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function week_lessons($id) {
        $coursemodule= CourseModule::where('id', $id)->first();
        return view('admin::course.course_week_lessons_list', compact('id','coursemodule'));
    }
    public function week_lessons_add($id) {
        $coursemodule= CourseModule::where('id', $id)->first();
        return view('admin::course.week_lessons_add', compact('id','coursemodule'));
    }
    public function post_week_lessons_add(Request $request,$id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'time' => 'required',
                    'video' => 'required|mimes:mp4,mov,ogg',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new CourseModuleVideo();
            $input = $request->all();
            $input['module_id']=$id;
            if ($file = $request->file('video')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course/video');
                $file->move($destinationPath, $name);
                $input['video'] = $name;
            }
            $data->fill($input)->save();
            $model = Course::where('id', $id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();

            return redirect()->route('admin-course-module-video', [$id])->with('success_msg', 'Course module video created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    //*** GET Request
    public function module_video_edit($id) {
        $data = CourseModuleVideo::findOrFail($id);
        return view('admin::course.module_video_edit', compact('data'));
    }

    //*** POST Request
    public function post_module_video_edit(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'time' => 'required',
                    'video' => 'nullable|mimes:mp4,mov,ogg',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = CourseModuleVideo::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('video')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course/video');
                $file->move($destinationPath, $name);
                $input['video'] = $name;
            }

            $data->update($input);
            $model = Course::where('id', $data->course_id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();
            
            return redirect()->route('admin-course-module-video', [$data->module_id])->with('success_msg', 'Course module video updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }
    public function module_video_delete($id) {
        $data = [];
        $model = CourseModuleVideo::findOrFail($id);
        //If Photo Doesn't Exist
        if ($model->video == null) {
            $model->delete();
            //--- Redirect Section     
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (isset($model->video))
            if (file_exists(public_path('uploads/course/video' . $model->video))) {
                unlink(public_path('uploads/course/video' . $model->video));
            }
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}
