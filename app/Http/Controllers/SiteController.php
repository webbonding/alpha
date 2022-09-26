<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thankyou;
/* * ************Request***************** */
//use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\CheckoutRequest;

/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\StaticPage;
use App\Model\Contactus;
use App\Model\Category;
use App\Model\Subcategory;
use App\Model\Blog;
use App\Model\Product;
use App\Model\Order;
use App\Model\Slider;
use App\Model\Settings;
use App\Model\Cart;
use App\Model\UserInfromation;

class SiteController extends Controller {

    public function index() {
        $data = [];
        $data['categories']=Category::where('status','1')->get();
        $data['subcategories']=Subcategory::where('status','1')->get();
        $data['products']=Product::where('status','1')->get();
        $data['latest_products']=Product::where('status','1')->orderBy('id', 'desc')->take('24')->get();
        $data['sliders']=Slider::where('status','1')->get();
        return view('site.maintainance', $data);
    }

    public function get_signup() {
        $data = [];
        return view('site.signup ', $data);
    }

    function imageUpload($image) {
        $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/user/');
        $image->move($destinationPath, $name);
        return $name;
    }

    public function post_signup(RegisterRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['image'] = $imagename;
            }
            $input['full_name'] = $input['first_name'] . ' ' . $input['last_name'];
            $password=$input['password'];
            $input['password'] = Hash::make($password);
            $input['type_id'] = '2';
            $input['status'] = '1';
            // $input['activation_token'] = $this->rand_string(20);
            $model = UserMaster::create($input);
            // $link = Route('active-account', ['id' => base64_encode($model->id), 'token' => $model->activation_token]);

            $email_setting = $this->get_email_data('user_registration', array('NAME' => $input['full_name'], 'EMAIL' => $input['email'], 'PASSWORD' => $password));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            Auth::guard('frontend')->login($model);
            $model->activation_token = NULL;
            $model->status = '1';
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();
            $data_msg['link'] = Route('dashboard');
            $data_msg['u_id'] = $model->id;
            $data_msg['msg'] = "You are successfully registered.";
            $request->session()->flash('success', 'You are successfully registered.');
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

    public function get_about_us(Request $request) {
        $data = [];
        return view('site.about_us', $data);
    }
    public function recipe(Request $request) {
        $data = [];
        return view('site.recipe', $data);
    }
    public function blog(Request $request) {
        $data = [];
        return view('site.blog', $data);
    }

    public function get_login() {
        return view('site.login');
    }

