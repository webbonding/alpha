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
/* * ************Models************* */
use App\Model\UserMaster;

class UserController extends AdminController {

    protected $appid, $secret;

    public function get_user_list() {


        return view('admin::user.user_list');
    }

    public function get_user_list_datatable() {
        $user_list = UserMaster::where('type_id', '2')->where('status', '<>', '3')->get();
        return Datatables::of($user_list)
                        ->addIndexColumn()
                        ->editColumn('image', function(UserMaster $data) {
                            $photo = $data->image ? URL::asset('public/uploads/user/' . $data->image) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        
                        ->editColumn('full_name', function ($model) {
                            return $model->full_name;
                        })
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })
                        ->editColumn('created_at', function($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        ->editColumn('payment_status', function ($model) {
                            if ($model->payment_status == '0') {
                                $payment_status= '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                if($model->subscription_end >= Carbon::now()->format('Y-m-d')){
                                $payment_status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                                }else{
                                $payment_status= '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';  
                                }
                            } 
                            return $payment_status;
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
                                    '<a href="' . Route("user-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteUser(this);" data-href="' . Route("user-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','status','payment_status', 'action'])
                        ->make(true);
    }

    public function get_add_user() {
        $data = [];
        return view('admin::user.user_add', $data);
    }

    public function post_add_user(Request $request) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'email' => 'required',
        ]);
        $validator->after(function($validator) use($request) {
            $checkUser = UserMaster::where('email', $request->input('email'))->count();
            if ($checkUser > 0)
                $validator->errors()->add('email', 'Email already in use.');
        });
        if ($validator->passes()) {
            $model = new UserMaster;
            $model->full_name = $request->input('full_name');
            $model->email = $request->input('email');
            $password = $this->rand_string(8);
            $url = url("/login");
            $model->password = Hash::make($password);
            $model->type_id = 2;
            $model->status = '1';
            $model->save();
            $email_setting = $this->get_email_data('new_account_create_for_user', array('NAME' => $request->input('full_name'), 'EMAIL' => $request->input('email'), 'PASSWORD' => $password, 'URL' => $url));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'create_customer',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            return redirect()->route('users')->with('success_msg', 'User account created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function get_edit_user($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('users')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::user.user_edit', $data);
    }

    public function post_edit_user(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|numeric|digits_between:10,15',
        ]);
        $validator->after(function($validator) use($request) {
            $checkUser = UserMaster::where('id', '<>', $request->input('id'))->where('email', $request->input('email'))->first();

            if (!empty($checkUser))
                $validator->errors()->add('email', 'Email already in use.');
        });
        if ($validator->passes()) {
            $model = UserMaster::where('id', '=', $id)->first();
            $model->full_name = $request->input('full_name');
            $model->email = $request->input('email');
            $model->phone = $request->input('phone');
            $model->status = $request->input('status');
            $model->payment_status = $request->input('payment_status');
           
                if($request->input('payment_status')=='1'){
                    $futureDate = date('Y-m-d', strtotime('+1 year'));
                    $model->subscription_end = $futureDate;
                }
            
            if ($request->hasFile('image')) {
                $model->image = $this->uploadimage($request);
            }
            $model->save();
            return redirect()->route('users')->with('success_msg', 'User updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = UserMaster::findorFail($id);
            if (!empty($model)) {
                $model->status = '3';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'User deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No User details found.';
            }
            return response()->json($data);
        }
    }

    public function uploadimage($request) {
        $sample_image = $request->file('image');
        $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/user');
        $sample_image->move($destinationPath, $imagename);
        return $imagename;
    }

    public function get_users_csv() {
        $table = UserDetails::where('status', '=', '1')->get();
        $filename = "users_details.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('User Id', 'Name', 'Mobile No', 'Email', 'Country', 'State', 'District', 'Gp/Nac', 'Block/Bmc/Nac', 'Full Address', 'Latitude', 'Longitude', 'Name As Per Aadhaar', 'Aadhar Number', 'Mobile No Linked With Aadhar', 'Pan Number', 'Nominee Name', 'Nominee Mobile Number', 'Relationship With Nominee', 'Other Relationship With Nominee', 'Bank Name', 'Bank Account Number', 'Bank IFSC Code', 'Services'));

        foreach ($table as $row) {
            $RequestServices = RequestService::where('user_id', $row['id'])->where('status', '1')->get();
            $services = '';
            foreach ($RequestServices as $RequestService) {
                $serviceName = Service::where('id', $RequestService['service_id'])->first();
                $services = $services . $serviceName->service_name . ', ';
            }
            if ($services == '') {
                $services = 'Not Available';
            }
            fputcsv($handle, array($row['user_id'], $row['name'], $row['mobile_no'], $row['email'], $row['country'], $row['state'], $row['district'], $row['gp_nac'], $row['block_bmc_nac'], $row['full_address'], $row['latitude'], $row['longitude'], $row['name_as_per_aadhaar'], $row['aadhar_number'], $row['mobile_no_linked_with_aadhar'], $row['pan_number'], $row['nominee_name'], $row['nominee_mobile_number'], $row['relationship_with_nominee'], $row['other_relationship_with_nominee'], $row['bank_name'], $row['bank_account_number'], $row['bank_ifsc_code'], $services));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename);
    }

    public function download_image($name) {

        $filepath = public_path('/uploads/user/') . $name;

        return response()->download($filepath);
    }

}
