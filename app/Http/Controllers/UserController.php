<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Validator;
use Carbon\Carbon;
use App\Helpers\CalenderApi;
/* * ************Request***************** */
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditprofileRequest;
/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\Order;
use App\Model\Product;

class UserController extends Controller {

    public function dashboard() {
        $id = Auth::guard('frontend')->user()->id;

        $data = [];
        $data['model'] = UserMaster::find(Auth()->guard('frontend')->user()->id);
        return view('user.dashboard', $data);
    }

    public function get_profile() {
        $model = UserMaster::find(Auth()->guard('frontend')->user()->id);
        return view('user.edit_profile', ['model' => $model]);
    }

    public function post_profile(EditprofileRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = UserMaster::find(Auth()->guard('frontend')->user()->id);
            $input = $request->all();
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['image'] = $imagename;
            }
            $model->update($input);
            $request->session()->flash('success_msg', 'Profile updated successfully.');
            $data_msg['msg'] = 'Profile updated successfully.';
            $data_msg['link'] = Route('my-profile');

            return response()->json($data_msg);
        }
    }

    public function reset_password(ChangePasswordRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $model->update($input);
            $data_msg['msg'] = 'Your password changed successfully.';
            return response()->json($data_msg);
        }
    }

    public function get_change_image() {
        $model = UserMaster::where('id', Auth::guard('frontend')->id())->first();
        return view('user.change_image', ['model' => $model]);
    }

    

    public function upload_picture(Request $request) {
        $validator = Validator::make($request->all(), [
                    'image' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            $data['errors'] = $validator->errors()->getMessages();
            $data['status'] = 'error';
        } else {
            $user_id = Auth::guard('frontend')->user()->id;
            $model = UserMaster::findOrFail($user_id);
            if ($request->file('image')) {
                if (file_exists(public_path('uploads/frontend/profile_picture/original/' . $model->profile_picture))) {
                    File::delete(public_path('uploads/frontend/profile_picture/original/' . $model->profile_picture));
                    File::delete(public_path('uploads/frontend/profile_picture/preview/' . $model->profile_picture));
                    File::delete(public_path('uploads/frontend/profile_picture/thumb/' . $model->profile_picture));
                }
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/frontend/profile_picture/original/'), $img_name);
                Image::make(public_path('uploads/frontend/profile_picture/original/') . $img_name)->resize(500, 500)->save(public_path('uploads/frontend/profile_picture/preview/') . $img_name);
                Image::make(public_path('uploads/frontend/profile_picture/original/') . $img_name)->resize(200, 200)->save(public_path('uploads/frontend/profile_picture/thumb/') . $img_name);
                $model->image = $img_name;
            }
            if ($model->save()) {
                $user_id = Auth::guard('frontend')->user()->id;
                $data = UserMaster::findOrFail($user_id);
                return response()->json([
                            'status' => 'success',
                            'data' => $data,
                            'msg' => 'profile photo update successfully',
                            'link' => route('my-profile')
                ]);
                die();
            } else {
                return response()->json([
                            'status' => 'failed',
                            'msg' => "Please try again"
                ]);
                die();
            }
        }
        return response()->json($data);
    }
    public function order() {
        $model = Order::where('user_id', Auth()->guard('frontend')->user()->id)->get();
        return view('user.user_order', ['model' => $model]);
    }

    public function order_datatable() {
        $package = Order::where('user_id', Auth()->guard('frontend')->user()->id)->orderBy('id', 'DESC')->get();
        // print_r(Auth()->guard('frontend')->user()->id);
        // exit;
        return Datatables::of($package)
                        ->addIndexColumn()
                        
                        ->editColumn('order_number', function ($model) {
                            return $model->order_number;
                        })
                        ->editColumn('product_id', function ($model) {
                            $product=Product::where('id',$model->product_id)->first();
                            return (!empty($product->name)) ? $product->name : 'Not available';
                        })
                        
                        
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-F-Y') : 'Not Found';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Pending</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Details send to email</span>';
                            }
                            return $status;
                        })
                        
                        
                        
                        ->rawColumns(['product_id','status','action'])
                        ->make(true);
    }

}
