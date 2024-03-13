<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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

    public function login_registration_page()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        return view('auth.login_register', compact('rootCategories'));
    }

    public function registration(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|digits:11',
            'birthday' => 'date|before:' . date('12/06/2010'),
            'image' => 'max:10240',
            'email' => 'required|email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8'
        ]);
        $otp_number = rand(1111, 9999);
        $fileName = NULL;
        if ($request->hasFile('image')) {
            $fileName = date('Ymdhmi') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/users/', $fileName);
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'image' => $fileName,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'otp' => $otp_number,
            'role' => 'auth_user'
        ]);
        $user_id = $user->id;
        session()->flash('success', 'Registration Successful. Now Verify your contact number');

        $otp_verify_account = new SmsController();
        $otp_success = $otp_verify_account->otp_verify_account($user);

        if($otp_success === true) {
            return view('auth.otp_register', compact('user_id'));
        } else {
            echo "<br><br>Wait... Redirecting in 3 seconds...";
            header('refresh: 3; url=/');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // $inputValue = request('username');
        $inputValue = $request->username;
        $inputKey = filter_var($inputValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$inputKey => $inputValue]);
        if ($inputKey == 'email') {
            $credentials = $request->only(['email', 'password']);
        } else {
            $credentials = $request->only(['username', 'password']);
        }
        $user = User::where('password', $request->password)->orWhere('email', $request->email)->orWhere('username', $request->username)->first();
        if ($user->otp == null) {
            if (Auth::attempt($credentials)) {
                $carts = Cart::where('ip_address', request()->ip())->get();
                if (isset($carts) && !empty($carts)) {
                    foreach ($carts as $cart) {
                        $user_cart = Cart::where('user_id', Auth::id())->where('product_id', $cart->product_id)->first();
                        if (isset($user_cart) && !empty($user_cart) && $cart->product->type == 'Book') {
                            $user_cart->increment('quantity');
                            $cart->delete();
                        } elseif (isset($user_cart) && !empty($user_cart) && $cart->product->type == 'Tutorial') {
                            $cart->delete();
                        } else {
                            $cart->update([
                                'user_id' => auth()->user()->id,
                                'ip_address' => NULL
                            ]);
                        }
                    }
                }
                Session::flash('success', 'Login Successful');
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'Invalid Credentials');
            }
        } else {
            $user_id = $user->id;
            session()->flash('error', 'You have to verify contact with OTP');

            $otp_verify_account = new SmsController();
            $otp_verify_account->otp_verify_account($user, $user_id);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back()->with('success', 'Logout Successful');
    }

    public function account_dashboard()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        return view('frontend.pages.customer.dashboard', compact('rootCategories'));
    }
    public function account_details()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        return view('frontend.pages.customer.account_details', compact('rootCategories'));
    }
    public function my_address()
    {
        // Unlimited child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $customer_address = User::where('id', auth()->user()->id)->first();

        return view('frontend.pages.customer.my_address', compact('customer_address', 'rootCategories'));
    }
    public function my_payment_method()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        return view('frontend.pages.customer.my_payment_method', compact('rootCategories'));
    }
    public function account_details_update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric|digits:11',
            'birthday' => 'date|before:' . date('10/10/2010'),
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
        ]);
        $customer = User::find(auth()->user()->id);
        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'username' => $request->username
        ]);
        return redirect()->back()->with('success', 'Account Updated Successfully');
    }
    public function account_details_update_image(Request $request)
    {
        $request->validate([
            'image' => 'image|max:10240',
        ]);
        $customer = User::find(auth()->user()->id);
        $fileName = auth()->user()->image;
        if ($request->hasFile('image')) {
            $removeFile = public_path() . '/uploads/users/' . $fileName;
            File::delete($removeFile);
            $fileName = date('Ymdhmi') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/users/', $fileName);
        }
        $customer->update([
            'image' => $fileName,
        ]);
        return redirect()->back()->with('success', 'Image Updated Successfully');
    }
    public function account_details_update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);
        $customer = User::find(auth()->user()->id);
        $customer->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
    public function account_delete()
    {
        $customer = User::find(auth()->user()->id);
        if (!empty($customer->image)) {
            $find_image = public_path() . '/uploads/users/' . $customer->image;
            File::delete($find_image);
        }
        $customer->delete();
        return redirect()->back()->with('success', 'Account deleted Successfully');
    }
    public function my_address_create(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'address' => 'required|max:300',
            'city' => 'required|max:50',
            'postal_code' => 'required',
            'country' => 'required|max:50'
        ]);
        User::create([
            //'database_column_name' => $request->form_column_name_or_value
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country
        ]);
        return redirect()->back()->with('success', 'Address created Successfully');
    }
    public function my_address_update(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'address' => 'required|max:300',
            'city' => 'required|max:50',
            'postal_code' => 'required',
            'country' => 'required|max:50'
        ]);
        $customer_address = User::find(auth()->user()->id);
        $customer_address->update([
            //'database_column_name' => $request->form_column_name_or_value
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country
        ]);
        return redirect()->back()->with('success', 'Address Updated Successfully');
    }
}
