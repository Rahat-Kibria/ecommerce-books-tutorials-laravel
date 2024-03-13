<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function orders_report()
    {
        $orders = Order::with('user', 'orderDetails')->latest()->paginate(30);
        return view('backend.pages.report.orders_report', compact('orders'));
    }
    public function orders_report_search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_date'    => 'required|date',
            'to_date'      => 'required|date|after:from_date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $from = $request->from_date;
        $to = $request->to_date;
        $orders = Order::whereBetween('created_at', [$from, $to])->paginate(30);
        return view('backend.pages.report.orders_report', compact('orders'));
    }
}
