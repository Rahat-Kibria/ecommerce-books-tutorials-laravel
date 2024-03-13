<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\SubscribeNewsletter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function admin_login()
    {
        return view('auth.login');
    }

    public function admin_login_submit(Request $request)
    {
        $request->validate([
            'username' => 'required|max:30',
            'password' => 'required|min:8'
        ]);
        // $inputValue = request('username');
        $inputValue = $request->username;
        // dd($inputValue);
        $inputKey = filter_var($inputValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // dd($inputKey);
        request()->merge([$inputKey => $inputValue]);
        // dd($request->all());
        if ($inputKey == 'email') {
            $credentials = $request->only(['email', 'password']);
        } else {
            $credentials = $request->only(['username', 'password']);
        }
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Successful');
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function admin_logout()
    {
        Auth::logout(); //auth()->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successful');
    }

    public function admin_details()
    {
        $admin = User::where('role', 'admin')->get();
        // dd($admin);
        return view('backend.pages.admin.admin_details', compact('admin'));
    }

    public function admin_details_update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric|digits:11',
            'birthday' => 'date|before:' . date('07/05/2010')
        ]);
        $admin = User::find(auth()->user()->id);
        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'gender' => $request->gender,
            'birthday' => $request->birthday
        ]);
        return redirect()->back()->with('success', 'Account Updated Successfully');
    }

    public function admin_username_email_update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username'
        ]);
        $admin = User::find(auth()->user()->id);
        $admin->update([
            'email' => $request->email,
            'username' => $request->username
        ]);
        return redirect()->back()->with('success', 'Email Username Changed Successfully');
    }

    public function admin_image_create(Request $request)
    {
        $request->validate([
            'image' => 'image|max:10240'
        ]);
        $fileName = Null;
        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            // dd("true");
            $fileName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/users/', $fileName);
        }
        $admin = User::find(auth()->user()->id);
        $admin->create([
            'image' => $fileName
        ]);
        return redirect()->back()->with('success', 'Image Created Successfully');
    }

    public function admin_image_update(Request $request)
    {
        $request->validate([
            'image' => 'image|max:10240',
        ]);
        $fileName = auth()->user()->image;
        if ($request->hasFile('image')) {
            $removeFile = public_path() . '/uploads/users/' . $fileName;
            File::delete($removeFile);
            $fileName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/users/', $fileName);
        }
        $admin = User::find(auth()->user()->id);
        $admin->update([
            'image' => $fileName
        ]);
        return redirect()->back()->with('success', 'Image Updated Successfully');
    }

    public function admin_password_change(Request $request)
    {
        $request->validate(['password' => 'required|confirmed|min:8']);
        $admin = User::find(auth()->user()->id);
        $admin->update([
            'password' => bcrypt($request->password)
        ]);
        session()->flash('success', 'Password Changed Successfully');
        return redirect()->back();
    }

    public function customers_list()
    {
        $customers = User::where('role', 'auth_user')->orWhere('role', 'guest')->paginate(10);
        return view('backend.pages.customer.customer_list', compact('customers'));
    }

    public function customer_view($user_id)
    {
        $customer = User::findOrFail($user_id);
        return view('backend.pages.customer.customer_view', compact('customer'));
    }
    public function customer_delete($user_id)
    {
        $customer = User::findOrFail($user_id);
        $customer->delete();
        session()->flash('success', 'User deleted successfully');
        return back();
    }

    public function admin_dashboard()
    {
        $customer_count = User::where('role', 'guest')->orWhere('role', 'auth_user')->count();

        $product_count = Product::count();

        $order_count = Order::count();

        $orders_today = Order::where('created_at', '>=', today())->count();

        $products_sold = Order::where('is_completed', 'yes')->count();

        $new_orders = Order::with('user', 'orderDetails')->latest()->take(10)->get();

        $product_ids = OrderDetails::groupBy('product_id')->select('product_id')->pluck('product_id')->all();
        $top_product_sales_count = OrderDetails::with('product')->whereIn('product_id', $product_ids)->selectRaw('product_id, count(*) as total')->orderBy('total', 'desc')->groupBy('product_id')->get();

        $subscriptions = SubscribeNewsletter::latest()->take(10)->get();

        return view('backend.pages.admin.admin_dashboard', compact('customer_count', 'product_count', 'order_count', 'orders_today', 'products_sold', 'new_orders', 'top_product_sales_count', 'subscriptions'));
    }
}
