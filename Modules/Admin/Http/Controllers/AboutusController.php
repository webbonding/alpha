<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Testimonial;
use Yajra\Datatables\Datatables;
use Validator;

class AboutusController extends AdminController {

    public function index(Request $request) {
        return view('admin.aboutus.index');
    }

    public function get_list() {
        $aboutus = Testimonial::select(['*'])->where('status', '1');
        return Datatables::of($aboutus)
                        ->editColumn('description', function ($model) {
                            return '<p>' .str_limit($model->description, 80) . '</p>';
                        })
                        ->addColumn('action', function ($model) {
                            $html = '<a href="' . Route("aboutuspage-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                            return $html;
                        })
                        ->make(true);
    }

    public function get_add() {
        return view('admin.aboutus.add', []);
    }

    public function post_add(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'description' => 'required',
        ]);
        if ($validator->passes()) {
            $model = new Testimonial;
            $model->title = $request->input('title');
            $model->description = $request->input('description');
            $model->status = '1';
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();
            return redirect()->route('aboutuspage')->with('success_msg', 'About us section Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function get_edit($id) {
        $model = Testimonial::where('id', $id)->first();
        return view('admin.aboutus.edit', ['model' => $model]);
    }

    public function post_edit($id, Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'description' => 'required',
        ]);
        if ($validator->passes()) {
            $model = Testimonial::where('id', $id)->first();
            $model->title = $request->input('title');
            $model->description = $request->input('description');
            $model->status = '1';
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            return redirect()->route('aboutuspage')->with('success_msg', 'About us updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete($id) {
        $model = Testimonial::where('id', $id)->first();
        $model->status = '3';
        $model->updated_at = date("Y-m-d H:i:s");
        $model->save();
        return redirect()->route('aboutuspage')->with('success_msg', 'About us deleted successfully.');
    }

}
