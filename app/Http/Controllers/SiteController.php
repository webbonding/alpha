<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thankyou;
/* * ************Request***************** */

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ContactUsRequest;
/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\StaticPage;
use App\Model\Course;
use App\Model\Contactus;
use App\Model\Testimonial;
use App\Model\Faq;

class SiteController extends Controller {

    public function index() {
        $data = [];
        $data['courses'] = Course::where('status', '1')->get();
        return view('site.index', $data);
    }

    

    public function post_signup(RegisterRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['type_id'] = '2';
            $input['activation_token'] = $this->rand_string(20);
            $model = UserMaster::create($input);
            $link = Route('active-account', ['id' => base64_encode($model->id), 'token' => $model->activation_token]);

            $email_setting = $this->get_email_data('user_registration', array('NAME' => $input['full_name'], 'EMAIL' => $input['email'], 'LINK' => $link));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            $data_msg['u_id'] = $model->id;
            $data_msg['msg'] = "You are successfully registered. Please check your email to verify your account.";
            return response()->json($data_msg);
        }
    }

    public function get_active_account(Request $request, $id, $token) {
        if ($id == "" && $token == "") {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = UserMaster::where('id', $id)->where('activation_token', $token)->first();
        if (empty($model))
            return redirect()->route('/')->with('error', 'Requested url is no longer valid. Please try again.');
        else {
//            Auth::guard('frontend')->login($model);
//            $model->email_verified_at = Carbon::now()->toDateTimeString();
            $model->activation_token = NULL;
            $model->status = '1';
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();
//            Mail::to($model->email)->send(new Thankyou($model));
            return redirect()->route('/')->with('success', 'Your account has been activated successfully.');
        }
    }

    public function post_login(LoginRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->only('email');
            $model = UserMaster::where('email', '=', $input['email'])->first();
            if (!empty($request->input('rememberMe'))) {
                $expire = time() + 172800;
                setcookie('user_email', $request->input('email'), $expire, '/');
                setcookie('user_password', $request->input('password'), $expire, '/');
            } else {
                $expire = time() - 172800;
                setcookie('user_email', '', $expire, '/');
                setcookie('user_password', '', $expire, '/');
            }
            Auth::guard('frontend')->login($model);
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();
            $data_msg['link'] = Route('dashboard');

            $request->session()->flash('success', 'You are successfully logged in.');
            return response()->json($data_msg);
        }
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['reset_password_token'] = $this->rand_string(20);
            $model = UserMaster::where('email', '=', $input['email'])->first();
            $model->update($input);

            $link = route('reset-password', ['id' => base64_encode($model->id), 'token' => $model->reset_password_token]);

            $email_setting = $this->get_email_data('forgot_password', array('NAME' => $model->full_name, 'EMAIL' => $input['email'], 'LINK' => $link));

            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'forgot_password',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            $data_msg['msg'] = 'Your reset password link has been sent to your email.';
            return response()->json($data_msg);
        }
    }

    public function get_reset_password($id, $token) {
        if ($id === "" && $token === "") {
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = UserMaster::where('id', $id)->where('reset_password_token', $token)->first();
        if (empty($model))
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        else {
            Session::put('user_id', $id);
            Session::put('forgot_token', $token);
            return redirect()->route('/');
        }
    }

    public function post_reset_password(ResetRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

            $input['reset_password_token'] = NULL;
            $user_id = Session::get('user_id');
            $model = UserMaster::findOrFail($user_id);
            $model->update($input);
            Session::remove('user_id');
            Session::remove('forgot_token');
            $data_msg['msg'] = 'Your password changed successfully.';
            return response()->json($data_msg);
        }
    }

    public function get_static_page(Request $request) {
        $data = [];
        if ($request->route()->named('about-us')) {
            $data['model'] = StaticPage::where('slug', '=', 'about_us')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('privacy-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'privacy_policy')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('cookie-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'cookie_policy')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('terms-condition')) {
            $data['model'] = StaticPage::where('slug', '=', 'terms_conditions')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('faq-page')) {
            $data['model'] = Faq::where('status', '=', '1')->get();
            return view('site.faq', $data);
        } else {
            return redirect()->route('/');
        }
    }

    public function logout() {
        Auth::guard('frontend')->logout();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }

    

    public function get_faq() {
        $data = [];
        $data['model'] = Faq::where('status', '1')->get();
        return view('site.faq', $data);
    }

    public function get_contactus() {
        return view('site.contact_us');
    }

    public function post_contact(ContactUsRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            $input = $request->all();
            $contact = Contactus::create($input);

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'SUBJECT' => $contact->subject,
                    'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;

            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }

    

}
