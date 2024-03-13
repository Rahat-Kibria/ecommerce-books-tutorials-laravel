<?php

namespace App\Http\Controllers\backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupons_list()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.coupon.coupons_list', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon_add()
    {
        return view('backend.pages.coupon.coupon_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function coupon_add_submit(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $rules = [
                'code' => 'required',
                'slug' => 'required',
                'expiry_date' => 'required|after_or_equal:today',
                'discount' => 'required|numeric:coupons',
            ];
            $messages = [
                'code.required' => '*Code is required!',
                'slug.required' => '*Slug is required!',
                'expiry_date.required' => '*Expiry Date is required!',
                'expiry_date.after_or_equal:today' => '*Expiry Date should be after or equal today',
                'discount.required' => '*Discount is required!',
                'discount.numeric' => '*Discount has to be numeric',
            ];
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            Coupon::create([
                //'database_column_name' => $request->form_column_name_or_value
                'code' => strtoupper($request->code),
                'slug' => $request->slug,
                'expiry_date' => $request->expiry_date,
                'discount' => $request->discount,
            ]);
            return redirect()->back()->with('success', 'Added 1 coupon successfully');
        } else {
            return redirect()->back()->with('error', 'Check the method properly');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function view_coupon($coupon_id)
    {
        $coupon = Coupon::findOrFail($coupon_id);
        return view('backend.pages.coupon.coupon_view', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit_coupon($coupon_id)
    {
        $coupon = Coupon::findOrFail($coupon_id);
        return view('backend.pages.coupon.coupon_edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update_coupon(Request $request, $coupon_id)
    {
        if ($request->isMethod('put')) {
            $input = $request->all();
            $rules = [
                'code' => 'required',
                'slug' => 'required',
                'expiry_date' => 'required|after_or_equal:today',
                'discount' => 'required|numeric:coupons',
            ];
            $messages = [
                'code.required' => '*Code is required!',
                'slug.required' => '*Slug is required!',
                'expiry_date.required' => '*Expiry Date is required!',
                'expiry_date.after_or_equal:today' => '*Expiry Date should be after or equal today',
                'discount.required' => '*Discount is required!',
                'discount.numeric' => '*Discount has to be numeric',
            ];
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $coupon = Coupon::findOrFail($coupon_id);
            $coupon->update([
                //'database_column_name' => $request->form_column_name_or_value
                'code' => strtoupper($request->code),
                'slug' => $request->slug,
                'expiry_date' => $request->expiry_date,
                'discount' => $request->discount,
            ]);
            return redirect()->back()->with('success', 'Updated 1 coupon successfully');
        } else {
            return redirect()->back()->with('error', 'Check the method properly');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::findOrFail($coupon_id);
        $coupon->delete();
        return redirect()->back()->with('success', 'Deleted 1 coupon successfully');
    }
}
