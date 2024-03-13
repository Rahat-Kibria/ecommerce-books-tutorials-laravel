<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Category;
use App\Mail\OrderConfirmed;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\frontend\SslCommerzPaymentController;
use App\Models\Audio;
use App\Models\Ebook;

class OrderController extends Controller
{
    private static function tree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty()) {
                self::tree($category->children, $allCategories);
            }
        }
    }
    public function order_checkout_page()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);
        if (auth()->check()) {
            $cart_products = Cart::where('user_id', auth()->user()->id)->latest()->get();
        } else {
            $cart_products = Cart::where('ip_address', request()->ip())->latest()->get();
        }
        return view('frontend.pages.order.checkout_order', compact('rootCategories', 'cart_products'));
    }
    public function order_submit(Request $request)
    {
        if ($request->has('terms_conditions')) {
            if (auth()->check()) {
                $input = $request->except(['username', 'password']);
                $rules = [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email',
                    'contact_number' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'postal_code' => 'required',
                    'country' => 'required',
                ];
                $custom_messages = [
                    'first_name.required' => '*First name is required',
                    'last_name.required' => '*Last name is required',
                    'email.required' => '*Email is required',
                    'email.email' => '*Email has to be email',
                    'contact_number.required' => '*Contact number is required',
                    'address.required' => '*Address is required',
                    'city.required' => '*City is required',
                    'postal_code.required' => '*Postal Code is required',
                    'country.required' => '*Country is required',
                ];
                $validator = Validator::make($input, $rules, $custom_messages);
                if ($validator->fails()) {
                    return back()->withErrors($validator);
                }
                $user = User::find(auth()->user()->id);
                $user->update([
                    //'database_column_name' => $request->form_column_name_or_value
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);
                session()->flash('success', 'Address Updated Successfully');
                if (session()->has('coupon')) {
                    $coupon = Coupon::where('code', session()->get('coupon')['coupon_code'])->first();
                    $order_id = Order::insertGetId([
                        'user_id' => auth()->user()->id,
                        'coupon_id' => $coupon->id,
                        'ip_address' => request()->ip(),
                        'message' => $request->message,
                        'coupon_discount' => session()->get('coupon')['coupon_discount'],
                        'total' => $request->total,
                        'grand_total' => $request->grand_total,
                        'payment_type' => $request->payment_type,
                        'transaction_id' => uniqid(),
                        'currency' => 'BDT',
                        'created_at' => Carbon::now(),
                    ]);
                    $cart_products = Cart::where('user_id', auth()->user()->id)->latest()->get();
                    foreach ($cart_products as $cart_product) {
                        OrderDetails::insert([
                            'order_id' => $order_id,
                            'product_id' => $cart_product->product_id,
                            'product_quantity' => $cart_product->quantity,
                            'created_at' => Carbon::now(),
                        ]);
                    }
                    if (session()->has('coupon')) {
                        $request->session()->forget('coupon');
                    }
                    Cart::where('user_id', auth()->user()->id)->delete();
                    if ($request->payment_type == 'cash on delivery') {
                        $order = Order::where('id', $order_id)->with('orderDetails', 'user', 'orderDetails.product')->first();

                        $otp_order_number = new SmsController();
                        $otp_order_number->otp_order_number($user, $order_id);

                        $this->send_order_place_mail($order);

                        session()->flash('success', 'Order created Successfully');
                        return redirect()->route('botu.order.complete');
                    } else {
                        session()->flash('success', 'Order created Successfully');

                        $otp_order_number = new SmsController();
                        $otp_order_number->otp_order_number($user, $order_id);

                        $sslc = new SslCommerzPaymentController();
                        $sslc->index($order_id);
                    }
                } else {
                    $order_id = Order::insertGetId([
                        'user_id' => auth()->user()->id,
                        'ip_address' => request()->ip(),
                        'message' => $request->message,
                        'total' => $request->total,
                        'grand_total' => $request->grand_total,
                        'payment_type' => $request->payment_type,
                        'transaction_id' => uniqid(),
                        'currency' => 'BDT',
                        'created_at' => Carbon::now(),
                    ]);
                    $cart_products = Cart::where('user_id', auth()->user()->id)->latest()->get();
                    foreach ($cart_products as $cart_product) {
                        OrderDetails::insert([
                            'order_id' => $order_id,
                            'product_id' => $cart_product->product_id,
                            'product_quantity' => $cart_product->quantity,
                            'created_at' => Carbon::now(),
                        ]);
                    }
                    Cart::where('user_id', auth()->user()->id)->delete();
                    if ($request->payment_type == 'cash on delivery') {
                        $order = Order::where('id', $order_id)->with('orderDetails', 'user', 'orderDetails.product')->first();

                        $otp_order_number = new SmsController();
                        $otp_order_number->otp_order_number($user, $order_id);

                        $this->send_order_place_mail($order);

                        session()->flash('success', 'Order created Successfully');
                        return redirect()->route('botu.order.complete');
                    } else {
                        session()->flash('success', 'Order created Successfully');

                        $otp_order_number = new SmsController();
                        $otp_order_number->otp_order_number($user, $order_id);

                        $sslc = new SslCommerzPaymentController();
                        $sslc->index($order_id);
                    }
                }
            } else {
                if ($request->username == null && $request->password == null) {
                    $input = $request->all();
                    $rules = [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|email|unique:users',
                        'contact_number' => 'required',
                        'address' => 'required',
                        'city' => 'required',
                        'postal_code' => 'required',
                        'country' => 'required',
                    ];
                    $custom_messages = [
                        'first_name.required' => '*First name is required',
                        'last_name.required' => '*Last name is required',
                        'email.required' => '*Email is required',
                        'email.email' => '*Email has to be email',
                        'email.unique' => '*Email has to be unique',
                        'contact_number.required' => '*Contact number is required',
                        'address.required' => '*Address is required',
                        'city.required' => '*City is required',
                        'postal_code.required' => '*Postal Code is required',
                        'country.required' => '*Country is required',
                    ];
                    $validator = Validator::make($input, $rules, $custom_messages);
                    if ($validator->fails()) {
                        return back()->withErrors($validator);
                    }
                    $otp_number = rand(1111, 9999);
                    $user = User::create([
                        //'database_column_name' => $request->form_column_name_or_value
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'address' => $request->address,
                        'city' => $request->city,
                        'postal_code' => $request->postal_code,
                        'country' => $request->country,
                        'otp' => $otp_number,
                        'role' => 'guest'
                    ]);
                    session()->flash('success', 'Address added successfully');
                    $user_id = $user->id;
                    $order_message = $request->message;
                    $total = $request->total;
                    $grand_total = $request->grand_total;
                    $payment_type = $request->payment_type;

                    $otp_verify_user = new SmsController();
                    $otp_success = $otp_verify_user->otp_verify_user($user);

                    if($otp_success === true) {
                        return view('auth.otp_checkout', compact('user_id', 'order_message', 'total', 'grand_total', 'payment_type'));
                    } else {
                        echo "<br><br>Wait... Redirecting in 3 seconds...";
                        header('refresh: 3; url=/order/checkout/page');
                    }
                } else {
                    $input = $request->all();
                    $rules = [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|email|unique:users',
                        'contact_number' => 'required',
                        'address' => 'required',
                        'city' => 'required',
                        'postal_code' => 'required',
                        'country' => 'required',
                        'username' => 'required',
                        'password' => 'required',
                    ];
                    $custom_messages = [
                        'first_name.required' => '*First name is required',
                        'last_name.required' => '*Last name is required',
                        'email.required' => '*Email is required',
                        'email.email' => '*Email has to be email',
                        'email.unique' => '*Email has to be unique',
                        'contact_number.required' => '*Contact number is required',
                        'address.required' => '*Address is required',
                        'city.required' => '*City is required',
                        'postal_code.required' => '*Postal Code is required',
                        'country.required' => '*Country is required',
                        'username.required' => '*Username is required',
                        'password.required' => '*Password is required',
                    ];
                    $validator = Validator::make($input, $rules, $custom_messages);
                    if ($validator->fails()) {
                        return back()->withErrors($validator);
                    }
                    $otp_number = rand(1111, 9999);
                    $user = User::create([
                        //'database_column_name' => $request->form_column_name_or_value
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'address' => $request->address,
                        'city' => $request->city,
                        'postal_code' => $request->postal_code,
                        'country' => $request->country,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        'otp' => $otp_number,
                        'role' => 'auth_user'
                    ]);
                    session()->flash('success', 'Account created Successfully');
                    $user_id = $user->id;
                    $order_message = $request->message;
                    $total = $request->total;
                    $grand_total = $request->grand_total;
                    $payment_type = $request->payment_type;

                    $otp_verify_user = new SmsController();
                    $otp_success = $otp_verify_user->otp_verify_user($user);

                    if($otp_success === true) {
                        return view('auth.otp_checkout', compact('user_id', 'order_message', 'total', 'grand_total', 'payment_type'));
                    } else {
                        echo "<br><br>Wait... Redirecting in 3 seconds...";
                        header('refresh: 3; url=/order/checkout/page');
                    }
                }
            }
        } else {
            session()->flash('error', 'You have to agree to our terms and conditions');
            return redirect()->back()->withInput();
        }
    }

    public function otp_in_checkout(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($request->otp === $user->otp) {
            $user->otp = null;
            $user->save();
            if (session()->has('coupon')) {
                $coupon = Coupon::where('code', session()->get('coupon')['coupon_code'])->first();
                $order_id = Order::insertGetId([
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                    'ip_address' => request()->ip(),
                    'message' => $request->message,
                    'coupon_discount' => session()->get('coupon')['coupon_discount'],
                    'total' => $request->total,
                    'grand_total' => $request->grand_total,
                    'payment_type' => $request->payment_type,
                    'transaction_id' => uniqid(),
                    'currency' => 'BDT',
                    'created_at' => Carbon::now(),
                ]);
                $cart_products = Cart::where('ip_address', request()->ip())->latest()->get();
                foreach ($cart_products as $cart_product) {
                    OrderDetails::insert([
                        'order_id' => $order_id,
                        'product_id' => $cart_product->product_id,
                        'product_quantity' => $cart_product->quantity,
                        'created_at' => Carbon::now(),
                    ]);
                }
                if (session()->has('coupon')) {
                    $request->session()->forget('coupon');
                }
                Cart::where('ip_address', request()->ip())->delete();
                if ($request->payment_type == 'cash on delivery') {
                    $order = Order::where('id', $order_id)->with('orderDetails', 'user', 'orderDetails.product')->first();

                    $otp_order_number = new SmsController();
                    $otp_order_number->otp_order_number($user, $order_id);

                    $this->send_order_place_mail($order);
                    session()->flash('success', 'Order created Successfully');
                    return redirect()->route('botu.order.complete');
                } else {
                    session()->flash('success', 'Order created Successfully');

                    $otp_order_number = new SmsController();
                    $otp_order_number->otp_order_number($user, $order_id);

                    $sslc = new SslCommerzPaymentController();
                    $sslc->index($order_id);
                }
            } else {
                $order_id = Order::insertGetId([
                    'user_id' => $user->id,
                    'ip_address' => request()->ip(),
                    'message' => $request->message,
                    'total' => $request->total,
                    'grand_total' => $request->grand_total,
                    'payment_type' => $request->payment_type,
                    'transaction_id' => uniqid(),
                    'currency' => 'BDT',
                    'created_at' => Carbon::now(),
                ]);
                $cart_products = Cart::where('ip_address', request()->ip())->latest()->get();
                foreach ($cart_products as $cart_product) {
                    OrderDetails::insert([
                        'order_id' => $order_id,
                        'product_id' => $cart_product->product_id,
                        'product_quantity' => $cart_product->quantity,
                        'created_at' => Carbon::now(),
                    ]);
                }
                Cart::where('ip_address', request()->ip())->delete();
                if ($request->payment_type == 'cash on delivery') {
                    $order = Order::where('id', $order_id)->with('orderDetails', 'user', 'orderDetails.product')->first();

                    $otp_order_number = new SmsController();
                    $otp_order_number->otp_order_number($user, $order_id);

                    $this->send_order_place_mail($order);
                    session()->flash('success', 'Order created Successfully');
                    return redirect()->route('botu.order.complete');
                } else {
                    session()->flash('success', 'Order created Successfully');

                    $otp_order_number = new SmsController();
                    $otp_order_number->otp_order_number($user, $order_id);

                    $sslc = new SslCommerzPaymentController();
                    $sslc->index($order_id);
                }
            }
        } else {
            return back()->with('error', 'Sorry wrong otp. Try again?');
        }
    }
    public function order_complete()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        if (auth()->check()) {
            $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        } else {
            $order = Order::where('ip_address', request()->ip())->latest()->first();
        }
        if (!empty($order->id)) {
            $order_details = OrderDetails::where('order_id', $order->id)->with('product')->get();
        } else {
            return redirect()->route('botu');
        }

        return view('frontend.pages.order.order_complete', compact('rootCategories', 'order', 'order_details'));
    }
    public function send_order_place_mail($order)
    {
        $pdf = Pdf::loadView('pdf.order_invoice', compact('order'))->setPaper('a4')
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        $pdf->save('uploads/pdf/invoice-' . $order->id . '.pdf');
        Mail::to($order->user->email)->send(new OrderConfirmed($order));
        // Mail::send(new OrderConfirmed($order2), function ($message) use ($order, $pdf) {
        //     $message->to($order->user->email)->attachData($pdf->output(), 'invoice-' . $order->id . '.pdf');
        // });
    }
    public function order_track()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        return view('frontend.pages.order.track_order', compact('rootCategories'));
    }
    public function order_track_number_details(Request $request)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);
        $check = Order::find($request->order_id);
        if (isset($check) && !empty($check)) {
            $order = Order::where('id', $request->order_id)->with('coupon')->first();
            $order_details = OrderDetails::where('order_id', $request->order_id)->with('product')->get();
            return view('frontend.pages.order.track_order_details', compact('rootCategories', 'order', 'order_details'));
        } else {
            return back()->with('error', 'Sorry, We did not find your order. Check your order number');
        }
    }
    public function order_cancel($order_id)
    {
        $order = Order::find($order_id);
        $order->is_cancelled = 'yes';
        $order->is_seen_by_admin = 'no';
        $order->is_out_for_delivery = 'no';
        $order->is_completed = 'no';
        $order->save();
        return back()->with('success', 'Order is cancelled successfully');
    }
    public function my_orders()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $orders = Order::where('user_id', auth()->user()->id)->latest()->get();

        return view('frontend.pages.customer.my_orders', compact('rootCategories', 'orders'));
    }
    public function my_order_details($order_id)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $order = Order::where('id', $order_id)->with('coupon')->first();
        $order_details = OrderDetails::where('order_id', $order_id)->with('product')->get();

        return view('frontend.pages.customer.my_order_details', compact('rootCategories', 'order', 'order_details'));
    }
    public function my_returns()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        return view('frontend.pages.customer.my_returns', compact('rootCategories'));
    }

    public function my_courses()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $order_ids = Order::where('user_id', auth()->user()->id)->where('is_completed', 'yes')->pluck('id')->all();
        $order_details = OrderDetails::whereIn('order_id', $order_ids)->with('product')->latest()->get();
        $products = array();
        foreach ($order_details as $order_detail) {
            if ($order_detail->product->type == 'Tutorial') {
                $products[] = $order_detail->product;
            }
        }

        return view('frontend.pages.customer.my_courses', compact('rootCategories', 'products'));
    }
    public function my_audio_books()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $order_ids = Order::where('user_id', auth()->user()->id)->where('is_completed', 'yes')->pluck('id')->all();
        $order_details = OrderDetails::whereIn('order_id', $order_ids)->with('product')->latest()->get();
        $audios = array();
        foreach ($order_details as $order_detail) {
            if ($order_detail->product->type == 'Book') {
                $audio_check = Audio::where('product_id', $order_detail->product->id)->first();
                if (isset($audio_check) && !empty($audio_check)) {
                    $audios[] = $audio_check;
                }
            }
        }

        return view('frontend.pages.customer.my_audio_books', compact('rootCategories', 'audios'));
    }
    public function my_ebooks()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $order_ids = Order::where('user_id', auth()->user()->id)->where('is_completed', 'yes')->pluck('id')->all();
        $order_details = OrderDetails::whereIn('order_id', $order_ids)->with('product')->latest()->get();
        $ebooks = array();
        foreach ($order_details as $order_detail) {
            if ($order_detail->product->type == 'Book') {
                $ebook_check = Ebook::where('product_id', $order_detail->product->id)->first();
                if (isset($ebook_check) && !empty($ebook_check)) {
                    $ebooks[] = $ebook_check;
                }
            }
        }

        return view('frontend.pages.customer.my_ebooks', compact('rootCategories', 'ebooks'));
    }
}
