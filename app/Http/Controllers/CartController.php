<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Auth;
use URL;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
/* * ********* Request **************** */
//use App\Http\Requests\ShippingAddressRequest;
//use App\Http\Requests\PaymentFormRequest;

/* * ********* Models **************** */
use App\Model\Cart;
use App\Model\Product;

class CartController extends Controller {

    public function index() {

        $data = [];

        if (Auth()->guard('frontend')->guest() && Cookie::has('guest_user_selectfresh')) {
            $user_id = Cookie::get('guest_user_selectfresh');
        } else if (!Auth()->guard('frontend')->guest()) {
            $user_id = Auth()->guard('frontend')->user()->id;
        } else {
            $user_id = 0;
        }
        
        $data['carts'] = $cart = Cart::where(['user_id' => $user_id, 'status' => '1'])->get();
        
        if ($user_id === 0) {
            return view('cart.notfound');
        } else {
            if (sizeof($cart) > 0) {
                return view('cart.cart', $data);
            } else {
                return view('cart.notfound');
            }
        }
    }

    public function add_to_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            $product_id = $request->input('product_id');
            $quantity = $request->input('quantity');
            $model = Product::findorFail($product_id);
            if (Auth()->guard('frontend')->guest()) {
                $user_id = $this->rand_string(10);
                if (Cookie::has('guest_user_selectfresh')) {
                    $user_id = Cookie::get('guest_user_selectfresh');
                } else {
                    Cookie::queue(Cookie::make('guest_user_selectfresh', $user_id, (86400 * 30), '/'));
                }
            } else {
                $user_id = Auth()->guard('frontend')->user()->id;
            }
            
            $checkProduct = Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('status', '1')->first();
            if (!empty($checkProduct) > 0) {
                $input['quantity'] = $checkProduct->quantity + $quantity;
                $checkProduct->update($input);
                $data['type'] = 1;
                $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                $data['msg'] = "cart quantity updated successfully.";
            } else {
                $input['user_id'] = $user_id;
                $input['product_id'] = $product_id;
                $input['item_price'] = ($model->price !== NULL) ? $model->price : 0;
                $input['quantity'] = $quantity;
                $input['status'] = '1';
                Cart::create($input);
                $data['type'] = 1;
                $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                $data['msg'] = "Successfully added to the cart.";
            }

            return response()->json($data);
        }
    }

    public function remove_from_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            if (Auth()->guard('frontend')->guest() && Cookie::has('guest_user_selectfresh')) {
                $user_id = Cookie::get('guest_user_selectfresh');
            } else {
                $user_id = Auth()->guard('frontend')->user()->id;
            }
            $product_id = $request->input('product_id');
            $checkProduct = Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('status', '1')->first();
            if (!empty($checkProduct)) {
                $input['status'] = '3';
                $checkProduct->update($input);
                $products = Cart::where('user_id', $user_id)->where('status', '1')->get();
                $total = 0;
                $sub_total = 0;
                foreach ($products as $product) {
                    $total += $product->item_price;
                    $sub_total += $product->item_price;
                }
                    
                if (!sizeof($products)>0) {
                    $data['content'] = view('cart.notfound')->render();
                }
                $data['total'] =  number_format($total, 2);
                $data['sub_total'] =  number_format($sub_total, 2);
                $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                $data['msg'] = "Successfully removed from cart.";
                $data['type'] = 1;
            } else {
                $data['type'] = 2;
                $data['msg'] = "Oops!something went wrong.";
            }
            return response()->json($data);
        }
    }

    public function update_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            
            $cartId = $request->input('cartId');
            $qty = $request->input('qty');
            $checkProduct = Cart::where('id', $cartId)->where('status', '1')->first();
            if (!empty($checkProduct)) {
                $input['quantity'] = $qty;
                $checkProduct->update($input);
                
                $data['msg'] = "cart Updated successfully.";
                $data['type'] = 1;
            } else {
                $data['type'] = 2;
                $data['msg'] = "Oops!something went wrong.";
            }
            return response()->json($data);
        }
    }

    

}