    public function post_login(LoginRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->only('email');
            $model = UserMaster::where('email', '=', $input['email'])->first();
            
            Auth::guard('frontend')->login($model);
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();
            if (Cookie::has('guest_user_selectfresh')) {
                $user_id = Cookie::get('guest_user_selectfresh');
                $array = Cart::select('product_id')->where('user_id', '=', $model->id)->whereStatus('1')->get()->toArray();
                $usercarts = Arr::flatten($array);
                $products = Cart::where('user_id', '=', $user_id)->where('status','1')->get();
                
//                if (sizeof($products) > 0) {
//                    foreach ($products as $product) {
//
//                        if (!in_array($product->product_id, $usercarts)) {
//                            $product->user_id = $model->id;
//                            $product->save();
//                        }
//                    }
//                }
//                if (count($products) > 0) {
                    foreach ($products as $product) {
                        $product->user_id = $model->id;
                        $product->save();
                    }
//                }
                Cookie::forget('guest_user_selectfresh');
            }
            $data_msg['link'] = Route('dashboard');

            $request->session()->flash('success', 'You are successfully logged in.');
            return response()->json($data_msg);
        }
    }

    public function get_forgot_password() {
        return view('site.forgot-one');
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['reset_password_token'] = $this->rand_string(20);
            $model = UserMaster::where('email', '=', $input['email'])->first();
            $model->update($input);

            $link = Route('reset-password', ['id' => base64_encode($model->id), 'token' => $model->reset_password_token]);

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
        // print_r(1);
        // exit;
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
            $data = [];
            return view('site.forgot-two', $data);
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
            $data_msg['link'] = Route('/');

            $request->session()->flash('success', 'Your password changed successfully.');
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
        } else if ($request->route()->named('return-refund-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'return-refund-policy')->first();
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

    public function get_contactus() {
        $data = [];
        $data['model'] = Settings::where('module', '=', 'Location')->get();
        $data['social_links'] = Settings::where('module', '=', 'Social Link')->get();
        return view('site.contact_us', $data);
    }

    public function post_contact(ContactUsRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            $input = $request->all();
            $contact = Contactus::create($input);

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email,
                    'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => 'albert@yopmail.com',
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
                // print_r(1);
                // exit;
            endif;

            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }

    public function category(Request $request, $slug, $slug1 = null) {
        // print_r($slug1);
        // exit;

        if ($slug == "") {
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
        $cat = null;
        $subcat = null;

        if (!empty($slug)) {
            $cat = Category::where('slug', $slug)->firstOrFail();
            $data['cat'] = $cat;
        }
        

        if (!empty($slug1)) {
            $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
            $data['subcat'] = $subcat;
        }
        
        $products = Product::when($cat, function ($query, $cat) {
                    return $query->where('category_id', $cat->id);
                })
                ->when($subcat, function ($query, $subcat) {
                    return $query->where('subcategory_id', $subcat->id);
                });

        


        $products = $products->where('status', '1')->get();
        // print_r($products);
        // exit;

        $data['products'] = $products;


        return view('site.product', $data);
        
    }
    
  	
  	public function autocomplete(Request $request)
    {
      	
      	$search = $request->input('search');
        $datas = Blog::select("title")->where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->get();
   		
      	$response = array();
      foreach($datas as $data){
         $response[] = array("value"=>$data->title,"label"=>$data->title);
      }

      return response()->json($response);
    }

    public function checkout() {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['carts'] = $cart = Cart::where(['user_id' => $user_id, 'status' => '1'])->get();
        if (!sizeof($cart)>0) {
            return redirect()->route('cart')->with('error_msg', 'No product added to cart!');
        }
        $data['user_details']=UserMaster::where('id',$user_id)->first();
        $data['user_information']=UserInfromation::where('user_id',$user_id)->first();
        return view('site.checkout', $data);
        
    }

    public function post_checkout(CheckoutRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $input = $request->all();

            $input['order_number'] = $this->rand_string(8);
            $input['user_id'] = $user_id;
            $input['status'] = '1';
            $carts = cart::where('user_id', $user_id)->where('status', '1')->get();
            // $mesage='Hello Admin Message From '.$input['full_name'];
            $message='';
            $wp_message=" Hello Select Fresh %0a Order Enquiry from ".$input['full_name']."%0a Address: ".$input['address']."%0a City: ".$input['city']."%0a State: ".$input['state']."%0a *Order Details* %0a";
            foreach ($carts as $cart) {
                $product=Product::where('id',$cart->product_id)->first();
                $input['product_id'] = $cart->product_id;
                $input['quantity'] = $cart->quantity;
                $input['item_price'] = $cart->item_price;

                
                $order = Order::create($input);

                
                $message .='Product Name: '.$product->name.' - Qty: '.$cart->quantity.'<br/>';
                $wp_message .=" Product Name: ".$product->name." - Qty: ".$cart->quantity."%0a";
            }
            Session::put('whatapp_message', $wp_message);
            $user_information = UserInfromation::where('user_id',$user_id)->first();
            if(empty($user_information)){
                $user_information = UserInfromation::create($input);
            }else{
                $user_information->update($input);
            }
            

            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('order_success', array('ADMIN' => "Admin", 'SOCIAL_TITLE' => $input['social_title'], 'NAME' => $input['full_name'], 'EMAIL' => $input['email'],
                    'PHONE' => $input['phone'], 'ADDRESS' => $input['address'], 'CITY' => $input['city'], 'STATE' => $input['state'],
                    'ZIPCODE' => $input['zipcode'], 'NOTES' => isset($input['notes'])?$input['notes']:'Not Provided', 'PRODUCT_DETAILS' => $message));
                $email_data = [
                    'to' => 'jackfruitwork@gmail.com',
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
                // print_r(1);
                // exit;
            endif;


            // $data_msg['amount'] = $input['amount'] . '00';
            $models = cart::where('user_id', $user_id)->delete();
            $data_msg['link'] = Route('thank-you');
            $request->session()->flash('success', 'Thank You for your Order');
            $data_msg['msg'] = "Thank You for you Query";
            return response()->json($data_msg);
        }
    }
    public function thank_you() {
        $data['whatapp_message'] = Session::get('whatapp_message');
        // Session::remove('whatapp_message');
        return view('site.thank_you', $data);
    }

    public function logout() {
        Auth::guard('frontend')->logout();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }

}
