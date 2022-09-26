<?php

# Copy the code from below to that controller file located at app/Http/Controllers/RazorpayController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Model\UserMaster;
use App\Model\Settings;
use App\Model\Product;
use App\Model\Cart;
use App\Model\Order;

class RazorpayController extends Controller {

    public function pay() {

        $data = [];
        $data['subscription'] = Settings::where('slug', 'subscription_charge')->first();
        $data['razorpay'] = Settings::where('slug', 'razorpay_key')->first();
        return view('user.pay', $data);
    }

    public function dopayment(Request $request) {
        //Input items of form
        $data_msg = [];
        $card = [];
        $input = $request->all();

        $futureDate = date('Y-m-d', strtotime('+1 year'));

        $input['payment_status'] = '1';
        $input['subscription_end'] = $futureDate;
        $model = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);

        if ($model->update($input)) {
            $data_msg['msg'] = 'Your Payment is successful';
        } else {
            $data_msg['msg'] = 'Some thing went wwrong!';
        }

        return response()->json($data_msg);
        // Please check browser console.
    }

    public function docheckoutpayment(Request $request) {
        //Input items of form
        $data_msg = [];
        $card = [];
        $input = $request->all();

        $user_id = Auth::guard('frontend')->user()->id;
        $futureDate = date('Y-m-d', strtotime('+1 year'));
        $input['order_number'] = $this->rand_string(8);
        $input['user_id'] = $user_id;
        $input['status'] = '1';
        $carts = cart::where('user_id', $user_id)->where('status', '1')->get();
        foreach ($carts as $cart) {

            $input['product_id'] = $cart->product_id;
            $input['pay_amount'] = $cart->item_price;

            
            $order = Order::create($input);
        }
        $model = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);
        $email_setting = $this->get_email_data('order_success', array('NAME' => $model->full_name));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            
        $models = cart::where('user_id', $user_id)->delete();
        
        $data_msg['msg'] = 'Your Payment is successful';


        return response()->json($data_msg);
        // Please check browser console.
    }

}
