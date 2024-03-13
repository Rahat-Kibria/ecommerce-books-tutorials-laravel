<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\CompletedNo;
use App\Mail\CompletedYes;
use App\Mail\SeenByAdminNo;
use App\Mail\SeenByAdminYes;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Mail\OutForDeliveryNo;
use App\Mail\OutForDeliveryYes;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\frontend\SmsController;

class OrderController extends Controller
{
    public function orders_list()
    {
        $orders = Order::orderByDesc('id')->paginate(10);
        return view('backend.pages.order.orders_list', compact('orders'));
    }
    public function seen_by_admin_to_yes(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $order->update([
            'is_seen_by_admin' => 'yes'
        ]);

        Mail::to($user->email)->send(new SeenByAdminYes($user, $order));

        $seen_by_admin_to_yes = new SmsController();
        $seen_by_admin_to_yes->seen_by_admin_to_yes($user, $order);

        return back()->with('success', 'Updated successfully');
    }
    public function seen_by_admin_to_no(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $order->update([
            'is_seen_by_admin' => 'no'
        ]);

        Mail::to($user->email)->send(new SeenByAdminNo($user, $order));

        $seen_by_admin_to_no = new SmsController();
        $seen_by_admin_to_no->seen_by_admin_to_no($user, $order);
        return back()->with('success', 'Updated successfully');
    }
    public function out_for_delivery_to_yes(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $order->update([
            'is_out_for_delivery' => 'yes'
        ]);

        Mail::to($user->email)->send(new OutForDeliveryYes($user, $order));

        $out_for_delivery_to_yes = new SmsController();
        $out_for_delivery_to_yes->out_for_delivery_to_yes($user, $order);
        return back()->with('success', 'Updated successfully');
    }
    public function out_for_delivery_to_no(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $order->update([
            'is_out_for_delivery' => 'no'
        ]);

        Mail::to($user->email)->send(new OutForDeliveryNo($user, $order));

        $out_for_delivery_to_no = new SmsController();
        $out_for_delivery_to_no->out_for_delivery_to_no($user, $order);
        return back()->with('success', 'Updated successfully');
    }
    public function completed_to_yes(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $order->update([
            'is_completed' => 'yes',
            'completion_date' => Carbon::now(),
        ]);

        Mail::to($user->email)->send(new CompletedYes($user, $order));

        $completed_to_yes = new SmsController();
        $completed_to_yes->completed_to_yes($user, $order);
        return back()->with('success', 'Updated successfully');
    }
    public function completed_to_no(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $order->update([
            'is_completed' => 'no',
        ]);

        Mail::to($user->email)->send(new CompletedNo($user, $order));

        $completed_to_no = new SmsController();
        $completed_to_no->completed_to_no($user, $order);
        return back()->with('success', 'Updated successfully');
    }
    public function order_delete($order_id)
    {
        $order = Order::findOrFail($order_id);
        OrderDetails::where('order_id', $order_id)->delete();
        $order->delete();
        return redirect()->back()->with('success', 'Order successfully deleted');
    }
    public function admin_view_order_details($order_id)
    {
        $order = Order::where('id', $order_id)->with('user', 'coupon')->first();
        $order_details = OrderDetails::where('order_id', $order_id)->with('product')->get();
        return view('backend.pages.order.order_details_view', compact('order', 'order_details'));
    }
    public function admin_view_order_invoice($order_id)
    {
        $order = Order::where('id', $order_id)->with('orderDetails', 'user', 'orderDetails.product')->first();
        $pdf = Pdf::loadView('pdf.order_invoice', compact('order'))->setPaper('a4')
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        // return $pdf->stream('invoice-' . $order_id . '.pdf');
        return view('pdf.order_invoice', compact('order'));
    }
    public function admin_generate_order_invoice($order_id)
    {
        $order = Order::where('id', $order_id)->with('orderDetails', 'user', 'orderDetails.product')->first();
        $pdf = Pdf::loadView('pdf.order_invoice', compact('order'))->setPaper('a4')
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        return $pdf->download('invoice-' . $order_id . '.pdf');
    }
}
